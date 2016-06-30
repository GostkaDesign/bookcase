<?php

namespace Core;
use \Core\Random;
// 
class Auth {

    private $options = [

    'restriction_msg' => "Acces denied. You must be loged."

    ];

    private $session;


    public function __construct($session, $options = []){

        $this->options = array_merge($this->options, $options);

        $this->session = $session;

    }

    // Hash du password
    public function hashPassword ($password){

        $conf = array('cost' => 11);
        $password = password_hash($password, PASSWORD_BCRYPT, $conf);
        return $password;
    }

    // Inscription sur le site
    public function register ($db, $username, $password, $email) {

        $password = $this->hashPassword($password);
        // Création du token pour la validation
        $token = Str::random(60);

        debug($token);

        // Création de l'entrée user dans la BDD
        $db->query('INSERT INTO users SET username = ?, email = ?, password = ?, confirmation_token = ?', [
           $username,
           $email,
           $password,
           $token
           ]);
        

        $user_id = $db->lastInsertId();
        debug($user_id);
        

        $to = $email;
        $object = 'Confirmation de votre compte BOOKCASE';
        $message = "<b>Confirmation de votre inscrition sur BookCase</b>\n\n\r\n\n\r
        Afin de valider votre compte merci de cliquer sur ce lien : \n\n\r\r
        http://localhost/gitkraken/projets/bookcase/mvc/public/profile/confirm/?id=" . $user_id . "&token=" . $token;
        
        $headers  = 'From: gostka@free.f'."\r\n".
                    'Reply-To: gostka@free.fr'."\r\n".
                    'MIME-Version: 1.0' . "\r\n".
                    'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        mail($to, $object, $message, $headers);

        // die('Votre compte à bien été créé');
        // éventueellement faire un return true pour savoir si le compte à été créé

    }

    // Confirmation de l'inscription
    public function confirm ($db, $user_id, $token){


        $user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();

        if ($user && $user->confirmation_token == $token ) {     

            // Mise à jour de la date de validation
            $db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?', [$user_id]);

            // On stock l'utilisateur dans la variable session
            $this->session->write('auth', $user);

            return true;

        } else {

            return false;
        }

    }

    // public function restrict(){

    //     if (!$this->session->read('auth')) {

    //         $this->session->setFlash('danger', $this->options['restriction_msg']);

    //         //Redirection vers la page profile
    //         AppDB::redirect("../login/");

    //         exit();

    //     }
    // }
    
    // Retourn les slugs de permissions
    private function getSlugs($db){

        $slugs = $db->query('SELECT slug,level FROM roles')->fetchAll();
        $roles = array();

        foreach ($slugs as $key => $userType) {
            // echo "[$key]  ";
            // var_dump($userType);
            // echo "Slug: $userType->slug  |    ";
            // echo "level: $userType->level";
            // echo '<br>';
            $roles[$userType->slug] = $userType;
            unset($userType);
        }       
        return $roles;
    }


    // Autorise des rangs a acceder à une page
    public function restrict($db, $slug = "member"){


        // On test si l'utilisateur est connecté
        if (!$this->session->read('auth')) {

            $this->session->setFlash('danger', $this->options['restriction_msg']);

            //Redirection vers la page profile
            AppDB::redirect(WEBROOT."profile/login/");
            
            exit();
        }

        // On va vérifier tous les roles disponnibles
        $roles = $this->getSlugs($db);
        // var_dump($roles);

        
        if (!isset($roles[$slug]->slug)) {
            $this->session->setFlash('danger', "Profile type unknow, please check the syntax for <b>$slug</b>");
        }
        else {

            if ($this->session->read('auth')->level >= $roles[$slug]->level){
                // $this->session->setFlash('success', "Vous avez les droits necessaires");
            }
            else {
                $this->session->setFlash('danger', $this->options['restriction_lvl_msg']);
                //Redirection vers la page profile
                AppDB::redirect(WEBROOT."profile/account/");
                exit();
            }
        }

    }

    // return l'utilisateur depuis la session
    public function user(){

        if (!$this->session->read('auth')) {

            return false;
            
        }
        return $this->session->read('auth');

    }

    //connexion de l'utilisateur 
    public function connect($user){
        
        // session_regenerate_id();
        $this->session->write('auth', $user);
        // die (var_dump ($user));

    }


    // connexion depuis un cookie + rafraichissement des cookies
    public function connectFromCookie($db){
        

        if (isset($_COOKIE['remember']) && !$this->user()) {

            $remember_token = $_COOKIE['remember'];

            $parts = explode('==', $remember_token);

            $user_id = $parts[0];

            $user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();
            
            
            if ($user) {

                $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'BookCase');

                if ($expected == $remember_token) {

                    $this->connect($user);

                    $_SESSION['flash']['success'] = "Auth success !";

                    // On rafraichi le cookie
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);

                }else {

                    setcookie('remember', NULL, -1);

                }
            }else {

                setcookie('remember', NULL, -1);
                
            }


        }
        
    }

    // Return l'utilisateur s'il existe
    private function user_exist($db, $username, $password){

        // $user = $db->query('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL', ['username' => $username])->fetch();
        $user = $db->query('SELECT * FROM users LEFT JOIN roles ON users.role_id=roles.level WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL', ['username' => $username])->fetch();

        return $user;

    }

    // Connexion à un compte
    public function login ($db, $username, $password, $remember = false){

        $user = $this->user_exist($db, $username, $password);
        if ($user){

            if (password_verify($password, $user->password)) {

                // On stock l'utilisateur dans la variable session
                $this->connect($user);

                //Verification si la case "se rappeler" de moi est cochée
                if ($remember) {

                    // voir plus securise
                    $remember_token = Str::random(250);
                    
                    // $req = $pdo->prepare('SELECT * FROM users WHERE remeber_token != NULL');
                    $db->query('UPDATE users SET remember_token = ? WHERE id = ?', [$remember_token, $user->id]);

                    // cookie qui tiendra 7 jours
                    setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'BookCase'), time() + 60 * 60 * 24 * 7);


                }

                return $user;

            }else {

               return false;

            }

        }
        else {
            return false;
        }

    }

    //Deconnexion d'un compte
    public function logout(){
        
        setcookie('remember', NULL, -1);
        
        $this->session->delete('auth');

    }

    // Renvoie un token pour reinitialiser son mot de passe
    public function rememberPassword($db, $email){

        $user = $db->query('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL', [$email])->fetch();

        if ($user) {

            $reset_token = Str::random(60);

            $db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?', [$reset_token, $user->id]);

            $to = $email;
            $object = 'Reinitialisation de votre mot de passe BOOKCASE';
            $message = "<b>Afin de reinitialise votre mot de passe BOOKCASE merci de cliquer sur ce lien : </b>\n\n\r\r
            http://localhost/gitkraken/projets/bookcase/mvc/public/profile/password_reset/?id={$user->id}&token=" . $reset_token;

            $headers  = 'From: gostka@free.fr'."\r\n".
                        'Reply-To: gostka@free.fr'."\r\n".
                        'MIME-Version: 1.0' . "\r\n".
                        'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            mail($to, $object, $message, $headers);

            return $user;

        }
        return false;

    }

    // Verifie le token de l'user
    public function getUserFromUserToken($db, $user_id, $token){

        return $db->query('SELECT * FROM users WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token])->fetch();

    }

    // Mise a jour du mot de passe du compte
    public function changePassword($db, $user_id, $password){

        $password = $this->hashPassword($password);
        // Update du password        
        $db->query('UPDATE users SET password = ?, reset_at = NOW() WHERE id = ?', [$password, $user_id]);

    }
    


}

?>
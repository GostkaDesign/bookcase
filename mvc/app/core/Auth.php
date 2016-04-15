<?php 

class Auth {

    private $options = [

    'restriction_msg' => "Acces denied. You must be loged."

    ];

    private $session;

    public function __construct($session, $options = []){

        $this->options = array_merge($this->options, $options);

        $this->session = $session;

    }

    public function register ($db, $username, $password, $email) {

    	$conf = array('cost' => 11);
        $password = password_hash($password, PASSWORD_BCRYPT, $conf);

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
        
        $headers  = 'From: Bookcase - votre gestionnaire de livre en ligne'."\r\n";
        $headers .= 'Reply-To: gostka@free.fr'."\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        mail($to, $object, $message, $headers);

        // die('Votre compte à bien été créé');
        // éventueellement faire un return true pour savoir si le compte à été créé

    }

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

    public function restrict(){

        if (!$this->session->read('auth')) {

            $this->session->setFlash('danger', $this->options['restriction_msg']);

            //Redirection vers la page profile
            AppDB::redirect("../login/");

            exit();

        }
    }

    public function user(){

        if (!$this->session->read('auth')) {

            return false;
            
        }
        //else
        return $this->session->read('auth');

    }

    public function connect($user){

        $this->session->write('auth', $user);

    }

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

    private function user_exist($db, $username, $password){

        $user = $db->query('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL', ['username' => $username])->fetch();

        return $user;

    }

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


}

?>
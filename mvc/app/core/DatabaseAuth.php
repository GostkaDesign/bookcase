<?php 

class DatabaseAuth {

    private $db;

    public function __construct($db)
    {
    	
    	$this->db = $db;

    }

    public function register ($username, $password, $email) {

    	$options = array('cost' => 11);
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        // Création du token pour la validation
        $token = Str::random(60);

        debug($token);

        // Création de l'entrée user dans la BDD
        $this->db->query('INSERT INTO users SET username = ?, email = ?, password = ?, confirmation_token = ?', [
	          $username,
	          $email,
	          $password,
	          $token
          ]);
        // die('Votre compte à bien été créé');

        $user_id = $this->db->lastInsertId();
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

    }

    public function confirm ($user_id, $token, $session){

        
        $user = $this->db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();

        if ($user && $user->confirmation_token == $token ) {     

            // Mise à jour de la date de validation
            $this->db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?', [$user_id]);

            // On stock l'utilisateur dans la variable session
            $session->write('auth', $user);

            return true;

        } else {

            return false;
        }

    }


}

?>
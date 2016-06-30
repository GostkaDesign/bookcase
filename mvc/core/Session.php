<?php 

namespace Core;

class Session
{
    /**
     * summary
     */
    public function __construct()
    {
        echo '<br><span class="label label-success">SESSION LAUNCH</span><br><br>';
        session_start();

    }

    static $instance; // singleton pattern
    const KEY = 'flash';

    static function getInstance (){
    	if (!self::$instance) {

    		self::$instance = new Session();

    	}

    	return self::$instance;

    }

    //connexion de l'utilisateur 
    public function updateSessionUser($user){

        $this->write('auth', $user);

    }
    
    // Definir un message flash
    public function setFlash($key, $message) {
    	
    	$_SESSION[self::KEY][$key] = $message;

    }

    // A un message flash
    public function hasFlashes() {
    	
    	return isset($_SESSION[self::KEY]);

    }

    // Retourn le message flash
    public function getFlashes(){
        
        $flash = $_SESSION[self::KEY];

        unset ($_SESSION[self::KEY]);

        return $flash;

    }

    // Modifier une cles session
    public function write($key, $value){

        $_SESSION[$key]=$value;

    }

    // Lire une cles sesssion
    public function read($key){

        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;

    }

    // Deleter la session
    public function delete($key){

        unset($_SESSION[$key]);
    }


}

?>
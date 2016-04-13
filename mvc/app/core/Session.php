<?php /**
 * summary
 */
class Session
{
    /**
     * summary
     */
    public function __construct()
    {
        
        session_start();

    }
    static $instance; // singleton pattern

    static function getInstance (){
    	if (!self::$instance) {
            
    		self::$instance = new Session();

    	}

    	return self::$instance;

    }
    

    public function setFlash($key, $message)
    {
    	
    	$_SESSION['flash'][$key] = $message;

    }

    public function hasFlashes()
    {
    	
    	return isset($SESSION['flash']);

    }

    public function getFlashes(){

        $flash = $_SESSION['flash'];

        unset ($_SESSION['flash']);

        return $flash;

    }

    public function write($key, $value){

        $_SESSION[$key]=$value;

    }

    public function read($key){

        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;

    }


}

?>
<?php 

class AppDB {

    static $db = null;

    static function getDatabase(){

    	// Condition qui permet d'initialiser la connexion à la base de donnée qu'une seule fois 

    	if (!self::$db) {
    		
    		self::$db = new Database('root', '', 'bookcase', 'localhost');
           
    	}

    	return self::$db;

    }

    static function redirect($page){

        header("location: $page");

        exit();
        
    }

    static function getAuth(){
        //A chaque appel on appel une instance differente.
        //A voir s'il faudra modifier et renvoyer toujour la meme
        // lorsque la connexion facebook sera la 

        return new Auth(Session::getInstance(), ['restriction_msg' => 'Lol tu es bloque']);

    }

    

}

?>
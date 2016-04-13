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

}

?>
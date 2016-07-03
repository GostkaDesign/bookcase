<?php 

namespace Core;
use \Core\Config\Conf;
use \Core\Database\MysqlDatabase;
use \Core\Table\Table;

class AppDB {

    static $db = null;

    static $conf_DB_Name = 'default';


    // Connexion a la bdd
    public static function getDatabase(){

    	// Condition qui permet d'initialiser la connexion à la base de donnée qu'une seule fois 

    	if (!self::$db) {
    		
            $conf = Conf::$databases[self::$conf_DB_Name];

    		self::$db = new MysqlDatabase($conf["database"], $conf["login"], $conf["password"], $conf["host"]);
           
    	}
    	return self::$db;


    }

    // Redirection
    public static function redirect($page){

        header("location: $page");

        exit();
        
    }

    // Genere uen instance unique d'authentification
    public static function getAuth(){
        //A chaque appel on appel une instance differente.
        //A voir s'il faudra modifier et renvoyer toujour la meme
        // lorsque la connexion facebook sera la 

        return new Auth(Session::getInstance(), [
            'restriction_msg' => 'Access reservé',
            'restriction_lvl_msg' => 'Compte level pas asse elevé'
        ]);

    }

    // Factory pour les Tables
    // sappel de cette facon var_dump(AppDB::getTable('Users'));
    public static function getTable($tableName){
        
        $class_name = '\\App\\Table\\' . ucfirst($tableName) . 'Table';

        return new $class_name(self::$db);

    }

    

}

?>
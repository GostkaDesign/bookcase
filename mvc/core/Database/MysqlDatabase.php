<?php 

namespace Core\Database;

use \PDO;
use \Core\Database\Database;
use \Core\Config\conf;

/**
* 
*/
class MysqlDatabase extends Database {
    private $db_name;

    private $db_user;

    private $db_pass;

    private $db_host;

    private $conf;

    private $pdo;


    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost')
    {
        
        $this->db_name = $db_name;

        $this->db_user = $db_user;

        $this->db_pass = $db_pass;

        $this->db_host = $db_host;

        try{
            if ($this->pdo === null) {

                $this->pdo = new PDO ("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);

                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            }
            
            
        }

        catch(PDOException $e)
        
        {
            
            if (Conf::$debug >= 1){

                die('Erreur : '.$e->getMessage());

            }else {
                die('Impossible de se connecter à la base de données');
            }
            
        
        }

    }

    //$statement ou $query
    public function query($statement, $params = false){

        if ($params) {
            
            $req = $this->pdo->prepare($statement);

            $req->execute($params);

        }else{

            $req = $this->pdo->query($statement);
            
        }   

        return $req;
        // faire un fetch ou fetchall ensuite

    }

    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }



}

?>
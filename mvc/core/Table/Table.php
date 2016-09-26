<?php 

namespace Core\Table;
use \App\Core\Database;
/**
 * Class permetant d'appeler dynamiquement une table
 */
 class Table
 {
 	
 	protected $table;
 	protected $db;
 	
 	public function __construct($db)
 	{
 		$this->db = $db;

 		if (is_null($this->table)) {

 			$this->db = $db;

 			var_dump(get_class($this));

	 		$parts = explode('\\', get_class($this));

	 		$class_name = end($parts);

	 		$this->table = strtolower(str_replace('Table', '', $class_name));

 		}
 		
 	}


 	public function all(){

 		return $this->db->query('SELECT * FROM users')->fetchAll();
 	}


 }

 ?>
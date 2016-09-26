<?php 

namespace Core\Model;
/**
 * summary
 */
class Model {
    /**
     * summary
    */
    protected $db;

    public function __construct($dependances = null){
    	if (isset($dependances)){

                extract($dependances);

                if (isset($db)){
                    $this->db = $db;
                }

            }
        
        // echo __CLASS__."<br>";
    }

    public function delete1 (){
		echo 'fdsf'; 	
    }
}

?>
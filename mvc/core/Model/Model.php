<?php 

namespace Core\Model;
/**
 * summary
 */
class Model {
    /**
     * summary
    */
  

    public function __construct($dependances = null)
    {
    	
        if (isset($dependances['db'])){
            $this->db = $dependances['db'];
        }
        echo __CLASS__;
    }

    public function delete1 (){
		echo 'fdsf';    	
    }
}

?>
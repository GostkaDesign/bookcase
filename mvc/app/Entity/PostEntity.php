<?php

namespace App\Entity;

use Core\Entity\Entity;

/**
 * summary
 */
class PostEntity extends Entity {

    /**
     * summary
    */
    
    public function getUrl(){

		return 'index.php?p=article&id=' . $this->id;

    }

    public function getExtrait(){

    	$html = '<p>' . substr($this->contenu, 0, 100) . '...</p>';

    	$html .= '<p><a href="' . $this->getUrl() . '">Voir la suite</a></p>';

    	return $html;

    }
}

 ?>
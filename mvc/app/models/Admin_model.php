<?php

class Admin_model
{
	// public $name;

	function __construct()
	{
		// echo 'Bonjour je suis la class MODELUSER';
		// echo 'user : ' . $name . '<br>';
		
	}

	public function get_users($db){

    	$users = $db->query('SELECT * FROM users')->fetchAll();
    	return $users;

    }

    public function get_user($db, $id,$username){
    	//a verifier
    	$users = $db->query('SELECT * FROM users WHERE id=? OR username=?', [$id, $username])->fetch();
    	return $user;

    }

	

}

?>
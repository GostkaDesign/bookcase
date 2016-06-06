<?php

class User
{
		
	function __construct()
	{
		echo '<br>Bonjour je suis la class MODEL USER<br>';
		// echo 'user : ' . $name . '<br>';
	}

    /**
     * db object
     * id string
     * username string
     * return string
     **/
	public function get_users($db){

        $users = $db->query('SELECT id, role_id, username, email FROM users')->fetchAll();
        return $users;

    }

    // AVEC TOUS LES CHAMPS DE LA BDD
    // public function get_users($db){

    //     $users = $db->query('SELECT * FROM users')->fetchAll();
    //     return $users;

    // }

    /**
     * db object
     * return object
     **/
    public function get_roles($db){

        $slugs = $db->query('SELECT slug,level FROM roles')->fetchAll();
        $roles = array();

        foreach ($slugs as $key => $userType) {
            // echo "[$key]  ";
            // var_dump($userType);
            // echo "Slug: $userType->slug  |    ";
            // echo "level: $userType->level";
            // echo '<br>';
            $roles[$userType->slug] = $userType;
            unset($userType);
        }       
        return $roles;
        
    }

    /**
     * db object
     * user_id string
     * return string
     **/
    // public function get_role($db, $user_id){

    //     $user_level = $db->query('SELECT role_id FROM users WHERE user_id=?',[$user_id])->fetch();
    //     $role = $db->query('SELECT name,slug FROM roles WHERE level=?',[$user_level])->fetch();
    //     return $roles;
        
    // }
    // 
    
    private function get_role($db, $role_id){

        $role = $db->query('SELECT name FROM roles WHERE level=?',[$role_id])->fetch();
        return $role->name;
    }

    /**
     * db object
     * id string
     * username string
     * return string
     **/
    public function get_user($db, $id, $username){
    	//a verifier
    	$users = $db->query('SELECT * FROM users WHERE id=? OR username=?', [$id, $username])->fetch();
    	return $user;

    }

    /**
     * db object
     * return string [html]
     **/
    public function get_users_list($db){
		
		$users = $this->get_users($db);
		// var_dump($users);
    	
    	$user_list = "<div class='list-group' >";
    	foreach ($users as $user) {

    		$user_list .= "<div class='col-lg-6'>
    						<a href='#' class='list-group-item ' >";
    		$user_list .= "<h4 class='list-group-item-heading'><b>$user->username</b> [$user->id]</h4>";
			$user_list .= "<p class='list-group-item-text'>";
    //         foreach ($user as $key => $value) {
				// 	$user_list .= "<b>$key</b> : $value<br>";
				// }
            $user_list .= "<b>Grade :</b> : ".$this->get_role($db,$user->role_id)."<br>"; 
            $user_list .= "<b>Email :</b> : $user->email<br>";


            $user_list .= "</p>";
    		$user_list .= "</a>
    						</div>";

    	}

    	$user_list .= "</div>";
    	return $user_list;	

    }
}

?>
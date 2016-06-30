<?php

class User
{
	

    protected $db;
    private $username;
    private $email;
    private $last_name;
    private $first_name;
    private $last_connection;
    private $role_id;
    private $is_logged = false;


    /*********
    / TAB USERS
    /**********
    id                  : int
    role_id             : int
    username            : varchar
    email               : varchar
    password            : varchar
    last_name           : varchar
    first_name          : varchar
    confirmation_token  : varchar
    confirmed_at        : datetime
    reset_token         : varchar
    reset_at            : datetime
    remember_token      : varchar
     */	
	function __construct($db)
	{
		echo '<br><span class="label label-success">MODEL USER</span><br>';
        $this->db = $db;        
	}

    static $instance; // singleton pattern

    public static function getInstance (){

        if (!self::$instance) {

            self::$instance = new User();

        }

        return self::$instance;

    }

    /**
     * db object
     * id string
     * username string
     * return string
     **/
	public function get_users(){

        $users = $this->db->query('SELECT id, role_id, username, email FROM users')->fetchAll();
        return $users;

    }


    /**
     * db object
     * return object
     **/
    public function get_roles(){

        $slugs = $this->db->query('SELECT slug,level FROM roles')->fetchAll();
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
    // public function get_roles($user_id){

    //     $user_level = $this->db->query('SELECT role_id FROM users WHERE user_id=?',[$user_id])->fetch();
    //     $role = $this->db->query('SELECT name,slug FROM roles WHERE level=?',[$user_level])->fetch();
    //     return $roles;
        
    // }
    
    /*
    db object 
    role_id number
    return string
     */
    private function get_role($role_id){

        $role = $this->db->query('SELECT name FROM roles WHERE level=?',[$role_id])->fetch();
        return $role->name;
    }

    /**
     * db object
     * id string
     * username string
     * return string
     **/
    public function get_user($id, $username){
    	//a verifier
    	$users = $this->db->query('SELECT * FROM users WHERE id=? OR username=?', [$id, $username])->fetch();
    	return $user;

    }

    /**
     * db object
     * return string [html]
     **/
    public function get_users_list(){
		$users = $this->get_users();

    	$user_list = "<div class='list-group' >";
    	foreach ($users as $user) {

    		$user_list .= "<div class='col-lg-6'>
    						<a href='#' class='list-group-item ' >";
    		$user_list .= "<h4 class='list-group-item-heading'><b>$user->username</b> [$user->id]</h4>";
			$user_list .= "<p class='list-group-item-text'>";
                //foreach ($user as $key => $value) {
				// 	$user_list .= "<b>$key</b> : $value<br>";
				// }
            $user_list .= "<b>Grade :</b> : ".$this->get_role($user->role_id)."<br>"; 
            $user_list .= "<b>Email :</b> : $user->email<br>";


            $user_list .= "</p>";
    		$user_list .= "</a>
    						</div>";

    	}

    	$user_list .= "</div>";
    	return $user_list;	

    }

    public function promote_user($username, $role_level){
        $this->db->query('UPDATE users SET role_id = ? WHERE username = ?', [$role_level, $username]);
        $session = Session::getInstance();
        // $user = $this->db->query('SELECT * FROM users WHERE username=?', [$username])->fetch();
        $user = $this->db->query('SELECT * FROM users LEFT JOIN roles ON users.role_id=roles.level WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL', ['username' => $username])->fetch();
        var_dump($user);         
        print_r($session);
        // echo $user->role_id;

        // $this->session->write('auth', $user);
        $session->updateSessionUser($user);
        
        return true;
    }

    // public function update($db, $user_id, $label, $value){

    //     // Update du password        
    //     $db->query('UPDATE users SET $label = ? WHERE id = ?', [$label, $value]);

    // }
    // 
    
    public function update($username) {
    }

    public function delete($user) {
        $this->$db->query('DELETE FROM users WHERE user = ', [$user]);
        return true;
    }

    // public function get_users() {
    //     $users = $this->$db->query('SELECT * FROM users');
    //     return ($users);
    // }


    // INIT
    // creation de la bdd 
    // private function create_db() {
    //     $query  = 'CREATE TABLE users ('
    //             . 'user VARCHAR(75) NOT NULL, '
    //             . 'password VARCHAR(75) NOT NULL, '
    //             . 'email VARCHAR(150) NULL, '
    //             . 'PRIMARY KEY (user) '
    //             . ') ENGINE=MyISAM COLLATE=utf8_general_ci';
    //     return ($this->db->query($query));
    // }

    // private function drop_db() {
    //     $query  = 'DROP TABLE IF EXISTS users ';
    // }
}

?>
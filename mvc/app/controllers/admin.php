<?php


/**
* 
*/
class Admin extends Controller {
	
	public function Index(){
		
		// Définition du modèle à utiliser
		// $data = $this->model('Admin_model');

		// On set les variables
		// $data->name = $name;

		// Définition de la vue à utiliser
		$this->view('admin/index');

	}

	public function Users(){
	
			// Définition du modèle à utiliser
		$data = $this->model('User');

		// $data = $this->layout('test_layout_home');
		// 
		$db = AppDB::getDatabase();
		

		// On set les variables
		$users = new User();
		// $data->users = $users->get_users($db);
		$data->users = $users->get_users_list($db);
		// $data->roles = $users->get_roles($db);

		// var_dump($data);

		// Définition de la vue à utiliser
		$this->view('admin/users', $data);

	}

}

?>
<?php

class Admin extends Controller {
	
	public function Index(){
		
		// Définition du modèle à utiliser
		$data = $this->model('Admin_model');
		// On set les variables
		// $data->name = $name;

		// Définition de la vue à utiliser
		$this->view('admin/index');

	}

	public function Users(){
		
		$db = AppDB::getDatabase();

		// Définition du modèle à utiliser
		// $data = $this->model('User', $db);
		// $data->layout = $this->layout('admin_users');
		
		
		// $data->category = "mes category";
		// $data->users = $data->get_users_list();
		// // Définition de la vue à utiliser
		// $this->view('admin/users', $data);
		
				 
		$model = $this->model('User', $db);
		$this->layout('admin_users');
		
		
		$category = "mes category";
		$users = $model->get_users_list();

		// Définition de la vue à utiliser
		$this->view('admin/users', compact('category', 'users'));


		// echo ($data->promote_user('Gostka',3));
		// var_dump($user);

		// $data->users = $users->get_users();
		// $data->roles = $users->get_roles();

		// on peux aussi faire un compact('array','array',..) des tableaux à envoyer
		// au lieux de l'objet data
		// et dans view refaire un extract($data)

		// var_dump($data);


		

	}

}

?>
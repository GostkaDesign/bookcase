<?php

function debug ($variable){
	if (!isset($variable)){

		echo "<pre> Aucune variable à débuguer n'est défini</pre>";

	}
	else{
		echo '<pre>' . print_r($variable, true) . '</pre>';
	}
	
}

function str_random($lenght){

	$alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

	return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0 , $lenght);

}

function is_connected(){
	
	if (!isset($_SESSION['auth'])) {
		
		$_SESSION['flash']['danger'] = "Acces denied. You must be loged.";

		//Redirection vers la page profile
      	header('location:../login/');

      	exit();

	}
}

function reconnect_from_cookie(){
	
	if (isset($_COOKIE['remember']) && !isset($_SESSION['auth'])) {

		require_once 'db.php';

		if (!isset($pdo)) {
		
			global $pdo;
		
		}

		$remember_token = $_COOKIE['remember'];

		$parts = explode('==', $remember_token);

		$user_id = $parts[0];

		$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
		
		$req->execute([$user_id]);

		$user = $req->fetch();

		if ($user) {
			
			$expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'BookCase');

			if ($expected == $remember_token) {
				
				// session_start();

				$_SESSION['auth'] = $user;

		      	$_SESSION['flash']['success'] = "Auth success !";

		      	// On rafraichi le cookie
		      	setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);

			}else {

				setcookie('remember', NULL, -1);

			}
		}else {
	
			setcookie('remember', NULL, -1);
	
		}


	}

}


// echo '<br>function.php <span class="label label-success">loaded</span>';

?>
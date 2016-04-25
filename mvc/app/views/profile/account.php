<?php include_once 'inc/header.php'; ?>  
<?php

	// Restrict to logged
	$auth = AppDB::getAuth();
	//restriction
	$auth->restrict();

	$db = AppDB::getDatabase();

	$session = Session::getInstance();

	// Pour changer le mot de passe
if (!empty($_POST)) {
	
	if (empty ($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {


		$session->setFlash("danger", "Both password wrong !");
		AppDB::redirect("../account/$user_name"); 

	}else{
		
		$user_id = $session->read('auth')->id;

		$session->setFlash('success', "Password update successfull");


		$auth->changePassword($db, $session->read('auth')->id, $_POST['password']);

		$user_name = $session->read('auth')->username;

		AppDB::redirect("../account/$user_name");

	}
	
	
	
}


?>
<div>
	<h4>sesion</h4>
	<pre><?php print_r($_SESSION)?></pre>
</div>
<div class="container">
	<h1>Votre compte</h1>
	<p>Bonjour <b><?= $session->read('auth')->username ; ?></b></p>
	<p>Email : <?= $session->read('auth')->email ; ?></p>
	<p>Nom : <?= $session->read('auth')->nom ; ?></p>
	<p>Prenom : <?= $session->read('auth')->prenom ; ?></p>

	<h3>Change password</h3>

	<form action="" method="post">

		<div class="form-group">

			<input type="password" name="password" placeholder="New password">

		</div>

		<div class="form-group">

			<input type="password" name="password_confirm" placeholder="Confirm your new password">

		</div>

		<button class="btn btn-primary">Change your password</button>

	</form>
	
	
</div>

<?php
include_once 'inc/footer.php';
?>  

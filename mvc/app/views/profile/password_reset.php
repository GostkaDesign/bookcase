<?php include_once 'inc/header.php'; ?>

<?php

if (isset($_GET['id']) && isset($_GET['token'])) {

	$db = AppDB::getDatabase();
	$auth = AppDB::getAuth();
	$session = Session::getInstance();


	$user = $auth->getUserFromUserToken($db, $_GET['id'], $_GET['token']);
	// get user from user token

	if ($user) {

		if (!empty($_POST)) {

			$validator = new Validator($_POST);
			$validator->isConfirmed('password', "Les champs ne correspondent pas");

			if ($validator->isValid()) {

				$password = $auth->hashPassword($_POST['password']);

				$db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', [$password, $_GET['id']]);

				$session->setFlash('success', "Password update successfull");
				
				$session->write('auth', $user);

				$auth->connect($user);
				
				AppDB::redirect("../account/$user->username");

			}else {
                // Rien n'est envoyé                
				$session->setFlash('danger', "Les champs ne correspondent pas");
				AppDB::redirect("../login/");
			}
		}
		
	}
	else {

		$session->setFlash('danger',  "Ce token n'est pas valide");
		AppDB::redirect("../login/");

	}
}
else {
	$session->setFlash('danger', "No account for this email");
	AppDB::redirect("../login/");
}

?> 

<div class="container">
	<h1>Reset de votre password</h1>

	<form action="" method="POST">

		<div class="form-group">
			<label for="password">New password</label>
			<input type="password" name="password" class="form-control">
		</div>

		<div class="form-group">
			<label for="password">New password confirmation</label>
			<input type="password" name="password_confirm" class="form-control">
		</div>

		<button type="submit" class="btn btn-primary">Reset your password</button>

	</form>
</div>

<?php
include_once 'inc/footer.php';
?>  


<?php include_once 'inc/header.php'; ?>

<?php

if (isset($_GET['id']) && isset($_GET['token'])) {

	require 'inc/db.php';

	$req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');

	$req->execute([$_GET['id'], $_GET['token']]);

	$user = $req->fetch();


	if ($user) {

		debug($user);

		if (!empty($_POST)) {


			if (!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']) {
				
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

				$req = $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL');

				$req->execute([$password]);

				// puis on le connect
				// session_start();

				$_SESSION['flash']['success'] = "Password update successfull";

				$_SESSION['auth'] = $user;

				header('location: ../account/');

				exit();

			}else {
				// Rien n'est envoyé				
				$_SESSION['flash']['danger'] = "Les champs ne correspondent pas";
			}
		}else {
			// Rien n'est envoyé				
			$_SESSION['flash']['danger'] = "Vous n'avez rien rempli";
		}
		
	} else {

		$_SESSION['flash']['danger'] = "Ce token n'est pas valide";

		header('location: ../login/');

		exit();
	}
} else {

	header('location: ../login/');

	exit();
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
     
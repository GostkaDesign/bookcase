<?php include_once 'inc/header.php'; ?>

<?php

$auth = AppDB::getAuth();

$db = AppDB::getDatabase();

$auth->connectFromCookie($db);

if ($auth->user()) {

	AppDB::redirect("../account/");

}

?>


<div class="container">
	<h1>Login</h1>

	<?php 

		if (!empty($_POST) &&  !empty($_POST['username']) && !empty($_POST['password'])) {
			
			$user = $auth->login($db, $_POST['username'], $_POST['password'], isset($_POST['remember']));

			$session = Session::getInstance();
			
			if ($user) {

				$session->setFlash("success", "Vous êtes maintenant connection");
				AppDB::redirect("../account/");
			}
			else {
				$session->setFlash("danger", "Login or password invalid");
				AppDB::redirect("../login/");
			}

		}

	?>

	<form action="" method="POST" class="form-horizontal">
		<legend>Connect to your account</legend>
		<div class="form-group">
			<label for="username control-label">Username or e-mail</label>
			<input type="text" name="username" class="form-control" value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>">
		</div>

		<div class="form-group">
			<label for="password control-label">Password</label>
			<input type="password" name="password" class="form-control" value="">

			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember" value="1"> Remember me
				</label>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Connect</button>

		<br>
		<br>
		<a href="../password_remember/">I forgot my password</a>

	</form>

</div>

<?php
include_once 'inc/footer.php';
?>  

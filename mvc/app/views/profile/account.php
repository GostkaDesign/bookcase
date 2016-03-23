<?php include_once 'inc/header.php'; ?>  
<?php
	// debug($_SESSION);
	is_connected();

	// Pour changer le mot de passe
	if (!empty($_POST)) {
		
		if (empty ($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

			$_SESSION['flash']['danger'] = "Both password wrong !";

		}else{

			$user_id = $_SESSION['auth']->id;

			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			require_once 'inc/db.php';

			$pdo->prepare('UPDATE users SET password = ?')->execute([$password]);

			$_SESSION['flash']['success'] = "Password update successfull";

		}
	}

?>
    <div class="container">
      <h1>Votre compte</h1>
      <p>Bonjour <b><?= $_SESSION['auth']->username ; ?></b></p>

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
     
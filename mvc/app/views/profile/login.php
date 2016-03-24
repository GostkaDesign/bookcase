<?php include_once 'inc/header.php'; ?>

<?php
	
	reconnect_from_cookie();

	if (isset($_SESSION['auth'])) {

			header('location: ../account/' . $_SESSION['auth']->username);

			exit();

		}

?>

    <div class="container">
      <h1>Connectez vous</h1>
		
		<?php
		if (!empty($_POST) &&  !empty($_POST['username']) && !empty($_POST['password'])) {

			require_once 'inc/db.php';

			$req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');

			$req->execute(['username' => $_POST['username']]);

			$user = $req->fetch();

			if ($user && password_verify($_POST['password'], $user->password) && $user) {
				
				// On stock l'utilisateur dans la variable session
		      	$_SESSION['auth'] = $user;

		      	$_SESSION['flash']['success'] = "Auth success !";

		      	//Verification si la case "se rappeler" de moi est cochée
		      	if ($_POST['remember']) {
		      		
		      		// voir plus securise
		      		$remember_token = str_random(250);
		      		
		      		// $req = $pdo->prepare('SELECT * FROM users WHERE remeber_token != NULL');
		      		$pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);

		      		// cookie qui tiendra 7 jours
		      		setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'BookCase'), time() + 60 * 60 * 24 * 7);
		      	}
		      	
		      	//Redirection vers la page profile
		      	header('location:../account/'.$user->username);

		      	exit ();

			} else {

				$_SESSION['flash']['danger'] = "Bad login or password";

				header('location:../login/');

				exit();
				
			}

		}

		?>

		<form action="" method="POST" class="form-horizontal">
			<legend>Connect to you account</legend>
			<div class="form-group">
				<label for="username control-label">Username or e-mail</label>
				<input type="text" name="username" class="form-control" value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>">
			</div>

			<div class="form-group">
				<label for="password control-label">Password</label>
				<input type="password" name="password" class="form-control" value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>">
				
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
     
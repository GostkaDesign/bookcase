<?php include_once 'inc/header.php'; ?>  

    <div class="container">
      <h1>Connectez vous</h1>
		
		<?php
		if (!empty($_POST) &&  !empty($_POST['username']) && !empty($_POST['password'])) {

			require_once 'inc/db.php';

			$req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');

			$req->execute(['username' => $_POST['username']]);

			$user = $req->fetch();

		
			if (password_verify($_POST['password'], $user->password)) {
				
				// On stock l'utilisateur dans la variable session
		      	$_SESSION['auth'] = $user;

		      	$_SESSION['flash']['success'] = "Auth success !";

		      	//Redirection vers la page profile
		      	header('location:../account/'.$user->username);

		      	exit ();

			} else {

				$_SESSION['flash']['danger'] = "Bad login or password";
				
			}

		}

		?>

		<form action="" method="POST">
      
			<div class="form-group">
				<label for="username">Username or e-mail</label>
				<input type="text" name="username" class="form-control">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control">
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
     
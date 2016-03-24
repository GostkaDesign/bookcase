<?php include_once 'inc/header.php'; ?>  

    <div class="container">
      <h1>Mot de pass oublié</h1>
		
		<?php
		if (!empty($_POST) &&  !empty($_POST['email'])) {

			require_once 'inc/db.php';

			$req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');

			$req->execute([$_POST['email']]);

			$user = $req->fetch();

		
			if ($user) {
				
				$reset_token = str_random(60);

				$pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
		      

		      	$_SESSION['flash']['success'] = "Un email vous à été envoyé par email";


		      	$to = $_POST['email'];
		        $object = 'Reinitialisation de votre mot de passe BOOKCASE';
		        $message = "<b>Afin de reinitialise votre mot de passe BOOKCASE merci de cliquer sur ce lien : </b>\n\n\r\r
		        http://localhost/gitkraken/projets/bookcase/mvc/public/profile/password_reset/?id={$user->id}&token=" . $reset_token;
		         
		        $headers  = 'From: Bookcase - votre gestionnaire de livre en ligne'."\r\n";
		        $headers .= 'Reply-To: gostka@free.fr'."\r\n";
		        $headers .= 'MIME-Version: 1.0' . "\r\n";
		        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		         
        		mail($to, $object, $message, $headers);


		      	//Redirection vers la page login
		      	header('location:../login/');

		      	exit ();

			} else {

				$_SESSION['flash']['danger'] = "No account for this email";
				
			}

		}

		?>

		<form action="" method="POST">
      
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" class="form-control">
			</div>

			<button type="submit" class="btn btn-primary">Give me a new password</button>

      	</form>
		
    </div>

<?php
  include_once 'inc/footer.php';
?>  
     
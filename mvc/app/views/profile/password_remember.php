<?php include_once '/../inc/header.php'; ?>  

    <div class="container">
      <h1>Mot de pass oublié</h1>
		
		<?php
		if (!empty($_POST) &&  !empty($_POST['email'])) {

			$db = AppDB::getDatabase();
			$auth = AppDB::getAuth();
			$session = Session::getInstance();
			
			$user = $auth->rememberPassword($db, $_POST['email']);

			if ($user) {

				$session->setFlash('success', "Un email vous à été envoyé par email");
				AppDB::redirect('../login/');

            }
            	$session->setFlash('danger', "No account for this email");

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
  include_once '/../inc/footer.php';
?>  
     
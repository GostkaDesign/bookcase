<?php include_once 'inc/header.php'; ?>  

    <div class="container">

      <?php

      $user_id = $_GET['id'];

      $user_token = $_GET['token'];

      require 'inc/db.php';

      $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');

      $req->execute([$user_id]);

      $user = $req->fetch();


      // Demarrage de la sessions
      // session_start(); // présent dans le header.php

      if ($user && $user->confirmation_token == $user_token ) {
      	

      	// Mise a jour de la date de validation
      	$pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);

		    $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
		  
        $req->execute([$user_id]);
      	
      	$user = $req->fetch();

        $_SESSION['flash']['success'] = "Votre compte a bien été validé.";

      	// On stock l'utilisateur dans la variable session
      	$_SESSION['auth'] = $user;

      	//Redirection vers la page profile
      	header('location:../account/'.$user->username);

      	// die('ok!');

      }else {

      	$_SESSION['flash']['danger'] = "Ce token n'est plus valide";

      	header('location:../login/'.$user->username);
      	// die('pas ok!');
      }

      ?>

    </div>

<?php
  include_once 'inc/footer.php';
?>  
     
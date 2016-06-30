<?php include_once '/../inc/header.php'; ?>  

<div class="container">

  <?php

      // On se connecte à la BDD
  $db = AppDB::getDatabase();
  
      // authentification
  $auth = AppDB::getAuth();
  
  if ($auth->confirm($db, $_GET['id'], $_GET['token'])){

    Session::getInstance()->setFlash("success", "Votre compte a bien été validé.");

    AppDB::redirect(WEBROOT."profile/account/");


  }else{

    Session::getInstance()->setFlash("danger", "Ce token n'est plus valide");

    AppDB::redirect(WEBROOT."profile/login/");
      	// die('pas ok!');
  }

  ?>

</div>

<?php
include_once '/../inc/footer.php';
?>  

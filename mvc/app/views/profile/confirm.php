<?php include_once 'inc/header.php'; ?>  

    <div class="container">

      <?php

      // On se connecte à la BDD
      $db = AppDB::getDatabase();
      
      // authentification
      $auth = new Auth();
    
      if ($auth->confirm($db, $_GET['id'], $_GET['token'], Session::getInstance())){

        Session::getInstance()->setFlash("success", "Votre compte a bien été validé.");

        AppDB::redirect("../account/");


      }else{

        Session::getInstance()->setFlash("danger", "Ce token n'est plus valide");

        AppDB::redirect("../login/");
      	// die('pas ok!');
      }

      ?>

    </div>

<?php
  include_once 'inc/footer.php';
?>  
     
<?php include_once 'inc/header.php'; ?>  

    <div class="container">

      <?php

      // On se connecte à la BDD
      $db = GlobalApp::getDatabase();
      
      // authentification
      $DatabaseAuth = new DatabaseAuth($db);
    
      if ($DatabaseAuth->confirm($_GET['id'], $_GET['token'], Session::getInstance())){

        Session::getInstance()->setFlash("success", "Votre compte a bien été validé.");

        GlobalApp::redirect("../account/");


      }else{

        Session::getInstance()->setFlash("danger", "Ce token n'est plus valide");

        GlobalApp::redirect("../login/");
      	// die('pas ok!');
      }

      ?>

    </div>

<?php
  include_once 'inc/footer.php';
?>  
     
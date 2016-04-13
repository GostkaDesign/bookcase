<?php include_once 'inc/header.php'; ?>  
  
<?php
    if (!empty($_POST)) { 
      

      $errors = array();

      // On se connecte à la BDD
      $db = GlobalApp::getDatabase();

      $validator = new Validator($_POST);

      // Check si le pseudo est définit et valide
      $validator->isAlpha('username', "Your username is not valid ( only special caractered '_' and '-' are available )");

      if ($validator->isvalid()) {
    
        // Check si le pseudo est libre
        $validator->isUniq('username', $db , 'users', 'This username is not available');
    
      }

      // Check de l'email
      $validator->isEmail('email', "This mail is not available");

      if ($validator->isvalid()) {
    
        // Check si l'email n'est pas déjà utilisé
        $validator->isUniq('email', $db , 'users', 'This mail is already use for other account');
    
      }


       // Check si le password est validé par le second champ
      $validator->isConfirmed('password', 'Bad confirm password, please check it');
    

      if ($validator->isvalid()) {
        
        $DatabaseAuth = new DatabaseAuth($db);

        $DatabaseAuth->register($_POST['username'], $_POST['password'], $_POST['email']);

        Session::getInstance()->setFlash("success", "Un e-mail de validation vous à été envoyé pour valider votre compte.");

        GlobalApp::redirect("../login/");
      }
      else {

        $errors = $validator->getErrors();


      }

      // debug($errors);

    }

    ?>
    <div class="container">

      <h1>S'inscrire<h1>

      <?php if (!empty($errors)): ?>

        <div class="alert alert-danger">
          <p>An error has occurred, you haven't properly completed the form</p>
            <ul>
          <?php foreach ($errors as $error): ?>
              <li><?= $error; ?></li>
          <?php endforeach; ?>
            </ul>
        </div>

      <?php endif; ?>
        
      <form action="" method="POST">
      
      <div class="form-group">
        <label for="username">User name</label>
        <input type="text" name="username" class="form-control">
      </div>

      <div class="form-group">
        <label for="email">Mail</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
      </div>

      <div class="form-group">
        <label for="password_confirm">Confirmed password</label>
        <input type="password" name="password_confirm" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">M'inscrire</button>

      </form>

    </div>

<?php
  include_once 'inc/footer.php';
?>  
     
  

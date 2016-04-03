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
        
        $options = array('cost' => 11);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

        // Création du token pour la validation
        $token = str_random(60);

        debug($token);

        // Création de l'entrée user dans la BDD
        $req = $db->query('INSERT INTO users SET username = ?, email = ?, password = ?, nom = ?, prenom = ?, confirmation_token = ?', [$_POST['username'], $_POST['email'], $password, 'test', 'test', $token]);
        // die('Votre compte à bien été créé');

        $user_id = $db->lastInsertId();
        debug($user_id);
    

        $to = $_POST['email'];
        $object = 'Confirmation de votre compte BOOKCASE';
        $message = "<b>Confirmation de votre inscrition sur BookCase</b>\n\n\r\n\n\r
        Afin de valider votre compte merci de cliquer sur ce lien : \n\n\r\r
        http://localhost/gitkraken/projets/bookcase/mvc/public/profile/confirm/?id=" . $user_id . "&token=" . $token;
         
        $headers  = 'From: Bookcase - votre gestionnaire de livre en ligne'."\r\n";
        $headers .= 'Reply-To: gostka@free.fr'."\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        mail($to, $object, $message, $headers);

        $_SESSION['flash']['success'] = "Un e-mail de validation vous à été envoyé pour valider votre compte.";

        header('location:../login/');

        exit();
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
          <p>Vous n'avez pas rempli le formulaire correctement </p>
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
     
  

<?php include_once 'inc/header.php'; ?>  


<?php 
  
  $db = GlobalApp::getDatabase();

  $user = $db->query('SELECT * FROM users')->fetchAll();

  debug($user);

  die();
  
?>

<?php
    if (!empty($_POST)) { 
      

      $errors = array();

      // connexion à la BDD
      require_once 'inc/db.php';

      // Check si le pseudo est définit et valide
      if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_POST['username'])) {
        
        $errors['username'] = "Vous n'est pas valide (alphanumerique)'";

      } else {

        $req = $pdo->prepare(' SELECT id FROM users WHERE username =?');

        $req->execute([$_POST['username']]);

        $user = $req->fetch();

        if ($user) {
          
          $errors ['username'] = 'Ce pseudo est déjà pris';

        }

      }
      

      // Check si le mail est définit et valide
      if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
       
        $errors['email'] = "votre email n'est pas valide";

      } else {

        $req = $pdo->prepare(' SELECT id FROM users WHERE email =?');

        $req->execute([$_POST['email']]);

        $user = $req->fetch();

        if ($user) {
          
          $errors ['email'] = 'Cet email est déjà utilisé pour un autre compte';

        }

      }


      if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

        $errors['password'] = "Vous devez entrer un mot de passe valide";

      }

      if (empty($errors)) {
        
        $req = $pdo->prepare("INSERT INTO users SET username = ?, email = ?, password = ?, nom = ?, prenom = ?, confirmation_token = ?");
        
        $options = array('cost' => 11);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

        // Création du token pour la validation
        $token = str_random(60);

        debug($token);

        // Création de l'entrée user dans la BDD
        $req->execute([$_POST['username'], $_POST['email'], $password, 'test', 'test', $token]);
        // die('Votre compte à bien été créé');

        $user_id = $pdo->lastInsertId();
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
     
  

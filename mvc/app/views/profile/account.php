<?php include_once 'inc/header.php'; ?>  

    <div class="container">
      <h1>Votre compte</h1>
      Bonjour <b><?= $_SESSION['auth']->username ; ?></b>

		<?php
			debug($_SESSION);

			is_connected();
		?>
	
    </div>

<?php
  include_once 'inc/footer.php';
?>  
     
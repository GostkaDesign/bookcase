<?php include_once '/../inc/header.php'; ?>

    <div class="container">

      PAGE PROFIL INDEX

<?php
	
	// Restrict to logged
	$auth = AppDB::getAuth();

	$db = AppDB::getDatabase();

	//restriction
	$auth->restrict($db, 'member');
?>
    </div>

<?php
  include_once '/../inc/footer.php';
?>  
     
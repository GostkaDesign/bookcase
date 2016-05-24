<?php include_once '/../inc/header.php'; ?>

<?php

	// Restrict to logged
	$auth = AppDB::getAuth();

	$db = AppDB::getDatabase();

	//restriction
	$auth->restrict($db, 'admin');

	$session = Session::getInstance();

?>

    <div class="container">

PAGE ADMIN


    </div>

<?php
	include_once '/../inc/footer.php';
?>
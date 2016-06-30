<?php

use \Core\Session;
use \Core\AppDB;

	// Restrict to logged
	$auth = AppDB::getAuth();

	$db = AppDB::getDatabase();

	//restriction
	$auth->restrict($db, 'admin');

	$session = Session::getInstance();

?>


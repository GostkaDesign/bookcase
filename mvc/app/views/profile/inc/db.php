<?php

try {
		$bdd_name = 	'bookcase';
		$bdd_host = 	'localhost';
		$bdd_login = 	'root';
		$bdd_password = '';

		$pdo = new PDO ('mysql:dbname=' . $bdd_name . ';host=' . $bdd_host.'', ''.$bdd_login.'' , ''.$bdd_password.'');
		// $pdo = new PDO ('mysql:host=localhost;dbname=bookcase','root','');

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}
	catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
 		}


?>
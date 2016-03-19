<?php

	// session_destroy();
	// si on detruit la session on detruira toutes les informations de la session mais peut être certains infos sont utiles
	session_start();

	unset($_SESSION['auth']);

	$_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

	header('location:../login/');
?>

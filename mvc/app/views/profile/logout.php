<?php

	// session_destroy();
	// si on detruit la session on detruira toutes les informations de la session mais peut être certains infos sont utiles
	
	session_start();

	// setcookie('remember', NULL, -1);
	if (isset($_COOKIE['remember'])) {
	var_dump($_COOKIE['remember']);
}else {
	echo 'pas de _COOKIE';
}

	unset($_SESSION['auth']);
	// session_destroy();

	$_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

	// header('location:../login/');

	exit();
?>

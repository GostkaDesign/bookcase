<?php
	
	AppDB::getAuth()->logout();
	echo 'Vous ete smaintenant déconnecté';

	Session::getInstance()->setFlash('success', "Vous êtes maintenant déconnecté");
	// $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";
	// 
	AppDB::redirect(WEBROOT."profile/login/");

?>

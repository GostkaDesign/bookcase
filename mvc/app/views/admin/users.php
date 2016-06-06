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

	<h1>GESTION DES UTILISATEURS</h1>
 <?php

// foreach ($allUser as $key) {

// 		// var_dump($key);

// 		echo "<br>"
// 		."<b>id : </b>"						.$key->id. 					"<br>"
// 		."<b>role_id : </b>"				.$key->role_id. 			"<br>"
// 		."<b>username : </b>"				.$key->username. 			"<br>"
// 		."<b>email : </b>"					.$key->email. 				"<br>"
// 		."<b>password : </b>"				.$key->password. 			"<br>"
// 		."<b>last_name : </b>"				.$key->last_name. 			"<br>"
// 		."<b>first_name : </b>"				.$key->first_name. 			"<br>"
// 		."<b>confirmation_token : </b>"		.$key->confirmation_token. 	"<br>"
// 		."<b>confirmed_at : </b>"			.$key->confirmed_at. 		"<br>"
// 		."<b>reset_token : </b>"			.$key->reset_token. 		"<br>"
// 		."<b>reset_at : </b>"				.$key->reset_at. 			"<br>"
// 		."<b>remember_token : </b>"			.$key->remember_token. 		"<br>";
// 		echo "<hr>";
	
	
// }

 	// var_dump($data);

 	// echo "<ul>";
  // 	foreach ($data->users as $user) {
 	// 	echo "<li><h3>".$user->username."</h3><br>";
 	// 	echo "<pre style='font-size:11px;'>";
 	// 	foreach ($user as $key => $value) {
		// 	echo "<b>$key</b> : $value<br>";
		// }
		// echo "</pre>";
		// echo "</li>";
		// echo "<hr>";
 	// }
 	// echo "</ul>";

 	// var_dump ($data);
 	echo $data->users;
 	// var_dump($data);
 
 	
?>





	</div>

<?php
	include_once '/../inc/footer.php';
?>
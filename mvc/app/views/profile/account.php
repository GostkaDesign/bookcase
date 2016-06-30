<?php
	use \Core\Session;
	use \Core\AppDB;

	// Restrict to logged
	$auth = AppDB::getAuth();

	$db = AppDB::getDatabase();

	//restriction
	$auth->restrict($db, 'member');

	$session = Session::getInstance();
	//update de la session
	// $session->updateSessionUser($auth);



	// Pour changer le mot de passe
if (!empty($_POST)) {
	
	if (empty ($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

		$session->setFlash("danger", "Both password wrong !");

		AppDB::redirect(WEBROOT."profile/account/$user_name"); 

	}else{
		
		$user_id = $session->read('auth')->id;

		$session->setFlash('success', "Password update successfull");

		$auth->changePassword($db, $session->read('auth')->id, $_POST['password']);

		$user_name = $session->read('auth')->username;

		AppDB::redirect(WEBROOT."profile/account/$user_name");

	}

}


?>
<div>
	<h4>sesion</h4>
	<pre><?php print_r($_SESSION)?></pre>
</div>
<div class="container">
	<h1>My account</h1>
	<p>Welcome <b><?= $session->read('auth')->username ; ?></b></p>
	<p>Level : <?= $session->read('auth')->name ; ?></p>
	<hr>
	<div class="row">

		<div class="col-lg-6">
			
			<h3>My informations</h3>
			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">Email</span>
			    <input type="text" class="form-control" placeholder="<?= $session->read('auth')->email ; ?>">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">Last name</span>
			    <input type="text" class="form-control" placeholder="<?= $session->read('auth')->last_name ; ?>">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">First name</span>
			    <input type="text" class="form-control" placeholder="<?= $session->read('auth')->first_name ; ?>">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">Facebook</span>
			    <input type="text" class="form-control" placeholder="facebook account">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">Twitter</span>
			    <input type="text" class="form-control" placeholder="twitter account">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">Instagram</span>
			    <input type="text" class="form-control" placeholder="instagram account">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

			<div class="form-group">
			  <label class="control-label"></label>
			  <div class="input-group">
			    <span class="input-group-addon">Google</span>
			    <input type="text" class="form-control" placeholder="Google+ account">
			    <span class="input-group-btn">
			      <button class="btn btn-default" type="button">Ok</button>
			    </span>
			  </div>
			</div>

		</div>

		<div class="col-lg-6">
			<h3>Change password</h3>

			<form action="" method="post">

				<div class="form-group">
					<input type="password" name="password" placeholder="New password">
				</div>

				<div class="form-group">
					<input type="password" name="password_confirm" placeholder="Confirm your new password">
				</div>

				<button class="btn btn-primary">Change your password</button>

			</form>
		</div>
	</div>

</div>

 

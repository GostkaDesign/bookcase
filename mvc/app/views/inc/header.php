<!DOCTYPE html>
<?php

use \Core\Session;
// $session = Session::getInstance();

?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Gostka Design">
    <link rel="icon" href="<?=WEBROOT;?>favicon.ico">

    <title><?=$meta_title?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=WEBROOT;?>css/themes/yeti/bootstrap.min.css" rel="stylesheet">

  </head>
  
  <body>
    
    <?php
    
    ?>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=WEBROOT;?>profile/index/">BookCase</a>
        </div>
       

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

            <li><a href="<?=WEBROOT;?>profile/index/">Index</a></li>
            
            <?php if (isset($_SESSION['auth'])): ?>
              <li><a href="<?=WEBROOT;?>profile/account/<?= $_SESSION['auth']->username; ?>">My account</a></li>
              <li><a href="<?=WEBROOT;?>profile/logout/">Logged as <b><?= $_SESSION['auth']->username; ?></b> Logout</a></li>

            <?php else: ?>         

            <li class="active"><a href="../register/">Register</a></li>

            <li><a href="<?=WEBROOT;?>profile/login/">login</a></li>
            <li><a href="<?=WEBROOT;?>profile/logout/">Logout</a></li>
          <?php endif; ?>

          </ul>
        </div><!--/.nav-collapse -->


         <!-- ADMIN NAVBAR -->
        <?php
        
        if (isset($_SESSION['auth']) && $_SESSION['auth']->name == "Administrator"){
          ?>
          <div id="navbar" class="collapse navbar-collapse" style="background-color:black;">

            <ul class="nav navbar-nav">
              <li><a href="<?=WEBROOT;?>admin/index/">Admin</a></li>
              <li><a href="<?=WEBROOT;?>admin/users/">Users</a></li>
            </ul>
          </div>
          <?php
        }
        ?>

      </div>
    </nav>

    <?php if (Session::getInstance()->hasFlashes()): ?>

        <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
        

        <div class="alert alert-<?= $type; ?>">
          
          <?= $message; ?>

        </div>          
        
        <?php endforeach; ?>

    <?php endif; ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Gostka Design">
    <link rel="icon" href="../../favicon.ico">

    <title>BookCase</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/themes/yeti/bootstrap.min.css" rel="stylesheet">

  </head>
  
  <body>
    
    <?php $session = Session::getInstance(); ?>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BookCase</a>
        </div>
       

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

            <li><a href="../index/">Index</a></li>
            
            <?php if (isset($_SESSION['auth'])): ?>
              <li><a href='../account/<?= $_SESSION['auth']->username; ?>'>My account</a></li>
              <li><a href="../login/?logout">Logged as <b><?= $_SESSION['auth']->username; ?></b> Logout</a></li>

            <?php else: ?>         

            <li class="active"><a href="../register/">Register</a></li>

            <li><a href="../login/">login</a></li>
            <li><a href="../logout/">Logout</a></li>
          <?php endif; ?>

          </ul>
        </div><!--/.nav-collapse -->


         <!-- ADMIN NAVBAR -->
        <?php
        if ($_SESSION['auth']->name == "Administrator"){
          ?>
          <div id="navbar" class="collapse navbar-collapse" style="background-color:black;">
            <ul class="nav navbar-nav">
              <li><a href='../../admin/index/'>Admin</a></li>
              <li><a href='../../admin/users/'>Users</a></li>
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
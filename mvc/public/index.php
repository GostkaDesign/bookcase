<?php
// var_dump($_SERVER);

define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('WEBAPP',str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME'].'app/'));
define('ROOT',str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME']));

// echo "<pre>WEBROOT : ".WEBROOT."</pre>";
// echo "<pre>WEBAPP : ".WEBAPP."</pre>";
// echo "<pre>ROOT : ".ROOT."</pre>";

require_once WEBAPP.'Autoloader.php';
Autoloader::register();
$app = new App;
// var_dump($app);
?>
<?php
// var_dump($_SERVER);

define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('WEBAPP',str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME'].'app'));
define('WEBCORE',str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME'].'core'));
define('ROOT',str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('WEBLAYOUT',str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME'].'layouts'));

echo "<pre>WEBROOT : ".WEBROOT."</pre>";
echo "<pre>WEBAPP : ".WEBAPP."</pre>";
echo "<pre>WECORE : ".WEBCORE."</pre>";
echo "<pre>WEBLAYOUT : ".WEBLAYOUT."</pre>";
echo "<pre>ROOT : ".ROOT."</pre>";

require_once ROOT.'Autoloader.php';
Autoloader::register();
$app = new \Core\App;
var_dump($app);
?>
<?php 

namespace Core\Config;

class Conf
{

  static $debug = 1;

  static $databases = array(

    'default' => array(
        'host' => 'localhost',
        'database' => 'bookcase',
        'login' => 'root',
        'password' => ''

    )
  );


}




?>
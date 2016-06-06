<?php 

 // namespace Core;

/**
 * summary
 */
class Config
{
    /**
     * summary
     */
    private $settings = [];

    public function __construct()
    {
       $this->$settings = require_once dirname(__DIR__) . '\config\config.php';
       // echo dirname(__DIR__) . '\config\config.php';
       // // echo __DIR__;
       // echo "<br>";
       // echo dirname(__DIR__);
    }
}
?>
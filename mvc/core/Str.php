<?php 

namespace Core;

class Str
{

    static function random($lenght){

		$alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

		return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0 , $lenght);

    }
}

?>
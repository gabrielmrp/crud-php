<?php

namespace App\Controllers;
 

function render_php($path,$args){
    ob_start();
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return $var;
}


class HomeController
{
    public function hello($params)
    {
        return "Olá {$params[1]}";
    }

    public static function render_php($path,$args)
    {
	    ob_start();
	    include($path);
	    $var=ob_get_contents(); 
	    ob_end_clean();
	    return $var;
	} 

	public static function migrate()
    {
    	$path = dirname(__DIR__, 2).'/migrate.php';
	    include($path);
	} 

}
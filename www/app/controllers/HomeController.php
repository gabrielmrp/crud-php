<?php

namespace App\Controllers;
 


class HomeController
{
    

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

	public static function populate()
    {
    	$path = dirname(__DIR__, 2).'/populate.php';
	    include($path);
	} 

	public static function start()
    {
    	HomeController::migrate();
    	HomeController::populate();
	} 

	public static function error404()
    {
    	$path = dirname(__DIR__, 2).'/404.php';
	    include($path);
	} 

	

}
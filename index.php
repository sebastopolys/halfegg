<?php
 
namespace Halfegg;
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(file_exists(__DIR__).'/config.php'){
        require_once( __DIR__.'/config.php');
    } else {
        die('<pre>ERROR: cannot load config file.</pre>');
    }

                //die('access denied');

    // Composer PSR4 Class Autoloader
    require HOMPATH.'/vendor/autoload.php';

   // Start the thing
   
   $t = new srcinit();	
   $t->public();
   
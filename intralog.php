<?php 
 
namespace Halfegg;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(file_exists(__DIR__).'/config.php'){
    require_once( __DIR__.'/config.php');
}
 
    // Composer ClassMap
    require HOMPATH.'/vendor/autoload.php';		
  
 
   // Start backend
    $t = new srcinit();	
    echo $t->admin(); 

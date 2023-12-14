<?php
namespace Halfegg;
use Halfegg\init\installer;
use Halfegg\public\log\publicLog;
use Halfegg\admin\log\adminLog;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 

class srcinit{
    public function admin(){
        $a = new adminLog();
        return $a->run_admin();
    }
    public function public(){
        
        if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
            $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: $redirect_url");
            exit();
        }
        
        $in = new installer();
        if($in->check_db()==FALSE){        
            $p = new publicLog();
            return $p->run_public();
        }
    }
}
<?php
namespace Halfegg;
use Halfegg\init\installDatabase;
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
        
        $in = new installDatabase();
        if($in->check_database()==FALSE){        
            $p = new publicLog();
            return $p->run_public();
        }
    }
}
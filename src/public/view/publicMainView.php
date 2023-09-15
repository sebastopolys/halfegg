<?php

namespace Halfegg\public\view;

use Halfegg\public\templates\publicHeader;
use Halfegg\public\templates\publicClient;
use Halfegg\public\templates\publicDebug;
use Halfegg\public\templates\uniqueFooter;

//require_once (HOMPATH.'/public/templates/header.php');
 //require_once (HOMPATH.'/public/templates/debug.php');
//r//equire_once (HOMPATH.'/public/templates/client.php');
//require_once (HOMPATH.'/public/templates/footer.php');
 
class publicMainView{

    public function print_public_view($state,$user_dat,$user_lic){  
     
        $h = new publicHeader();      
        echo $h->public_header_view(PREFIX,MAINAME,DESCR,$user_dat);

        if(DEBUG==true){
            $d = new publicDebug();
            echo $d->public_debug();      
        }
        if(isset($state)){
           $p =  new publicClient();
           echo $p->public_client_view($user_dat,$user_lic);
        }
        else{
            $p =  new publicClient();
            echo $p->public_client_view(null,null);
        }
        $f = new uniqueFooter();
        echo $f->unique_footer_view();
    }
}

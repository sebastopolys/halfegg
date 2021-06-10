<?php
require_once (HOMPATH.'/view/templates/header.php');
require_once (HOMPATH.'/view/templates/form.php');
require_once (HOMPATH.'/view/templates/debug.php');
require_once (HOMPATH.'/view/templates/client.php');
require_once (HOMPATH.'/view/templates/footer.php');
class view_main{
    public function __construct($state,$user_dat,$user_lic){  
      
        echo print_head(PREFIX,MAINAME,DESCR,$user_dat);       
        

        if(DEBUG==true){
        echo print_debug();
        }
        if(isset($state)){
            echo print_client($user_dat,$user_lic);
        }
        else{
            echo print_client(null,null);
        }
    }
}
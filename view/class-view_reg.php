<?php
require_once (HOMPATH.'/view/templates/footer.php');
require_once (HOMPATH.'/view/templates/header_register.php');
require_once (HOMPATH.'/view/templates/client_register.php');



class view_reg{
  
    public function __construct(){
   
        echo header_register(PREFIX);
        echo client_register();
    }
}
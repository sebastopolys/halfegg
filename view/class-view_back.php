<?php
require_once (HOMPATH.'/view/templates/footer.php');
require_once (HOMPATH.'/view/templates/header_register.php');
require_once (HOMPATH.'/view/templates/admin_dashboard.php');





class view_back{
    public function __construct($user_dat,$lic_dat){
        echo header_register(PREFIX);
echo intralog_dashboard($lic_dat,$user_dat);
  
           

    }
}
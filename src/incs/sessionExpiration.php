<?php
namespace Halfegg\incs;
use DateTime;
class sessionExpiration{

  public static function expire_time(){
        # Session expiration: 3600 / 1 hour
    if(!empty($_SESSION['login'])):
      $dt = new DateTime(); 
      $tmp = $dt->getTimestamp();
      $ses_tmp = $_SESSION['login']['TIMESTAMP'];  
      if($tmp >$ses_tmp+3600){    
        echo "session expired";
        unset($_SESSION['login']);
        unset($_SESSION['logout']);
        session_destroy();  
      }
    endif;
    
  }
}  
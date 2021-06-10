<?php
class expiration{
    public static function expire_time(){
        # Expiration
  if(!empty($_SESSION['login'])):
    $dt = new DateTime(); 
    $tmp = $dt->getTimestamp();
    $ses_tmp = $_SESSION['login']['TIMESTAMP'];  
    if($tmp >$ses_tmp+3600){    
      echo "sesion expired";
      unset($_SESSION['login']);
      unset($_SESSION['logout']);
      session_destroy();  
    }
  endif;
    }
}  
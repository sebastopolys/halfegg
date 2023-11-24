<?php

namespace Halfegg\incs;

//require_once (HOMPATH.'/mod/incs/class-client_login.php');

class formValidate{

    public static $_dat=NULL;

    public function validation($us_d){
 
# DB validation
        if(!empty($us_d)&&!empty($_POST['psw_f'])):        
          $user_dat= $us_d;
          # PSW validation
          if($user_dat['password']==$_POST['psw_f']): 
              # session data             
              $hs= new clientLogin;            
              $data = $hs->cl_sess_data($user_dat['id']);
                       
              # create session['login']
                
              $_SESSION['login'] = $data;              
              self::$_dat= $data;
              #  unset logout
              unset($_SESSION['logout']); 
              # return
              return self::$_dat;
          endif;
        endif;
    }
}

<?php
require_once (HOMPATH.'/mod/incs/class-client_login.php');

class form_validate{

    public $_dat=NULL;

    public function validation($us_d){
# DB validation
        if(!empty($us_d)&&!empty($_POST['psw_f'])):        
          $user_dat= $us_d;
          # PSW validation
          if($user_dat['contrasena']==$_POST['psw_f']): 
              # session data             
              $hs= new mod_cl_login;            
              $data = $hs->cl_sess_data($user_dat['id']);
                       
              # create session['login']
                
              $_SESSION['login'] = $data;              
              $this->_dat= $data;
              #  unset logout
              unset($_SESSION['logout']); 
              # return
              return $this->_dat;
          endif;
        endif;
    }
}
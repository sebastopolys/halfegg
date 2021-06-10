<?php


if(!isset($_SESSION)){
    session_start();  
  }
require_once (dirname(__DIR__).'/config.php'); 
require_once (HOMPATH.'/mod/class-mod_main.php');
require_once (HOMPATH."/log/incs/class-registration_link.php");
require_once (HOMPATH."/log/incs/class-validate_back.php");

require_once (HOMPATH."/view/class-view_reg.php");

require_once (HOMPATH."/view/class-view_back.php");

class log_back{
  function __construct(){ 
# Session isset && loged in
$rt = new mod_main;
  if($rt->_sess&&$rt->_sess['LABEL']=='logedin'):
    # get id from session hash
    
    //$g_id=str_split($rt->_sess['HASH']);

    $g_id=str_split($rt->_sess['HASH']);
    $id_l=$g_id[4];
    $get_id="";
    for ($i=0;$i<$id_l;$i++)
      {$get_id .=$g_id[$i+5];} 

    # get user && license   
    $user_dat= $rt->val_user(intval($get_id)); 
    $user_lic= $rt->val_lic($user_dat['id']);       
    # User licence exists && status is -1 (admin)
        if ($user_lic&&$user_lic!==false&&$user_lic['status']==-1):
            $all_users= $rt->val_users();
            $all_lics=$rt->val_lics();
            # display backend admin class
            $rm = new view_back($all_users,$all_lics);    
            # run $_POST validation to backend 
            new val_backend();
          else: // redirect to public loged in url
           echo '<aside> <a href="'.MANPATH.'/'.BASPATH.'"><button><<--Go Back-->></button></a></aside>LOGED IN<br/>Redirect to home page';
          endif;
  else:  // LOGED OUT   // Registration LINK is ACTIVE  
    if(isset($_GET['st'])&&!empty($_GET['st'])){
      $rel= new reg_link(); 
      # Registration link is validated with database ['hash']timestamp  
      if(isset($rel->r_link)&&!empty($rel->r_link)&&$rt->val_db_action($_GET['st'])==true): # registration link is active
        
        if(
          empty($rt->val_db_hash($_GET['st'])['name'])
          &&empty($rt->val_db_hash($_GET['st'])['contrasena'])
          ):
        
          new view_reg; # print registration form              
          self::validate_reg_form(); #~ validation
        else: 
          echo "Your account is already activated";
        endif;
      else:              
        echo '<aside> <a href="'.MANPATH.'/'.BASPATH.'"><button><<--Redirect to home page-->></button></a></aside>';
      endif;
    } 
    else{
      echo "invalid link";
    }           
    # Redirect to home page
  endif;
  }

  function validate_reg_form(){
    // validate form (!empty fields && password match)
    if(isset($_POST['log-submit'])&&!empty($_POST['name-log'])&&!empty($_POST['mail-log'])&&!empty($_POST['pass-log'])&&!empty($_POST['pass1-log'])&&$_POST['pass-log']==$_POST['pass1-log']){
        if(self::val_r_psw()==true){
          self::val_r_email();
        }
    }
  }

  private function val_r_email(){
      // validate email format
      if(filter_var($_POST['mail-log'], FILTER_VALIDATE_EMAIL)){
        // validate email in database
        $rwt = new mod_main;        
        if( $rwt->reg_user($_POST['mail-log'])==true){           
          $us_ro= $rwt->reg_user($_POST['mail-log']);
          $usdb_id= $us_ro['id'];
          $usdb_nm= $us_ro['nombre'];
          $usdb_ps= $us_ro['contrasena'];
          $usdb_hs= $us_ro['hash'];
            // name and password  are not set
            if(empty($usdb_nm)&&empty($usdb_ps)){
          
            if($_POST['mail-log']==$rwt->val_db_hash($_GET['st'])['email']){
            
                  echo "<pre>Success, email exist and validated on DB. Account is active</pre>";
                  $rwt->update_usr($_POST['name-log'],$_POST['pass-log'],$usdb_id);
            }
              
            }
        }
        else{ echo "<pre>Email is not registered in database. Cannot complete registration</pre>";
        }        
      }
      else{ echo "<pre>Invalid email formatting</pre>";
      }
  }

  private function val_r_psw(){
    if(strlen($_POST['pass-log'])>7){ 
      return true;       
    }
    else{ echo "<pre>Password length must be 8 characters at least</pre>"; return false;
    }   
  }
}
new log_back;
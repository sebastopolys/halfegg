<?php
namespace halfegg\admin\log;

use Halfegg\incs\modMain;

use Halfegg\admin\view\adminMainView;
use Halfegg\admin\view\adminViewRegistration;

use Halfegg\incs\validateAdminBackend;
use Halfegg\incs\adminRegistrationLink;

use Halfegg\admin\templates\registerSuccess;
  
class adminLog{

    /**
    *   Default Roles 
    */ 
    private static $defrols = DEFROLE;

    public function run_admin(){

        if(!isset($_SESSION)){
            session_start();  
          }
        
        $rt = new modMain;

        # LOGGED IN
        if($rt->_sess&&$rt->_sess['LABEL']=='logedin'):

            # get id from session hash
            $g_id=str_split($rt->_sess['HASH']);
            $id_l=$g_id[4];
            $get_id="";
            for ($i=0;$i<$id_l;$i++)
            {$get_id .=$g_id[$i+5];} 

            # get user && item   
            $user_dat= $rt->val_user(intval($get_id)); 
           
      
            $user_lic= $rt->val_lic($user_dat['id']);

            # User item exists && is admin
                if ($user_lic&&$user_lic!==false&&$user_lic['status']==-1):

                    $all_users= $rt->val_users();                    

                    # display backend admin class
                    $rm = new adminMainView($all_users);
             
                    # run $_POST validation to backend 
                    new validateAdminBackend();

                else: 
                  // redirect to public logged in url
                  echo '<aside> <a href="'.MANPATH.'/'.BASPATH.'"><button><<--Go Back-->></button></a></aside>LOGED IN<br/>Redirect to home page';
                endif;
        // LOGED OUT
        else:     
            // Registration LINK is ACTIVE  
            if(isset($_GET['st'])&&!empty($_GET['st'])){
                $rel= new adminRegistrationLink(); 
                # Registration link is validated with database ['hash']timestamp  
     
                if(isset($rel->r_link)
                    && !empty($rel->r_link)
                    && $rt->val_db_action($_GET['st'])==true
                ): 
     
                # registration link is active
                    if(
                        empty($rt->val_db_hash($_GET['st'])['username'])
                        && empty($rt->val_db_hash($_GET['st'])['password'])
                    ): 
                    
                        new adminViewRegistration; # print registration form              
                        self::validate_reg_form(); #~ validation
                        return;
                
                    else: 
                        echo 'Account already created<aside> <a href="'.MANPATH.'/'.BASPATH.'"><button><<--Redirect to home page-->></button></a></aside>';
                      //  header('location: '.MANPATH.'/'.BASPATH);
                      //  die();
                    endif;
                else:              
                    echo '<aside> <a href="'.MANPATH.'/'.BASPATH.'"><button><<--Redirect to home page-->></button></a></aside>';
                endif;
            } 
            else{
                echo "invalid link";
            }
        endif;
    }

    function validate_reg_form(){
        // validate form (!empty fields && password match)
        if(isset($_POST['log-submit'])&&!empty($_POST['name-log'])&&!empty($_POST['mail-log'])&&!empty($_POST['pass-log'])&&!empty($_POST['pass1-log'])&&$_POST['pass-log']==$_POST['pass1-log']){
            if(self::val_r_psw()==true){
                self::val_r_email();
                return;
            }
        }
    }

  private function val_r_email(){

    // validate email format
    if(filter_var($_POST['mail-log'], FILTER_VALIDATE_EMAIL)){
        // validate email in database
        $rwt = new modMain;        
        if( $rwt->reg_user($_POST['mail-log'])==true){           
          $us_ro= $rwt->reg_user($_POST['mail-log']);
          $usdb_id= $us_ro['id'];
          $usdb_nm= $us_ro['username'];
          $usdb_ps= $us_ro['password'];
          $usdb_hs= $us_ro['hash'];
  
            // name and password  are not set
            if(empty($usdb_nm)&&empty($usdb_ps)){

                if($_POST['mail-log']==$rwt->val_db_hash($_GET['st'])['email']){
                
                    echo "<pre>Success, email exist and validated on DB. Account is active</pre>";

                    // DEFAULT ROLES
                    $roles = serialize(self::$defrols);

                    $rwt->update_usr($_POST['name-log'],$_POST['pass-log'],$usdb_id,$roles);
                    // Redirect to home
                    header('location: '.MANPATH.'/'.BASPATH.'?msg=welcome');
                    die();
                    
                } else{
                    echo "Account created";
                }
              
            }
        }
        else{ 
            echo "<pre>Email is not registered in our Database. Cannot complete registration</pre>";
            return;
        }        
      }
      else{ 
        echo "<pre>Invalid email formatting</pre>";
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
 
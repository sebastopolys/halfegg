<?php
error_reporting(E_ALL);
# includes
require_once (HOMPATH.'/mod/incs/class-mod_db.php');

require_once (HOMPATH.'/mod/incs/class-client_login.php');
require_once (HOMPATH.'/mod/incs/class-form_validate.php');

require_once (HOMPATH.'/mod/incs/class-session_autostart.php');


// get database users table
class mod_main{
  public $_sess = NULL;
  public function __construct(){  
    # autostart 
    # database conection
    $us_c=new mod_db();   
    
    # login    
    if(# front end form validation 
      isset($_POST['user_f'])&&$_POST['user_f']
      &&isset($_POST['psw_f'])&&$_POST['psw_f']
      &&isset($_POST['submit_f'])){       
        # incs/class-mod_db.php
          // try to Get name from DB
        $us_row=$us_c->ddbb_query('*','users','nombre',$_POST["user_f"]);  
        $us_row_ps=$us_c->ddbb_query('*','users','contrasena',$_POST["psw_f"]);        

        if($us_row!==NULL&&!empty($us_row)
          &&$us_row_ps!==NULL&&!empty($us_row_ps)
          &&$us_row['nombre']==$us_row_ps['nombre']
          &&$us_row['contrasena']==$us_row_ps['contrasena'])
        {
            # incs/class-form_validate.php     
            $va = new form_validate;
            $dats = $va->validation($us_row);               
           
        } 
    }
    # logout
    elseif(isset($_POST['logout_f'])&&!isset($_SESSION['logout'])){        
      unset($_SESSION['login']); 
      # incs/class-session_autostart.php      
      session_auto_start::autostart();
     
    }  
    # Default
    else{      
        if(!empty($_SESSION['login'])){
          $_session = $_SESSION['login'];               
        }
        elseif(!empty($_SESSION['logout'])){
          $_session =  $_SESSION['logout'];  
                 
        }
        else{
          session_auto_start::autostart();
          $_session = $_SESSION['logout']; 
        }
      $this->_sess= $_session;
      return $this->_sess;
    }
  }

 
 


  public function val_user($us_id){
    $us_cl=new mod_db(); 
    $u_id = $us_cl->ddbb_query('*','users','id',$us_id);
    return $u_id;
  }

  public function  val_users(){
    $us_r=new mod_db();   
    $us_ers=$us_r->ddbb_query('*','users',null,null);
    return $us_ers;
  }

  public function reg_user($us_ml){
    $re_g=new mod_db(); 
    $reg_u=$re_g->ddbb_query('*','users','email',$us_ml);
    return $reg_u;
  }

  public function val_lic($us_ipd){
    $us_l= new mod_db;   
    $u_li = $us_l->ddbb_query('lic_id','users','id',$us_ipd);
    $l_id = $us_l->ddbb_query('*','licencias','id',$u_li[0]);
    return $l_id; 
  }

  public function val_lics(){
    $us_l=new mod_db;
    $us_ls=$us_l->ddbb_query('*','licencias',null,null);
    return $us_ls;
  }
  public function create_usr($mmll,$timestamp){
    $nw_u=new mod_db;  
    $ne_w=$nw_u->ddbb_ins($mmll,$timestamp);
    return $ne_w;
  }

  public function update_usr($nm,$ps,$id){
    $nw_a=new mod_db;  
    $n_aw=$nw_a->ddbb_upd($nm,$ps,$id);
    return $n_aw;


  }

  public function val_db_action($mome){
    $us_dh= new mod_db; 
      $us_db_hash = $us_dh->ddbb_query('hash','users','hash',$mome);    
      return $us_db_hash;
  }
  public function val_db_hash($mom){
    $us_dh= new mod_db; 
      $us_db_hash = $us_dh->ddbb_query('*','users','hash',$mom);    
      return $us_db_hash;
  }

}

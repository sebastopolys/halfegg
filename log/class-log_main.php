<?php
/*
    LOG = Controller
*/
# constants
require_once(dirname(__DIR__).'/config.php'); 
# session start
if(!isset($_SESSION)){
  session_start();  
}
# includes
require_once (HOMPATH.'/mod/class-mod_main.php');
require_once (HOMPATH.'/view/class-view-main.php');
require_once (HOMPATH.'/log/incs/class-expiration.php');

# inst validation class
$hg = new mod_main;

# get session
if($hg->_sess==true):
  # LOGED IN
  if(!empty($_SESSION['login'])):  
    // get user ID from session
    $us_dat=$hg->_sess;  
    $idf_hash=id_f_hash($us_dat['HASH']);
    $user_dat= $hg->val_user(intval($idf_hash)); 
    // get user licence
    $user_lic= $hg->val_lic($user_dat['id']); 
    # LOGED OUT
  else:
    $user_dat=NULL;
    $us_dat=NULL;
    $user_lic=NULL;
  endif;
else:
  $user_dat=NULL;
  $us_dat=NULL;
  $user_lic=NULL;
endif;

# inst view class
$hs = new view_main($hg->_sess,$user_dat,$user_lic);

expiration::expire_time();

function id_f_hash($hsh){
    $g_id=str_split($hsh);
    $id_l=$g_id[4];
    $get_id=" ";
      for ($i=0; $i < $id_l; $i++) { 
        $get_id .=$g_id[$i+5];
      }  
    return $get_id;  
  }
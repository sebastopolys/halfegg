<?php

namespace Halfegg\public\log;
use Halfegg\incs\modMain;
 use Halfegg\incs\sessionExpiration;
use Halfegg\public\view\publicMainView;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 
class publicLog{

    private static $hg = NULL;

    public function run_public(){
       /*
        LOG = Controller
        */
       
       
        # session start
        if(!isset($_SESSION)){
            session_start();  
        }
       
        # Bring Validations
        if(self::$hg===NULL){
            self::$hg = new modMain;   
        }        
     
        # get session
        if(self::$hg->_sess==true):
   
            # LOGED IN
            if(isset($_SESSION['login'])):  
                // get user ID from session               
                $idf_hash=$this->id_f_hash(self::$hg->_sess['HASH']);
                $user_dat= self::$hg->val_user(intval($idf_hash)); 

                // get user licence   
                $user_lic= self::$hg->val_lic($user_dat['id']); 
                  
            # LOGED OUT
            else:
                $user_dat=NULL;
                $us_dat=NULL;
                $user_lic=NULL; 
            endif;
        # No Session
        else:
            $user_dat=NULL;
            $us_dat=NULL;
            $user_lic=NULL; 
        endif;

        # Expiration class
        sessionExpiration::expire_time();

        #  view class instance       
        $h = new publicMainView();
        return $h->print_public_view(self::$hg->_sess,$user_dat,$user_lic);
 
        
        
    }

    private function id_f_hash($hsh){
        $g_id=str_split($hsh);
        $id_l=$g_id[4];
        $get_id=" ";
            for ($i=0; $i < $id_l; $i++) { 
                $get_id .=$g_id[$i+5];
            }  
        return $get_id;  
    }
}
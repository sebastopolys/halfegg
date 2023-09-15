<?php
namespace Halfegg\incs;
 
use DateTime;
 

class validateAdminBackend{

    public $_data = NULL;

    public function __construct(){
        // get post input in array
        if(isset($_POST['cr-users-sub'])){
            if(isset($_POST['cr-email'])){

                if(strpos($_POST['cr-email'], ",") !== false){                   
                    $emails = explode(",", $_POST['cr-email']);
                }
                else{
                    $emails =array($_POST['cr-email']);
                }
    
             self::create_register($emails);             
            }           
        } 
    }

    private function create_register($email){
   //validate array or single email        
        $pass_mail=array();
        $fail_mail=array();

            for ($gf=0; $gf < count($email); $gf++) {          
                if (filter_var($email[$gf], FILTER_VALIDATE_EMAIL)) {
                    array_push($pass_mail,$email[$gf]);
                    $res=true;               
                }
                else{
                    array_push($fail_mail,$email[$gf]);
                    $res=false;
                }
            }

            if($res==true){               
                $rm=new modMain; 
                $date = new DateTime();
//  CHECK IF EMAIL IS ALREADY REGISTERED IN DDBB  BEFORE SAVING IT !ª!!!! 

                $rm->create_usr($pass_mail,$date->getTimestamp());
                ECHO "<H4>SUCCESFULLY ADDED USERS</H4>";
                             
                echo "<h5>Registration link: ".MANPATH.'/'.BASPATH."/intralog.php?st=".$date->getTimestamp()."</h5>";
            }
            elseif($res==false){
                echo "INVALID EMAILS";
                var_dump($fail_mail);
            } 

    }
  

}
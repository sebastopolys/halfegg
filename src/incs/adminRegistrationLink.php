<?php
namespace Halfegg\incs;

use DateTime;
//use Halfegg\public\mod\modMain;
//require_once (HOMPATH.'/mod/class-mod_main.php');

class adminRegistrationLink{
    public $r_link=NULL;
    public $r_exp=NULL;

    public function __construct(){

        $dwt = new DateTime(); 
        $twp = $dwt->getTimestamp();
        $frnd=rand(0000,9999);
        $srnd=rand(000,999);

        /*                                                   *
        [0][1][2][3][4][5][6][7][8][9][0][1][2][3][4][5][6]  |
        [n][n][n][n][1][6][2][3][1][9][2][1][9][4][n][n][n]  |
        |  random(3)   |    timestamp(10)        | random(3) |
        Total= (16)                                         
        */
    
        /*
        $ret_h='?st=';
        $ret_h.=$twp;
        */
        // $ret_h.='&hs='.intval($id);

        $f_link='?st='.$frnd.$twp.$srnd;
        $set_ex=self::get_st();
        
        // EXPIRATION 3 hours

        if(intval($set_ex)+7200> $twp){
          //  echo 'Email link is active. You have 2 hours to complete registration | <br>';        
           $this->r_link=MANPATH.'/'.BASPATH.'/intralog.php'.$f_link;        

           return $this->r_link;
        }
        else{
       
            echo 'Email registration link expired. 2 hours | LINK Timestamp:'.$set_ex." ~ Current timestamp:".$twp;

           return ;
           
        }        
    }

    private function get_st(){ 

        if(isset($_GET['st'])){
        $ori=$_GET['st'];

            return $ori;
        }
        else{        
        return;
        }
    }

    private function get_hs(){   

        if(isset($_GET['hs'])){
        $ori=$_GET['hs'];
            return $ori;
        }
        else{        
        return;
        }

    }
}

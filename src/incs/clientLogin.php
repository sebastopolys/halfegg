<?php
namespace Halfegg\incs;

use DateTime;

class clientLogin{
    public static $_client = NULL;
    public function cl_sess_data($id){
        $date = new DateTime();    
        $data=array();    
         # label
         $data['LABEL']='logedin';              
         # timestamp
         $data['TIMESTAMP']=$date->getTimestamp();
        # hash
        $j='HG'.rand(11,99).strlen($id).$id;    
        $crap= 13-strlen($id);       
        for ($hh=0; $hh < $crap ; $hh++) { 
            $j.=rand(0,9);
        }
        $data['HASH']= $j;
        # return
        self::$_client = $data;        
        return self::$_client;
    }
}


#       H A S H       
#
#       0   1   2   3   4=n_i   5[0]    [1]     [2]     [3]    [4]     [5]      [6]     [7]     [8]   [9]    15     16       17       18   
#       H   F   n   n   id_l    n_i     n_i     n_i     n_i    n_i      n_i     n_i     n_i     n_i   n_i     n      n        n       n  
#
#
#       id_l = lenght of id
#       n_i = id //(length given by id_l)
#       100000000000000000
#       123456789012345678
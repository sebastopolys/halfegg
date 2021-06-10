<?php
class session_auto_start{  
    public static function autostart(){
        if(!isset($_SESSION['logout'])&&!isset($_SESSION['login'])){             
            $date = new DateTime(); 
            $data['LABEL']='logedout';
            $data['TIMESTAMP']=$date->getTimestamp();
            $data['HASH']=NULL; 
            $_SESSION['logout']=$data;       
        }
    }
}
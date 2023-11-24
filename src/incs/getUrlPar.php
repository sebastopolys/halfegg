<?php
namespace Halfegg\incs;

class getUrlPar{

    public static $par = null;


    public function __construct($par){

        if(self::$par === null){

            if(isset($_GET[$par])&&!empty($_GET[$par])){

                $par = $_GET[$par];
                $pat = '/^[0-9]+$/';               
                 
                if ( preg_match($pat, $par) && is_string($par) ) {
                    self::$par = $par;
                }

            }
            
        }

    }


    public function __destruct(){

        self::$par = null;

    }

}
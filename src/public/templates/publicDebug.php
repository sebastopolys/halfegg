<?php
namespace Halfegg\public\templates;

class publicDebug{
    function public_debug(){

        if(isset($_SESSION['login'])){
            $_session=$_SESSION['login'];  
        }
        elseif(isset($_SESSION['logout'])){
            $_session= $_SESSION['logout'];    
        }
        else{
            $_session =NULL;
        }
 
        return $this->print_pre($_session);
    }

    function print_pre($gt){
        if($gt==NULL){
            $t= 'Session is NULL';
        }
        else{
        $t = ' <h5>DEBUG ON</h5> 
        <section id="hg-debug" class="">
        <div><pre>Cookie ID: '.session_id().'</pre>
        <pre>LABEL: '.$gt['LABEL'].'</pre>
        <pre>TIMESTAMP: '.$gt['TIMESTAMP'].'</pre>
        <pre>HASH: ';
        if($gt['HASH']==null){
            $t.='undefined';
        }else{
            $t .=$gt['HASH'];
        }
        
        $t.='</pre>
        </div>
        </section>';
        }
        
        return $t;
    }
}


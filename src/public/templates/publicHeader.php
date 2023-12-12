<?php
namespace Halfegg\public\templates;
 
class publicHeader{
    function public_header_view($pref,$name,$desc,$us_dat){

        $fo = new publicForm( );
        if(isset($_SESSION['login'])){
            $_session=$_SESSION['login'];  
            $loged=true;
        }
        elseif(isset($_SESSION['logout'])){
            $_session= $_SESSION['logout'];    
            $loged=false;
        }
        else{
            $_session ='NULL';
            $loged=false;
        }

        $h= '<html>
        <head>
            <title>'.$pref.'</title>';
        
        $h .= '<meta name="robots" content="noindex,follow" />';
       
        $h.= '<script src="'.MANPATH."/".BASPATH.'/scripts/JS/publicscript.js" async="" type="text/javascript"></script>';
 
        $h.= '<link href="'.MANPATH."/".BASPATH.'/scripts/CSS/main-style1.css" rel="stylesheet">';
      
        $h.= '</head>
                    <body><div id="container">';

       
        $form = $fo->user_client_form($us_dat);
        if($loged==false):

            
            $h.=' <nav id="navigation">
            <ul><li class="nofloat"><a href=""><img src="'.MANPATH.'/'.BASPATH.'/assets/images/defaultlogo.png" width="130"/></a></li>
            <li class="float"><a href="'.MANPATH.'/'.BASPATH.'/#">Account</a></li>
            <li class="float"><a href="'.MANPATH.'/'.BASPATH.'/#">Register</a></li>    
            <li class="float"><a href="'.MANPATH.'/'.BASPATH.'">HOME</a></li>  
            </ul>
            </nav><div class="i_form">'.$form.'</div>';
        elseif($loged==true):
            $h.=' <nav  id="navigation">
            <ul><li class="nofloat"><a href=""><img src="'.MANPATH.'/'.BASPATH.'/assets/images/defaultlogo.png" width="130"/></a></li>    
            <li class="float"><a href="'.MANPATH.'/'.BASPATH.'/?pg=acc">Account</a></li>
            <li class="float"><a href="'.MANPATH.'/'.BASPATH.'?pg=dash">Dashboard</a></li>    
            <li class="float"><a href="'.MANPATH.'/'.BASPATH.'">HOME</a></li>
            </ul>
            </nav><div class="i_form">'.$form.'</div>';
        else:
        endif;
        return $h;
    }
}
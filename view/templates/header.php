<?php
require_once (HOMPATH.'/view/templates/form.php');

function print_head($pref,$name,$desc,$us_dat){


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
   $h.= '<link href="'.MANPATH."/".BASPATH.'/view/scripts/CSS/main-style1.css" rel="stylesheet">';
  
   $h.='
</head>
<body><div id="container">';

$form=print_form($us_dat);
if($loged==false):

    
    $h.=' <nav id="navigation">
    <ul><li class="nofloat"><a href="">'.$name.'</a></li>
    <li class="float"><a href="'.MANPATH.'/'.BASPATH.'/#">Account</a></li>
    <li class="float"><a href="'.MANPATH.'/'.BASPATH.'/#">Register</a></li>    
    <li class="float"><a href="'.MANPATH.'/'.BASPATH.'">HOME</a></li>  
    </ul>
    </nav><div class="i_form">'.$form.'</div>';
elseif($loged==true):
    $h.=' <nav  id="navigation">
    <ul><li class="nofloat"><a href="">'.$name.'</a></li>    
    <li class="float"><a href="'.MANPATH.'/'.BASPATH.'/?pg=acc">Account</a></li>
    <li class="float"><a href="'.MANPATH.'/'.BASPATH.'?pg=dash">Dashboard</a></li>    
    <li class="float"><a href="'.MANPATH.'/'.BASPATH.'">HOME</a></li>
    </ul>
    </nav><div class="i_form">'.$form.'</div>';
else:
endif;
return $h;
}
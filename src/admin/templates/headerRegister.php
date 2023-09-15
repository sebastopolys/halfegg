<?php
namespace Halfegg\admin\templates;

class headerRegister{

    function header_register($prf){
        $hg= '<html>
    <head>
        <title>'.$prf.'</title>
        <link rel="stylesheet" type = "text/css" href="'.MANPATH.'/'.PREFIX.'/scripts/CSS/main-style.css"/>';
        $hg.= '<script src="'.MANPATH."/".PREFIX.'/scripts/JS/adminscript.js" async></script>';
       $hg.='<script src="'.MANPATH."/".PREFIX.'/scripts/JS/adminitem.js" async></script>';
    $hg.='</head><body>';
    
    return $hg;
    }

}

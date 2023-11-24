<?php
namespace Halfegg\admin\templates;
use Halfegg\incs\getUrlPar;

class headerRegister{

    function header_register($prf,$users){

        $par = new getUrlPar('userid');

        $hg= '<!DOCTYPE html><html>
    <head>
        <title>'.$prf.'</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type = "text/css" href="'.MANPATH.'/'.PREFIX.'/scripts/CSS/main-style.css"/>';
    
        // Target User
    if($par::$par){
  
        $hg.= '<script src="'.MANPATH."/".PREFIX.'/scripts/JS/targetuser.js" async></script>';
       // $hg.= '<script src="'.MANPATH."/".PREFIX.'/scripts/JS/adminitem.js" async></script>';
        $hg.='<script src="/'.PREFIX.'/src/admin/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>';
       
    } else {
        $hg.='<script src="'.MANPATH."/".PREFIX.'/scripts/JS/adminajaxview.js" async></script>';

    }
    //   $hg.='<script src="'.MANPATH."/".PREFIX.'/scripts/JS/adminview.js" async></script>';
    
    //$hg.= '<script src="'.MANPATH."/".PREFIX.'/scripts/JS/adminscript.js" async></script>';

   
   // $hg.= '    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>';
    
       $hg.='</head><body>';
    
    return $hg;
    }

}

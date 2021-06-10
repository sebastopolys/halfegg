<?php
function header_register($prf){
    $hg= '<html>
<head>
    <title>'.$prf.'</title>
    <link rel="stylesheet" type = "text/css" href="http://localhost/QR-BAR/src/css/main.css"/>';
    $hg.= '<script src="'.MANPATH."/".BASPATH.'/view/scripts/JS/il_main.js" async></script>';
$hg.='</head><body>';
return $hg;
}
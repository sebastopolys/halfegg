<?php

namespace Halfegg\admin\log;

class createItemAjax{

    public function __construct(){
       
        echo "USER ID: ".htmlspecialchars(trim($_POST['id']));
        echo "<br/>".htmlspecialchars(trim($_POST['it-name']));
        echo "<br/>".htmlspecialchars(trim($_POST['it-descr']));
        echo "<br/>".htmlspecialchars(trim($_POST['it-cont']));

    }

}
$g = new createItemAjax();
die();
<?php

namespace Halfegg\admin\view;

use Halfegg\admin\templates\headerRegister;
use Halfegg\admin\templates\adminMainDashboard;

class adminMainView{

    public function __construct($user_dat){
        
        $he = new headerRegister();
        echo $he->header_register(PREFIX);

        $ad = new adminMainDashboard();
        echo $ad->intralog_dashboard($user_dat);

    }
}
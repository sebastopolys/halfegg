<?php

namespace Halfegg\admin\view;

use Halfegg\admin\templates\adminHeaderRegister;
use Halfegg\admin\templates\adminClientRegister;



class adminViewRegistration{
  
    public function __construct(){
   
        $dr = new adminHeaderRegister();
        echo $dr->header_register(PREFIX);

        $cl = new adminClientRegister();
        echo $cl->client_register();
    }
}
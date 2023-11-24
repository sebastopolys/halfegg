<?php
namespace Halfegg\incs;

class checkRoleCaps{

    /**
     * Role Capabilities preset
     */
    private static $_rol_caps = null;

    /**
     * Return Array with user capabilities
     */
    public $check = [];

    public function __construct($roles){

        if(self::$_rol_caps===null):

            self::$_rol_caps = require_once(dirname(__DIR__).'/mods/presets/roleCapabilities.php');

        endif;
 
        foreach (unserialize($roles) as $rol) {
            foreach (self::$_rol_caps[$rol] as $cap) {
                 if(!in_array($cap,$this->check)){
                    $this->check[] = $cap;
                }               
            }
        }
 
        return $this->check;

    }

    public function __destruct(){

        $this->check = false;
        self::$_rol_caps = [];

    }

}

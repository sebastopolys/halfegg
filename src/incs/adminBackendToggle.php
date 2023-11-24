<?php
namespace Halfegg\incs;

use Halfegg\admin\templates\adminBackendRegister;
use Halfegg\admin\templates\adminBackendUsers;
use Halfegg\admin\templates\adminBackendItems;

class adminBackendToggle{
    private $_bckpage=NULL;
    private static $_admusr = NULL;
    private static $_admreg = NULL;
    private static $_admits = NULL;

    public $_html=NULL;

    public function __construct($usrs){

        if(self::$_admusr==NULL){
            self::$_admusr = new adminBackendUsers(); 
        }
        if(self::$_admreg==NULL){
            self::$_admreg = new adminBackendRegister(); 
        }
        if(self::$_admits==NULL){
            self::$_admits = new adminBackendItems(); 
        }       
         
        
        if(isset($_GET["bkpg"])&&htmlspecialchars($_GET["bkpg"])){           
            $this->_bckpage= $_GET["bkpg"];                
        
            switch ($this->_bckpage) {
                case 'home':$this->admin_home($usrs);break;
                case 'users':$this->admin_users($usrs);break;
                case 'licences':$this->admin_licences($usrs);break;
                case 'search':$this->admin_search();break;
                case 'analitycs':$this->admin_analitycs();break;
                case 'settings':$this->admin_settings();break;
                default:$this->admin_home($usrs);break;
            }
        }

    }

    private function admin_home($usrs){
        $this->_html = self::$_admusr->back_admin_users($usrs);  
       
        // $this->_html .= self::$_admlic->back_admin_licenses();            
        return $this->_html;
    }

    private function admin_users($usrs){     
        $this->_html.= self::$_admusr->back_admin_users($usrs);      
        $this->_html .= self::$_admreg->back_admin_register($usrs,$this->_bckpage);
                       
        return $this->_html;
    }

    private function admin_licences($usrs){        
       // $this->_html = self::$_admreg->back_admin_register($usrs,$this->_bckpage);     
        $this->_html = self::$_admits->back_admin_items($usrs);   
        return $this->_html;
    }

    private function admin_search(){
        $this->_html = "Search";
        return $this->_html;
    }

    private function admin_analitycs(){
        $this->_html = "Analitycs";
        return $this->_html;
    }
    
    protected function admin_settings(){
        $this->_html = 'back_admin_settings()';       
        return $this->_html;
    }
   
}
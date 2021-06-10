<?php
require_once (HOMPATH.'/view/templates/back_admin_register.php');
require_once (HOMPATH.'/view/templates/back_admin_users.php');
require_once (HOMPATH.'/view/templates/back_admin_licenses.php');
require_once (HOMPATH.'/view/templates/back_admin_settings.php');



class back_toggle{
    private $_bckpage=NULL;
    public $_html=NULL;

    public function __construct($lics,$usrs){      
        if(isset($_GET["bkpg"])&&htmlspecialchars($_GET["bkpg"])){           
            $this->_bckpage= $_GET["bkpg"];
                        
            switch ($this->_bckpage) {
                case 'home':$this->admin_home($lics,$usrs);break;
                case 'users':$this->admin_users($lics,$usrs);break;
                case 'licences':$this->admin_licences($lics,$usrs);break;
                case 'search':$this->admin_search();break;
                case 'analitycs':$this->admin_analitycs();break;
                case 'settings':$this->admin_settings();break;
                default:$this->admin_home($lics,$usrs);break;
            }
        }  
    
    }
    private function admin_home($lics,$usrs){
        $this->_html=back_admin_users($lics,$usrs);  
        $this->_html .= back_admin_licenses($lics);            
        return $this->_html;
    }
    private function admin_users($lics,$usrs){
        $this->_html = back_admin_register($lics,$usrs,$this->_bckpage);
        $this->_html.=back_admin_users($lics,$usrs);                   
        return $this->_html;
    }
    private function admin_licences($lics,$usrs){      
        $this->_html = back_admin_register($lics,$usrs,$this->_bckpage);     
        $this->_html .= back_admin_licenses($lics);   
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
        $this->_html = back_admin_settings();       
        return $this->_html;
    }
   
}
<?php
namespace Halfegg\public\log;
 use Halfegg\incs\ajaxQueries; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class publicFormAjax {

 
    /**
     * Database Conection
     */
    private $_dbmod = NULL;
 
   
    /**
     * Database Prefix
     */
    private static $_prefx = NULL;

    /**
     * Model File
     */
    private static $_currmod = 'defaultProfile.php';

    
    public function __construct(){
       
        $this->initialize();
       
        // Get User 
        $user =$this->_dbmod->ddbb_get_data('*',self::$_prefx.'_users','id',htmlspecialchars(trim($_POST['userid'])));
        
         
      

        #~ MODE
        // include the user mod file
        $mod= include_once(dirname(dirname(__DIR__)).'/mods/presets/'.self::$_currmod);

     
        
        // get mod labels
        $modlabels = [];
        foreach ($mod as $fk => $reg) {
            array_push($modlabels,$reg[0]);             
         }            
     

        #~ USER META
        // get user meta id's relation
        $rels = $this->_dbmod->ddbb_relation('meta_id',self::$_prefx.'_user_meta_rel',['user_id'=>htmlspecialchars(trim($_POST['userid'])),'type'=>'profile']);
        
        // get user meta label
        $meta = $this->get_user_meta($rels  );

        // Get meta labels
        $metalabs = [];
        foreach ($meta as $ky => $vu) {
            array_push($metalabs,$vu['label']);
        }
        
        // unexistent database meta user registers
        $newreg = array_diff($modlabels,$metalabs );

        // Insert Missing user meta
        if($newreg){
            $usid = htmlspecialchars(trim($_POST['userid']));
            for ($ii=0; $ii < count($modlabels); $ii++) {            
                if(in_array($modlabels[$ii],$newreg)){
                    $this->_dbmod->ddbb_insert(self::$_prefx.'_users_meta',[[$modlabels[$ii],htmlspecialchars(trim($_POST[$modlabels[$ii]]))]],$usid);
                }             
            }
        }

        // UPDATE
        foreach ($meta as $ix => $lab) {
            if(!empty(htmlspecialchars(trim($_POST[$lab['label']])))
                &&$lab['value']!== htmlspecialchars(trim($_POST[$lab['label']]))) {               
                    $this->_dbmod->ddbb_update(self::$_prefx.'_users_meta',
                    htmlspecialchars(trim($_POST[$lab['label']])),
                    $lab['id']);
            }
        }         
    }

    private function get_user_meta($rels ){
        $meta =[];
        if($rels){
            $dummy = '';           
            foreach ($rels as $key => $value) { 
                $dummy = $this->_dbmod->ddbb_get_data('*',self::$_prefx.'_users_meta', 'id', $value[0]); 
                if($dummy){
                    array_push($meta,[    
                                'id'=>$dummy['id'],
                                'label'=>$dummy['label'],
                                'value'=>$dummy['value']
                            ]);
                }
            }
        }
        return $meta;
    }   

    private function initialize(){
         
        if($this->_dbmod===NULL){
            include(dirname(dirname(__DIR__)).'/incs/ajaxQueries.php'); 
            $this->_dbmod = new ajaxQueries();
        }

        if(self::$_prefx===NULL){
          //  include(dirname(dirname(dirname(__DIR__))).'/config.php');
            self::$_prefx = SHPRFIX;
        }
        
    }

    public function __destruct(){
        die();
    }
}

$t = new publicFormAjax();
 
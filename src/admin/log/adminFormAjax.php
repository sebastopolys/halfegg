<?php
namespace Halfegg\admin\log;

use Halfegg\incs\ajaxQueries; 
 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class adminFormAjax{

    private $_dbmod = NULL;
    private $_usmod = NULL;
    private $_prefx = NULL;
    private static $_optab = 'halfegg_options';
    private static $_preset = 'defaultProfile.php';
 
   
   

    public function __construct($dir){
         
        $this->initialize();        

         #~ USER META
        // get user meta id's relation
        $rels = $this->_dbmod->ddbb_relation('meta_id',$this->_prefx.'_user_meta_rel',['user_id'=>htmlspecialchars(trim($_POST['id']))]);
        
        // get user meta 
        $meta = $this->get_user_meta($rels  );

        if(NULL==$meta)die("No profile information");

        // Get meta labels
        $metalabs = [];
        $strig = '';        
        foreach ($meta as $ky => $vu) {
            $strig .=$vu['label'];
            array_push($metalabs,[$vu['label']=>$vu['value']]);
        }

        // PRINT PROFILE
                            echo "<pre>";
                            print_r($metalabs);
                            echo "</pre>";
        #~ USER ITEM
        // get user item id relation
        $usrel = $this->_dbmod->ddbb_relation(  
                            'item_id',
                            $this->_prefx.'_user_item_rel',
                            ['user_id'=>intval(htmlspecialchars(trim($_POST['id'])))]
                        );

        // get item
        if($usrel){

            $item = $this->_dbmod->ddbb_get_data('*',$this->_prefx.'_items','id',$usrel[0]['item_id']);

            // PRINT ITEM        
            var_dump($item);
        } else {
            echo "There is no item created for this user";
            
        }
        

    }

    private function get_user_meta($rels ){
        $meta =[];
        if($rels){
            $dummy = '';           
            foreach ($rels as $key => $value) { 
                $dummy = $this->_dbmod->ddbb_get_data('*',$this->_prefx.'_users_meta', 'id', $value[0]); 
                if($dummy){
                    array_push($meta,[    
                                'id'=>$dummy['id'],
                                'label'=>$dummy['label'],
                                'value'=>$dummy['value']
                            ]);
                }
            }
        } else {
            $meta = null;
        }
        return $meta;
    }   


    private function initialize(){

        include(dirname(dirname(__DIR__)).'/incs/ajaxQueries.php');                 
       
        if($this->_dbmod===NULL){
           $this->_dbmod = new ajaxQueries();           
        }
        if(self::$_preset===NULL){
            self::$_preset = include(dirname(dirname(__DIR__)).'/mods/presets/'.self::$_preset);               
        }
        if($this->_prefx===NULL){
            $this->_prefx = $this->_dbmod->ddbb_get_data('value',self::$_optab,'label','baspath')['value'];
        }
               
    }

    public function __destruct(){
        die();
    }

}

$x = new adminFormAjax(__DIR__);
die();
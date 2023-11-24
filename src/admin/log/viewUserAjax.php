<?php

namespace Halfegg\admin\log;
use Halfegg\incs\ajaxQueries;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class viewUserAjax{

    private static $_dbquers = null;
    private static $_preset = 'defaultProfile.php';
    private static $_prefx = null;
   // private static $_optab = 'rafstd_options';
    
    public function __construct(){

        // Valid request
        if (htmlspecialchars(trim($_POST['id']))) {
            $id = htmlspecialchars(trim($_POST['id']));
            $this->initialize();            
            header('Content-Type: application/json');
            $response = array(
                'success' => true,
                'message' => 'ID recibido correctamente: ' . $id,
            );

            #~  PROFILE
            // Get this user id Meta
            $users_meta = self::$_dbquers->ddbb_relation('meta_id',self::$_prefx.'_user_meta_rel',['user_id'=>$id,'type'=>'profile']);
            
            // Print the profile
         
           echo ('<a href="?userid='.$id.'" target="_blank" id="edit_user" userid="'.$id.'">edit</a>' 
                    . $this->printProfile($this->get_user_meta($users_meta)));
       

            #~ ITEM
            // Get this user Item rel
            $users_item = self::$_dbquers->ddbb_relation('item_id',self::$_prefx.'_user_item_rel',['user_id'=>$id,'type'=>'item']);
            
            // initialize output
            $print_item = '';
            
            // if item exists
            if($users_item){
                
                // get item
                $item = self::$_dbquers->ddbb_get_data('*',self::$_prefx.'_items','id',$users_item[0]['item_id']);
                
                // fill the output with item 
                $print_item = $this->printItem($item);
            
                // no item exists for this user
            } else {
                echo "noitem";
                // fill the output with message
                $print_item = 'There is no item for this user';
            
            }
            
            // Print the output
          //  echo self::$_prefx;
       echo ('<div>'.$print_item.'</div>');

      // echo json_encode($response);
        
            // Not valid request
        } else {

            $response = array(
                'success' => false,
                'message' => 'No valid ID provided in the request',
            );
            
        // echo json_encode($response);
        
        }

       
        die();
    }

    private function get_user_meta($rels ){
        $meta =[];
        if($rels){
            $dummy = '';           
            foreach ($rels as $key => $value) { 
                $dummy = self::$_dbquers->ddbb_get_data('*',self::$_prefx.'_users_meta', 'id', $value[0]); 
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

    private  function printProfile($meta){
        $returnme = '';
        if($meta){
            $returnme .= '<table>';
            foreach ($meta as $key => $value) {
            $returnme .= '<tr><td>'.$value['label'].':</td><td>'.$value['value'].'</td></tr>';
            }
            $returnme .= '</table>';
       } else {
        $returnme .= 'There is no Profile for this user';
       }
        return $returnme;
    }

    private function printItem($item){
        if($item){
            return '<h1>'.$item['name'].'</h1><h2>'.$item['description'].'</h2>'.htmlspecialchars_decode($item['content']);
        } else {
            return 'There is no item for this user';
        }
    }

    private function initialize(){

        include(dirname(dirname(__DIR__)).'/incs/ajaxQueries.php');

        if(self::$_dbquers===NULL){
            self::$_dbquers = new ajaxQueries();           
         }
         if(self::$_preset===NULL){
             self::$_preset = include(dirname(dirname(__DIR__)).'/mods/presets/'.self::$_preset);               
         }

         if(self::$_prefx===NULL){
            self::$_prefx = SHPRFIX;
           // self::$_prefx = self::$_dbquers->ddbb_get_data('value', self::$_optab,'label','shprfix')['value'];
        }
    
    }
     
}

new viewUserAjax();
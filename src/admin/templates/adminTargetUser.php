<?php
namespace Halfegg\admin\templates;

use Halfegg\incs\modMain;
use Halfegg\mods\useThisMod;
use Halfegg\incs\modDatabase; 


class adminTargetUser{

    private static $modddbb = null;

    private static $thismod = null;

    private static $database = null;



    public function __construct(){
        if(self::$modddbb===null){
            self::$modddbb = new modMain();
        }
        if(self::$database===null){
            self::$database = new modDatabase();
        } 
        
    }

    public function targetUser($user){
         
        $user_dat= self::$modddbb->val_user($user); 
        
        if(self::$thismod===null){
            self::$thismod = new useThisMod($user_dat);
        }

        
                     

        $cd =  '<div id="ajax_response"></div>';

        #~ PROFILE
        if(null == self::$thismod->printProfile('admin') ){
            $cd .= '<form id="edit_profile_f" enctype="multipart/form-data">';
            $cd .= '<h3>Create Profile for this user</h3>';
            
            $cd .= self::$thismod->createUserMeta()[1];

        } else {           
            
           
          
            $cd .= '<form id="edit_profile_f" enctype="multipart/form-data">';
            $cd .= '<h3>Profile for this user</h3>';
            $cd .=self::$thismod->printProfile('admin');
        }

         #~ ITEM
            // Get this user Item rel
            $users_item = self::$database->ddbb_relation('item_id',SHPRFIX.'_user_item_rel',['user_id'=>$user_dat['id'],'type'=>'item']);
            
            // initialize output
            $print_item = '';
            
            // if item exists
            if($users_item){
                $item = self::$database->ddbb_query('*',ITEMTB,'id',$users_item[0]['item_id']);
                $cd .= '<h3>ITEM of this user:</h3>';
                $cd .= $this->print_item_form($user_dat['id'],$item);
            } else {
                $cd .= '<h3>Create Item for this user</h3>';
                $cd .= $this->print_item_form($user_dat['id'],null);
            }

        return $cd;
    }


    private function print_item_form($id,$item){
       // print_R($item);
        if($item!==null){
            $title = $item['name'];
            $description = $item['description'];
            $html = htmlspecialchars_decode($item['content']);
        } else {
            $title = $description = $html = '';
        }
         
        $hu = '<div id="newitemform">
                <form id="newitem" enctype="multipart/form-data">';

        $hu .= '<span id="item-title" class="item-tinymce">    
                    <label for="it-name">Title</label>
                    <input id="it-name" type="text" name="it-name" value="'.$title.'"/>
                </span>';

        $hu .= '<span id="item-desc" class="item-tinymce">
                    <label for="it-descr">Description</label>                    
                    <input type="text" id="it-descr" name="it-descr" value="'.$description.'"/>
                </span>';            
        $hu .=  '<span id="item-editor" class="item-tinymce"> 
                <textarea id="it-cont" name="it-cont" row="20" cols="33">'. $html .'</textarea>
                </span>';
        $hu .= '<input id="user_id" name="user_id" type="hidden" value="'.$id.'"/>';
        $hu .= '</form></div>';  
        return $hu;
        
    }

    
}
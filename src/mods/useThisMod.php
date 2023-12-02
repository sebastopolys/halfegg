<?php
namespace Halfegg\mods;

use Halfegg\incs\modMain;

class useThisMod{

    /**
     * User Id
     */
    public static $_usid = NULL;

    /**
     * User Role
     */
    private static $_usrol = NULL;

    /**
     * Database Conection
     */
    private static $_dbmod = NULL;

    /**
     * Mod Preset
     */   
    private static $_mod = NULL;    
    
     

    /**
     * Open form
     */
    private static $_openform = NULL;

    /**
     * User data
     */
    private static $_userdata = NULL;

     

    public function __construct($user_id){
         
        if(self::$_usid===NULL){
            self::$_usid = $user_id['id'];              
        }   
            
        if(self::$_usrol===NULL){
            self::$_usrol = $user_id['role'];
        }
      

        if(self::$_dbmod===NULL){
            self::$_dbmod = new modMain();
        }
        if(self::$_mod===NULL){
             self::$_mod = require_once('presets/'.CURRMOD);   
                   
        }
        if(self::$_openform===NULL){
            self::$_openform =  
                      '<input id="userid" name="userid" type="hidden" value="'.$user_id['id'].'"/>
                      <a href="#" value="edit" id="edit_pr" class="profile-butt" name="edit-profile">edit</a>                        
                     <a href="#" value="save" id="save_pr" class="profile-butt" name="save-profile">save</a>
                     <a href="#" value="cancel" id="cancel_pr" class="profile-butt" name="cancel-profile">cancel</a>
                    ';
        }
        
        if(self::$_userdata===NULL){
            self::$_userdata = '<p>User ID: '.$user_id['id'].'</p>
                     <p>User name: '.$user_id['username'].'</p>
                     <p>email: '.$user_id['email'].'</p>';
        }
     
    }

    public function printProfile($role){
       
        // get user meta 
        if(self::$_dbmod){
            //  get meta user data from database
            $result =  self::$_dbmod->get_relations('meta_id',USMTRL,['user_id'=>self::$_usid,'type'=>'profile']);
            
            if(!$result){return null;}
         //   if($role!=='view'&&$role!=='edit'){return null;}

            // get array of data ($return)
            $return = [];
            foreach ($result as $k => $v) {
                $return[$v['label']]=$v['value'];                
            }
            
            // no meta user data
            if(!$return){return null;}
            
            // default avatar
            if(array_key_exists('gender',$return)){
                $image= '<div><img src="'.MANPATH.'/'.BASPATH.'/assets/images/'.$this->profileImage($return['gender']) .'"></div>';
            } else {
                $image= '<div><img src="'.MANPATH.'/'.BASPATH.'/assets/images/'.$this->profileImage('X') .'"></div>';
            }

            // inputs
            
            $output = '';
            
            if( (is_string($role)&&$role=='admin')
                || (is_array($role)&&in_array('can_edit_profile',$role))){
            
                
                 $output .= self::$_openform;
            }  
             
           // $output = '';     
            foreach (self::$_mod as $k => $v) {  
                // no database register for this label
                $output .= '<p><span class="profile-label">'.$v[1].': </span>';
                if(empty($return[$v[0]])){
                    
                        $output .= '<span id="pr_dat_'.$v[0].'" class="prof-data">This meta is not registered</span>';
                        $output .= $this->profileInputs($v[2],$v[0],null,$v[3]);

                } else {
                    
                        $output.= '<span id="pr_dat_'.$v[0].'" class="prof-data">'.$return[$v[0]].'</span>';                    
                        $output .= $this->profileInputs($v[2],$v[0],$return[$v[0]],$v[3]) ;                   

                }
                
            }      

            $output .= '</form>';

            return [$image,$output];

        }

        return null;

    }

    public function createUserMeta(){

        $img= '<div><img src="'.MANPATH.'/'.BASPATH.'/assets/images/defaultfemale.png"></div>';
      $out = self::$_openform;      
        // $output = '';     
         foreach (self::$_mod as $k => $v) {  
               
                 $out.= '<p><span class="create-profile">'.$v[1].': </span>'.$this->profileInputs($v[2],$v[0],'',$v[3]).'</p>';
             
         }          
         $out .= '</form>';
         return [$img,$out];
    }

    public function profileImage($gend){
        
            if($gend=='M'){
                $ret = 'defaultmale.png';
            } else {
                $ret = 'defaultfemale.png';
            }
 
        return $ret;

    }

    private function profileInputs($type,$name,$placeholder,$options){

        $pr_inp = '<span class="profile-input">';

        if($type==='text'||$type==='number'||$type==='date'){
            $pr_inp .= '<input type="'.$type.'" name="'.$name.'" id="pr_input_'.$name.'" value="'.$placeholder.'" placeholder="'.$placeholder.'">';
        }

        if($type==='radio'&&$options!==NULL&&is_array($options)){
            $o=0;
           
            foreach ($options as $option) {
                if($placeholder==$option){$select = 'checked=""';} else{$select='';}
                $pr_inp .= '<input type="'.$type.'"'.$select.' name="'.$name.'" value="'.$option.'" id="inp-'.$name.'_'.$o.'" class="pr_input_'.$name.'"><label for="inp-'.$name.'_'.$o.'">'.$option.'</label>';
                $o++;
            }
            if(empty($placeholder)){$selected = 'checked=""';} else{$selected='';}
            $pr_inp .= '<input id="default-radio-button" type="'.$type.'"'.$selected.' name="'.$name.'" value="UN" id="inp-'.$name.'_'.$o.'" class="pr_input_'.$name.'">';

            $options = [];
        }

        if($type==='select'&&$options!==NULL&&is_array($options)){
            $pr_inp .= '<select name="'.$name.'" id="inp-'.$name.'" class="pr_input_'.$name.'">';
            foreach ($options as $option) {
                $pr_inp .= '<option  value="'.$option.'"';
                if($option==$placeholder){
                    $pr_inp .=' selected '; 
                }
                $pr_inp .= '>'.$option.'</option>';
            }
            $pr_inp .='</select>';
            $options = [];
        }

        return $pr_inp.'</span></p>';
    }

    public function printItem( ){
 
        $item = self::$_dbmod->get_relations('item_id', USITRL, ['user_id'=>self::$_usid,'type'=>'item']);
       
        $cn = '';
        if($item){
            $cn .= '<h3>'.$item[0]['name'].'</h3>';
            $cn .= '<h5>'.$item[0]['description'].'</h5>';
            //var_dump($item[0]);
            $cn .= htmlspecialchars_decode($item[0]['content']);
        }
        return $cn;
    }

    
}

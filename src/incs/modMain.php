<?php
namespace Halfegg\incs;

class modMain{
    public $_sess = NULL;
    private static $_mod = NULL;
    
    public function __construct(){  
        # autostart 
        # database conection
        if(self::$_mod==NULL){
        self::$_mod = new modDatabase();
        }
        //$us_c=new modDatabase();   
        
        # login    
        if(# front end form validation 
        isset($_POST['user_f'])&&$_POST['user_f']
        &&isset($_POST['psw_f'])&&$_POST['psw_f']
        &&isset($_POST['submit_f'])){       
            # incs/class-mod_db.php
            // try to Get name from DB
            $us_row=self::$_mod->ddbb_query('*',USERTB,'username',$_POST["user_f"]);  
            $us_row_ps=self::$_mod->ddbb_query('*',USERTB,'password',$_POST["psw_f"]);        

            if($us_row!==NULL&&!empty($us_row)
            &&$us_row_ps!==NULL&&!empty($us_row_ps)
            &&$us_row['username']==$us_row_ps['username']
            &&$us_row['password']==$us_row_ps['password'])
            {
                # incs/class-form_validate.php     
                $va = new formValidate;
                $this->_sess = $va->validation($us_row);               
            
            } 
        }
        # logout
        elseif(isset($_POST['logout_f'])&&!isset($_SESSION['logout'])){        
            unset($_SESSION['login']); 
            # incs/class-session_autostart.php      
            sessionAutoStart::autostart();
        
        }  
        # Default
        else{      
            if(!empty($_SESSION['login'])){
            $_session = $_SESSION['login'];               
            }
            elseif(!empty($_SESSION['logout'])){
            $_session =  $_SESSION['logout'];  
                    
            }
            else{
            sessionAutoStart::autostart();
            $_session = $_SESSION['logout']; 
            }
        $this->_sess= $_session;
        return $this->_sess;
        }
        return $this->_sess;
    }

    


    public function val_user($us_id){
    
        $u_id = self::$_mod->ddbb_query('*',USERTB,'id',$us_id);
        return $u_id;
    }

    public function  val_users(){

        $us_ers=self::$_mod->pag_ddbb_query('*',USERTB,0,3);

        $users = [];
        
        for ($i=0; $i < count($us_ers); $i++) { 
           $users[$i] =$this->val_user($us_ers[$i]);           
        }           
       
        return $users;
         
    }

     

    public function reg_user($us_ml){

        $reg_u=self::$_mod->ddbb_query('*',USERTB,'email',$us_ml);
        return $reg_u;
    }

    public function val_lic($us_ipd){
  
        // search relation
        $u_li = self::$_mod->ddbb_query('item_id',USITRL,'user_id',$us_ipd); 
        if($u_li){
            // get ITEM
            $l_id = self::$_mod->ddbb_query('*',ITEMTB,'id',$u_li['item_id']);
            return $l_id; 
        }
        
        return;
    }

    public function val_lics(){

        $us_ls=self::$_mod->ddbb_query('*',ITEMTB,null,null);
        return $us_ls;
    }
    public function create_usr($mmll,$timestamp){

        $ne_w=self::$_mod->ddbb_ins($mmll,$timestamp);
        return $ne_w;
    }

    public function get_relations($target, $tab, $were){
        $gt_rrl = self::$_mod->ddbb_relation($target,$tab,$were);
        if(is_array($gt_rrl)){
            $return_rels = [];
            if($tab==USMTRL){$newtab = MTUSTB;}
            foreach ($gt_rrl as $key => $value) {
                
                array_push($return_rels,self::$_mod->ddbb_query('*',$newtab,'id',$value['meta_id']));
            }
        }
        
        return $return_rels;
       
    }

    public function update_usr($nm,$ps,$id){

        $n_aw=self::$_mod->ddbb_upd($nm,$ps,$id);
        return $n_aw;


    }

    public function val_db_action($mome){

        $us_db_hash = self::$_mod->ddbb_query('hash',USERTB,'hash',$mome);    
        return $us_db_hash;
    }
    public function val_db_hash($mom){

        $us_db_hash = self::$_mod->ddbb_query('*',USERTB,'hash',$mom);    
        return $us_db_hash;
    }
}
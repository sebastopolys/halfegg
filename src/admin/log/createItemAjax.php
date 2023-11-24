<?php

namespace Halfegg\admin\log;
use Halfegg\incs\ajaxQueries;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class createItemAjax{

    private $_ajxqueries = NULL;
    private static $_prefix = null;
    

    public function __construct(){
       
        $this->initialize();
       
        $usid = htmlspecialchars(trim($_POST['user_id']));       
        $name = htmlspecialchars(trim($_POST['it-name']));
        $desc = htmlspecialchars(trim($_POST['it-descr']));
        $cont = htmlspecialchars(trim($_POST['it-cont']));
      //  echo $usid . $name.' - '.$desc.' - '.$cont;

      // check if an item exist for this user    
        $item = $this->_ajxqueries->ddbb_relation('item_id',self::$_prefix.'_user_item_rel',['user_id'=>$usid,'type'=>'item']);
        
        if($item==null){
            // insert item
            $id = $this->_ajxqueries->insert_item([$name,'item',null,$desc,$cont,0]);

            $this->_ajxqueries->insert_item_relation(self::$_prefix.'_user_item_rel','item',$usid,$id);
        } else {
            echo "EXISTENT ITEM.";
            $item_id = $item[0]['item_id'];
            echo "UPDATE";
            $data = ['name'=>$name,'desc'=>$desc,'cont'=>$cont];
            $this->_ajxqueries->update_user_item($data,self::$_prefix.'_items',$item_id);
        }
       
    }

    private function initialize(){
      
        if(include(dirname(dirname(__DIR__)).'/incs/ajaxQueries.php')){
             
        }
        
        if($this->_ajxqueries===NULL){
            $this->_ajxqueries = new ajaxQueries();
        }
        if(self::$_prefix===NULL){
            self::$_prefix = SHPRFIX;
           
        }
        
    }

}
$g = new createItemAjax();
die();
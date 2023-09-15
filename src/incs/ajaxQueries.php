<?php
namespace Halfegg\incs;

use PDO;

class ajaxQueries{

    public $_conn = NULL;
    private $returned = NULL;

    // CONECTION
    public function __construct(){
  
        try {
			$dsn = "mysql:host=localhost;dbname=halfegg";
			$dbh = new PDO($dsn, 'root',''); // user & pasword
         
		} catch (PDOException $poet){
			$poet->getMessage();
        }
        if($dbh!==NULL&&$this->_conn==NULL){
            $this->_conn=$dbh;
            return $this->_conn;
        }
    }

    # # # # # # # # # # - - - > QUERY < - - -  # # # # # # # # # # # # # #

    public function ddbb_get_data($tr,$tb,$pt,$qr){   
         
            $see = "SELECT $tr FROM $tb WHERE $pt LIKE '$qr';";  
            return $this->query_build_x($see);
          
    }
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

    # # # # # # # # # # - - - > UPDATE USER META < - - -  # # # # # # # # # # # # # #

    public function ddbb_update($tab,$val,$id){   
        $intid = intval($id);
        $data = [':val'=>$val,':id'=>$id];
       
        $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $sep="UPDATE `$tab` SET `value`= :val WHERE `$tab`.id= :id";
            $qq = $this->_conn->prepare($sep);
            $qq->execute($data);         
        }
        catch(PDOException $e) {  
            echo "PDO Error: " .$e->getMessage(). "</br>";
        }        
    }

    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

     # # # # # # # # # # - - - > INSERT USER  META < - - -  # # # # # # # # # # # # # #

     public function ddbb_insert($tab, $data, $usid){  
       
          
       // insert META
       
       
    
            $sql = "INSERT into `$tab` (label,`value`,last_action,created_at) values (?,?,CURRENT_DATE(),CURRENT_DATE())";

            $stmt = $this->_conn->prepare($sql);

            // get relations
            $rel = $this->ddbb_relation('meta_id','halfegg_user_meta_rel',['type'=>'profile', 'user_id'=>$usid]);
            $rels = [];
            foreach ($rel as $metaid) {
                array_push($rels,$metaid['meta_id']);
            }
           var_dump($rels );echo "--";

            // INSERT META
            $op=0;
            foreach($data as $row) {
                
                // check meta data            
                if($this->ddbb_relation('label','halfegg_users_meta',['id'=>$rels[$op]])){
                    $check = $this->ddbb_relation('label','halfegg_users_meta',['id'=>$rels[$op]]);
                } else {
                    $check = false;
                }
                
                  //  echo "<br/>ROW: ".$row[0];
                   // echo "CHECK: ".$check[0]['label'];
                    
                    $stmt->execute($row);
                
                    $id = $this->_conn->lastInsertId();
                    $this->insert_relation('halfegg_user_meta_rel','profile',$usid,$id);
                          
              
                $op++;
            }         
    }
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

    # # # # # # # # # # - - - > INSERT   USER - META   RELATIONS  < - - -  # # # # # # # # # # # # # #

    private function insert_relation($tab, $type, $usid, $id){
       
        // insert META
        $row = [$type,$usid,$id];
        $sql = "insert into `$tab` (type,user_id,meta_id) values (?,?,?)";
 
        $st = $this->_conn->prepare($sql);

    
             $st->execute($row);
           
       

    }
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #



    # # # # # # # # # # - - - > GET RELATIONS  < - - -  # # # # # # # # # # # # # #
    public function ddbb_relation($tr,$tb,$were){
        $condition = [];
        $parameter = [];
        foreach ($were as $key => $value) {
            $condition[] = $key.' LIKE ?';
            $parameter[] = '%'.$value.'%';
        }
        // the main query
        $see = "SELECT $tr FROM $tb";

        // a smart code to add all conditions, if any
        if ($condition)
        {
            $see .= " WHERE ".implode(" AND ", $condition);
        }
        $stmt = $this->_conn->prepare($see);
        $stmt->execute($parameter);
        $data = $stmt->fetchAll();
        return $data;
    }
    # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
 

    #  Build Single Query 
    public function query_s($quer){
        $q = $this->_conn->prepare($quer);
            $q->execute();
            $this->returned=$q->fetch(PDO::FETCH_ASSOC);
            return $this->returned;
    }

    public function query_build_x($quer){
        $q = $this->_conn->prepare($quer);
            $q->execute();
            $this->returned=$q->fetch();
            return $this->returned;
    }

     // CLOSE CONECTION
     public function __destruct(){
        $this->_conn = NULL;
    }
}
<?php
class mod_db{    //https://www.php.net/manual/en/pdo.prepared-statements.php
// CONSTANTS
    private $_name= NAMBDAT;
    private $_host= HOSBDAT;
    private $_conn= NULL;
    private $returned = NULL;
// CONECTION
    public function __construct(){
        try {
			$dsn = "mysql:host=$this->_host;dbname=$this->_name";
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

public function ddbb_query($tr,$tb,$pt,$qr){   
    if($pt==NULL&&$qr==NULL):
        $see = "SELECT $tr FROM $tb;";
        return self::query_build_a($see);         
    else:
        $see = "SELECT $tr FROM $tb WHERE $pt LIKE '$qr';";  
        return self::query_build_s($see);
    endif;        
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # - - - > INSERT USER  < - - -  # # # # # # # # # # # # # #

public function ddbb_ins($mail,$tmp){  
    $hash=0;
    for ($tr=0; $tr < count($mail); $tr++) { 
        $hash=rand(100010001000,999999999999);
        $mms=$mail[$tr];
        $see="INSERT INTO `users` (`id`, `lic_id`, `nombre`, `email`, `contrasena`, `role`, `last_action`, `hash`) VALUES (NULL, '0', '', '$mms', '', '0', CURRENT_TIME(), '$tmp') ";
        self::query_build_s($see);  
    }
     
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # - - - > UPDATE USER  < - - -  # # # # # # # # # # # # # #
public function ddbb_upd($nm,$ps,$id){    
        
        $see="UPDATE `users` SET `nombre`='$nm',`contrasena`='$ps' WHERE `users`.`id` = '$id'; ";
        self::query_build_s($see);  
  
     
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #



# Build Query all  
    public function query_build_a($quer){
        if($this->_conn!==NULL):
            $stmt = $this->_conn->prepare($quer);	
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();	
            $user_db=array();		
            while ($row = $stmt->fetch()){
                array_push($user_db,$row);						
            }
            $this->returned=$user_db;     
            # return  value      
            return $this->returned;
        else:
            # return  value NULL 
            $this->returned = NULL;
            return $this->returned;
        endif;
    }  
#  Build Single Query 
    public function query_build_s($quer){
        $q = $this->_conn->prepare($quer);
            $q->execute();
            $this->returned=$q->fetch();
            return $this->returned;
    }
// CLOSE CONECTION
    public function __destruct(){
        $dbh = NULL;
    }
// END CLASS
}



#################################################################################################



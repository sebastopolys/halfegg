<?php
namespace Halfegg\incs;
use PDO;
use DateTime;


class modDatabase{    //https://www.php.net/manual/en/pdo.prepared-statements.php
// CONSTANTS
    private $_name= NAMBDAT;
    private $_host= HOSBDAT;
  
    private $_conn= NULL;
    private $returned = NULL;
// CONECTION
    public function __construct(){
        try {
			$dsn = "mysql:host=$this->_host;dbname=$this->_name";
			$dbh = new PDO($dsn, DBUSER,DBPASS ); // user & pasword
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
    if($pt===NULL&&$qr===NULL):
        $see = "SELECT $tr FROM $tb;";
        return self::query_build_a($see);         
    else:
        $see = "SELECT $tr FROM $tb WHERE $pt LIKE '$qr';";  
        return self::query_build_s($see);
    endif;        
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # #     P A G I N A T I O N   Q U E R Y    # # # # # # #

public function pag_ddbb_query($tr,$tb,$offset,$limit){
    $see = "SELECT $tr FROM $tb LIMIT $offset,$limit;";
    return self::query_build_a($see);  
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



# # # # # # # # # # - - - > INSERT USER  < - - -  # # # # # # # # # # # # # #

public function ddbb_ins($mail,$tmp){  
    $hash=0;
    $tab =USERTB;
   
    for ($tr=0; $tr < count($mail); $tr++) { 
        $hash=rand(100010001000,999999999999);
        $mms=$mail[$tr];
        $see="INSERT INTO `$tab` (`id`, `username`, `email`, `password`, `role`, `hash`, `last_action`, `created_at` ) 
        VALUES (NULL, NULL, '$mms', NULL, '0', '$tmp', CURRENT_DATE(), CURRENT_DATE()) ";
        self::query_build_s($see);  
    }
     
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # - - - > UPDATE USER  < - - -  # # # # # # # # # # # # # #
public function ddbb_upd($nm,$ps,$id,$roles){    
    $tab =USERTB;
        $see="UPDATE `$tab` SET `username`='$nm',`password`='$ps',`role`='$roles' WHERE `$tab`.`id` = '$id'; ";
        self::query_build_s($see);  
  
     
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #



# Build Query all  
    public function query_build_a($quer){
        if($this->_conn!==NULL):
          
            $stmt = $this->_conn->prepare($quer);	

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user_db=array();
             


            	
            while ($row = $stmt->fetch()){
                array_push($user_db,$row['id']);						
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



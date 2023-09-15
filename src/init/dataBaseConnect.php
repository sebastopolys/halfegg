<?php
namespace Halfegg\init;
use PDO;
class dataBaseConnect{

        // CONSTANTS
        private $_name= NAMBDAT;
        private $_host= HOSBDAT;
        protected static $_conn= NULL;
    
        
    // CONECTION
    public function __construct(){
        try {			
			$dbh = new PDO("mysql:host=$this->_host","root","" ); // user & pasword
		} catch (PDOException $poet){
			$poet->getMessage();
        }
        
        if($dbh!==NULL&&self::$_conn==NULL){
            
            self::$_conn=$dbh;

        }
        
    }
 

    
}

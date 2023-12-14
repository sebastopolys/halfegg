<?php
namespace Halfegg\init;
use PDO;
class dataBaseConnect{

        // CONSTANTS
        private static $_name= NAMBDAT;
        private static $_host= HOSBDAT;
        private static $_dbus = DBUSER;
        // CONECTION
        protected static $_conn= NULL;


    protected function __construct(){
        $dbhs = self::$_host;
        try {			
			$dbh = new PDO("mysql:host=$dbhs",DBUSER,DBPASS ); 
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		} catch (PDOException $poet){
             
			$poet->getMessage();
        }
        
        if($dbh!==NULL&&self::$_conn==NULL){
            
            self::$_conn=$dbh;

        }
        
    }
    
    protected function pori(){

        $dbnm = self::$_name;
        $dbhs = self::$_host;
        $dbus = self::$_dbus;
        self::$_conn=NULL;
        try {
			$dsn = "mysql:host=$dbhs;dbname=$dbnm";
			$dbh = new PDO($dsn, $dbus,DBPASS );
		} 
        catch (PDOException $poet){
             
			  $poet->getMessage();
        }
         
        if($dbh!==NULL&&self::$_conn==NULL){
            
            self::$_conn=$dbh;

        }
        
    }

    

    public function __destruct(){
        self::$_conn == NULL;
    }
 
  

    
}

 
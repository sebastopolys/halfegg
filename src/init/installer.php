<?php
namespace Halfegg\init;
use PDO;

class installer extends dataBaseConnect{


    private static $dbname = NAMBDAT;  

    protected static $tables = [USERTB,ITEMTB,OPTSTB,MTUSTB,MTITTB,USITRL,USMTRL,ITMTRL];

   
 
    public function __construct(){
         
         new dataBaseConnect();        
      
    }
 
    public function check_db(){

        // TRUE:   Installer on
        // FALSE:    Installer off

        $dbname = self::$dbname;
        $ustab = self::$tables[0];
        $optab = self::$tables[2];      

        $see = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
        
        $saa = "SHOW TABLES LIKE '{$ustab}'";

        $checkDb = parent::$_conn->query($see)->fetchColumn();

        #~ Check if database exists
            if(!$checkDb){
                
                    echo $this->installerDash('in_db');
                            
                    return TRUE;

                }
        
        parent::$_conn = null;
        parent::pori();
            
        #~ Check if user table has been installed
            if(!parent::$_conn->query($saa)->fetchColumn()){  

                $ct = new createTables();
                $cr_tabs = $ct->installTables();
                
                    if($cr_tabs==1){

                        echo $this->installerDash('succ');
                    } else {
                        echo $this->installerDash('in_tb');
                    }
                                
                return TRUE;

            }
  
        return FALSE;        
      
    }

    private function installerDash($label){

        $ot = '<p><br/><hr/>To avoid unexpected errors please ensure that installation procedure has been completed before initializing database</p><hr/>';
        
        if(isset($_POST['cancel_ddbb'])){
            $ot .= '<h3><pre>Aborted</pre></h3>';
            
            return $ot;
        }
        if($label=='in_db'){
            $ot .= '<p><pre>There is no database for this domain<br/>Create a database and reload.</pre></p>';
        
        }

        if($label=='in_tb'){
            $ot .= '<h3><pre>Initialize Database</pre></h3> 
                    <p><pre>8 tables will be created in <b><i>'.self::$dbname.'</i></b> database</pre></p>
                    <p><pre>Are you sure ?</pre><p>
                    <form method="post">
                        <input type="submit" value="INSTALL" name="inst_ddbb">
                        <input type="submit" value="CANCEL" name="cancel_ddbb">
                    </form>';
             if(isset($_POST['cancel_ddbb'])){
                $ot .= 'Come back later';
            }
        }

        if($label=='succ'){
            $ot .= '<h3><pre>Installation completed</pre></h3> <p><pre>Please reload page</pre></p>';
        
        }
   
        return $ot;

    }
   
}

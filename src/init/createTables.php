<?php 
namespace Halfegg\init;

class createTables extends dataBaseConnect{

    private static $dbname = NAMBDAT;
    private static $tables = [USERTB,ITEMTB,OPTSTB,MTUSTB,MTITTB,USITRL,USMTRL,ITMTRL];
 
 
    public function __construct(){

        new dataBaseConnect();
        
    }

    public function installTables( ){

        $dbname = self::$dbname;
                   
            if(isset($_POST['inst_ddbb'])){

                $this->create_tables($dbname,self::$tables);  
                $this->insertOptions();
                return TRUE;

            } else {

                return FALSE;

            }

    }

    # create tables
    private function create_tables($dbname,$tables){
    
        #~ USERS
        $stats = ['CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[0].'( 
            id INT AUTO_INCREMENT,
            username VARCHAR(100) NULL, 
            email VARCHAR(50) NULL, 
            password VARCHAR(100) NULL,
            role VARCHAR(100) NULL,           
            hash VARCHAR(100) NULL,
            last_action DATE,
            created_at DATE,
            PRIMARY KEY(id)
        );',
        #~ ITEMS
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[1].'( 
            id INT AUTO_INCREMENT,            
            name VARCHAR(100) NULL, 
            type VARCHAR(150) NULL,
            has_child VARCHAR(150) NULL,
            description VARCHAR(500) NULL,
            content VARCHAR(5000) NULL,
            status VARCHAR(300) NULL,
            last_action DATE,
            created_at DATE,
     
            PRIMARY KEY(id)
        );',
        #~ OPTIONS
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[2].'( 
            id INT AUTO_INCREMENT,
            label VARCHAR(50) NOT NULL, 
            value VARCHAR(100) NULL,
            last_action DATE,
            created_at DATE,
 
            PRIMARY KEY(id)
        );',
        #~ META_USERS
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[3].'( 
            id INT AUTO_INCREMENT,            
            label VARCHAR(50) NOT NULL,            
            value VARCHAR(2500) NULL,            
            last_action DATE,
            created_at DATE,
            PRIMARY KEY(id)
        );',
        #~ META_ITEMS
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[4].'( 
            id INT AUTO_INCREMENT,            
            label VARCHAR(50) NOT NULL,            
            value VARCHAR(2500) NULL,            
            last_action DATE,
            created_at DATE,
            PRIMARY KEY(id)
        );',
        #~ USER - ITEMS RELATION
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[5].'( 
            id INT AUTO_INCREMENT,
            type VARCHAR(20),     
            user_id INT(10),
            item_id INT(10),
            CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES '.$tables[0].'(id) ON DELETE CASCADE,
            CONSTRAINT fk_item FOREIGN KEY(item_id) REFERENCES '.$tables[1].'(id) ON DELETE CASCADE,
                
            PRIMARY KEY(id)
        );',
        #~ USER - META_USER RELATION
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[6].'( 
            id INT AUTO_INCREMENT,
            type VARCHAR(20), 
            user_id INT(10),
            meta_id INT(10),
            CONSTRAINT fk_muser FOREIGN KEY(user_id) REFERENCES '.$tables[0].'(id) ON DELETE CASCADE,
            CONSTRAINT fk_metauser FOREIGN KEY(meta_id) REFERENCES '.$tables[3].'(id) ON DELETE CASCADE,
                      
            PRIMARY KEY(id)
        );',
        #~ ITEMS - META_ITEMS RELATION
        'CREATE TABLE IF NOT EXISTS '.$dbname.'.'.$tables[7].'( 
            id INT AUTO_INCREMENT,
            type VARCHAR(20),
            item_id INT(10),
            meta_id INT(10),
            CONSTRAINT fk_mitem FOREIGN KEY(item_id) REFERENCES '.$tables[1].'(id) ON DELETE CASCADE,
            CONSTRAINT fk_metaitem FOREIGN KEY(meta_id) REFERENCES '.$tables[4].'(id) ON DELETE CASCADE,
            
            PRIMARY KEY(id)
        );'];
     
        foreach ($stats as $stat) {
            parent::$_conn->exec($stat );
        }       
        return;
    }

        # Insert constants in options table

        public function insertOptions(){

            $tab = OPTSTB;
    
            $data = [
                ['abspath',ABSPATH ],
                ['hompath',HOMPATH ],
                ['baspath',BASPATH ],
                ['manpath',MANPATH ],
                ['prefix',PREFIX],
                ['shprfix',SHPRFIX],
                ['currmod',CURRMOD],
                ['installer',1]
            ];
     
            $dbname = self::$dbname;
            $soo="INSERT INTO $dbname.`$tab` (`label`, `value`,`last_action`,`created_at` ) 
            VALUES (?,?,CURRENT_DATE(),CURRENT_DATE()) ";
    
            $stmt = parent::$_conn->prepare($soo);
    
            foreach ($data as $row) {            
               $stmt->execute($row);  
            }  
    
        }
    
   

    # CLOSE CONECTION
    public function __destruct(){

        $dbh = NULL;

    }

}

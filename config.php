<?php

require_once __DIR__ . '/vendor/autoload.php'; // Ruta al autoload de la librería Dotenv

use Dotenv\Dotenv;


 // Load Env file
 $dotenvPath = dirname(dirname(dirname(__DIR__)));
 
 $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
 $dotenv->load($dotenvPath);
 define('NAMBDAT', $_ENV['NAMBDAT']);  
 define('HOSBDAT',$_ENV['HOSBDAT']);
 define('DBUSER',$_ENV['DBUSER']);
 define('DBPASS',$_ENV['DBPASS']);
 define('DBVERS',$_ENV['DBVERS']);
 define('MANPATH','http://'.HOSBDAT);
 

 
# STRINGS
    // Project name
    define('MAINAME','Promedic');
    // project domain (required)
    define('PREFIX','promedic');
    // project prefix (required)
    define('SHPRFIX','prmdc');
    // database prefix
    define('DBPRFX',SHPRFIX.'_');
    // project description
    define('DESCR','A customer Portal');
    // project version
    define('VERSION','0.0.7');
    
# Database TABLES (don't edit)
    #~ users
    define('USERTB',DBPRFX.'users');
    #~ items
    define('ITEMTB',DBPRFX.'items');
    #~ options
    define('OPTSTB',DBPRFX.'options');
    #~ users meta
    define('MTUSTB',DBPRFX.'users_meta');
    #~ items meta
    define('MTITTB',DBPRFX.'items_meta');
    #~ user items relation
    define('USITRL',DBPRFX.'user_item_rel');
    #~ user user_meta relation
    define('USMTRL',DBPRFX.'user_meta_rel');
    #~ item item_meta relation
    define('ITMTRL',DBPRFX.'item_meta_rel');

# PATHS (don't edit)
    define('ABSPATH',dirname(__DIR__));
    define('HOMPATH',__DIR__);
    define('FILPATH',__FILE__);
    define('BASPATH',basename(HOMPATH));
    
    define('REGPATH','link.php');
    define('BACTIT','Backend dashboard'); 
    define('REGTIT','Registration Form');

# MOD
    define('CURRMOD','defaultProfile.php');
    define('DEFROLE',[1,3,8]);

# DEBUG
    define('DEBUG',false); 
 
 
 
 
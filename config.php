<?php

# STRINGS
    define('MAINAME','Halfegg 1');
    define('PREFIX','halfegg1');
    define('SHPRFIX','hlfg1');
    define('DESCR','A customer Portal');
    define('VERSION','0.0.5');

# Database
    #~  Name
    define('NAMBDAT','halfegg1');
    #~ prefix
    define('DBPRFX',SHPRFIX.'_');
    #~ host
    define('HOSBDAT','localhost');
    #~ user
    define('DBUSER','root');
    #~ user password
    define('DBPASS','');
    #~ version
    define('DBVERS','0.0.2');

# TABLES
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

# PATHS
    define('ABSPATH',dirname(__DIR__));
    define('HOMPATH',__DIR__);
    define('FILPATH',__FILE__);
    define('BASPATH',basename(HOMPATH));
    define('MANPATH','http://'.HOSBDAT);
    define('REGPATH','link.php');
    define('BACTIT','Backend dashboard'); 
    define('REGTIT','Registration Form');

# MOD
    define('CURRMOD','defaultProfile.php');
    define('DEFROLE',[1,3,8]);

# DEBUG
    define('DEBUG',false); 
 
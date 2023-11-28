<?php
 

# STRINGS
    // Project name
    define('MAINAME','Acquarium');
    // project domain (required)
    define('PREFIX','acquarium');
    // project prefix (required)
    define('SHPRFIX','acqrum');
    // project description
    define('DESCR','A customer Portal');
    // project version
    define('VERSION','0.0.7');
   
# Database
    #~  Name (required) 
    define('NAMBDAT','acqua');
    #~ prefix (don't edit)
    define('DBPRFX',SHPRFIX.'_');
    #~ host 
    define('HOSBDAT','localhost');
    #~ user (required)
    define('DBUSER','root');
    #~ user password (required)
    define('DBPASS','');
    #~ version
    define('DBVERS','0.0.2');

# TABLES (don't edit)
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
    define('MANPATH','http://'.HOSBDAT);
    define('REGPATH','link.php');
    define('BACTIT','Backend dashboard'); 
    define('REGTIT','Registration Form');

# MOD
    define('CURRMOD','defaultProfile.php');
    define('DEFROLE',[1,3,8]);

# DEBUG
    define('DEBUG',false); 
 
#~ ENV 


<?php
    //error_reporting(E_ALL | E_STRICT);
    session_start();
// SYSTEM CONFIGURATION //
    define('DIR_PATH', 'RoyalWebStructure/');
    define('CORE_PATH', __DIR__.'/');
    define('SYS_PROJECT', $_GET['sysProject']);
    define('SYS_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.DIR_PATH.SYS_PROJECT.'/');
    define('SYS_URL', 'http://'.$_SERVER['SERVER_NAME'].'/'.DIR_PATH);
    if(!is_dir(SYS_PATH)){
        session_destroy();
        die();
    }
// DATABASE CONFIGURATION //
    $_db_idx = 'sys';
    $_db = array(
        'sys' => array(
            'HOST_DB' => 'royalweb.com.mx',
            'USER_DB' => 'royalweb_rw',
            'PASSWORD_DB' => 'RoyalWeb',
            'DATABASE_DB' => 'royalweb_structure'
        ),
        'localhost' => array(
            'HOST_DB' => 'localhost',
            'USER_DB' => 'root',
            'PASSWORD_DB' => '',
            'DATABASE_DB' => 'royalweb_structure'
        )
    );
    define('HOST_DB', $_db[$_db_idx]['HOST_DB']);
    define('USER_DB', $_db[$_db_idx]['USER_DB']);
    define('PASSWORD_DB', $_db[$_db_idx]['PASSWORD_DB']);
    define('DATABASE_DB', $_db[$_db_idx]['DATABASE_DB']);
// CORE CONFIGURATION //
    define('DEBUG', TRUE);
    if(!isset($_SESSION['sysRequireView'])){
        $_SESSION['sysRequireView'] = TRUE;
    }
?>
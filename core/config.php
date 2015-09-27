<?php
    //error_reporting(E_ALL);
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
    define('HOST_DB', $_db['localhost']['HOST_DB']);
    define('USER_DB', $_db['localhost']['USER_DB']);
    define('PASSWORD_DB', $_db['localhost']['PASSWORD_DB']);
    define('DATABASE_DB', $_db['localhost']['DATABASE_DB']);
// CORE CONFIGURATION //
    define('DEBUG', TRUE);
    if(!isset($_SESSION['sysRequireView'])){
        $_SESSION['sysRequireView'] = TRUE;
    }
?>
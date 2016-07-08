<?php
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    ini_set('memory_limit', '-1');
    ini_set('date.timezone','America/Mexico_City');
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    session_start();
// SYSTEM CONFIGURATION //
    $_GET['sysProject'] = isset($_GET['sysProject']) ? $_GET['sysProject'] : '';
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
    $_db_idx = 'localhost';
    $_db = array(
        'sys' => array(
            'HOST_DB' => 'royalweb.com.mx',
            'USER_DB' => 'royalweb_rw',
            'PASSWORD_DB' => 'RoyalWeb',
            'DATABASE_DB' => 'royalweb_pruebas_gya'
        ),
        'localhost' => array(
            'HOST_DB' => '192.168.1.76',
            'USER_DB' => 'rwroot',
            'PASSWORD_DB' => '/*royalweb*/',
            'DATABASE_DB' => 'royalweb_test_gya'
        ),
        'test' => array(
            'HOST_DB' => 'royalweb.com.mx',
            'USER_DB' => 'royalweb_rw',
            'PASSWORD_DB' => 'RoyalWeb',
            'DATABASE_DB' => 'royalweb_test_gya'
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
// CUSTOM CONFIG //
    define('TARIFA_PORCENTAJE_1', 0.0045);
    define('TARIFA_PORCENTAJE_2', 0.00225);
?>

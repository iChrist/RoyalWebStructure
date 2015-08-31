<?php
    require_once ('config.php');
    $_SESSION['allow'] = 0;
    unset($_SESSION['allow']);
    if(session_start()){
        session_destroy();
    }
    header('Location: '.SYS_URL);
?>
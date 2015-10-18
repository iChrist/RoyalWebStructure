<?php
    require_once ('config.php');
    if(session_start()){
        session_destroy();
    }
    header('Location: '.SYS_URL);
?>
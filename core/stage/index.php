<?php
    require_once("../config.php");
    require_once(CORE_PATH."model/core.model.php");
    require_once(CORE_PATH."model/core.php.functions.php");
    $core = new Core_Model(); 
    $core->index();
?>
<?php
    require_once("../config.php");
    require_once(CORE_PATH."model/core.functions.php");
    require_once(CORE_PATH."model/core.model.php");
    $core = new Core_Model(); 
    $core->index();
?>
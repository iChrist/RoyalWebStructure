<?php
    require_once("../config.php");
    require_once(CORE_PATH."assets/plugins/jquery-file-upload/server/php/UploadHandler.php");
    //require_once(CORE_PATH."assets/PHPExcel/Classes/PHPExcel/IOFactory.php");
    require_once(CORE_PATH."model/core.functions.php");
    require_once(CORE_PATH."model/core.model.php");
    require_once(CORE_PATH."model/dashboard.model.php");
    $dash = new darshboard_model();
    $core = new Core_Model();
    $core->index();


?>

<?php
	require_once("../config.php");
	require_once("../model/mysql.model.php");
	require_once("../model/core.model.php");
	require_once("../model/funtions.model.php");
	$core = new Core_Model(); 
	$core->index();
?>
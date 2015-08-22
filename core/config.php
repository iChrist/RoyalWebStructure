<?php
	session_start();
// SYSTEM CONFIGURATION //
	define("CORE_PATH" 		,	__DIR__."/");
	define("DIR_PATH" 		, 	"RoyalWebStructure");
	define("SYS_PROJECT" 	, 	$_GET["sysProject"]);
	define("SYS_PATH" 		, 	$_SERVER["DOCUMENT_ROOT"]."/".DIR_PATH."/".$_GET["sysProject"]."/");
	if(!is_dir(SYS_PATH)){
		session_destroy();
		die();
	}
// DATABASE CONFIGURATION //
	$db = array(
		"sys"	=>	array(
			"HOST_DB"		=>	"royalweb.com.mx",
			"USER_DB"		=>	"royalweb_rw",
			"PASSWORD_DB"	=>	"RoyalWeb",
			"DATABASE_DB"	=>	"royalweb_structure",
		),
		"sys2"	=>	array(
			"HOST_DB"		=>	"royalweb.com.mx",
			"USER_DB"		=>	"royalweb_rw",
			"PASSWORD_DB"	=>	"RoyalWeb",
			"DATABASE_DB"	=>	"royalweb_structure",
		),
	);
	define("HOST_DB" 		, 	$db[SYS_PROJECT]["HOST_DB"]);
	define("USER_DB" 		, 	$db[SYS_PROJECT]["USER_DB"]);
	define("PASSWORD_DB" 	, 	$db[SYS_PROJECT]["PASSWORD_DB"]);
	define("DATABASE_DB" 	, 	$db[SYS_PROJECT]["DATABASE_DB"]);
// CORE CONFIGURATION //
	define("DEBUG", TRUE);
	if(!isset($_SESSION["sysRequireView"])){
		$_SESSION["sysRequireView"] = TRUE;
	}
?>
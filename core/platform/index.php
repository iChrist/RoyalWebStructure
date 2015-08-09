<?php
	require_once("../config.php");
	require_once("../model/core.model.php");
	require_once("../model/funtions.model.php");
	require_once("header.php");
?>
 <!DOCTYPE html>
<html>
	<head>
		<title>RW</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<h3>platform/index.php</h3>
		<?php
			$core = new Core_Model(); 
			$core->index();
		?>
	</body>
</html> 
<?php
	require_once("footer.php");
?>
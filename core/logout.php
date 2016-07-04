<?php
    require_once ('config.php');
	if(isset($_SESSION)){
		session_destroy();
	}
    header('Location: '.SYS_URL);
?>
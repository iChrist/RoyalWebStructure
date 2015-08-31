<?php
	$_SESSION['allow'] = 0;
	session_destroy();
    header('Location: sys');
?>
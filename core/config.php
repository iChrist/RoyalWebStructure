<?php
echo "config.php<br>";
//$cxsis=mysqli_connect("www.royalweb.com.mx","userstr","USER.WWW.2015") or die("No se puede conectar al Servidor".mysqli_connect_error());
$cxsis=mysqli_connect("royalweb.com.mx","royalweb_rw","RoyalWeb") or die("No se puede conectar al Servidor");
$bdsis=mysqli_select_db($cxsis, "royalweb_structure") or die("No se encuentra la Base de Datos");



// CONFIGURACIÓN DE BASE DE DATOS //
		$host_db = "royalweb.com.mx"; 
		$user_db = "royalweb_rw";
		$password_db = "RoyalWeb"; 
		$database_db = "royalweb_structure";
		require_once("model/mysql.model.php");
		require_once("model/core.model.php");
?>
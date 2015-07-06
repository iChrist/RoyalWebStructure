<?
//$cxsis=mysqli_connect("www.royalweb.com.mx","userstr","USER.WWW.2015") or die("No se puede conectar al Servidor".mysqli_connect_error());
$cxsis=mysqli_connect("royalweb.com.mx","royalweb_rw","RoyalWeb") or die("No se puede conectar al Servidor");
$bdsis=mysqli_select_db($cxsis, "royalweb_structure") or die("No se encuentra la Base de Datos");
?>
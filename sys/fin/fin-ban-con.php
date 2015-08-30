<?php
	while($row= $data['infoEdicion']["EdicionEntidad"]->fetch_assoc()){
		echo "<hr><pre>".print_r($row,1)."</pre><hr>";
	}
	while($row= $data['infoEdicion']["EdicionDomicilio"]->fetch_assoc()){
		echo "<hr><pre>".print_r($row,1)."</pre><hr>";
	}

	//$rEntidad= $data['comboEntidades']->fetch_assoc();
	//$data['comboEntidades'];
?>

<form action="" method="post">
	<input type="text" name="nombre" value= '<?=$rEntidad{'sPkModule'}?>'>
	<input type="hidden" name="axn" value="getEntidades">
	<input type="submit" value="Enviar">
</form>
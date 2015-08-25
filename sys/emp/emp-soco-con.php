<?php
	echo "<hr><pre>".print_r($data,1)."</pre><hr>";
	while($row= $data['modulos']->fetch_assoc()){
		echo $row['sPkModule']."<br>";
		
		
	}
	?>
	<hr>
	<?php
	while($row= $data['empresas']->fetch_assoc()){
		echo $row['sPkModule']."<br>";
		
		
	}
?>
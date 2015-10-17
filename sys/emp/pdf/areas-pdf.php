<?php
    if(isset($data['datos']) && $data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<style type="text/css">
table{
    width:  100%;
}
th{
    text-align: center;
}
td{
width:  50%;
    text-align: left;
font-size: 12px;
    word-wrap: break-word;
}
span{
	text-align: left;
font-size: 12px;
    word-wrap: break-word;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <page_header>
        <table style="width: 100%;">
            <tr>
            	<td style="text-align: left; width: 85%">
                    <!--<img src="<?php echo SYS_URL; ?>RoyalWeb-Black.png" style="width:170px;height:50px;" alt="RoyalWeb">!-->
                    <span style="font-size: 12px; font-weight: bold;text-align:center;">RoyalWeb</span>
		</td>
                <td style="text-align: right; width: 15%;"><?php echo date('d/m/Y'); ?></td>
            </tr>
        </table>
	<hr>
    </page_header>
    <page_footer>
	<hr>
        <table style="width: 100%;">
            <tr>
            	<td style="text-align: left;    width: 85%">RoyalWeb</td>
                <td style="text-align: right;    width: 15%;">P&aacute;gina [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <br><br><br><br>
<span style="font-size: 16px; font-weight: bold;text-align:center;">DETALLE AREAS</span>
<br><br>
	<table>
<tr>
  <td><strong>Nombre: </strong></td>
</tr>
<tr>
<td><?php echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : ''; ?></td>
</tr>

<tr>
  <td><strong>Título: </strong></td>
</tr>
<tr>
<td><?php echo (isset($result['sTitulo'])) ? utf8_encode($result['sTitulo']) : ''; ?></td>
</tr>
 
<tr>
  <td><strong>Estatus: </strong></td>
</tr>
<tr>
<td><?php echo isset($result['skStatus']) ? $result['htmlStatus'] : '' ; ?></td>
</tr>

</table>


</page>

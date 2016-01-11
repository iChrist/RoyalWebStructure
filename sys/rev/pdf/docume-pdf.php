<?php
    $result = $data['datos'];
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
            	<td style="text-align: left; width: 70%">
                    <!--<img src="<?php echo SYS_URL; ?>core/assets/img/logo.logo" style="width:170px;height:50px;" alt="RoyalWeb">!-->
                    <span style="font-size: 12px; font-weight: bold;text-align:center;">Solicitud de revaldaci&oacute;n</span>
		</td>
                <td style="text-align: right; width: 30%;"><?php echo date('d-m-Y H:i:s'); ?></td>
            </tr>
        </table>
	<hr>
    </page_header>
    <page_footer>
	<hr>
        <table style="width: 100%;">
            <tr>
            	<td style="text-align: left;    width: 85%">Gomez y Alvez</td>
                <td style="text-align: right;    width: 15%;">P&aacute;gina [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <br>
<!-- BODY PDF !-->
<span style="font-size: 16px; font-weight: bold;text-align:center;">Solicitud de revaldaci&oacute;n</span>
<br><br>
<?php 
    //echo '<pre>'.print_r($result,1).'</pre>'; 
?>
<table>
<tr>
    <td><strong>Referencia: </strong></td>
    <td><?php echo (isset($data['datos']['sReferencia'])) ? utf8_encode($data['datos']['sReferencia']) : ''; ?></td>
</tr>
<tr>
    <td><strong>BL: </strong></td>
    <td><?php echo (isset($data['datos']['sBL'])) ? utf8_encode($data['datos']['sBL']) : ''; ?></td>
</tr>
<tr>
    <td><strong>Fecha de arribo de buque: </strong></td>
    <td><?php echo (isset($data['datos']['dFechaArriboBuque'])) ? utf8_encode(date('d-m-Y',strtotime($data['datos']['dFechaArriboBuque']))) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Corresponsalia: </strong></td>
    <td><?php echo (isset($result['corresponsalia'])) ? utf8_encode($result['corresponsalia']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Clave documento: </strong></td>
    <td><?php echo (isset($result['skClaveDocumento'])) ? utf8_encode($result['skClaveDocumento']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Tramite: </strong></td>
    <td><?php echo (isset($result['TipoTramite'])) ? utf8_encode($result['TipoTramite']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Servicio: </strong></td>
    <td><?php echo (isset($result['TipoServicio'])) ? utf8_encode($result['TipoServicio']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<?php 
    if($result['skTipoServicio'] == 'CONT'){ 
?>
<tr>
    <td><strong>N&uacute;mero de contenedor: </strong></td>
    <td><?php echo (isset($result['sNumContenedor'])) ? utf8_encode($result['sNumContenedor']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<?php 
    }elseif($result['skTipoServicio'] == 'CSUE'){
?>
<tr>
    <td><strong>Bultos: </strong></td>
    <td><?php echo (isset($result['iBultos'])) ? utf8_encode($result['iBultos']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Peso: </strong></td>
    <td><?php echo (isset($result['fPeso'])) ? utf8_encode($result['fPeso']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Volumen: </strong></td>
    <td><?php echo (isset($result['fVolumen'])) ? utf8_encode($result['fVolumen']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<?php 
    }//ENDIF
?>
<tr>
    <td><strong>Mercancia: </strong></td>
    <td><?php echo (isset($result['sMercancia'])) ? utf8_encode($result['sMercancia']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Observaciones: </strong></td>
    <td><?php echo (isset($result['sObservaciones'])) ? utf8_encode($result['sObservaciones']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Fecha de recepci&oacute;n: </strong></td>
    <td><?php echo (isset($result['dRecepcion'])) ? utf8_encode($result['dRecepcion'].' '.$result['tRecepcion']) : ''; ?></td>
</tr>




</table>


</page>

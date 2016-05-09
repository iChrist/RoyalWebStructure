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
                    <img src="<?php echo SYS_URL; ?>core/assets/img/logo.png" style="width:170px;height:50px;" alt="RoyalWeb">
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
<br><br>
<?php 
    //echo '<pre>'.print_r($result,1).'</pre>'; 
?>
<table>
    <tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Referencia: </strong></td>
    <td><?php echo (isset($data['datos']['sReferencia'])) ? utf8_encode($data['datos']['sReferencia']) : ''; ?></td>
</tr>
<tr><td style="height:5px;"></td></tr>
<tr>
    <td><strong>BL Master: </strong></td>
    <td><?php echo (isset($data['datos']['sBlMaster'])) ? utf8_encode($data['datos']['sBlMaster']) : ''; ?></td>
</tr>
<tr><td style="height:5px;"></td></tr>
<tr>
    <td><strong>BL House: </strong></td>
    <td><?php echo (isset($data['datos']['sBlHouse'])) ? utf8_encode($data['datos']['sBlHouse']) : ''; ?></td>
</tr>
<tr><td style="height:5px;"></td></tr>
<tr>
    <td><strong>ETA: </strong></td>
    <td><?php echo (isset($data['datos']['dEta'])) ? utf8_encode(date('d-m-Y',strtotime($data['datos']['dEta']))) : ''; ?></td>
</tr>
<tr>
    <td><strong>Fecha de arribo de buque: </strong></td>
    <td><?php echo (isset($data['datos']['dFechaArriboBuque'])) ? utf8_encode(date('d-m-Y',strtotime($data['datos']['dFechaArriboBuque']))) : ''; ?></td>
</tr>
<tr><td style="height:5px;"></td></tr>
<tr>
    <td><strong>Prioridad: </strong></td>
    <td><?php echo (isset($data['datos']['iPrioridad']) && $data['datos']['iPrioridad'] == 1 ) ? 'Urgente': 'Normal';?></td>
</tr>
<tr><td style="height:5px;"></td></tr>
<tr>
    <td><strong>Solicitud: </strong></td>
    <td><?php echo !empty($data['datos']['dFechaCreacion']) ? date('d-m-Y H:i:s', strtotime($data['datos']['dFechaCreacion'])) : '-'; ?></td>
</tr>
<tr>
    <td><strong>Proceso: </strong></td>
    <td><?php echo !empty($data['datos']['dFechaProceso']) ? date('d-m-Y H:i:s', strtotime($data['datos']['dFechaProceso'])) : '-'; ?></td>
</tr>
<tr>
    <td><strong>Cierre: </strong></td>
    <td><?php echo !empty($data['datos']['dFechaCierre']) ? date('d-m-Y H:i:s', strtotime($data['datos']['dFechaCierre'])) : '-'; ?></td>
</tr>

<tr><td style="height:30px;"></td></tr>
<tr>
    <td><strong>Cliente:</strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['Empresa'])) ? utf8_encode($data['recepcionDocumentos']['Empresa']) : ''; ?></td>
</tr>
<tr>
    <td><strong>Ejecutivo:</strong></td>
    <td><?php echo (isset($data['datos']['UsuarioEjecutivo'])) ? utf8_encode($data['datos']['UsuarioEjecutivo']) : ''; ?></td>
</tr>
<tr>
    <td><strong>Tramite: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['TipoTramite'])) ? utf8_encode($data['recepcionDocumentos']['TipoTramite']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Servicio: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['TipoServicio'])) ? utf8_encode($data['recepcionDocumentos']['TipoServicio']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<?php
    if($data['recepcionDocumentos']['skTipoServicio'] == 'CONT'){ 
        ?>
        <tr>
            <td>
                <?php 
                    echo (isset($data['mercancias'])) ? utf8_encode($data['mercancias']) : ''; 
                ?>
            </td>
        </tr>
        <tr><td style="height:1px;"></td></tr>
        <?php
    }elseif($data['recepcionDocumentos']['skTipoServicio'] == 'CSUE'){
        ?>
        <tr>
            <td>
                <?php 
                    echo (isset($data['mercancias'])) ? utf8_encode($data['mercancias']) : ''; 
                ?>
            </td>
        </tr>
        <tr><td style="height:1px;"></td></tr>
<?php
    }//ENDIF
?>
<!--
<?php 
    if($data['recepcionDocumentos']['skTipoServicio'] == 'CONT'){ 
?>
<tr>
    <td><strong>N&uacute;mero de contenedor: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['sNumContenedor'])) ? utf8_encode($data['recepcionDocumentos']['sNumContenedor']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<?php 
    }elseif($data['recepcionDocumentos']['skTipoServicio'] == 'CSUE'){
?>
<tr>
    <td><strong>Bultos: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['iBultos'])) ? utf8_encode($data['recepcionDocumentos']['iBultos']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Peso: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['fPeso'])) ? utf8_encode($data['recepcionDocumentos']['fPeso']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Volumen: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['fVolumen'])) ? utf8_encode($data['recepcionDocumentos']['fVolumen']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<?php 
    }//ENDIF
?>
!-->
<tr>
    <td><strong>Mercancia: </strong></td>
    <td><?php echo (isset($data['recepcionDocumentos']['sMercancia'])) ? utf8_encode($data['recepcionDocumentos']['sMercancia']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Observaciones: </strong></td>
    <td><?php echo (isset($data['datos']['sObservaciones'])) ? utf8_encode($data['datos']['sObservaciones']) : ''; ?></td>
</tr>

<tr><td style="height:30px;"></td></tr>
<tr>
    <td><strong>Linea naviera: </strong></td>
    <td><?php echo (isset($data['datos']['EmpresaNaviera'])) ? utf8_encode($data['datos']['EmpresaNaviera']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Tramitador: </strong></td>
    <td><?php echo (isset($data['datos']['Tramitador'])) ? utf8_encode($data['datos']['Tramitador']) : ''; ?></td>
</tr>
<tr><td style="height:1px;"></td></tr>
<tr>
    <td><strong>Estatus naviera: </strong></td>
    <td><?php echo (isset($data['datos']['Estatus'])) ? utf8_encode($data['datos']['Estatus']) : ''; ?></td>
</tr>
<tr><td style="height:30px;"></td></tr>
</table>
<?php
    if(count($data['rechazosSolicitud']) > 0) {
        echo '<table><tr><td style="width:20%;"><strong>MOTIVOS DE RECHAZO</strong></td></tr><tr><td style="height:5px;"></td></tr>';
        foreach($data['rechazos'] AS $k=>&$v){
            if(in_array($v['skRechazo'], $data['rechazosSolicitud'])){
                echo '<tr><td style="width:20%;">'.$v['sNombre'].'</td><td></td></tr><tr><td style="height:10px;"></td></tr>';
            }
        }
        echo '</table>';
    }
?>

</page>

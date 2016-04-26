<?php require_once($data['config']['style']); ?>
<?php include($data['config']['header']); ?>
<?php
if (isset($data['datos']) && $data['datos']) {
    $result = $data['datos'];
}
?>

<table class="col-md-12">
    <tr>
        <td class="col-md-4"><strong>Referencia: </strong></td>
        <td class="col-md-8"><?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : ''; ?></td>
    </tr>
    <tr><td style="height:1px;"></td></tr>
    <tr>
        <td><strong>Pedimento: </strong></td>
        <td><?php echo (isset($result['sPedimento'])) ? utf8_encode($result['sPedimento']) : ''; ?></td>
    </tr>
    <tr><td style="height:1px;"></td></tr>
    <tr>
        <td><strong>BL Master: </strong></td>
        <td><?php echo (isset($result['sBlMaster'])) ? utf8_encode($result['sBlMaster']) : ''; ?></td>
    </tr>
    <tr><td style="height:1px;"></td></tr>
    <tr>
        <td><strong>Cliente: </strong></td>
        <td><?php echo (isset($result['Empresa'])) ? utf8_encode($result['Empresa']) : ''; ?></td>
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
    if ($result['skTipoServicio'] == 'CONT') {
        ?>
        <tr>
            <td colspan="2">
                <?php echo (isset($data['mercancias'])) ? utf8_encode($data['mercancias']) : ''; ?>
            </td>
        </tr>
        <tr><td style="height:1px;"></td></tr>
        <?php
    } elseif ($result['skTipoServicio'] == 'CSUE') {
        ?>
        <tr>
            <td colspan="2">
                <?php echo (isset($data['mercancias'])) ? utf8_encode($data['mercancias']) : ''; ?>
            </td>
        </tr>
        <tr><td style="height:1px;"></td></tr>
        <!--!
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
        <tr><td style="height:1px;"></td></tr>!-->
        <?php
    }//ENDIF
    ?>
    <tr><td style="height:5px;"></td></tr>
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
        <td><?php echo (isset($result['dRecepcion'])) ? utf8_encode(date('d-m-Y', strtotime($result['dRecepcion'])) . ' ' . $result['tRecepcion']) : ''; ?></td>
    </tr>


</table>



<?php include($data['config']['footer']); ?>
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




</table>



<?php include($data['config']['footer']); ?>

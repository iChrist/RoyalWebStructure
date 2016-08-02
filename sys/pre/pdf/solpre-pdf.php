<?php require_once($data['config']['style']); ?>
<?php include($data['config']['header']); ?>
<?php
if (isset($data['datos']) && $data['datos']) {
    $result = $data['datos'];


}
?>
<style type="text/css">
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
</style>
<table cellspacing="0" style="width: 100%; border: solid 1px black; background: #FFF; text-align: center; font-size: 10pt;">
    <tr>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Referencia </strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : ''; ?></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7; "><strong>Fecha de Previo </strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo ($result['fechaProgramacion'] ? date('d/m/Y ', strtotime($result['fechaProgramacion'])) : 'N/D') ; ?></td>
    </tr>
    <tr>
        <td colspan="1" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Cliente</strong></td>
        <td colspan="3" style="border: solid 1px #000000;"> <?php echo (isset($result['importador'])) ? utf8_encode($result['importador']) : ''; ?></td>
        <td colspan="1" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Recinto</strong></td>
        <td colspan="3" style="border: solid 1px #000000;"><?php echo (isset($result['recinto'])) ? utf8_encode($result['recinto']) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Conocimiento Maritimo</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo (isset($result['mbl'])) ? utf8_encode($result['mbl']) : ''; ?></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Contenedor / C. Suelta</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo (isset($result['contenedor'])) ? utf8_encode($result['contenedor']) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Sello de Origen</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo (isset($result['selloOrigen'])) ? utf8_encode($result['selloOrigen']) : ''; ?></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Sello Final</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo (isset($result['selloFinal'])) ? utf8_encode($result['selloFinal']) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Tipo de Embalaje</strong></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Revisado Por</strong></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Tramitador</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"><?php echo (isset($result['usuarioTramitador'])) ? utf8_encode($result['usuarioTramitador']) : ''; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">MADERA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">ADUANA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Pais de origen</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;">CARTON&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;">PGR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Hora de Apertura</strong></td>
        <td colspan="2" style="border: solid 1px #000000;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">ATADOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">SAGARPA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" rowspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Hora de Presentacion de <br>la Autoridad</strong></td>
        <td colspan="2" rowspan="2"  style="border: solid 1px #000000;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">COSTALERA&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">SEMARNAT&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;">PALETIZADO&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;">SALUD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Tipo de Previo</strong></td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;"><?php echo (isset($result['tipoPrevio'])) ? utf8_encode($result['tipoPrevio']) : 'N/D'; ?> </td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;">GRANEL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;">SEDENA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;"></td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">OTROS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border-left: solid 1px #000000; border-right: solid 1px #000000; ">OTROS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; "></td>
        <td colspan="2" style="border: solid 1px #000000;"></td>
    </tr>
    <tr>
        <td colspan="8" style="text-align:left; border: solid 1px #000000;" ><strong>Observaciones:</strong></td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Faltante</strong></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Sobrante</strong></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Averias</strong></td>
        <td colspan="2" style="border: solid 1px #000000; background: #E7E7E7;"><strong>Marcas y Numeros</strong></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #000000; ">SI&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; ">SI&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; ">SI&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;]</td>
        <td colspan="2" rowspan="2" style="border: solid 1px #000000; "></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #000000; ">NO [&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; ">NO [&nbsp;&nbsp;]</td>
        <td colspan="2" style="border: solid 1px #000000; ">NO [&nbsp;&nbsp;]</td>
    </tr>
    <tr>
        <td style="width: 12.5%; border: solid 1px #000000; background: #E7E7E7;"><strong>Factura</strong></td>
        <td style="width: 12.5%;  border: solid 1px #000000; background: #E7E7E7;"><strong>Consecutivo</strong></td>
        <td style="width: 12.5%; border: solid 1px #000000; background: #E7E7E7;"><strong>Descripcion</strong></td>
        <td style="width: 12.5%; border: solid 1px #000000; background: #E7E7E7;"><strong>Modelo</strong></td>
        <td style="width: 12.5%; border: solid 1px #000000; background: #E7E7E7;"><strong>Etiquetado</strong></td>
        <td style="width: 12.5%; border: solid 1px #000000; background: #E7E7E7;"><strong>Marca</strong></td>
        <td style="width: 12.5%; border-top: solid 1px #000000; background: #E7E7E7;border-left: solid 1px #000000; background: #E7E7E7;border-bottom: solid 1px #000000; background: #E7E7E7;"><strong>Observacion</strong></td>
        <td style="width: 12.5%; border-top: solid 1px #000000; background: #E7E7E7;border-right: solid 1px #000000; background: #E7E7E7;border-bottom: solid 1px #000000; background: #E7E7E7;"><strong>&nbsp;</strong></td>
    </tr>
    <?php
    if($data['clasificaciones']){
        while ($facturas = $data['clasificaciones']->fetch_assoc()) {
            ?>

            <tr>
                <td style="width: 12.5%; border: solid 1px #000000; background: #FFF;"><?php echo $facturas['sFactura']; ?></td>
                <td style="width: 12.5%;  border: solid 1px #000000; background: #FFF;"><?php echo $facturas['iSecuencia']; ?></td>
                <td style="width: 12.5%; border: solid 1px #000000; background: #FFF;"><?php echo $facturas['sDescripcion']; ?></td>
                <td style="width: 12.5%; border: solid 1px #000000; background: #FFF;"><?php echo $facturas['sNumeroParte']; ?></td>
                <td style="width: 12.5%; border: solid 1px #000000; background: #FFF;"></td>
                <td style="width: 12.5%; border: solid 1px #000000; background: #FFF;">SI&nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;NO&nbsp;[&nbsp;&nbsp;]</td>
                <td style="width: 12.5%; border-top: solid 1px #000000; background: #FFF;border-left: solid 1px #000000; background: #E7E7E7;border-bottom: solid 1px #000000; background: #FFF;"><strong></strong></td>
                <td style="width: 12.5%; border-top: solid 1px #000000; background: #FFF;border-right: solid 1px #000000; background: #E7E7E7;border-bottom: solid 1px #000000; background: #FFF;"><strong>&nbsp;</strong></td>

            </tr>            <?php
        }//ENDIF
    }//ENDWHILE
    //$data['clasificaciones']->data_seek(0);
    ?>

    <tr>
        <td colspan="8" style="text-align:left; border: solid 1px #000000;" ><strong>Resultado de Previo</strong></td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;">&nbsp;&nbsp;</td>
    </tr>


</table>



<?php include($data['config']['footer']); ?>

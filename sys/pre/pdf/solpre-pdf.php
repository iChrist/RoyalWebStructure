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
    <!-- NORMAS DEL PDF-->
    <tr>
        <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA Oficial Mexicana NOM-004-SCFI-2006, Información comercial-Etiquetado de productos textiles, prendas de vestir, sus accesorios y ropa de casa.<br>
    <b>a)</b>   Marca comercial.           (cuando el cliente utilice su nombre como marca ese se deberá de considerar <br>
    <b>b)</b> Descripción de insumos   (porcentaje en masa en orden de predominio) <br>
    <b>c)</b> Talla para prendas de vestir, o medidas para ropa de casa y textiles. <br>
    <b>d)</b> Instrucciones de cuidado.<br>
    <b>e)</b> País de origen.<br>
    <b>f)</b> Para personas físicas: Nombre y domicilio fiscal del fabricante o importador, pudiéndose incorporar de manera voluntaria el RFC. (y) Para personas morales: Razón social y domicilio fiscal del fabricante o importador, pudiéndose incorporar de manera voluntaria el RFC.
</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">Para las siguientes mercancías solo requieren lo señalado en el punto 4.1.2<br>
            a) Cortes de tela acondicionados para la venta al por menor, que contengan 45% o más de lana peinada, que no excedan de cinco metros (Casimires)<br>
        b) Bolsos de mano. c) Maletas. d) Monederos. e) Billeteras.  f) Estuches.  g) Mochilas.  h) Paraguas y parasoles.  i) Cubreasientos.  j) Artículos para cubrir electrodomésticos y domésticos.  k) Cubiertas para planchadores.  l) Cubiertas para muebles de baño.  <br>
        m) Cubiertas para muebles.  n) Cojines.  ñ) Artículos de limpieza.  o) Pañales.  p) Lienzos para pintores.  q) Canguro para bebé.   r) Pañaleras.  s) Baberos.  t) Cambiadores.  u ) Cinturones textiles<br>
        5.2.2 La información requerida en 4.1.2 debe presentarse en etiqueta permanente o temporal adherida <br>
        o amarrada al producto, en los siguientes casos.<br>
        a) Telas tejidas y no tejidas de cualquier índole.<br>
        b) Alfombras, bajo alfombras y tapetes de materiales textiles.<br>
        c) Pelucas.<br>
        d) Artículos para el cabello (salvo aquellos que por sus pequeñas dimensiones deban empacarse a granel).<br>
        e) Corbatas de moño.<br>
        f) Artículos destinados a ser utilizados en una sola ocasión (desechables). En este caso, la información a que se refiere el inciso 4.1.2 puede presentarse en el envase.</td>
    </tr>
    <tr>
        <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA OFICIAL MEXICANA NOM-020-SCFI-1997, INFORMACION COMERCIAL-ETIQUETADO DE CUEROS Y PIELES CURTIDAS NATURALES Y MATERIALES SINTETICOS O ARTIFICIALES CON ESA APARIENCIA, CALZADO, MARROQUINERIA, ASI COMO LOS PRODUCTOS ELABORADOS CON DICHOS MATERIALES.<br>
            a) Nombre, denominación o razón social completo o abreviado del fabricante nacional o importador o su marca registrada.<br>
b) La leyenda "Hecho (u otros análogos) en México" o bien, el nombre del país de origen.<br>
c) Definición genérica o específica de los materiales y opcionalmente su acabado. (Esta información puede ser ostentada en una etiqueta).<br>
 4.1.1. Los comerciantes no son responsables de la fidelidad de los datos que reciben de los fabricantes pero sí lo son si los productos o artículos no los ostentan en la forma requerida por esta Norma Oficial Mexicana.
<br>
Los comerciantes que deseen que su marca registrada aparezca en el producto o artículo, pueden solicitarlo al fabricante de tal manera que esta indicación no obstruya los datos del marcado.
<br>
4.1.2. Para los efectos de esta Norma deben especificarse claramente los principales elementos de los artículos elaborados con piel o de productos con esa apariencia o de sus substitutos de otros materiales.<br>
a) En el calzado: el corte, el forro y la suela.<br>
Cuando exista combinación de dos o más materiales dentro de alguna de estas tres partes, debe especificarse el que predomine.<br>
b) En las prendas de vestir como abrigos, chamarras, sacos, pantalones, faldas, bolsas para dama, guantes, cinturones y artículos para viaje como velices, portafolios, mochilas, etc., la parte externa del producto y el forro.
<br>
c) En artículos como monederos, carteras, billeteras, llaveros, estuches, artículos para escritorio, para oficina, deportivos y otros no especificados, se deben indicar el material de la vista, sin considerar armazones, divisiones y otras partes, excepto el forro cuando éste sea piel.<br>
d) En los artículos de cuero para uso industrial, como son los rollos de banda de cuero, artículos tales como refacciones de cuero, empaques de cuero, etc., únicamente debe marcarse en un lugar visible de su embalaje.<br>
e) Cuando los artículos a que se refiere esta Norma se comercialicen como pares, la información podrá presentarse en una o ambas piezas.
        </td>
        </tr>
        <tr>
            <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA OFICIAL MEXICANA NOM-024-SCFI-2013, INFORMACIÓN COMERCIAL PARA EMPAQUES, INSTRUCTIVOS Y GARANTÍAS DE LOS PRODUCTOS ELECTRÓNICOS, ELÉCTRICOS Y ELECTRODOMÉSTICOS.<br>
                a) La representación gráfica o el nombre del producto, salvo que éste sea obvio, <br>
b) Nombre, denominación o razón social y domicilio del fabricante nacional o importador, <br>
c) La leyenda que identifique al país de origen del mismo (ejemplo: “Hecho en...”, “Manufacturado en...”, u otros análogos), <br>
d) Las características eléctricas nominales aplicables al producto, determinadas por el fabricante, como por ejemplo: <br>
• Tensión de alimentación, en volts. <br>
• Consumo de potencia, en watts o consumo de corriente, en amperes. <br>
• Frecuencia, en hertz. <br>
Aquellos productos que se comercialicen como sistemas (conjunto de varias unidades y que por su configuración de conexión no puedan ser opera dos de manera independiente), deben indicar al menos las características eléctricas nominales de aquella que se desempeñe como unidad principal, según determine el fabricante. <br>
e) Para el caso de productos reconstruidos, usados o de segunda mano, el tamaño de la letra que indique esta circunstancia debe ser cuando menos dos veces mayor que el del resto de la información descrita en este inciso.

            </td>
        </tr>
        <tr>
            <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA OFICIAL MEXICANA NOM-055-SCFI-1994, INFORMACION COMERCIAL - MATERIALES RETARDANTES Y/O INHIBIDORES DE FLAMA Y/O IGNIFUGOS - ETIQUETADO.<br>
            <br>    Los productos nacionales y/o importados deben ostentar en forma clara, legible e indeleble, la información siguiente: <br>
- Nombre o razón social del fabricante <br>
- Marca comercial del producto <br>
- Nombre genérico del material y/o específico del mismo <br>
- Nombre técnico o químico del producto <br>
- Modo de empleo del producto (el fabricante debe especificar la forma de preparar y aplicar el producto para su uso correcto. Las indicaciones deben senalarse en instructivo anexo o en la etiqueta) <br>
- Nombre técnico o químico de los solventes a emplearse <br>
- Advertencias (el fabricante debe anotar las advertencias mínimas para preservar la seguridad y salud de las personas y la integridad del medio ambiente en general) <br>
- La leyenda "Hecho en México" o la designación del país de origen <br>
- Fecha de caducidad <br>
- El Registro Federal de Contribuyente del fabricante <br>
- El Registro Federal de Contribuyente del importador. Este dato puede agregarse al momento de la comercialización

            </td>
        </tr>
        <tr>
            <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA OFICIAL MEXICANA NOM-051-SCFI/SSA1-2010, ESPECIFICACIONES GENERALES DE ETIQUETADO PARA ALIMENTOS Y BEBIDAS NO ALCOHOLICAS PREENVASADOS-INFORMACION COMERCIAL Y SANITARIA.<br>
                        <br>       4.2.1 Nombre o denominación del alimento o bebida no alcohólica preenvasado<br>
                               4.2.2 Lista de ingredientes <br>
                               4.2.3 Contenido neto y masa drenada <br>
                               4.2.4 Nombre, denominación o razón social y domicilio fiscal. <br>
                               4.2.5 País de origen <br>
                               4.2.6 Identificación del lote <br>
                               4.2.7 Fecha de caducidad o de consumo preferente <br>
                               4.2.8 Información nutrimental <br>
                               4.2.9. Etiquetado frontal nutrimental.

            </td>
        </tr>
        <tr>
            <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA Oficial Mexicana NOM-050-SCFI-2004, Información comercial-Etiquetado general de productos.<br>
Nombre o denominación genérica del producto, cuando no sea identificable a simple vista por el consumidor.Un producto es identificable a simple vista si éste está contenido en un empaque que permite ver su contenido; o bien, si el empaque presenta el gráfico del producto, siempre y cuando en este gráfico no aparezcan otros productos no incluidos en el empaque. <br>
b) Indicación de cantidad conforme a la NOM-030-SCFI, en el entendido de que si el contenido o número de piezas de un producto puede identificarse a simple vista, no será necesario indicar la declaración de cantidad. En ese sentido, resultará irrelevante que se indique o no en dichos productos la declaración de cantidad y también la forma en que se haga (en idioma distinto al español, en un sitio distinto a la superficie principal de exhibición, en un tamaño menor al requerido, etc.), siempre y cuando dicha declaración corresponda al producto que la ostente. <br>
En caso de envase múltiple o colectivo, cuyo contenido no sea inidentificable a simple vista, éste debe ostentar la declaración de cantidad (solamente la que corresponde al envase múltiple o colectivo, no la que corresponde a cada uno de los envases de los productos en lo individual), de conformidad con la Norma Oficial Mexicana NOM-030-SCFI-1993 (ver referencias). La descripción de los componentes puede aparecer en la superficie de información y debe incluir el nombre o denominación genérica de los productos, así como su contenido o contenido neto. <br>
c) Nombre, denominación o razón social y domicilio fiscal, incluyendo código postal, ciudad o estado del fabricante o responsable de la fabricación para productos nacionales o bien del importador. Para el caso de productos importados, esta información puede incorporarse al producto en territorio nacional, después del despacho aduanero y antes de la comercialización del producto. Dicha información debe ser proporcionada a la Secretaría por el importador a solicitud de ésta. Asimismo, la Secretaría debe proporcionar esta información a los consumidores que así lo soliciten cuando existan quejas sobre los productos.<br>
d) La leyenda que identifique al país de origen del producto, por ejemplo Producto de..., Hecho en..., Manufacturado en..., Producido en..., u otros análogos. <br>
e) Las advertencias de riesgos por medio de leyendas, gráficas o símbolos precautorios en el caso de productos peligrosos. <br>
f) Cuando el uso, manejo o conservación del producto requiera de instrucciones, debe presentarse esa información. En caso de que dicha información se encuentre en un instructivo o manual de operación anexo, se debe indicar en la respectiva etiqueta: VEASE INSTRUCTIVO ANEXO O MANUAL DE OPERACION, u otras leyendas análogas, las cuales podrán presentarse indistintamente en mayúsculas, minúsculas o en una combinación de ambas. <br>
g) Cuando corresponda, la fecha de caducidad o de consumo preferente.
            </td>
        </tr>
        <tr>
            <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA Oficial Mexicana NOM-015-SCFI-2007, Información comercial-Etiquetado para juguetes.<br>
                a) Nombre genérico del producto, cuando éste no sea plenamente identificable a simple vista por el consumidor; <br>
b) Indicación de cantidad en forma escrita o gráfica; <br>
b.1 Los juguetes que se comercialicen por cuenta numérica en empaques que permitan ver su contenido, no requieren presentar declaración de cantidad. <br>
b.2 Los juguetes que se comercialicen por cuenta numérica en envases que no permitan ver su contenido, pero éste sea obvio y contengan una sola unidad, no requieren presentar declaración <br>
de cantidad.
b.3 Los juguetes que se comercialicen por cuenta numérica, pero no se encuentren en los supuestos a que se refieren los incisos b.1 y b.2 antes citados, deben indicar la cantidad en forma escrita o gráfica. En caso de que la declaración sea escrita, ésta debe expresarse de manera ostensible y fácilmente legible de forma tal que el tamaño y tipo de letra permita al consumidor su lectura, como lo dispone el inciso c) del punto 5.1.3 de la presente Norma Oficial Mexicana. <br>
b.4 Los juguetes que se comercialicen en unidades de masa o de volumen deben indicar la cantidad en forma escrita, de forma tal que el tamaño y tipo de letra permitan al consumidor su lectura, como lo dispone el inciso a) del punto 5.1.3 de la presente Norma Oficial Mexicana.<br>
c) Nombre, denominación o razón social y domicilio fiscal del fabricante o responsable de la fabricación para productos nacionales. En el caso de productos importados, esta información debe ser proporcionada a la Secretaría de Economía o a la Procuraduría Federal del Consumidor por el importador a solicitud de cualquiera de ellas; <br>
La Secretaría de Economía o la Procuraduría Federal del Consumidor proporcionará esta información a los consumidores que así lo soliciten cuando existan quejas sobre los productos; <br>
d) Leyenda que identifique el país de origen del producto, por ejemplo: "Producto de ... ", "Hecho en ... ", "Manufacturado en ... " u otros análogos, sujeto a lo dispuesto en los tratados internacionales de los que los Estados Unidos Mexicanos sean parte; <br>
e) Tratándose de productos importados: nombre, denominación o razón social y domicilio fiscal del importador. Esta información puede incorporarse al producto en territorio nacional, después
del despacho aduanero y antes de su comercialización; <br>
f) Leyenda o símbolo que indique la edad del consumidor recomendada sólo por el fabricante para <br>
su uso.
g) En su caso, el tipo y cantidad de pilas y/o baterías o de cualquier otra fuente de alimentación del juguete menor o igual a 24 V, en forma gráfica o escrita que requiera para su funcionamiento. <br>
h) En su caso, las características eléctricas nominales de alimentación del juguete, cuando éste consuma para su operación una tensión mayor a 24 V.

            </td>
        </tr>
        <tr>
            <td colspan="8" style="border: solid 1px #000000;font-size: 6pt;text-align:left;height: auto;">NORMA Oficial Mexicana NOM-141-SSA1/SCFI-2012, Etiquetado para productos cosméticos preenvasados. Etiquetado sanitario y comercial.<br>
 5. Requisitos de etiquetado <br>
   5.1 Requisitos generales. <br>
5.1.1 Presentación de la información. D.O.F. 14/02/2014 <br>
Los productos destinados a ser comercializados en el mercado nacional, deben ostentar una etiqueta con la información establecida en esta norma en idioma español, independientemente de que también pueda estar en otros idiomas, los caracteres podrán ser mayores, iguales o menores a aquéllos en los que se presenta la información en otros idiomas; los cuales deben ser claros, visibles, indelebles y en colores contrastantes, fáciles de leer por el consumidor en circunstancias normales de compra y uso. No será necesario utilizar las comillas en el etiquetado.
 <br>5.1.2. La información que se presente al consumidor, debe ser veraz y comprobable.
 <br>5.1.3. Las etiquetas que ostenten los productos objeto de esta norma, deben fijarse de manera tal que permanezcan disponibles hasta el momento de su compra y uso en condiciones normales.
 <br>5.1.5 Denominación genérica y específica del producto.
 <br>5.1.4 Cuando por las características del producto, no sea posible que la(s) etiqueta(s) se encuentre(n) directamente sobre el envase primario o secundario se podrán anexar al mismo.
 <br>5.1.5.1 Todos los productos deben ostentar la denominación genérica, conforme a lo que se establece en el apéndice informativo “A” de esta norma, pudiendo incluir la específica. En caso de productos cuya denominación no se encuentre dentro del ordenamiento antes citado, su denominación será aquella que mejor los describa o la más común o usual, podrá usarse una ilustración o viñeta que represente el uso del producto cosmético.
 <br>5.1.5.2 La información del numeral anterior, debe presentarse en español a excepción de las formas cosméticas que podrán declararse en su idioma original. Esta información podrá presentarse en la superficie principal del envase primario o secundario.
 <br>5.1.6 Identificación del responsable del producto.
 <br>5.1.6.1 Debe figurar en la superficie de información del envase primario o secundario, el nombre, denominación o razón social y domicilio (calle, número, código postal, ciudad y estado) del responsable del producto. Tratándose de productos importados, estos datos podrán incorporarse al producto, en el Territorio Nacional después del despacho aduanero y antes de su comercialización.
 <br>5.1.6.2 Leyenda que identifique al país de origen del producto o gentilicio, por ejemplo “Producto de ...”, “Hecho en...”, “Manufacturado en ...” u otras análogas, sujeto a lo dispuesto en los tratados internacionales de los cuales México sea parte.
 <br>5.1.7 Declaración de lote.
 <br>5.1.7.1 En cualquier parte del envase primario o secundario, debe figurar en todos los productos objeto de esta norma, la identificación del lote con una indicación en clave o en lenguaje claro, ya sea grabado, marcado con tinta indeleble o de cualquier otro modo similar, siempre y cuando éste sea claro y asegure su permanencia en condiciones normales de uso.
 <br>5.1.8 Instrucciones o modo de uso.
 <br>5.1.8.1 Deben figurar las instrucciones de uso u otros análogos en la superficie de información del envase primario o secundario o instructivo anexo de los siguientes productos: tintes, colorantes, coloración, decolorantes; permanentes; alaciadores permanentes; en productos para la piel cuya función primaria sea la protección solar, bronceadores, autobronceadores, depilatorios, epilatorios o en cualquier otro producto que lo requiera.
 <br>5.1.8.2 En caso de que las instrucciones o modo de uso estén en un instructivo anexo deberá señalarse esta situación mediante la oración “léase instructivo anexo” o equivalente.
 <br>5.1.8.3 En productos para la piel cuya función primaria sea la protección solar, indicar mediante las frases siguientes o equivalentes:
 <br>5.1.8.3.1 Que se aplique antes de la exposición al sol.
 <br>5.1.8.3.2 Que para mantener la protección, se repita con frecuencia la aplicación del producto , especialmente después de transpirar, bañarse o secarse.
 <br>5.1.8.3.3. Que se aplique a la piel la cantidad suficiente.
 <br>5.1.9 Declaraciones prohibidas de propiedades.
 <br>Se prohíbe el uso de las siguientes declaraciones:
 <br>5.1.9.1 Declaración de propiedades que no pueden comprobarse.
 <br>5.1.9.2 No podrán atribuirse a los productos cosméticos, acciones propias de los medicamentos.
 <br>5.1.9.3 En la comercialización de los productos cosméticos, el etiquetado no utilizará textos, denominaciones, marcas, imágenes o cualquier otro símbolo figurativo o no, con el fin de atribuir a estos productos características o propiedades de las que carecen.
 <br>5.1.10 En los envases múltiples o colectivos será necesario declarar únicamente, la información de etiquetado que no contengan los productos, de forma individual.
 <br>5.1.10.1 La información anterior debe aparecer en la superficie principal de exhibición o en la de información, sin restricción en el tamaño de la letra utilizada, siempre que sea fácil de leer por el consumidor.
 <br>5.1.10.2 Para los productos que se comercialicen en envases múltiples o colectivos:
 <br>5.1.10.2.1 La declaración de la cantidad puede expresarse indistintamente por cuenta numérica por los envases que contiene o por contenido neto, excepto cuando el contenido o contenido neto sea obvio, no siendo restrictivo la ubicación y tamaño de la letra utilizada.
 <br>5.1.10.2.2 Los envases individuales deben contener la declaración de cantidad del dato cuantitativo de acuerdo con lo establecido en este ordenamiento. En el caso de que los envases individuales no contengan la declaración de cantidad, ésta debe declararse en el envase múltiple o colectivo, no siendo restrictivo la ubicación y tamaño de la letra utilizada. D.O.F. 14/02/2014
 <br>5.2. Información Comercial
 <br>5.2.1 Se debe cumplir con lo que establece la Norma Oficial Mexicana NOM-008-SCFI-2002 Sistema General de Unidades de Medida, sin perjuicio de que además se puedan utilizar unidades de medida de otro sistema.
 <br>5.2.2 Para la declaración de cantidad se considera suficiente que los envases ostenten el dato cuantitativo, seguido de la unidad correspondiente a la magnitud aplicable, sin que sea necesario ostentar las leyendas “CONTENIDO”, “CONTENIDO NETO”, O SUS ABREVIATURAS, “CONT”, “CONT.NET”.
 <br>5.2.3 La declaración anterior debe aparecer en la superficie principal de exhibición o en la de información del envase primario o secundario.
 <br>5.2.4 El tamaño de la declaración de contenido o contenido neto debe ser de acuerdo a lo establecido en la Norma Oficial Mexicana NOM-030-SCFI-2006 Información comercial - Declaración de cantidad en la etiqueta - Especificaciones.
 <br>5.2.5 En las muestras o ayudas de venta y amenidades debe figurar, en cualquier parte del envase la siguiente información: denominación del producto, nombre del responsable del producto, número de lote y cuando aplique, considerando lo establecido en esta norma, incluir las instrucciones de uso y/o leyendas precautorias.
 <br>5.2.6 Las muestras de lociones y fragancias cuyo contenido neto sea menor o igual a 2 ml quedan exceptuadas de la declaración de la información del etiquetado respecto al numeral anterior, al igual que las ayudas de venta o probadores. D.O.F. 14/02/2014
 <br>5.3 Información Sanitaria
 <br>5.3.1. En los productos objeto de esta norma, debe figurar en caracteres visibles, en cualesquiera de las etiquetas que se encuentran en la superficie de información del envase primario o secundario, la lista de los nombres de los ingredientes de la fórmula. D.O.F. 14/02/2014
 <br>5.3.1.1 por orden cuantitativo decreciente; o,
 <br>5.3.1.2 por orden cuantitativo decreciente aquellos ingredientes cuya concentración sea superior al 1% seguido por aquellos ingredientes en concentración inferior o igual al 1% que podrán mencionarse en cualquier orden.
 <br>5.3.2 Quedan exceptuadas de la declaración de los nombres de los ingredientes, los perfumes y fragancias.
 <br>5.3.3 Para la nomenclatura de los ingredientes, puede emplearse a elección del fabricante cualquiera de las establecidas en los Acuerdos, o el nombre químico más usual o el nombre tal cual como aparece en la Nomenclatura Internacional de Ingredientes Cosméticos (INCI).
 <br>Las fragancias y sabores pueden designarse con el nombre genérico.
 <br>Los materiales de origen botánico deben designarse con el nombre científico de la planta, siendo opcional el nombre común de la misma.
 <br>5.3.4 Para la declaración de los nombres de los ingredientes en los productos con una o más presentaciones, en los que la fórmula base es la misma y sólo varía el uso de los colorantes, se incluirá la lista con los nombres de los ingredientes comunes de la fórmula, seguida de otra con todos los colorantes usados para las diversas presentaciones, anteponiendo a esta última el texto "puede contener" o "contiene uno o más” o “+/-”. o equivalentes.
 <br>5.3.5 Para la declaración de los nombres de los ingredientes en aquellos productos que por su tamaño carecen de espacio, (como son lápices de cejas, delineadores, entre otros) ésta podrá figurar en el envase secundario si lo hubiere o bien en un volante impreso anexo al producto o en una etiqueta de bandera.
 <br>5.3.6 En productos con una duración menor o igual a 24 meses debe figurar, en cualquier parte del envase primario o secundario, la fecha hasta la cual un producto, en condiciones adecuadas de almacenamiento, es seguro para la salud del consumidor, indicando al menos el mes y el año, o bien por el día, el mes y el año Este dato podrá o no ir precedido por la leyenda, a elección del fabricante: Caducidad, Consumo preferente, Vencimiento, Duración mínima, Validez, Expiración, o equivalentes o sus abreviaturas.
 <br>Quedan exceptuados de la declaración de esta fecha, los productos que por sus características no permiten el crecimiento microbiano o que tienen una alta rotación de venta y uso, tales como: Aceites, Jabones sólidos, sales de baño, perfumes y derivados, desodorantes que no sean emulsiones, antitranspirantes, depilatorios, tintes y decolorantes, shampoo, acondicionadores, permanentes, relajantes permanentes de rizos y alaciadores permanentes, fijadores, oxidantes, productos para uñas, brillantinas, unidosis y productos en envases presurizados.
 <br>5.3.7 Leyendas precautorias
 <br>Las leyendas precautorias asociadas a ingredientes que conforme a las disposiciones que emita la Secretaría representen riesgos a la salud, deberán estar escritas en idioma español, incluyendo el nombre de dichos ingredientes. Cuando los ingredientes se hayan declarado conforme a la Nomenclatura INCI, las leyendas precautorias a que hace referencia el párrafo anterior deberán incluir también dicha denominación.
 <br>Conforme al tipo de producto y las sustancias que contiene, se deben incluir las siguientes leyendas precautorias o sus equivalentes:
 <br>5.3.7.1 En desodorantes o antitranspirantes:
 <br>5.3.7.1.1 Que no se aplique sobre piel irritada o lastimada
 <br>5.3.7.1.2 Que descontinúe su uso en caso de presentarse irritación, enrojecimiento o alguna molestia
 </td>
 </tr>
    <tr>
        <td colspan="8" style="font-size: 6pt;text-align:left;height: auto;">
 <br>5.3.7.1.3 Que no se deje al alcance de los niños
 <br>5.3.7.1.4 En caso de contener Fenolsulfonato de zinc mencionar que se evite el contacto con los ojos
 <br>5.3.7.2 En tintes, colorantes, coloración y otros relacionados:
 <br>5.3.7.2.1 Los colorantes del cabello pueden causar reacciones alérgicas graves
 <br>5.3.7.2.2 Lea y siga las instrucciones
 <br>5.3.7.2.3 Este producto no está destinado a utilizarse en personas menores de dieciséis años.
 <br>5.3.7.2.4 Los tatuajes temporales de «henna negra» pueden aumentar el riesgo de alergia
 <br>5.3.7.2.5 No utilice el tinte capilar
 <br>5.3.7.2.5.1 Si tiene una erupción cutánea en el rostro o tiene el cuero cabelludo sensible, irritado o dañado
 <br>5.3.7.2.5.2 Si alguna vez ha experimentado cualquier tipo de reacción después de la coloración del cabello
 <br>5.3.7.2.5.3 Si alguna vez ha experimentado una reacción a los tatuajes temporales de «henna negra»
 <br>5.3.7.2.6 Que se realice una prueba preliminar de acuerdo a las instrucciones
 <br>5.3.7.2.7 Que puede causar alergia en algunas personas
 <br>5.3.7.2.8 Que suspenda su empleo en caso de irritación
 <br>5.3.7.2.9 Que no se aplique en cejas o pestañas
 <br>5.3.7.2.10 Que se evite el contacto con los ojos
 <br>5.3.7.2.11 Que no se deje al alcance de los niños
 <br>5.3.7.2.12 Indicaciones de primeros auxilios para el caso
 <br>5.3.7.2.13 Que se usen guantes apropiados
 <br>5.3.7.2.14 En caso de que el producto entre en contacto con los ojos, que se enjuaguen inmediatamente con agua
 <br>5.3.7.2.15 En productos profesionales además se debe indicar: Reservado a profesionales
 <br>5.3.7.3 En tintes, colorantes, coloración y otros que contengan alguna de las siguientes sustancias, además de las leyendas anteriores, se deberán indicar que la contienen:
 <br>5.3.7.3.1 Diaminobenceno y sus derivados
 <br>5.3.7.3.2 Diaminotolueno y sus derivados
 <br>5.3.7.3.3 Diaminofenol
 <br>5.3.7.3.4 Hidroquinona
 <br>5.3.7.3.5 Resorcinol
 <br>5.3.7.4 En permanentes y alaciadores permanentes:
 <br>5.3.7.4.1 Que se destaque(n) la(s) sustancia(s) que puedan causar daño al cabello y piel cabelluda
 <br>5.3.7.4.2 Que no se aplique a cejas o pestañas
 <br>5.3.7.4.3 Que se evite el contacto con los ojos. Que puede causar ceguera
 <br>5.3.7.4.4 Que se use exclusivamente conforme al instructivo
 <br>5.3.7.4.5 Que no se deje al alcance de los niños
 <br>5.3.7.4.6 Además deben incluirse las indicaciones de primeros auxilios para el caso y recomendar la consulta a un médico
 <br>5.3.7.4.7 En productos profesionales además se debe indicar: Reservado a profesionales
 <br>5.3.7.4.8 En los productos que contengan alguna de las siguientes sustancias, además de lo anterior, se deberá indicar que las contienen:
 <br>5.3.7.4.8.1 Hidróxido de sodio
 <br>5.3.7.4.8.2 Hidróxido de potasio
 <br>5.3.7.4.8.3 Hidróxido de litio
 <br>5.3.7.4.8.4 Hidróxido de calcio
 <br>Se podrá indicar de manera genérica “Contiene un agente alcalino”
 <br>5.3.7.5 En decolorantes:
 <br>5.3.7.5.1 Que se destaque(n) la(s) sustancia(s) que puede causar daño
 <br>5.3.7.5.2 Que se evite el contacto con los ojos
 <br>5.3.7.5.3 En caso de que el producto entre en contacto con los ojos, que se enjuaguen inmediatamente con agua
 <br>5.3.7.5.4 Que se usen guantes apropiados
 <br>5.3.7.5.5 Que no se aplique si la piel cabelluda está irritada
 <br>5.3.7.5.6 Que se suspenda su empleo en caso de irritación
 <br>5.3.7.5.7 Que no se aplique en cejas o pestañas
 <br>5.3.7.5.8 Que no se deje al alcance de los niños
 <br>5.3.7.5.9 Que se den indicaciones de primeros auxilios para el caso
 <br>5.3.7.6 En depilatorios:
 <br>5.3.7.6.1 Que no se aplique sobre piel irritada o lastimada
 <br>5.3.7.6.2 Que no se deje al alcance de los niños
 <br>5.3.7.6.3 Que se evite el contacto con los ojos
 <br>5.3.7.6.4 Los productos que contengan alguna de las siguientes sustancias además de las anteriores, se debe indicar que la contiene:
 <br>5.3.7.6.4.1 Hidróxido de sodio
 <br>5.3.7.6.4.2 Hidróxido de potasio
 <br>5.3.7.6.4.3 Hidróxido de litio
 <br>5.3.7.6.4.4 Hidróxido de calcio
 <br>Se podrá indicar de manera genérica “Contiene un agente alcalino”
 <br>5.3.7.7 En los endurecedores de uñas que contengan formaldehido:
 <br>5.3.7.7.1 Que se proteja la cutícula con sustancias grasosas
 <br>5.3.7.7.2 Indicar que lo contiene mediante la leyenda correspondiente (sólo si la concentración es superior a 0.05%)
 <br>5.3.7.8 En removedores de cutícula que contengan hidróxido de sodio o potasio:
 <br>5.3.7.8.1 Que contiene potasa o sosa, según corresponda o que contiene un agente alcalino
 <br>5.3.7.8.2 Que se evite el contacto con los ojos
 <br>5.3.7.8.3 Que puede causar ceguera
 <br>5.3.8.8.4 Que no se deje al alcance de los niños
 <br>5.3.7.9 En sistemas de uñas profesionales que contengan peróxido de benzoílo y/o hidroquinona:
 <br>5.3.7.9.1 Que está reservado a los profesionales
 </td>
 </tr>
 <tr>
     <td colspan="8" style="font-size: 6pt;text-align:left;height: auto;">
 <br>5.3.7.9.2 Que se evite el contacto con la piel
 <br>5.3.7.9.3 Que se lean las instrucciones de uso
 <br>5.3.7.10 En los productos para la piel cuya función primaria sea la de ofrecer protección solar:
 <br>5.3.7.10.1 Que se indique el valor del Factor de Protección Solar (FPS), en caso de que se utilicen las siglas FPS o SPF, señalar su significado
 <br>5.3.7.10.2 Que protege contra UVB y UVA
 <br>5.3.7.10.3 Que no permanezca mucho tiempo expuesto al sol, aunque emplee un producto de protección solar
 <br>5.3.7.10.4 Que se mantenga a los bebés y niños pequeños fuera de la luz solar directa
 <br>5.3.7.10.5 Que la exposición excesiva al sol es un riesgo importante para la salud
 <br>5.3.7.10.6 Que suspenda su empleo si se presentan signos de irritación o salpullido
 <br>5.3.7.10.7 Evite el contacto con los ojos, puede causar irritación
 <br>5.3.7.10.8 Se podrá incluir el logotipo del Factor UVA, el cual deberá indicarse mediante las siglas "UVA" impresas dentro de un círculo simple y cuyo diámetro no deberá exceder la altura con que se indique el número FPS.
 <br>Los productos que ofrezcan protección solar como función secundaria, no se consideran protectores solares por lo que no les aplican estas leyendas.
 <br>5.3.7.11 En productos cuya función primaria sea la de broncear éstos deben tener un FPS de 2 a 4 (valor medido 2 a 5.9) y declararlo:
 <br>5.3.7.11.1 Que s e indique el valor del Factor de Protección Solar (FPS), en caso de que se utilicen las siglas FPS o SPF, señalar su significado
 <br>5.3.7.11.2 Que suspenda su empleo si se presentan signos de irritación
 <br>5.3.7.11.3 Que no permanezca mucho tiempo expuesto al sol
 <br>5.3.7.11.4 Que se m antenga a los bebés y niños pequeños fuera de la luz solar directa
 <br>5.3.7.11.5 Que l a exposición excesiva al sol es un riesgo importante para la salud
 <br>5.3.7.11.6 Que no se recomienda para niños y personas con piel sensible al sol
 <br>5.3.7.12 En desodorantes femeninos en aerosol previstos para el uso en el área genital:
 <br>5.3.7.12.1 Este producto es exclusivo para uso externo solamente y no debe ser aplicado a piel con heridas, irritada o con escozor
 <br>5.3.7.13 En productos cuya presentación sea en ampolletas, iguales a la presentación farmacéutica, debe figurar en el envase múltiple o en cada ampolleta el texto: "no ingerible" "no inyectable"
 <br>5.3.7.14 En los productos cuya presentación es en envases presurizados (aerosol), además de las leyendas precautorias que se requieran conforme al producto de que se trate, las siguientes:
 <br>5.3.7.14.1 Que no se aplique cerca de los ojos o flama
 <br>5.3.7.14.2 Que no se exponga al calor
 <br>5.3.7.14.3 Que no se queme, ni perfore el envase
 <br>5.3.7.14.4 Que no se deje al alcance de los niños
 <br>5.3.7.15 En los productos inflamables, además de las leyendas precautorias que se requieran conforme al producto de que se trate:
 <br>5.3.7.15.1 Que es inflamable
 <br>5.3.7.15.2 Que no se aplique cerca de los ojos o piel irritada
 <br>5.3.7.15.3 Que no se deje al alcance de los niños
 <br>5.3.7.16 En productos que contengan ácido bórico y boratos (exceptuando productos para el baño y para la ondulación del cabello):
 <br>5.3.7.16.1 Que no se aplique a niños menores de tres años
 <br>5.3.7.16.2 Que no se aplique en piel irritada o lastimada (sólo si la concentración de borato soluble libre excede 1.5% expresado en ácido bórico masa / masa)
 <br>5.3.7.17 En productos que contengan tetraboratos:
 <br>5.3.7.17.1 En productos para el baño:
 <br>5.3.7.17.1.1 Que no se use en niños menores de tres años
 <br>5.3.7.17.2 En productos para el cabello:
 <br>5.3.7.17.2.1 Enjuagar abundantemente
 <br>5.3.7.17.3 En talcos:
 <br>5.3.7.17.3.1 Que no se use en niños menores de tres años
 <br>5.3.7.17.3.2 No utilizar en pieles escoriadas o irritadas
 <br>5.3.7.18 En productos para niños que contengan ácido salicílico y sus sales, excepto en shampoos: D.O.F. 14/02/2014
 <br>5.3.7.18.1 Que no se use en niños menores de tres años
 <br>5.3.7.19 En los productos que contengan diclorofeno, clorobutanol, cloroacetamida, timerosal compuestos fenilmercúricos (ya sea ácido o sales) u oxibenzona:
 <br>5.3.7.19.1 Indicar que lo contiene mediante la leyenda correspondiente
 <br>5.3.7.20 Si el producto contiene más de 0,05% de glutaraldehído en el producto final:
 </td>
 </tr>
 <tr>
     <td colspan="8" style="font-size: 6pt;text-align:left;height: auto;">
 <br>5.3.7.20.1 Indicar que lo contiene mediante la leyenda correspondiente
 <br>5.3.7.21 En productos que permanezcan en la piel, si la concentración de yodopropinil butil carbamato es superior a 0.02%:
 <br>5.3.7.21.1 Indicar que contiene yodo
 <br>5.3.7.22 En productos que contengan más de 2% de amoniaco se indicará que lo contiene.
 <br>5.3.7.23 En productos que contengan ácido tioglicólico, sus sales o esteres:
 <br>5.3.7.23.1 Para todos los productos:
 <br>5.3.7.23.1.1 Indicar que lo contiene mediante la leyenda correspondiente
 <br>5.3.7.23.1.2 Que se mantenga fuera del alcance de los niños
 <br>5.3.7.23.1.3 Que se siga el modo de empleo
 <br>5.3.7.23.1.4 Que se evite el contacto con los ojos
 <br>5.3.7.23.1.5 En caso de contacto con los ojos enjuague con abundante agua. Consulte al médico
 <br>5.3.7.23.2 Para el caso de productos para el cabello además de lo anterior:
 <br>5.3.7.23.2.1 Utilizar guantes adecuados
 <br>5.3.7.23.3 Para el caso de los Esteres del ácido tioglicólico además de lo anterior:
 <br>5.3.7.23.3.1 Puede causar sensibilización en caso de contacto con la piel
 <br>5.3.7.23.4 Para los productos para el cabello de uso profesional además de lo anterior, indicar:
 <br>5.3.7.23.4.1 Que es para uso profesional
 <br>5.3.7.24 En productos que contengan clorhidrato de aluminio / zirconio y sus complejos de glicina:
 <br>5.3.7.24.1 Que no se aplique sobre la piel irritada, o lastimada
 <br>5.3.7.25 En productos que contengan disulfuro de selenio:
 <br>5.3.7.25.1 Indicar que lo contiene mediante la leyenda correspondiente
 <br>5.3.7.25.2 Que se evite el contacto con los ojos y la piel lastimada
 <br>5.3.7.26 En productos que contengan peróxidos excepto cuando su uso sea como conservador:
 <br>5.3.7.26.1 Se deben usar guantes protectores (sólo cuando se trate de tratamientos capilares)
 <br>5.3.7.26.2 Que se evite el contacto con los ojos
 <br>5.3.7.26.3 Que en caso de contacto con los ojos se laven inmediatamente con agua
 <br>5.3.7.26.4 Indicar que lo contiene mediante la leyenda correspondiente
 <br>5.3.7.26.5 En productos profesionales además se debe indicar: Reservado a profesionales
 <br>5.3.7.27 En productos que contengan benzalconio como cloruro, bromuro o sacarinato:
 <br>5.3.7.27.1 Que se evite el contacto con los ojos
 <br>5.3.7.28 En productos que contengan ácido oxálico sus ésteres y sus sales:
 <br>5.3.7.28.1 Reservado a los profesionales
 <br>5.3.7.29 En productos que contengan Sulfuros alcalinos y alcalinotérreos:
 <br>5.3.7.29.1 Que se mantenga fuera del alcance de los niños
 <br>5.3.7.29.2 Que se evite el contacto con los ojos
 <br>5.3.7.30 En productos que contengan Hidróxido de estroncio:
 <br>5.3.7.30.1 Que se mantenga alejado del alcance de los niños
 <br>5.3.7.30.2 Que se evite el contacto con los ojos
 <br>5.3.7.31 En productos que contengan Nitrato de plata:
 <br>5.3.7.31.1 Indicar que lo contiene
 <br>5.3.7.31.2 Que en caso de contacto con los ojos, lavarse inmediatamente con agua

            </td>
        </tr>



</table>



<?php include($data['config']['footer']); ?>

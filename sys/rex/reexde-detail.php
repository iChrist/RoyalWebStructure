<?php
    $result = array();
    if ($data['datos']) {
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skSolicitudPrevio"  id="skSolicitudPrevio" value="<?php echo (isset($result['skSolicitudPrevio'])) ? $result['skSolicitudPrevio'] : ''; ?>">
    <div class="form-body">
      <div class="row">
            <label class="text-right col-md-2"><b>C&oacute;digo</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['codigo'] ? utf8_encode($result['codigo']) : ' N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Estatus</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Estatus'] ? utf8_encode($result['Estatus']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
            <label class="text-right col-md-2"><b>Referencia</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Referencia'] ? utf8_encode($result['Referencia']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Pedimento</b></label>
            <div class="col-md-4">
              <p class="text-left">
                <?php echo $result['Pedimento'] ? utf8_encode($result['Pedimento']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <!--/row-->
      <div class="row">
            <label class="text-right col-md-2"><b>Propietario</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Propietario'] ? utf8_encode($result['Propietario']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha Creacion</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['FechaCreacion'] ? date('d/m/Y H:i:s', strtotime($result['FechaCreacion'])) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Cliente</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Importador'] ? utf8_encode($result['Importador']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Usuario Creación</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['UsuarioCreacion'] ? utf8_encode($result['UsuarioCreacion']) : 'N/D'; ?>
              </p>
            </div>
      </div>



      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Guia Master</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['GuiaMaster'] ? utf8_encode($result['GuiaMaster']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Guia House</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['GuiaHouse'] ? utf8_encode($result['GuiaHouse']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Mercanc&iacute;a</b></label>
            <div class="col-md-10">
              <p class="text-left">
                 <?php echo $result['Mercancia'] ? utf8_encode($result['Mercancia']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Almac&eacute;n</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo (isset($result['Almacen'])) ? utf8_encode($result['Almacen']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Nº de Bultos</b></label>
            <div class="col-md-4">
              <p class="">
                 <?php echo (isset($result['iBultos'])) ? utf8_encode($result['iBultos']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Deposito</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo (isset($result['Deposito'])) ? utf8_encode("$ ".number_format($result['Deposito'],2)) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Saldo</b></label>
            <div class="col-md-4">
              <p class="">
                 <?php echo (isset($result['Saldo'])) ? utf8_encode("$ ".number_format($result['Saldo'],2)) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
        <label class="text-right col-md-2"><b>Conceptos </b></label>
        <div class="col-md-10">
          <table class="table table-striped">
            <thead>
              <tr>
                <th width="100%"> Concepto</th>
                <th nowrap="nowrap"> Divisa</th>
                <th nowrap="nowrap"> Cantidad</th>
                <th nowrap="nowrap"> Importe</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = "";
              if($data['conceptos']) {
                $i=0;
                while ($rConceptos = $data['conceptos']->fetch_assoc()) {
                    if($i==0){
                      $total = $rConceptos['Total'];
                    }
                      ?>
                      <tr>
                        <td><?php echo $rConceptos['Concepto'];?></td>
                        <td nowrap="nowrap"><?php echo $rConceptos['skDivisa'];?></td>
                        <td nowrap="nowrap"><?php echo $rConceptos['iCantidad'];?></td>
                        <td nowrap="nowrap">$ <?php echo number_format($rConceptos['dImporte'],2);?></td>
                      </tr>

                      <?php
                      $i++;
                  }//ENDIF
                  ?>

                  <tr>
                    <td></td>
                    <td></td>
                    <td style="float:right;"><b>TOTAL</b></td>
                    <td nowrap="nowrap"><b>$ <?php echo ($total ?  number_format($total,2) : '')?></b></td>
                  </tr>
                <?php }
              ?>

            </tbody>


          </table>
        </div>
      </div>


    <!-- <div class="row">
            <label class="text-right col-md-2"><b>Fecha de Revalidaci&oacute;n</b></label>
            <div class="col-md-4">
              <p class="text-left">
                <?php echo $result['FechaRevalidacion'] ? date('d/m/Y H:i:s', strtotime($result['FechaRevalidacion'])) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha de Previo</b></label>
            <div class="col-md-4">
              <p class="">
                <?php echo $result['FechaPrevio'] ? date('d/m/Y H:i:s', strtotime($result['FechaPrevio'])) : 'N/D'; ?>
              </p>
            </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Fecha de Clasifiaci&oacute;n</b></label>
            <div class="col-md-4">
              <p class="text-left">
                <?php echo $result['FechaClasificacion'] ? date('d/m/Y H:i:s', strtotime($result['FechaClasificacion'])) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha de Glosa</b></label>
            <div class="col-md-4">
              <p class="">
                <?php echo $result['FechaGlosa'] ? date('d/m/Y H:i:s', strtotime($result['FechaGlosa'])) : 'N/D'; ?>
              </p>
            </div>
      </div>

      <div class="row">
            <label class="text-right col-md-2"><b>Fecha de Captura</b></label>
            <div class="col-md-4">
              <p class="text-left">
                <?php echo $result['FechaCapturaPedimento'] ? date('d/m/Y H:i:s', strtotime($result['FechaCapturaPedimento'])) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha de Facturaci&oacute;n</b></label>
            <div class="col-md-4">
              <p class="">
                <?php echo $result['FechaFacturacion'] ? date('d/m/Y H:i:s', strtotime($result['FechaFacturacion'])) : 'N/D'; ?>
              </p>
            </div>
      </div>
    -->
      <!--<div class="row">
        <div class="col-md-12">
          <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
            </div>
          </div>
        </div>
    </div>-->
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Fotos</b></label>
            <div class="col-md-8">
      									<div class="margin-top-10">
      										<div class="row mix-grid">
                            <?php
                            if ($data['myFotos']) {
                                while ($rFotos = $data['myFotos']->fetch_assoc()) {
                                    ?>
                                    <div class="col-md-3 col-sm-4 mix category_1" style="min-height:169px; min-width:229px;max-height:169px; max-width:229px;" >
              												<div class="mix-inner" style="min-height:169px; min-width:229px;max-height:169px; max-width:229px;">
              													<img  class="img-responsive" src="<?php echo SYS_URL.SYS_PROJECT.$rFotos['sUbicacion']; ?>" alt="">
              													<div class="mix-details center">
              														<a class="mix-preview fancybox-button" href="<?php echo SYS_URL.SYS_PROJECT.$rFotos['sUbicacion']; ?>"data-rel="fancybox-button"><i class="fa fa-search"></i></a>
              													</div>
              												</div>
              											</div>
                                    <?php

                                }//ENDIF
                            }else{
                              ?>
                                <div class="col-md-10">
                                  <h3>No hay fotos cargadas para esta Referencia</h3>
                                </div>
                          <?php
                            }//ENDWHILE
                            ?>




      										</div>
      									</div>





            </div>
      </div>


        <div class="clearfix"></div>
        <hr>
</div>
    <div class="row">
        <div class="col-md-12">
            <label class="text-right col-md-2"><b>Archivos</b></label>
            <div class="col-md-8">
                <?php
                    if ($data['filesDocTipo']) {
                ?>
                    <ul>
                <?php
                    while ($row = $data['filesDocTipo']->fetch_assoc()) {
                ?>
                    <li><a href="<?php echo SYS_URL . SYS_PROJECT . $row['sUbicacion']; ?>" target="_blank"><?php echo $row['sNombre']; ?></a></li>
                <?php
                    }//ENDWHILE
                ?>
                    </ul>
                <?php
              }else{
                ?>
                <div class="col-md-10">
                  <h3>No hay documentos cargados para esta Referencia</h3>
                </div>

              <?php
              }//ENDIF
                ?>
            </div>
        </div>
      </div>

    </div>
</form>

<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }

     /*echo "<PRE>";
      print_r($result);
      echo "</PRE>";*/
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skSolicitudPrevio"  id="skSolicitudPrevio" value="<?php echo (isset($result['skSolicitudPrevio'])) ? $result['skSolicitudPrevio'] : '' ; ?>">
    <div class="form-body">
      <div class="row">
            <label class="text-right col-md-2"><b>C&oacute;digo</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['codigo'] ? utf8_encode($result['codigo']) : ' N/D') ; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Estatus</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['Estatus'] ? utf8_encode($result['Estatus']) : 'N/D') ; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
            <label class="text-right col-md-2"><b>Propietario</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['propietario'] ? utf8_encode($result['propietario']) : 'N/D') ; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha Solicitud</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['fechaSolicitud'] ? date('d/m/Y H:i:s', strtotime($result['fechaSolicitud'])) : 'N/D') ; ?>
              </p>
            </div>

        <!--/span-->
      </div>
      <!--/row-->

      <div class="row">
            <label class="text-right col-md-2"><b>Cliente</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['importador'] ? utf8_encode($result['importador']) : 'N/D') ; ?>
              </p>
            </div>
        <!--/span-->
            <label class="text-right col-md-2"><b>Recinto</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['recinto'] ? utf8_encode($result['recinto']) : 'N/D') ; ?>
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
            <label class="text-right col-md-2"><b>Usuario Creación</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['usuarioCreacion'] ? utf8_encode($result['usuarioCreacion']) : 'N/D') ; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Usuario Ejecutivo</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['usuarioEjecutivo'] ? utf8_encode($result['usuarioEjecutivo']) : 'N/D') ; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Usuario Tramitador</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['usuarioTramitador'] ? utf8_encode($result['usuarioTramitador']) : 'N/D') ; ?>
              </p>
            </div>
      </div>
        <!--/span-->
        <div class="col-md-6">

        </div>
        <!--/span-->

      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Mbl</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['mbl'] ? utf8_encode($result['mbl']) : 'N/D') ; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Contenedor</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['contenedor'] ? utf8_encode($result['contenedor']) : 'N/D') ; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Sello de Origen</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['selloOrigen'] ? utf8_encode($result['selloOrigen']) : 'N/D') ; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Sello Final</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo ($result['selloFinal'] ? utf8_encode($result['selloFinal']) : 'N/D') ; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Numero de Factura</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo (isset($result['numeroFactura'])) ? utf8_encode($result['numeroFactura']) : 'N/D' ; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Pais de Origen</b></label>
            <div class="col-md-4">
              <p class="">
                 <?php echo (isset($result['paisOrigen'])) ? utf8_encode($result['paisOrigen']) : 'N/D' ; ?>
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
            <label class="text-right col-md-2"><b>Fotos del Previo</b></label>
            <div class="col-md-8">


      									<div class="margin-top-10">
      										<!--<ul class="mix-filter">
      											<li class="filter btn" data-filter="all">
      												All
      											</li>

      										</ul>-->
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
                            }//ENDWHILE
                            ?>
      											<!--<div class="col-md-3 col-sm-4 mix category_1">
      												<div class="mix-inner">
      													<img class="img-responsive" src="http://localhost/RoyalWebStructure/sys/pre/fotos/17878e998ac52bd84834d29570a65d7a.png" alt="">
      													<div class="mix-details">
      														<a class="mix-preview fancybox-button" href="http://localhost/RoyalWebStructure/sys/pre/fotos/17878e998ac52bd84834d29570a65d7a.png" title="Project Name" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
      													</div>
      												</div>
      											</div>-->



      										</div>
      									</div>





            </div>
      </div>







        <div class="clearfix"></div>
        <hr>
</div>

    </div>
</form>

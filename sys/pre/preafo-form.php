<?php
    $result = array();
    if ($data['datos']) {
        $result = $data['datos']->fetch_assoc();
    }
    $ArrayListado = array();
    if($data['myFotos']) {
      if($data['myFotos']->num_rows > 0){
  			 while($row = $data['myFotos']->fetch_assoc()){
           array_push($ArrayListado,array('id' => $row{'skFotoPrevio'},
           'src' => SYS_URL.SYS_PROJECT.$row{'sUbicacion'},
           'param' => 'myFiles[]',
           'size' => '',
           'fileName' => ''));
  			 }
  		 }
    }
  //  print_r($ArrayListado);

?>
<!-- BEGIN PAGE LEVEL STYLES (DROPZONE) -->
<link href="<?php echo SYS_URL ?>core/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES (DROPZONE) -->
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
            <label class="text-right col-md-2"><b>Propietario</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['propietario'] ? utf8_encode($result['propietario']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha Solicitud</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['fechaSolicitud'] ? date('d/m/Y H:i:s', strtotime($result['fechaSolicitud'])) : 'N/D'; ?>
              </p>
            </div>

        <!--/span-->
      </div>
      <!--/row-->

      <div class="row">
            <label class="text-right col-md-2"><b>Cliente</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['importador'] ? utf8_encode($result['importador']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
            <label class="text-right col-md-2"><b>Recinto</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['recinto'] ? utf8_encode($result['recinto']) : 'N/D'; ?>
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
                 <?php echo $result['usuarioCreacion'] ? utf8_encode($result['usuarioCreacion']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Usuario Ejecutivo</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['usuarioEjecutivo'] ? utf8_encode($result['usuarioEjecutivo']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Usuario Tramitador</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['usuarioTramitador'] ? utf8_encode($result['usuarioTramitador']) : 'N/D'; ?>
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
                 <?php echo $result['mbl'] ? utf8_encode($result['mbl']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Contenedor</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['contenedor'] ? utf8_encode($result['contenedor']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Sello de Origen</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['selloOrigen'] ? utf8_encode($result['selloOrigen']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Sello Final</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['selloFinal'] ? utf8_encode($result['selloFinal']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Numero de Factura</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo (isset($result['numeroFactura'])) ? utf8_encode($result['numeroFactura']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Pais de Origen</b></label>
            <div class="col-md-4">
              <p class="">
                 <?php echo (isset($result['paisOrigen'])) ? utf8_encode($result['paisOrigen']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
        <div class="clearfix"></div>
        <div class="row">
          <label class="control-label col-md-2">Fotos <span aria-required="true" class="required"> * </span> </label>
          <div class="dropzone col-md-9" id="myDropzone" >
              <?php
                Core_Functions::printDropzoneImages($ArrayListado);
              ?>

          </div>

        </div>
    </div>
</form>
<div class="clearfix"></div>
<!-- BEGIN PAGE LEVEL PLUGINS (DROPZONE) -->
<script src="<?php echo SYS_URL ?>core/assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/lib/form-dropzone.js"></script>
<!-- END PAGE LEVEL PLUGINS (DROPZONE) -->
<script type="text/javascript">

    $(document).ready(function(){
      FormDropzone.init({
          url: "cambiarCuandoSeaCustom",
          paramName: "myFiles",
          acceptedFiles: 'image/*',
          maxFilesize: 2,
          uploadMultiple: true,
          autoProcessQueue: false
      });

      /* VALIDATIONS */
          isValid = $("#_save").validate({
              errorElement: 'span', //default input error message container
              errorClass: 'help-block', // default input error message class
              focusInvalid: false, // do not focus the last invalid input
              ignore: "",
              rules:{

              },
              invalidHandler: function (event, validator) { //alerta de error de visualización en forma de presentar
                  $('.alert-success').hide();
                  $('.alert-danger').show();
                  App.scrollTo($('.alert-danger'), -200);
              },
              errorPlacement: function (error, element) { // hacer la colocación de error para cada tipo de entrada
                  var icon = $(element).parent('.input-icon').children('i');
                  icon.removeClass('fa-check').addClass("fa-warning");
                  icon.attr("data-original-title", $('.alert-danger').text()).tooltip({'container': 'body'});
                  if (element.parent(".input-group").size() > 0) {
                      error.insertAfter(element.parent(".input-group"));
                  } else if (element.attr("data-error-container")) {
                      error.appendTo(element.attr("data-error-container"));
                  } else if (element.parents('.radio-list').size() > 0) {
                      error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                  } else if (element.parents('.radio-inline').size() > 0) {
                      error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                  } else if (element.parents('.checkbox-list').size() > 0) {
                      error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                  } else if (element.parents('.checkbox-inline').size() > 0) {
                      error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                  } else {
                      error.insertAfter(element); // Para otros insumos, sólo realizar comportamiento predeterminado (llamar messages)
                  }
              },
              highlight: function (element) { // entradas de error Hightlight
                  $(element).closest('.form-group').addClass('has-error'); // conjunto de clases de error
              },
              unhighlight: function (element) { // revertir el cambio realizado por hightlight
              },
              success: function (label, element) {
                  var icon = $(element).parent('.input-icon').children('i');
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // conjunto de clases de éxito con el grupo control
                  icon.removeClass("fa-warning").addClass("fa-check");
              },
              messages:{

              }
          });


    });
</script>

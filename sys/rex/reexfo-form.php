<?php
    $result = array();
    if ($data['datos']) {
        $result = $data['datos']->fetch_assoc();
    }

    $ArrayListado = array();
    if($data['myFotos']) {
      if($data['myFotos']->num_rows > 0){
  			 while($row = $data['myFotos']->fetch_assoc()){
           array_push($ArrayListado,array('id' => $row{'skFotoReferencia'},
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
    <input type="hidden" name="skReferenciaExterna"  id="skReferenciaExterna" value="<?php echo (isset($result['skReferenciaExterna'])) ? $result['skReferenciaExterna'] : ''; ?>">
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

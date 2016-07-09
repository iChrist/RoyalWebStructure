<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
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
        <label class="control-label col-md-2"><b>Tramitador</b> <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-4">
            <select name="skUsuarioTramitador" id="skUsuarioTramitador" class="form-control form-filter input-sm">
                <option value="">- Tramitador -</option>
                <?php
                if ($data['tramitadores']) {
                    while ($rTramitador = $data['tramitadores']->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $rTramitador['skUsers']; ?>" <?php echo (isset($result['skUsuarioTramitador'])) ? ($result['skUsuarioTramitador'] == $rTramitador['skUsers'] ? 'selected' : '' ) : ''; ?> > <?php echo utf8_encode($rTramitador['sName']); ?> </option>
                        <?php
                    }//ENDIF
                }//ENDWHILE
                ?>
            </select>
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


        <div id="dvDatos">
        </div>
        <div class="clearfix"></div>
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    var iTipoTarifa = 0;
    function obtenerDatos(){
    	  $('.page-title-loading').css('display','inline');
    	 $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
                $("#dvDatos").html(data);
                $('.page-title-loading').css('display','none');
                });
    			}
    $(document).ready(function(){

        // VALIDADOR PARA OBTENER DATOS POR REFERENCIA //
        $.validator.addMethod(
            "obtenerDatos",
            function(value, element) {
                if(obtenerDatos()){
                    return true;
                }else{
                    return false;
                }
            },
            "La referencia no existe."
        );
        // VALIDADOR DE SUMA DE PORCENTAJE //

        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ":hidden",
            rules:{
              sReferencia:{
                    required: true,
                     remote: {
                      url: "",
                      type: "post",
                      data: {
                        sReferencia: function (){return $( "#sReferencia" ).val();},
                        axn: "validarReferencia",
                        skSolicitudRevalidacion:  function (){return $( "#skSolicitudRevalidacion" ).val();}
                      }
                    }

                },

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
              sReferencia:{
                  required:"Ingresa una Referencia",
                  remote: function(){
                      return 'La referencia "'+$("#sReferencia").val()+'" no Existe.';
                  }
              },
            }
        });
    });
</script>

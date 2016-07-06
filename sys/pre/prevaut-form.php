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
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>C&oacute;digo</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['codigo'])) ? utf8_encode($result['codigo']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Estatus</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['Estatus'])) ? utf8_encode($result['Estatus']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Propietario</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['propietario'])) ? utf8_encode($result['propietario']) : '' ; ?>
              </p>
            </div>
        </div>
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Fecha Solicitud</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['fechaSolicitud'])) ? date('d/m/Y H:i:s', strtotime($result['fechaSolicitud'])) : '' ; ?>
              </p>
            </div>

        </div>
        <!--/span-->
      </div>
      <!--/row-->

      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Cliente</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['importador'])) ? utf8_encode($result['importador']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Recinto</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['recinto'])) ? utf8_encode($result['recinto']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Usuario Creación</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['usuarioCreacion'])) ? utf8_encode($result['usuarioCreacion']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Usuario Ejecutivo</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['usuarioEjecutivo'])) ? utf8_encode($result['usuarioEjecutivo']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Usuario Tramitador</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['usuarioTramitador'])) ? utf8_encode($result['usuarioTramitador']) : 'N/D' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">

        </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Mbl</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['mbl'])) ? utf8_encode($result['mbl']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Contenedor</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['contenedor'])) ? utf8_encode($result['contenedor']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Sello de Origen</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['selloOrigen'])) ? utf8_encode($result['selloOrigen']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Sello Final</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['selloFinal'])) ? utf8_encode($result['selloFinal']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Numero de Factura</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['numeroFactura'])) ? utf8_encode($result['numeroFactura']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <label class="control-label col-md-4"><b>Pais de Origen</b></label>
            <div class="col-md-8">
              <p class="form-control-static">
                 <?php echo (isset($result['paisOrigen'])) ? utf8_encode($result['paisOrigen']) : '' ; ?>
              </p>
            </div>
        </div>
        <!--/span-->
      </div>

        <div id="dvDatos">
        </div>






        <div class="clearfix"><hr></div>
        <div class="form-group">
          <label class="control-label col-md-2">Rechazo de Solicitud</label>
          <div class="col-md-10">
          <textarea name="sObservacionesRechazo"placeholder="Motivo por el cual Rechaza la solicitud"class="form-control" rows="3"></textarea>
          </div>
        </div>


        <div class="clearfix"></div>
        <hr>


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

                },skUsuarioEjecutivo:{
                    required: true
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
              skUsuarioEjecutivo:{
                  required: true
              },
            }
        });
    });
</script>

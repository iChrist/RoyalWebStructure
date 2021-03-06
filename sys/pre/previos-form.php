<?php

    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
  /*  echo "<PRE>";
    print_r($data['autoridadesPrevios']);
    echo "</PRE>";
*/
    $arrayAutoridades = array();
  	if(isset($data['autoridadesPrevios']))
      {
  		if($data['autoridadesPrevios']->num_rows > 0){
  			 while($row = $data['autoridadesPrevios']->fetch_assoc()){
  				$arrayAutoridades[] = $row{'skAutoridad'};
  			 }
  		 }
      }

?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skSolicitudPrevio"  id="skSolicitudPrevio" value="<?php echo (isset($result['skSolicitudPrevio'])) ? $result['skSolicitudPrevio'] : '' ; ?>">
    <div class="form-body">

        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
              <div class="input-icon right"> <i class="fa"></i>
                <input type="text" name="sReferencia" id="sReferencia" <?php echo (isset($result['skSolicitudPrevio'])) ? 'disabled': '' ; ?> class="form-control" onChange="obtenerDatos();" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? htmlentities(utf8_encode($result['sReferencia'])) : '' ; ?>" >
              </div>
            </div>
        </div>
        <hr>
        <div id="dvDatos">


        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Fecha de Programaci&oacute;n</label>
          <div class="col-md-4">
            <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
              <input type="text" id="dFechaProgramacion" name="dFechaProgramacion" class="form-control" value="<?php echo (isset($result['dFechaProgramacion']) ?  utf8_encode(date('d-m-Y', strtotime($result['dFechaProgramacion']))) : ''); ?>" >
              <span class="input-group-btn">
              <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
              </span>
            </div>
          </div>
        <!--  <label class="control-label col-md-2">Cliente <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-4">
              <select name="skSocioImportador" id="skSocioImportador" class="form-control form-filter input-sm">
                  <option value="">- Cliente -</option>
                  <?php
                  if ($data['importador']) {
                      while ($rImportador = $data['importador']->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $rImportador['skSocioEmpresa']; ?>" <?php echo (isset($result['skSocioImportador'])) ? ($result['skSocioImportador'] == $rImportador['skSocioEmpresa'] ? 'selected' : '' ) : ''; ?> > <?php echo utf8_encode($rImportador['sNombre']); ?> </option>
                          <?php
                      }
                  }
                  ?>
              </select>
          </div>-->
          <input type="hidden" name="skSocioImportador" id="skSocioImportador" value="">
          <input type="hidden" name="sBlMaster" id="sBlMaster" value="">
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Recinto<span aria-required="true" class="required"> * </span> </label>
          <div class="col-md-4">
            <select name="skSocioRecinto" id="skSocioRecinto" class="form-control form-filter input-sm">
                <option value="">- Recinto -</option>
                <?php
                if ($data['recinto']) {
                    while ($rRecinto = $data['recinto']->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $rRecinto['skSocioEmpresa']; ?>" <?php echo (isset($result['skSocioRecinto'])) ? ($result['skSocioRecinto'] == $rRecinto['skSocioEmpresa'] ? 'selected' : '' ) : ''; ?> > <?php echo utf8_encode($rRecinto['sNombre']); ?> </option>
                        <?php
                    }//ENDIF
                }//ENDWHILE
                ?>
            </select>
          </div>
          <label class="control-label col-md-2">Tramitador</label>
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
        <div class="form-group">
          <label class="control-label col-md-2">Sello de Origen</label>
          <div class="col-md-4">
            <div class="input-icon right"> <i class="fa"></i>
              <input type="text" name="sSelloOrigen" id="sSelloOrigen" class="form-control" placeholder="Sello de Origen" value="<?php echo (isset($result['sSelloOrigen'])) ? htmlentities(utf8_encode($result['sSelloOrigen'])) : '' ; ?>">
            </div>
          </div>
          <label class="control-label col-md-2">Sello Final</label>
          <div class="col-md-4">
            <div class="input-icon right"> <i class="fa"></i>
              <input type="text" name="sSelloFinal" id="sSelloFinal" class="form-control" placeholder="Sello Final" value="<?php echo (isset($result['sSelloFinal'])) ? htmlentities(utf8_encode($result['sSelloFinal'])) : '' ; ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Numero de Factura</label>
          <div class="col-md-4">
            <div class="input-icon right"> <i class="fa"></i>
              <input type="text" name="sNumeroFactura" id="sNumeroFactura" class="form-control" placeholder="Numero de Factura" value="<?php echo (isset($result['sNumeroFactura'])) ? htmlentities(utf8_encode($result['sNumeroFactura'])) : '' ; ?>">
            </div>
          </div>
          <label class="control-label col-md-2">Pais Origen</label>
          <div class="col-md-4">
            <div class="input-icon right"> <i class="fa"></i>
              <input type="text" name="sPais" id="sPais" class="form-control" placeholder="Pais Origen" value="<?php echo (isset($result['sPais'])) ? htmlentities(utf8_encode($result['sPais'])) : '' ; ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Tipo de Previo</label>
          <div class="col-md-4">
              <select name="skTipoPrevio" id="skTipoPrevio" class="form-control form-filter input-sm">
                  <option value="">- Tipo de Previo -</option>
                  <?php
                  if ($data['tiposPrevios']) {
                      while ($rTipoPrevio = $data['tiposPrevios']->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $rTipoPrevio['skTipoPrevio']; ?>" <?php echo (isset($result['skTipoPrevio'])) ? ($result['skTipoPrevio'] == $rTipoPrevio['skTipoPrevio'] ? 'selected' : '' ) : ''; ?> > <?php echo utf8_encode($rTipoPrevio['sNombre']); ?> </option>
                          <?php
                      }//ENDIF
                  }//ENDWHILE
                  ?>
              </select>
          </div>

        </div>
        <div class="clearfix"><hr></div>
        <div class="form-group">
            <label class="control-label col-md-2">Autoridades <span aria-required="true" class="required">  </span>
            </label>
            <div class="col-md-10">
                <div class="row">
                    <div class="checkbox-list">

                            <?php
                            if($data['autoridades'])
                            {
                                foreach ($data['autoridades'] as $autoridades)
                                {
                                ?>
                                    <div class="col-md-4">
                                           <label> <input type="checkbox" name="skAutoridad[]" value="<?php echo $autoridades['skAutoridad']; ?>" <?php echo (in_array($autoridades['skAutoridad'], $arrayAutoridades) ? 'checked' : '')?>   />
                                            <?php echo $autoridades['sNombre']; ?>    <br/>&nbsp;</label>

                                    </div>
                                <?php
                                }
                            }
                            ?>
                    </div>

                </div>
            </div>

        </div>






    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    function obtenerDatos(){
        if($("#sReferencia").val().trim() != ''){
    	           $('.page-title-loading').css('display','inline');
                 $('.filter-submit').click();
    	           $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
                    $("#dvDatos").html(data);
                  //POST para traer cliente, BL y Contenedor
                  if($("#skSolicitudPrevio").val().trim() == ''){
                    $.post("",{ axn : "obtenerCliente" , sReferencia : $("#sReferencia").val() }, function(data){
                      $("#skSocioImportador").val(data);
                    });
                    $.post("",{ axn : "obtenerBl" , sReferencia : $("#sReferencia").val() }, function(data){
                     $("#sBlMaster").val(data);
                    });
                  }


                $('.page-title-loading').css('display','none');
                });
          }
    			}
    $(document).ready(function(){
      obtenerDatos();
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
                        skSolicitudPrevio:  function (){return $( "#skSolicitudPrevio" ).val();}
                      }
                    }

                },skSocioImportador:{
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
                      return 'La referencia "'+$("#sReferencia").val()+'" no existe,no contiene una primera clasificacion o ya cuenta con un previo.';
                  }
              },
              skSocioImportador:{
                  required: "Agregar Cliente"
              },
            }
        });
    });
</script>

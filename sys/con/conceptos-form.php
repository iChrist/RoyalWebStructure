<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
    $arrayTramitesConceptos = array();
  	if(isset($data['tramitesconceptos']))
      {
  		if($data['tramitesconceptos']->num_rows > 0){
  			 while($row = $data['tramitesconceptos']->fetch_assoc()){
  				$arrayTramitesConceptos[] = $row{'skTipoTramite'};
  			 }
  		 }
      }
      $arrayEmpresasConceptos = array();
    	if(isset($data['empresasconceptos']))
        {
    		if($data['empresasconceptos']->num_rows > 0){
    			 while($row = $data['empresasconceptos']->fetch_assoc()){
    				$arrayEmpresasConceptos[] = $row{'skTipoEmpresa'};
    			 }
    		 }
        }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skConcepto"  id="skConcepto" value="<?php echo (isset($result['skConcepto'])) ? $result['skConcepto'] : '' ; ?>">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Nombre <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombre" id="sNombre" class="form-control" placeholder="Nombre" value="<?php echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : '' ; ?>" >
                </div>
            </div>
            <label class="control-label col-md-2">Nombre Corto <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombreCorto" id="sNombreCorto" class="form-control" placeholder="Nombre Corto" value="<?php echo (isset($result['sNombreCorto'])) ? utf8_encode($result['sNombreCorto']) : '' ; ?>" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Descripci&oacute;n <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sDescripcion" id="sDescripcion" class="form-control" placeholder="Descripci&oacute;n" value="<?php echo (isset($result['sDescripcion'])) ? utf8_encode($result['sDescripcion']) : '' ; ?>" >
                </div>
            </div>
        </div>
<hr>
<div class="form-group">
    <label class="control-label col-md-2">Tipo de Tr&aacute;mite <span aria-required="true" class="required"> * </span>
    </label>
    <div class="col-md-4">
        <div class="checkbox-list">
            <label>
                <div class="">
                    <span>
                        <input type="checkbox" name="skTipoTramite[]" value="IMPO" <?php echo (in_array("IMPO", $arrayTramitesConceptos) ? 'checked' : '')?>  > Importacion
                    </span>
                </div>
            </label>
            <label>
                <div class="">
                    <span>
                        <input type="checkbox" name="skTipoTramite[]" value="EXPO" <?php echo (in_array("EXPO", $arrayTramitesConceptos) ? 'checked' : '')?>> Exportacion
                    </span>
                </div>
            </label>
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <label class="control-label col-md-2">Tipo de Empresa<span aria-required="true" class="required"> * </span>
    </label>
    <div class="col-md-4">
        <div class="checkbox-list">
            <label>
                <div class="">
                    <span>
                        <input type="checkbox" name="skTipoEmpresa[]" value="LINA" <?php echo (in_array("LINA", $arrayEmpresasConceptos) ? 'checked' : '')?>  > L&iacute;nea Naviera
                    </span>
                </div>
            </label>
            <label>
                <div class="">
                    <span>
                        <input type="checkbox" name="skTipoEmpresa[]" value="RECI" <?php echo (in_array("RECI", $arrayEmpresasConceptos) ? 'checked' : '')?>> Recinto
                    </span>
                </div>
            </label>
            <label>
                <div class="">
                    <span>
                        <input type="checkbox" name="skTipoEmpresa[]" value="CORR" <?php echo (in_array("CORR", $arrayEmpresasConceptos) ? 'checked' : '')?>> Corresponsal
                    </span>
                </div>
            </label>

        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <label class="control-label col-md-2">Divisa <span aria-required="true" class="required"> * </span>
    </label>
    <div class="col-md-4">
      <select class="form-control"id="skDivisa" name="skDivisa">
          <option value="">- Seleccione -</option>
          <option value="USD" <?php echo (isset($result['skDivisa']) &&  $result['skDivisa'] =='USD' ? "selected" : ''); ?>> Dolar Estadounidense</option>
          <option value="MXN" <?php echo (isset($result['skDivisa']) &&  $result['skDivisa'] =='MXN' ? "selected" : ''); ?>> Peso Mexicano</option>

      </select>
    </div>
    <label class="control-label col-md-2">Precio Unitario <span aria-required="true" class="required"> * </span>
    </label>
    <div class="col-md-4">
        <div class="input-icon right">
            <i class="fa"></i>
            <input type="text" name="fPrecioUnitario" id="fPrecioUnitario" class="form-control" placeholder="Precio Unitario" value="<?php echo (isset($result['fPrecioUnitario'])) ? utf8_encode($result['fPrecioUnitario']) : '' ; ?>">
        </div>
    </div>
</div>
<hr>
        <div class="form-group">
            <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <div class="">
                            <span>
                                <input type="radio" name="skStatus" value="AC" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?> checked="checked"> Activo
                            </span>
                        </div>
                    </label>
                    <label>
                        <div class="">
                            <span>
                                <input type="radio" name="skStatus" value="IN" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
                            </span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

    </div>
</form>

<script type="text/javascript">
    var fraccion = 1;
    $(document).ready(function(){

        FormFileUpload.init('?axn=fileUpload');




        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                sNombre:{
                    required: true
                },
                sTitulo:{
                    required: true
                }
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
                sNombre:{
                    required: "Campo obligatorio."
                },
                sNombreCorto:{
                    required: "Campo obligatorio."
                }
            }
        });
    });
</script>

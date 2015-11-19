<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
	
	
/*echo "<pre>";
print_r($data);
echo "</pre>";

*/
?>

<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
  <input type="hidden" name="skSolicitudRevalidacion"  id="skSolicitudRevalidacion" value="<?php echo (isset($result['skSolicitudRevalidacion'])) ? $result['skSolicitudRevalidacion'] : '' ; ?>">
  <div class="form-body">
       
    <div class="form-group">
      <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sReferencia" id="sReferencia" class="form-control" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ; ?>" >
        </div>
      </div>
    </div>
         
    <div class="form-group">
      <label class="control-label col-md-2">Línea Naviera <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skEmpresa" id="skEmpresa" class="form-control form-filter input-sm">
          <option value="">- Línea Naviera -</option>
          <?php
                                    if(isset($data['empresas'])){
                                        while($rEmpresa = $data['empresas']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresa'])) ? ($result['skEmpresa'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']." (".$rEmpresa['sRFC'].")"); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>  
      <div class="form-group">
      <label class="control-label col-md-2">Tramitador <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skEmpresa" id="skEmpresa" class="form-control form-filter input-sm">
          <option value="">- Tramitador -</option>
          <?php
                                    if(isset($data['tramitadores'])){
                                        while($rTramitador = $data['tramitadores']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rTramitador['skUsers']; ?>" <?php echo (isset($result['skUsers'])) ? ($result['skUsers'] == $rTramitador['skUsers'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rTramitador['sName']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>    
    
    <hr>
    <div class="form-group">
      <label class="control-label col-md-2">Observaciones <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="textarea" name="sObservaciones" id="sObservaciones" class="form-control" placeholder="Observaciones" value="<?php echo (isset($result['sObservaciones'])) ? utf8_encode($result['sObservaciones']) : '' ; ?>" >
        </div>
      </div>
    </div>
    
    
    
     
  </div>
</form>
<div class="clearfix"></div>
<form id="fileupload" action="assets/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
  <table role="presentation" class="table table-striped clearfix">
    <tbody class="files">
    </tbody>
  </table>
</form>
<script type="text/javascript">
    var fraccion = 1;
    $(document).ready(function(){
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                sReferencia:{
                    required: true
                },
               
				sObservaciones:{
                    required: true
                },
				
                skEmpresaNaviera:{
                    required: true
                },
				skUsuarioTramitador:{
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
                sReferencia:{
                    required: true
                },
 				Observaciones:{
                    required: true
                },
				
                skEmpresaNaviera:{
                    required: true
                },
				skUsuarioTramitador:{
                    required: true
                }
            }
        });
    }); 
</script>
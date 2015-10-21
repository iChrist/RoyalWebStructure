<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
    $arrayTiposEmpresas = array();
	if(isset($data['tiposEmpresas']))
    {
		if($data['tiposEmpresas']->num_rows > 0){
			 while($row = $data['tiposEmpresas']->fetch_assoc()){
				$arrayTiposEmpresas[] = $row{'skTipoEmpresa'};
			 }
		 }
    }
    $arrayStatus = array();
	if(isset($data['status']))
    {
		if($data['status']->num_rows > 0){
			 while($row = $data['status']->fetch_assoc()){
				$arrayStatus[] = $row{'skStatus'};
			 }
		 }
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form"> 
     <div class="form-body"> 
       
        <div class="form-group">
            <label class="control-label col-md-2">RFC <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sRFC" id="sRFC" class="form-control" placeholder="RFC" value="<?php echo (isset($result['sRFC'])) ? utf8_encode($result['sRFC']) : '' ; ?>" >
                </div>
            </div>
        </div>     
        
        <div class="form-group">
            <label class="control-label col-md-2">Nombre <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombre" id="sNombre" class="form-control" placeholder="Nombre" value="<?php echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : '' ; ?>" >
                </div>
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-2">Nombre Corto <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombreCorto" id="sNombreCorto" class="form-control" placeholder="Nombre Corto" value="<?php echo (isset($result['sNombreCorto'])) ? utf8_encode($result['sNombreCorto']) : '' ; ?>" >
                </div>
            </div>
        </div>
         <div class="clearfix"><hr/></div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Tipo de Empresa <span aria-required="true" class="required"> * </span>  </label>
                                 <?php 
                                if($data['tiposEmpresas'])
                                {
                                ?> 
                                <div class="col-md-4">
                                <select class="form-control"id="skTipoEmpresa" name="skTipoEmpresa">
                                		<option value=""> Seleccionar...</option>
                                	<?php  foreach ($data['tiposEmpresas'] as $profile)  {  ?>
                                		<option value="<?php echo $profile['skTipoEmpresa']; ?>"> <?php echo $profile['sNombre']; ?></option>
                                	<?php }   ?>
                                </select>
                               </div>
                                    <?php
                                    
                                }  ?>
                        
                 
            </div>    
             <div class="form-group">
                <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span></label>
                                 <?php 
                                if($data['status'])
                                {
                                ?> 
                                <div class="col-md-4">
                                <select class="form-control"id="skStatus" name="skStatus">
                                		<option value=""> Seleccionar...</option>
                                	<?php  foreach ($data['status'] as $status)  {  ?>
                                		<option value="<?php echo $status['skStatus']; ?>"> <?php echo $status['sName']; ?></option>
                                	<?php }   ?>
                                </select>
                               </div>
                                    <?php
                                    
                                }  ?>
                        
                 
            </div>        
            
        
        </div>
            
    </div>
</form>
<div class="clearfix"></div>

<script type="text/javascript">
    $(document).ready(function(){
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                skTipoEmpresa:{
                    required: true
                },
                sNombre:{
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
                skTipoEmpresa:{
                    required: "Campo obligatorio."
                },sNombre:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>
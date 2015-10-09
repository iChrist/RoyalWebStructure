<?php
	/*echo "<pre>";
	print_r($arrayPerfilesUsuarios);
	echo "</pre>";*/

    if($data['datos'])
    {
        $result = $data['datos']->fetch_assoc();
    }
	

	$arrayPerfilesUsuarios = array();
	if(isset($data['perfilesusuarios']))
    {
		if($data['perfilesusuarios']->num_rows > 0){
			 while($row = $data['perfilesusuarios']->fetch_assoc()){
				$arrayPerfilesUsuarios[] = $row{'skProfiles'};
			 }
		 }
    }
	
    if($data['error'])
    {
?>
        <div class="alert alert-danger display-hide" style="display: block;">
            <button data-close="alert" class="close"></button>
            <?php echo $data['message']; ?>
        </div>
<?php
    } // ENDIF
    if($data['success'])
    {
?>
        <div class="alert alert-success display-hide" style="display: block;">
            <button data-close="alert" class="close"></button>
            <?php echo $data['message']; ?>
        </div>
<?php
    } // ENDIF
?>
    <input type="hidden" name="skUsers"  id="skUsers" value="<?php echo (isset($result['skUsers'])) ? $result['skUsers'] : '' ; ?>">
    <div class="form-body">
            
            <!-- Alerta de mensajes-->
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                Usted tiene algunos errores en el formulario. Por favor, consulte más abajo.
            </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button>
                Validación del formulario exitoso!
            </div>
            
            
            <div class="form-group">
                <label class="control-label col-md-2">Nombres <span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" name="sName" id="sName" class="form-control" placeholder="" value="<?php echo (isset($result['sName'])) ? utf8_encode($result['sName']) : '' ; ?>" >
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Apellido Paterno<span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" name="sLastNamePaternal" id="sLastNamePaternal" class="form-control" placeholder="" value="<?php echo (isset($result['sLastNamePaternal'])) ? utf8_encode($result['sLastNamePaternal']) : '' ; ?>" >
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Apellido Materno<span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" name="sLastNameMaternal" id="sLastNameMaternal" class="form-control" placeholder="" value="<?php echo (isset($result['sLastNameMaternal'])) ? utf8_encode($result['sLastNameMaternal']) : '' ; ?>" >
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Correo Electrónico <span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="email" name="sEmail" id="sEmail" class="form-control" placeholder="" value="<?php echo (isset($result['sEmail'])) ? $result['sEmail'] : '' ; ?>" >
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Nombre de usuario <span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" name="sUserName" id="sUserName" class="form-control" placeholder="" value="<?php echo (isset($result['sUserName'])) ? $result['sUserName'] : '' ; ?>" >
                    </div>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="control-label col-md-2">Contraseña <span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" name="sPassword" id="sPassword" class="form-control" placeholder="" value="<?php echo (isset($result['sPassword'])) ? $result['sPassword'] : '' ; ?>" >                                            
                    </div>
                </div>
            </div>
            
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
            
            <div class="clearfix"><hr/></div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Perfil del usuario <span aria-required="true" class="required"> * <div class="help-block">( Elija al menos 1 perfil )</div> </span>
                </label>
                <div class="col-md-10">
                    <div class="row">
                        <div class="checkbox-list">
                                                           
                                <?php 
                                if($data['profiles'])
                                {
                                    foreach ($data['profiles'] as $profile)
                                    {
                                    ?>
                                        <div class="col-md-4">
                                               <label> <input type="checkbox" name="skProfiles[]" value="<?php echo $profile['skProfiles']; ?>" <?php echo (in_array($profile['skProfiles'], $arrayPerfilesUsuarios) ? 'checked' : '')?>   />
                                                <?php echo $profile['sName']; ?>    <br/>&nbsp;</label>
                                            
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



<div class="col-md-12">
    <b>Nota:</b>
    <span class="label label-md label-info">
        Se enviar&aacute; correo electr&oacute;nico al usuario con una contrase&ntilde;a autogenerada para el acceso al sistema y posteriormente podr&aacute; cambiarla.
    </span>
</div>



<script type="text/javascript">

    $(document).ready(function(){
        
        var form = $('#_save');
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);
        $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",

            rules:{
                sName:{
                    required: true,
                },
				sLastNamePaternal:{
                    required: true,
                },
				sLastNameMaternal:{
                    required: true,
                },
                sEmail:{
                    required: true,
                    email: true,
                    remote: {
                      url: "",
                      type: "post",
                      data: {
                        sEmail: function (){return $( "#sEmail" ).val();},
                        axn: "validarEmail",
                        skUsers:  function (){return $( "#skUsers" ).val();}
                      }
                    }
                    
                },
                sUserName:{
                    required: true,
                    remote: {
                      url: "",
                      type: "post",
                      data: {
                     	sUserName: function (){return $( "#sUserName" ).val();},
                        axn: "validarUserName",
                        skUsers:   function (){return $( "#skUsers" ).val();}
                      }
                    }
                },
                sPassword:{
                    required: true,
                },
                'skProfiles[]':{
                    required: true,
                    minlength: 1
                    // maxlength: 2
                }
            },
            
            invalidHandler: function (event, validator) { //alerta de error de visualización en forma de presentar              
                success.hide();
                error.show();
                App.scrollTo(error, -200);
            },
            
            errorPlacement: function (error, element) { // hacer la colocación de error para cada tipo de entrada
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");  
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                
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
                $(element)
                    .closest('.form-group').addClass('has-error'); // conjunto de clases de error
            },
            unhighlight: function (element) { // revertir el cambio realizado por hightlight
            },
            
            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // conjunto de clases de éxito con el grupo control
                icon.removeClass("fa-warning").addClass("fa-check");
                
                
            },
            
            messages:{
                sName:{
                    required: "Campo obligatorio.",
                    // lettersonly: "Solo se aceptan letras en el campo 'Nombre Completo'."
                },
				sLastNamePaternal:{
                    required: "Campo obligatorio.",
                    // lettersonly: "Solo se aceptan letras en el campo 'Nombre Completo'."
                },
				sLastNameMaternal:{
                    required: "Campo obligatorio.",
                    // lettersonly: "Solo se aceptan letras en el campo 'Nombre Completo'."
                },
                sEmail:{
                    required: "Campo obligatorio.",
                    email: "Por favor, ingrese una dirección de 'Correo electrónico' valida.",
                    remote: "El correo electrónico ingresado ya está en uso, intente con otro correo electrónico."
                },
                sUserName:{
                    required: "Campo obligatorio.",
                    remote: "El nombre de usuario ingresado ya está en uso, intente con otro nombre de usuario."
                },
                sPassword:{
                    required: "Campo obligatorio.",
                }
            }
    
        });
		
		
    }); 
</script>
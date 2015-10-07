<?php
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
    if($data['error']){
?>
        <div class="alert alert-danger display-hide" style="display: block;">
            <button data-close="alert" class="close"></button>
            <?php echo $data['message']; ?>
        </div>
<?php
    }//ENDIF
    if($data['success']){
?>
        <div class="alert alert-success display-hide" style="display: block;">
            <button data-close="alert" class="close"></button>
            <?php echo $data['message']; ?>
        </div>
<?php
    }//ENDIF
?>
    <input type="hidden" name="skAreas"  id="skAreas" value="<?php echo (isset($result['skAreas'])) ? $result['skAreas'] : '' ; ?>">
    <div class="form-body">
            
        <!-- COMIENZA ALERTA DE MENSAJES DE VALIDACION -->
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            Usted tiene algunos errores en el formulario. Por favor, consulte m&aacute;s abajo.
        </div>
        <div class="alert alert-success display-hide">
            <button class="close" data-close="alert"></button>
            Validaci&oacute;n del formulario exitoso!
        </div>
        <!-- TERMINA ALERTA DE MENSAJES DE VALIDACION -->
            
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
            <label class="control-label col-md-2">Correo Electrónico <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="email" name="sCorreo" id="sCorreo" class="form-control" placeholder="correo@dominio.com" value="<?php echo (isset($result['sCorreo'])) ? $result['sCorreo'] : '' ; ?>" >
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
            
        <div class="clearfix"></div>
            
    </div>
</form>

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
                sNombre:{
                    required: true,
                },
                sCorreo:{
                    required: true,
                    email: true,
                    remote: {
                        url: "",
                        type: "post",
                        data: {
                            axn: "validarEmail",
                            sEmail: $( "#sCorreo" ).val(),
                            skUsers:  $( "#skAreas" ).val()
                        }
                    }
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
                sNombre:{
                    required: "Campo obligatorio."
                },
                sCorreo:{
                    required: "Campo obligatorio.",
                    email: "Por favor, ingrese una direcci&oacute;n de 'Correo electr&oacute;nico' valida.",
                    remote: "El correo electr&oacute;nico ingresado ya est&aacute; en uso, intente con otro correo electr&oacute;nico."
                }
            }
        });
    }); 
</script>
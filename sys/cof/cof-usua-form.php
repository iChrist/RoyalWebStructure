<?php
    if($data['datos'])
    {
        $result = $data['datos']->fetch_assoc();
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
    <input type="hidden" name="skUsers" value="<?php echo (isset($result['skUsers'])) ? $result['skUsers'] : '' ; ?>">
    <div class="row">
        <div class="col-md-12">
            <div id="errorContainer">
                <p>Por favor, corrija los siguientes errores y vuelva a intentarlo:</p>
                <ul />
            </div>
        </div>
    </div>
 
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre completo</label>
            <div class="col-md-4">
                <input type="text" name="sName" id="sName" class="form-control" placeholder="" value="<?php echo (isset($result['sName'])) ? $result['sName'] : '' ; ?>" >                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Correo electr&oacute;nico</label>
            <div class="col-md-4">
                <input type="email" name="sEmail" id="sEmail" class="form-control" placeholder="" id="email" value="<?php echo (isset($result['sEmail'])) ? $result['sEmail'] : '' ; ?>" >                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre de usuario</label>
            <div class="col-md-4">
                <input type="text" name="sUserName" id="sUserName" class="form-control" placeholder="" value="<?php echo (isset($result['sUserName'])) ? $result['sUserName'] : '' ; ?>" >                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Estatus</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="" value="AC" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?> checked="checked"> Activo
                    </label>
                    <label>
                        <input type="radio" name="skStatus" id="" value="IN" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
                    </label>
                </div>
            </div>
        </div>
        
        <div class="clearfix"><hr></div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Perfil del Usuario</label>
            <div class="col-md-10">
                <?php 
                if($data['profiles'])
                {
                ?>
                    <div class="row">
                        <?php
                        foreach ($data['profiles'] as $profile)
                        {
                        ?>
                            <div class="col-md-4">
                                <input type="checkbox" name="skProfiles[]" value="<?php echo $profile['skProfiles']; ?>" /> <?php echo $profile['sName']; ?> <br/>
                                <br />
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php 
                }
                ?>
            </div>
        </div>
        <div class="clearfix"><hr></div>
    </div>
</form>

<div class="col-md-12">
    <b>NOTA:</b>
    <span class="label label-md label-info">
        Se enviar&aacute; correo electr&oacute;nico al usuario con una contrase&ntilde;a autogenerada para el acceso al sistema y posteriormente podr&aacute; cambiarla.
    </span>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       
        $("#_save").validate({
            rules:{
                sName:{
                    required: true,
                    lettersonly: true
                },
                sEmail:{
                    required: true,
                    email: true,
                    remote: {
                      url: "",
                      type: "post",
                      data: {
                        sEmail: function() {
                          return $( "#sEmail" ).val();
                        },
                        axn: "validarEmail"
                      }
                    }
                    
                },
                sUserName:{
                    required: true,
                    remote: {
                      url: "",
                      type: "post",
                      data: {
                        sUserName: function() {
                          return $( "#sUserName" ).val();
                        },
                        axn: "validarUserName"
                      }
                    }
                },
                'skProfiles[]':{
                    required: true,
                    minlength: 1
                    // maxlength: 2
                }
            },
            messages:{
                sName:{
                    required: "Campo 'Nombre completo' obligatorio.",
                    lettersonly: "Solo se aceptan letras en el campo 'Nombre Completo'."
                },
                sEmail:{
                    required: "Campo 'Correo electrónico' obligatorio.",
                    email: "Por favor, ingrese una dirección de 'Correo electrónico' valida.",
                    remote: "El correo electrónico ingresado ya está en uso, intente con otro correo electrónico."
                },
                sUserName:{
                    required: "Campo 'Nombre de usuario' obligatorio.",
                    remote: "El nombre de usuario ingresado ya está en uso, intente con otro nombre de usuario."
                },
                'skProfiles[]':{
                    required: "Debe seleccionar al menos 1 perfil.",
                    minlength: "Debe seleccionar al menos 1 perfil.",
                    // maxlength: "No debe seleccionar mas de {0} perfiles."
                }
            },
            errorContainer: $('#errorContainer'),
            errorLabelContainer: $('#errorContainer ul'),
            wrapper: 'li'
            
        });
    }); 
</script>
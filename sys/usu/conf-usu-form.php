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
    } // ENDIF
    if($data['success']){
?>
<div class="alert alert-success display-hide" style="display: block;">
    <button data-close="alert" class="close"></button>
    <?php echo $data['message']; ?>
</div>
<?php
    } // ENDIF
?>
<form id="_save" method="post" class="form-horizontal form-bordered form-row-stripped" role="form">
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre *</label>
            <div class="col-md-4">
                <input type="text" name="sName" class="form-control" placeholder="Nombre" value="<?php echo (isset($result['sName'])) ? $result['sName'] : '' ; ?>" required>                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Correo electr&oacute;nico *</label>
            <div class="col-md-4">
                <input type="email" name="sEmail" class="form-control" placeholder="Email" value="<?php echo (isset($result['sEmail'])) ? $result['sEmail'] : '' ; ?>" required>                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre de usuario *</label>
            <div class="col-md-4">
                <input type="text" name="sUserName" class="form-control" placeholder="Email" value="<?php echo (isset($result['sUserName'])) ? $result['sUserName'] : '' ; ?>" required>                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Estatus *</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios22" value="AC" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?>> Activo
                    </label>
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios23" value="IN" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="clearfix"><hr></div>
<div class="col-md-12">
    <b>NOTA:</b>
    <span class="label label-md label-info">
        Se enviar&aacute; correo electr&oacute;nico al usuario con una contrase&ntilde;a autogenerada para el acceso al sistema y posteriormente pordr&aacute; cambiarla.
    </span>
</div>
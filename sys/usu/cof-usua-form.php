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

<form id="_save" method="post" class="form-horizontal" role="form">
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre Completo</label>
            <div class="col-md-4">
                <input type="text" name="sName" class="form-control" placeholder="" value="<?php echo (isset($result['sName'])) ? $result['sName'] : '' ; ?>" required>                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Correo Electr&oacute;nico</label>
            <div class="col-md-4">
                <input type="email" name="sEmail" class="form-control" placeholder="" value="<?php echo (isset($result['sEmail'])) ? $result['sEmail'] : '' ; ?>" required>                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre de Usuario</label>
            <div class="col-md-4">
                <input type="text" name="sUserName" class="form-control" placeholder="" value="<?php echo (isset($result['sUserName'])) ? $result['sUserName'] : '' ; ?>" required>                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Estatus</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="" value="AC" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?>> Activo
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
        
        
    </div>
</form>


<div class="col-md-12 text-center">
    <b>Nota:</b>
    <span class="label label-md label-info">
        Se enviar&aacute; correo electr&oacute;nico al usuario con una contrase&ntilde;a autogenerada para el acceso al sistema y posteriormente podr&aacute; cambiarla.
    </span>
</div>

    <script type="text/javascript">
        $(document).on("ready",function(){
            
            // alert();

            $(function(){
                $('[data-toggle="tooltip"]').tooltip()
            })

        });
    </script>
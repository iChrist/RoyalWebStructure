<?php
    if($data['datos'])
    {
        $result = $data['datos']->fetch_assoc();
    }
    
    $arrayPerfilesUsuarios = array();
    if(isset($data['perfilesusuarios']))
    {
        if(($data['perfilesusuarios']))
        {
            $arrayPerfilesUsuarios = $data['perfilesusuarios'];
        }
    }
?>

    <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-2">Nombre(s)</label>
                <div class="col-md-4">
                    <h4>
                        <?php 
                            echo (isset($result['sName'])) ? utf8_encode($result['sName']) : '' ;
                        ?>
                    </h4>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Apellido Paterno</label>
                <div class="col-md-3">
                    <h4>
                        <?php 
                            echo (isset($result['sLastNamePaternal'])) ? utf8_encode($result['sLastNamePaternal']) : '' ;
                        ?>
                    </h4>
                </div>
                
                <label class="control-label col-md-2">Apellido Materno</label>
                <div class="col-md-3">
                    <h4>
                        <?php
                            echo (isset($result['sLastNameMaternal'])) ? utf8_encode($result['sLastNameMaternal']) : '' ;
                        ?>
                    </h4>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Correo Electrónico</label>
                <div class="col-md-4">
                    <h4>
                        <?php
                            echo (isset($result['sEmail'])) ? $result['sEmail'] : '' ;
                        ?>    
                    </h4>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Nombre de usuario</label>
                <div class="col-md-4">
                    <h4>
                        <?php
                            echo (isset($result['sUserName'])) ? $result['sUserName'] : '' ;
                        ?>
                    </h4>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="control-label col-md-2">Contraseña</label>
                <div class="col-md-4">
                    <h4>
                        <?php
                            echo (isset($result['sPassword'])) ? $result['sPassword'] : '' ;
                        ?>
                    </h4>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Estatus</label>
                <div class="col-md-4">
                    <h4>
                        <?php 
                            echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'ACTIVO' : '' ;
                            echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'INACTIVO' : '' ;
                            echo (isset($result['skStatus']) && $result['skStatus'] == 'DE') ? 'ELIMINADO' : '' ;
                        ?>
                    </h4>
                </div>
            </div>
            
            <div class="clearfix"><hr/></div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Perfiles del usuario</label>
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
                                            <h4>
                                                <?php 
                                                    echo (in_array($profile['skProfiles'], $arrayPerfilesUsuarios) ? '<i class="fa fa-check-square-o tooltips" data-original-title="Perfil Activado" ></i>' : '<i class="fa fa-minus-square-o tooltips" data-original-title="Perfil Inactivo" ></i>');
                                                    echo " ".$profile['sName'];
                                                ?>
                                                <br/>
                                                &nbsp;
                                            </h4>
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



<script type="text/javascript">
    $(document).ready(function(){
        
    }); 
</script>
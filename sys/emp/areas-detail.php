<?php
    if(isset($data['datos'])){
        $result = $data['datos']->fetch_assoc();
    }
?>

    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Nombre</label>
            <div class="col-md-4">
                <h4>
                    <?php 
                        echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : '' ;
                    ?>
                </h4>
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label col-md-2">T&iacute;tulo</label>
            <div class="col-md-3">
                <h4>
                    <?php 
                        echo (isset($result['sTitulo'])) ? utf8_encode($result['sTitulo']) : '' ;
                    ?>
                </h4>
            </div>
        </div>
              
        <div class="form-group">
            <label class="control-label col-md-2">Estatus</label>
            <div class="col-md-4">
                <h4>
                    <?php 
                        echo isset($result['skStatus']) ? $result['htmlStatus'] : '' ;
                    ?>
                </h4>
            </div>
        </div>  
        
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        
    }); 
</script>
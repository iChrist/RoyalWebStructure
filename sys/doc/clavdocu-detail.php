<?php
    $result = array();
    if(isset($data['datos']) && $data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form">
    <div class="form-body">
        <div class="form-group">
            <label class=" col-md-2"><b>Clave documento</b></label>
            <label class="col-md-4">
                     <?php 
                        echo (isset($result['skClaveDocumento'])) ? utf8_encode($result['skClaveDocumento']) : '' ;
                    ?>
             </label>
       
            <label class=" col-md-2"><b>Nombre</b></label>
            <label class="col-md-4">
                     <?php 
                        echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : '' ;
                    ?>
             </label>
        </div>
         <hr>     
        <div class="form-group">
            <label class=" col-md-2"><b>Estatus</b></label>
            <label class="col-md-4">
                     <?php 
                        echo isset($result['skStatus']) ? $result['htmlStatus'] : '' ;
                    ?>
             </label>
        </div>  
        
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        
    }); 
</script>
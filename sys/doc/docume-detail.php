<?php
    $result = array();
    if(isset($data['datos']) && $data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
/*echo "<pre>";
print_r($result);
echo "</pre>";
*/?>

<div class="form-body">
  <div class="form-group">
    <label class="control-label col-md-2">Referencia</label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Pedimento</label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['sPedimento'])) ? utf8_encode($result['sPedimento']) : '' ;
                    ?>
      </p>
    </div>
  </div>

   
  <div class="form-group">
    <label class="control-label col-md-2">Empresa </label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['Empresa'])) ? utf8_encode($result['Empresa']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Tipo de Tramite </label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['TipoTramite'])) ? utf8_encode($result['TipoTramite']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Tipo de Servicio </label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['TipoServicio'])) ? utf8_encode($result['TipoServicio']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Clave de Documento </label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['ClaveDocumento'])) ? utf8_encode($result['ClaveDocumento']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Corresponsalía </label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['Corresponsalia'])) ? utf8_encode($result['Corresponsalia']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Mercancía</label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['sMercancia'])) ? utf8_encode($result['sMercancia']) : '' ;
                    ?>
      </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Observaciones</label>
    <div class="col-md-4">
      <p>
        <?php 
                        echo (isset($result['sObservaciones'])) ? utf8_encode($result['sObservaciones']) : '' ;
                    ?>
      </p>
    </div>
  </div>
    
    <div class="form-group">
        <label class="control-label col-md-2"># Contenedor</label>
        <div class="col-md-4">
            <p>
            <?php 
                echo (isset($result['sNumContenedor']) && !empty($result['sNumContenedor'])) ? $result['sNumContenedor'] : '---' ;
            ?>
            </p>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-2">Bultos</label>
        <div class="col-md-4">
            <p>
            <?php 
                echo (isset($result['iBultos']) && $result['iBultos']>0) ? $result['iBultos'] : '---' ;
            ?>
            </p>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-2">Peso</label>
        <div class="col-md-4">
            <p>
            <?php 
                echo (isset($result['fPeso']) && $result['fPeso']>=0) ? $result['fPeso'] : '---' ;
            ?>
            </p>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-2">Volumen</label>
        <div class="col-md-4">
            <p>
            <?php 
                echo (isset($result['fVolumen']) && $result['fVolumen']>0) ? $result['fVolumen'] : '---' ;
            ?>
            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2">Estatus</label>
        <div class="col-md-4">
            <p>
            <?php 
                echo isset($result['skStatus']) ? $result['htmlStatus'] : '' ;
            ?>
            </p>
        </div>
    </div>
    
    
</div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        
    }); 
</script>
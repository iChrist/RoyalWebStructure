<!-- BEGIN PAGE CONTENT-->
<?php
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

//$_SESSION['session']['skUsers']
?>

<div class="row">
  <div class="col-md-12">
    <div class="table-container">
      <div class="table-actions-wrapper"> <span></span>
        <div class="table-group-actions pull-right"> <span></span> 
          <!--<button type="button" class="btn btn-sm btn-default" id="enable_filter"><i class="fa fa-search"></i> Buscar</button>--> 
        </div>
      </div>
      <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
        <thead>
          <tr role="row" class="heading">
            <th width="10%"> Referencia </th>
            <th width="10%"> Pedimento </th>
            <th width="10%"> Tipo de Tramite </th>
            <th width="10%"> Tipo de Servicios </th>
            <th width="10%"> Empresa </th>
            <th width="10%"> Clave de Documento </th>
            <th width="10%"> Corresponsalía </th>
            <th width="10%"> Mercancía </th>
            
            <th width="10%"> Fecha </th>
            <th width="10%"> Estatus </th>
            <th width="10%"> Acciones </th>
          </tr>
          <tr role="row" class="filter">
            <td><input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia"></td>
            <td><input type="text" class="form-control form-filter input-sm" name="sPedimento" placeholder="Pedimentos"></td>
            <td><select name="skTipoTramite" class="form-control form-filter input-sm">
                <option value="">- Tipos de Tramites -</option>
                <?php
                                    if(isset($data['tipostramites'])){
                                        while($row = $data['tipostramites']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skTipoTramite']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><select name="skTipoServicio" class="form-control form-filter input-sm">
                <option value="">- Tipos de Servicios -</option>
                <?php
                                    if(isset($data['tiposservicios'])){
                                        while($row = $data['tiposservicios']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skTipoServicio']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><select name="skEmpresa" class="form-control form-filter input-sm">
                <option value="">- Empresa -</option>
                <?php
                                    if(isset($data['empresas'])){
                                        while($row = $data['empresas']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skEmpresa']; ?>"> <?php echo utf8_encode($row['sNombre']." (".$row['sRFC'].")"); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><select name="skClaveDocumento" class="form-control form-filter input-sm">
                <option value="">- Clave de Documento -</option>
                <?php
                                    if(isset($data['clavedocumento'])){
                                        while($row = $data['clavedocumento']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skClaveDocumento']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><select name="skCorresponsalia" class="form-control form-filter input-sm">
                <option value="">- Corresponsalía -</option>
                <?php
                                    if(isset($data['corresponsalia'])){
                                        while($row = $data['corresponsalia']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skCorresponsalia']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><input type="text" class="form-control form-filter input-sm" name="sMercancia" placeholder="Mercancía"></td>
            <td><input type="text" class="form-control form-filter input-sm" name="sObservaciones" placeholder="Observaciones"></td>
            
            <td></td>
            <td><select name="skStatus" class="form-control form-filter input-sm">
                <option value="">- Estatus -</option>
                <?php
                                    if(isset($data['status'])){
                                        while($row = $data['status']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skStatus']; ?>"> <?php echo $row['sName']; ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
              </div></td>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!--</div>!--> 
  </div>
  <!-- End: life time stats --> 
</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function(){       
   // init ajax table 
   TableAjax.init('?axn=fetch_all');
});
</script>
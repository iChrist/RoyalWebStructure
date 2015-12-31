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
              <th width="10%" >Estatus</th>
            <th width="10%"> Referencia </th>
            <th width="10%"> Fechas</th>
            <th width="10%"> Ejecutivo </th>
            <th width="10%"> Cliente </th>
            <th width="10%"> Linea Naviera </th>
            <th width="10%"> Tramitador </th>
             <th width="10%"> Observaciones </th>
            <th width="10%"> Acciones </th>
          </tr>
          <tr role="row" class="filter">
           <td><select name="skEstatusRevalidacion" class="form-control form-filter input-sm">
                <option value="">- Estatus -</option>
                <?php
                                    if($data['estatus']){
                                        while($row = $data['estatus']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skEstatus']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            <td><input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia"></td>
            <td>
                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control form-filter" readonly name="dFechaRevalidacion" placeholder="Fecha Inicio">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                    <input type="text" class="form-control form-filter" readonly name="dFechaFin" placeholder="Fecha Fin">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </td>
            <td><select name="skUsuarioRevalidacion" class="form-control form-filter input-sm">
                <option value="">- Ejecutivo -</option>
                <?php
                                    if($data['ejecutivo']){
                                        while($row = $data['ejecutivo']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skUsers']; ?>"> <?php echo utf8_encode($row['sName']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
              <td>
                  <select name="skEmpresa" class="form-control form-filter input-sm">
                <option value="">- Cliente -</option>
                <?php
                                    if($data['clientes']){
                                        while($row = $data['clientes']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skEmpresa']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select>
              </td>
            <td><select name="skEmpresaNaviera" class="form-control form-filter input-sm">
                <option value="">- Linea Naviera -</option>
                <?php
                                    if($data['empresas']){
                                        while($row = $data['empresas']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skEmpresa']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            
            <td><select name="skUsuarioTramitador" class="form-control form-filter input-sm">
                <option value="">- Tramitador -</option>
                <?php
                                    if($data['tramitadores']){
                                        while($row = $data['tramitadores']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skUsers']; ?>"> <?php echo utf8_encode($row['sName']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            
            <td><input type="text" class="form-control form-filter input-sm" name="sObservaciones" placeholder="Observaciones"></td>
           
            
            <td><div aria-label="Acciones" role="group" class="btn-group btn-group-xs" style="width:100px">
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
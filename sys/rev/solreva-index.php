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
            <th width="3%" >E</th>
            <th width="15%"> Referencia </th>
            <th width="10%"> Linea Naviera </th>
            <th width="10%"> Tramitador </th>
             <th width="10%"> Observaciones </th>
             <th width="10%"> Fecha </th>
            <th width="10%"> Acciones </th>
          </tr>
          <tr role="row" class="filter">
          <td></td>
            <td><input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia"></td>
            
            
            <td><select name="skEmpresaNaviera" class="form-control form-filter input-sm">
                <option value="">- Linea Naviera -</option>
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
            
            <td><select name="skUsuarioTramitador" class="form-control form-filter input-sm">
                <option value="">- Tramitador -</option>
                <?php
                                    if(isset($data['tramitadores'])){
                                        while($row = $data['tramitadores']->fetch_assoc()){
                                ?>
                <option value="<?php echo $row['skUsuarioTramitador']; ?>"> <?php echo utf8_encode($row['sName']); ?> </option>
                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
              </select></td>
            
            <td><input type="text" class="form-control form-filter input-sm" name="sObservaciones" placeholder="Observaciones"></td>
            
            <td></td>
            
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
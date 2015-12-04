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
            <th width="10%"> Clave Documento </th>
            <th width="10%"> Nombre </th>
            <th width="10%"> Estatus </th>
            <th width="10%"> Acciones </th>
          </tr>
          <tr role="row" class="filter">
            <td><input type="text" class="form-control form-filter input-sm" name="skClaveDocumento" placeholder="Clave"></td>
            <td><input type="text" class="form-control form-filter input-sm" name="sNombre" placeholder="Nombre"></td>
            <td>
                                <select name="skStatus" class="form-control form-filter input-sm">
                                    <option value="">- Estatus -</option>
                                <?php
                                    if($data['status']){
                                        while($row = $data['status']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skStatus']; ?>">
                                                <?php echo $row['sName']; ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>

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
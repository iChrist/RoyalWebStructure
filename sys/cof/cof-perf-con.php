<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span></span>
                        <div class="table-group-actions pull-right">
                            <span></span>
                            <!--<button type="button" class="btn btn-sm btn-default" id="enable_filter"><i class="fa fa-search"></i> Buscar</button>-->
                        </div>
                    </div>
                    
                        </table>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                             <th width="16%">
                                Nombre 
                            </th>
                             
                            <th width="16%">
                                Estatus
                            </th>
                            <th width="16%">
                                Acciones
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sName" placeholder="Nombre">
                            </td>
                           
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
                            <td>
                                <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                                    <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                                    <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                                </div>
                            </td>
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
<script type="text/javascript">
jQuery(document).ready(function() {       
   // init ajax table 
   TableAjax.init('?axn=fetch_all');
   $("#enable_filter").click(function(){
       $(".table-filter").css("display","block");
   });
});
</script>


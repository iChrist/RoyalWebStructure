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
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="25%">
                                RFC
                            </th>
                            <th width="25%">
                               Nombre
                            </th>
                             <th width="25%">
                               Nombre Corto
                            </th>
                            <th width="25%">
                               Tipo de Empresa
                            </th>
                            <th width="25%">
                                Corresponsalia
                            </th>
                            <th width="25%">
                                Promotor 1
                            </th>
                            <th width="25%">
                               Estatus
                            </th>
                            <th width="25%">
                                Acciones
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sRFC" placeholder="RFC">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sNombre" placeholder="Nombre">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sNombreCorto" placeholder="Nombre Corto">
                            </td>
                            <td>
                                <!--<input type="text" class="form-control form-filter input-sm" name="skTipoEmpresa" placeholder="Tipo de Empresa">!-->
                                <select name="skTipoEmpresa" class="form-control form-filter input-sm">
                                    <option value="">- Tipo de Empresa -</option>
                                <?php
                                    if(isset($data['tiposEmpresas'])){
                                        while($row = $data['tiposEmpresas']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skTipoEmpresa']; ?>">
                                                <?php echo $row['sNombre']; ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="skCorresponsalia" class="form-control form-filter input-sm">
                                    <option value="">- Corresponsalia -</option>
                                <?php
                                    if(isset($data['corresponsalias'])){
                                        while($row = $data['corresponsalias']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skEmpresa']; ?>">
                                                <?php echo $row['sNombre']; ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="skPromotor" class="form-control form-filter input-sm">
                                    <option value="">- Promotor -</option>
                                <?php
                                    if(isset($data['promotores'])){
                                        while($row = $data['promotores']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skPromotores']; ?>">
                                                <?php echo $row['sNombre']; ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="skStatus" class="form-control form-filter input-sm">
                                    <option value="">- Estatus -</option>
                                <?php
                                    if(isset($data['status'])){
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
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function(){       
   // init ajax table 
   TableAjax.init('?axn=fetch_all');
});
</script>
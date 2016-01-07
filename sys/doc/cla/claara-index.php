<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span></span>
                        <div class="table-group-actions pull-right">
                            <span></span>
                        </div>
                    </div>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="25%">
                                Referencia
                            </th>
                            <th width="25%">
                                Pedimento
                            </th>
                            <th width="25%">
                                Cliente
                            </th>
                            <th width="25%">
                                Fracci&oacute;n
                            </th>
                            <th width="25%">
                                Descripci&oacute;n
                            </th>
                            <th width="25%">
                                Ingl&eacute;s
                            </th>
                            <th width="25%">
                                Num. Parte
                            </th>
                            <th width="25%">
                                F. Previo
                            </th>
                            <th width="25%">
                                Factura
                            </th>
                            <th width="25%">
                                Autor
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
                                <input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sPedimento" placeholder="Pedimento">
                            </td>
                            <td>
                                <select name="skEmpresa" class="form-control form-filter input-sm">
                                    <option value="">- Cliente -</option>
                                <?php
                                    if($data['empresas']){
                                        while($row = $data['empresas']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skEmpresa']; ?>">
                                                <?php echo utf8_encode($row['sNombre']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sFraccion" placeholder="Fraccion">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcion" placeholder="Descripci&oacute;n">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcionIngles" placeholder="Descripci&oacute;n ingl&eacute;s">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sNumeroParte" placeholder="Num. Parte">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="dFechaPrevio" placeholder="F. Previo">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sFactura" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="skCreador" placeholder="Autor">
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
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function(){
   TableAjax.init('?axn=fetch_all');
});
</script>
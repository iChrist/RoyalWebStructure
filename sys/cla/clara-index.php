<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <form id="_formTableAjax" method="POST" action="?axn=fetch_all">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span></span>
                        <div class="table-group-actions pull-right"><span></span>
                            <div class="btn-group btn-group-md" role="group" aria-label="Acciones">
                            <?php
                                $buttons = $this->printModulesButtons(3);
                                echo $buttons['sHtml'];
                            ?>
                            </div>
                        </div>
                    </div>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="10%">
                                Buscar
                            </th>
                            <th width="25%">
                                Cliente
                            </th>
                            <th width="25%">
                                Referencia
                            </th>
                            <th width="25%">
                                Fracci&oacute;n (1ra)
                            </th>
                            <th width="25%">
                                Fracci&oacute;n (2da)
                            </th>
                            <th width="25%">
                                Modelo (1ra)
                            </th>
                            <th width="25%">
                                Modelo (2da)
                            </th>
                            <th width="25%">
                                Des. Esp (1ra)
                            </th>
                            <th width="25%">
                                Des. Esp (2da)
                            </th>
                            <th width="25%">
                                Des. Ing. (1ra)
                            </th>
                            <th width="25%">
                                Des. Ing. (2da)
                            </th>
                            <th width="25%">
                                Ejec. (1ra)
                            </th>
                            <th width="25%">
                                Ejec. (2da)
                            </th>
                            <th width="25%">
                                Clas. (1ra)
                            </th>
                            <th width="25%">
                                Clas. (2da)
                            </th>
                            <th width="25%">
                                Fac. (1ra)
                            </th>
                            <th width="25%">
                                Fac. (2da)
                            </th>
                            <th width="25%">
                                Sec. (1ra)
                            </th>
                            <th width="25%">
                                Sec. (2da)
                            </th>
                            <th width="25%">
                                F. Prev. (1ra)
                            </th>
                            <th width="25%">
                                F. Prev. (2da)
                            </th>
                            <th width="25%">
                                F. Alta (1ra)
                            </th>
                            <th width="25%">
                                F. Alta (2da)
                            </th>
                            <th width="25%">
                                F. Edición (1ra)
                            </th>
                            <th width="25%">
                                F. Edición (2da)
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                                    <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                                    <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                                </div>
                            </td>
                            <td>
                                <select name="skEmpresa" id="skEmpresa" class="form-control form-filter input-sm">
                                    <option value="">- Cliente -</option>
                                    <?php
                                        if ($data['empresas']) {
                                            while ($rEmpresa = $data['empresas']->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresa'])) ? ($result['skEmpresa'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : ''; ?> > <?php echo utf8_encode($rEmpresa['sNombre']); ?> </option>
                                                <?php
                                            }//ENDIF
                                        }//ENDWHILE
                                        $data['empresas']->data_seek(0);
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control form-filter input-sm" name="sFraccion" placeholder="Fracción">
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control form-filter input-sm" name="sNumeroParte" placeholder="Modelo">
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcion" placeholder="Descripción">
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcionIngles" placeholder="Inglés">
                            </td>
                            <td colspan="2">
                                <select name="skUsersCreacion" class="form-control form-filter input-sm">
                                    <option value="">- Ejecutivo -</option>
                                <?php
                                    if($data['users']){
                                        while($row = $data['users']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skUsers']; ?>">
                                                <?php echo utf8_encode($row['sName'].' '.$row['sLastNamePaternal'].' '.$row['sLastNameMaternal']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                    $data['users']->data_seek(0);
                                ?>
                                </select>
                            </td>
                            <td colspan="2">
                                <select name="skUsersModificacion" class="form-control form-filter input-sm">
                                    <option value="">- Clasificador -</option>
                                <?php
                                    if($data['users']){
                                        while($row = $data['users']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skUsers']; ?>">
                                                <?php echo utf8_encode($row['sName'].' '.$row['sLastNamePaternal'].' '.$row['sLastNameMaternal']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                    $data['users']->data_seek(0);
                                ?>
                                </select>
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control form-filter input-sm" name="sFactura" placeholder="Factura">
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control form-filter input-sm" name="iSecuencia" placeholder="Secuencia">
                            </td>
                            <td colspan="2">
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dFechaPrevio1" name="dFechaPrevio1" placeholder="Desde:">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dFechaPrevio2" name="dFechaPrevio2" placeholder="Hasta:">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dFechaCreacion1" name="dFechaCreacion1" placeholder="Desde:">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dFechaCreacion2" name="dFechaCreacion2" placeholder="Hasta:">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dFechaModificacion1" name="dFechaModificacion1" placeholder="Desde:">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dFechaModificacion2" name="dFechaModificacion2" placeholder="Hasta:">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                </div>
            </form> <!-- FORMULARIO PARA BOTONES DE LA TABLA iPosition 3!-->
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
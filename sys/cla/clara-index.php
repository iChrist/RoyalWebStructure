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
                                <input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sFraccion1" placeholder="Fracción">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sFraccion2" placeholder="Fracción">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sNumeroParte1" placeholder="Modelo">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sNumeroParte2" placeholder="Modelo">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcion1" placeholder="Descripción">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcion2" placeholder="Descripción">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcionIngles1" placeholder="Inglés">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sDescripcionIngles2" placeholder="Inglés">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="skUsersCreacion1" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="skUsersCreacion2" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="skUsersModificacion1" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="skUsersModificacion2" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sFactura1" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sFactura2" placeholder="Factura">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="iSecuencia1" placeholder="Secuencia">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="iSecuencia2" placeholder="Secuencia">
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dRecepcion" name="dFechaPrevio1" placeholder="Previo">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dRecepcion" name="dFechaPrevio2" placeholder="Previo">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dRecepcion" name="dFechaCreacion1" placeholder="Alta">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dRecepcion" name="dFechaCreacion2" placeholder="Alta">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dRecepcion" name="dFechaModificacion1" placeholder="Modificación">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" id="dRecepcion" name="dFechaModificacion2" placeholder="Modificación">
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
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
                            <th width="10%">
                                Cliente
                            </th>
                            <th width="10%">
                                Tipo Cambio
                            </th>
                            <th width="10%">
                                Tipo Tarifa
                            </th>
                            <th width="15%">
                                Fecha
                            </th>
                            <th width="10%">
                                Tarifa
                            </th>
                            <th width="10%">
                                Agente aduanal
                            </th>
                            <th width="15%">
                                Corresponsal
                            </th>
                            <th width="5%">
                                Promotor 1
                            </th>
                            <th width="5%">
                                Promotor 2
                            </th>
                            <th width="15%">
                                Autor
                            </th>
                            <th width="10%">
                                Estatus
                            </th>
                            <th width="10%">
                                Acciones
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <select name="skEmpresa" class="form-control form-filter input-sm">
                                    <option value="">- Cliente -</option>
                                <?php
                                    if(isset($data['clientes'])){
                                        while($row = $data['clientes']->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $row['skEmpresa']; ?>">
                                        <?php echo utf8_encode($row['sNombre']); ?>
                                    </option>
                                <?php
                                        }//ENDWHILE
                                    }//ENDIF
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="sTipoCambio" class="form-control form-filter input-sm">
                                    <option value="">- Tipo Cambio -</option>
                                    <option value="MX">Pesos (MX)</option>
                                    <option value="USD">Dolares (USD)</option>
                                </select>
                            </td>
                            <td>
                                <select name="iTipoTarifa" class="form-control form-filter input-sm">
                                    <option value="">- Tipo Tarifa -</option>
                                    <option value="1">Por Monto Fijo</option>
                                    <option value="2">Por Porcentaje</option>
                                    <option value="3">Por Contenedor</option>
                                </select>
                            </td>
                            <td>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" name="dFechaInicio" placeholder="Fecha Inicio">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                    <input type="text" class="form-control form-filter" name="dFechaFin" placeholder="Fecha Fin">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <input type="number" class="form-control form-filter input-sm" name="fTarifa" placeholder="Tarifa">
                            </td>
                            <td>
                                <input type="number" class="form-control form-filter input-sm" name="fAgenteAduanal" placeholder="Agente aduanal">
                            </td>
                            <td>
                                <select name="skCorresponsalia" class="form-control form-filter input-sm">
                                    <option value="">- Corresponsal -</option>
                                <?php
                                    if(isset($data['corresponsalias'])){
                                        while($row = $data['corresponsalias']->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $row['skEmpresa']; ?>">
                                        <?php echo utf8_encode($row['sNombre']); ?>
                                    </option>
                                <?php
                                        }//ENDWHILE
                                    }//ENDIF
                                ?>
                                </select>
                            </td>
                            <td colspan="2">
                                <select name="skPromotor" class="form-control form-filter input-sm">
                                    <option value="">- Promotor -</option>
                                <?php
                                    if(isset($data['promotores'])){
                                        while($row = $data['promotores']->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $row['skPromotores']; ?>">
                                        <?php echo utf8_encode($row['sNombre']); ?>
                                    </option>
                                <?php
                                        }//ENDWHILE
                                    }//ENDIF
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="skUserCreacion" class="form-control form-filter input-sm">
                                    <option value="">- Autor -</option>
                                <?php
                                    if($data['usuarios']){
                                        while($row = $data['usuarios']->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $row['skUsers']; ?>">
                                        <?php echo utf8_encode($row['sName']); ?>
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
                                    <option value="todos">Todos</option>
                                    <option value="AC">Activo</option>
                                    <option value="IN">Inactivo</option>
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
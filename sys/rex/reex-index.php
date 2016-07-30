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
						<th width="">Acciones</th>
						<th width="">Estado</th>
						<th width="100%">Referencia</th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Previo"><b>F.P</d></label></b></th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Desconsolidacion"><b>F.D</d></label></b></th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Clasificaci&oacute;n"><b>F.C</d></label></b></th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Glosa"><b>F.G</d></label></b></th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Captura de Pedimento"><b>F.C</d></label></b></th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Revalidaci&oacute;n"><b>F.R</d></label></b></th>
						<th nowrap="nowrap" ><b><label class="tooltips" data-toggle="tooltip" data-placement="top" title="Fecha de Facturaci&oacute;n"><b>F.F</d></label></b></th>
						<th nowrap="nowrap">Deposito</th>
						<th nowrap="nowrap">Saldo</th>
					</tr>
					<tr role="row" class="filter">
					    <td>
                            <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                            		<button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                            		<button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                            </div>
              </td>
							<td>
													<select name="sEstatus" class="form-control form-filter input-sm">
														<option value="">- Estatus -</option>
														<?php
														if(isset($data['listEstados'])){
															for ($i=0; $i <= count($data['listEstados']) -1 ; $i++) {
																echo "<option value=".
																	$data['listEstados'][$i]["skEstatus"].">".
																	$data['listEstados'][$i]["sNombre"]."</option>";

															}
						                                }
						                                ?>
						                                </select>
						            </td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><input type="text" class="form-control form-filter input-sm" name="iDeposito" placeholder="Cantidad deposito"></td>
						<td><input type="text" class="form-control form-filter input-sm" name="iSaldo" placeholder="Saldo"></td>
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
<!--
class="btn popovers" data-trigger="hover" data-placement="top"
data-content="Popover body goes here! Popover body goes here!"
data-original-title="Popover in top"
tooltips
-->
<div class="clearfix"></div>
<script type="text/javascript">
function tooltip() {
//	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

}

	jQuery(document).ready(function() {
   // init ajax table
	 TableAjax.init('?axn=fetch_all');

   //TableAjax.init('?axn=fetch_all');
	 setTimeout(tooltip, 5000)



});
</script>

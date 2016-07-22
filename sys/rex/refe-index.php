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
						<th width="">Pedimento</th>
						<th width="">Referencia</th>
						<th width="">Mercancía</th>
						<th width="">Guia Master</th>
						<th width="">Guia House</th>
						<th width="">Fecha Creacion</th>
						<th width="">Fecha Previo</th>
						<th width="">Fecha Despacho</th>
						<th width="">Fecha Clasificacion</th>
						<th width="">Fecha Glosa</th>
						<th width="">Fecha CapturaPedimento</th>
						<th width="">Fecha Facturacion</th>
						<th width="">Deposito</th>
						<th width="">Saldo</th>
						<th width="">Almacén</th>
						<th width="">Estado</th>
						<th width="">Socio Importador</th>

					</tr>
					<tr role="row" class="filter">
					    <td>
                            <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                            		<button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                            		<button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                            </div>
                        </td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="sPedimento" placeholder="Pedimento">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="sMercancia" placeholder="Mercancia">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="sGuiaMaster" placeholder="Guia master">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="sGuiaHouse" placeholder="Guia House">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaCreacion" placeholder="Fecha creacion">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaPrevio" placeholder="Fecha previo">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaDespacho" placeholder="Fecha despacho">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaClasificacion" placeholder="Fecha de clasificacion">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaGlosa" placeholder="Fecha de glosa">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaCapturaPedimento" placeholder="Fecha de captura del pedimento">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="dFechaFacturacion" placeholder="Fecha de facturacion">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="iDeposito" placeholder="Cantidad deposito">
						</td>
						<td>
							<input type="text" class="form-control form-filter input-sm" name="iSaldo" placeholder="Saldo">
						</td>
						<td>
							<select name="sAlmacen" class="form-control form-filter input-sm">
								<option value="">- Almacén -</option>
								<?php
								if(isset($data['listAlmacenes'])){
									for ($i=0; $i <= count($data['listAlmacenes']) -1 ; $i++) { 
										echo "<option value=".
											$data['listAlmacenes'][$i]["skAlmacen"]. ">".
											$data['listAlmacenes'][$i]["sNombre"]."</option>";
										
									}
                                }
                                ?>
                                </select>
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
							<select name="sSocioImportador" class="form-control form-filter input-sm">
								<option value="">- Estatus -</option>
								<?php
								
								if(isset($data['listSocios'])){
									for ($i=0; $i <= count($data['listSocios']) -1 ; $i++) { 
										echo "<option value=".
											$data['listSocios'][$i]["skSocioEmpresa"].">".
											$data['listSocios'][$i]["Empresa"]."</option>";
										
									}
                                }
                                    ?>
                                </select>
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
	jQuery(document).ready(function() {       
   // init ajax table 
   TableAjax.init('?axn=fetch_all');
		$.ajax({
        url : '<?php echo SYS_URL;?>/sys/rex/jsonSocioImportadores/0/<?php echo $_SESSION["session"]["skSocioEmpresaPropietario"]. "/" ;?>',
        data : {},

        // especifica si será una petición POST o GET
        type : 'GET',
        dataType : 'json',
        success : function(json) {
            ifsocioimportador = "<?php echo (isset($result['skSocioImportador'])) ? $result['skSocioImportador'] : '' ; ?>";
            for (o in json) {
                d = json[o];
                if (ifsocioimportador != "") {
                    if (ifsocioimportador == d.skSocioEmpresa ) {
                        $("#skSocioImportador").append('<option selected="selected" value="' + d.skSocioEmpresa +  '">'+d.Empresa+'</option>');
                    }else{
                        $("#skSocioImportador").append('<option value="' + d.skSocioEmpresa +  '">'+d.Empresa+'</option>');
                    }
                }else{
                    $("#skSocioImportador").append('<option value="' + d.skSocioEmpresa +  '">'+d.Empresa+'</option>');
                }
                
            }
        },
        error : function(xhr, status) {
            console.log("Algo salio mal en la peticion a jsonSocioImportadores")
        },
        complete : function(xhr, status) {
            console.log('Petición realizada');
        }
    }); 
   
});
</script>
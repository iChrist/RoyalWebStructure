<!-- BEGIN PAGE CONTENT-->

<pre>
	<?php 
		echo $data['listAlmacenes'];
	 ?>
</pre>
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
							<select name="sEstatus" class="form-control form-filter input-sm">
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
							<select name="sSocioImportador" class="form-control form-filter input-sm">
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
   /*$("#enable_filter").click(function(){
       $(".table-filter").css("display","block");
   });*/
   $.ajax({
	    url : '<?php echo SYS_URL;?>/sys/rex/jsonStatus/',
	    data : {},

	    // especifica si será una petición POST o GET
	    type : 'GET',
	    dataType : 'json',
	    success : function(json) {
	        ifestat = "<?php echo (isset($result['skEstatus'])) ? $result['skEstatus'] : '' ; ?>";
	        
	        for (o in json) {
	            d = json[o];
	            if (ifestat != "") {
	                if(ifestat == d.skEstatus ){
	                    $("#skEstatus").append('<option selected="selected" value="' + d.skEstatus +  '">'+d.sNombre+'</option>')
	                }else{
	                    $("#skEstatus").append('<option value="' + d.skEstatus +  '">'+d.sNombre+'</option>')
	                }
	            }else{
	                $("#skEstatus").append('<option value="' + d.skEstatus +  '">'+d.sNombre+'</option>')
	            }
	            
	        }
	    },
	    error : function(xhr, status) {
	        console.log("Algo salio mal en la peticion a jsonStatus")
	    },
	    complete : function(xhr, status) {
	        console.log('Petición realizada');
	    }
    });        

    $.ajax({
        url : '<?php echo SYS_URL;?>/sys/rex/jsonAlmacenes/',
        data : {},

        type : 'GET',
        dataType : 'json',
        success : function(json) {
            ifalmacen = "<?php echo (isset($result['skAlmacen'])) ? $result['skAlmacen'] : '' ; ?>";
            
            for(i in json){
                d = json[i];
                if (ifalmacen != "") {
                    if (ifalmacen == d.skAlmacen) {
                        $("#skAlmacen").append('<option selected="selected" value="' + d.skAlmacen + '">'+d.sNombre+'</option>');
                    }else{
                        $("#skAlmacen").append('<option value="' + d.skAlmacen + '">'+d.sNombre+'</option>');
                    }
                    
                }else{
                    $("#skAlmacen").append('<option value="' + d.skAlmacen + '">'+d.sNombre+'</option>');
                }
                
            }
        },
        error : function(xhr, status) {
            console.log("Algo salio mal en la peticion a jsonAlmacenes")
        },
        complete : function(xhr, status) {
            console.log('Petición realizada');
        }
    });
});
</script>
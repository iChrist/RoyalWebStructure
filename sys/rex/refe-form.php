        <?php
        //echo print_r($_SESSION["session"],1);
        //$fecha = DateTime::createFromFormat('d-m-Y', '30-07-2016');
        //echo $fecha->format('Y-m-d H:i:s');
        $result = array();
        if($data['datos']){
            $result = $data['datos'];
        }
        //echo (isset($result["dFechaFacturacion"])) ? $result["dFechaFacturacion"] : '' ;
        //echo DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaFacturacion"])->format('d-m-Y');
        //2016-07-26 00:00:00
        //(isset($result["sReferencia"])) ? echo $result["sReferencia"] : echo '' ;
        //die(print_r($data["conceptosTotales"],true)."<br>".print_r($data["conceptosRef"],true));
        ?>

<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skReferenciaExterna"  id="skReferenciaExterna" value="<?php echo (isset($result['skReferenciaExterna'])) ? $result['skReferenciaExterna'] : '' ; ?>">
    <input type="hidden" name="axn" id="anx" value="<?php echo (isset($result["sReferencia"])) ? 'update' : 'insert' ;?>" ></input>
    <div class="form-body">



        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="50" name="sReferencia" id="sReferencia" class="form-control" placeholder="Numero de referencia" value="<?php echo (isset($result["sReferencia"])) ? $result["sReferencia"] : '' ;?>" >

                </div>
            </div>

            <label class="control-label col-md-2">Importador <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <select class="form-control" id="skSocioImportador" name="skSocioImportador">
                        <option value="">--Seleccione Importador--</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-2">Almacen <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <select class="form-control" id="skAlmacen" name="skAlmacen">
                        <option value="">-- Seleccione un almacen --</option>
                    </select>
                </div>
            </div>
            <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <select class="form-control" id="skEstatus" name="skEstatus">
                        <option value="">-- Seleccione un estatus --</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">

        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Pedimento <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="50" name="sPedimento" id="sPedimento" class="form-control" placeholder="Numero de pedimento" value="<?php echo (isset($result["sPedimento"])) ? $result["sPedimento"] : '' ;?>" >
                </div>
            </div>
            
            <label class="control-label col-md-2">Bultos<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="number" min="0" name="iBultos" id="iBultos" class="form-control" placeholder="0" value="<?php echo (isset($result["iBultos"])) ? $result["iBultos"] : '' ;?>" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Mercancia<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-10">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <textarea name="sMercancia" id="sMercancia" cols="30" class="form-control" rows="10" placeholder="Mercancia"><?php echo (isset($result["sMercancia"])) ? $result["sMercancia"] : '' ;?></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="control-label col-md-2">Guia Master<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-2">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="100" name="sGuiaMaster" id="sGuiaMaster" class="form-control" placeholder="Guia master" value="<?php echo (isset($result["sGuiaMaster"])) ? $result["sGuiaMaster"] : '' ;?>" >
                </div>
            </div>
            <label class="control-label col-md-2">Guia House<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-2">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="100" name="sGuiaHouse" id="sGuiaHouse" class="form-control" placeholder="Guia House" value="<?php echo (isset($result["sGuiaHouse"])) ? $result["sGuiaHouse"] : '' ;?>" >
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de previo</label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaPrevio" name="dFechaPrevio" class="form-control" value="<?php echo (isset($result["dFechaPrevio"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaPrevio"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
              </div>
              <label class="control-label col-md-1"></label>
              <div class="col-md-2">
                <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaPrevio"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaPrevio"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraPrevio" id="tHoraPrevio" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Fecha de despacho</label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaDespacho" name="dFechaDespacho" class="form-control" value="<?php echo (isset($result["dFechaDespacho"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaDespacho"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
              </div>
              <label class="control-label col-md-1"></label>
              <div class="col-md-2">
                    <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaDespacho"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaDespacho"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraDespacho" id="tHoraDespacho" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-2">Fecha de clasificaci&oacute;n </label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaClasificacion" name="dFechaClasificacion" class="form-control" value="<?php echo (isset($result["dFechaClasificacion"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaClasificacion"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
            </div>
            <label class="control-label col-md-1"></label>
            <div class="col-md-2">
                <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaClasificacion"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaClasificacion"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraClasificacion" id="tHoraClasificacion" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Fecha de glosa</label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaGlosa" name="dFechaGlosa" class="form-control" value="<?php echo (isset($result["dFechaGlosa"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaGlosa"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
              </div>
              <label class="control-label col-md-1"></label>
              <div class="col-md-2">
                <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaGlosa"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaGlosa"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraGlosa" id="tHoraGlosa" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-2">Fecha de captura de pedimento </label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaCapturaPedimento" name="dFechaCapturaPedimento" class="form-control" value="<?php echo (isset($result["dFechaCapturaPedimento"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaCapturaPedimento"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
              </div>
              <label class="control-label col-md-1"></label>
              <div class="col-md-2">
                <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaCapturaPedimento"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaCapturaPedimento"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraCapturaPedimento" id="tHoraCapturaPedimento" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Fecha de revalidaci&oacute;n</label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaRevalidacion" name="dFechaRevalidacion" class="form-control" value="<?php echo (isset($result["dFechaRevalidacion"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaRevalidacion"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
              </div>
              <label class="control-label col-md-1"></label>
                <div class="col-md-2">
                <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaRevalidacion"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaRevalidacion"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraRevalidacion" id="tHoraRevalidacion" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de facturaci&oacute;n</label>
            <div class="col-md-2">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaFacturacion" name="dFechaFacturacion" class="form-control" value="<?php echo (isset($result["dFechaFacturacion"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaFacturacion"])->format('d-m-Y') : '' ;?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>

                </div>
              </div>
              <label class="control-label col-md-1"></label>
              <div class="col-md-2">
                <div class="input-group bootstrap-timepicker">
                        <input type="text" value="<?php echo (isset($result["dFechaFacturacion"])) ? DateTime::createFromFormat('Y-m-d H:i:s', $result["dFechaFacturacion"])->format('H:i:s') : '0:00:00' ;?>" class="form-control timepicker-24" name="tHoraFacturacion" id="tHoraFacturacion" aria-invalid="false">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                        </span>
                    </div>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <label class="control-label col-md-2">Deposito <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="number" maxlength="400" name="iDeposito" id="iDeposito" class="form-control" placeholder="0" value="<?php echo (isset($result["iDeposito"])) ? $result["iDeposito"] : '' ;?>" >
                </div>
            </div>
            <label class="control-label col-md-2">Tipo de cambio <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="number" maxlength="400" name="fTipoCambio" id="fTipoCambio" class="form-control" placeholder="0" value="<?php echo (isset($data["tipoCambio"]["USD"])) ? $data["tipoCambio"]["USD"]["valor"] : '' ;?>" >
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <td colspan="7" align="center"><h3>Conceptos de Pedimento</h3></td>
                    </tr>
                    <tr>
                        <th nowrap>S</th>
                        <th nowrap>Cantidad</th>
                        <th nowrap>Precio Unitario</th>
                        <th nowrap>Divisa</th>
                        <th width="80%">Nombre</th>
                        <th nowrap></th>
                        <th width="80%">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="ConceptosReferenciasTabla">

                    <?php
                    /**/
                    $totalConceptos = 0;
                        if (isset($data["conceptosTotales"]) ) {
                          /* $data["conceptosTotales"]
                            $data["conceptosRef"]*/
                            //exit('<pre>' . print_r($data["conceptosRef"]->fetch_array(),true).'</pre>');

                            while ($row = $data["conceptosTotales"]->fetch_assoc()) {
                                $conceptoRecord = false;
                                
                                while($cr = $data["conceptosRef"]->fetch_assoc()){
                                    
                                    if ($cr["skConcepto"] ===  $row["skConcepto"]) {
                                        $conceptoRecord = $cr;
                                        //$data["conceptosRef"]->data_seek(0);
                                    }
                                    
                                }
                                //echo ( "<pre>".print_r($conceptoRecord ,true)."</pre>");
                                
                               
                              



                    ?>

                    <tr>
                        <td>
                            <input onchange="cotizar();" value="<?php
                                echo $row['skConcepto'];
                            ?>" name="conceptos[]" type="checkbox" <?php echo ' '.($conceptoRecord != false)? 'checked' : '';?> >
                        </td>
                        <td>
                            <input name="iCantidad[]" onchange="cotizar();" class="form-control input-sm iCantidad" placeholder="Cant" value="<?php
                                echo ($conceptoRecord["iCantidad"]) ? $conceptoRecord["iCantidad"] : ' ';
                            ?>" type="text">
                        </td>
                        <td>
                            <input name="fPrecioUnitario[]" onchange="cotizar();" class="form-control input-sm fPrecioUnitario" placeholder="Precio Unitario" value="<?php
                                        echo ($conceptoRecord)? $conceptoRecord['dPrecioUnitario'] :$row['dPrecioUnitario'];
                                ?>" type="text">
                        </td>
                        <td style="color:#777;">
                            <?php echo $row['skDivisa'];?><input class="divisa" name="divisa[]" value="<?php echo $row['skDivisa'];?>" type="hidden">
                        </td>
                        <td nowrap=""><?php echo $row['sNombre'];?></td>
                        <td class="show_dolares" nowrap=""> <?php
                            if ($row['skDivisa'] === 'USD') {

                                //echo $row['dTipoCambio'] * ($row['iCantidad'] * $row['dPrecioUnitario'] );
                                echo ($conceptoRecord)? $conceptoRecord['dTipoCambio'] * ($conceptoRecord['iCantidad'] * $$conceptoRecord['dPrecioUnitario'] ): '';
                            }?> </td>
                        <td>
                            <span class="show_subtotal"><?php echo $row['dImporte']; $totalConceptos += $row['dImporte']?></span>
                            <input name="subtotal[]" class="subtotal" value="" type="hidden">
                        </td>
                    </tr>
                    <?php
                    
                            }
                        }
                    ?>
                </tbody>
            </table>
                    <div class="form-group">
          <div class="col-md-12">
            <div class="col-md-3 col-md-offset-9">
            <h3>Total: <span id="total"><?php echo $totalConceptos; ?></span></h3>
            </div>
          </div>
        </div>
        </div>


    <div class="form-group">
        <label class="control-label col-md-2">Saldo <span aria-required="true" class="required"> * </span>
        </label>
        <div class="col-md-4">
            <div class="input-icon right">
                <i class="fa"></i>
                <input readonly type="number" maxlength="400" name="iSaldo" id="iSaldo" class="form-control" placeholder="0" value="<?php echo (isset($result["iSaldo"])) ? $result["iSaldo"] : '' ;?>" >
            </div>
        </div>
    </div>

</div>
</form>

<script type="text/javascript">
    function cotizar(){
      //alert(1);
        $(".subtotal").val("");
        $(".show_subtotal").html("");
        var total = 0;
        $("input[name='conceptos[]']:checked").each(function(idx,obj){
            var tr = $(obj).closest('tr');
            var precioUnitario = $(tr).find(".fPrecioUnitario").val();
            var divisaConcepto = $(tr).find(".divisa").val();
            var cantidad = $(tr).find(".iCantidad").val();
            var unidadCambio = $("#fTipoCambio").val();
        if(divisaConcepto == 'MXN'){
          var resultado = precioUnitario * cantidad;
        }else{
                  //  alert("entro");
                  var resultadoDolares = precioUnitario * cantidad;
                  var resultado = precioUnitario * cantidad * unidadCambio;
                  $(tr).find(".show_dolares").html("$ "+resultadoDolares.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
              }
              var subtotal = $(tr).find(".subtotal").val(resultado);
              var show_subtotal = $(tr).find(".show_subtotal").html("$ "+resultado.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));


              total += resultado;
          });
      $("#total").html("$ "+total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
      $("#iSaldo").val(total - $("#iDeposito").val());
    }
    $(document).ready(function(){
        
        
        $("#iDeposito").change(function(){
            cotizar();
        });
        cotizar();

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

            // especifica si será una petición POST o GET
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

        $( "#skSocioImportador" ).change(function() {
            //alert($( "#skSocioImportador option:selected" ).val());
            $.ajax({
                url : '<?php echo SYS_URL;?>/sys/rex/jsonConceptos/',
                data : {skSocioImportador:$( "#skSocioImportador option:selected" ).val()},

                // especifica si será una petición POST o GET
                type : 'POST',
                dataType : 'json',
                success : function(json) {
                    $("#ConceptosReferenciasTabla").empty();

                    for (o in json) {
                        d = json[o];
                        $("#ConceptosReferenciasTabla").append(`
                            <tr>
                                <td>
                                    <input onchange="cotizar();" value="`+d.skConcepto+`" name="conceptos[]" type="checkbox">
                                </td>
                                <td>
                                    <input name="iCantidad[]" onchange="cotizar();" class="form-control input-sm iCantidad" placeholder="Cant" value="0" type="text">
                                </td>
                                <td>
                                    <input name="fPrecioUnitario[]" onchange="cotizar();" class="form-control input-sm fPrecioUnitario" placeholder="Precio Unitario" value="`+d.dPrecioUnitario+`" type="text">
                                </td>
                                <td style="color:#777;">
                                    `+d.skDivisa+`<input class="divisa" name="divisa[]" value="`+d.skDivisa+`" type="hidden">
                                </td>
                                <td nowrap="">`+d.sNombre+`</td>
                                <td class="show_dolares" nowrap=""></td>
                                <td>
                                    <span class="show_subtotal"></span>
                                    <input name="subtotal[]" class="subtotal" value="" type="hidden">
                                </td>
                            </tr>`);
                    }
                },
                error : function(xhr, status) {
                    console.log("Algo salio mal en la peticion a jsonConceptos")
                },
                complete : function(xhr, status) {
                    console.log('Petición realizada');
                }
            });
        });

        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                sReferencia:{
                    required: true
                },
                skSocioImportador:{
                  required: true
                },
                skAlmacen:{
                  required: true
                },
                skEstatus:{
                  required: true
                },sPedimento:{
                    required: true
                },
                sMercancia:{

                },
                sGuiaMaster:{

                },sGuiaHouse:{

                },
                iBultos:{
                    number:true
                },
                dFechaPrevio:{

                },
                dFechaDespacho:{

                },
                dFechaClasificacion:{

                },
                dFechaGlosa:{

                },
                dFechaCapturaPedimento:{

                },
                dFechaRevalidacion:{

                },
                dFechaFacturacion:{

                },
                iDeposito:{
                    number:true
                },iSaldo:{
                    number:true
                }

            },
            invalidHandler: function (event, validator) { //alerta de error de visualización en forma de presentar
                $('.alert-success').hide();
                $('.alert-danger').show();
                App.scrollTo($('.alert-danger'), -200);
            },
            errorPlacement: function (error, element) { // hacer la colocación de error para cada tipo de entrada
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");
                icon.attr("data-original-title", $('.alert-danger').text()).tooltip({'container': 'body'});
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').size() > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').size() > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else if (element.parents('.checkbox-list').size() > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                } else if (element.parents('.checkbox-inline').size() > 0) {
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // Para otros insumos, sólo realizar comportamiento predeterminado (llamar messages)
                }
            },
            highlight: function (element) { // entradas de error Hightlight
                $(element).closest('.form-group').addClass('has-error'); // conjunto de clases de error
            },
            unhighlight: function (element) { // revertir el cambio realizado por hightlight
            },
            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // conjunto de clases de éxito con el grupo control
                icon.removeClass("fa-warning").addClass("fa-check");
            },
            messages:{
                sReferencia:{
                    required: "Por favor inserte la referencia."
                },
                sPedimento:{
                    required: "Por favor inserte el pedimento."
                }
            }
        });
});
</script>

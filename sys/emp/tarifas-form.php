<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Cliente <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <select name="skEmpresa" id="skEmpresa" class="form-control form-filter input-sm">
                    <option value="">- Cliente -</option>
                    <?php
                        if($data['clientes']){
                            while($row = $data['clientes']->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['skEmpresa']; ?>" <?php echo (isset($result['skEmpresa'])) ? ($result['skEmpresa'] == $row['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($row['sNombre']); ?> </option>
                    <?php
                            }//ENDWHILE
                        }//ENDIF
                    ?>
                </select>
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label col-md-2">Tipo de cambio <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-2">
                <label>
                  <input type="radio" name="sTipoCambio" value="MX" checked>Pesos (MX)
                </label>
            </div>
            <div class="col-md-2">
                <label>
                  <input type="radio" name="sTipoCambio" value="USD" <?php if(isset($result['sTipoCambio']) && $result['sTipoCambio'] == 'USD'){ ?>checked="checked"<?php }//ENDIF ?>>Dolares (USD)
                </label>
            </div>
        </div>
        
<!-- SE SELECCIONA EL TIPO DE TARIFA !-->
        <div class="form-group">
            <label class="control-label col-md-2">Tipo de tarifa <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-2">
                <label>
                  <input type="radio" name="iTipoTarifa" value="1" checked>Por Monto Fijo
                </label>
            </div>
            <div class="col-md-2">
                <label>
                  <input type="radio" name="iTipoTarifa" value="2" <?php if(isset($result['iTipoTarifa']) && $result['iTipoTarifa'] == 2){ ?>checked="checked"<?php }//ENDIF ?>>Por Porcentaje
                </label>
            </div>
            <div class="col-md-2">
                <label>
                  <input type="radio" name="iTipoTarifa" value="3" <?php if(isset($result['iTipoTarifa']) && $result['iTipoTarifa'] == 3){ ?>checked="checked"<?php }//ENDIF ?>>Por Contenedor
                </label>
            </div>
        </div>
        
        <hr>
        
<!-- TARIFA POR MONTO FIJO !-->
        <div class="tarifaMontoFijo" style="display:block;">
            <div class="form-group">
                <label class="control-label col-md-2">Tarifa <span aria-required="true" class="required"> * </span></label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fTarifaPropuesta_1" class="form-control" value="">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Agente Aduanal (AA) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fAgenteAduanal_1" class="form-control" value="<?php echo (isset($result['fAgenteAduanal'])) ? utf8_encode($result['fAgenteAduanal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoAA_1" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoAA_1" value="1" <?php if(isset($result['tipoCalculoAA']) && $result['tipoCalculoAA'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="corresponsalName"></span> (Corresponsal) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fCorresponsal_1" class="form-control" value="<?php echo (isset($result['fCorresponsal'])) ? utf8_encode($result['fCorresponsal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoCorresponsal_1" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoCorresponsal_1" value="1" <?php if(isset($result['tipoCalculoCorresponsal']) && $result['tipoCalculoCorresponsal'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor1Name"></span> (Promotor 1) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor1_1" class="form-control" value="<?php echo (isset($result['fPromotor1'])) ? utf8_encode($result['fPromotor1']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor1_1" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor1_1" value="1" <?php if(isset($result['tipoCalculoPromotor1']) && $result['tipoCalculoPromotor1'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor2Name"></span> (Promotor 2) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor2_1" class="form-control" value="<?php echo (isset($result['fPromotor2'])) ? utf8_encode($result['fPromotor2']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor2_1" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor2_1" value="1" <?php if(isset($result['tipoCalculoPromotor2']) && $result['tipoCalculoPromotor2'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>
        </div>
        
<!-- TARIFA POR PORCENTAJE !-->
        <div class="tarifaPorcentaje" style="display:none;">
            <div class="form-group">
                <label class="control-label col-md-2">Tarifa <span aria-required="true" class="required"> * </span></label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fTarifaPropuesta_2" class="fTarifaPropuesta" class="form-control" value="">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                        <input type="radio" name="fTarifaPropuesta_2" class="tarifaProcentajePersonal" value="0" checked="checked"> Personalizada
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="fTarifaPropuesta_2" value="<?php echo TARIFA_PORCENTAJE_1; ?>" <?php if(isset($result['fTarifaPropuesta']) && $result['fTarifaPropuesta'] == TARIFA_PORCENTAJE_1){ ?>checked="checked"<?php }//ENDIF ?>><?php echo TARIFA_PORCENTAJE_1; ?>
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="fTarifaPropuesta_2" value="<?php echo TARIFA_PORCENTAJE_2; ?>" <?php if(isset($result['fTarifaPropuesta']) && $result['fTarifaPropuesta'] == TARIFA_PORCENTAJE_2){ ?>checked="checked"<?php }//ENDIF ?>><?php echo TARIFA_PORCENTAJE_2 ?>
                    </label>
                </div>
            </div> 
            
            <div class="form-group">
                <label class="control-label col-md-2">Agente Aduanal (AA) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fAgenteAduanal_2" class="form-control" value="<?php echo (isset($result['fAgenteAduanal'])) ? utf8_encode($result['fAgenteAduanal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoAA_2" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoAA_2" value="1" <?php if(isset($result['tipoCalculoAA']) && $result['tipoCalculoAA'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="corresponsalName"></span> (Corresponsal) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fCorresponsal_2" class="form-control" value="<?php echo (isset($result['fCorresponsal'])) ? utf8_encode($result['fCorresponsal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoCorresponsal_2" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoCorresponsal_2" value="1" <?php if(isset($result['tipoCalculoCorresponsal']) && $result['tipoCalculoCorresponsal'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor1Name"></span> (Promotor 1) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor1_2" class="form-control" value="<?php echo (isset($result['fPromotor1'])) ? utf8_encode($result['fPromotor1']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor1_2" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor1_2" value="1" <?php if(isset($result['tipoCalculoPromotor1']) && $result['tipoCalculoPromotor1'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor2Name"></span> (Promotor 2) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor2_2" class="form-control" value="<?php echo (isset($result['fPromotor2'])) ? utf8_encode($result['fPromotor2']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor2_2" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor2_2" value="1" <?php if(isset($result['tipoCalculoPromotor2']) && $result['tipoCalculoPromotor2'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>
        </div>
        
<!-- TARIFA POR RANGO DE CONTENEDORES !-->
        <div class="tarifaPorContenedor"  style="display:none;">
            <div class="form-group">
                <label class="control-label col-md-2">Tipo <span aria-required="true" class="required"> * </span></label>
                <div class="col-md-3">
                    <label>
                      <input type="radio" name="tipoTarifaContenedor_3" value="1" checked>Por Rango
                    </label>
                </div>
                <div class="col-md-3">
                    <label>
                      <input type="radio" name="tipoTarifaContenedor_3" value="2" <?php if(isset($result['fTarifaPropuesta']) && $result['fTarifaPropuesta'] == 'USD'){ ?>checked="checked"<?php }//ENDIF ?>>Por Precio de Contenedor
                    </label>
                </div>
            </div>
            
            <div class="form-group fTarifaPropuesta_3" style="display: none;">
                <label class="control-label col-md-2">Tarifa <span aria-required="true" class="required"> * </span></label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fTarifaPropuesta_3" class="form-control" disabled="disabled" value="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Agente Aduanal (AA) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fAgenteAduanal_3" class="form-control" value="<?php echo (isset($result['fAgenteAduanal'])) ? utf8_encode($result['fAgenteAduanal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoAA_3" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoAA_3" value="1" <?php if(isset($result['tipoCalculoAA']) && $result['tipoCalculoAA'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="corresponsalName"></span> (Corresponsal) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fCorresponsal_3" class="form-control" value="<?php echo (isset($result['fCorresponsal'])) ? utf8_encode($result['fCorresponsal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoCorresponsal_3" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoCorresponsal_3" value="1" <?php if(isset($result['tipoCalculoCorresponsal']) && $result['tipoCalculoCorresponsal'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor1Name"></span> (Promotor 1) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor1_3" class="form-control" value="<?php echo (isset($result['fPromotor1'])) ? utf8_encode($result['fPromotor1']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor1_3" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor1_3" value="1" <?php if(isset($result['tipoCalculoPromotor1']) && $result['tipoCalculoPromotor1'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor2Name"></span> (Promotor 2) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor2_3" class="form-control" value="<?php echo (isset($result['fPromotor2'])) ? utf8_encode($result['fPromotor2']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor2_3" value="0" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoCalculoPromotor2_3" value="1" <?php if(isset($result['tipoCalculoPromotor2']) && $result['tipoCalculoPromotor2'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>
        <!-- RANGOS DE CONTENEDORES !-->
            <div class="tarifaContenedorRango" style="display:block;">
                <div id="rangos" style="display: block;">
                    <div class="form-group">
                        <label class="control-label col-md-1">DE <span aria-required="true" class="required"> * </span></label>
                        <div class="col-md-2">
                            <div class="input-icon right"> <i class="fa"></i>
                                <input type="number" name="rango1_3[]" class="form-control inpRango" disabled="disabled" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                            </div>
                        </div>
                        <label class="control-label col-md-1">HASTA <span aria-required="true" class="required"> * </span></label>
                        <div class="col-md-2">
                            <div class="input-icon right"> <i class="fa"></i>
                                <input type="number" name="rango2_3[]" class="form-control inpRango" disabled="disabled" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                            </div>
                        </div>
                        <label class="control-label col-md-1">$ <span aria-required="true" class="required"> * </span></label>
                        <div class="col-md-2">
                            <div class="input-icon right"> <i class="fa"></i>
                                <input type="number" name="tarifa_3[]" class="form-control inpRango" disabled="disabled" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                            </div>
                        </div>
                        <a href="javascript:void(0);" id="addRank" class="btn btn-default btn-sm">
                            <i class="fa fa-plus-circle"></i> Agregar
                        </a>
                    </div>
                </div>
            </div>

            <!-- TARIFA POR CONTENEDOR !-->
            <div class="tarifaContenedor" style="display:none;">

            </div>
        </div>
        
        
        
       
        
      
        
            
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    var porcentaje = 0;
    $(document).ready(function(){
        
        $("#skEmpresa").change(function(){
            if($(this).val() != ""){
                $.post('',{axn:'getCliente',skEmpresa:$(this).val()},function(data){
                    if(data[0]['corresponsal']){
                        $("input[name=fCorresponsal_1] , input[name=fCorresponsal_2] , input[name=fCorresponsal_3]").attr("disabled",false);
                        $(".corresponsalName").html(data[0]['corresponsal']);
                    }else{
                        $("input[name=fCorresponsal_1] , input[name=fCorresponsal_2] , input[name=fCorresponsal_3]").attr("disabled",true);
                        $(".corresponsalName").html("");
                    }
                    if(data[0]['promotor1']){
                        $("input[name=fPromotor1_1] , input[name=fPromotor1_2] , input[name=fPromotor1_3]").attr("disabled",false);
                        $(".promotor1Name").html(data[0]['promotor1']);
                    }else{
                        $("input[name=fPromotor1_1] , input[name=fPromotor1_2] , input[name=fPromotor1_3]").attr("disabled",true);
                        $(".promotor1Name").html("");
                    }
                    if(data[0]['promotor2']){
                        $("input[name=fPromotor2_1] , input[name=fPromotor2_2] , input[name=fPromotor2_3]").attr("disabled",false);
                        $(".promotor2Name").html(data[0]['promotor2']);
                    }else{
                        $("input[name=fPromotor2_1] , input[name=fPromotor2_2] , input[name=fPromotor2_3]").attr("disabled",true);
                        $(".promotor2Name").html("");
                    }
                });
            }
        });
        $('input[type=radio][name=iTipoTarifa]').change(function() {
            var iTipoTarifa = $(this).val();
            switch(iTipoTarifa) {
                case "1":
                    // MONTO FIJO //
                    $(".tarifaMontoFijo").css("display","block");
                    $('.tarifaMontoFijo').find("input").attr("disabled",false);
                    // POR PORCENTAJE //
                    $(".tarifaPorcentaje").css("display","none");
                    $('.tarifaPorcentaje').find("input").attr("disabled",true);
                    // POR CONTENEDOR //
                    $(".tarifaPorContenedor").css("display","none");
                    $('.tarifaPorContenedor').find("input").attr("disabled",true);
                    break;
                case "2":
                    // MONTO FIJO //
                    $(".tarifaMontoFijo").css("display","none");
                    $('.tarifaMontoFijo').find("input").attr("disabled",true);
                    // POR PORCENTAJE //
                    $(".tarifaPorcentaje").css("display","block");
                    $('.tarifaPorcentaje').find("input").attr("disabled",false);
                    // POR CONTENEDOR //
                    $(".tarifaPorContenedor").css("display","none");
                    $('.tarifaPorContenedor').find("input").attr("disabled",true);
                    break;
                case "3":
                    // MONTO FIJO //
                    $(".tarifaMontoFijo").css("display","none");
                    $('.tarifaMontoFijo').find("input").attr("disabled",true);
                    // POR PORCENTAJE //
                    $(".tarifaPorcentaje").css("display","none");
                    $('.tarifaPorcentaje').find("input").attr("disabled",true);
                    // POR CONTENEDOR //
                    $(".tarifaPorContenedor").css("display","block");
                    $('.tarifaPorContenedor').find("input").attr("disabled",false);
                    break;
            }
        });
        $(".fTarifaPropuesta").change(function(){
            if(parseFloat($(this).val())){
                $(".tarifaProcentajePersonal").val($(this).val());
            }
        });
        $('input[type=radio][name=tipoTarifaContenedor_3]').change(function() {
            var tipo = $(this).val();
            switch(tipo) {
                case "1":
                    $(".tarifaContenedorRango").css("display","block");
                    $('.tarifaContenedorRango').find("input").attr("disabled",false);
                    // Ocultamos Tarifa Propuesta en la Tartifa por Rango //
                    $(".fTarifaPropuesta_3").css("display","none");
                    $("input[name=fTarifaPropuesta_3]").attr("disabled",true);
                    break;
                case "2":
                    $(".tarifaContenedorRango").css("display","none");
                    $('.tarifaContenedorRango').find("input").attr("disabled",true);
                    // Mostramos Tarifa Propuesta en la Tartifa por Rango //
                    $(".fTarifaPropuesta_3").css("display","block");
                    $("input[name=fTarifaPropuesta_3]").attr("disabled",false);
                    break;
            }
        });
        // AGREGAR UN RANGO MAS PARA LA TARIFA DE TIPO CONTENEDOR POR RANGO //
        $("#addRank").click(function(){
            var cad = '<div class="form-group"><label class="control-label col-md-1">DE <span aria-required="true" class="required"> * </span></label><div class="col-md-2"><div class="input-icon right"> <i class="fa"></i><input type="number" name="rango1_3[]" class="form-control inpRango" value=""></div></div><label class="control-label col-md-1">HASTA <span aria-required="true" class="required"> * </span></label><div class="col-md-2"><div class="input-icon right"> <i class="fa"></i><input type="number" name="rango2_3[]" class="form-control inpRango" value=""></div></div><label class="control-label col-md-1">$ <span aria-required="true" class="required"> * </span></label><div class="col-md-2"><div class="input-icon right"> <i class="fa"></i><input type="number" name="tarifa_3[]" class="form-control inpRango" value=""></div></div><a href="javascript:void(0);" class="btn btn-default btn-sm delRank"><i class="fa fa-trash-o"></i> Eliminar</a></div>';
            $(cad).appendTo("#rangos");
        });
        // REMUEVE UN RANGO DE LA TARIFA DE TIPO CONTENEDOR POR RANGO //
        $("body").delegate(".delRank","click",function(){
            $(this).parent().remove();
        });
        
        
        
        
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ":hidden",
            rules:{
                skEmpresa:{
                    required: true
                },
                fTarifa:{
                    required: true,
                    number: true
                },
                fAgenteAduanal:{
                    required: true,
                    number: true
                },
                fCorresponsal:{
                    required: true,
                    number: true
                },
                fPromotor1:{
                    required: true,
                    number: true
                },
                fPromotor2:{
                    required: true,
                    number: true
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
                skEmpresa:{
                    required: "Campo obligatorio."
                },
                fTarifa:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                },
                fAgenteAduanal:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                },
                fCorresponsal:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                },
                fPromotor1:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                },
                fPromotor2:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                }
            }
        });
    }); 
</script>
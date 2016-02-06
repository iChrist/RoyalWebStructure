<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <input type="hidden" name="skPromotores"  id="skPromotores" value="<?php echo (isset($result['skPromotores'])) ? $result['skPromotores'] : '' ; ?>">
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
        
        
        
        
        <!-- COMIENZA TARIFA POR CONTENEDOR !-->
        <div id="tarifaPorContenedor" style="display: none;">
            <div class="form-group">
                <label class="control-label col-md-2">Tipo <span aria-required="true" class="required"> * </span></label>
                <div class="col-md-3">
                    <label>
                      <input type="radio" name="tipoTarifaContenedor" value="1" checked>Por Rango
                    </label>
                </div>
                <div class="col-md-3">
                    <label>
                      <input type="radio" name="tipoTarifaContenedor" value="2" <?php if(isset($result['fTarifaPropuesta']) && $result['fTarifaPropuesta'] == 'USD'){ ?>checked="checked"<?php }//ENDIF ?>>Por Precio de Contenedor
                    </label>
                </div>
            </div>
            <div id="rangos" style="display: block;">
                <div class="form-group">
                    <label class="control-label col-md-1">DE <span aria-required="true" class="required"> * </span></label>
                    <div class="col-md-2">
                        <div class="input-icon right"> <i class="fa"></i>
                            <input type="number" name="rango1[]" class="form-control inpRango" disabled="disabled" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                        </div>
                    </div>
                    <label class="control-label col-md-1">HASTA <span aria-required="true" class="required"> * </span></label>
                    <div class="col-md-2">
                        <div class="input-icon right"> <i class="fa"></i>
                            <input type="number" name="rango2[]" class="form-control inpRango" disabled="disabled" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                        </div>
                    </div>
                    <label class="control-label col-md-1">$ <span aria-required="true" class="required"> * </span></label>
                    <div class="col-md-2">
                        <div class="input-icon right"> <i class="fa"></i>
                            <input type="number" name="tarifa[]" class="form-control inpRango" disabled="disabled" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                        </div>
                    </div>
                    <a href="javascript:void(0);" id="addRank" class="btn btn-default btn-sm">
                        <i class="fa fa-plus-circle"></i> Agregar
                    </a>
                </div>
            </div>
            <div id="precioContenedor" style="display: none;">
                <div class="form-group">
                    <label class="control-label col-md-2">Tarifa <span aria-required="true" class="required"> * </span></label>
                    <div class="col-md-2">
                        <div class="input-icon right"> <i class="fa"></i>
                            <input type="number" name="fTarifaPropuesta" class="form-control inpfTarifaPropuesta" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>" disabled="disabled">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TERMINA TARIFA POR CONTENEDOR !-->
        
        
        
        
        <!-- COMIENZA LA TARIFA PORCENTAJE | MONTO FIJO !-->
        <div class="tarifaPorcentajeMontoFijo" style="display:block;">
            
            <div class="form-group" id="tarifaPorcentajeMontoFijo">
                <label class="control-label col-md-2">Tarifa <span aria-required="true" class="required"> * </span></label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fTarifaPropuesta" id="fTarifa" class="form-control input_tarifaPorcentajeMontoFijo" value="<?php echo (isset($result['fTarifaPropuesta'])) ? utf8_encode($result['fTarifaPropuesta']) : '' ; ?>">
                    </div>
                </div>
                <div id="tarifaPorcentaje" style="display:none;">
                    <div class="col-md-2">
                        <label>
                            <input type="radio" name="fTarifaPropuesta" id="procentajePersonal" class="radTarifaPorcentaje input_tarifaPorcentajeMontoFijo" value="0" checked="checked"> Personalizada
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label>
                          <input type="radio" name="fTarifaPropuesta" class="radTarifaPorcentaje input_tarifaPorcentajeMontoFijo" value="<?php echo TARIFA_PORCENTAJE_1; ?>" <?php if(isset($result['fTarifaPropuesta']) && $result['fTarifaPropuesta'] == TARIFA_PORCENTAJE_1){ ?>checked="checked"<?php }//ENDIF ?>><?php echo TARIFA_PORCENTAJE_1; ?>
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label>
                          <input type="radio" name="fTarifaPropuesta" class="radTarifaPorcentaje input_tarifaPorcentajeMontoFijo" value="<?php echo TARIFA_PORCENTAJE_2; ?>" <?php if(isset($result['fTarifaPropuesta']) && $result['fTarifaPropuesta'] == TARIFA_PORCENTAJE_2){ ?>checked="checked"<?php }//ENDIF ?>><?php echo TARIFA_PORCENTAJE_2 ?>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-4 col-md-offset-2" id="procentaje" style="font-weight: bolder;">

                </label>
            </div>
            
            
            <div class="form-group">
                <label class="control-label col-md-2">Agente Aduanal (AA) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fAgenteAduanal" id="fAgenteAduanal" class="form-control porcentajes input_tarifaPorcentajeMontoFijo" value="<?php echo (isset($result['fAgenteAduanal'])) ? utf8_encode($result['fAgenteAduanal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaAA" value="0" class="input_tarifaPorcentajeMontoFijo" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaAA" value="1" class="input_tarifaPorcentajeMontoFijo" <?php if(isset($result['tipoTarifaAA']) && $result['tipoTarifaAA'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span id="corresponsal"></span> (Corresponsal) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fCorresponsal" id="fCorresponsal" class="form-control porcentajes input_tarifaPorcentajeMontoFijo" value="<?php echo (isset($result['fCorresponsal'])) ? utf8_encode($result['fCorresponsal']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaCorresponsal" value="0" class="input_tarifaPorcentajeMontoFijo" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaCorresponsal" value="1" class="input_tarifaPorcentajeMontoFijo" <?php if(isset($result['tipoTarifaCorresponsal']) && $result['tipoTarifaCorresponsal'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span class="promotor1"></span> (Promotor 1) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor1" id="fPromotor1" class="form-control porcentajes input_tarifaPorcentajeMontoFijo" value="<?php echo (isset($result['fPromotor1'])) ? utf8_encode($result['fPromotor1']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaPromotor1" value="0" class="input_tarifaPorcentajeMontoFijo" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaPromotor1" value="1" class="input_tarifaPorcentajeMontoFijo" <?php if(isset($result['tipoTarifaPromotor1']) && $result['tipoTarifaPromotor1'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2"><span id="promotor2"></span> (Promotor 2) %<span aria-required="true" class="required"> * </span> </label>
                <div class="col-md-2">
                    <div class="input-icon right"> <i class="fa"></i>
                        <input type="number" name="fPromotor2" id="fPromotor2" class="form-control porcentajes input_tarifaPorcentajeMontoFijo" value="<?php echo (isset($result['fPromotor2'])) ? utf8_encode($result['fPromotor2']) : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaPromotor2" value="0" class="input_tarifaPorcentajeMontoFijo" checked>Porcentaje
                    </label>
                </div>
                <div class="col-md-2">
                    <label>
                      <input type="radio" name="tipoTarifaPromotor2" value="1" class="input_tarifaPorcentajeMontoFijo" <?php if(isset($result['tipoTarifaPromotor2']) && $result['tipoTarifaPromotor2'] == 1){ ?>checked="checked"<?php }//ENDIF ?>>Monto Fijo
                    </label>
                </div>
            </div>
        </div>
        <!-- TERMINA LA TARIFA PORCENTAJE | MONTO FIJO !-->
        
            
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    var porcentaje = 0;
    $(document).ready(function(){
        $("#skEmpresa").change(function(){
            if($(this).val() != ""){
                $.post('',{axn:'getCliente',skEmpresa:$(this).val()},function(data){
                    $("#corresponsal").html(data[0]['corresponsal']);
                    $("#promotor1").html(data[0]['promotor1']);
                    $("#promotor2").html(data[0]['promotor2']);
                });
            }
        });
        $('input[type=radio][name=iTipoTarifa]').change(function() {
            var iTipoTarifa = $(this).val();
            switch(iTipoTarifa) {
                case "1":
                    $(".tarifaPorcentajeMontoFijo").css("display","block");
                    $(".input_tarifaPorcentajeMontoFijo").attr("disabled",false);
                    $("#tarifaPorcentaje").css("display","none");
                    $("#tarifaPorContenedor").css("display","none");
                    $('.inpRango').attr("disabled",true);
                    break;
                case "2":
                    $(".tarifaPorcentajeMontoFijo").css("display","block");
                    $(".input_tarifaPorcentajeMontoFijo").attr("disabled",false);
                    $("#tarifaPorcentaje").css("display","block");
                    $("#tarifaPorContenedor").css("display","none");
                    $('.inpRango').attr("disabled",true);
                    $("#fTarifa").attr("disabled",false);
                    $("#fTarifa").css("display","block");
                    break;
                case "3":
                    // REPARTO DE TARIFA //
                    $(".tarifaPorcentajeMontoFijo").css("display","block");
                    $(".input_tarifaPorcentajeMontoFijo").attr("disabled",false);
                    $("#tarifaPorcentajeMontoFijo").css("display","none");
                    $("#fTarifa").attr("disabled",true);
                    $("#tarifaPorcentaje").css("display","none");
                    $("#tarifaPorContenedor").css("display","block");
                    $('.inpRango').attr("disabled",false);
                    break;
            }
        });
        $("#fTarifa").change(function(){
            if(parseFloat($(this).val())){
                $("#procentajePersonal").val($(this).val());
            }
        });
        $('input[type=radio][name=tipoTarifaContenedor]').change(function() {
            var tipo = $(this).val();
            switch(tipo) {
                case "1":
                    $("#rangos").css("display","block");
                    $('.inpRango').attr("disabled",false);
                    $("#precioContenedor").css("display","none");
                    $(".inpfTarifaPropuesta").attr("disabled",true);
                    // REPARTO DE TARIFA //
                    $(".tarifaPorcentajeMontoFijo").css("display","block");
                    $(".input_tarifaPorcentajeMontoFijo").attr("disabled",false);
                    $("#tarifaPorcentajeMontoFijo").css("display","none");
                    $("#fTarifa").attr("disabled",true);
                    break;
                case "2":
                    $(".tarifaPorcentajeMontoFijo").css("display","none");
                    $(".input_tarifaPorcentajeMontoFijo").attr("disabled",true);
                    $("#precioContenedor").css("display","block");
                    $("#rangos").css("display","none");
                    $('.inpRango').attr("disabled",true);
                    $(".inpfTarifaPropuesta").attr("disabled",false);
                    break;
            }
        });
        // AGREGAR UN RANGO MAS PARA LA TARIFA DE TIPO CONTENEDOR POR RANGO //
        $("#addRank").click(function(){
            var cad = '<div class="form-group"><label class="control-label col-md-1">DE <span aria-required="true" class="required"> * </span></label><div class="col-md-2"><div class="input-icon right"> <i class="fa"></i><input type="number" name="rango1[]" class="form-control inpRango" value=""></div></div><label class="control-label col-md-1">HASTA <span aria-required="true" class="required"> * </span></label><div class="col-md-2"><div class="input-icon right"> <i class="fa"></i><input type="number" name="rango2[]" class="form-control inpRango" value=""></div></div><label class="control-label col-md-1">$ <span aria-required="true" class="required"> * </span></label><div class="col-md-2"><div class="input-icon right"> <i class="fa"></i><input type="number" name="tarifa[]" class="form-control inpRango" value=""></div></div><a href="javascript:void(0);" class="btn btn-default btn-sm delRank"><i class="fa fa-trash-o"></i> Eliminar</a></div>';
            $(cad).appendTo("#rangos");
        });
        // REMUEVE UN RANGO DE LA TARIFA DE TIPO CONTENEDOR POR RANGO //
        $("body").delegate(".delRank","click",function(){
            $(this).parent().remove();
        });
        // VALIDADOR DE SUMA DE PORCENTAJE //
        /*$.validator.addMethod(
            "validarPorcentaje", 
            function(value, element) {
                porcentaje = 
                      parseInt(($("#fAgenteAduanal").val()) ? $("#fAgenteAduanal").val() : 0) 
                    + parseInt(($("#fCorresponsal").val()) ? $("#fCorresponsal").val() : 0)
                    + parseInt(($("#fPromotor1").val()) ? $("#fPromotor1").val() : 0)
                    + parseInt(($("#fPromotor2").val()) ? $("#fPromotor2").val() : 0);
                $("#procentaje").html("Suma de porcentajes: "+porcentaje+"%");
                if(porcentaje > 0 && porcentaje <= 100){
                    $("#procentaje").css("color","green");
                    $("#procentaje").html("Suma de porcentajes: "+porcentaje+"%");
                    // SUCCESS INPUT //
                    var icon = $(".porcentajes").parent('.input-icon').children('i');
                    $(".porcentajes").closest('.form-group').removeClass('has-error').addClass('has-success');
                    icon.removeClass("fa-warning").addClass("fa-check");
                    return true;
                }else{
                    $("#procentaje").css("color","red");
                    $("#procentaje").html("Suma de porcentajes: "+porcentaje+"%");
                    var icon = $(".porcentajes").parent('.input-icon').children('i');
                    $(".porcentajes").closest('.form-group').removeClass('has-success').addClass('has-error');
                    icon.removeClass("fa-check").addClass("fa-warning");
                    return false;
                }
            },
            "La suma de los porcentajes debe ser menor o igual a 100%"
        );*/
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
                    number: true,
                    //validarPorcentaje: true
                },
                fCorresponsal:{
                    required: true,
                    number: true,
                    //validarPorcentaje: true
                },
                fPromotor1:{
                    required: true,
                    number: true,
                    //validarPorcentaje: true
                },
                fPromotor2:{
                    required: true,
                    number: true,
                    //validarPorcentaje: true
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
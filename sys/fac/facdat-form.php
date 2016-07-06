<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skFacturacion"  id="skFacturacion" value="<?php echo (isset($result['skFacturacion'])) ? $result['skFacturacion'] : '' ; ?>">
    <input type="hidden" name="skTarifa"  id="skTarifa" value="">
    <div class="form-body">
        
        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="sReferencia" id="sReferencia" class="form-control" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <hr>
        <div class="form-group" id="dvDatos"></div>
        <hr>
        <div class="form-group" id="tarifa">
            <label class="col-md-3">Tipo Cambio: <span id="sTipoCambio"></span></label>
            <label class="col-md-3">Tipo Tarifa: <span id="tipoTarifa"></span></label>
        </div>
  
        <div class="form-group">
            <label class="control-label col-md-2">Fecha facturaci&oacute;n <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaFacturacion" name="dFechaFacturacion" placeholder="dd-mm-aaaa" class="form-control" value="<?php echo (isset($result['dFechaFacturacion'])) ?  utf8_encode(date('d-m-Y', strtotime($result['dFechaFacturacion']))) : date('d-m-Y') ; ?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Folio <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="sFolio" id="sFolio" class="form-control" placeholder="Folio" value="<?php echo (isset($result['sFolio'])) ? utf8_encode($result['sFolio']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Importe <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fImporte" id="fImporte" class="form-control calcular" placeholder="Importe" value="<?php echo (isset($result['fImporte'])) ? utf8_encode($result['fImporte']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">IVA %<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fIva" id="fIva" class="form-control" placeholder="IVA" value="<?php echo (isset($result['fIva'])) ? utf8_encode($result['fIva']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Total Facturado<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fTotalFacturado" id="fTotalFacturado" class="form-control" placeholder="Total Facturado" value="<?php echo (isset($result['fTotalFacturado'])) ? utf8_encode($result['fTotalFacturado']) : '' ; ?>" disabled>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Valor del Dolar $<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fValorDolar" id="fValorDolar" class="form-control" value="<?php echo (isset($result['fValorDolar'])) ? utf8_encode($result['fValorDolar']) : '' ; ?>">
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-4 col-md-offset-2" id="procentaje" style="font-weight: bolder;">

            </label>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Agente Aduanal (AA) %<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fAgenteAduanal" id="fAgenteAduanal" class="form-control porcentajes calcular" value="<?php echo (isset($result['fAgenteAduanal'])) ? utf8_encode($result['fAgenteAduanal']) : '' ; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2"><span id="corresponsal"></span> (Corresponsal) %<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fCorresponsal" id="fCorresponsal" class="form-control porcentajes calcular" value="<?php echo (isset($result['fCorresponsal'])) ? utf8_encode($result['fCorresponsal']) : '' ; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2"><span id="promotor1"></span> (Promotor 1) %<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fPromotor1" id="fPromotor1" class="form-control porcentajes calcular" value="<?php echo (isset($result['fPromotor1'])) ? utf8_encode($result['fPromotor1']) : '' ; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2"><span id="promotor2"></span> (Promotor 2) %<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fPromotor2" id="fPromotor2" class="form-control porcentajes calcular" value="<?php echo (isset($result['fPromotor2'])) ? utf8_encode($result['fPromotor2']) : '' ; ?>">
                </div>
            </div>
        </div>
                
        <div class="form-group">
            <label class="control-label col-md-2">Ganancia CG<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fGanancia" id="fGanancia" class="form-control" placeholder="Ganancia CG" value="<?php echo (isset($result['fGanancia'])) ? utf8_encode($result['fGanancia']) : '' ; ?>" disabled>
                </div>
            </div>
        </div>
        
        <div class="form-group" id="tarifa">
            
            <label class="control-label col-md-2" style="font-weight: bold;">Ganacia Agente Aduanal: $<span id="AA"></span></label>
            <label class="control-label col-md-2" style="font-weight: bold;">Ganancia (Corresponsal): $<span id="gananciaCorresponsal"></span></label>
            <label class="control-label col-md-2" style="font-weight: bold;">Ganancia (Promotor 1): $<span id="gananciaPromotor1"></span></label>
            <label class="control-label col-md-2" style="font-weight: bold;">Ganancia (Promotor 2): $<span id="gananciaPromotor2"></span></label>
            <label class="control-label col-md-2" style="font-weight: bold;">Ganancia GC: $<span id="gananciagc"></span></label>
        </div>
        
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    var iTipoTarifa = 0;
function obtenerDatos(){
    $('.page-title-loading').css('display','inline');
        var response = true;
        $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){ 
        var cad = '';
        if(!data.data){
            response = false;
            var icon = $("#sReferencia").parent('.input-icon').children('i');
            $("#sReferencia").closest('.form-group').removeClass('has-success').addClass('has-error');
            icon.removeClass("fa-check").addClass("fa-warning");
        }else{   
    	cad ='<div class="form-group">'+
     	'<label class="col-md-2">Cliente</label>'+
     	'<div class="col-md-4">'+
       	'<label id="lbCliente" class="control-label">'+data.data.Empresa+'</label>'+
        '</div>'+
      	'<label class="control-label col-md-2">Tipo de Servicio</label>'+
	     '<div class="col-md-4">'+
	       ' <label id="lbServicio" class="control-label">'+data.data.TipoServicio+'</label>'+
	    ' </div>'+
   ' </div>'+
    '<div class="form-group">'+
     	'<label class="col-md-2">Ejecutivo</label>'+
     	'<div class="col-md-4">'+
       	'	 <label id="lbEjecutivo" class="control-label">'+data.data.Ejecutivo+'</label>'+
       ' </div>'+
      	'<label class="control-label col-md-2">Mercancia</label>'+
	    ' <div class="col-md-4">'+
	    '    <label id="lbMercancia" class="control-label ">'+data.data.sMercancia+'</label>'+
	    ' </div>'+
   ' </div>'+
    '<div class="form-group">'+
      '<label class="col-md-2">Datos del tipo de servicio</label>'+
      '<div class="col-md-2">'+
        '  <label class="control-label">Num. Contenedor: '+data.data.sNumContenedor+'</label>'+
       ' </div>'+
      ' <div class="col-md-2">'+
      '    <label class="control-label ">Bultos: '+data.data.iBultos+'</label>'+
      ' </div>'+
      ' <div class="col-md-2">'+
      '    <label class="control-label ">Peso: '+data.data.fPeso+'</label>'+
      ' </div>'+
      ' <div class="col-md-2">'+
      '    <label class="control-label ">Volumen: '+data.data.fVolumen+'</label>'+
      ' </div>'+
   ' </div>';
            $.post("",{ axn : "getTarifa" , skEmpresa : data.data.skEmpresa }, function(data){
                if(data){
                    console.log(data);
                    $("#skTarifa").val(data[0]['skTarifa']);
                    $("#sTipoCambio").html(data[0]['sTipoCambio']);
                    $("#tipoTarifa").html(data[0]['tarifa']);
                    iTipoTarifa = data[0]['iTipoTarifa'];
                    switch(iTipoTarifa) {
                        case "1": // Por Monto Fijo
                            $("#fImporte").val(data[0]['fTarifa']);
                            break;
                        case "2": // Por Procentaje
                            break;
                        case "3": // Por Contenedor
                            break;
                    }
                }
                $('.page-title-loading').css('display','none');
            });
   }
    $("#dvDatos").html(cad);
    });
    if(response){
         return true;
    }else{
         return false;
    }
}

    $(document).ready(function(){
        $(".calcular").change(function(){
            switch(iTipoTarifa) {
                case "1": // Por Monto Fijo
                    _fAgenteAduanal = parseFloat(($("#fAgenteAduanal").val()) ? $("#fAgenteAduanal").val() : 0)
                    var fAgenteAduanal = ( (_fAgenteAduanal / 100) * (parseFloat($("#fImporte").val())) );
                    $("#AA").html(fAgenteAduanal);
                    
                    _fCorresponsal = parseFloat(($("#fCorresponsal").val()) ? $("#fCorresponsal").val() : 0)
                    var fCorresponsal = ( (_fCorresponsal / 100) * (parseFloat($("#fImporte").val())) );
                    $("#gananciaCorresponsal").html(fCorresponsal);
                    
                    _fPromotor1 = parseFloat(($("#fPromotor1").val()) ? $("#fPromotor1").val() : 0)
                    var fPromotor1 = ( (_fPromotor1 / 100) * (parseFloat($("#fImporte").val())) );
                    $("#gananciaPromotor1").html(fPromotor1);
                    
                    _fPromotor2 = parseFloat(($("#fPromotor2").val()) ? $("#fPromotor2").val() : 0)
                    var fPromotor2 = ( (_fPromotor2 / 100) * (parseFloat($("#fImporte").val())) );
                    $("#gananciaPromotor2").html(fPromotor2);
                    
                    var gananciagc = parseFloat($("#fImporte").val()) - _fAgenteAduanal - _fCorresponsal - _fPromotor1 - _fPromotor2;
                    $("#gananciagc").html(gananciagc);
                    
                    break;
                case "2": // Por Procentaje
                    break;
                case "3": // Por Contenedor
                    break;
            }
        });
        // VALIDADOR PARA OBTENER DATOS POR REFERENCIA //
        $.validator.addMethod(
            "obtenerDatos", 
            function(value, element) {
                if(obtenerDatos()){
                    return true;
                }else{
                    return false;
                }
            },
            "La referencia no existe."
        );
        // VALIDADOR DE SUMA DE PORCENTAJE //
        $.validator.addMethod(
            "validarPorcentaje", 
            function(value, element) {
                porcentaje = 
                      parseFloat(($("#fAgenteAduanal").val()) ? $("#fAgenteAduanal").val() : 0) 
                    + parseFloat(($("#fCorresponsal").val()) ? $("#fCorresponsal").val() : 0)
                    + parseFloat(($("#fPromotor1").val()) ? $("#fPromotor1").val() : 0)
                    + parseFloat(($("#fPromotor2").val()) ? $("#fPromotor2").val() : 0);
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
        );
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ":hidden",
            rules:{
                sReferencia:{
                    required: true,
                    remote: {
                        url: "",
                        type: "post",
                        data: {
                            sReferencia: function (){return $( "#sReferencia" ).val();},
                            axn: "validarReferencia"
                        }
                    },
                    obtenerDatos: true
                },
                fIva: {
                    required: true,
                    number: true,
                },
                fValorDolar: {
                    required: true,
                    number: true,
                },
                fTotalFacturado: {
                    required: true,
                    number: true,
                },
                fAgenteAduanal:{
                    required: true,
                    number: true,
                    validarPorcentaje: true
                },
                fCorresponsal:{
                    required: true,
                    number: true,
                    validarPorcentaje: true
                },
                fPromotor1:{
                    required: true,
                    number: true,
                    validarPorcentaje: true
                },
                fPromotor2:{
                    required: true,
                    number: true,
                    validarPorcentaje: true
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
                    required:"Campo obligatorio",
                    remote: "La referencia no existe."
                },
                fIva:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                },
                fValorDolar:{
                    required: "Campo obligatorio.",
                    number: "Solo n&uacute;meros."
                },
                fTotalFacturado:{
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
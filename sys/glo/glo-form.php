<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skGlosa"  id="skGlosa" value="<?php echo (isset($result['skProforma'])) ? $result['skProforma'] : '' ; ?>">
    <div class="form-body">
        
        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="sReferencia" id="sReferencia" class="form-control" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? htmlentities(utf8_encode($result['sReferencia'])) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <hr>
        <div class="form-group" id="dvDatos"></div>
        <hr>
        
        <h4>Documentos <em>(Seleccione los documentos faltantes)</em></h4>
            <div class="col-md-12">
                <?php
                    if($data['docGlo']){
                        foreach($data['docGlo'] AS $k=>$v){
                ?>
                <div class="col-md-6">
                    <?php if(count($v['children']) > 0){ ?>
                    <fieldset>
                    <legend>
                    <?php }//ENDIF ?>
                        <div class="col-md-6">
                            <input type="checkbox" name="docGlo[]" value="<?php echo $v['skDocGlosa']; ?>"> <?php echo htmlentities($v['sNombre']); ?>
                        </div>
                    <?php if(count($v['children']) > 0){ ?>
                    </legend>
                    <div class="clearfix"></div><br>
                    <?php foreach($v['children'] AS $key=>$val){ ?>
                            <div class="col-md-6">    
                                <input type="checkbox" parent="<?php echo $v['skDocGlosa']; ?>" name="docGlo[]" value="<?php echo $val['skDocGlosa']; ?>"> <?php echo htmlentities($val['sNombre']); ?>
                            </div>
                    <?php }//ENDFOREACH ?>
                    </fieldset>
                    <?php }//ENDIF ?>
                </div>
                <?php
                        }//ENDFOREACH
                    }//ENDIF
                ?>
            </div>
        <div class="clearfix"></div><br>
        <div class="form-group">
            <label class="control-label col-md-2">Observaciones del Pedimento <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-8">
                <div class="input-icon right"> <i class="fa"></i>
                    <textarea rows="5"  name="sObservacionesPedimento" id="sObservacionesPedimento" class="form-control" placeholder="Observaciones del Pedimento"  ><?php echo (isset($result['sObservacionesPedimento'])) ? htmlentities(utf8_encode($result['sObservacionesPedimento'])) : '' ; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
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
   ' </div>'+
   '<div class="form-group">'+
      ' <div class="col-md-4">'+
      '    <label class="control-label ">BL Master: '+data.data.sBlMaster+'</label>'+
      ' </div>'+
      ' <div class="col-md-4">'+
      '    <label class="control-label ">BL House: '+data.data.sBlHouse+'</label>'+
      ' </div>'+
   ' </div>';
   }
    $("#dvDatos").html(cad);
    $('.page-title-loading').css('display','none');
    });
    if(response){
         return true;
    }else{
         return false;
    }
}

    $(document).ready(function(){
        
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
                sObservacionesPedimento:{
                    required: true,
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
                sObservacionesPedimento:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>
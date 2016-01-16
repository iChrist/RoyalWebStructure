<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skFacturacion"  id="skFacturacion" value="<?php echo (isset($result['skFacturacion'])) ? $result['skFacturacion'] : '' ; ?>">
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
                    <input type="text" name="fImporte" id="fImporte" class="form-control" placeholder="Importe" value="<?php echo (isset($result['fImporte'])) ? utf8_encode($result['fImporte']) : '' ; ?>" >
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
                    <input type="text" name="fTotalFacturado" id="fTotalFacturado" class="form-control" placeholder="Total Facturado" value="<?php echo (isset($result['fTotalFacturado'])) ? utf8_encode($result['fTotalFacturado']) : '' ; ?>" >
                </div>
            </div>
        </div>
                
        <div class="form-group">
            <label class="control-label col-md-2">Ganancia<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fGanancia" id="fGanancia" class="form-control" placeholder="Ganancia" value="<?php echo (isset($result['fGanancia'])) ? utf8_encode($result['fGanancia']) : '' ; ?>" >
                </div>
            </div>
        </div>
                
        <div class="form-group">
            <label class="control-label col-md-2">AA<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fAA" id="fAA" class="form-control" placeholder="AA" value="<?php echo (isset($result['fAA'])) ? utf8_encode($result['fAA']) : '' ; ?>" >
                </div>
            </div>
        </div>
                
        <div class="form-group">
            <label class="control-label col-md-2">Promotor 1<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fPromotor1" id="fPromotor1" class="form-control" placeholder="Promotor 1" value="<?php echo (isset($result['fPromotor1'])) ? utf8_encode($result['fPromotor1']) : '' ; ?>" >
                </div>
            </div>
        </div>
                
        <div class="form-group">
            <label class="control-label col-md-2">Promotor 2<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fPromotor2" id="fPromotor2" class="form-control" placeholder="Promotor 2" value="<?php echo (isset($result['fPromotor2'])) ? utf8_encode($result['fPromotor2']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
function obtenerDatos(){
	  $('.page-title-loading').css('display','inline');
	 $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
             
             //console.log(data);
                //console.log(data.data[0][0]); 
              //  var cad="";
              //if(data['data']){
              //  if(data.data[0]){    
        var cad = '';
        if(!data.data[0]){
            cad ='';
        }else{        
    	cad ='<div class="form-group">'+
     	'<label class="col-md-2">Cliente</label>'+
     	'<div class="col-md-4">'+
       	'<label id="lbCliente" class="control-label">'+data.data[0][0]+'</label>'+
        '</div>'+
      	'<label class="control-label col-md-2">Tipo de Servicio</label>'+
	     '<div class="col-md-4">'+
	       ' <label id="lbServicio" class="control-label">'+data.data[0][1]+'</label>'+
	    ' </div>'+
   ' </div>'+
    '<div class="form-group">'+
     	'<label class="col-md-2">Ejecutivo</label>'+
     	'<div class="col-md-4">'+
       	'	 <label id="lbEjecutivo" class="control-label">'+data.data[0][2]+'</label>'+
       ' </div>'+
      	'<label class="control-label col-md-2">Mercancia</label>'+
	    ' <div class="col-md-4">'+
	    '    <label id="lbMercancia" class="control-label ">'+data.data[0][3]+'</label>'+
	    ' </div>'+
   ' </div>'+
    '<div class="form-group">'+
      '<label class="col-md-2">Datos del tipo de servicio</label>'+
      '<div class="col-md-2">'+
        '  <label class="control-label">Num. Contenedor: '+data.data[0][4]+'</label>'+
       ' </div>'+
      ' <div class="col-md-2">'+
      '    <label class="control-label ">Bultos: '+data.data[0][5]+'</label>'+
      ' </div>'+
      ' <div class="col-md-2">'+
      '    <label class="control-label ">Peso: '+data.data[0][6]+'</label>'+
      ' </div>'+
      ' <div class="col-md-2">'+
      '    <label class="control-label ">Volumen: '+data.data[0][7]+'</label>'+
      ' </div>'+
   ' </div>';
   }
                 $("#dvDatos").html(cad);
               /*$("#sNumeroParte").html(cad);
               $("#sNumeroParte").prop('disabled', false);*/
               $('.page-title-loading').css('display','none');
            });
          //  $('.page-title-loading').css('display','none');
			}

    $(document).ready(function(){
        //obtenerDatos();
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
                        axn: "validarReferencia",
                        skSolicitudRevalidacion:  function (){return $( "#skFacturacion" ).val();}
                      }
                    }
                    
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
                    remote: "Esta referencia no Existe."
                }
            }
        });
    }); 
</script>
<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }


?>
<?php
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skCotizacion"  id="skCotizacion" value="<?php echo (isset($result['skCotizacion'])) ? $result['skCotizacion'] : '' ; ?>">
<<<<<<< HEAD
    <?php
    
    //echo "aaaaa";
//    $a = $data['tipo_cambio']->fetch_assoc();
/*echo "<pre>";
print_r($data['tipo_cambio']['USD']['valor']);
echo "</pre>"; */
  ?>
=======

>>>>>>> 8a4b4c15a618fa52fe02b4656e0c01353d8f6f95
    <div class="form-body">
      <div class="form-group">
        <label class="control-label col-md-2">Tipo de Cotizaci&oacute;n  <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-10">
          <div class="radio-list">
            <?php $i = 0 ?>
            <?php while($rTipoCotizacion =  $data['tipoCotizacion']->fetch_assoc()){?>
            <?php $i++;?>
            <div class="col-md-2">
            <label>
              <input type="radio" name="skTipoCobroCotizacion" value="<?php echo $rTipoCotizacion{'skTipoCobroCotizacion'}?>" <?php echo ((isset($result['skTipoCobroCotizacion']) ? $result['skTipoCobroCotizacion'] : "-") == $rTipoCotizacion{'skTipoCobroCotizacion'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
              <?php echo utf8_encode($rTipoCotizacion{'sNombre'})?>
            </label>
          </div>
            <?php }?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2">Tipo de Tramite <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-10">
          <div class="radio-list">
            <?php $i = 0 ?>
            <?php while($rTipoTramite =  $data['tipoTramite']->fetch_assoc()){?>
            <?php $i++;?>
            <div class="col-md-2">
            <label>
              <input type="radio" name="skTipoTramite" value="<?php echo $rTipoTramite{'skTipoTramite'}?>" <?php echo ((isset($result['skTipoTramite']) ? $result['skTipoTramite'] : "-") == $rTipoTramite{'skTipoTramite'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
              <?php echo utf8_encode($rTipoTramite{'sNombre'})?>
            </label>
          </div>
            <?php }?>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-2">Tipo de Transporte <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-10">
          <div class="radio-list">
            <?php $i = 0 ?>
            <?php while($rTransporte =  $data['tipoTranporte']->fetch_assoc()){?>
            <?php $i++;?>
            <div class="col-md-2">
            <label>
              <input type="radio" name="skTipoTransporte" value="<?php echo $rTransporte{'skTipoTransporte'}?>" <?php echo ((isset($result['skTipoTransporte']) ? $result['skTipoTransporte'] : "-") == $rTransporte{'skTipoTransporte'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
              <?php echo utf8_encode($rTransporte{'sNombre'})?>
            </label>
          </div>
            <?php }?>
          </div>
        </div>
      </div>
  <hr>
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
        <div class="form-group col-md-12" id="dvDatos"></div>
        <div class="form-group">
          <label class="control-label col-md-2">Importador <span aria-required="true" class="required"> * </span> </label>
          <div class="col-md-4">
            <select name="skEmpresaImportador" id="skEmpresaImportador" class="form-control form-filter input-sm" onchange="getConceptosImportador();">
              <option value="">- Importador -</option>
              <?php
                                        if($data['empresaImportador']){
                                            while($rEmpresa = $data['empresaImportador']->fetch_assoc()){
                                    ?>
              <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresaImportador'])) ? ($result['skEmpresaImportador'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']); ?> </option>
              <?php
                                            }//ENDIF
                                        }//ENDWHILE
                                    ?>
            </select>
          </div>
          <label class="control-label col-md-2">L&iacute;nea Naviera <span aria-required="true" class="required"> * </span> </label>
          <div class="col-md-4">
            <select name="skEmpresaNaviera" id="skEmpresaNaviera" class="form-control form-filter input-sm" onchange="getConceptosNaviera();">
              <option value="">- Linea Naviera -</option>
              <?php
                                        if($data['empresaNaviera']){
                                            while($rEmpresa = $data['empresaNaviera']->fetch_assoc()){
                                    ?>
              <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresaNaviera'])) ? ($result['skEmpresaNaviera'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']); ?> </option>
              <?php
                                            }//ENDIF
                                        }//ENDWHILE
                                    ?>
            </select>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">Recinto <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
              <select name="skEmpresaRecinto" id="skEmpresaRecinto" class="form-control form-filter input-sm" onchange="getConceptosRecinto();">
                <option value="">- Recinto -</option>
                <?php
                                          if($data['empresaRecinto']){
                                              while($rEmpresa = $data['empresaRecinto']->fetch_assoc()){
                                      ?>
                <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresaRecinto'])) ? ($result['skEmpresaRecinto'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']); ?> </option>
                <?php
                                              }//ENDIF
                                          }//ENDWHILE
                                      ?>
              </select>
            </div>
        </div>

        <div class="clearfix"></div>
      <hr>
        <div class="form-group">
            <label class="control-label col-md-2">Tipo de Cambio <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fTipoCambio" id="fTipoCambio" class="form-control" placeholder="Tipo de Cambio" value="<?php echo $data['tipo_cambio']['USD']['valor'];?>" >
                </div>
            </div>
            <label class="control-label col-md-2">Valor Mercanc&iacute;a<span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"><i class="fa"></i>
                    <input type="text" name="fValorMercancia" id="fValorMercancia" class="form-control" placeholder="Valor Mercanc&iacute;a" value="" >
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-xs-12" id="divConceptos" style="display: <?php echo isset($_GET['p1']) ? 'block' : 'none'; ?>;">

      <hr>
        <div class="form-group">
            <label class="control-label col-md-2">Conceptos</label>
            <div class="col-md-10">
              <table class="table table-responsive">
                <thead>
                  <th nowrap>S</th>
                  <th nowrap>Cantidad</th>
                  <th nowrap>Precio Unitario</th>
                  <th nowrap>Divisa</th>
                  <th >Nombre</th>
                  <th width="100%"></th>

                  <th nowrap>Subtotal</th>
                </thead>
                <tbody id="dvConceptosPedimento">
                </tbody>
                <tbody id="dvConceptosNaviera">
                </tbody>
                <tbody id="dvConceptosRecinto">
                <tbody id="dvConceptosDespacho">
                </tbody>
              </table>

            </div>
        </div>

        <!--<div class="form-group" id="dvConceptosPedimento">
            <label class="control-label col-md-2">Recinto</label>
            <div class="col-md-10">
              <table class="table table-responsive">
                <tbody id="dvConceptosRecinto">
                </tbody>
              </table>
            </div>
        </div>-->
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-md-2 col-md-offset-10">
            <h3>Total: <span id="total">0.00</span></h3>
            </div>
          </div>
        </div>
      </div>
    <div class="clearfix"></div>
      <!--<hr>
        <div class="form-group">
            <label class="control-label col-md-2">Observaciones <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-8">
                <div class="input-icon right"> <i class="fa"></i>
                    <textarea rows="5"  name="sObservaciones" id="sObservaciones" class="form-control" placeholder="Observaciones"  ><?php echo (isset($result['sObservaciones'])) ? utf8_encode($result['sObservaciones']) : '' ; ?></textarea>
                </div>
            </div>
        </div>
          <div class="clearfix"></div>
        <hr>-->
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
function cotizar(){
  //alert(1);
  $(".subtotal").val("");
  $(".show_subtotal").html("");
    			var total = 0;
    			$("input[name='conceptos[]']:checked").each(function(idx,obj){
    				var tr = $(obj).parent().parent();
            var precioUnitario = $(tr).find(".fPrecioUnitario").val();
            var divisaConcepto = $(tr).find(".divisa").val();
    				var cantidad = $(tr).find(".iCantidad").val();
            var unidadCambio = $("#fTipoCambio").val();
            if(divisaConcepto == 'MXN'){
              var resultado = precioUnitario * cantidad;
            }else{
              //  alert("entro");
              var resultado = precioUnitario * cantidad * unidadCambio;
            }
            var subtotal = $(tr).find(".subtotal").val(resultado);
            var show_subtotal = $(tr).find(".show_subtotal").html("$ "+resultado.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));


    				total += resultado;
    			});
    			$("#total").html("$ "+total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,'));
}

    function getConceptosImportador(){
        $('.page-title-loading').css('display','inline');
        if(!$('#skEmpresaImportador').val() == ''){
          $.post("",{
              axn : "getConceptos"
              ,skEmpresaImportador : $("#skEmpresaImportador").val()

              ,skTipoTramite : $('input[name=skTipoTramite]:checked').val()
              ,skTipoCobroCotizacion : $('input[name=skTipoCobroCotizacion]:checked').val()
          }, function(response){
             console.log(response);
              $("#dvConceptosDespacho").html(response['conceptosDespacho']);
            //  $("#dvConceptosNaviera").html(response['conceptosNaviera']);
              $('.page-title-loading').css('display','none');
          });
        }
    }
    function getConceptosNaviera(){
        $('.page-title-loading').css('display','inline');
        if(!$('#skEmpresaImportador').val() == ''){
          $.post("",{
              axn : "getConceptos"
              ,skEmpresaNaviera : $("#skEmpresaNaviera").val()

              ,skTipoTramite : $('input[name=skTipoTramite]:checked').val()
              ,skTipoCobroCotizacion : $('input[name=skTipoCobroCotizacion]:checked').val()
          }, function(response){
             console.log(response);
              $("#dvConceptosNaviera").html(response['conceptosNaviera']);
              $('.page-title-loading').css('display','none');
          });
        }
    }
    function getConceptos(){
        $('.page-title-loading').css('display','inline');


        if(!$('#skEmpresaImportador').val() == ''&& !$('#skEmpresaNaviera').val() == ''){
          $.post("",{
              axn : "getConceptos"
              ,skEmpresaImportador : $("#skEmpresaImportador").val()
              ,skEmpresaNaviera : $("#skEmpresaNaviera").val()
              ,skEmpresaRecinto : $("#skEmpresaRecinto").val()
              ,skTipoTramite : $('input[name=skTipoTramite]:checked').val()
              ,skTipoCobroCotizacion : $('input[name=skTipoCobroCotizacion]:checked').val()
          }, function(response){
             console.log(response);
              $("#divConceptos").css("display","block");
              $("#dvConceptosPedimento").html(response['conceptosPedimento']);
              $("#dvConceptosNaviera").html(response['conceptosNaviera']);
              $("#dvConceptosRecinto").html(response['conceptosRecinto']);
              $("#dvConceptosDespacho").html(response['conceptosDespacho']);
            //  $("#dvConceptosNaviera").html(response['conceptosNaviera']);
              $('.page-title-loading').css('display','none');
          });
        }

    }

function obtenerDatos(){
    $('.page-title-loading').css('display','inline');
        var response = true;
        $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
            //console.log(data);
        var cad = '';
        if(!data.data){
            response = false;
            var icon = $("#sReferencia").parent('.input-icon').children('i');
            $("#sReferencia").closest('.form-group').removeClass('has-success').addClass('has-error');
            icon.removeClass("fa-check").addClass("fa-warning");
        }else{
    	cad ='<div class="form-group">'+
          	'<label class="control-label col-md-2">Tipo de Servicio</label>'+
    	     '<div class="col-md-4">'+
    	       ' <label id="lbServicio" class="control-label">'+data.data.TipoServicio+'</label>'+
    	    ' </div>'+
          '<label class="col-md-2 control-label">Ejecutivo</label>'+
         	'<div class="col-md-4">'+
           	'	 <label id="lbEjecutivo" class="control-label">'+data.data.Ejecutivo+'</label>'+
           ' </div>'+
           ' </div>'+
           '<div class="form-group">'+
              '<label class="control-label col-md-2">BL Master</label>'+
              ' <div class="col-md-4">'+
              '    <label class="control-label">'+data.data.sBlMaster+'</label>'+
              ' </div>'+

           ' </div> <hr>';

    // Selecciona la empresa (cliente) de la refernecia //
    $("#skEmpresaImportador").val(data.data.skEmpresa);
    // Selecciona la skEmpresaNaviera (Naviera) de la refernecia //
    $("#skEmpresaNaviera").val(data.data.skEmpresaNaviera);
    // Selecciona el tipo de tramite (skTipoTramite) IMPO | EXPO de la refernecia //
    //$("#skTipoTramite_"+data.data.skTipoTramite).prop('checked',true);
      getConceptos();
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
                sObservaciones:{
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
                }
            }
        });
    });
</script>

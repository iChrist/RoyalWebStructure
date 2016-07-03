
<pre>
    <?php 
        echo print_r($_SESSION["session"],1);
        echo "No hay nadaaaaa";
    ?>
</pre>

<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <input type="hidden" name="sReferenciaViejo"  id="sReferenciaViejo" value="<?php echo (isset($result['sReferencia'])) ? $result['sReferencia'] : '' ; ?>">
    <input type="hidden" name="axn" id="insert" value="insert" ></input>
    <div class="form-body">

        <div class="form-group">
            <label class="control-label col-md-2">Referencia Externa <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="sReferencia" id="sReferencia" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-2">Socio Importador <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <select class="form-control" id="skSocioImportador" name="skSocioImportador">
                        <option value="FLow">Flow</option>
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
                        
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <select class="form-control" id="skEstatus" name="skEstatus">
                        
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Pedimento <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="sPedimento" id="sPedimento" class="form-control" placeholder="Numero de pedimento" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="sReferencia" id="sReferencia" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Mercancia<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="sReferencia" id="sMercancia" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Guia Master<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="sReferencia" id="sGuiaMaster" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Guia House<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="sReferencia" id="sGuiaHouse" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Bultos<span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="number" name="iBultos" id="sReferencia" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de previo <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaPrevio" name="dFechaPrevio" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de despacho <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaDespacho" name="dFechaDespacho" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de clasificacion <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaClasificacion" name="dFechaClasificacion" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de glosa<span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaGlosa" name="dFechaGlosa" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de captura de pedimento <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaCapturaPedimento" name="dFechaCapturaPedimento" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de revalidacion<span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaRevalidacion" name="dFechaRevalidacion" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Fecha de facturacion<span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                    <input type="text" id="dFechaFacturacion" name="dFechaFacturacion" class="form-control" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Deposito <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="iDeposito" id="iDeposito" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Sado <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" maxlength="400" name="iSaldo" id="iSaldo" class="form-control" placeholder="Numero de referencia" value="" >
                </div>
            </div>
        </div>

    </div>
</form>

<script type="text/javascript">
    $(document).ready(function(){

        $.ajax({
            url : 'http://localhost:81/sys/rex/jsonStatus/',
            data : {},
         
            // especifica si será una petición POST o GET
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                console.log(json);
                for (o in json) {
                    d = json[o];
                    $("#skEstatus").append('<option value="' + d.skStatus +  '">'+d.sNombre+'</option>')
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
            url : 'http://localhost:81/sys/rex/jsonAlmacenes/',
            data : {},
         
            // especifica si será una petición POST o GET
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                console.log(json);
                for(i in json){
                    d = json[i];
                    $("#skAlmacen").append('<option value="' + d.skAlmacen + '">'+d.sNombre+'</option>');
                }
            },
            error : function(xhr, status) {
                console.log("Algo salio mal en la peticion a jsonAlmacenes")
            },
            complete : function(xhr, status) {
                console.log('Petición realizada');
            }
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
                sPedimento:{
                    required: true
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
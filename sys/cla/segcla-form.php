<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <input type="hidden" name="axn" value="insert" />
    <input type="hidden" name="skClasificacion"  id="skClasificacion" value="<?php echo (isset($result['skClasificacion'])) ? $result['skClasificacion'] : '' ; ?>">
    <input type="hidden" name="clasificacionSegundaMercancia" id="sJson" />
    <div class="form-body">
        
        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="sReferencia" id="sReferencia" class="form-control" onChange="obtenerDatos();" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? htmlentities(utf8_encode($result['sReferencia'])) : '' ; ?>">
                </div>
            </div>
        </div>
        
  
        <!-- OBTENER DATOS DE LA REFERENCIA !-->
        <hr><div id="dvDatos"></div>
    
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <h4>
                    <b>Nota:</b> 
                    <span style="color: red; font-weight: bolder;font-size: 14px;">Sube el template para corregir y validar la segunda clasificación <br> ó dejalo vacio y para validarla.</span>
                </h4>
            </div>
        </div>
        
        <div class="form-group">
            <!--<label class="col-md-2">Archivo</label>!-->
            <label class="control-label col-md-2">Archivo</label>
            <div class="col-md-4">
            <!--<div class="col-md-4">!-->
                <span class="btn btn-default fileinput-button">
                    <i class="fa fa-file-excel-o"></i>
                    <span> Seleccionar Excel</span>
                    <input type="file" name="xlfile" id="xlf" />
                </span>
            </div>
        </div>
        
        <!-- INFORMACION DE CUANTOS REGISTROS SE VAN A PROCESAR !-->
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-10 error-import">
                <h3 id="total"></h3>
            </div>
        </div>
        
    </div>
</form>      
        <div class="clearfix"></div>
        
        <!-- CLASIFICACIÓN DE MERCANCIAS !-->
        <hr>
        <div class="row claificacion_mercancias" style="display: block;">
            <div class="col-md-12">
                <form id="_formTableAjax" method="POST" action="?axn=fetch_all">
                    <div class="table-container">
                        <div class="table-actions-wrapper">
                            <span></span>
                            <div class="table-group-actions pull-right"><span></span>
                                <div class="btn-group btn-group-md" role="group" aria-label="Acciones">
                                <?php
                                    $buttons = $this->printModulesButtons(3);
                                    echo $buttons['sHtml'];
                                ?>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="10%">
                                        Buscar
                                    </th>
                                    <th width="25%">
                                        Factura
                                    </th>
                                    <th width="25%">
                                        Fracci&oacute;n
                                    </th>
                                    <th width="25%">
                                        Descripci&oacute;n
                                    </th>
                                    <th width="25%">
                                        Ingl&eacute;s
                                    </th>
                                    <th width="25%">
                                        Num. Parte
                                    </th>
                                    <th width="25%">
                                        Secuencia
                                    </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td>
                                        <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                                            <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                                            <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control form-filter input-sm" name="sReferencia" id="sReferenciaClasificacion" value="<?php echo (isset($result['sReferencia'])) ? htmlentities(utf8_encode($result['sReferencia'])) : '' ; ?>">
                                        <input type="text" class="form-control form-filter input-sm" name="sFactura" placeholder="Factura">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="sFraccion" placeholder="Fraccion">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="sDescripcion" placeholder="Descripci&oacute;n">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="sDescripcionIngles" placeholder="Descripci&oacute;n ingl&eacute;s">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="sNumeroParte" placeholder="Num. Parte">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="iSecuencia" placeholder="Secuencia">
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </form> <!-- FORMULARIO PARA BOTONES DE LA TABLA iPosition 3!-->
            </div>
        </div>
    <!--    
    </div>
</form>!-->
<div class="clearfix"></div>

<script type="text/javascript">
    var js_rABS = '<?php echo SYS_URL ?>core/assets/sheetjs/xlsxworker2.js';
    var js_norABS = '<?php echo SYS_URL ?>core/assets/sheetjs/xlsxworker1.js';
    var js_noxfer = '<?php echo SYS_URL ?>core/assets/sheetjs/xlsxworker.js';
</script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/shim.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/jszip.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/xlsx.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/dist/ods.js"></script>
<script src="<?php echo SYS_URL ?>sys/cla/js/importarTemplateClasificacion.js"></script>
<script type="text/javascript">
    
    
    
    function obtenerDatos(){
        if($("#sReferencia").val().trim() != ''){
            $('.page-title-loading').css('display','inline');
            $("#sReferenciaClasificacion").val($("#sReferencia").val());
            $('.filter-submit').click();
            $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
                $("#dvDatos").html(data);
                $('.page-title-loading').css('display','none');
            });
        }
    }
    
    $(document).ready(function(){
        TableAjax.init('?axn=fetch_all');
        
        obtenerDatos();
         
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                sReferencia:{
                    required: true,
                    remote: {
                        url: "",
                        type: "post",
                        data: {
                            sReferencia: function(){ return $("#sReferencia").val(); },
                            axn: "validarReferencia"
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
                    required: "Campo obligatorio.",
                    remote: "La referencia no existe o no tiene previo finalizado."
                }
            }
        });
    }); 
</script>
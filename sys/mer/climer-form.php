<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <input type="hidden" name="skAreas"  id="skAreas" value="<?php echo (isset($result['skAreas'])) ? $result['skAreas'] : '' ; ?>">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sReferencia" id="sReferencia" class="form-control" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Pedimento <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sPedimento" id="sPedimento" class="form-control" placeholder="Pedimento" value="<?php echo (isset($result['sPedimento'])) ? utf8_encode($result['sPedimento']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Factura <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sFactura" id="sFactura" class="form-control" placeholder="Factura" value="<?php echo (isset($result['sFactura'])) ? utf8_encode($result['sFactura']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Fecha de previo <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd/mm/yyyy" class="input-group date date-picker">
                    <input type="text" readonly="" class="form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <div class="">
                            <span>
                                <input type="radio" name="skStatus" value="AC" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?> checked="checked"> Activo
                            </span>
                        </div>
                    </label>
                    <label>
                        <div class="">
                            <span>
                                <input type="radio" name="skStatus" value="IN" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
                            </span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!--<div class="form-group">
            <label class="control-label col-md-2">GitHub</label>
            <div class="col-md-4">
                <select class="form-control js-data-example-ajax">
                    <option value="0" selected="selected">- Seleccione mercancia -</option>
                </select>
            </div>
        </div>!-->
        
        <div class="clearfix"></div>
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Mercancias
                </div>
                <div class="tools">  
                    <a class="collapse" href="javascript:;"></a>
                </div>
            </div>
        <div class="portlet-body form">
        <div class="table-responsive">
            <table class="table table-bordered" id="fraccionesArancelarias">
                <tbody>
                    <tr class="gray">
                        <th colspan="2"><center>Mercancia</center></th>
                        <td colspan="3">
                            <select class="form-control js-data-example-ajax">
                                <option value="0" selected="selected">- Seleccione mercancia -</option>
                            </select>
                        </td>
                        <td align="center">
                            <a href="javascript:;" class="btn btn-default add-mercancia"><i class="fa fa-plus"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>N&uacute;mero de parte</th>
                        <th>Fracci&oacute;n Arancelaria</th>
                        <th>Descripci&oacute;n espa&ntilde;ol</th>
                        <th>Descripci&oacute;n ingl&eacute;s</th>
                        <th><center>Fotos</center></th>
                        <th><center>Acciones</center></th>
                    </tr>
                    <tbody id="mercancias">
                    <tr>
                        <td>N&uacute;mero de parte</td>
                        <td>Fracci&oacute;n Arancelaria</td>
                        <td>Descripci&oacute;n espa&ntilde;ol</td>
                        <td>Descripci&oacute;n ingl&eacute;s</td>
                        <td align="center">
                            <a href="javascript:;" class="btn btn-default btn-xs add-mercancia"><i class="fa fa-camera"></i></a>
                        </td>
                        <td align="center">
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <a href="javascript:;" class="btn btn-default btn-xs ver-mercancia"><i class="fa fa-eye"></i></a>
                                <a href="javascript:;" class="btn btn-default btn-xs add-mercancia"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
    var fraccion = 1;
    $(document).ready(function(){
        
        function formatRepo (data) {
            if (data.loading) return data.text;
            var markup = '<div class="clearfix"><div class="col-md-6">'+data.id+'.-'+data.name+'</div></div>';
            return markup;
        }
  
        function formatRepoSelection (repo) {
          return repo.name || repo.text;
        }
        
        $(".js-data-example-ajax").select2({
            ajax: {
                url: "",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                    axn: "listarMercancias",
                    search: params.term
                    //page: params.page
                };
            },
            processResults: function (data, page) {
                return {
                    results: data.items
                };
            },
            cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 3,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    

        
        
        /* AGREGAR FRACCION */
        $('body').delegate('.add-fraccion', 'click', function(){
            var html_fraccion = '<tbody><tr class="gray"><th><center>Fracci&oacute;n</center></th><td colspan="2"><input type="text" name="fraccionArancelaria['+fraccion+'][sReferencia]" class="form-control" placeholder="Fracci&oacute;n arancelaria"></td><td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td></tr><tr><th colspan="2"><center>Descripciones</center></th><th><center>Fotos</center></th><td align="center"><a href="javascript:;" class="btn btn-default add-descripcion" fraccion="'+fraccion+'"><i class="fa fa-plus"></i></a></td></tr><tbody id="fraccionDescripciones_'+fraccion+'"><tr><td><textarea name="fraccionArancelaria['+fraccion+'][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td><td><textarea name="fraccionArancelaria['+fraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td><td><center><div class="fileUpload btn btn-default"><span><i class="fa fa-cloud-upload"></i></span><input type="file" name="fraccionArancelaria['+fraccion+'][archivos]['+fraccion+'][]" class="BtnUpload" multiple /></div></center></td><td align="center"><a href="javascript:;" class="btn btn-default delete-descripcion" fraccion="'+fraccion+'"><i class="fa fa-trash-o"></i></a></td></tr></tbody></tbody>';
            $("#fraccionesArancelarias").append(html_fraccion);
            fraccion ++;
        });
        /* ELIMINAR FRACCION */
        $('body').delegate('.delete-fraccion','click',function(){  
            $(this).parent().parent().parent().remove();
        });
        
        /* AGREGAR DESCRIPCIONES */
        $('body').delegate('.add-descripcion','click',function(){
            var numFraccion = $(this).attr('fraccion');
            var html_descripcion = '<tr><td><textarea name="fraccionArancelaria['+numFraccion+'][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td><td><textarea name="fraccionArancelaria['+numFraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td><td><center><div class="fileUpload btn btn-default"><span><i class="fa fa-cloud-upload"></i></span><input type="file" name="fraccionArancelaria['+numFraccion+'][archivos]['+numFraccion+'][]" class="BtnUpload" multiple /></div></center></td><td align="center"><a href="javascript:;" class="btn btn-default delete-descripcion" fraccion="'+numFraccion+'"><i class="fa fa-trash-o"></i></a></td></tr>';
            $("#fraccionDescripciones_" + numFraccion).append(html_descripcion);
        });
        /* ELIMINAR DESCRIPCIONES */
        $('body').delegate('.delete-descripcion','click',function(){  
            $(this).parent().parent().remove();
        });
        
        $('body').delegate('.BtnUpload','change',function(){
            $(this).parent().removeClass('btn-default');
            $(this).parent().addClass('btn-success');
            console.log($(this).val());
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
                },
                sFactura:{
                    required: true
                },
                dFechaPrevio:{
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
                    required: "Campo obligatorio."
                },
                sPedimento:{
                    required: "Campo obligatorio."
                },
                sFactura:{
                    required: "Campo obligatorio."
                },
                dFechaPrevio:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>
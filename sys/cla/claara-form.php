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
            <label class="control-label col-md-2">Nombre <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombre" id="sNombre" class="form-control" placeholder="Nombre" value="<?php echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : '' ; ?>" >
                </div>
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label col-md-2">Descripci&oacute;n <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <textarea name="sDescripcion" id="sDescripcion" class="form-control" placeholder="Descripci&oacute;n"><?php echo (isset($result['sDescripcion'])) ? utf8_encode($result['sDescripcion']) : '' ; ?></textarea>
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
        
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Fracciones arancelarias
                </div>
                <div class="tools">
                    <a href="javascript:;" class="add-fraccion"><i class="fa fa-plus"></i> Agregar</a>    
                    <a class="collapse" href="javascript:;"></a>
                </div>
            </div>
        <div class="portlet-body form">
        <div class="table-responsive">
            <table class="table table-bordered" id="fraccionesArancelarias">
                <tbody>
                    <tr class="gray">
                        <th><center>Fracci&oacute;n</center></th>
                        <td colspan="2">
                            <input type="text" name="fraccionArancelaria[0][sNombre]" class="form-control" placeholder="Fracci&oacute;n arancelaria">
                        </td>
                        <td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <tr>
                        <th colspan="2"><center>Descripciones</center></th>
                        <th><center>Fotos</center></th>
                        <td align="center"><a href="javascript:;" class="btn btn-default btn-xs add-descripcion" fraccion="0" descripcion="0"><i class="fa fa-plus"></i></a></td>
                    </tr>
                    <tbody id="fraccionDescripciones_0">
                        <tr>
                            <td><textarea name="fraccionArancelaria[0][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td>
                            <td><textarea name="fraccionArancelaria[0][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td>
                            <td align="center"><div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file"  name="fraccionArancelaria[0][archivos][0][]" class="BtnUpload" multiple /></div></td>
                            <td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="0"><i class="fa fa-trash-o"></i></a></div></td>
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
    var fraccionDescripcion = 1;
    $(document).ready(function(){
        
        /* AGREGAR FRACCION */
        $('body').delegate('.add-fraccion', 'click', function(){
            var html_fraccion = '<tbody><tr class="gray"><th><center>Fracci&oacute;n</center></th><td colspan="2"><input type="text" name="fraccionArancelaria['+fraccion+'][sNombre]" class="form-control" placeholder="Fracci&oacute;n arancelaria"></td><td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td></tr><tr><th colspan="2"><center>Descripciones</center></th><th><center>Fotos</center></th><td align="center"><a href="javascript:;" class="btn btn-default btn-xs add-descripcion" fraccion="'+fraccion+'"><i class="fa fa-plus"></i></a></td></tr><tbody id="fraccionDescripciones_'+fraccion+'"><tr><td><textarea name="fraccionArancelaria['+fraccion+'][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td><td><textarea name="fraccionArancelaria['+fraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td><td align="center"><div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file" name="fraccionArancelaria['+fraccion+'][archivos]['+fraccionDescripcion+'][]" class="BtnUpload" multiple /></div></td><td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="'+fraccion+'"><i class="fa fa-trash-o"></i></a></div></td></tr></tbody></tbody>';
            $("#fraccionesArancelarias").append(html_fraccion);
            fraccion ++;
            fraccionDescripcion ++;
        });
        /* ELIMINAR FRACCION */
        $('body').delegate('.delete-fraccion','click',function(){  
            $(this).parent().parent().parent().remove();
        });
        
        /* AGREGAR DESCRIPCIONES */
        $('body').delegate('.add-descripcion','click',function(){
            var numFraccion = $(this).attr('fraccion');
            var html_descripcion = '<tr><td><textarea name="fraccionArancelaria['+numFraccion+'][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td><td><textarea name="fraccionArancelaria['+numFraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td><td align="center"><div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file" name="fraccionArancelaria['+numFraccion+'][archivos]['+fraccionDescripcion+'][]" class="BtnUpload" multiple /></div></td><td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="'+numFraccion+'"><i class="fa fa-trash-o"></i></a></div></td></tr>';
            $("#fraccionDescripciones_" + numFraccion).append(html_descripcion);
        });
        /* ELIMINAR DESCRIPCIONES */
        $('body').delegate('.delete-descripcion','click',function(){  
            $(this).parent().parent().parent().remove();
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
                sNombre:{
                    required: true
                },
                sDescripcion:{
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
                sNombre:{
                    required: "Campo obligatorio."
                },
                sDescripcion:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>
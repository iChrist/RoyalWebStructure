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
            <label class="control-label col-md-2">T&iacute;tulo <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sTitulo" id="sTitulo" class="form-control" placeholder="T&iacute;tulo" value="<?php echo (isset($result['sTitulo'])) ? utf8_encode($result['sTitulo']) : '' ; ?>" >
                </div>
            </div>
        </div>
        
        <h4>Fracciones arancelarias <a href="#" class="btn btn-default btn-xs add-fraccion"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h4>
        <div id="fraccionesArancelarias">
            <div class="form-group">
                <label class="control-label col-md-2"></label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="fraccionArancelaria[0][sNombre]" class="form-control" placeholder="Fracci&oacute;n arancelaria">
                        <span class="input-group-addon" id="basic-addon2"><a href="#" class="delete-fraccion"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <label class="control-label col-md-2"></label>
                <div class="col-md-4">
                    <h5>Descripciones <a href="#" class="btn btn-default btn-xs add-descripcion" fraccion="0"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h5>
                </div>
                <div class="clearfix"></div>
                <div class="fraccionesArancelariasDescripciones">
                    <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-4">
                        <div class="input-group">
                        <textarea name="fraccionArancelaria[0][sDescripcion][]" class="form-control" placeholder="Descripción en espa&ntilde;ol"></textarea>
                        <textarea name="fraccionArancelaria[0][sDescripcionIngles][]" class="form-control" placeholder="Descripción en ingl&eacute;s"></textarea>
                        <span class="input-group-addon" id="basic-addon2"><a href="#" class="delete-descripcion" fraccion="0"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div><!-- TERMINA DE div id=fraccionesArancelarias -->
        
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
            
    </div>
</form>
<div class="clearfix"></div>
<form id="fileupload" action="assets/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="col-lg-7">
            <span class="btn btn-default fileinput-button">
                <i class="fa fa-plus"></i><span> Archivo(s)</span><input type="file" name="files[]" multiple="">
            </span>
            <button type="submit" class="btn btn-primary start">
                <i class="fa fa-upload"></i><span> Subir</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
                <i class="fa fa-ban"></i><span> Cancelar</span>
            </button>
            <button type="button" class="btn btn-danger delete">
                <i class="fa fa-trash-o"></i><span> Eliminar</span>
            </button>
            <input type="checkbox" class="toggle">
                <span class="fileupload-process">
            </span>
        </div>
        <!-- The global progress information -->
        <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;">
                    </div>
            </div>
            <!-- The extended global progress information -->
            <div class="progress-extended">
                     &nbsp;
            </div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped clearfix">
    <tbody class="files">
    </tbody>
    </table>
</form>
<script type="text/javascript">
    var fraccion = 1;
    $(document).ready(function(){
        
        FormFileUpload.init('?axn=fileUpload');
        
        /* AGREGAR FRACCION */
        $('body').delegate('.add-fraccion', 'click', function(){
            var html = '<div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-4"><div class="input-group"><input type="text" name="fraccionArancelaria['+fraccion+'][sNombre]" class="form-control" placeholder="Fracci&oacute;n arancelaria"><span class="input-group-addon" id="basic-addon2"><a href="#" class="delete-fraccion"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span></div></div><div class="clearfix"></div><label class="control-label col-md-2"></label><div class="col-md-4"><h5>Descripciones <a href="#" class="btn btn-default btn-xs add-descripcion" fraccion="'+fraccion+'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h5></div><div class="clearfix"></div><div class="fraccionesArancelariasDescripciones"><div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-4"><div class="input-group"><textarea name="fraccionArancelaria['+fraccion+'][sDescripcion][]" class="form-control" placeholder="Descripción en espa&ntilde;ol"></textarea><textarea name="fraccionArancelaria['+fraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripción en ingl&eacute;s"></textarea><span class="input-group-addon" id="basic-addon2"><a href="#" class="delete-descripcion" fraccion="'+fraccion+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span></div></div></div></div></div>';
            $("#fraccionesArancelarias").append(html);
            fraccion ++;
        });
        /* ELIMINAR FRACCION */
        $('body').delegate('.delete-fraccion','click',function(){  
            $(this).parent().parent().parent().parent().remove();
        });
        
        /* AGREGAR DESCRIPCIONES */
        $('body').delegate('.add-descripcion','click',function(){
            var numFraccion = $(this).attr('fraccion');
            console.log(numFraccion);
            var html = '<div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-4"><div class="input-group"><textarea name="fraccionArancelaria['+numFraccion+'][sDescripcion][]" class="form-control" placeholder="Descripción en espa&ntilde;ol"></textarea><textarea name="fraccionArancelaria['+numFraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripción en ingl&eacute;s"></textarea><span class="input-group-addon" id="basic-addon2"><a href="#" class="delete-descripcion" fraccion="'+numFraccion+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></span></div></div></div>';    
            $(this).parent().parent().next('div').next('div').append(html);
        });
        /* ELIMINAR DESCRIPCIONES */
        $('body').delegate('.delete-descripcion','click',function(){  
            $(this).parent().parent().parent().parent().remove();
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
                sTitulo:{
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
                sTitulo:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>
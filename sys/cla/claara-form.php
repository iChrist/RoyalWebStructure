<?php
    $result = array();
    if($data['datos']){
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <input type="hidden" name="skNumeroParte"  id="skNumeroParte" value="<?php echo (isset($data['datos']['numPar']['skNumeroParte'])) ? $data['datos']['numPar']['skNumeroParte'] : '' ; ?>">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Nombre <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombre" id="sNombre" class="form-control" placeholder="Nombre" value="<?php echo (isset($data['datos']['numPar']['sNombre'])) ? $data['datos']['numPar']['sNombre'] : '' ; ?>" >
                </div>
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label col-md-2">Descripci&oacute;n <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <textarea name="sDescripcion" id="sDescripcion" class="form-control" placeholder="Descripci&oacute;n"><?php echo (isset($data['datos']['numPar']['sDescripcion'])) ? $data['datos']['numPar']['sDescripcion'] : '' ; ?></textarea>
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
                                <input type="radio" name="skStatus" value="AC" <?php echo (isset($data['datos']['numPar']['skStatus']) && $data['datos']['numPar']['skStatus'] == 'AC') ? 'checked' : '' ; ?> checked="checked"> Activo
                            </span>
                        </div>
                    </label>
                    <label>
                        <div class="">
                            <span>
                                <input type="radio" name="skStatus" value="IN" <?php echo (isset($data['datos']['numPar']['skStatus']) && $data['datos']['numPar']['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
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
                <?php 
                    $fraccion = 0;
                    $fraccionDescripcion = 0;
                    if(isset($data['datos']['numPar']['numparfraran'])){
                        $fraccion = 0;
                        foreach($data['datos']['numPar']['numparfraran'] AS $numparfraran){
                ?>
                <tr><td><table class="table table-bordered">
                    <tr class="gray">
                        <th><center>Fracci&oacute;n</center></th>
                        <td colspan="2">
                            <input type="hidden" name="fraccionArancelaria[<?php echo $fraccion; ?>][skFraccionArancelaria]" value="<?php echo $numparfraran['skFraccionArancelaria']; ?>" class="form-control">
                            <input type="text" name="fraccionArancelaria[<?php echo $fraccion; ?>][sNombre]" value="<?php echo $numparfraran['sNombre']; ?>" class="form-control" placeholder="Fracci&oacute;n arancelaria">
                        </td>
                        <td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <tr>
                        <th colspan="2"><center>Descripciones</center></th>
                        <th><center>Fotos</center></th>
                        <td align="center">
                            <a href="javascript:;" class="btn btn-default btn-xs add-descripcion" fraccion="0" descripcion="0"><i class="fa fa-plus"></i></a>
                        </td>
                    </tr>
                    <tbody id="fraccionDescripciones_<?php echo $fraccion; ?>">
                    <?php
                        if(isset($numparfraran['fraAraDes'])){
                            $fraccionDescripcion = 0;
                            foreach($numparfraran['fraAraDes'] AS $fraAraDes){
                    ?>
                        <tr>
                            <td>
                                <input type="hidden" name="fraccionArancelaria[<?php echo $fraccionDescripcion; ?>][skFraccionArancelariaDescripcion][]" value="<?php echo $fraAraDes['skFraccionArancelariaDescripcion']; ?>" class="form-control">
                                <textarea name="fraccionArancelaria[<?php echo $fraccionDescripcion; ?>][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"><?php echo $fraAraDes['sDescripcion']; ?></textarea>
                            </td>
                            <td>
                                <textarea name="fraccionArancelaria[<?php echo $fraccionDescripcion; ?>][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"><?php echo $fraAraDes['sDescripcionIngles']; ?></textarea>
                            </td>
                            <td align="center">
                                <div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file"  name="fraccionArancelaria[<?php echo $fraccion; ?>][archivos][<?php echo $fraccionDescripcion; ?>][]" class="BtnUpload" multiple /></div>
                                <a href="#" data-toggle="modal" role="button" class="btn btn-default btn-xs modal_fotos" skFraccionArancelariaDescripcion="<?php echo $fraAraDes['skFraccionArancelariaDescripcion']; ?>"><i class="fa fa-camera"></i></a>
                            </td>
                            <td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="<?php echo $fraccion; ?>"><i class="fa fa-trash-o"></i></a></div></td>
                        </tr>
                    <?php
                            $fraccionDescripcion++;
                            }//FOREACH     
                    ?>
                    </tbody>
                    <?php
                        }//ENDIF
                    ?>
                </table></td></tr>
                
                
                <?php
                        $fraccion++;
                        }//ENDFOREACH
                    }else{
                ?>
                
                
                <table class="table table-bordered">
                    <tr class="gray">
                        <th><center>Fracci&oacute;n</center></th>
                        <td colspan="2">
                            <input type="hidden" name="fraccionArancelaria[0][skFraccionArancelaria]" value="" class="form-control">
                            <input type="text" name="fraccionArancelaria[0][sNombre]" class="form-control" placeholder="Fracci&oacute;n arancelaria">
                        </td>
                        <td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    <tr>
                        <th colspan="2"><center>Descripciones</center></th>
                        <th><center>Fotos</center></th>
                        <td align="center">
                            <a href="javascript:;" class="btn btn-default btn-xs add-descripcion" fraccion="0" descripcion="0"><i class="fa fa-plus"></i></a>
                        </td>
                    </tr>
                    <tbody id="fraccionDescripciones_0">
                        <tr>
                            <td>
                                <input type="hidden" name="fraccionArancelaria[0][skFraccionArancelariaDescripcion][]" value="" class="form-control">
                                <textarea name="fraccionArancelaria[0][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea>
                            </td>
                            <td>
                                <textarea name="fraccionArancelaria[0][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea>
                            </td>
                            <td align="center">
                                <div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file"  name="fraccionArancelaria[0][archivos][0][]" class="BtnUpload" multiple /></div>
                            </td>
                            <td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="0"><i class="fa fa-trash-o"></i></a></div></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                    }//ENDIF
                ?>
            </table>
        </div>
        </div>
        </div>
    </div>
</form>
<div class="clearfix"></div>

<!-- MODAL PARA VISUALIZAR IMAGENES !-->
<!-- Large modal -->

<div id="myModal_example" class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
    </div>
  </div>
</div>

<!-- MODAL PARA VISUALIZAR FOTOS !-->
<div id="modal_fotos" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Fotos</h4>
            </div>
            <div class="modal-body form thumbnail-clas">
                
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var fraccion = <?php if($fraccion==0){ echo 1; }else{ echo $fraccion; } ?>;
    var fraccionDescripcion = <?php if($fraccionDescripcion==0){ echo 1; }else{ echo $fraccionDescripcion; } ?>;
    $(document).ready(function(){
        /* AGREGAR FRACCION */
        $('body').delegate('.add-fraccion', 'click', function(){
            var html_fraccion = '<tr><td><table class="table table-bordered"><tr class="gray"><th><center>Fracci&oacute;n</center></th><td colspan="2"><input type="text" name="fraccionArancelaria['+fraccion+'][sNombre]" class="form-control" placeholder="Fracci&oacute;n arancelaria"></td><td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td></tr><tr><th colspan="2"><center>Descripciones</center></th><th><center>Fotos</center></th><td align="center"><a href="javascript:;" class="btn btn-default btn-xs add-descripcion" fraccion="'+fraccion+'"><i class="fa fa-plus"></i></a></td></tr><tbody id="fraccionDescripciones_'+fraccion+'"><tr><td><textarea name="fraccionArancelaria['+fraccion+'][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td><td><textarea name="fraccionArancelaria['+fraccion+'][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td><td align="center"><div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file" name="fraccionArancelaria['+fraccion+'][archivos]['+fraccionDescripcion+'][]" class="BtnUpload" multiple /></div></td><td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="'+fraccion+'"><i class="fa fa-trash-o"></i></a></div></td></tr></tbody></table></td></tr>';
            $("#fraccionesArancelarias").append(html_fraccion);
            fraccion ++;
            fraccionDescripcion ++;
        });
        /* ELIMINAR FRACCION */
        $('body').delegate('.delete-fraccion','click',function(){  
            $(this).parent().parent().parent().parent().parent().parent().remove();
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
        });
        
        $('body').delegate('.modal_fotos','click',function(){
            var skFraccionArancelariaDescripcion = $(this).attr('skFraccionArancelariaDescripcion');
            $.post('',{ 
                axn: 'listImg',
                skFraccionArancelariaDescripcion: skFraccionArancelariaDescripcion 
            },function(data){
                console.log(data);
                //'+data[0]['sArchivo']+'
                var thumbnails = '<div class="col-md-4 col-sm-4 col-xs-4"><img alt="" src="http://vision7.com.mx/admin/files/news/1715916695insua.jpg" class="img-responsive img-thumbnail img-view" width="400px" height="400px" style="margin-left:15px;"></div><div class="col-md-8 col-sm-8 col-xs-8">'; 
                $('.thumbnail-clas').html(thumbnails);
                $.each(data,function(k,v){ //'+v.src+'
                    thumbnails += '<img src="http://vision7.com.mx/admin/thumbnail.php?width=297&height=221&url=http://vision7.com.mx/admin/files/news/1715916695insua.jpg" alt="'+v.sArchivo+'" width="80px" height="80px" style="margin-left:15px;" class="img-thumbnail">';
                });
                thumbnails += '</div>';
                $('.thumbnail-clas').html(thumbnails);
                $('#modal_fotos').modal();
            });
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
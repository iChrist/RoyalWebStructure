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
                <h4>
                    <?php echo (isset($data['datos']['numPar']['sNombre'])) ? $data['datos']['numPar']['sNombre'] : '' ; ?></span>
                </h4>
            </div>
        </div>
            
        <div class="form-group">
            <label class="control-label col-md-2">Descripci&oacute;n <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <h4>
                    <?php echo (isset($data['datos']['numPar']['sDescripcion'])) ? $data['datos']['numPar']['sDescripcion'] : '' ; ?></span>
                </h4>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">Estatus</label>
            <div class="col-md-4">
                <h4>
                    <?php 
                        echo (isset($data['datos']['numPar']['skStatus'])) ? $data['datos']['numPar']['htmlStatus'] : '' ;
                    ?>
                </h4>
            </div>
        </div> 
        
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Fracciones arancelarias
                </div>
                <div class="tools">
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
                            <input type="text" name="fraccionArancelaria[<?php echo $fraccion; ?>][sNombre]" value="<?php echo $numparfraran['sNombre']; ?>" class="form-control" placeholder="Fracci&oacute;n arancelaria"  disabled>
                        </td>
                        <!--<td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td>!-->
                    </tr>
                    <tr>
                        <th colspan="2"><center>Descripciones</center></th>
                        <th><center>Fotos</center></th>
                        <!--<td align="center">
                            <a href="javascript:;" class="btn btn-default btn-xs add-descripcion" fraccion="0" descripcion="0"><i class="fa fa-plus"></i></a>
                        </td>!-->
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
                                <textarea name="fraccionArancelaria[<?php echo $fraccionDescripcion; ?>][sDescripcion][]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"  disabled><?php echo $fraAraDes['sDescripcion']; ?></textarea>
                            </td>
                            <td>
                                <textarea name="fraccionArancelaria[<?php echo $fraccionDescripcion; ?>][sDescripcionIngles][]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"  disabled><?php echo $fraAraDes['sDescripcionIngles']; ?></textarea>
                            </td>
                            <td align="center">
                                <!--<div class="fileUpload btn btn-default btn-xs"><span><i class="fa fa-cloud-upload"></i></span><input type="file"  name="fraccionArancelaria[<?php echo $fraccion; ?>][archivos][<?php echo $fraccionDescripcion; ?>][]" class="BtnUpload" multiple /></div>!-->
                                <a href="#" data-toggle="modal" role="button" class="btn btn-default btn-xs fileUpload modal_fotos" skFraccionArancelariaDescripcion="<?php echo $fraAraDes['skFraccionArancelariaDescripcion']; ?>"><i class="fa fa-camera"></i></a>
                            </td>
                            <!--<td align="center"><div style="margin:15px;"><a href="javascript:;" class="btn btn-default btn-xs delete-descripcion" fraccion="<?php echo $fraccion; ?>"><i class="fa fa-trash-o"></i></a></div></td>!-->
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
    $(document).ready(function(){
        $('body').delegate('.modal_fotos','click',function(){
            var skFraccionArancelariaDescripcion = $(this).attr('skFraccionArancelariaDescripcion');
            $.post('',{ 
                axn: 'listImg',
                skFraccionArancelariaDescripcion: skFraccionArancelariaDescripcion 
            },function(data){
                var thumbnails = '<div class="col-md-4 col-sm-4 col-xs-4"><img alt="'+data[0]['sArchivo']+'" src="'+data[0]['src']+'" class="img-responsive img-thumbnail img-view" width="400px" height="400px" style="margin-left:15px;"></div><div class="col-md-8 col-sm-8 col-xs-8">'; 
                $('.thumbnail-clas').html(thumbnails);
                $.each(data,function(k,v){ //'+v.src+'
                    //thumbnails += '<img src="http://vision7.com.mx/admin/thumbnail.php?width=297&height=221&url=http://vision7.com.mx/admin/files/news/1715916695insua.jpg" alt="'+v.sArchivo+'" width="80px" height="80px" style="margin-left:15px;" class="img-thumbnail">';
                    thumbnails += '<img src="'+v.src+'" alt="'+v.sArchivo+'" width="80px" height="80px" style="margin-left:15px;" class="img-thumbnail img-preview">';
                });
                thumbnails += '</div>';
                $('.thumbnail-clas').html(thumbnails);
                $('#modal_fotos').modal();
            });
        });

        $('body').delegate('.img-preview','click',function(){
            var src = $(this).attr('src');
            $('.img-view').attr('src',src);
        });
    }); 
</script>
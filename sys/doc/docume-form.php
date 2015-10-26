<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
	
	
/*echo "<pre>";
print_r($data);
echo "</pre>";

*/
?>

<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
  <input type="hidden" name="skRecepcionDocumento"  id="skRecepcionDocumento" value="<?php echo (isset($result['skRecepcionDocumento'])) ? $result['skRecepcionDocumento'] : '' ; ?>">
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Tipo Tramite <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-10">
        <div class="radio-list">
          <?php $i = 0?>
          <?php while($rTipoTramite =  $data['tipostramites']->fetch_assoc()){?>
          <?php $i++;?>
          <label>
          <div class=""> <span>
            <input type="radio" name="skTipoTramite" value="<?php echo $rTipoTramite{'skTipoTramite'}?>" <?php echo ((isset($result['skTipoTramite']) ? $result['skTipoTramite'] : "-") == $rTipoTramite{'skTipoTramite'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
            <?php echo utf8_encode($rTipoTramite{'sNombre'})?> </span> </div>
          </label>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Tipo Servicios <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-10">
        <div class="radio-list">
          <?php $i = 0?>
          <?php while($rTiposervicio =  $data['tiposservicios']->fetch_assoc()){?>
          <?php $i++;?>
          <label>
          <div class=""> <span>
            <input type="radio" name="skTipoServicio" value="<?php echo $rTiposervicio{'skTipoServicio'}?>" <?php echo ((isset($result['skTipoServicio']) ? $result['skTipoServicio'] : "-") == $rTiposervicio{'skTipoServicio'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
            <?php echo utf8_encode($rTiposervicio{'sNombre'})?> </span> </div>
          </label>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sReferencia" id="sReferencia" class="form-control" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ; ?>" >
        </div>
      </div>
    </div>
    <div class="form-group">
            <label class="control-label col-md-2">Fecha de Programación <span aria-required="true" class="required"> * </span></label>
            <div class="col-md-4">
                <div data-date-format="dd/mm/yyyy" class="input-group date date-picker">
                    <input type="text" readonly class="form-control" name="dFechaProgramacion" id="dFechaProgramacion" value="<?php echo (isset($result['dFechaProgramacion'])) ? utf8_encode($result['dFechaProgramacion']) : '' ; ?>">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
        </div>
    <div class="form-group">
      <label class="control-label col-md-2">Empresa <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skEmpresa" id="skEmpresa" class="form-control form-filter input-sm">
          <option value="">- Empresa -</option>
          <?php
                                    if(isset($data['empresas'])){
                                        while($rEmpresa = $data['empresas']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresa'])) ? ($result['skEmpresa'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']." (".$rEmpresa['sRFC'].")"); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>    
    <div class="form-group">
      <label class="control-label col-md-2">Regimen <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skRegimen" id="skRegimen" class="form-control form-filter input-sm">
          <option value="">- Regimen -</option>
          <?php
                                    if(isset($data['regimenes'])){
                                        while($rRegimen = $data['regimenes']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rRegimen['skRegimen']; ?>" <?php echo (isset($result['skRegimen'])) ? ($result['skRegimen'] == $rRegimen['skRegimen'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rRegimen['sNombre']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Clave de Documento <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skClaveDocumento" id="skClaveDocumento" class="form-control form-filter input-sm">
          <option value="">- Clave de Documento -</option>
          <?php
                                    if(isset($data['clavedocumento'])){
                                        while($rClaveDocumento = $data['clavedocumento']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rClaveDocumento['skClaveDocumento']; ?>" <?php echo (isset($result['skClaveDocumento'])) ? ($result['skClaveDocumento'] == $rClaveDocumento['skClaveDocumento'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rClaveDocumento['sNombre']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Corresponsalía <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skCorresponsalia" id="skCorresponsalia" class="form-control form-filter input-sm">
          <option value="">- Corresponsalía -</option>
          <?php
                                    if(isset($data['corresponsalia'])){
                                        while($rCorresponsalia = $data['corresponsalia']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rCorresponsalia['skCorresponsalia']; ?>" <?php echo (isset($result['skCorresponsalia'])) ? ($result['skCorresponsalia'] == $rCorresponsalia['skCorresponsalia'] ? 'selected' : '' ) : '' ; ?> >  <?php echo utf8_encode($rCorresponsalia['sNombre']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Conocimiento Marítimo <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skConocimientoMaritimo" id="skConocimientoMaritimo" class="form-control form-filter input-sm">
          <option value="">- Conocimiento Marítimo -</option>
          <?php
                                    if(isset($data['conocimientomaritimo'])){
                                        while($rConocimientoMaritimo = $data['conocimientomaritimo']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rConocimientoMaritimo['skConocimientoMaritimo']; ?>" <?php echo (isset($result['skConocimientoMaritimo'])) ? ($result['skConocimientoMaritimo'] == $rConocimientoMaritimo['skConocimientoMaritimo'] ? 'selected' : '' ) : '' ; ?> >  <?php echo utf8_encode($rConocimientoMaritimo['sNombre']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>
    
    
     
  </div>
</form>
<div class="clearfix"></div>
<form id="fileupload" action="assets/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
  <table role="presentation" class="table table-striped clearfix">
    <tbody class="files">
    </tbody>
  </table>
</form>
<script type="text/javascript">
    var fraccion = 1;
    $(document).ready(function(){
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
                skEmpresa:{
                    required: true
                },
				skRegimen:{
                    required: true
                },
				skClaveDocumento:{
                    required: true
                },
				skCorresponsalia:{
                    required: true
                },
				skConocimientoMaritimo:{
                    required: true
                },
				dFechaProgramacion:{
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
                    required: true
                },
                skEmpresa:{
                    required: true
                },
				skRegimen:{
                    required: true
                },
				skClaveDocumento:{
                    required: true
                },
				skCorresponsalia:{
                    required: true
                },
				skConocimientoMaritimo:{
                    required: true
                },
				dFechaProgramacion:{
                    required: true
                }
            }
        });
    }); 
</script>
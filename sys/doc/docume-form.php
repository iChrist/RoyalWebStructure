<?php
    $result = array();
    $filesDocTipo = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
        if($data['filesDocTipo']){
            while($row = $data['filesDocTipo']->fetch_assoc()){
                $filesDocTipo[$row['skDocTipo']] = array($row['skRecepcionDoc_docTipo'],$row['sFile']);
            }
        }
    }
	
	
//echo "<pre>".print_r($data,1)."</pre>";
//echo "<pre>".print_r($result,1)."</pre>";
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
    <hr>
    <div class="form-group">
      <label class="control-label col-md-2">Tipo Servicios <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-10">
        <div class="radio-list">
          <?php $i = 0?>
          <?php while($rTiposervicio =  $data['tiposservicios']->fetch_assoc()){?>
          <?php $i++;?>
          <label>
                <input type="radio" class="tipoServicio" tipo="<?php echo utf8_encode($rTiposervicio{'sNombre'}); ?>" name="skTipoServicio" value="<?php echo $rTiposervicio{'skTipoServicio'}?>" <?php echo ((isset($result['skTipoServicio']) ? $result['skTipoServicio'] : "-") == $rTiposervicio{'skTipoServicio'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
                <?php echo utf8_encode($rTiposervicio{'sNombre'}); ?>
          </label>
          <?php }?>
        </div>
      </div>
    </div>
    <!--  DATOS PARA EL TIPO DE SERVICIO !-->
        <!-- CONTENEDOR !-->
        <div class="form-group contenedor">
            <label class="control-label col-md-2">N&uacute;m. Contenedor <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="sNumContenedor" id="sNumContenedor" class="form-control contenedor" placeholder="N&uacute;m. Contenedor" value="<?php echo (isset($result['sNumContenedor'])) ? utf8_encode($result['sNumContenedor']) : '' ; ?>" >
                </div>
            </div>
        </div>
        <!-- CARGA SUELTA !-->
        <div class="form-group cargaSuelta">
            <label class="control-label col-md-2">Bultos <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="iBultos" id="iBultos" class="form-control cargaSuelta" placeholder="Bultos" value="<?php echo (isset($result['iBultos'])) ? utf8_encode($result['iBultos']) : '' ; ?>" >
                </div>
            </div>
        </div>
        <div class="form-group cargaSuelta">
            <label class="control-label col-md-2">peso <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fPeso" id="fPeso" class="form-control cargaSuelta" placeholder="Peso" value="<?php echo (isset($result['fPeso'])) ? utf8_encode($result['fPeso']) : '' ; ?>" >
                </div>
            </div>
        </div>
        <div class="form-group cargaSuelta">
            <label class="control-label col-md-2">Volumen <span aria-required="true" class="required"> * </span> </label>
            <div class="col-md-4">
                <div class="input-icon right"> <i class="fa"></i>
                    <input type="text" name="fVolumen" id="fVolumen" class="form-control cargaSuelta" placeholder="Volumen" value="<?php echo (isset($result['fVolumen'])) ? utf8_encode($result['fVolumen']) : '' ; ?>" >
                </div>
            </div>
        </div>
        <hr>
    <!-- TERMINA DATOS PARA EL TIPO DE SERVICIO !-->
      
      
    <div class="form-group">
      <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sReferencia" id="sReferencia" class="form-control" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ; ?>" >
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Pedimento <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sPedimento" id="sPedimento" class="form-control" placeholder="Pedimento" value="<?php echo (isset($result['sPedimento'])) ? utf8_encode($result['sPedimento']) : '' ; ?>" >
        </div>
      </div>
    </div>
     
    <div class="form-group">
      <label class="control-label col-md-2">Cliente <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skEmpresa" id="skEmpresa" class="form-control form-filter input-sm">
          <option value="">- Cliente -</option>
          <?php
                                    if($data['empresas']){
                                        while($rEmpresa = $data['empresas']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresa'])) ? ($result['skEmpresa'] == $rEmpresa['skEmpresa'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']); ?> </option>
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
                                    if($data['clavedocumento']){
                                        while($rClaveDocumento = $data['clavedocumento']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rClaveDocumento['skClaveDocumento']; ?>" <?php echo (isset($result['skClaveDocumento'])) ? ($result['skClaveDocumento'] == $rClaveDocumento['skClaveDocumento'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rClaveDocumento['skClaveDocumento']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Mercancía <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sMercancia" id="sMercancia" class="form-control" placeholder="Mercancía" value="<?php echo (isset($result['sMercancia'])) ? utf8_encode($result['sMercancia']) : '' ; ?>" >
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Observaciones <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sObservaciones" id="sObservaciones" class="form-control" placeholder="Observaciones" value="<?php echo (isset($result['sObservaciones'])) ? utf8_encode($result['sObservaciones']) : '' ; ?>" >
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-md-2">Fecha de recepci&oacute;n <span aria-required="true" class="required"> * </span></label>
      <div class="col-md-4">
        <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
          <input type="text" id="dRecepcion" name="dRecepcion" readonly="" class="form-control" value="<?php echo (isset($result['dRecepcion'])) ? utf8_encode($result['dRecepcion']) : date('d-m-Y') ; ?>">
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2">Hora de recepci&oacute;n <span aria-required="true" class="required"> * </span></label>
        <div class="col-md-4">
            <div class="input-group bootstrap-timepicker">
                <input type="text" id="tRecepcion" name="tRecepcion" class="form-control timepicker-24" value="<?php echo (isset($result['tRecepcion'])) ? utf8_encode($result['tRecepcion']) : '' ; ?>">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                </span>
            </div>
        </div>
    </div>
    
    <!-- CARGAR DE rel_recepcionDoc_docTipo !-->
    <div class="form-group">
      <label class="control-label col-lg-2 col-md-2 col-xs-2">Archivos </label>
      <div class="col-lg-4 col-md-2 col-xs-2">
        <?php
          if($data['docTipo']){
            while($docTipo = $data['docTipo']->fetch_assoc()){
        ?>
            <label>
                <?php 
                    echo $docTipo['skDocTipo'];
                    $hidden = false;
                    if(array_key_exists($docTipo['skDocTipo'] , $filesDocTipo)){
                        $hidden = true;
                ?>
                <span>
                    <input type="hidden" value="<?php echo $filesDocTipo[$docTipo['skDocTipo']][0]; ?>" />
                    <a href="<?php echo SYS_URL.SYS_PROJECT; ?>/doc/files/<?php echo $filesDocTipo[$docTipo['skDocTipo']][1]; ?>" target="_blank">Ver archivo</a>
                    <a href="javascript:;" class="btn btn-default btn-xs delete-doc-tipo" skDocTipo="<?php echo $docTipo['skDocTipo']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </span>
                <?php
                    }//ENDIF
                ?>
                <input type="file" name="skDocTipo[<?php echo $docTipo['skDocTipo']; ?>]" id="<?php echo $docTipo['skDocTipo']; ?>" <?php if($hidden){ echo 'style="display:none;"';}?> />
            </label><br>
        <?php
            }//ENDWHILE
          }//ENDIF
        ?>
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
        /*
         * HABILITA EL CAMPO DE Núm. Contenedor
         */
        var tipo = $('.tipoServicio:checked').attr("tipo"); 
        switch(tipo){
            case "Contenedor":
                $(".cargaSuelta").val('');
                $(".cargaSuelta").css("display","none");
                $(".contenedor").css("display","block");
                break;
            case "Carga Suelta":
                $(".contenedor").val('');
                $(".contenedor").css("display","none");
                $(".cargaSuelta").css("display","block");
                break;
        }
        $(".tipoServicio").click(function(){
           tipo = $(this).attr("tipo"); 
           switch(tipo){
               case "Contenedor":
                   $(".cargaSuelta").val('');
                   $(".cargaSuelta").css("display","none");
                   $(".contenedor").css("display","block");
                   break;
               case "Carga Suelta":
                   $(".contenedor").val('');
                   $(".contenedor").css("display","none");
                   $(".cargaSuelta").css("display","block");
                   break;
           }
        });
        /*
         * Muestra el input type file para un documento
         * que sustituirá al actual.
         */
        $(".delete-doc-tipo").click(function(){
            var skDocTipo = $(this).attr("skDocTipo");
            $("#"+skDocTipo).css("display","block");
            $(this).parent().remove();
        });
        /*
         * VALIDACIONES DEL FORMULARIO
         */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: ":hidden",
            rules:{
                sReferencia:{
                    required: true
                },
                sPedimento:{
                    required: true
                },
                sMercancia:{
                    required: true
                },
                sObservaciones:{
                    required: true
                },
		skEmpresa:{
                    required: true
                },
                skClaveDocumento:{
                    required: true
                },
                skCorresponsalia:{
                    required: true
                },
                sNumContenedor:{
                    required: true
                },
                iBultos:{
                    required: true,
                    number: true
                },
                fPeso:{
                    required: true,
                    number: true
                },
                fVolumen:{
                    required: true,
                    number: true
                },
                dRecepcion:{
                    required: true
                },
                tRecepcion:{
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
                    required: "Campo obligatorio"
                },
                sPedimento:{
                    required: "Campo obligatorio"
                },
                sMercancia:{
                    required: "Campo obligatorio"
                },
                Observaciones:{
                    required: "Campo obligatorio"
                },		
                skEmpresa:{
                    required: "Campo obligatorio"
                },
                skClaveDocumento:{
                    required: "Campo obligatorio"
                },
                skCorresponsalia:{
                    required: "Campo obligatorio"
                },
                sNumContenedor:{
                    required: "Campo obligatorio"
                },
                iBultos:{
                    required: "Campo obligatorio",
                    number: "Solo n&uacute;meros"
                },
                fPeso:{
                    required: "Campo obligatorio",
                    number: "Solo n&uacute;meros"
                },
                fVolumen:{
                    required: "Campo obligatorio",
                    number: "Solo n&uacute;meros"
                },
                dRecepcion:{
                    required: "Campo obligatorio"
                },
                tRecepcion:{
                    required: "Campo obligatorio"
                }
            }
        });
    }); 
</script>

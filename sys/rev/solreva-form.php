<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
	$arrayRechazos = array();
	if(isset($data['rechazosSolicitud'])){
  if($data['rechazosSolicitud'])
    {
		if($data['rechazosSolicitud']->num_rows > 0){
			 while($row = $data['rechazosSolicitud']->fetch_assoc()){
				$arrayRechazos[] = $row{'skRechazo'};
			 }
		 }
    }
  }
    $disabled="";
    $result['skEstatusRevalidacion'] = isset($result['skEstatusRevalidacion']) ? $result['skEstatusRevalidacion'] : null;
    if(!is_null($result['skEstatusRevalidacion'])){
      $disabled="disabled";
    }
    $disabled_solicitud ="";
    if(!is_null($result['skEstatusRevalidacion']) && ($result['skEstatusRevalidacion']=='RV' || $result['skEstatusRevalidacion']=='RE')){
        $disabled_solicitud ="disabled";
    }
?>

<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
  <input type="hidden" name="skSolicitudRevalidacion"  id="skSolicitudRevalidacion" value="<?php echo (isset($result['skSolicitudRevalidacion'])) ? $result['skSolicitudRevalidacion'] : '' ; ?>">
  <div class="form-body">

    <div class="form-group">
      <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sReferencia" id="sReferencia" class="form-control" onChange="obtenerDatos();" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? htmlentities(utf8_encode($result['sReferencia'])) : '' ; ?>" <?php echo $disabled; ?>>
        </div>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-md-2">BL Master</label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sBlMaster" id="sBlMaster" class="form-control" placeholder="BL Master" value="<?php echo (isset($result['sBlMaster'])) ? htmlentities(utf8_encode($result['sBlMaster'])) : '' ; ?>" <?php echo $disabled; ?>>
        </div>
      </div>
    </div>

    <!--
    <div class="form-group">
      <label class="control-label col-md-2">BL House</label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sBlHouse" id="sBlHouse" class="form-control" placeholder="BL House" value="<?php echo (isset($result['sBlHouse'])) ? htmlentities(utf8_encode($result['sBlHouse'])) : '' ; ?>" <?php echo $disabled; ?>>
        </div>
      </div>
    </div>
    !-->

    <div class="form-group">
      <label class="control-label col-md-2">ETA <span aria-required="true" class="required"> * </span></label>
      <div class="col-md-4">
        <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
          <input type="text" id="dEta" name="dEta" class="form-control" value="<?php echo (isset($result['dEta'])) ?  utf8_encode(date('d-m-Y', strtotime($result['dEta']))) : date('d-m-Y') ; ?>" <?php echo $disabled; ?>>
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Fecha de Arribo de buque </label>
      <div class="col-md-4">
        <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
          <input type="text" id="dFechaArriboBuque" name="dFechaArriboBuque" class="form-control" value="<?php echo (isset($result['dFechaArriboBuque'])) ?  utf8_encode(date('d-m-Y', strtotime($result['dFechaArriboBuque']))) : date('d-m-Y') ; ?>" <?php echo $disabled; ?>>
          <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Prioridad <span aria-required="true" class="required"> * </span></label>
      <div class="col-md-2">
          <label>
            <input type="radio" name="iPrioridad" value="0" checked <?php echo $disabled; ?>>Normal
          </label>
      </div>
      <div class="col-md-2">
          <label>
            <input type="radio" name="iPrioridad" value="1" <?php if(isset($result['iPrioridad']) && $result['iPrioridad'] == 1){ ?>checked="checked"<?php }//ENDIF ?> <?php echo $disabled; ?>>Urgente
          </label>
      </div>
    </div>

    <hr>
     <div id="dvDatos">


     </div>


    <div class="form-group">
      <label class="col-md-2">Línea Naviera <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skEmpresaNaviera" id="skEmpresaNaviera" class="form-control form-filter input-sm" <?php echo $disabled; ?>>
          <option value="">- Línea Naviera -</option>
          <?php
                                    if($data['empresas']){
                                        while($rEmpresa = $data['empresas']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rEmpresa['skEmpresa']; ?>" <?php echo (isset($result['skEmpresaNaviera'])) ? ($result['skEmpresaNaviera'] == $rEmpresa['skEmpresa'] ? 'selected="selected"' : '' ) : '' ; ?> > <?php echo utf8_encode($rEmpresa['sNombre']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>

    <?php
        //skEstatusRevalidacion
        $skEstatusRevalidacion = isset($result['skEstatusRevalidacion']) ? $result['skEstatusRevalidacion'] : '';
        if($skEstatusRevalidacion == 'NU'){
    ?>
    <hr>
    <input type="hidden" name="skEstatusRevalidacion" value="PR">
      <div class="form-group">
        <label class="col-md-2">Tramitador <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-4">
          <select name="skUsuarioTramitador" id="skUsuarioTramitador" class="form-control form-filter input-sm">
            <option value="">- Tramitador -</option>
            <?php
                if($data['tramitadores']){
                    while($rTramitador = $data['tramitadores']->fetch_assoc()){
            ?>
            <option value="<?php echo $rTramitador['skUsers']; ?>" <?php echo (isset($result['skUsuarioTramitador'])) ? ($result['skUsuarioTramitador'] == $rTramitador['skUsers'] ? 'selected="selected"' : '' ) : '' ; ?> > <?php echo utf8_encode($rTramitador['sName']); ?> </option>
            <?php
                    }//ENDIF
                }//ENDWHILE
            ?>
          </select>
        </div>
      </div>

    <?php
        }elseif($skEstatusRevalidacion == 'PR' || $skEstatusRevalidacion == 'RV' || $skEstatusRevalidacion == 'RE'){
    ?>
<div id="dvEstatusNaviera" style="display:none">

     <div class="form-group">
        <label class="col-md-2">Tramitador <span aria-required="true" class="required"> * </span> </label>
        <div class="col-md-4">
          <select name="skUsuarioTramitador" id="skUsuarioTramitador" class="form-control form-filter input-sm" disabled="disabled">
            <option value="">- Tramitador -</option>
            <?php
                if($data['tramitadores']){
                    while($rTramitador = $data['tramitadores']->fetch_assoc()){
            ?>
            <option value="<?php echo $rTramitador['skUsers']; ?>" <?php echo (isset($result['skUsuarioTramitador'])) ? ($result['skUsuarioTramitador'] == $rTramitador['skUsers'] ? 'selected="selected"' : '' ) : '' ; ?> > <?php echo utf8_encode($rTramitador['sName']); ?> </option>
            <?php
                    }//ENDIF
                }//ENDWHILE
            ?>
          </select>
        </div>
      </div>

    <div class="form-group">
      <label class="col-md-2">Estatus Naviera <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-10">
        <?php
          if($data['estatus']){
            while($rEstatus =  $data['estatus']->fetch_assoc()){
        ?>
        <label><input type="radio" name="skEstatusRevalidacion" class="form-filter tipoEstatus" tipo="<?php echo utf8_encode($rEstatus{'skEstatus'}); ?>" value="<?php echo $rEstatus{'skEstatus'}?>" <?php echo ((isset($result['skEstatusRevalidacion']) ? $result['skEstatusRevalidacion'] : "-") == $rEstatus{'skEstatus'} ? 'checked' : '' ? 'checked' : '' ); ?> <?php echo $disabled_solicitud; ?> ><?php echo utf8_encode($rEstatus['sNombre'])?></label>
        <?php
            }//ENDWHILE
          }//ENDIF
        ?>
      </div>
    </div>


    <div id="dvRechazos" style="display:none;">
    <hr>
     <div class="form-group">
                <label class="col-md-2">Rechazos <span aria-required="true" class="required"> * <div class="help-block">( Elija al menos 1 rechazo )</div> </span>
                </label>
                <div class="col-md-10">
                    <div class="row">
                        <div class="checkbox-list">

                                <?php
                                if($data['rechazos'])
                                {
                                    foreach ($data['rechazos'] as $rechazo)
                                    {
                                    ?>
                                        <div class="col-md-6">
                                               <label> <input type="checkbox" name="skRechazo[]" value="<?php echo $rechazo['skRechazo']; ?>" <?php  echo (in_array($rechazo['skRechazo'], $arrayRechazos) ? 'checked' : '') ?> <?php echo $disabled_solicitud; ?> />
                                                <?php echo $rechazo['sNombre']; ?>    <br/>&nbsp;</label>

                                        </div>
                                    <?php
                                    }
                                }
                                ?>
                        </div>

                    </div>
                </div>

            </div>
         <hr>
     </div>

     </div>
      <!-- Cierra div dvEstatusNaviera-->
    <?php
        }//ENDIF skEstatusRevalidacion
    ?>

    <div class="form-group">
      <label class=" col-md-2">Observaciones </label>
      <div class="col-md-8">
        <div class="input-icon right"> <i class="fa"></i>
          <textarea rows="5"  name="sObservaciones" id="sObservaciones" class="form-control" placeholder="Observaciones"  ><?php echo (isset($result['sObservaciones'])) ? htmlentities(utf8_encode($result['sObservaciones'])) : '' ; ?></textarea>
        </div>
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

function lanzadera(){
 	if(document.getElementById("skSolicitudRevalidacion").value){
            var skStatusRevalidacion = '<?php echo isset($result['skEstatusRevalidacion']) ? $result['skEstatusRevalidacion'] : ''; ?>';
            switch(skStatusRevalidacion){
                case 'PR':
                break;
                case 'TR':

                break;
                case 'RV':
                    obtenerDatos();
                    document.getElementById('dvEstatusNaviera').style.display ='block';
                break;
                case 'RE':
                    obtenerDatos();
                    document.getElementById('dvEstatusNaviera').style.display ='block';
                break;
            }
		obtenerDatos();
		document.getElementById('dvEstatusNaviera').style.display ='block';
	}
}

    window.onload = lanzadera;


     var tipo = $('.tipoEstatus:checked').attr("tipo");
        switch(tipo){
            case "RE":
                 $("#dvRechazos").css("display","block");
                break;
            case "RV":
                  $("#dvRechazos").css("display","none");
                  break;
        }
        $(".tipoEstatus").click(function(){
            tipo = $(this).attr("tipo");
           // alert(tipo);
           switch(tipo){
               case "RE":
                 $("#dvRechazos").css("display","block");
                break;
            case "RV":
                  $("#dvRechazos").css("display","none");
                  break;
           }
        });
function obtenerDatos(){
	  $('.page-title-loading').css('display','inline');
	 $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
            $("#dvDatos").html(data);
            $('.page-title-loading').css('display','none');
            });
			}

    $(document).ready(function(){




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
                        axn: "validarReferencia",
                        skSolicitudRevalidacion:  function (){return $( "#skSolicitudRevalidacion" ).val();}
                      }
                    }

                },

                skEmpresaNaviera:{
                    required: true,
                     minlength: 1
                },
                skUsuarioTramitador:{
                    required: true
                },
                skEstatusRevalidacion:{
                    required: true
                },
                sBL:{
                    required: true
                },
                dEta:{
                    required: true
                }
                /*sObservaciones:{
                    required: true
                },*/
                /*
                /* 'skRechazo[]':{
                    required: true,
                    minlength: 1
                 }*/
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
                    required:"Ingresa una Referencia",
                    remote: function(){
                        return 'La referencia "'+$("#sReferencia").val()+'" no Existe.';
                    }
                },
                skEmpresaNaviera:{
                    required: "Selecciona una Línea Naviera",
                    minlength: 1
                },
                skUsuarioTramitador:{
                    required: "Selecciona un Tramitador"
                },
                skEstatusRevalidacion:{
                    required: "Selecciona un Estatus"
                    /*required: function(){
                        alert('HJKBSDKJHFGDS');
                    }*/
                },
                sBL:{
                    required: "Campo obligatorio"
                },
                dEta:{
                    required: "Campo obligatorio"
                }
                /*Observaciones:{
                    required: true
                },*/
            }
        });
    });
</script>

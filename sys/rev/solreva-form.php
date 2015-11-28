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
  <input type="hidden" name="skSolicitudRevalidacion"  id="skSolicitudRevalidacion" value="<?php echo (isset($result['skSolicitudRevalidacion'])) ? $result['skSolicitudRevalidacion'] : '' ; ?>">
  <div class="form-body">
       
    <div class="form-group">
      <label class="control-label col-md-2">Referencia <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <div class="input-icon right"> <i class="fa"></i>
          <input type="text" name="sReferencia" id="sReferencia" class="form-control" onchange="obtenerDatos();" placeholder="Referencia" value="<?php echo (isset($result['sReferencia'])) ? utf8_encode($result['sReferencia']) : '' ; ?>" >
        </div>
      </div>
    </div>
     <div id="dvDatos">
     
     <!--<div class="form-group">
       
     	<label class="control-label col-md-2"><b>Cliente</b></label>
     	<div class="col-md-4">
       		 <label id="lbCliente" class="control-label col-md-2">aaaa</label>
        </div>
      	<label class="control-label col-md-2"><b>Servicio de</b></label>
	     <div class="col-md-4">
	        <label id="lbServicio" class="control-label col-md-2">Contenedor</label>
	     </div>
    </div>
    <div class="form-group">
       
     	<label class="control-label col-md-2"><b>Ejecutivo</b></label>
     	<div class="col-md-4">
       		 <label id="lbEjecutivo" class="control-label col-md-2">Eje</label>
        </div>
      	<label class="control-label col-md-2"><b>Mercancia</b></label>
	     <div class="col-md-4">
	        <label id="lbMercancia" class="control-label col-md-2">Merca</label>
	     </div>
    </div>-->
    
     </div>
     
    <div class="form-group">
      <label class="control-label col-md-2">Línea Naviera <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skEmpresaNaviera" id="skEmpresaNaviera" class="form-control form-filter input-sm">
          <option>- Línea Naviera -</option>
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
      <label class="control-label col-md-2">Tramitador <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-4">
        <select name="skUsuarioTramitador" id="skUsuarioTramitador" class="form-control form-filter input-sm">
          <option>- Tramitador -</option>
          <?php
                                    if(isset($data['tramitadores'])){
                                        while($rTramitador = $data['tramitadores']->fetch_assoc()){
                                ?>
          <option value="<?php echo $rTramitador['skUsers']; ?>" <?php echo (isset($result['skUsers'])) ? ($result['skUsers'] == $rTramitador['skUsers'] ? 'selected' : '' ) : '' ; ?> > <?php echo utf8_encode($rTramitador['sName']); ?> </option>
          <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
        </select>
      </div>
    </div>    
     <div class="form-group">
      <label class="control-label col-md-2">Estatus Naviera <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-10">
        <div class="radio-list">
          <?php $i = 0?>
          <?php while($rEstatus =  $data['estatus']->fetch_assoc()){?>
          <?php $i++;?>
          <label>
          <div class=""> <span>
            <input type="radio" name="skEstatusRevalidacion" value="<?php echo $rEstatus{'skEstatus'}?>" <?php echo ((isset($result['skEstatusRevalidacion']) ? $result['skEstatusRevalidacion'] : "-") == $rEstatus{'skEstatus'} ? 'checked' : ($i==1 ) ? 'checked' : '' )?>  >
            <?php echo utf8_encode($rEstatus{'sNombre'})?> </span> </div>
          </label>
          <?php }?>
        </div>
      </div>
    </div>

    
    <hr>
    <div class="form-group">
      <label class="control-label col-md-2">Observaciones <span aria-required="true" class="required"> * </span> </label>
      <div class="col-md-8">
        <div class="input-icon right"> <i class="fa"></i>
          <textarea rows="5"  name="sObservaciones" id="sObservaciones" class="form-control" placeholder="Observaciones" value="<?php echo (isset($result['sObservaciones'])) ? utf8_encode($result['sObservaciones']) : '' ; ?>" ></textarea>
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
function obtenerDatos(){
	  $('.page-title-loading').css('display','inline');
	 $.post("",{ axn : "obtenerDatos" , sReferencia : $("#sReferencia").val() }, function(data){
                console.log(data); 
                
                  if(data['response']){
                  alert(1);
                   alert(data['datos']['sReferencia']);
                  }
                   
                var cad = 'aaaa';
                /*$.each(data,function(k,v){
                  cad += '<option value="'+v+'">'+v+'</option>'; 
               });*/
               $("#dvDatos").html(cad);
               /*$("#sNumeroParte").html(cad);
               $("#sNumeroParte").prop('disabled', false);*/
               $('.page-title-loading').css('display','none');
            });
            
		//obj.disabled = true;
	   /* $('.alert-danger').hide();
	    $('.alert-success').show();*/
	  
	   /* var formdata = false;
	    if (window.FormData) {
		formdata = new FormData($("#obtenerDatos")[0]);
	    }
		$.ajax({
		type: "POST",
		url: "",
		data: formdata,
 		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
 		    if(data['response']){
 		      // toastr.success(data['message'], "Notificaci&oacute;n");
                        var cad = '';
                        alert(1);
                        $.each(data['datos'], function(k,v){
                        alert(2);
                            //console.log(getUrl+'?axn=getFoto&url='+v);
                            console.log(v);
                            cad +='aaaaaaaaaa';
                        });
                        $("#dvDatos").html(cad);
		    }else{
		        toastr.error(data['message'], "No se Encuentra la Referencia");
		    }
		    $('.page-title-loading').css('display','none');
		   // obj.disabled = false;
		}
	    });*/
	}

    $(document).ready(function(){
    
    
    
    
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
                        sReferencia: function (){return $( "#sReferencia" ).val();},
                        axn: "validarReferencia",
                        skSolicitudRevalidacion:  function (){return $( "#skSolicitudRevalidacion" ).val();}
                      }
                    }
                    
                },

				sObservaciones:{
                    required: true
                },
				
                skEmpresaNaviera:{
                    required: true
                },
				skUsuarioTramitador:{
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
                    required: true,
                       remote: "Esta referencia no Existe."
                },
 				Observaciones:{
                    required: true
                },
				
                skEmpresaNaviera:{
                    required: true
                },
				skUsuarioTramitador:{
                    required: true
                }
            }
        });
    }); 
</script>
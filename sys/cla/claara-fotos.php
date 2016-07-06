<?php
    $result = array();
    if($data['datos']){
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-2">Archivo ZIP
            </label>
            <div class="col-md-4">
                <input type="file" name="zip" id="zip" />
            </div>
        </div>

    </div>
</form>
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-reorder"></i>Clasificaci&oacute;n de mercancias
                </div>
                <div class="tools">   
                    <a class="collapse" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body form">
                
		<form id="buscarFotos" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <div class="form-body">
	<input type="hidden" name="axn" value="buscarFotos">
        <div class="form-group">
            <label class="control-label col-md-2">Fracci&oacute;n
            </label>
            <div class="col-md-4">
                <select name="sFraccion" id="sFraccion" class="form-control form-filter input-sm">
                    <option value="">- Todos -</option>
                <?php
                    if($data['fracciones']){
                        while($row = $data['fracciones']->fetch_assoc()){
                ?>
                    <option value="<?php echo $row['sFraccion']; ?>">
                                <?php echo utf8_encode($row['sFraccion']); ?>
                            </option>
                <?php
                        }//ENDIF
                    }//ENDWHILE
                ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">N&uacute;mero de parte
            </label>
            <div class="col-md-4">
                <select name="sNumeroParte" id="sNumeroParte" class="form-control form-filter input-sm" disabled>
                    <option value="">- N&uacute;mero de parte -</option>
                </select>
            </div>
        </div>

        <div class="form-group">
<label class="control-label col-md-2"></label>
            <div class="col-md-4">
                <a href="javascript:;" class="btn btn-sm btn-default" onclick="buscarFotos(this);"><i class="fa fa-search"></i> Buscar</a>
            </div>
        </div>

    </div>
</form>

                <div class="row" id="imgClasificacion" style="padding:10px;"></div>
                
            </div>
        </div>

<div class="clearfix"></div>

<script type="text/javascript">
        
	function buscarFotos(obj){
		obj.disabled = true;
	    $('.alert-danger').hide();
	    $('.alert-success').show();
	    $('.page-title-loading').css('display','inline');
	    var formdata = false;
	    if (window.FormData) {
		formdata = new FormData($("#buscarFotos")[0]);
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
		        toastr.success(data['message'], "Notificaci&oacute;n");
                        var cad = '';
                        $.each(data['datos'], function(k,v){
                            //console.log(v);
                            cad +='<div class="col-lg-3 col-md-3 col-xs-4"><a href="'+v.sArchivo+'" class="thumbnail" target="_blank"><img src="'+v.sThumbnail+'" class="col-lg-12 col-md-12 col-xs-12" alt="GyA"><div class="caption"><center><p>'+v.sFraccion+'<br>'+v.sNumeroParte+'</p></center></div></a></div>';
                        });
                        $("#imgClasificacion").html(cad);
		    }else{
		        toastr.error(data['message'], "Notificaci&oacute;n");
		    }
		    $('.page-title-loading').css('display','none');
		    obj.disabled = false;
		}
	    });
	}
    $(document).ready(function(){
        // CARGAR LOS NUMEROS DE PARTE CORRESPONDIENTES A CADA FRACCION ARANCELARIA //
        $("#sFraccion").change(function(){
            $('.page-title-loading').css('display','inline');    
            $.post("",{ axn : "getNumerosParte" , sFraccion : $("#sFraccion").val() }, function(data){
                //console.log(data); 
                var cad = '<option value="">- Todos -</option>';
                $.each(data,function(k,v){
                  cad += '<option value="'+v+'">'+v+'</option>'; 
               });
               $("#sNumeroParte").html(cad);
               $("#sNumeroParte").prop('disabled', false);
               $('.page-title-loading').css('display','none');
            });
        });
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                zip:{
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
                zip:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>

<!-- BEGIN PAGE LEVEL STYLES (DROPZONE) -->
<link href="<?php echo SYS_URL ?>core/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES (DROPZONE) -->

<div class="col-md-12">
    <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
        <button onclick="_save(this,'http://localhost/RoyalWebStructure/sys/cla/segcla-form/registrar-2da-clasificacion/');" class="btn btn-sm btn-default" type="button"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</div>

<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    <input type="hidden" name="axn" value="insert" />
    <div class="form-group">
        <label class="control-label col-md-2">Imagenes <span aria-required="true" class="required"> * </span> </label>
        <div class="dropzone col-md-9" id="myDropzone">
            <?php
                Core_Functions::printDropzoneImages(array(
                    array(
                        'fileName'=>'8d60a9e041184baf28f426cc1c30f206.png'
                        ,'size'=>'95.8'
                        ,'src'=>SYS_URL.'sys/zon/files/8d60a9e041184baf28f426cc1c30f206.png'
                        ,'param'=>'skImagen[]'
                        ,'id'=>'ABC123'
                    ),
                    array(
                        'fileName'=>'c5d9df1d65547108a24fde228f1b55c7.png'
                        ,'size'=>'36.5'
                        ,'src'=>SYS_URL.'sys/zon/files/c5d9df1d65547108a24fde228f1b55c7.png'
                        ,'param'=>'skImagen[]'
                        ,'id'=>'DEF456'
                    ),
                    array(
                        'fileName'=>'ca28d5e8f5c2c0d663fd73c1c4d452e5.png'
                        ,'size'=>'58.3'
                        ,'src'=>SYS_URL.'sys/zon/files/ca28d5e8f5c2c0d663fd73c1c4d452e5.png'
                        ,'param'=>'skImagen[]'
                        ,'id'=>'GHI789'
                    )
                ));
            ?>
        </div>
    </div>
</form>
<!-- BEGIN PAGE LEVEL PLUGINS (DROPZONE) -->
<script src="<?php echo SYS_URL ?>core/assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/lib/form-dropzone.js"></script>
<!-- END PAGE LEVEL PLUGINS (DROPZONE) -->
<script>
jQuery(document).ready(function() {
   // initiate layout and plugins
    FormDropzone.init({
        url: "cambiarCuandoSeaCustom",
        paramName: "myFiles", // The name that will be used to transfer the file
        acceptedFiles: 'image/*',
        maxFilesize: 2, // MB
        dictDefaultMessage: 'Sube aqui tus archivos',
        thumbnailWidth:'200',
        thumbnailHeight:'200',
        uploadMultiple: true,
        autoProcessQueue: false,
        
    });
    
    /*Dropzone.options.myDropzone = {
        url: "a",
        paramName: "myFiles", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        uploadMultiple: true,
        autoProcessQueue: false
    };*/
    
    /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                
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
                
            }
        });
    
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
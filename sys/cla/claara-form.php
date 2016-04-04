<?php
    $result = array();
    if($data['datos']){
    }
?>
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data"> 
    
    <div class="form-body">
        <input type="hidden" id="sJson" />
        
        <div class="form-group">
            <label class="control-label col-md-2">Archivo
            </label>
            <div class="col-md-4">
                <span class="btn btn-default fileinput-button">
                    <i class="fa fa-file-excel-o"></i>
                    <span> Seleccionar Excel</span>
                    <input type="file" name="xlfile" id="xlf" />
                </span>
            </div>
        </div>
        
        <!-- INFORMACION DE CUANTOS REGISTROS SE VAN A PROCESAR !-->
        <div class="clearfix"></div>
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-10 error-import">
                <h3 id="total"></h3>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <h4><b>Nota:</b> Da click <a href="<?php echo SYS_URL.SYS_PROJECT; ?>/cla/files/claara/tplClasificacionMercancias.xlsx" target="_blank" style="font-weight: bolder;color:red;font-size: 22px;">aqu&iacute;</a> para descargar el template.</h4>
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

<!-- SCRIPT FOR SHEETS JS !-->
<!-- uncomment the next line here and in xlsxworker.js for encoding support -->
<!--<script src="<?php echo SYS_URL ?>core/assets/sheetjs/dist/cpexcel.js"></script>-->
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/shim.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/jszip.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/xlsx.js"></script>
<!-- uncomment the next line here and in xlsxworker.js for ODS support -->
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/dist/ods.js"></script>
<script type="text/javascript">
var X = XLSX;
var XW = {
	/* worker message */
	msg: 'xlsx',
	/* worker scripts */
	rABS: '<?php echo SYS_URL ?>core/assets/sheetjs/xlsxworker2.js',
	norABS: '<?php echo SYS_URL ?>core/assets/sheetjs/xlsxworker1.js',
	noxfer: '<?php echo SYS_URL ?>core/assets/sheetjs/xlsxworker.js'
};

var rABS = typeof FileReader !== "undefined" && typeof FileReader.prototype !== "undefined" && typeof FileReader.prototype.readAsBinaryString !== "undefined";
var use_worker = typeof Worker !== 'undefined';
var transferable = use_worker;
var wtf_mode = false;

function fixdata(data) {
	var o = "", l = 0, w = 10240;
	for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
	o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
	return o;
}

function ab2str(data) {
	var o = "", l = 0, w = 10240;
	for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint16Array(data.slice(l*w,l*w+w)));
	o+=String.fromCharCode.apply(null, new Uint16Array(data.slice(l*w)));
	return o;
}

function s2ab(s) {
	var b = new ArrayBuffer(s.length*2), v = new Uint16Array(b);
	for (var i=0; i != s.length; ++i) v[i] = s.charCodeAt(i);
	return [v, b];
}

function xw_noxfer(data, cb) {
	var worker = new Worker(XW.noxfer);
	worker.onmessage = function(e) {
		switch(e.data.t) {
			case 'ready': break;
			case 'e': console.error(e.data.d); break;
			case XW.msg: cb(JSON.parse(e.data.d)); break;
		}
	};
	var arr = rABS ? data : btoa(fixdata(data));
	worker.postMessage({d:arr,b:rABS});
}

function xw_xfer(data, cb) {
	var worker = new Worker(rABS ? XW.rABS : XW.norABS);
	worker.onmessage = function(e) {
		switch(e.data.t) {
			case 'ready': break;
			case 'e': console.error(e.data.d); break;
			default: xx=ab2str(e.data).replace(/\n/g,"\\n").replace(/\r/g,"\\r"); console.log("done"); cb(JSON.parse(xx)); break;
		}
	};
	if(rABS) {
		var val = s2ab(data);
		worker.postMessage(val[1], [val[1]]);
	} else {
		worker.postMessage(data, [data]);
	}
}

function xw(data, cb) {
	if(transferable) xw_xfer(data, cb);
	else xw_noxfer(data, cb);
}

function to_json(workbook) {
	var result = {};
	workbook.SheetNames.forEach(function(sheetName) {
		var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
		if(roa.length > 0){
			result[sheetName] = roa;
		}
	});
	return result;
}

function process_wb(wb) {
	var output = "";
	output = JSON.stringify(to_json(wb), 2, 2);
        var total = to_json(wb);
        console.log(Object.keys(total));
        if(total[Object.keys(total)]){
            $("#total").html("Procesando " + total[Object.keys(total)].length + " Registros...");
            $("#sJson").val(JSON.stringify(to_json(wb)));
            $('.page-title-loading').css('display','inline');
            $.ajax({
                method: "POST",
                url: "",
                data: { 
                    axn: "json_excel",
                    sJson: $("#sJson").val()
                }
            })
            .done(function( data ) {
                if(data['response']){
                    toastr.success(data['message'], "Notificaci&oacute;n");
                    // AQUI SE HACE LA REDIRECCION
                    setInterval(function(){ 
                        //obj.disabled = false;
                        location.reload();
                    }, 3000);
                }else{
                    toastr.error(data['message'], "Notificaci&oacute;n");
                    $("<p style='color:red;font-weight:bold;'>"+data['message']+"</p>").appendTo(".error-import");
                }
                $('.page-title-loading').css('display','none');
            });
        }else{
            toastr.error("El template est&aacute; vacio, o está da&ntilde;ado.", "Notificaci&oacute;n");
        }
        
        
	/*if(out.innerText === undefined) out.textContent = output;
	else out.innerText = output;
	if(typeof console !== 'undefined') console.log("output", new Date());*/
}

var xlf = document.getElementById('xlf');
function handleFile(e) {
	var files = e.target.files;
	var f = files[0];
	{
		var reader = new FileReader();
		var name = f.name;
		reader.onload = function(e) {
			if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
			var data = e.target.result;
			if(use_worker) {
				xw(data, process_wb);
			} else {
				var wb;
				if(rABS) {
					wb = X.read(data, {type: 'binary'});
				} else {
				var arr = fixdata(data);
					wb = X.read(btoa(arr), {type: 'base64'});
				}
				process_wb(wb);
			}
		};
		if(rABS) reader.readAsBinaryString(f);
		else reader.readAsArrayBuffer(f);
	}
}

if(xlf.addEventListener) xlf.addEventListener('change', handleFile, false);
</script>

<script type="text/javascript">
    var fraccion = 0;
    var fraccionDescripcion = 0;
    $(document).ready(function(){
        /* AGREGAR FRACCION */
        $('body').delegate('.add-fraccion', 'click', function(){
            var html_fraccion = '<tr><td><table class="table table-bordered"><tr class="gray"><th><center>Fracci&oacute;n arancelaria</center></th><td><input type="text" name="sFraccion[]" class="form-control" placeholder="Fracci&oacute;n arancelaria"></td><th><center>N&uacute;mero de parte</center></th><td><input type="text" name="sNumeroParte[]" class="form-control" placeholder="N&uacute;mero de parte"></td><td align="center"><a href="javascript:;" class="btn btn-default delete-fraccion"><i class="fa fa-trash-o"></i></a></td></tr><tr><th colspan="2"><center>Descripci&oacute;n</center></th><th colspan="2"><center>Descripci&oacute;n ingl&eacute;s</center></th></tr><tr><td colspan="2"><textarea name="sDescripcion[]" class="form-control" placeholder="Descripci&oacute;n en espa&ntilde;ol"></textarea></td><td colspan="2"><textarea name="sDescripcionIngles[]" class="form-control" placeholder="Descripci&oacute;n en ingl&eacute;s"></textarea></td></tr></table></td></tr>';
            $("#fraccionesArancelarias").append(html_fraccion);
        });
        /* ELIMINAR FRACCION */
        $('body').delegate('.delete-fraccion','click',function(){  
            console.log($(this).parent().parent().parent().parent().parent().parent());
            $(this).parent().parent().parent().parent().parent().parent().remove();
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
                sPedimento:{
                    required: true
                },
                skEmpresa:{
                    required: true
                },
                sFactura:{
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
                    required: "Campo obligatorio."
                },
                sPedimento:{
                    required: "Campo obligatorio."
                },
                skEmpresa:{
                    required: "Campo obligatorio."
                },
                sFactura:{
                    required: "Campo obligatorio."
                }
            }
        });
    }); 
</script>
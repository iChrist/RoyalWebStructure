<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <form id="_formTableAjax" method="POST" action="?axn=fetch_all">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span></span>
                        <div class="table-group-actions pull-right"><span></span>
                            <div class="btn-group btn-group-md" role="group" aria-label="Acciones">
                            <?php
                                $buttons = $this->printModulesButtons(3);
                                echo $buttons['sHtml'];
                            ?>
                            </div>
                        </div>
                    </div>
                        <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="10%">
                                Acciones
                            </th>
                            <th width="5%">
                                Estatus
                            </th>
                            <th width="25%">
                                Referencia
                            </th>
                            <th width="25%">
                                Pedimento
                            </th>
                            <th width="25%">
                                Cliente
                            </th>
                            <th width="5%">
                                Fracciones
                            </th>
                            <th width="25%">
                                Ejecutivo
                            </th>
                            <th width="25%">
                                Clasificador
                            </th>
                            <th width="25%">
                                Estatus
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td>
                                <div aria-label="Acciones" role="group" class="btn-group btn-group-xs">
                                    <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                                    <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                                </div>
                            </td>
                            <td>
                                <select name="valido" class="form-control form-filter input-sm">
                                    <option value="">-Seleccione-</option>
                                    <option value="0">Pendiente</option>
                                    <option value="1">Valido</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
                            </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="sPedimento" placeholder="Pedimento">
                            </td>
                            <td>
                                <select name="skEmpresa" class="form-control form-filter input-sm">
                                    <option value="">- Cliente -</option>
                                <?php
                                    if($data['empresas']){
                                        while($row = $data['empresas']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skEmpresa']; ?>">
                                                <?php echo utf8_encode($row['sNombre']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <!--<input type="text" class="form-control form-filter input-sm" name="skUsersCreacion" placeholder="Ejecutivo">!-->
                                <select name="skUsersCreacion" class="form-control form-filter input-sm">
                                    <option value="">- Ejecutivo -</option>
                                <?php
                                    if($data['users']){
                                        while($row = $data['users']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skUsers']; ?>">
                                                <?php echo utf8_encode($row['sName'].' '.$row['sLastNamePaternal'].' '.$row['sLastNameMaternal']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                    $data['users']->data_seek(0);
                                ?>
                                </select>
                            </td>
                            <td>
                                <!--<input type="text" class="form-control form-filter input-sm" name="skUsersModificacion" placeholder="Clasificador">!-->
                                <select name="skUsersModificacion" class="form-control form-filter input-sm">
                                    <option value="">- Clasificador -</option>
                                <?php
                                    if($data['users']){
                                        while($row = $data['users']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skUsers']; ?>">
                                                <?php echo utf8_encode($row['sName'].' '.$row['sLastNamePaternal'].' '.$row['sLastNameMaternal']); ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                    $data['users']->data_seek(0);
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="skStatus" class="form-control form-filter input-sm">
                                    <option value="">- Estatus -</option>
                                <?php
                                    if($data['status']){
                                        while($row = $data['status']->fetch_assoc()){
                                ?>
                                            <option value="<?php echo $row['skStatus']; ?>">
                                                <?php echo $row['sName']; ?>
                                            </option>
                                <?php
                                        }//ENDIF
                                    }//ENDWHILE
                                ?>
                                </select>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                </div>
            </form> <!-- FORMULARIO PARA BOTONES DE LA TABLA iPosition 3!-->
            <!--</div>!-->
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<div class="clearfix"></div>


<!-- MODAL PARA LA VALIDACIÓN DE LA 1ER CLASIFICACIÓN !-->
<div class="modal fade _validar-modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title _validar-modal-title" id="gridSystemModalLabel">Validar 1ra clasifiaci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <form id="formValidarClasificacion" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="_validar-modal-content">
                        
                </div>
                <div class="_validar-modal-record">

                </div>
                
                <input type="hidden" id="sJson" name="sJson"/>
                
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
                
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <h4>
                            <b>Nota:</b> 
                            <span style="color: red; font-weight: bolder;font-size: 14px;">Sube el template para corregir y validar la 1ra clasificación.</span>
                        </h4>
                    </div>
                </div>
                <!--
                <h4>
                            <b>Nota:</b> 
                            <span style="color: red; font-weight: bolder;font-size: 14px;">
                                Sube el template para corregir y validar la 1ra clasificación
                            </span>
                        </h4>!-->
                
                <div class="col-md-10 error-import"><h4 id="total"></h4></div>
                <div class="clearfix"></div>
            </form>
        </div>
      </div>
      <div class="modal-footer _validar-modal-buttons">
        <button type="button" class="btn btn-default _validar-modal-cancel" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary _validar-modal-ok" disabled="disabled">Validar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- SCRIPT FOR SHEETS JS !-->
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/shim.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/jszip.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/xlsx.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/sheetjs/dist/ods.js"></script>
<script type="text/javascript">
    /* COMIENZA SCRIPT PARA PROCESAR EL EXCEL */
    
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
    
    /* TERMINA SCRIPT PARA PROCESAR EL EXCEL */
    
    
    function process_wb(wb) {
	var output = "";
	output = JSON.stringify(to_json(wb), 2, 2);
        var total = to_json(wb);
        console.log(Object.keys(total));
        if(total[Object.keys(total)]){
            $("#total").html("Se procesar&aacute;n " + total[Object.keys(total)].length + " Registros...");
            $("#sJson").val(JSON.stringify(to_json(wb)));
            $("._validar-modal-ok").prop("disabled",false);
        }else{
            toastr.error("El template est&aacute; vacio, o está da&ntilde;ado.", "Notificaci&oacute;n");
        }
    }
    
    // DELETE DATA //
    var validarUrl = null;
    function validarClasificacion(obj,url){
        validarUrl = url;
        var tr = $(obj).parent().parent().parent().parent().parent().clone();
        $(tr[0]).find('td')[0].remove();
        var thead = $("#datatable_ajax").children().children().clone();
        $(thead[0]).children()[0].remove();
        $("._validar-modal-record").html('<table class="table"><thead><tr role="row" class="heading">'+thead[0].innerHTML+'</tr></thead><tr>'+tr[0].innerHTML+'</tr></table>');
        $("._validar-modal").modal('toggle');
        return false;
    }

$(document).ready(function(){
    
   TableAjax.init('?axn=fetch_all');
   
   // MOSTRAR MODAL CON LA INFORMACIÓN PARA VALIDAR LA 1ER CLASIFICACIÓN //
   $("._validar-modal-ok").click(function(){
        $("._validar-modal").modal('hide');
        $('.page-title-loading').css('display','inline');
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData($("#formValidarClasificacion")[0]);
        }
        $.ajax({
            type: "POST",
            url: validarUrl,
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                validarUrl = null;
                $("._validar-modal-ok").prop("disabled",true);
                $("#xlf").val("");
                $("#total").html("");
                $("#sJson").val("");
                if(data['response']){
                    toastr.success(data['message'], "Notificaci&oacute;n");
                    setInterval(function(){ 
                         location.reload(); 
                    }, 3000);
                }else{
                    toastr.error(data['message'], "Notificaci&oacute;n");
                    setInterval(function(){ 
                    }, 9000);
                }
                $('.page-title-loading').css('display','none');
                validarUrl = null;
            }
        });
   });
   
});
</script>
<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
    $arrayTiposEmpresas = array();
	if(isset($data['tiposEmpresas']))
    {
		if($data['tiposEmpresas']->num_rows > 0){
			 while($row = $data['tiposEmpresas']->fetch_assoc()){
				$arrayTiposEmpresas[] = $row{'skTipoEmpresa'};
			 }
		 }
    }
    $arrayStatus = array();
	if(isset($data['status']))
    {
		if($data['status']->num_rows > 0){
			 while($row = $data['status']->fetch_assoc()){
				$arrayStatus[] = $row{'skStatus'};
			 }
		 }
    }
?>
<!--<form id="_save" method="post" class="form-horizontal" role="form">
<div class="col-lg-12 col-md-12 col-xs-12">
<!-- BEGIN TAB -->
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_datosGenerales" data-toggle="tab">Datos Generales</a>
        </li>
        <li class="inactive">
            <a href="#tab_servicios" data-toggle="tab">Servicios</a>
        </li>
    </ul>
<form id="_save" method="post" class="form-horizontal" role="form">
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tab_datosGenerales">
            
            <!-- FORMULARIO DE DATOS GENERALES DE EMPRESAS !-->
             
     <div class="form-body"> 
    <input type="hidden" name="skEmpresa"  id="skEmpresa" value="<?php echo (isset($result['skEmpresa'])) ? $result['skEmpresa'] : '' ; ?>">
        <div class="form-group">
            <label class="control-label col-md-2">RFC
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sRFC" id="sRFC" class="form-control" placeholder="RFC" value="<?php echo (isset($result['sRFC'])) ? utf8_encode($result['sRFC']) : '' ; ?>" >
                </div>
            </div>
        </div>     
        
        <div class="form-group">
            <label class="control-label col-md-2">Nombre <span aria-required="true" class="required"> * </span>
            </label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" name="sNombre" id="sNombre" class="form-control" placeholder="Nombre" value="<?php echo (isset($result['sNombre'])) ? utf8_encode($result['sNombre']) : '' ; ?>" >
                </div>
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-2">Nombre Corto 
            </label>
            <div class="col-md-4">
                <div class="input-icon">
                    <i class="fa"></i>
                    <input type="text" name="sNombreCorto" id="sNombreCorto" class="form-control" placeholder="Nombre Corto" value="<?php echo (isset($result['sNombreCorto'])) ? utf8_encode($result['sNombreCorto']) : '' ; ?>" >
                </div>
            </div>
        </div>
         <div class="clearfix"><hr/></div>
            
            <div class="form-group">
                <label class="control-label col-md-2">Tipo de Empresa <span aria-required="true" class="required"> * </span>  </label>
                                 <?php 
                                if($data['tiposEmpresas'])
                                {
                                ?> 
                                <div class="col-md-4">
                                <select class="form-control"id="skTipoEmpresa" name="skTipoEmpresa">
                                		<option value="">- Seleccione -</option>
                                	<?php  foreach ($data['tiposEmpresas'] as $profile)  {  ?>
                                		<option value="<?php echo $profile['skTipoEmpresa']; ?>" 
                                		<?php 
                                		if(isset($result['skTipoEmpresa'])){
	                                	echo ($result['skTipoEmpresa']==$profile['skTipoEmpresa'] ? 'selected="selected"' : '');
                                		}
                                		
                                		?>> 
                                		<?php echo $profile['sNombre']; ?></option>
                                	<?php }   ?>
                                </select>
                               </div>
                                    <?php
                                    
                                }  ?>
                        
                 
            </div>    
         
        <!-- CORRESPONSALES !-->
        <div class="form-group skCorresponsalia" <?php if(isset($result['skTipoEmpresa']) && $result['skTipoEmpresa'] == 'CLIE'){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; }//ENDIF ?>>
            <label class="control-label col-md-2">Corresponsalia <span aria-required="true" class="required"> * </span> </label>
            <?php
               if($data['corresponsalias']){
            ?> 
            <div class="col-md-4">
                <select class="form-control skCorresponsalia" id="skCorresponsalia" name="skCorresponsalia">
                    <option value="">- Seleccione Corresponsalia -</option>
                    <?php  foreach ($data['corresponsalias'] as $corresponsalia)  {  ?>
                        <option value="<?php echo $corresponsalia['skEmpresa']; ?>" 
                    <?php 
                        if(isset($result['skCorresponsalia'])){
                            echo ($result['skCorresponsalia'] == $corresponsalia['skEmpresa'] ? 'selected="selected"' : '');
                        }
                    ?>
                        ><?php echo $corresponsalia['sNombre']; ?></option>
                    <?php }//ENDFOREACH ?>
               </select>
            </div>
            <?php
                }//ENDIF  
            ?> 
        </div>
        <!-- PROMOTORES !-->
        <div class="form-group skPromotor" <?php if(isset($result['skTipoEmpresa']) && $result['skTipoEmpresa'] == 'CLIE'){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; }//ENDIF ?>>
            <label class="control-label col-md-2">Promotor 1 </label>
            <?php
               if($data['promotores']){
            ?> 
            <div class="col-md-4">
                <select class="form-control"id="skPromotor1" name="skPromotor1">
                    <option value="">- Seleccione Promotor -</option>
                    <?php  foreach ($data['promotores'] as $promotor)  {  ?>
                        <option value="<?php echo $promotor['skPromotores']; ?>" 
                    <?php 
                        if(isset($result['skPromotor1'])){
                            echo ($result['skPromotor1'] == $promotor['skPromotores'] ? 'selected="selected"' : '');
                        }
                    ?>
                        ><?php echo $promotor['sNombre']; ?></option>
                    <?php }//ENDFOREACH ?>
               </select>
            </div>
            <?php
                }//ENDIF  
            ?> 
        </div>
        <div class="form-group skPromotor" <?php if(isset($result['skTipoEmpresa']) && $result['skTipoEmpresa'] === 'CLIE'){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; }//ENDIF ?>>
            <label class="control-label col-md-2">Promotor 2 </label>
            <?php
               if($data['promotores']){
            ?> 
            <div class="col-md-4">
                <select class="form-control"id="skPromotor2" name="skPromotor2">
                    <option value="">- Seleccione Promotor -</option>
                    <?php  foreach ($data['promotores'] as $promotor)  {  ?>
                        <option value="<?php echo $promotor['skPromotores']; ?>" 
                    <?php 
                        if(isset($result['skPromotor2'])){
                            echo ($result['skPromotor2'] == $promotor['skPromotores'] ? 'selected="selected"' : '');
                        }
                    ?>
                        ><?php echo $promotor['sNombre']; ?></option>
                    <?php }//ENDFOREACH ?>
               </select>
            </div>
            <?php
                }//ENDIF  
            ?> 
        </div>
         
         
         <!--
             <div class="form-group">
                <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span></label>
                                 <?php 
                                if($data['status'])
                                {
                                ?> 
                                <div class="col-md-4">
                                <select class="form-control"id="skStatus" name="skStatus">
                                		<option value=""> Seleccionar...</option>
                                	<?php  foreach ($data['status'] as $status)  {  ?>
                                		<option value="<?php echo $status['skStatus']; ?>" 
                                		<?php 
                                		if(isset($result['skStatus'])){
	                                	echo ($result['skStatus']==$status['skStatus'] ? 'selected="selected"' : '');
                                		}
                                		?>>
                                 		<?php echo $status['sName']; ?></option>
                                	<?php }   ?>
                                </select>
                               </div>
                                    <?php
                                    
                                }  ?>
                        
                 
            </div>
         !-->
            <!-- STATUS -->
            <div class="form-group">
                <label class="control-label col-md-2">Estatus <span aria-required="true" class="required"> * </span>
                </label>
                <div class="col-md-4">
                    <div class="radio-list">
                        <label>
                            <div class="">
                                <span>
                                    <input type="radio" name="skStatus" value="AC" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?> checked="checked"> Activo
                                </span>
                            </div>
                        </label>
                        <label>
                            <div class="">
                                <span>
                                    <input type="radio" name="skStatus" value="IN" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
                                </span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
        
        </div>
            
    <!--</div>!-->
            <!-- TEMRINA FORMULARIO DE DATOS GENERALES DE EMPRESAS !-->
            
            
        </div>
        <div class="tab-pane fade" id="tab_servicios">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-2">Agregar Servicio</label>
                    <div class="col-md-10">
                    <table class="table table-hover table-bordered" id="_add_multiple_rows">
                    <thead>
                        <tr>
                            <th class="middle"><center><i class="fa fa-cog"></i></center></th>
                            <th nowrap>Tipo tramite</th>
                            <th nowrap>Servicio</th>
                            <th nowrap>Divisa</th>
                            <th nowrap>Precio unitario</th>
                            <th class="middle"><a href="javascript:;" class="btn btn-default _add_multiple_rows_add_row"><i class="fa fa-plus-square"></i></a></th>
                        </tr>
                    </thead>
                    <tbody id="_add_multiple_tr">
                        <?php
                            //if($data['tiposTramites']){
                                //while($row = $data['tiposTramites']->fetch_assoc()){
                        ?>
                        <tr>
                            <td class="middle"><a href="javascript:;" class="btn btn-default _add_multiple_rows_delete_row"><i class="fa fa-trash-o"></i></a></td>
                            <td class="middle">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio-list">
                                            <div class="form-group">
                                            <?php
                                                if($data['tiposTramites']){
                                                    while($rTipoTramite =  $data['tiposTramites']->fetch_assoc()){
                                                        $i++;
                                            ?>
                                            <label class="radio">
                                                <input type="radio" name="skTipoTramite[0][]" class="skTipoTramite" value="<?php echo utf8_encode($rTipoTramite['skTipoTramite']); ?>"><?php echo utf8_encode($rTipoTramite['sNombre']); ?>
                                            </label>
                                            <?php 
                                                    }//ENDWHILE 
                                                }//ENDIF
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="middle">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select class="form-control skConcepto" name="skConcepto[]">
                                            <option value="">-Servicios-</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="middle">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select class="form-control skDivisa" name="skDivisa[]">
                                            <option value="">-Divisas-</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" class="middle">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-icon">
                                            <i class="fa fa-money"></i>
                                            <input type="text" name="fPrecioUnitario[]" placeholder="Precio Unitario" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                                //}//ENDWHILE
                            //}//ENDIF
                        ?>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div> 
        </div>
    </div></form>
<!-- END TAB -->
</div>
    <!--</form>!-->                              

<div class="clearfix"></div>

<script type="text/javascript">
    var serviciosExpo = null;
    var serviciosImpo = null;
    var serviciosTipoEmpresa = null;
    var cat_divisas = null;
    var cat_tipos_tramites = null;
    function obtenerTiposTramites(){
        if(cat_tipos_tramites != null){
            return cat_tipos_tramites;
        }
        $.ajax({
            method: "POST",
            url: "",
            cache: false,
            async: false,
            data: { 
                axn : "obtenerTiposTramites"
            }
        })
        .done(function( data ) {
            if(data['response']){
                toastr.success(data['message'], "Notificaci&oacute;n");
                cat_tipos_tramites = data.datos;
            }else{
                toastr.error(data['message'], "Notificaci&oacute;n");
            }
        });
        return cat_tipos_tramites;
    }
    function obtenerDivisas(){
        if(cat_divisas != null){
            return cat_divisas;
        }
        $.ajax({
            method: "POST",
            url: "",
            cache: false,
            async: false,
            data: { 
                axn : "obtenerDivisas"
            }
        })
        .done(function( data ) {
            if(data['response']){
                toastr.success(data['message'], "Notificaci&oacute;n");
                cat_divisas = data.datos;
            }else{
                toastr.error(data['message'], "Notificaci&oacute;n");
            }
        });
        return cat_divisas;
    }
    function obtenerServicios(skTipoTramite , skTipoEmpresa){
        $('.page-title-loading').css('display','inline');
        obtenerTiposTramites();
        obtenerDivisas();
        if(skTipoTramite == 'EXPO' && serviciosTipoEmpresa == skTipoEmpresa && serviciosExpo != null){
            $('.page-title-loading').css('display','none');
            return serviciosExpo;
        }else if(skTipoTramite == 'IMPO' && serviciosTipoEmpresa == skTipoEmpresa && serviciosImpo != null){
            $('.page-title-loading').css('display','none');
            return serviciosImpo;
        }
        $.ajax({
            method: "POST",
            url: "",
            cache: false,
            async: false,
            data: { 
                axn : "obtenerServicios",
                skTipoTramite : skTipoTramite,
                skTipoEmpresa : skTipoEmpresa
            }
        })
        .done(function( data ) {
            if(data['response']){
                toastr.success(data['message'], "Notificaci&oacute;n");
                if(skTipoTramite == 'EXPO'){
                    serviciosExpo = data.datos;
                }else if(skTipoTramite == 'IMPO'){
                    serviciosImpo = data.datos;
                }
            }else{
                toastr.error(data['message'], "Notificaci&oacute;n");
            }
        });
        $('.page-title-loading').css('display','none');
        serviciosTipoEmpresa = skTipoEmpresa;
        if(skTipoTramite == 'EXPO'){
            return serviciosExpo;
        }else if(skTipoTramite == 'IMPO'){
            return serviciosImpo;
        }
    }
    $(document).ready(function(){
        // SELECCIÓN DE TIPO DE TRAMITE //
        $('body').delegate('.skTipoTramite', 'change', function(){
            servicios = obtenerServicios($(this).val() , $("#skTipoEmpresa").val());
            var tr = $(this).closest('tr');
            // Servicios (Conceptos) //
            var conceptos = '<option value="">-Servicios-</option>';
            $.each(servicios,function(k,v){
                conceptos += '<option value="'+v.skConcepto+'">'+v.concepto+'</option>';
            });
            $(tr).find('select[name^="skConcepto"]').html(conceptos);
            // Divisas //
            var divisas = '<option value="">-Divisas-</option>';
            $.each(cat_divisas,function(k,v){
                divisas += '<option value="'+v.skDivisa+'">'+v.sName+'</option>';
            });
            $(tr).find('select[name^="skDivisa"]').html(divisas);
            // Precio Unitario del Servicio //
            $(tr).find('input[name^="fPrecioUnitario"]').val("");
        });
        // SELECCIÓN DE CONCEPTO //
        $('body').delegate('.skConcepto', 'change', function(){
            var skConcepto = $(this).val();
            var tr = $(this).closest('tr');
            if(typeof servicios[skConcepto] != "undefined") {
                $(tr).find('select[name^="skDivisa"]').val(servicios[skConcepto].skDivisa);
                $(tr).find('input[name^="fPrecioUnitario"]').val(servicios[skConcepto].fPrecioUnitario);
            }else{
                $(tr).find('select[name^="skDivisa"]').val("");
                $(tr).find('input[name^="fPrecioUnitario"]').val("");
            }
        });
        /*
         * Cuando sea una empresa de tipo cliente(clie) está puede tener 1 corresponsalia y 2 promotores.
         */
        $("#skTipoEmpresa").change(function(){
           if($(this).val() == "CLIE"){
                $(".skCorresponsalia").css("display","block");
                $(".skPromotor").css("display","block");
           }else{
                $("#skCorresponsalia").val("");
                $("#skPromotor1").val("");
                $("#skPromotor2").val("");
                $(".skCorresponsalia").css("display","none");
                $(".skPromotor").css("display","none"); 
           } 
        });
        /*
         * Se valida que los promotores no se supliquen.
         */
        $("#skPromotor1").change(function(){ 
            if($(this).val() != ""){
                if($(this).val() == $("#skPromotor2").val()){
                    toastr.error("No puede tener el mismo promotor 2 veces en el mismo registro.", "Notificaci&oacute;n");
                    $(this).val("");
                }
            }
        });
        $("#skPromotor2").change(function(){ 
            if($(this).val() != ""){
                if($(this).val() == $("#skPromotor1").val()){
                    toastr.error("No puede tener el mismo promotor 2 veces en el mismo registro.", "Notificaci&oacute;n");
                    $(this).val("");
                }
            }
        });
        
        /*
         * Aquí se valida el RFC
         */
        /*if($("sRFC").length){	
		     if($("sRFC").attr("value").match(/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/)){
			    alert("good");
		    }else{
			    alert("bad");
			    
		    }
        }*/
       
        /*
         * Aquí se valida el formulario.
         */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules:{
            	sRFC:{
                    //required: true,
                    /*remote: {
                      url: "",
                      type: "post",
                      data: {
                        sRFC: function (){return $( "#sRFC" ).val();},
                        axn: "validarRFC",
                        skEmpresa:  function (){return $( "#skEmpresa" ).val();}
                      }
                    }*/
                    
                },
               
                skTipoEmpresa:{
                    required: true
                },
                sNombre:{
                    required: true
                },
                skCorresponsalia:{
                    required: true
                },
                "skTipoTramite[]":{
                    required: true
                },
                "skConcepto[]":{
                    required: true
                },
                "skDivisa[]":{
                    required: true
                },
                "fPrecioUnitario[]":{
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
            	sRFC:{
                    //required: "Campo obligatorio.",
                    //remote: "El RFC Ingresado ya Existe."
                },skTipoEmpresa:{
                    required: "Campo obligatorio."
                },sNombre:{
                    required: "Campo obligatorio."
                },
                skCorresponsalia:{
                    required: "Campo obligatorio."
                },
                "skTipoTramite[]":{
                    required: "Campo obligatorio."
                },
                "skConcepto[]":{
                    required: "Campo obligatorio."
                },
                "skDivisa[]":{
                    required: "Campo obligatorio."
                },
                "fPrecioUnitario[]":{
                    required: "Campo obligatorio."
                }
                
            }
        });
        //
        function _add_multiple_rows_add_row(html){
            $("#_add_multiple_tr").append(html);
        }
        function _add_multiple_rows_delete_row(obj){
            $(obj).parent().parent().remove();
        }
        $('body').delegate('._add_multiple_rows_add_row', 'click', function(){
            // Tipos Tramites (EXPO , IMPO) //
            obtenerTiposTramites();
            var tipoTramites = '<div class="form-group">';
            var time = new Date().getTime();
            $.each(cat_tipos_tramites,function(k,v){
                tipoTramites += '<label class="radio"><input type="radio" name="skTipoTramite['+time+'][]" class="skTipoTramite" value="'+v.skTipoTramite+'">'+v.sNombre+'</label>';
            });
            tipoTramites += '</div>';
            var html = '<tr> <td class="middle"><a href="javascript:;" class="btn btn-default _add_multiple_rows_delete_row"><i class="fa fa-trash-o"></i></a></td><td class="middle"> <div class="form-group"> <div class="col-md-12 "><div class="radio-list">'+tipoTramites+'</div></div></div></td><td class="middle"> <div class="form-group"> <div class="col-md-12"> <select class="form-control skConcepto" name="skConcepto[]"> <option value="">-Servicios-</option> </select> </div></div></td><td class="middle"> <div class="form-group"> <div class="col-md-12"> <select class="form-control skDivisa" name="skDivisa[]"> <option value="">-Divisas-</option> </select> </div></div></td><td colspan="2" class="middle"> <div class="form-group"> <div class="col-md-12"> <div class="input-icon"> <i class="fa fa-money"></i> <input type="text" name="fPrecioUnitario[]" placeholder="Precio Unitario" class="form-control"> </div></div></div></td></tr>';
            _add_multiple_rows_add_row(html);
        });
        //
        $('body').delegate('._add_multiple_rows_delete_row','click',function(){  
            _add_multiple_rows_delete_row(this);
        });
    }); 
</script>
<?php
    $result = array();
    if($data['datos']){
        $result = $data['datos']->fetch_assoc();
    }
?>

                
<form id="_save" method="post" class="form-horizontal form-bordered form-row-stripped" role="form">

	<input type="hidden" name="skProfiles" value="<?php echo (isset($result['skProfiles'])) ? $result['skProfiles'] : '' ; ?>">
    <div class="form-body">
    
 
            
    
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-4">
                <input type="text" name="sName" class="form-control" placeholder="Nombre Perfil" value="<?php echo (isset($result['sName'])) ? utf8_encode($result['sName']) : '' ; ?>">                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Estatus</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios22" value="AC"  <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'AC') ? 'checked' : '' ; ?> checked="checked"> Activo
                    </label>
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios23" value="IN" <?php echo (isset($result['skStatus']) && $result['skStatus'] == 'IN') ? 'checked' : '' ; ?>> Inactivo
                    </label>
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<label class="col-md-2 control-label">Configuraci&oacute;n</label>
         		 <div  id="divRegistros" class="col-md-10" style=" height: 550px; overflow:auto; padding-left:10px; padding-top:10px;border: 1px solid #ddd;">
          	 
          	 
          	 <?php 		

		$select = "CALL stpMapSite('sys-func',0,'".((isset($result['skProfiles'])) ? $result['skProfiles'] : '' )."',NULL);";
			//echo $select;
 			$result = $this->db->query($select);
                    
 			$html1="";
              $i=0; 
			  $contadorNivel0=0;
   			while($rSeccion = $result->fetch_assoc()){
   			
			$ind = "";
			if($rSeccion{'eNivel'}){
		 
				for($j=0; $j<(int)$rSeccion{'eNivel'};$j++){
					$ind.="<div class='col-sm-1'></div>";
					
					//$ind.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					//$ind.="style='padding-left:45px;'";
				
 				}
				if($rSeccion{'eNivel'}==1){
					$contadorNivel1++;
					$contadorNivel2=1;
					$contadorSeccion=sprintf("%02d",$contadorNivel0).".".sprintf("%02d",$contadorNivel1);
 				}
				if($rSeccion{'eNivel'}==2){
					$contadorNivel2++;
					$contadorNivel3=0;
					$contadorSeccion=sprintf("%02d",$contadorNivel0).".".sprintf("%02d",$contadorNivel1).".".sprintf("%02d",$contadorNivel2);
 				}
				if($rSeccion{'eNivel'}==3){
					$contadorNivel3++;
					$contadorNivel4=0;
					$contadorSeccion=sprintf("%02d",$contadorNivel0).".".sprintf("%02d",$contadorNivel1).".".sprintf("%02d",$contadorNivel2).".".sprintf("%02d",$contadorNivel3);
 				}
				if($rSeccion{'eNivel'}==3){
					$contadorNivel4++;
					
					$contadorSeccion=sprintf("%02d",$contadorNivel0).".".sprintf("%02d",$contadorNivel1).".".sprintf("%02d",$contadorNivel2).".".sprintf("%02d",$contadorNivel3).".".sprintf("%02d",$contadorNivel4);
 				}
 			}else{
				$contadorNivel0++;
				$contadorNivel1=1;
				$contadorSeccion=sprintf("%02d",$contadorNivel0);
 			}
			$tTitulo = (trim(utf8_encode($rSeccion{'sTitle'}))=="-" ? "<div class='page-subheader' style='margin: 0px 0 15px;padding:0;'></div>" : trim((utf8_encode($rSeccion{'sTitle'}))));
			//echo $tTitulo;
			$tr="<div class='form-group'>".
				"<div class='checkbox-list col-sm-7 col-xs-7'>".$ind."".($rSeccion{'eNivel'}==0 ? "" : "").
				
				(trim(utf8_encode($rSeccion{'sTitle'}))!="-" ? ($rSeccion{'eNivel'}==1 ? "<p>" : "<p>").($rSeccion{'eNivel'}==0 ? " " : '').
				//(trim($rSeccion{'sTitle'})!="-" ? "<label>".
 				"<input type=\"hidden\" name=\"eSeccion".$i."\" id=\"eSeccion".$i."\" value=\"".$rSeccion{'sCodSeccion'}."\" >
 				<input type=\"checkbox\"  name=\"skModule".$i."\" id=\"skModule".$i."\"   ".
 				
				(!$rSeccion{'peR'}&&!$rSeccion{'peW'}&&!$rSeccion{'peD'}&&!$rSeccion{'peA'}  ? "" : "checked=\"checked\"")." value=\"".$contadorSeccion."\" /><label class='text-muted' for=\"skModule".$i."\"  id=\"skModule".$i."\" >" : "").
				
				($rSeccion{'eNivel'}==0 ? "<strong>" : "").
				"&nbsp;&nbsp;".($tTitulo)."".
				($rSeccion{'eNivel'}==0 ? "</strong>" : "").
				(trim($rSeccion{'sTitle'})!="-" ? "</label>" : "").
 				(trim($rSeccion{'sTitle'})!="-" ? ($rSeccion{'eNivel'}==1 ? "</label></p>" : "</label></p>") : "").
				"</div>".
 				"<div class='col-sm-1 col-xs-1 '><p>"."".(trim($rSeccion{'sTitle'})!="-" ? "<input type=\"checkbox\" name=\"R_".$i."\" id=\"R_".$i."\" ".($rSeccion{'seR'} ? "" : "disabled=\"disabled\"")." ". 
 				(!$rSeccion{'peR'} ? "" : "checked=\"checked\"")." value=\"R\" /><label for=\"R_".$i."\">&nbsp; R</label>" : "")."</p></div>".
 				
 				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'sTitle'})!="-" ? "<input type=\"checkbox\" name=\"W_".$i."\" id=\"W_".$i."\" ".($rSeccion{'seW'} ? " " : "   disabled=\"disabled\"")." ".
				(!$rSeccion{'peW'} ? "" : "checked=\"checked\"")." value=\"W\" /><label for=\"W_".$i."\"> &nbsp;W</label>" : "")."</p></div>".
				
				"<div class='col-sm-1 col-xs-1 '>
				<p>".(trim($rSeccion{'sTitle'})!="-" ? "
				<input type=\"checkbox\"  name=\"D_".$i."\" id=\"D_".$i."\" ".($rSeccion{'seD'} ? "" : "  disabled=\"disabled\"")." ".
					(!$rSeccion{'peD'} ? "" : "checked=\"checked\"")." value=\"D\" />
				<label for=\"D_".$i."\"> &nbsp;D</label>" : "")."
				</p>
				</div>".
				
				/* 
				onclick=\"marcarHijos(this);\"
				onChange=\"marcarPadre(this);\"  */
				
				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'sTitle'})!="-" ? "
				<input type=\"checkbox\"  name=\"A_".$i."\" id=\"A_".$i."\" ".($rSeccion{'seA'} ? "" : "  disabled=\"disabled\"")." ".
				(!$rSeccion{'peA'} ? "" : "checked=\"checked\"")." value=\"A\"  /><label for=\"A_".$i."\"> &nbsp;A</label>" : "")."</p></div>".

 								  
				"</div>";
			$datos[$i]['html'] = $tr;
			$datos[$i]['titulo'] = trim($rSeccion{'sTitle'});
			$i++;			
  			 }
  			 
  			
			 		foreach($datos as $tFila){
					$html1.=$tFila['html'];
					}
					
					echo $html1;

?>
          	 
          	 
          	 
        		</div>
        
        </div>
    </div>
</form>

 <script type="text/javascript">
  	$(document).ready(function(){
        /* VALIDATIONS */
        isValid = $("#_save").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules:{
                sName:{
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
                sName:{
                    required: "Campo obligatorio."
                } 
            }
        });
    }); 

	
</script>

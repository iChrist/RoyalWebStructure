<?php 
/*echo $data['msg']; 
if($data['datos']){
    $result = $data['datos']->fetch_assoc();
}*/
?>
 
<form id="_save" method="post" class="form-horizontal form-bordered form-row-stripped" role="form">


    <div class="form-body">
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-4">
                <input type="text" name="sName" class="form-control" placeholder="Nombre Perfil" value="">                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-2 control-label">Estatus</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios22" value="AC" checked> Activo
                    </label>
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios23" value="IN" > Inactivo
                    </label>
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<label class="col-md-2 control-label">Configuraci&oacute;n</label>
         		 <div  id="divRegistros" class="col-md-10" style=" height: 550px; overflow:auto; padding-left:10px; padding-top:10px;border: 1px solid #ddd;">
          	 
          	 
          	 <?php 		

		$select = "CALL stpMapSite('sys-func',0,'',NULL);";
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
			$tTitulo = (trim($rSeccion{'sTitle'})=="-" ? "<div class='page-subheader' style='margin: 0px 0 15px;padding:0;'></div>" : trim(($rSeccion{'sTitle'})));
			//echo $tTitulo;
			$tr="<div class='form-group'>".
				"<div class='checkbox-list col-sm-7 col-xs-7'>".$ind."".($rSeccion{'eNivel'}==0 ? "" : "").
				
				(trim($rSeccion{'sTitle'})!="-" ? ($rSeccion{'eNivel'}==1 ? "<p>" : "<p>").($rSeccion{'eNivel'}==0 ? " " : '').
				//(trim($rSeccion{'sTitle'})!="-" ? "<label>".
 				"<input type=\"hidden\" name=\"eSeccion".$i."\" id=\"eSeccion".$i."\" value=\"".$rSeccion{'sCodSeccion'}."\" >
 				<input type=\"checkbox\"  name=\"skModule".$i."\" id=\"skModule".$i."\" onclick=\"marcarHijos(this);\"".
 				
				(!$rSeccion{'peR'}&&!$rSeccion{'peW'}&&!$rSeccion{'peD'}&&!$rSeccion{'peA'}  ? "" : "checked=\"checked\"")." value=\"".$contadorSeccion."\" /><label class='text-muted' for=\"skModule".$i."\"  id=\"skModule".$i."\" >" : "").
				
				($rSeccion{'eNivel'}==0 ? "<strong>" : "").
				"&nbsp;&nbsp;".($tTitulo)."".
				($rSeccion{'eNivel'}==0 ? "</strong>" : "").
				(trim($rSeccion{'sTitle'})!="-" ? "</label>" : "").
 				(trim($rSeccion{'sTitle'})!="-" ? ($rSeccion{'eNivel'}==1 ? "</label></p>" : "</label></p>") : "").
				"</div>".
 				"<div class='col-sm-1 col-xs-1 '><p>"."".(trim($rSeccion{'sTitle'})!="-" ? "<input type=\"checkbox\" name=\"R_".$i."\" id=\"R_".$i."\" ".($rSeccion{'seR'} ? "" : "disabled=\"disabled\"")." ". 
 				(!$rSeccion{'peR'} ? "" : "checked=\"checked\"")." value=\"R\" onclick=\"marcarPadre(this);\" /><label for=\"R_".$i."\">&nbsp; R</label>" : "")."</p></div>".
 				
 				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'sTitle'})!="-" ? "<input type=\"checkbox\" name=\"W_".$i."\" id=\"W_".$i."\" ".($rSeccion{'seW'} ? " " : "   disabled=\"disabled\"")." ".
				(!$rSeccion{'peW'} ? "" : "checked=\"checked\"")." value=\"W\" onclick=\"marcarPadre(this);\" /><label for=\"W_".$i."\"> &nbsp;W</label>" : "")."</p></div>".
				
				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'sTitle'})!="-" ? "
				<input type=\"checkbox\"  name=\"D_".$i."\" id=\"D_".$i."\" ".($rSeccion{'seD'} ? "" : "  disabled=\"disabled\"")." ".
				(!$rSeccion{'peD'} ? "" : "checked=\"checked\"")." value=\"D\" onclick=\"marcarPadre(this);\" /><label for=\"D_".$i."\"> &nbsp;D</label>" : "")."</p></div>".
				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'sTitle'})!="-" ? "
				<input type=\"checkbox\"  name=\"A_".$i."\" id=\"A_".$i."\" ".($rSeccion{'seA'} ? "" : "  disabled=\"disabled\"")." ".
				(!$rSeccion{'peA'} ? "" : "checked=\"checked\"")." value=\"A\" onclick=\"marcarPadre(this);\" /><label for=\"A_".$i."\"> &nbsp;A</label>" : "")."</p></div>".

 								  
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
  	 function marcarPadre(hijo)
	{
    		var bSeleccionado=false;
			id = hijo.id.replace(hijo.value+"_","");
  			padre = ("skModule"+id);
  			
  		if(($("input[id=\"R_"+id+"\"]").is(':checked')) || ($("input[id=\"W_"+id+"\"]").is(':checked')) || ($("input[id=\"D_"+id+"\"]").is(':checked')) || ($("input[id=\"A_"+id+"\"]").is(':checked')) ){
  			
  			
  				 bSeleccionado=true;
   			}
      			 document.getElementById(padre).checked = bSeleccionado; 
     			 			
 	}
 	
 	
	
	 /*	function marcarHijos(padre)
		{ 
  	var bSeleccionado=false;
 	 	marcarPermisos(padre);
 		id = padre.id.replace("skModule","");

 	valor = document.getElementsByName("skModule"+id)[0].value;
  			 var arr = document.forms['_save'].elements;
							for (var i = 0; i < arr.length; i++) {
								var el = arr[i];
								if(el.type=='checkbox'){
 													if(el.value.match(valor+".")){
 														if(!el.disabled){
															//registry.byId(el.id).set('checked', padre.checked);
																		el.checked = padre.checked;		
 																		marcarPermisos(el);
														}
													}
								}
  							}
	marcarHermanos(valor);
 	}
      function marcarPermisos(padre)
      {
      
 		id = padre.id.replace("skModule","");
			if(id!=''){
				if(($("input[id=\"R_"+id+"\"]").is(':disabled')==false)  ){
 						 document.getElementById("R_"+id).checked = padre.checked;
				}
				if(($("input[id=\"W_"+id+"\"]").is(':disabled')==false)  ){
						 document.getElementById("W_"+id).checked = padre.checked;
				}
				if(($("input[id=\"D_"+id+"\"]").is(':disabled')==false)  ){
						 document.getElementById("D_"+id).checked = padre.checked;
				}
				if(($("input[id=\"A_"+id+"\"]").is(':disabled')==false)  ){
						 document.getElementById("A_"+id).checked = padre.checked;
				}
			}
    	//		 document.getElementById(padre).checked = true;
	}
	 function marcarHermanos(valor)
	 {
	var bSeleccionado=false;
	var nid="";
	s = valor.split(".");
 	if(valor)
			{
			for (var i=0;i<(s.length-1);i++)
				{
				nid+= (nid ? "." : "")+s[i];
				
				}
				nodop='';
			 var arr = document.forms['_save'].elements;
								for (var i = 0; i < arr.length; i++) {
												var el = arr[i];
 									if(el.type=='checkbox'){
										if(el.value==(nid)){
											nodop=el;
 										}
									}
								}
			valor = nodop.value;
			var arr = document.forms['_save'].elements;
								for (var i = 0; i < arr.length; i++) {
									var el = arr[i];
										if(el.type=='checkbox'&&valor){
													if(el.value.match(valor)){
														if(el.checked){
															bSeleccionado=true;
														}
													}
										}
								}
			if(bSeleccionado)
				{
					nodop.checked = bSeleccionado;
					marcarPermisos(nodop);
				}
 			marcarHermanos(nid);
			}
	}
 */
		   $(document).ready(function(){
		   
 			   /*$('a#guardarPerfil').click( function() {
 			$("a#guardarPerfil").hide();
			$("a#guardarPerfilConfirmar").show();
  		 });
												$('a#guardarPerfilConfirmar').click( function() {
													$("a#guardarPerfilConfirmar").hide();
														$("a#cargadorPerfil").show();
													bandera = false;
													if(!$("#tCodPerfil").val()){
																  bandera = true;
															 }
 										if (bandera==true){
														$("#msjError").hide();
														$("#msjError").show();
														$("#msjError").delay(4000).hide("blind", 600);
														setTimeout(function(){
														$("a#cargadorPerfil").hide();
															$("a#guardarPerfil").show();
																 }, 4000); 
										}else{  
											$("a#cargadorPerfil").show();
												 $.ajax({
														url: '/des/cnt/principal.controller.php',
														type: 'post',
														cache: false,
														data: $('form#Datos').serialize(),
														success: function(data) {
															$("a#cargadorPerfil").show();
															if(data == 1){
																	$("#msjAlert").hide();
																	$("#msjExito").show();
																	$("#msjExito").delay(4000).hide("blind", 600);
																	setTimeout(function(){
																			window.location.href = "/web/inic-perf/perfiles/";				
																	 }, 2000); 
																	 } else {
																		  $("a#cargadorPerfil").hide();
																		 $("a#guardarPerfil").show();
																		$("#msjAlert").hide();
																		$("#msjAlert").show();
																		$("#msjAlert").delay(4000).hide("blind", 600);
																  }
																 }
													});
										}
										}); */	
			});
</script>
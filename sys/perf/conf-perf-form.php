<?php 
echo $data['msg']; 
if($data['datos']){
    $result = $data['datos']->fetch_assoc();
}
?>
 
<form id="_save" method="post" class="form-horizontal form-bordered form-row-stripped" role="form">

<?php 		$select = "CALL stpMapSite('sys',0,'".$_GET['v1']."',NULL);";
 			$result = $this->db->query($select);
                    
 			$html1="";
              $i=0; 
			  $contadorNivel0=0;
   			while($rsSecciones = $result->fetch_assoc()){
			$ind = "";
			if($rSeccion{'eNivel'}){
				for($j=0; $j<(int)$rSeccion{'eNivel'};$j++){
					$ind.="style='padding-left:45px;'";
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
			$tTitulo = (trim($rSeccion{'tTitulo'})=="-" ? "<div class='page-subheader' style='margin: 0px 0 15px;padding:0;'></div>" : trim(($rSeccion{'tTitulo'})));
			$tr="<div class='radio-list form-group'>".
				"<div class='col-sm-7 col-xs-7 ' ".$ind.">".
 				"".($rSeccion{'eNivel'}==0 ? "" : "").
				(trim($rSeccion{'tTitulo'})!="-" ? ($rSeccion{'eNivel'}==1 ? "<p>" : "<p>").($rSeccion{'eNivel'}==0 ? " " : '').
				//(trim($rSeccion{'tTitulo'})!="-" ? "<label>".
 				"<input type=\"hidden\" name=\"eSeccion".$i."\" id=\"eSeccion".$i."\" value=\"".$rSeccion{'tCodSeccion'}."\" ><input type=\"checkbox\"  name=\"tCodSeccion".$i."\" id=\"tCodSeccion".$i."\" onclick=\"marcarHijos(this);\"".
				(!$rSeccion{'peR'}&&!$rSeccion{'peW'}&&!$rSeccion{'peD'} ? "" : "checked=\"checked\"")." value=\"".$contadorSeccion."\" /><label class='text-muted' for=\"tCodSeccion".$i."\"  id=\"tCodSeccion".$i."\" >" : "").
				($rSeccion{'eNivel'}==0 ? "<strong>" : "").
				"&nbsp;&nbsp;".($tTitulo)."".
				($rSeccion{'eNivel'}==0 ? "</strong>" : "").
				(trim($rSeccion{'tTitulo'})!="-" ? "</label>" : "").
 				(trim($rSeccion{'tTitulo'})!="-" ? ($rSeccion{'eNivel'}==1 ? "</label></p>" : "</label></p>") : "").
				"</div>".
 				"<div class='col-sm-1 col-xs-1 '><p>".
				"".(trim($rSeccion{'tTitulo'})!="-" ? "<input type=\"checkbox\" name=\"R_".$i."\" id=\"R_".$i."\" ".($rSeccion{'seR'} ? "" : "disabled=\"disabled\"")." ".
				(!$rSeccion{'peR'} ? "" : "checked=\"checked\"")." value=\"R\" onclick=\"marcarPadre(this);\" /><label for=\"R_".$i."\">&nbsp; R</label>" : "")."</p></div>".
 				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'tTitulo'})!="-" ? "<input type=\"checkbox\" name=\"W_".$i."\" id=\"W_".$i."\" ".($rSeccion{'seW'} ? " " : "   disabled=\"disabled\"")." ".
				(!$rSeccion{'peW'} ? "" : "checked=\"checked\"")." value=\"W\" onclick=\"marcarPadre(this);\" /><label for=\"W_".$i."\"> &nbsp;W</label>" : "")."</p></div>".
				
				"<div class='col-sm-1 col-xs-1 '><p>".(trim($rSeccion{'tTitulo'})!="-" ? "
				<input type=\"checkbox\"  name=\"D_".$i."\" id=\"D_".$i."\" ".($rSeccion{'seD'} ? "" : "  disabled=\"disabled\"")." ".
				(!$rSeccion{'peD'} ? "" : "checked=\"checked\"")." value=\"D\" onclick=\"marcarPadre(this);\" /><label for=\"D_".$i."\"> &nbsp;D</label>" : "")."</p></div>".
 								  
				"</div>";
			$datos[$i]['html'] = $tr;
			$datos[$i]['titulo'] = trim($rSeccion{'tTitulo'});
			$i++;			
  			 }
  			 
  			 if (is_array($datos) || is_object($datos))
					{
					    foreach ($datos as $tFila)
					    {
					       $html1.=$tFila['html'];
					    }
			}
			 		/*foreach($datos as $tFila){
						$html1.=$tFila['html'];
					}*/

?>
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-1 control-label">Nombre</label>
            <div class="col-md-4">
                <input type="text" name="sName" class="form-control" placeholder="Nombre Perfil" value="<?php echo (isset($result['sName'])) ? $result['sName'] : '' ; ?>">                                            
            </div>
        </div> 
        <div class="form-group">
            <label class="col-md-1 control-label">Estatus</label>
            <div class="col-md-4">
                <div class="radio-list">
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios22" value="AC" checked> Activo
                    </label>
                    <label>
                        <input type="radio" name="skStatus" id="optionsRadios23" value="IN" checked> Inactivo
                    </label>
                </div>
                
            </div>
        </div>
        <div class="form-group">
        	<label class="col-md-1 control-label">aaa</label>
        		<div class="col-md-10">
        		<?php echo $html1; ?>
        		</div>
        
        </div>
    </div>
</form>
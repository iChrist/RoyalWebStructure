<?php
	Abstract Class rev_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $solreva = array(
                    'skSolicitudRevalidacion'    			=>  ''
                    ,'skEmpresaNaviera'     				=>  ''
                    ,'skUsuarioTramitador'     				=>  ''
                    ,'skUsuarioRevalidacion'     			=>  ''
                    ,'sReferencia'     						=>  ''
                     ,'sObservaciones'     					=>  ''
                     ,'sDescripcion'    			  		=>  ''
                    ,'skEstatusRevalidacion'     			=>  ''
                    ,'limit'        						=>  ''
                    ,'offset'       						=>  ''
                );
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }
            public function __destruct(){

            }
			 /* COMIENZA MODULO RECEPCION DE DOCUMENTOS JCBB*/
            public function count_solreva(){
                $sql = "SELECT COUNT(*) AS total FROM ope_solicitud_revalidacion WHERE 1=1 ";
                if(!empty($this->solreva['skSolicitudRevalidacion'])){
                    $sql .=" AND skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."'";
                }
                if(!empty($this->solreva['sReferencia'])){
                    $sql .=" AND sReferencia like '%".$this->solreva['sReferencia']."%'";
                }
                if(!empty($this->solreva['skEmpresaNaviera'])){
                    $sql .=" AND skEmpresaNaviera like '%".$this->solreva['skEmpresaNaviera']."%'";
                }
				if(!empty($this->solreva['skUsuarioTramitador'])){
                    $sql .=" AND skUsuarioTramitador like '%".$this->solreva['skUsuarioTramitador']."%'";
                }
				if(!empty($this->solreva['sObservaciones'])){
                    $sql .=" AND sObservaciones like '%".$this->solreva['sObservaciones']."%'";
                }
 				if(!empty($this->solreva['skUsuarioRevalidacion'])){
                    $sql .=" AND skEmpresa = '".$this->solreva['skUsuarioRevalidacion']."'";
                }
				
			 
				if(!empty($this->solreva['skEstatusRevalidacion'])){
                    $sql .=" AND skStatus = '".$this->solreva['skEstatusRevalidacion']."'";
                }
 				//echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            
            public function read_solreva(){
                $sql = "	SELECT 	sd.*, 
								us.sName AS Tramitador, 
								usr.sName AS UsuarioEjecutivo, 
								ce.sNombre AS EmpresaNaviera
 						FROM ope_solicitud_revalidacion sd 
 						INNER JOIN cat_empresas  ce ON ce.skEmpresa = sd.skEmpresaNaviera 
 						INNER JOIN _users  us ON us.skUsers = sd.skUsuarioTramitador
 						INNER JOIN _users  usr ON usr.skUsers = sd.skUsuarioRevalidacion
 						WHERE 1=1 ";
                if(!empty($this->solreva['skSolicitudRevalidacion'])){
                    $sql .=" AND sd.skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."'";
                }
                if(!empty($this->solreva['sReferencia'])){
                    $sql .=" AND sd.sReferencia like '%".$this->solreva['sReferencia']."%'";
                }
                if(!empty($this->solreva['skEmpresaNaviera'])){
                    $sql .=" AND sd.skEmpresaNaviera like '%".$this->solreva['skEmpresaNaviera']."%'";
                }
				if(!empty($this->solreva['skUsuarioTramitador'])){
                    $sql .=" AND sd.skUsuarioTramitador like '%".$this->solreva['skUsuarioTramitador']."%'";
                }
				if(!empty($this->solreva['sObservaciones'])){
                    $sql .=" AND sd.sObservaciones like '%".$this->solreva['sObservaciones']."%'";
                }
				
                if(!empty($this->solreva['skUsuarioRevalidacion'])){
                    $sql .=" AND sd.skUsuarioRevalidacion like '%".$this->solreva['skUsuarioRevalidacion']."%'";
                }
                
               
                if(is_int($this->solreva['limit'])){
                    if(is_int($this->solreva['offset'])){
                        $sql .= " LIMIT ".$this->solreva['offset']." , ".$this->solreva['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->solreva['limit'];
                    }
                }
				//echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            
            public function create_recepciondocumentos(){
 				$sql = "INSERT INTO ope_recepciones_documentos (	skRecepcionDocumento,sReferencia,sPedimento,sMercancia,sObservaciones,skEmpresa,skTipoTramite,
																skTipoServicio,skClaveDocumento,skCorresponsalia,skStatus,
																dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion) 
						VALUES ('".$this->recepciondocumentos['skRecepcionDocumento']."',
								'".$this->recepciondocumentos['sReferencia']."',
								'".$this->recepciondocumentos['sPedimento']."',
								'".$this->recepciondocumentos['sMercancia']."',
								'".$this->recepciondocumentos['sObservaciones']."',
								
								'".$this->recepciondocumentos['skEmpresa']."',
								'".$this->recepciondocumentos['skTipoTramite']."',
								'".$this->recepciondocumentos['skTipoServicio']."',
								'".$this->recepciondocumentos['skClaveDocumento']."',
								'".$this->recepciondocumentos['skCorresponsalia']."',
								'AC',
								'".$datetime->format('Y-m-d')."',
								CURRENT_TIMESTAMP(),
								'".$_SESSION['session']['skUsers']."',
								CURRENT_TIMESTAMP(),
								'".$_SESSION['session']['skUsers']."')";
				//echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    return $this->recepciondocumentos['skRecepcionDocumento'];
                }else{
                    return false;
                }
            }
            
            public function update_recepciondocumentos(){
				
                $sql = "UPDATE ope_recepciones_documentos SET ";
                if(!empty($this->recepciondocumentos['sReferencia'])){
                    $sql .=" sReferencia = '".$this->recepciondocumentos['sReferencia']."' ,";
                }
                if(!empty($this->recepciondocumentos['sPedimento'])){
                    $sql .=" sPedimento = '".$this->recepciondocumentos['sPedimento']."' ,";
                }
				if(!empty($this->recepciondocumentos['sMercancia'])){
                    $sql .=" sMercancia = '".$this->recepciondocumentos['sMercancia']."' ,";
                }
				if(!empty($this->recepciondocumentos['sObservaciones'])){
                    $sql .=" sObservaciones = '".$this->recepciondocumentos['sObservaciones']."' ,";
                }
				
                if(!empty($this->recepciondocumentos['skEmpresa'])){
                    $sql .=" skEmpresa = '".$this->recepciondocumentos['skEmpresa']."' ,";
                }
                if(!empty($this->recepciondocumentos['skTipoTramite'])){
                    $sql .=" skTipoTramite = '".$this->recepciondocumentos['skTipoTramite']."' ,";
                }
				if(!empty($this->recepciondocumentos['skTipoServicio'])){
                    $sql .=" skTipoServicio = '".$this->recepciondocumentos['skTipoServicio']."' ,";
                }
				if(!empty($this->recepciondocumentos['skClaveDocumento'])){
                    $sql .=" skClaveDocumento = '".$this->recepciondocumentos['skClaveDocumento']."' ,";
                }
				if(!empty($this->recepciondocumentos['skCorresponsalia'])){
                    $sql .=" skCorresponsalia = '".$this->recepciondocumentos['skCorresponsalia']."' ,";
                }
                     $sql .=" dFechaModificacion = CURRENT_TIMESTAMP() ,";
                    $sql .=" skUsersModificacion = '".$_SESSION['session']['skUsers']."'";
                $sql .= "  WHERE skRecepcionDocumento = '".$this->recepciondocumentos['skRecepcionDocumento']."' LIMIT 1";
				//echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    return $this->recepciondocumentos['skRecepcionDocumento'];
                }else{
                    return false;
                }
            }
			
	
			
			 /* COMIENZA MODULO  JCBB*/
		   
		   
	}
?>
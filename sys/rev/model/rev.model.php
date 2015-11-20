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
            
            public function create_solreva(){
 				$sql = "INSERT INTO ope_solicitud_revalidacion (	skSolicitudRevalidacion,sReferencia,sObservaciones,skEmpresaNaviera,
																skUsuarioTramitador,skEstatusRevalidacion,dFechaRevalidacion,skUsuarioRevalidacion) 
						VALUES ('".$this->solreva['skSolicitudRevalidacion']."',
								'".$this->solreva['sReferencia']."',
  								'".$this->solreva['sObservaciones']."',
 								'".$this->solreva['skEmpresaNaviera']."',
								'".$this->solreva['skUsuarioTramitador']."',
								'RE',
 								CURRENT_TIMESTAMP(),
								'".$_SESSION['session']['skUsers']."')";
				//echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    return $this->solreva['skSolicitudRevalidacion'];
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
            
            public function read_referencia(){
	            $sql = "	SELECT 	rd.*, 
								st.sName AS status, 
								ce.sNombre AS Empresa, 
								ctt.sNombre AS TipoTramite, 
								cts.sNombre AS TipoServicio, 
								ccd.sNombre AS ClaveDocumento, 
								cc.sNombre AS Corresponsalia, 
								st.sHtml AS htmlStatus 
						FROM ope_recepciones_documentos rd 
						INNER JOIN _status  st ON st.skStatus = rd.skStatus 
						INNER JOIN cat_empresas  ce ON ce.skEmpresa = rd.skEmpresa 
						INNER JOIN cat_tipos_tramites  ctt ON ctt.skTipoTramite = rd.skTipoTramite 
						INNER JOIN cat_tipos_servicios  cts ON cts.skTipoServicio = rd.skTipoServicio 
						INNER JOIN cat_claves_documentos  ccd ON ccd.skClaveDocumento = rd.skClaveDocumento 
						INNER JOIN cat_corresponsalias  cc ON cc.skCorresponsalia = rd.skCorresponsalia 
						INNER JOIN _status ON _status.skStatus = rd.skStatus 
						WHERE 1=1 ";
                
                if(!empty($this->solreva['sReferencia'])){
                    $sql .=" AND rd.sReferencia = '".$this->solreva['sReferencia']."'";
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
			
	
			
			 /* COMIENZA MODULO  JCBB*/
		   
		   
	}
?>
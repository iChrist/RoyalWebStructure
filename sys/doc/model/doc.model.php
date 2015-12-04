<?php
	Abstract Class doc_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $recepciondocumentos = array(
                    'skRecepcionDocumento'    		=>  ''
                    ,'sReferencia'     				=>  ''
                    ,'sPedimento'     				=>  ''
                    ,'sMercancia'     				=>  ''
                    ,'sObservaciones'     				=>  ''
					
                    ,'sDescripcion'    			  	=>  ''
                    ,'skStatus'     				=>  ''
                    ,'limit'        					=>  ''
                    ,'offset'       					=>  ''
                );
                
                 public $clavdocu = array(
                    'skClaveDocumento'    		=>  ''
                    ,'sNombre'     				=>  ''
                    ,'skStatus'     			=>  ''
                    ,'limit'        			=>  ''
                    ,'offset'       			=>  ''
                );
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }
            public function __destruct(){

            }
			 /* COMIENZA MODULO RECEPCION DE DOCUMENTOS JCBB*/
            public function count_recepciondocumentos(){
                $sql = "SELECT COUNT(*) AS total FROM ope_recepciones_documentos WHERE 1=1 ";
                if(!empty($this->recepciondocumentos['skRecepcionDocumento'])){
                    $sql .=" AND skRecepcionDocumento = '".$this->recepciondocumentos['skRecepcionDocumento']."'";
                }
                if(!empty($this->recepciondocumentos['sReferencia'])){
                    $sql .=" AND sReferencia like '%".$this->recepciondocumentos['sReferencia']."%'";
                }
                if(!empty($this->recepciondocumentos['sPedimento'])){
                    $sql .=" AND sPedimento like '%".$this->recepciondocumentos['sPedimento']."%'";
                }
				if(!empty($this->recepciondocumentos['sMercancia'])){
                    $sql .=" AND sMercancia like '%".$this->recepciondocumentos['sMercancia']."%'";
                }
				if(!empty($this->recepciondocumentos['sObservaciones'])){
                    $sql .=" AND sObservaciones like '%".$this->recepciondocumentos['sObservaciones']."%'";
                }
				
				if(!empty($this->recepciondocumentos['skEmpresa'])){
                    $sql .=" AND skEmpresa = '".$this->recepciondocumentos['skEmpresa']."'";
                }
				if(!empty($this->recepciondocumentos['skTipoTramite'])){
                    $sql .=" AND skTipoTramite = '".$this->recepciondocumentos['skTipoTramite']."'";
                }
				if(!empty($this->recepciondocumentos['skTipoServicio'])){
                    $sql .=" AND skTipoServicio = '".$this->recepciondocumentos['skTipoServicio']."'";
                }
			 
				if(!empty($this->recepciondocumentos['skClaveDocumento'])){
                    $sql .=" AND skClaveDocumento = '".$this->recepciondocumentos['skClaveDocumento']."'";
                }
				if(!empty($this->recepciondocumentos['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->recepciondocumentos['skCorresponsalia']."'";
                }
				if(!empty($this->recepciondocumentos['skStatus'])){
                    $sql .=" AND skStatus = '".$this->recepciondocumentos['skStatus']."'";
                }
				if(!empty($this->recepciondocumentos['skStatus'])){
                    $sql .=" AND skStatus = '".$this->recepciondocumentos['skStatus']."'";
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
            
            public function read_recepciondocumentos(){
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
                if(!empty($this->recepciondocumentos['skRecepcionDocumento'])){
                    $sql .=" AND rd.skRecepcionDocumento = '".$this->recepciondocumentos['skRecepcionDocumento']."'";
                }
                if(!empty($this->recepciondocumentos['sReferencia'])){
                    $sql .=" AND rd.sReferencia like '%".$this->recepciondocumentos['sReferencia']."%'";
                }
                if(!empty($this->recepciondocumentos['sPedimento'])){
                    $sql .=" AND rd.sPedimento like '%".$this->recepciondocumentos['sPedimento']."%'";
                }
				if(!empty($this->recepciondocumentos['sMercancia'])){
                    $sql .=" AND rd.sMercancia like '%".$this->recepciondocumentos['sMercancia']."%'";
                }
				if(!empty($this->recepciondocumentos['sObservaciones'])){
                    $sql .=" AND rd.sObservaciones like '%".$this->recepciondocumentos['sObservaciones']."%'";
                }
				
                if(!empty($this->recepciondocumentos['skStatus'])){
                    $sql .=" AND rd.skStatus like '%".$this->recepciondocumentos['skStatus']."%'";
                }
                if(!empty($this->recepciondocumentos['skEmpresa'])){
                    $sql .=" AND rd.skEmpresa like '%".$this->recepciondocumentos['skEmpresa']."%'";
                }
                if(!empty($this->recepciondocumentos['skTipoTramite'])){
                    $sql .=" AND rd.skTipoTramite like '%".$this->recepciondocumentos['skTipoTramite']."%'";
                }
                if(!empty($this->recepciondocumentos['skTipoServicio'])){
                    $sql .=" AND rd.skTipoServicio like '%".$this->recepciondocumentos['skTipoServicio']."%'";
                }
                if(!empty($this->recepciondocumentos['skClaveDocumento'])){
                    $sql .=" AND rd.skClaveDocumento like '%".$this->recepciondocumentos['skClaveDocumento']."%'";
                }
                if(!empty($this->recepciondocumentos['skCorresponsalia'])){
                    $sql .=" AND rd.skCorresponsalia like '%".$this->recepciondocumentos['skCorresponsalia']."%'";
                }
                if(is_int($this->recepciondocumentos['limit'])){
                    if(is_int($this->recepciondocumentos['offset'])){
                        $sql .= " LIMIT ".$this->recepciondocumentos['offset']." , ".$this->recepciondocumentos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->recepciondocumentos['limit'];
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
			
	
			
			public function read_tipos_tramites(){
				$sql = "	SELECT 	rd.*
						FROM cat_tipos_tramites rd 
						WHERE 1=1 ";
				if(!empty($this->recepciondocumentos['skTipoTramite'])){
					$sql .=" AND rd.skTipoTramite = '".$this->recepciondocumentos['skTipoTramite']."'";
				}
				if(!empty($this->recepciondocumentos['sNombre'])){
					$sql .=" AND rd.sNombre like '%".$this->recepciondocumentos['sNombre']."%'";
				}
				if(!empty($this->recepciondocumentos['skStatus'])){
					$sql .=" AND rd.skStatus like '%".$this->recepciondocumentos['skStatus']."%'";
				}else{
					$sql .=" AND rd.skStatus = 'AC'";
				}
				
				if(is_int($this->recepciondocumentos['limit'])){
					if(is_int($this->recepciondocumentos['offset'])){
						$sql .= " LIMIT ".$this->recepciondocumentos['offset']." , ".$this->recepciondocumentos['limit'];
					}else{
						$sql .= " LIMIT ".$this->recepciondocumentos['limit'];
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
			public function read_tipos_servicios(){
				$sql = "	SELECT 	rd.*
						FROM cat_tipos_servicios rd 
						WHERE 1=1 ";
				if(!empty($this->recepciondocumentos['skTipoTramite'])){
					$sql .=" AND rd.skTipoTramite = '".$this->recepciondocumentos['skTipoTramite']."'";
				}
				if(!empty($this->recepciondocumentos['sNombre'])){
					$sql .=" AND rd.sNombre like '%".$this->recepciondocumentos['sNombre']."%'";
				}
				if(!empty($this->recepciondocumentos['skStatus'])){
					$sql .=" AND rd.skStatus like '%".$this->recepciondocumentos['skStatus']."%'";
				}else{
					$sql .=" AND rd.skStatus = 'AC'";
				}
				
				if(is_int($this->recepciondocumentos['limit'])){
					if(is_int($this->recepciondocumentos['offset'])){
						$sql .= " LIMIT ".$this->recepciondocumentos['offset']." , ".$this->recepciondocumentos['limit'];
					}else{
						$sql .= " LIMIT ".$this->recepciondocumentos['limit'];
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
			public function read_clave_documento(){
				$sql = "	SELECT 	rd.*
						FROM cat_claves_documentos rd 
						WHERE 1=1 ";
				if(!empty($this->recepciondocumentos['skTipoTramite'])){
					$sql .=" AND rd.skTipoTramite = '".$this->recepciondocumentos['skTipoTramite']."'";
				}
				if(!empty($this->recepciondocumentos['sNombre'])){
					$sql .=" AND rd.sNombre like '%".$this->recepciondocumentos['sNombre']."%'";
				}
				if(!empty($this->recepciondocumentos['skStatus'])){
					$sql .=" AND rd.skStatus like '%".$this->recepciondocumentos['skStatus']."%'";
				}else{
					$sql .=" AND rd.skStatus = 'AC'";
				}
				
				if(is_int($this->recepciondocumentos['limit'])){
					if(is_int($this->recepciondocumentos['offset'])){
						$sql .= " LIMIT ".$this->recepciondocumentos['offset']." , ".$this->recepciondocumentos['limit'];
					}else{
						$sql .= " LIMIT ".$this->recepciondocumentos['limit'];
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
			public function read_corresponsalia(){
				$sql = "	SELECT 	rd.*
						FROM cat_corresponsalias rd 
						WHERE 1=1 ";
				if(!empty($this->recepciondocumentos['skCorresponsalia'])){
					$sql .=" AND rd.skCorresponsalia = '".$this->recepciondocumentos['skCorresponsalia']."'";
				}
				if(!empty($this->recepciondocumentos['sNombre'])){
					$sql .=" AND rd.sNombre like '%".$this->recepciondocumentos['sNombre']."%'";
				}
				if(!empty($this->recepciondocumentos['skStatus'])){
					$sql .=" AND rd.skStatus like '%".$this->recepciondocumentos['skStatus']."%'";
				}else{
					$sql .=" AND rd.skStatus = 'AC'";
				}
				
				if(is_int($this->recepciondocumentos['limit'])){
					if(is_int($this->recepciondocumentos['offset'])){
						$sql .= " LIMIT ".$this->recepciondocumentos['offset']." , ".$this->recepciondocumentos['limit'];
					}else{
						$sql .= " LIMIT ".$this->recepciondocumentos['limit'];
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

			public function count_clavdocu(){
                $sql = "SELECT COUNT(*) AS total FROM cat_claves_documentos WHERE 1=1 ";
                if(!empty($this->clavdocu['skClaveDocumento'])){
                    $sql .=" AND skClaveDocumento = '".$this->clavdocu['skClaveDocumento']."'";
                }
                if(!empty($this->clavdocu['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->clavdocu['sNombre']."%'";
                }
                if(!empty($this->clavdocu['skStatus'])){
                    $sql .=" AND cat_claves_documentos.skStatus like '%".$this->clavdocu['skStatus']."%'";
                }
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
			public function read_equal_clavdocu(){
                $sql = "SELECT cat_claves_documentos.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_claves_documentos INNER JOIN _status ON _status.skStatus = cat_claves_documentos.skStatus WHERE 1=1 ";
                if(!empty($this->clavdocu['skClaveDocumento'])){
                    $sql .=" AND skClaveDocumento = '".$this->clavdocu['skClaveDocumento']."'";
                }
                if(!empty($this->clavdocu['sNombre'])){
                    $sql .=" AND sNombre = '".$this->clavdocu['sNombre']."'";
                }
                if(!empty($this->clavdocu['skStatus'])){
                    $sql .=" AND cat_claves_documentos.skStatus = '".$this->clavdocu['skStatus']."'";
                }
                if(is_int($this->clavdocu['limit'])){
                    if(is_int($this->clavdocu['offset'])){
                        $sql .= " LIMIT ".$this->clavdocu['offset']." , ".$this->clavdocu['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->clavdocu['limit'];
                    }
                }
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            public function read_like_clavdocu(){
                $sql = "SELECT cat_claves_documentos.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_claves_documentos INNER JOIN _status ON _status.skStatus = cat_claves_documentos.skStatus WHERE 1=1 ";
                if(!empty($this->clavdocu['skClaveDocumento'])){
                    $sql .=" AND skClaveDocumento = '".$this->clavdocu['skClaveDocumento']."'";
                }
                if(!empty($this->clavdocu['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->clavdocu['sNombre']."%'";
                }
               
                if(!empty($this->clavdocu['skStatus'])){
                    $sql .=" AND cat_claves_documentos.skStatus like '%".$this->clavdocu['skStatus']."%'";
                }
                if(is_int($this->clavdocu['limit'])){
                    if(is_int($this->clavdocu['offset'])){
                        $sql .= " LIMIT ".$this->clavdocu['offset']." , ".$this->clavdocu['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->clavdocu['limit'];
                    }
                }
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            public function create_clavdocu(){
                $sql = "INSERT INTO cat_claves_documentos (skClaveDocumento,sNombre,skStatus) VALUES ('".$this->clavdocu['skClaveDocumento']."','".$this->clavdocu['sNombre']."','".$this->clavdocu['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->clavdocu['skClaveDocumento'];
                }else{
                    return false;
                }
            }
            public function update_clavdocu(){
                $sql = "UPDATE cat_claves_documentos SET ";
                if(!empty($this->clavdocu['sNombre'])){
                    $sql .=" sNombre = '".$this->clavdocu['sNombre']."' ,";
                }
                if(!empty($this->clavdocu['skStatus'])){
                    $sql .=" skStatus = '".$this->clavdocu['skStatus']."' ,";
                }
                $sql .= " skClaveDocumento = '".$this->clavdocu['skClaveDocumento']."' WHERE skClaveDocumento = '".$this->clavdocu['skClaveDocumentoViejo']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->clavdocu['skClaveDocumento'];
                }else{
                    return false;
                }
            }
			
			 /* COMIENZA MODULO  JCBB*/
		   
		   
	}
?>
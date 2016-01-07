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
                    ,'sNumContenedor'=>''
                    ,'iBultos'=>0
                    ,'fPeso'=>0
                    ,'fVolumen'=>0
                    ,'dRecepcion'=>''
                    ,'tRecepcion'=>''
                    ,'skStatus'     				=>  ''
                    
                    ,'skCorresponsalia'=>''
                    ,'skPromotor1'=>''
                    ,'skPromotor2'=>''
                    ,'limit'        					=>  ''
                    ,'offset'       					=>  ''
                    ,'orderBy'       					=>  ''
                    ,'sortBy'       					=>  'DESC'   
                );

                 public $clavdocu = array(
                    'skClaveDocumento'    		=>  ''
                    ,'sNombre'     				=>  ''
                    ,'skStatus'     			=>  ''
                    ,'limit'        			=>  ''
                    ,'offset'       			=>  ''
                    );
                    
                  public $correspo = array(
                    'skCorresponsalia'    		=>  ''
                    ,'sNombre'     				=>  ''
                    ,'skStatus'     			=>  ''
                    ,'limit'        			=>  ''
                    ,'offset'       			=>  ''
                    );
                    
                    
            	/* cat_docTipo */
                public $docTipo = array(
				'skDocTipo' =>  NULL
				,'sNombre'=>  NULL
				,'skStatus' 			=>  NULL
				,'limit'    				=>  NULL
				,'offset'   				=>  NULL
                );
                /**/
                public $recepcionDoc_docTipo = array(
				'skRecepcionDoc_docTipo' =>  NULL
				,'skRecepcionDocumento'=>  NULL
				,'skDocTipo' 			=>  NULL
				,'sFile' 			=>  NULL
				,'skStatus' 			=>  NULL
				,'limit'    				=>  NULL
				,'offset'   				=>  NULL
                );
                
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }
            public function __destruct(){

            }
            /* CATALOGO DE TIPOS DE DOCUMENTOS PARA SUBIR COMO ARTCHIVO */
            public function count_docTipo(){
                $sql = "SELECT COUNT(*) AS total FROM cat_docTipo AS docTipo WHERE 1=1 ";
                if(!empty($this->recepcionDoc_docTipo['skDocTipo'])){
                    $sql .=" AND docTipo.skDocTipo = '".$this->recepcionDoc_docTipo['skDocTipo']."'";
                }
                if(!empty($this->recepcionDoc_docTipo['sNombre'])){
                    $sql .=" AND docTipo.sNombre like '%".$this->recepcionDoc_docTipo['sNombre']."%'";
                }
                if(!empty($this->recepcionDoc_docTipo['skStatus'])){
                    $sql .=" AND docTipo.skStatus = '".$this->recepcionDoc_docTipo['skStatus']."'";
                }
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }

            public function read_like_docTipo(){
                $sql="SELECT docTipo.*,st.sHtml AS htmlStatus FROM cat_docTipo AS docTipo INNER JOIN _status  st ON st.skStatus = docTipo.skStatus WHERE 1=1 ";
                if(!empty($this->recepcionDoc_docTipo['skDocTipo'])){
                    $sql .=" AND docTipo.skDocTipo like '".$this->recepcionDoc_docTipo['skDocTipo']."%'";
                }
                if(!empty($this->recepcionDoc_docTipo['sNombre'])){
                    $sql .=" AND docTipo.sNombre like '".$this->recepcionDoc_docTipo['sNombre']."%'";
                }
                if(!empty($this->recepcionDoc_docTipo['skStatus'])){
                    $sql .=" AND docTipo.skStatus = '".$this->recepcionDoc_docTipo['skStatus']."'";
                }
                if(is_int($this->recepcionDoc_docTipo['limit'])){
                    if(is_int($this->recepcionDoc_docTipo['offset'])){
                        $sql .= " LIMIT ".$this->recepcionDoc_docTipo['offset']." , ".$this->recepcionDoc_docTipo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->recepcionDoc_docTipo['limit'];
                    }
                }
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }

            public function read_equal_docTipo(){
            	$sql="SELECT docTipo.*,st.sHtml AS htmlStatus FROM cat_docTipo AS docTipo INNER JOIN _status  st ON st.skStatus = docTipo.skStatus WHERE 1=1 ";
                if(!empty($this->recepcionDoc_docTipo['skDocTipo'])){
                    $sql .=" AND docTipo.skDocTipo = '".$this->recepcionDoc_docTipo['skDocTipo']."'";
                }
                if(!empty($this->recepcionDoc_docTipo['sNombre'])){
                    $sql .=" AND docTipo.sNombre = '".$this->recepcionDoc_docTipo['sNombre']."'";
                }
                if(!empty($this->recepcionDoc_docTipo['skStatus'])){
                    $sql .=" AND docTipo.skStatus = '".$this->recepcionDoc_docTipo['skStatus']."'";
                }
                if(is_int($this->recepcionDoc_docTipo['limit'])){
                    if(is_int($this->recepcionDoc_docTipo['offset'])){
                        $sql .= " LIMIT ".$this->recepcionDoc_docTipo['offset']." , ".$this->recepcionDoc_docTipo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->recepcionDoc_docTipo['limit'];
                    }
                }
            	//exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            
            public function create_docTipo(){
                $sql = "INSERT INTO cat_docTipo (skDocTipo,sNombre,skStatus) VALUES ('".$this->recepcionDoc_docTipo['skDocTipo']."','".$this->recepcionDoc_docTipo['sNombre']."','".$this->recepcionDoc_docTipo['skStatus']."')";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->recepcionDoc_docTipo['skDocTipo'];
                }else{
                    return false;
                }
            }
            
            public function update_docTipo(){
                $sql = "UPDATE cat_docTipo SET ";
                if(!empty($this->recepcionDoc_docTipo['sNombre'])){
                    $sql .=" sNombre = '".$this->recepcionDoc_docTipo['sNombre']."' ,";
                }
                if(!empty($this->recepcionDoc_docTipo['skStatus'])){
                    $sql .=" skStatus = '".$this->recepcionDoc_docTipo['skStatus']."' ";
                }
                $sql .= " WHERE skDocTipo = '".$this->recepcionDoc_docTipo['skDocTipo']."' LIMIT 1";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->recepcionDoc_docTipo['skDocTipo'];
                }else{
                    return false;
                }
            }
            
            public function read_equal_recepcionDoc_docTipo(){
                $sql="SELECT recepcionDoc_docTipo.* FROM rel_recepcionDoc_docTipo AS recepcionDoc_docTipo WHERE 1=1 ";
                if(!empty($this->recepcionDoc_docTipo['skRecepcionDocumento'])){
                    $sql .=" AND skRecepcionDocumento = '".$this->recepcionDoc_docTipo['skRecepcionDocumento']."'";
                }
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            /* INSERT DE TIPOS DE DOCUMENTOS SUBIDOS POR CATALOGO DE TIPOS DE DOCUMENTOS */
            public function create_recepcionDoc_docTipo(){
            	$sql="INSERT INTO rel_recepcionDoc_docTipo () VALUES (
            		 '".$this->recepcionDoc_docTipo['skRecepcionDoc_docTipo']."'
            		,'".$this->recepcionDoc_docTipo['skRecepcionDocumento']."'
            		,'".$this->recepcionDoc_docTipo['skDocTipo']."'
            		,'".$this->recepcionDoc_docTipo['sFile']."'
            		,'AC')";
            	//exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'];
                }else{
                	return false;
                }
            }
            /* UPDATE(DELETE) DE TIPOS DE DOCUMENTOS SUBIDOS POR CATALOGO DE TIPOS DE DOCUMENTOS */
            public function updateStatus_recepcionDoc_docTipo(){
            	$sql="UPDATE rel_recepcionDoc_docTipo SET skStatus = '".$this->recepcionDoc_docTipo['skStatus']."' WHERE 1=1 ";
                if(!empty($this->recepcionDoc_docTipo['skRecepcionDocumento'])){
                    $sql .=" AND skRecepcionDocumento = '".$this->recepcionDoc_docTipo['skRecepcionDocumento']."'";
                }
                if(!empty($this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'])){
                    $sql .=" AND skRecepcionDoc_docTipo = '".$this->recepcionDoc_docTipo['skRecepcionDoc_docTipo']."'";
                }
            	//exit($sql);
                $result = $this->db->query($sql);
            	if($result){
                    return true;
                }else{
                	return false;
                }
            }
        /* COMIENZA MODULO RECEPCION DE DOCUMENTOS JCBB*/
        public function getMaxPedimento(){
            $sql = "SELECT MAX(sPedimento) AS sPedimento FROM ope_recepciones_documentos WHERE skStatus = 'AC' ";
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                return $result->fetch_assoc();
            }else{
                return false;
            }
        }
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
                if(!empty($this->recepciondocumentos['dFechaCreacion'])){
                    $sql .=" AND DATE_FORMAT(dFechaCreacion,'%Y-%m-%d') = '".$this->recepciondocumentos['dFechaCreacion']."'";
                }
                if(!empty($this->recepciondocumentos['dRecepcion'])){
                    $sql .=" AND DATE_FORMAT(dRecepcion,'%Y-%m-%d') = '".$this->recepciondocumentos['dRecepcion']."'";
                }
				if(!empty($this->recepciondocumentos['skStatus'])){
                    $sql .=" AND skStatus = '".$this->recepciondocumentos['skStatus']."'";
                }
 				//echo $sql;
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
                $sql = "SELECT rd.*, 
                            st.sName AS status, 
                            ce.sNombre AS Empresa,
                            ce.skCorresponsalia,
                            (SELECT sNombre FROM cat_empresas WHERE cat_empresas.skEmpresa = ce.skCorresponsalia) AS corresponsalia,
                            ctt.sNombre AS TipoTramite, 
                            cts.sNombre AS TipoServicio, 
                            ccd.sNombre AS ClaveDocumento,
                            _users.sName AS autor,
                            promotor1.sNombre AS promotor1, 
                            promotor2. sNombre AS promotor2,
                            st.sHtml AS htmlStatus 
                FROM ope_recepciones_documentos rd 
                INNER JOIN _status  st ON st.skStatus = rd.skStatus 
                INNER JOIN cat_empresas  ce ON ce.skEmpresa = rd.skEmpresa

                LEFT JOIN cat_promotores promotor1 ON promotor1.skPromotores  = ce.skPromotor1 
                LEFT JOIN cat_promotores promotor2 ON promotor2.skPromotores  = ce.skPromotor2 
                INNER JOIN cat_tipos_tramites  ctt ON ctt.skTipoTramite = rd.skTipoTramite 
                INNER JOIN cat_tipos_servicios  cts ON cts.skTipoServicio = rd.skTipoServicio 
                INNER JOIN cat_claves_documentos  ccd ON ccd.skClaveDocumento = rd.skClaveDocumento 
                INNER JOIN _users ON _users.skUsers = rd.skUsersCreacion 
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
                if(!empty($this->recepciondocumentos['sNumContenedor'])){
                    $sql .=" AND rd.sNumContenedor like '%".$this->recepciondocumentos['sNumContenedor']."%'";
                }
                if(!empty($this->recepciondocumentos['skTipoServicio'])){
                    $sql .=" AND rd.skTipoServicio like '%".$this->recepciondocumentos['skTipoServicio']."%'";
                }
                if(!empty($this->recepciondocumentos['skClaveDocumento'])){
                    $sql .=" AND rd.skClaveDocumento like '%".$this->recepciondocumentos['skClaveDocumento']."%'";
                }
                if(!empty($this->recepciondocumentos['dFechaCreacion'])){
                    $sql .=" AND DATE_FORMAT(rd.dFechaCreacion,'%Y-%m-%d') = '".$this->recepciondocumentos['dFechaCreacion']."'";
                }
                if(!empty($this->recepciondocumentos['dRecepcion'])){
                    $sql .=" AND DATE_FORMAT(rd.dRecepcion,'%Y-%m-%d') = '".$this->recepciondocumentos['dRecepcion']."'";
                }
                if(!empty($this->recepciondocumentos['skCorresponsalia'])){
                    $sql .=" AND ce.skCorresponsalia = '".$this->recepciondocumentos['skCorresponsalia']."'";
                }
                if(!empty($this->recepciondocumentos['skPromotor1'])){
                    $sql .=" AND ce.skPromotor1 = '".$this->recepciondocumentos['skPromotor1']."' OR ce.skPromotor2 = '".$this->recepciondocumentos['skPromotor2']."'";
                }
                if(!empty($this->recepciondocumentos['orderBy'])){
                    $sql .=" ORDER BY ".$this->recepciondocumentos['orderBy']." ".$this->recepciondocumentos['sortBy'];
                }
                if(is_int($this->recepciondocumentos['limit'])){
                    if(is_int($this->recepciondocumentos['offset'])){
                        $sql .= " LIMIT ".$this->recepciondocumentos['offset']." , ".$this->recepciondocumentos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->recepciondocumentos['limit'];
                    }
                }
                //echo $sql;
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
 				$sql = "INSERT INTO ope_recepciones_documentos (skRecepcionDocumento,sReferencia,sPedimento,sMercancia,sObservaciones,sNumContenedor,iBultos,fPeso,fVolumen,skEmpresa,skTipoTramite,
                        skTipoServicio,skClaveDocumento,dRecepcion,tRecepcion,
                        skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion) 
                        VALUES ('".$this->recepciondocumentos['skRecepcionDocumento']."',
                                '".$this->recepciondocumentos['sReferencia']."',
                                '".$this->recepciondocumentos['sPedimento']."',
                                '".$this->recepciondocumentos['sMercancia']."',
                                '".$this->recepciondocumentos['sObservaciones']."',
                                
                                '".$this->recepciondocumentos['sNumContenedor']."',
                                ".$this->recepciondocumentos['iBultos'].",
                                ".$this->recepciondocumentos['fPeso'].",
                                ".$this->recepciondocumentos['fVolumen'].",

                                '".$this->recepciondocumentos['skEmpresa']."',
                                '".$this->recepciondocumentos['skTipoTramite']."',
                                '".$this->recepciondocumentos['skTipoServicio']."',
                                '".$this->recepciondocumentos['skClaveDocumento']."',
                                '".$this->recepciondocumentos['dRecepcion']."',
                                '".$this->recepciondocumentos['tRecepcion']."',
                                'AC',
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
                
                /* TIPO DE SERVICIO */
                $sql .=" sNumContenedor = '".$this->recepciondocumentos['sNumContenedor']."' ,";
                $sql .=" iBultos = ".$this->recepciondocumentos['iBultos']." ,";
                $sql .=" fPeso = ".$this->recepciondocumentos['fPeso']." ,";
                $sql .=" fVolumen = ".$this->recepciondocumentos['fVolumen']." ,";
                /* TERMINA TIPO DE SERVICIO */
                
                $sql .=" dRecepcion = '".$this->recepciondocumentos['dRecepcion']."' ,";
                $sql .=" tRecepcion = '".$this->recepciondocumentos['tRecepcion']."' ,";

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
	    
            public function delete_recepciondocumentos(){
                $sql = "DELETE FROM ope_recepciones_documentos WHERE skRecepcionDocumento = '".$this->recepciondocumentos['skRecepcionDocumento']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return true;
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
            
            public function count_correspo(){
                $sql = "SELECT COUNT(*) AS total FROM cat_corresponsalias WHERE 1=1 ";
                if(!empty($this->correspo['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->correspo['skCorresponsalia']."'";
                }
                if(!empty($this->correspo['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->correspo['sNombre']."%'";
                }
                if(!empty($this->correspo['skStatus'])){
                    $sql .=" AND cat_corresponsalias.skStatus like '%".$this->correspo['skStatus']."%'";
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
            public function read_equal_correspo(){
                $sql = "SELECT cat_corresponsalias.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_corresponsalias INNER JOIN _status ON _status.skStatus = cat_corresponsalias.skStatus WHERE 1=1 ";
                if(!empty($this->correspo['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->correspo['skCorresponsalia']."'";
                }
                if(!empty($this->correspo['sNombre'])){
                    $sql .=" AND sNombre = '".$this->correspo['sNombre']."'";
                }
                if(!empty($this->correspo['skStatus'])){
                    $sql .=" AND cat_corresponsalias.skStatus = '".$this->correspo['skStatus']."'";
                }
                if(is_int($this->correspo['limit'])){
                    if(is_int($this->correspo['offset'])){
                        $sql .= " LIMIT ".$this->correspo['offset']." , ".$this->correspo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->correspo['limit'];
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
            public function read_like_correspo(){
                $sql = "SELECT cat_corresponsalias.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_corresponsalias INNER JOIN _status ON _status.skStatus = cat_corresponsalias.skStatus WHERE 1=1 ";
                if(!empty($this->correspo['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->correspo['skCorresponsalia']."'";
                }
                if(!empty($this->correspo['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->correspo['sNombre']."%'";
                }
               
                if(!empty($this->correspo['skStatus'])){
                    $sql .=" AND cat_corresponsalias.skStatus like '%".$this->correspo['skStatus']."%'";
                }
                if(is_int($this->correspo['limit'])){
                    if(is_int($this->correspo['offset'])){
                        $sql .= " LIMIT ".$this->correspo['offset']." , ".$this->correspo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->correspo['limit'];
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
            public function create_correspo(){
                $sql = "INSERT INTO cat_corresponsalias (skCorresponsalia,sNombre,skStatus) VALUES ('".$this->correspo['skCorresponsalia']."','".$this->correspo['sNombre']."','".$this->correspo['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->correspo['skCorresponsalia'];
                }else{
                    return false;
                }
            }
            public function update_correspo(){
                $sql = "UPDATE cat_corresponsalias SET ";
                if(!empty($this->correspo['sNombre'])){
                    $sql .=" sNombre = '".$this->correspo['sNombre']."' ,";
                }
                if(!empty($this->correspo['skStatus'])){
                    $sql .=" skStatus = '".$this->correspo['skStatus']."' ,";
                }
                $sql .= " skCorresponsalia = '".$this->correspo['skCorresponsalia']."' WHERE skCorresponsalia = '".$this->correspo['skCorresponsaliaViejo']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->correspo['skCorresponsalia'];
                }else{
                    return false;
                }
            }
			
			 /* COMIENZA MODULO  JCBB*/
		   
		   
	}
?>
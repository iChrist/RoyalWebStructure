<?php
	Class Fac_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $facdat = array(
                    'skFacturacion'=>null
                    ,'sReferencia'=>null
                    ,'dFechaFacturacion'=>null
                    ,'sFolio'=>null
                    ,'fImporte'=>null
                    ,'fIva'=>null
                    ,'fTotalFacturado'=>null
                    ,'fGanancia'=>null
                    ,'fAA'=>null
                    ,'fPromotor1'=>null
                    ,'fPromotor2'=>null
                    ,'skUserCreacion'=>null
                    ,'skUserModificacion'=>null
                    ,'dFechaCreacion'=>null
                    ,'dFechaModificacion'=>null
                    ,'limit'=>null
                    ,'offset'=>null
                );
            // PRIVATE VARIABLES //
                private $data = array();

            public function __construct(){
                parent::__construct();
            }
            public function __destruct(){

            }
			
            public function count_solreva(){
                $sql = "SELECT COUNT(*) AS total FROM ope_solicitud_revalidacion WHERE 1=1 ";
                if(!empty($this->solreva['skSolicitudRevalidacion'])){
                    $sql .=" AND skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."'";
                }
                if(!empty($this->solreva['sReferencia'])){
                    $sql .=" AND sReferencia like '%".$this->solreva['sReferencia']."%'";
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
                $sql = "SELECT 	sd.*,
                FROM ope_solicitud_revalidacion sd 
                WHERE 1=1 ";
                if(!empty($this->solreva['skSolicitudRevalidacion'])){
                    $sql .=" AND sd.skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."'";
                }
                if(!empty($this->solreva['sReferencia'])){
                    $sql .=" AND sd.sReferencia like '%".$this->solreva['sReferencia']."%'";
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
                $sql = "INSERT INTO ope_solicitud_revalidacion 
                    (skSolicitudRevalidacion,sReferencia,sObservaciones,skEmpresaNaviera,skEstatusRevalidacion,dFechaCreacion,skUsuarioSolicitud,sBL,iPrioridad,dFechaArriboBuque,dEta) 
                    VALUES ('".$this->solreva['skSolicitudRevalidacion']."',
                    '".$this->solreva['sReferencia']."',
                    '".$this->solreva['sObservaciones']."',
                    '".$this->solreva['skEmpresaNaviera']."',
                    'NU',
                    CURRENT_TIMESTAMP(),
                    '".$_SESSION['session']['skUsers']."',
                '".$this->solreva['sBL']."',
                ".$this->solreva['iPrioridad'].",
                '".$this->solreva['dFechaArriboBuque']."',
                '".$this->solreva['dEta']."')";
                //echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    return $this->solreva['skSolicitudRevalidacion'];
                }else{
                    return false;
                }
            }
             public function update_solreva(){
                
                $sql = "UPDATE ope_solicitud_revalidacion SET ";
                
                if(!is_null($this->solreva['skEmpresaNaviera'])){
                    $sql.=" skEmpresaNaviera='".$this->solreva['skEmpresaNaviera']."', ";
                }
                if(!is_null($this->solreva['skUsuarioTramitador'])){
                    $sql.=" skUsuarioTramitador='".$this->solreva['skUsuarioTramitador']."', ";
                }
                if(!is_null($this->solreva['dFechaProceso'])){
                    $sql.=" dFechaProceso=".$this->solreva['dFechaProceso'].", ";
                }
                if(!is_null($this->solreva['dFechaCierre'])){
                    $sql.=" dFechaCierre=".$this->solreva['dFechaCierre'].", ";
                }
                if(!is_null($this->solreva['sObservaciones'])){
                    $sql.=" sObservaciones='".$this->solreva['sObservaciones']."', ";
                }
                if(!is_null($this->solreva['skEstatusRevalidacion'])){
                    $sql.=" skEstatusRevalidacion='".$this->solreva['skEstatusRevalidacion']."', ";
                }
                if(!is_null($this->solreva['skUsuarioProceso'])){
                    $sql.=" skUsuarioProceso='".$this->solreva['skUsuarioProceso']."', ";
                }
                if(!is_null($this->solreva['skUsuarioCierre'])){
                    $sql.=" skUsuarioCierre='".$this->solreva['skUsuarioCierre']."', ";
                }
                if(!is_null($this->solreva['sBL'])){
                    $sql.=" sBL='".$this->solreva['sBL']."', ";
                }
                if(!is_null($this->solreva['iPrioridad'])){
                    $sql.=" iPrioridad='".$this->solreva['iPrioridad']."', ";
                }
                if(!is_null($this->solreva['dFechaArriboBuque'])){
                    $sql.=" dFechaArriboBuque='".$this->solreva['dFechaArriboBuque']."', ";
                }
                if(!is_null($this->solreva['dEta'])){
                    $sql.=" dEta='".$this->solreva['dEta']."', ";
                }
                $sql .= " skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."' WHERE skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."'";
                //exit($sql);
                $result = $this->db->query($sql);
                $sql = "DELETE from rel_solicitud_revalidaciones_rechazos  WHERE skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."'";
                $this->db->query($sql);
                if($result){
                    return $this->solreva['skSolicitudRevalidacion'];
                }else{
                    return false;
                }
            }
            
            public function delete_solreva(){
                $sql = "DELETE FROM ope_solicitud_revalidacion WHERE skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            
            public function read_referencia(){
	            $sql = "	SELECT 	rd.*, 
								st.sName AS status,
								us.sName AS Ejecutivo,
								ce.sNombre AS Empresa, 
								ctt.sNombre AS TipoTramite, 
								cts.sNombre AS TipoServicio, 
								ccd.sNombre AS ClaveDocumento, 
								st.sHtml  
						FROM ope_recepciones_documentos rd 
						INNER JOIN _status  st ON st.skStatus = rd.skStatus 
						INNER JOIN cat_empresas  ce ON ce.skEmpresa = rd.skEmpresa 
						INNER JOIN cat_tipos_tramites  ctt ON ctt.skTipoTramite = rd.skTipoTramite 
						INNER JOIN cat_tipos_servicios  cts ON cts.skTipoServicio = rd.skTipoServicio 
						INNER JOIN cat_claves_documentos  ccd ON ccd.skClaveDocumento = rd.skClaveDocumento 
						INNER JOIN _users us ON us.skUsers = rd.skUsersCreacion
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
 
	}
?>
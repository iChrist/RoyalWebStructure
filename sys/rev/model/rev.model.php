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
                    
                    ,'skEmpresa'=>''
                    
                    ,'limit'        							=>  ''
                    ,'offset'       							=>  ''
                    ,'dFechaFin'=>''

                    ,'dFechaCreacion'       				=>  null
                    ,'dFechaTramitador'                     =>  null
                    ,'dFechaCierre'                         =>  null
                );
                public $rechazos = array(
                    'skRechazo'    							=>  ''
                    ,'sNombre'     							=>  ''
                    ,'skStatus'     						=>  ''
                    ,'dFechaCreacion'     					=>  ''
                    ,'skUserCreacion'     					=>  ''
                     ,'skUserActualizacion'     			=>  ''
                     ,'dFechaActualizacion'    			  	=>  ''
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
                    $sql .=" AND skUsuarioRevalidacion = '".$this->solreva['skUsuarioRevalidacion']."'";
                }
				if(!empty($this->solreva['skEstatusRevalidacion'])){
                    $sql .=" AND skEstatusRevalidacion = '".$this->solreva['skEstatusRevalidacion']."'";
                }
			 	if(!empty($this->solreva['order_date_from'])){
 					$Fecha = explode("/", $this->solreva['order_date_from']);
                    $sql .=" AND dFechaCierre like '%".$Fecha[2]."-".$Fecha[1]."-".$Fecha[0]."%'";
                }
				if(!empty($this->solreva['skEstatusRevalidacion'])){
                    $sql .=" AND skEstatusRevalidacion = '".$this->solreva['skEstatusRevalidacion']."'";
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
                us.sName AS Tramitador, 
                usr.sName AS UsuarioEjecutivo, 
                ce.sNombre AS EmpresaNaviera,
                cm.sNombre AS Cliente,
                cs.sNombre AS Estatus,
                cs.sIcono As Icono
                FROM ope_solicitud_revalidacion sd 
                INNER JOIN cat_empresas  ce ON ce.skEmpresa = sd.skEmpresaNaviera 
                LEFT JOIN _users  us ON us.skUsers = sd.skUsuarioTramitador
                LEFT JOIN _users  usr ON usr.skUsers = sd.skUsuarioRevalidacion
                INNER JOIN cat_estatus  cs ON cs.skEstatus = sd.skEstatusRevalidacion
                LEFT  JOIN ope_recepciones_documentos opr ON opr.sReferencia = sd.sReferencia
                LEFT JOIN cat_empresas cm ON cm.skEmpresa = opr.skEmpresa
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
				if(!empty($this->solreva['skEstatusRevalidacion'])){
                    $sql .=" AND sd.skEstatusRevalidacion = '".$this->solreva['skEstatusRevalidacion']."'";
                }
                if(!empty($this->solreva['skUsuarioRevalidacion'])){
                    $sql .=" AND sd.skUsuarioRevalidacion like '%".$this->solreva['skUsuarioRevalidacion']."%'";
                }
                if(!empty($this->solreva['dFechaCierre'])){
                    if(!empty($this->solreva['dFechaFin'])){
                        $sql .= " AND (DATE_FORMAT(sd.dFechaCierre,'%Y-%m-%d') >= '".date('Y-m-d',  strtotime($this->solreva['dFechaCierre']))."' AND DATE_FORMAT(sd.dFechaCierre,'%Y-%m-%d') <= '".date('Y-m-d',  strtotime($this->solreva['dFechaFin']))."')";
                    }else{
                        //$Fecha = explode("/", $this->solreva['order_date_from']);
                        //$sql .=" AND sd.dFechaCierre like '%".$Fecha[2]."-".$Fecha[1]."-".$Fecha[0]."%'";
                        $sql .=" AND DATE_FORMAT(sd.dFechaCierre,'%Y-%m-%d') = '".date('Y-m-d',  strtotime($this->solreva['dFechaCierre']))."'";
                    }
                }
                if(!empty($this->solreva['skEmpresa'])){
                    $sql .=" AND cm.skEmpresa = '".$this->solreva['skEmpresa']."'";
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
																skUsuarioTramitador,skEstatusRevalidacion,dFechaCreacion,skUsuarioRevalidacion) 
						VALUES ('".$this->solreva['skSolicitudRevalidacion']."',
								'".$this->solreva['sReferencia']."',
  								'".$this->solreva['sObservaciones']."',
 								'".$this->solreva['skEmpresaNaviera']."',
								'".$this->solreva['skUsuarioTramitador']."',
								'NU',
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
             public function update_solreva(){
                
                $sql = "UPDATE ope_solicitud_revalidacion SET ";
                
                if(!is_null($this->solreva['skEmpresaNaviera'])){
                    $sql.=" skEmpresaNaviera='".$this->solreva['skEmpresaNaviera']."', ";
                }
                if(!is_null($this->solreva['skUsuarioTramitador'])){
                    $sql.=" skUsuarioTramitador='".$this->solreva['skUsuarioTramitador']."', ";
                }
                if(!is_null($this->solreva['dFechaTramitador'])){
                    $sql.=" dFechaTramitador=".$this->solreva['dFechaTramitador'].", ";
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
            
            public function read_estatus(){
	            $sql = "	SELECT 	*  FROM cat_estatus WHERE skStatus='AC' ";
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

			
	
			public function count_rechazos(){
                $sql = "SELECT COUNT(*) AS total FROM cat_rechazos WHERE 1=1 ";
                if(!empty($this->rechazos['skRechazo'])){
                    $sql .=" AND skRechazo = '".$this->rechazos['skRechazo']."'";
                }
                if(!empty($this->rechazos['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->rechazos['sNombre']."%'";
                }
                 if(!empty($this->rechazos['skUserCreacion'])){
                    $sql .=" AND skUserCreacion like '%".$this->rechazos['skUserCreacion']."%'";
                }
                if(!empty($this->rechazos['skUserActualizacion'])){
                    $sql .=" AND skUserActualizacion like '%".$this->rechazos['skUserActualizacion']."%'";
                }
                if(!empty($this->rechazos['skStatus'])){
                    $sql .=" AND cat_rechazos.skStatus like '%".$this->rechazos['skStatus']."%'";
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
			public function read_equal_rechazos(){
                $sql = "SELECT cat_rechazos.*, _status.sName AS status, _status.sHtml AS htmlStatus, _users.sName AS UsuarioCreacion FROM cat_rechazos 
                	INNER JOIN _status ON _status.skStatus = cat_rechazos.skStatus 
                	INNER JOIN _users ON _users.skUsers = cat_rechazos.skUserCreacion 
                	WHERE 1=1 ";
                if(!empty($this->rechazos['skRechazo'])){
                    $sql .=" AND skRechazo = '".$this->rechazos['skRechazo']."'";
                }
                if(!empty($this->rechazos['sNombre'])){
                    $sql .=" AND sNombre = '".$this->rechazos['sNombre']."'";
                }
                 if(!empty($this->rechazos['skUserCreacion'])){
                    $sql .=" AND skUserCreacion like '%".$this->rechazos['skUserCreacion']."%'";
                }
                 if(!empty($this->rechazos['skUserActualizacion'])){
                    $sql .=" AND skUserActualizacion like '%".$this->rechazos['skUserActualizacion']."%'";
                }
                
                if(!empty($this->rechazos['skStatus'])){
                    $sql .=" AND cat_rechazos.skStatus = '".$this->rechazos['skStatus']."'";
                }
                if(is_int($this->rechazos['limit'])){
                    if(is_int($this->rechazos['offset'])){
                        $sql .= " LIMIT ".$this->rechazos['offset']." , ".$this->rechazos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->rechazos['limit'];
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
			public function read_like_rechazos(){
               $sql = "SELECT cat_rechazos.*, _status.sName AS status, _status.sHtml AS htmlStatus, _users.sName AS UsuarioCreacion FROM cat_rechazos 
                	INNER JOIN _status ON _status.skStatus = cat_rechazos.skStatus 
                	INNER JOIN _users ON _users.skUsers = cat_rechazos.skUserCreacion 
                	WHERE 1=1 ";
                if(!empty($this->rechazos['skRechazo'])){
                    $sql .=" AND skRechazo = '".$this->rechazos['skRechazo']."'";
                }
                if(!empty($this->rechazos['sNombre'])){
                    $sql .=" AND sNombre = '".$this->rechazos['sNombre']."'";
                }
                 if(!empty($this->rechazos['skUserCreacion'])){
                    $sql .=" AND skUserCreacion like '%".$this->rechazos['skUserCreacion']."%'";
                }
                 if(!empty($this->rechazos['skUserActualizacion'])){
                    $sql .=" AND skUserActualizacion like '%".$this->rechazos['skUserActualizacion']."%'";
                }
                
                if(!empty($this->rechazos['skStatus'])){
                    $sql .=" AND cat_rechazos.skStatus = '".$this->rechazos['skStatus']."'";
                }
                if(is_int($this->rechazos['limit'])){
                    if(is_int($this->rechazos['offset'])){
                        $sql .= " LIMIT ".$this->rechazos['offset']." , ".$this->rechazos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->rechazos['limit'];
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
			public function create_rechazos(){
                $sql = "INSERT INTO cat_rechazos (skRechazo,sNombre,skStatus,dFechaCreacion,skUserCreacion) VALUES ('".$this->rechazos['skRechazo']."','".$this->rechazos['sNombre']."','".$this->rechazos['skStatus']."',CURRENT_TIMESTAMP(),'".$_SESSION['session']['skUsers']."')";
                 
                $result = $this->db->query($sql);
                if($result){
                    return $this->rechazos['skRechazo'];
                }else{
                    return false;
                }
            }
			public function update_rechazos(){
                $sql = "UPDATE cat_rechazos SET ";
                if(!empty($this->rechazos['sNombre'])){
                    $sql .=" sNombre = '".$this->rechazos['sNombre']."' ,";
                }
                if(!empty($this->rechazos['skStatus'])){
                    $sql .=" skStatus = '".$this->rechazos['skStatus']."' ,";
                }
                $sql .= " skRechazo = '".$this->rechazos['skRechazo']."' WHERE skRechazo = '".$this->rechazos['skRechazo']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->rechazos['skRechazo'];
                }else{
                    return false;
                }
            }
			 /* COMIENZA MODULO  LAVA*/
			 
			  public function create_solreva_rechazos($valores) {
                    $sql = "INSERT INTO rel_solicitud_revalidaciones_rechazos (skSolicitudRevalidacion, skRechazo ) VALUES ".$valores."";
                    //echo  $sql."<br><br><br>";die();
					$result = $this->db->query($sql);
                    if($result){
                        return true;
                    }else{
                        return false;
                    }
                }
                
                 public function read_solreva_rechazos(){
					$sql = "SELECT * FROM rel_solicitud_revalidaciones_rechazos  WHERE 1=1 AND skSolicitudRevalidacion = '".$this->solreva['skSolicitudRevalidacion']."' ";
					
			    $result = $this->db->query($sql);
          		return $result;
            }
            
		   
		   
	}
?>
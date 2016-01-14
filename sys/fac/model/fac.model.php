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
			
            public function count_facdat(){
                $sql = "SELECT COUNT(*) AS total FROM ope_facturacion AS facdat WHERE 1=1 ";
                if(!is_null($this->facdat['skFacturacion'])){
                    $sql .=" AND facdat.skFacturacion = '".$this->facdat['skFacturacion']."'";
                }
                if(!is_null($this->facdat['sReferencia'])){
                    $sql .=" AND facdat.sReferencia like '%".$this->facdat['sReferencia']."%'";
                }
                if(!is_null($this->facdat['dFechaFacturacion'])){
                    $sql .=" AND facdat.dFechaFacturacion = '".$this->facdat['dFechaFacturacion']."'";
                }
                if(!is_null($this->facdat['sFolio'])){
                    $sql .=" AND facdat.sFolio like '%".$this->facdat['sFolio']."%'";
                }
                if(!is_null($this->facdat['fImporte'])){
                    $sql .=" AND facdat.fImporte like '%".$this->facdat['fImporte']."%'";
                }
                if(!is_null($this->facdat['fIva'])){
                    $sql .=" AND facdat.fIva like '%".$this->facdat['fIva']."%'";
                }
                if(!is_null($this->facdat['fTotalFacturado'])){
                    $sql .=" AND facdat.fTotalFacturado like '%".$this->facdat['fTotalFacturado']."%'";
                }
                if(!is_null($this->facdat['fGanancia'])){
                    $sql .=" AND facdat.fGanancia like '%".$this->facdat['fGanancia']."%'";
                }
                if(!is_null($this->facdat['fAA'])){
                    $sql .=" AND facdat.fAA like '%".$this->facdat['fAA']."%'";
                }
                if(!is_null($this->facdat['fPromotor1'])){
                    $sql .=" AND facdat.fPromotor1 like '%".$this->facdat['fPromotor1']."%'";
                }
                if(!is_null($this->facdat['fPromotor2'])){
                    $sql .=" AND facdat.fPromotor2 like '%".$this->facdat['fPromotor2']."%'";
                }
                if(!is_null($this->facdat['skUserCreacion'])){
                    $sql .=" AND facdat.skUserCreacion = '".$this->facdat['skUserCreacion']."'";
                }
                if(!is_null($this->facdat['dFechaCreacion'])){
                    $sql .=" AND facdat.dFechaCreacion = '".$this->facdat['dFechaCreacion']."'";
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
            
            public function read_facdat(){
                $sql = "SELECT 	facdat.*,
                FROM ope_facturacion AS facdat
                INNER JOIN ope_recepciones_documentos AS rd ON rd.sReferencia = facdat.sReferencia
                INNER JOIN _users AS usr ON usr.skUsers =  facdat.skUserCreacion
                WHERE 1=1 ";
                if(!is_null($this->facdat['skFacturacion'])){
                    $sql .=" AND facdat.skFacturacion = '".$this->facdat['skFacturacion']."'";
                }
                if(!is_null($this->facdat['sReferencia'])){
                    $sql .=" AND facdat.sReferencia like '%".$this->facdat['sReferencia']."%'";
                }
                if(!is_null($this->facdat['dFechaFacturacion'])){
                    $sql .=" AND facdat.dFechaFacturacion = '".$this->facdat['dFechaFacturacion']."'";
                }
                if(!is_null($this->facdat['sFolio'])){
                    $sql .=" AND facdat.sFolio like '%".$this->facdat['sFolio']."%'";
                }
                if(!is_null($this->facdat['fImporte'])){
                    $sql .=" AND facdat.fImporte like '%".$this->facdat['fImporte']."%'";
                }
                if(!is_null($this->facdat['fIva'])){
                    $sql .=" AND facdat.fIva like '%".$this->facdat['fIva']."%'";
                }
                if(!is_null($this->facdat['fTotalFacturado'])){
                    $sql .=" AND facdat.fTotalFacturado like '%".$this->facdat['fTotalFacturado']."%'";
                }
                if(!is_null($this->facdat['fGanancia'])){
                    $sql .=" AND facdat.fGanancia like '%".$this->facdat['fGanancia']."%'";
                }
                if(!is_null($this->facdat['fAA'])){
                    $sql .=" AND facdat.fAA like '%".$this->facdat['fAA']."%'";
                }
                if(!is_null($this->facdat['fPromotor1'])){
                    $sql .=" AND facdat.fPromotor1 like '%".$this->facdat['fPromotor1']."%'";
                }
                if(!is_null($this->facdat['fPromotor2'])){
                    $sql .=" AND facdat.fPromotor2 like '%".$this->facdat['fPromotor2']."%'";
                }
                if(!is_null($this->facdat['skUserCreacion'])){
                    $sql .=" AND facdat.skUserCreacion = '".$this->facdat['skUserCreacion']."'";
                }
                if(!is_null($this->facdat['dFechaCreacion'])){
                    $sql .=" AND facdat.dFechaCreacion = '".$this->facdat['dFechaCreacion']."'";
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
            
            public function create_facdat(){
                $sql = "INSERT INTO ope_facturacion 
                    (skFacturacion,sReferencia,dFechaFacturacion,sFolio,fImporte,fIva,fTotalFacturado,fGanancia,fAA,fPromotor1,fPromotor2,skUserCreacion,dFechaCreacion)
                    VALUES ( '".$this->facdat['skFacturacion']."',
                    '".$this->facdat['sReferencia']."',
                    '".$this->facdat['dFechaFacturacion']."',
                    '".$this->facdat['sFolio']."',
                    ".$this->facdat['fImporte'].",
                    ".$this->facdat['fIva'].",
                    ".$this->facdat['fTotalFacturado'].",
                    ".$this->facdat['fGanancia'].",
                    ".$this->facdat['fAA'].",
                    ".$this->facdat['fPromotor1'].",
                    ".$this->facdat['fPromotor2'].",
                    '".$_SESSION['session']['skUsers']."',
                    CURRENT_TIMESTAMP() )";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->facdat['skFacturacion'];
                }else{
                    return false;
                }
            }
             public function update_facdat(){
                $sql = "UPDATE ope_facturacion SET ";
                if(!is_null($this->facdat['sReferencia'])){
                    $sql.=" sReferencia = '".$this->facdat['sReferencia']."', ";
                }
                $sql .= " skFacturacion = '".$this->facdat['skFacturacion']."' WHERE skFacturacion = '".$this->facdat['skFacturacion']."'";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->facdat['skFacturacion'];
                }else{
                    return false;
                }
            }
            
            public function delete_facdat(){
                $sql = "UPDATE ope_facturacion SET skStatus = 'DE' WHERE skFacturacion IN (".implode(',',$this->facdat['skFacturacion']).")";
                //exit($sql);
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
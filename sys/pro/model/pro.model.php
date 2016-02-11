<?php
	Class Pro_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
            public $pro = array(
                'skProforma'=>null
                ,'sReferencia'=>null
                ,'sObservaciones'=>null
                ,'skUserCreacion'=>null
                ,'dFechaCreacion'=>null
                ,'skUserModificacion'=>null
                ,'dFechaModificacion'=>null
                ,'skStatus'=>null
                
                ,'skEmpresa'=>null

                ,'limit'=>null
                ,'offset'=>null
                ,'orderBy'=>null
                ,'sortBy'=>'DESC'
                );
            // PRIVATE VARIABLES //
            private $data = array();

            public function __construct(){
                parent::__construct();
            }
            public function __destruct(){

            }
			
            public function count_pro(){
                $sql = "SELECT COUNT(*) AS total FROM ope_proforma AS pro 
                INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = pro.sReferencia 
                INNER JOIN cat_empresas ce ON ce.skEmpresa = rd.skEmpresa WHERE 1=1 ";
                if(!is_null($this->pro['skProforma'])){
                    $sql .=" AND pro.skProforma = '".$this->pro['skProforma']."'";
                }
                if(!is_null($this->pro['sReferencia'])){
                    $sql .=" AND pro.sReferencia like '%".$this->pro['sReferencia']."%'";
                }
                if(!is_null($this->pro['sObservaciones'])){
                    $sql .=" AND pro.sObservaciones like '%".$this->pro['sObservaciones']."%'";
                }
                if(!is_null($this->pro['skUserCreacion'])){
                    $sql .=" AND pro.skUserCreacion = '".$this->pro['skUserCreacion']."'";
                }
                if(!is_null($this->pro['dFechaCreacion'])){
                    $sql .=" AND pro.dFechaCreacion = '".$this->pro['dFechaCreacion']."'";
                }
                if(!is_null($this->pro['skStatus'])){
                    $sql .=" AND pro.skStatus = '".$this->pro['skStatus']."'";
                }

                if(!is_null($this->pro['skEmpresa'])){
                    $sql .=" AND ce.skEmpresa = '".$this->pro['skEmpresa']."'";
                }

                if(!is_null($this->pro['orderBy'])){
                    $sql .=" ORDER BY ".$this->pro['orderBy']." ".$this->pro['sortBy'];
                }
                if(is_int($this->pro['limit'])){
                    if(is_int($this->pro['offset'])){
                        $sql .= " LIMIT ".$this->pro['offset']." , ".$this->pro['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->pro['limit'];
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
            
            public function read_pro(){
                //CONCAT(IF(usr.sName = null, '',usr.sName),' ',IF(usr.sLastNamePaternal = null, '',usr.sLastNamePaternal),' ',IF(usr.sLastNameMaternal = null, '',usr.sLastNameMaternal)) AS autor,
                $sql = "SELECT 	pro.*, ce.sNombre AS cliente,
                usr.sName AS autor,
                _status.sHtml AS htmlStatus
                FROM ope_proforma AS pro
                INNER JOIN ope_recepciones_documentos AS rd ON rd.sReferencia = pro.sReferencia
                INNER JOIN cat_empresas ce ON ce.skEmpresa = rd.skEmpresa
                INNER JOIN _users AS usr ON usr.skUsers =  pro.skUserCreacion
                INNER JOIN _status ON _status.skStatus = pro.skStatus
                WHERE 1=1 ";
                if(!is_null($this->pro['skProforma'])){
                    $sql .=" AND pro.skProforma = '".$this->pro['skProforma']."'";
                }
                if(!is_null($this->pro['sReferencia'])){
                    $sql .=" AND pro.sReferencia like '%".$this->pro['sReferencia']."%'";
                }
                if(!is_null($this->pro['sObservaciones'])){
                    $sql .=" AND pro.sObservaciones like '%".$this->pro['sObservaciones']."%'";
                }
                if(!is_null($this->pro['skUserCreacion'])){
                    $sql .=" AND pro.skUserCreacion = '".$this->pro['skUserCreacion']."'";
                }
                if(!is_null($this->pro['dFechaCreacion'])){
                    $sql .=" AND pro.dFechaCreacion = '".$this->pro['dFechaCreacion']."'";
                }
                if(!is_null($this->pro['skStatus'])){
                    $sql .=" AND pro.skStatus = '".$this->pro['skStatus']."'";
                }

                if(!is_null($this->pro['skEmpresa'])){
                    $sql .=" AND ce.skEmpresa = '".$this->pro['skEmpresa']."'";
                }

                if(!is_null($this->pro['orderBy'])){
                    $sql .=" ORDER BY ".$this->pro['orderBy']." ".$this->pro['sortBy'];
                }
                if(is_int($this->pro['limit'])){
                    if(is_int($this->pro['offset'])){
                        $sql .= " LIMIT ".$this->pro['offset']." , ".$this->pro['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->pro['limit'];
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
            
            public function create_pro(){
                $sql = "INSERT INTO ope_proforma 
                    (skProforma,sReferencia,sObservaciones,skUserCreacion,dFechaCreacion)
                    VALUES ( '".$this->pro['skProforma']."',
                    '".$this->pro['sReferencia']."',
                    '".$this->pro['sObservaciones']."',
                    '".$_SESSION['session']['skUsers']."',
                    CURRENT_TIMESTAMP() )";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->pro['skProforma'];
                }else{
                    return false;
                }
            }

             public function update_pro(){
                $sql = "UPDATE ope_proforma SET ";
                if(!is_null($this->pro['sReferencia'])){
                    $sql.=" sReferencia = '".$this->pro['sReferencia']."', ";
                }
                if(!is_null($this->pro['sObservaciones'])){
                    $sql.=" skUserCreacion = sObservaciones = '".$this->pro['sObservaciones']."', ";
                }
                $sql .= " skUserCreacion = '".$_SESSION['session']['skUsers']."' , dFechaModificacion = CURRENT_TIMESTAMP() WHERE skProforma = '".$this->pro['skProforma']."'";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->pro['skProforma'];
                }else{
                    return false;
                }
            }
            
            public function delete_pro(){
                $sql = "UPDATE ope_proforma SET skStatus = 'DE' WHERE skProforma = '".$this->pro['skProforma']."'";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            
            public function read_referencia(){
                $sql = "SELECT 	rd.*, 
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
 
	}
?>
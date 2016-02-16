<?php
	Class glo_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
            public $glo = array(
                'skGlosa'=>null
                ,'sReferencia'=>null
                ,'sObservacionesPedimento'=>null
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

            public $gloPart = array(
                'skGlosa'=>null
                ,'skClasificacionMercancia'=>null
                ,'sObservacionesPartida'=>null
                ,'iSecuencia'=>null
                ,'limit'=>null
                ,'offset'=>null
                ,'orderBy'=>null
                ,'sortBy'=>'DESC'
            );

            public $gloDocGlo = array(
                'skGlosa'=>null
                ,'skDocGlosa'=>null

                ,'limit'=>null
                ,'offset'=>null
                ,'orderBy'=>null
                ,'sortBy'=>'DESC'
            );

            public $docGlo = array(
                 'skDocGlosa'=>null
                ,'skParent'=>null
                ,'sNombre'=>null
                ,'skStatus'=>null
                ,'skUserCreacion'=>null
                ,'dFechaCreacion'=>null
                ,'skUserModificacion'=>null
                ,'dFechaModificacion'=>null
                ,'skStatus'=>null
                ,'iPosition'=>null

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
			
            /* COMIENZA cat_docGlosa => docGlo */
            public function read_docGlo(){
                $sql="SELECT docGlo.* FROM cat_docGlosa AS docGlo WHERE skStatus = 'AC' ";
                if(!is_null($this->docGlo['skParent'])){
                    $sql .=" AND docGlo.skParent = '".$this->docGlo['skParent']."'";
                }else{
                    $sql .=" AND docGlo.skParent IS NULL ";
                }
                
                if(!is_null($this->docGlo['orderBy'])){
                    $sql .=" ORDER BY ".$this->docGlo['orderBy']." ".$this->docGlo['sortBy'];
                }
                if(is_int($this->docGlo['limit'])){
                    if(is_int($this->docGlo['offset'])){
                        $sql .= " LIMIT ".$this->docGlo['offset']." , ".$this->docGlo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->docGlo['limit'];
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

            public function delete_docGlo(){
                $sql = "UPDATE cat_docGlosa SET skStatus = 'DE' WHERE skDocGlosa = '".$this->docGlo['skDocGlosa']."' LIMIT 1 ";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            /* TERMINA cat_docGlosa => docGlo */

            /* COMIENZA rel_glosa_partidas => gloPart */
            public function read_gloPart(){
                $sql="SELECT gloPart.* FROM rel_glosa_partidas AS gloPart 
                LEFT JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacionMercancia = gloPart.skClasificacionMercancia
                WHERE skGlosa = '".$this->gloPart['skGlosa']."' ";
                if(!is_null($this->gloPart['skClasificacionMercancia'])){
                    $sql .=" AND gloPart.skClasificacionMercancia = '".$this->gloPart['skClasificacionMercancia']."'";
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

            public function delete_gloPart(){
                $sql = "DELETE FROM rel_glosa_partidas WHERE skGlosa = '".$this->gloPart['skGlosa']."' ";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            public function create_gloPart(){
                $sql = "INSERT INTO rel_glosa_partidas 
                    (skGlosa,skClasificacionMercancia,iSecuencia,sObservacionesPartida)
                    VALUES ( '".$this->gloPart['skGlosa']."',
                    '".$this->gloPart['skClasificacionMercancia']."',
                    '".$this->gloPart['iSecuencia']."',
                    '".$this->gloPart['sObservacionesPartida']."')";
				//echo $sql;
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->gloPart['skGlosa'];
                }else{
                    return false;
                }
            }
            /* TERMINA rel_glosa_partidas => gloPart */

            /* COMIENZA rel_glosa_docGlosa => gloDocGlo */
            public function read_gloDocGlo(){
                $sql="SELECT gloDocGlo.* FROM rel_glosa_docGlosa AS gloDocGlo WHERE skGlosa = '".$this->gloDocGlo['skGlosa']."' ";
                if(!is_null($this->gloDocGlo['skDocGlosa'])){
                    $sql .=" AND gloDocGlo.skDocGlosa = '".$this->gloDocGlo['skDocGlosa']."'";
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

            public function delete_gloDocGlo(){
                $sql = "DELETE FROM rel_glosa_docGlosa WHERE skGlosa = '".$this->gloDocGlo['skGlosa']."' ";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            public function create_gloDocGlo(){
                $sql = "INSERT INTO rel_glosa_docGlosa 
                    (skGlosa,skDocGlosa)
                    VALUES ( '".$this->gloDocGlo['skGlosa']."',
                    '".$this->gloDocGlo['skDocGlosa']."')";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->gloDocGlo['skGlosa'];
                }else{
                    return false;
                }
            }
            /* TERMINA rel_glosa_docGlosa => gloDocGlo */

            /* COMIENZA ope_glosa => glo */
            public function count_glo(){
                $sql = "SELECT COUNT(*) AS total FROM ope_glosa AS glo 
                INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = glo.sReferencia 
                INNER JOIN cat_empresas ce ON ce.skEmpresa = rd.skEmpresa WHERE 1=1 ";
                if(!is_null($this->glo['skGlosa'])){
                    $sql .=" AND glo.skGlosa = '".$this->glo['skGlosa']."'";
                }
                if(!is_null($this->glo['sReferencia'])){
                    $sql .=" AND glo.sReferencia like '%".$this->glo['sReferencia']."%'";
                }
                if(!is_null($this->glo['sObservacionesPedimento'])){
                    $sql .=" AND glo.sObservacionesPedimento like '%".$this->glo['sObservacionesPedimento']."%'";
                }
                if(!is_null($this->glo['skUserCreacion'])){
                    $sql .=" AND glo.skUserCreacion = '".$this->glo['skUserCreacion']."'";
                }
                if(!is_null($this->glo['dFechaCreacion'])){
                    $sql .=" AND glo.dFechaCreacion = '".$this->glo['dFechaCreacion']."'";
                }
                if(!is_null($this->glo['skStatus'])){
                    $sql .=" AND glo.skStatus = '".$this->glo['skStatus']."'";
                }

                if(!is_null($this->glo['skEmpresa'])){
                    $sql .=" AND ce.skEmpresa = '".$this->glo['skEmpresa']."'";
                }

                if(!is_null($this->glo['orderBy'])){
                    $sql .=" ORDER BY ".$this->glo['orderBy']." ".$this->glo['sortBy'];
                }
                if(is_int($this->glo['limit'])){
                    if(is_int($this->glo['offset'])){
                        $sql .= " LIMIT ".$this->glo['offset']." , ".$this->glo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->glo['limit'];
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
            
            public function read_glo(){
                $sql = "SELECT 	glo.*, ce.sNombre AS cliente,
                usr.sName AS autor,
                _status.sHtml AS htmlStatus
                FROM ope_glosa AS glo
                INNER JOIN ope_recepciones_documentos AS rd ON rd.sReferencia = glo.sReferencia
                INNER JOIN cat_empresas ce ON ce.skEmpresa = rd.skEmpresa
                INNER JOIN _users AS usr ON usr.skUsers =  glo.skUserCreacion
                INNER JOIN _status ON _status.skStatus = glo.skStatus
                WHERE 1=1 ";
                if(!is_null($this->glo['skGlosa'])){
                    $sql .=" AND glo.skGlosa = '".$this->glo['skGlosa']."'";
                }
                if(!is_null($this->glo['sReferencia'])){
                    $sql .=" AND glo.sReferencia like '%".$this->glo['sReferencia']."%'";
                }
                if(!is_null($this->glo['sObservacionesPedimento'])){
                    $sql .=" AND glo.sObservacionesPedimento like '%".$this->glo['sObservacionesPedimento']."%'";
                }
                if(!is_null($this->glo['skUserCreacion'])){
                    $sql .=" AND glo.skUserCreacion = '".$this->glo['skUserCreacion']."'";
                }
                if(!is_null($this->glo['dFechaCreacion'])){
                    $sql .=" AND glo.dFechaCreacion = '".$this->glo['dFechaCreacion']."'";
                }
                if(!is_null($this->glo['skStatus'])){
                    $sql .=" AND glo.skStatus = '".$this->glo['skStatus']."'";
                }

                if(!is_null($this->glo['skEmpresa'])){
                    $sql .=" AND ce.skEmpresa = '".$this->glo['skEmpresa']."'";
                }

                if(!is_null($this->glo['orderBy'])){
                    $sql .=" ORDER BY ".$this->glo['orderBy']." ".$this->glo['sortBy'];
                }
                if(is_int($this->glo['limit'])){
                    if(is_int($this->glo['offset'])){
                        $sql .= " LIMIT ".$this->glo['offset']." , ".$this->glo['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->glo['limit'];
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
            
            public function create_glo(){
                $sql = "INSERT INTO ope_glosa 
                    (skGlosa,sReferencia,sObservacionesPedimento,skUserCreacion,dFechaCreacion)
                    VALUES ( '".$this->glo['skGlosa']."',
                    '".$this->glo['sReferencia']."',
                    '".$this->glo['sObservacionesPedimento']."',
                    '".$_SESSION['session']['skUsers']."',
                    CURRENT_TIMESTAMP() )";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->glo['skGlosa'];
                }else{
                    return false;
                }
            }

             public function update_glo(){
                $sql = "UPDATE ope_glosa SET ";
                if(!is_null($this->glo['sReferencia'])){
                    $sql.=" sReferencia = '".$this->glo['sReferencia']."', ";
                }
                if(!is_null($this->glo['sObservacionesPedimento'])){
                    $sql.=" sObservacionesPedimento = '".$this->glo['sObservacionesPedimento']."', ";
                }
                $sql .= " skUserModificacion = '".$_SESSION['session']['skUsers']."' , dFechaModificacion = CURRENT_TIMESTAMP() WHERE skGlosa = '".$this->glo['skGlosa']."'";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->glo['skGlosa'];
                }else{
                    return false;
                }
            }
            
            public function delete_glo(){
                $sql = "UPDATE ope_glosa SET skStatus = 'DE' WHERE skGlosa = '".$this->glo['skGlosa']."'";
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
                    st.sHtml,
                    cla.skClasificacion
                    FROM ope_recepciones_documentos rd 
                    INNER JOIN _status  st ON st.skStatus = rd.skStatus 
                    INNER JOIN cat_empresas  ce ON ce.skEmpresa = rd.skEmpresa 
                    INNER JOIN cat_tipos_tramites  ctt ON ctt.skTipoTramite = rd.skTipoTramite 
                    INNER JOIN cat_tipos_servicios  cts ON cts.skTipoServicio = rd.skTipoServicio 
                    INNER JOIN cat_claves_documentos  ccd ON ccd.skClaveDocumento = rd.skClaveDocumento 
                    INNER JOIN _users us ON us.skUsers = rd.skUsersCreacion
                    INNER JOIN _status ON _status.skStatus = rd.skStatus
                    INNER JOIN cat_clasificacion cla ON cla.sReferencia = rd.sReferencia
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
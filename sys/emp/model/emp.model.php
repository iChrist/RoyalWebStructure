<?php
	 Class Emp_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $areas = array(
                    'skAreas'       =>  ''
                    ,'sNombre'       =>  ''
                    ,'sTitulo'       =>  ''
                    ,'skStatus'     =>  ''
                    ,'limit'        =>  ''
                    ,'offset'       =>  ''
                );

                public $promotores = array(
                    'skPromotores'       =>  ''
                    ,'sNombre'       =>  ''
                    ,'sCorreo'       =>  ''
                    ,'skStatus'     =>  ''
                    ,'limit'        =>  ''
                    ,'offset'       =>  ''
                );
                
                public $departamentos = array(
                    'skDepartamento'       =>  ''
                    ,'sNombre'       =>  ''
                     ,'skStatus'     =>  ''
                    ,'limit'        =>  ''
                    ,'offset'       =>  ''
                );
                public $tipoempresas = array(
                    'skTipoEmpresa'       =>  ''
                    ,'sNombre'       =>  ''
                     ,'skStatus'     =>  ''
                    ,'limit'        =>  ''
                    ,'offset'       =>  ''
                );
                public $empresas = array(
                    'skEmpresa'       =>  ''
                    ,'skEmpresaDistinta'       =>  ''
                    ,'sNombreCorto'       =>  ''
                    ,'sRFC'       =>  ''
                    ,'sNombre'       =>  ''
                    ,'skCorresponsalia'       =>  ''
                    ,'skPromotor1'       =>  ''
                    ,'skPromotor2'       =>  ''
                    ,'skStatus'     =>  ''
                    ,'limit'        =>  ''
                    ,'offset'       =>  ''
                );
                
                    
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
            
            /* COMIENZA MODULO areas */
            public function count_areas(){
                $sql = "SELECT COUNT(*) AS total FROM areas WHERE 1=1 ";
                if(!empty($this->areas['skAreas'])){
                    $sql .=" AND skAreas = '".$this->areas['skAreas']."'";
                }
                if(!empty($this->areas['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->areas['sNombre']."%'";
                }
                if(!empty($this->areas['sTitulo'])){
                    $sql .=" AND sTitulo like '%".$this->areas['sTitulo']."%'";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" AND areas.skStatus like '%".$this->areas['skStatus']."%'";
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
            
            public function read_equal_areas(){
                $sql = "SELECT areas.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM areas INNER JOIN _status ON _status.skStatus = areas.skStatus WHERE 1=1 ";
                if(!empty($this->areas['skAreas'])){
                    $sql .=" AND skAreas = '".$this->areas['skAreas']."'";
                }
                if(!empty($this->areas['sNombre'])){
                    $sql .=" AND sNombre = '".$this->areas['sNombre']."'";
                }
                if(!empty($this->areas['sTitulo'])){
                    $sql .=" AND sTitulo = '".$this->areas['sTitulo']."'";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" AND areas.skStatus = '".$this->areas['skStatus']."'";
                }
                if(is_int($this->areas['limit'])){
                    if(is_int($this->areas['offset'])){
                        $sql .= " LIMIT ".$this->areas['offset']." , ".$this->areas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->areas['limit'];
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
            
            public function read_like_areas(){
                $sql = "SELECT areas.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM areas INNER JOIN _status ON _status.skStatus = areas.skStatus WHERE 1=1 ";
                if(!empty($this->areas['skAreas'])){
                    $sql .=" AND skAreas = '".$this->areas['skAreas']."'";
                }
                if(!empty($this->areas['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->areas['sNombre']."%'";
                }
                if(!empty($this->areas['sTitulo'])){
                    $sql .=" AND sTitulo like '%".$this->areas['sTitulo']."%'";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" AND areas.skStatus like '%".$this->areas['skStatus']."%'";
                }
                if(is_int($this->areas['limit'])){
                    if(is_int($this->areas['offset'])){
                        $sql .= " LIMIT ".$this->areas['offset']." , ".$this->areas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->areas['limit'];
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
            
            public function create_areas(){
                $sql = "INSERT INTO areas (skAreas,sNombre,sTitulo,skStatus) VALUES ('".$this->areas['skAreas']."','".$this->areas['sNombre']."','".$this->areas['sTitulo']."','".$this->areas['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->areas['skAreas'];
                }else{
                    return false;
                }
            }
            
            public function update_areas(){
                $sql = "UPDATE areas SET ";
                if(!empty($this->areas['sNombre'])){
                    $sql .=" sNombre = '".$this->areas['sNombre']."' ,";
                }
                if(!empty($this->areas['sTitulo'])){
                    $sql .=" sTitulo = '".$this->areas['sTitulo']."' ,";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" skStatus = '".$this->areas['skStatus']."' ,";
                }
                $sql .= " skAreas = '".$this->areas['skAreas']."' WHERE skAreas = '".$this->areas['skAreas']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->areas['skAreas'];
                }else{
                    return false;
                }
            }
            
            public function delete_areas(){
                $sql = "UPDATE areas SET skStatus = 'DE' WHERE skAreas = '".$this->areas['skAreas']."' LIMIT 1 ";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            /* TERMINA MODULO areas */

            /* COMIENZA MODULO promotores */
            public function count_promotores(){
                $sql = "SELECT COUNT(*) AS total FROM cat_promotores WHERE 1=1 ";
                if(!empty($this->promotores['skPromotores'])){
                    $sql .=" AND cat_promotores.skPromotores = '".$this->promotores['skPromotores']."'";
                }
                if(!empty($this->promotores['sNombre'])){
                    $sql .=" AND cat_promotores.sNombre like '%".$this->promotores['sNombre']."%'";
                }
                if(!empty($this->promotores['sCorreo'])){
                    $sql .=" AND cat_promotores.sCorreo like '%".$this->promotores['sCorreo']."%'";
                }
                if(!empty($this->promotores['skStatus'])){
                    $sql .=" AND cat_promotores.skStatus like '%".$this->promotores['skStatus']."%'";
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
            public function read_equal_promotores(){
                $sql = "SELECT cat_promotores.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_promotores INNER JOIN _status ON _status.skStatus = cat_promotores.skStatus WHERE 1=1 ";
                if(!empty($this->promotores['skPromotores'])){
                    $sql .=" AND cat_promotores.skPromotores = '".$this->promotores['skPromotores']."'";
                }
                if(!empty($this->promotores['sNombre'])){
                    $sql .=" AND cat_promotores.sNombre = '".$this->promotores['sNombre']."'";
                }
                if(!empty($this->promotores['sCorreo'])){
                    $sql .=" AND cat_promotores.sCorreo = '".$this->promotores['sCorreo']."'";
                }
                if(!empty($this->promotores['skStatus'])){
                    $sql .=" AND cat_promotores.skStatus = '".$this->promotores['skStatus']."'";
                }
                if(is_int($this->promotores['limit'])){
                    if(is_int($this->promotores['offset'])){
                        $sql .= " LIMIT ".$this->promotores['offset']." , ".$this->promotores['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->promotores['limit'];
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
            public function read_like_promotores(){
                $sql = "SELECT cat_promotores.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_promotores INNER JOIN _status ON _status.skStatus = cat_promotores.skStatus WHERE 1=1 ";
                if(!empty($this->promotores['skPromotores'])){
                    $sql .=" AND cat_promotores.skPromotores = '".$this->promotores['skPromotores']."'";
                }
                if(!empty($this->promotores['sNombre'])){
                    $sql .=" AND cat_promotores.sNombre like '%".$this->promotores['sNombre']."%'";
                }
                if(!empty($this->promotores['sCorreo'])){
                    $sql .=" AND cat_promotores.sCorreo like '%".$this->promotores['sCorreo']."%'";
                }
                if(!empty($this->promotores['skStatus'])){
                    $sql .=" AND cat_promotores.skStatus like '%".$this->promotores['skStatus']."%'";
                }
                if(is_int($this->promotores['limit'])){
                    if(is_int($this->promotores['offset'])){
                        $sql .= " LIMIT ".$this->promotores['offset']." , ".$this->promotores['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->promotores['limit'];
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
            public function create_promotores(){
                $sql = "INSERT INTO cat_promotores (skPromotores,sNombre,sCorreo,skStatus) VALUES ('".$this->promotores['skPromotores']."','".$this->promotores['sNombre']."','".$this->promotores['sCorreo']."','".$this->promotores['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->promotores['skPromotores'];
                }else{
                    return false;
                }
            }
            
            public function update_promotores(){
                $sql = "UPDATE cat_promotores SET ";
                if(!empty($this->promotores['sNombre'])){
                    $sql .=" sNombre = '".$this->promotores['sNombre']."' ,";
                }
                if(!empty($this->promotores['sCorreo'])){
                    $sql .=" sCorreo = '".$this->promotores['sCorreo']."' ,";
                }
                if(!empty($this->promotores['skStatus'])){
                    $sql .=" skStatus = '".$this->promotores['skStatus']."' ,";
                }
                $sql .= " skPromotores = '".$this->promotores['skPromotores']."' WHERE skPromotores = '".$this->promotores['skPromotores']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->promotores['skPromotores'];
                }else{
                    return false;
                }
            }
            /* TERMINA MODULO promotores */
            
            /*EMPIEZA MODULO DE DEPARTAMENTOS*/
            public function create_departamentos(){
                $sql = "INSERT INTO cat_departamentos (skDepartamento,sNombre,skStatus) VALUES ('".$this->departamentos['skDepartamento']."','".$this->departamentos['sNombre']."','".$this->departamentos['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->departamentos['skDepartamento'];
                }else{
                    return false;
                }
            }
            public function update_departamentos(){
                $sql = "UPDATE cat_departamentos SET ";
                if(!empty($this->departamentos['sNombre'])){
                    $sql .=" sNombre = '".$this->departamentos['sNombre']."' ,";
                }
                
                if(!empty($this->departamentos['skStatus'])){
                    $sql .=" skStatus = '".$this->departamentos['skStatus']."' ";
                }
                $sql .= " WHERE skDepartamento = '".$this->departamentos['skDepartamento']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->departamentos['skDepartamento'];
                }else{
                    return false;
                }
            }
            public function count_departamentos(){
                $sql = "SELECT COUNT(*) AS total FROM cat_departamentos WHERE 1=1 ";
                if(!empty($this->departamentos['skDepartamento'])){
                    $sql .=" AND skDepartamento = '".$this->departamentos['skDepartamento']."'";
                }
                if(!empty($this->departamentos['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->departamentos['sNombre']."%'";
                }
               
                if(!empty($this->departamentos['skStatus'])){
                    $sql .=" AND cat_departamentos.skStatus like '%".$this->departamentos['skStatus']."%'";
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
            public function read_equal_departamentos(){
                $sql = "SELECT cat_departamentos.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_departamentos INNER JOIN _status ON _status.skStatus = cat_departamentos.skStatus WHERE 1=1 ";
                if(!empty($this->departamentos['skDepartamento'])){
                    $sql .=" AND skDepartamento = '".$this->departamentos['skDepartamento']."'";
                }
                if(!empty($this->departamentos['sNombre'])){
                    $sql .=" AND sNombre = '".$this->departamentos['sNombre']."'";
                }
             
                if(!empty($this->departamentos['skStatus'])){
                    $sql .=" AND cat_departamentos.skStatus = '".$this->departamentos['skStatus']."'";
                }
                if(is_int($this->departamentos['limit'])){
                    if(is_int($this->departamentos['offset'])){
                        $sql .= " LIMIT ".$this->departamentos['offset']." , ".$this->departamentos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->departamentos['limit'];
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
            public function read_like_departamentos(){
                $sql = "SELECT cat_departamentos.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_departamentos INNER JOIN _status ON _status.skStatus = cat_departamentos.skStatus WHERE 1=1 ";
                if(!empty($this->departamentos['skDepartamento'])){
                    $sql .=" AND skDepartamento = '".$this->departamentos['skDepartamento']."'";
                }
                if(!empty($this->departamentos['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->departamentos['sNombre']."%'";
                }
                 if(!empty($this->departamentos['skStatus'])){
                    $sql .=" AND cat_departamentos.skStatus like '%".$this->departamentos['skStatus']."%'";
                }
                if(is_int($this->departamentos['limit'])){
                    if(is_int($this->departamentos['offset'])){
                        $sql .= " LIMIT ".$this->departamentos['offset']." , ".$this->departamentos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->departamentos['limit'];
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
             /* TERMINA MODULO DE DEPARTAMENTOS*/
             
            /* EMPIEZA MODULO DE TIPOS DE EMPRESAS*/ 
            public function count_tipoempresas(){
                $sql = "SELECT COUNT(*) AS total FROM cat_tipos_empresas WHERE 1=1 ";
                if(!empty($this->tipoempresas['skTipoEmpresa'])){
                    $sql .=" AND skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."'";
                }
                if(!empty($this->tipoempresas['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->tipoempresas['sNombre']."%'";
                }
               
                if(!empty($this->tipoempresas['skStatus'])){
                    $sql .=" AND cat_tipos_empresas.skStatus like '%".$this->tipoempresas['skStatus']."%'";
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
            public function read_equal_tipoempresas(){
                $sql = "SELECT cat_tipos_empresas.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_tipos_empresas INNER JOIN _status ON _status.skStatus = cat_tipos_empresas.skStatus WHERE 1=1 ";
                if(!empty($this->tipoempresas['skTipoEmpresa'])){
                    $sql .=" AND skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."'";
                }
                if(!empty($this->tipoempresas['sNombre'])){
                    $sql .=" AND sNombre = '".$this->tipoempresas['sNombre']."'";
                }
             
                if(!empty($this->tipoempresas['skStatus'])){
                    $sql .=" AND cat_tipos_empresas.skStatus = '".$this->tipoempresas['skStatus']."'";
                }
                if(is_int($this->tipoempresas['limit'])){
                    if(is_int($this->tipoempresas['offset'])){
                        $sql .= " LIMIT ".$this->tipoempresas['offset']." , ".$this->tipoempresas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->tipoempresas['limit'];
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
            public function read_like_tipoempresas(){
                $sql = "SELECT cat_tipos_empresas.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_tipos_empresas INNER JOIN _status ON _status.skStatus = cat_tipos_empresas.skStatus WHERE 1=1 ";
                if(!empty($this->tipoempresas['skTipoEmpresa'])){
                    $sql .=" AND skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."'";
                }
                if(!empty($this->tipoempresas['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->tipoempresas['sNombre']."%'";
                }
                 if(!empty($this->tipoempresas['skStatus'])){
                    $sql .=" AND cat_tipos_empresas.skStatus like '%".$this->tipoempresas['skStatus']."%'";
                }
                if(is_int($this->tipoempresas['limit'])){
                    if(is_int($this->tipoempresas['offset'])){
                        $sql .= " LIMIT ".$this->tipoempresas['offset']." , ".$this->tipoempresas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->tipoempresas['limit'];
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
            public function create_tipoempresas(){
                $sql = "INSERT INTO cat_tipos_empresas (skTipoEmpresa,sNombre,skStatus) VALUES ('".$this->tipoempresas['skTipoEmpresa']."','".$this->tipoempresas['sNombre']."','".$this->tipoempresas['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->tipoempresas['skTipoEmpresa'];
                }else{
                    return false;
                }
            }
            public function update_tipoempresas(){
                $sql = "UPDATE cat_tipos_empresas SET ";
                if(!empty($this->tipoempresas['sNombre'])){
                    $sql .=" sNombre = '".$this->tipoempresas['sNombre']."' ,";
                }
                
                if(!empty($this->tipoempresas['skStatus'])){
                    $sql .=" skStatus = '".$this->tipoempresas['skStatus']."' ,";
                }
                $sql .= " skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."' WHERE skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->tipoempresas['skTipoEmpresa'];
                }else{
                    return false;
                }
            }
             /* TERMINA MODULO DE TIPOS DE EMPRESAS*/ 
             
             
             
              public function count_empresas(){
                $sql = "SELECT COUNT(*) AS total FROM cat_empresas WHERE 1=1 ";
                if(!empty($this->empresas['skEmpresa'])){
                    $sql .=" AND skEmpresa = '".$this->empresas['skEmpresa']."'";
                }
                if(!empty($this->empresas['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->empresas['sNombre']."%'";
                }
                if(!empty($this->empresas['sNombreCorto'])){
                    $sql .=" AND sNombreCorto like '%".$this->empresas['sNombreCorto']."%'";
                }
                if(!empty($this->empresas['sRFC'])){
                    $sql .=" AND sRFC like '%".$this->empresas['sRFC']."%'";
                }
                if(!empty($this->empresas['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->empresas['skCorresponsalia']."'";
                }
                if(!empty($this->empresas['skPromotor1'])){
                    $sql .=" AND (skPromotor1 = '".$this->empresas['skPromotor1']."' OR skPromotor2 = '".$this->empresas['skPromotor2']."')";
                }
                if(!empty($this->empresas['skStatus'])){
                    $sql .=" AND cat_empresas.skStatus like '%".$this->empresas['skStatus']."%'";
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
              public function read_equal_empresas(){
                $sql = "SELECT cat_empresas.*,rel_cat_empresas_cat_tipos_empresas.skTipoEmpresa, _status.sName AS status, _status.sHtml AS htmlStatus 
                	FROM cat_empresas 
                	INNER JOIN _status ON _status.skStatus = cat_empresas.skStatus 
                	LEFT JOIN rel_cat_empresas_cat_tipos_empresas ON rel_cat_empresas_cat_tipos_empresas.skEmpresa = cat_empresas.skEmpresa 
                	WHERE 1=1 ";
                if(!empty($this->empresas['skEmpresa'])){
                    $sql .=" AND cat_empresas.skEmpresa = '".$this->empresas['skEmpresa']."'";
                }
                if(!empty($this->empresas['sNombre'])){
                    $sql .=" AND sNombre = '".$this->empresas['sNombre']."'";
                }
                if(!empty($this->empresas['sNombreCorto'])){
                    $sql .=" AND sNombreCorto = '".$this->empresas['sNombreCorto']."'";
                }
                if(!empty($this->empresas['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->empresas['skCorresponsalia']."'";
                }
                if(!empty($this->empresas['skPromotor1'])){
                    $sql .=" AND (cat_empresas.skPromotor1 = '".$this->empresas['skPromotor1']."' OR cat_empresas.skPromotor2 = '".$this->empresas['skPromotor2']."')";
                }
                if(!empty($this->empresas['skStatus'])){
                    $sql .=" AND cat_empresas.skStatus = '".$this->empresas['skStatus']."'";
                }
                if(is_int($this->empresas['limit'])){
                    if(is_int($this->empresas['offset'])){
                        $sql .= " LIMIT ".$this->empresas['offset']." , ".$this->empresas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->empresas['limit'];
                    }
                }
               // echo($sql);
                
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
              public function read_like_empresas(){
                $sql = "SELECT
                ce.*,  st.sName AS STATUS,
                st.sHtml AS htmlStatus,
                cte.sNombre AS tipoEmpresa,
                catEmp.sNombre AS corresponsalia,
                promo1.sNombre AS promotor1,
                promo2.sNombre AS promotor2
                FROM
                cat_empresas ce
                LEFT JOIN _status st ON  st.skStatus = ce.skStatus
                LEFT JOIN cat_empresas catEmp ON  catEmp.skEmpresa = ce.skCorresponsalia
                LEFT JOIN cat_promotores promo1 ON  promo1.skPromotores = ce.skPromotor1
                LEFT JOIN cat_promotores promo2 ON  promo2.skPromotores = ce.skPromotor2
                LEFT JOIN rel_cat_empresas_cat_tipos_empresas  rce ON rce.skEmpresa = ce.skEmpresa
                LEFT JOIN cat_tipos_empresas cte ON cte.skTipoEmpresa = rce.skTipoEmpresa WHERE 1=1 ";
                
                if(!empty($this->empresas['skEmpresa'])){
                    $sql .=" AND ce.skEmpresa = '".$this->empresas['skEmpresa']."'";
                }
                if(!empty($this->empresas['sNombre'])){
                    $sql .=" AND ce.sNombre like '%".$this->empresas['sNombre']."%'";
                }
                 if(!empty($this->empresas['sNombreCorto'])){
                    $sql .=" AND ce.sNombreCorto like '%".$this->empresas['sNombreCorto']."%'";
                }
                if(!empty($this->empresas['sRFC'])){
                    $sql .=" AND ce.sRFC like '%".$this->empresas['sRFC']."%'";
                }
                if(!empty($this->empresas['skCorresponsalia'])){
                    $sql .=" AND ce.skCorresponsalia = '".$this->empresas['skCorresponsalia']."'";
                }
                if(!empty($this->empresas['skPromotor1'])){
                    $sql .=" AND (ce.skPromotor1 = '".$this->empresas['skPromotor1']."' OR ce.skPromotor2 = '".$this->empresas['skPromotor2']."')";
                }
                if(!empty($this->empresas['skStatus'])){
                    $sql .=" AND ce.skStatus like '%".$this->empresas['skStatus']."%'";
                }
                 if(!empty($this->tipoempresas['skTipoEmpresa'])){
                    $sql .=" AND rce.skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."'";
                }
                $sql .=" ORDER BY ce.sNombre ASC ";
                if(is_int($this->empresas['limit'])){
                    if(is_int($this->empresas['offset'])){
                        $sql .= " LIMIT ".$this->empresas['offset']." , ".$this->empresas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->empresas['limit'];
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
              public function create_empresas(){
                $sql = "INSERT INTO cat_empresas (skEmpresa,sNombre,sNombreCorto,sRFC,skStatus, dFechaCreacion,skCorresponsalia,skPromotor1,skPromotor2) VALUES ('".$this->empresas['skEmpresa']."','".$this->empresas['sNombre']."','".$this->empresas['sNombreCorto']."','".$this->empresas['sRFC']."','".$this->empresas['skStatus']."', CURRENT_TIMESTAMP(),'".$this->empresas['skCorresponsalia']."','".$this->empresas['skPromotor1']."','".$this->empresas['skPromotor2']."')";
                //echo $sql;
                //die();
                $result = $this->db->query($sql);
                $sql="INSERT INTO rel_cat_empresas_cat_tipos_empresas(skEmpresa,skTipoEmpresa) VALUES('".$this->empresas['skEmpresa']."','".$this->tipoempresas['skTipoEmpresa']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->empresas['skEmpresa'];
                }else{
                    return false;
                }
                
            }
            
              public function update_empresas(){
              	$sql="UPDATE rel_cat_empresas_cat_tipos_empresas SET skTipoEmpresa = '".$this->tipoempresas['skTipoEmpresa']."' WHERE skEmpresa = '".$this->empresas['skEmpresa']."' ";
              	$this->db->query($sql);
                $sql = "UPDATE cat_empresas  SET ";
                if(!is_null($this->empresas['sNombre'])){
                    $sql .=" sNombre = '".$this->empresas['sNombre']."' ,";
                }
                if(!is_null($this->empresas['sNombreCorto'])){
                    $sql .=" sNombreCorto = '".$this->empresas['sNombreCorto']."' ,";
                }
                if(!is_null($this->empresas['sRFC'])){
                    $sql .=" sRFC = '".$this->empresas['sRFC']."' ,";
                }
                if(!is_null($this->empresas['skCorresponsalia'])){
                    $sql .=" skCorresponsalia = '".$this->empresas['skCorresponsalia']."' ,";
                }
                if(!is_null($this->empresas['skPromotor1'])){
                    $sql .=" skPromotor1 = '".$this->empresas['skPromotor1']."' ,";
                }
                if(!is_null($this->empresas['skPromotor2'])){
                    $sql .=" skPromotor2 = '".$this->empresas['skPromotor2']."' ,";
                }
                if(!is_null($this->empresas['skStatus'])){
                    $sql .=" skStatus = '".$this->empresas['skStatus']."' ,";
                }
                $sql .= " skEmpresa = '".$this->empresas['skEmpresa']."' WHERE skEmpresa = '".$this->empresas['skEmpresa']."' LIMIT 1";
                //echo $sql;
                $result = $this->db->query($sql);
                if($result){
                    return $this->empresas['skEmpresa'];
                }else{
                    return false;
                }
            }
              public function read_empresa(){
                $sql = "SELECT cat_empresas.*, _status.sName AS status, _status.sHtml  
						FROM cat_empresas 
						LEFT JOIN _status ON _status.skStatus = cat_empresas.skStatus 
						WHERE 1=1 ";
                if(!empty($this->empresas['skEmpresaDistinta'])){
                    $sql .= " AND cat_empresas.skEmpresa <> '".$this->empresas['skEmpresaDistinta']."' ";
                }
                if(!empty($this->empresas['skEmpresa'])){
                    $sql .= " AND cat_empresas.skEmpresa ='".$this->empresas['skEmpresa']."' ";
                }
                if(!empty($this->empresas['sNombre'])){
                    $sql .= " AND cat_empresas.sNombre = '".$this->empresas['sNombre']."'";
                }
                if(!empty($this->empresas['sRFC'])){
                    $sql .= " AND cat_empresas.sRFC = '".$this->empresas['sRFC']."'";
                }
                if(!empty($this->empresas['sNombreCorto'])){
                    $sql .= " AND cat_empresas.sNombreCorto = '".$this->empresas['sNombreCorto']."'";
                }
                if(!empty($this->empresas['skCorresponsalia'])){
                    $sql .=" AND skCorresponsalia = '".$this->empresas['skCorresponsalia']."'";
                }
                if(!empty($this->empresas['skPromotor1'])){
                    $sql .=" AND (cat_empresas.skPromotor1 = '".$this->empresas['skPromotor1']."' OR cat_empresas.skPromotor2 = '".$this->empresas['skPromotor2']."')";
                }
                if(!empty($this->empresas['skStatus'])){
                    $sql .= " AND cat_empresas.skStatus = '".$this->empresas['skStatus']."'";
                }
                $sql .=" ORDER BY cat_empresas.sNombre ASC ";
                if(is_int($this->empresas['limit'])){
                    if(is_int($this->empresas['offset'])){
                        $sql .= " LIMIT ".$this->empresas['offset']." , ".$this->empresas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->empresas['limit'];
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
              
              
	}
?>
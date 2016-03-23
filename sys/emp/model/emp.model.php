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
                public $conTipEmp = array(
                    'skTipoEmpresa'=>null
                    ,'skTipoTramite'=>null
                );
                public $empTarCon = array(
                    'skEmpresaTarifaConcepto'=>null
                    ,'skEmpresa'=>null
                    ,'skTipoTramite'=>null
                    ,'skConcepto'=>null
                    ,'skDivisa'=>null
                    ,'fPrecioUnitario'=>null
                    ,'skUserCreacion'=>null
                    ,'dFechaCreacion'=>null
                );
                public $tarifas = array(
                     'skTarifa'=>null
                    ,'skEmpresa'=>null
                    ,'sTipoCambio'=>null
                    ,'iTipoTarifa'=>null
                    ,'fTarifa'=>null
                    ,'fAgenteAduanal'=>null
                    ,'iTipoCalculoAA'=>null
                    ,'fCorresponsal'=>null
                    ,'iTipoCalculoCorresponsal'=>null
                    ,'fPromotor1'=>null
                    ,'iTipoCalculoPromotor1'=>null
                    ,'fPromotor2'=>null
                    ,'iTipoCalculoPromotor2'=>null
                    ,'skUserCreacion'=>null
                    ,'dFechaCreacion'=>null
                    ,'skStatus'=>null
                    // DATOS DE FILTRADO  //
                    ,'dFechaInicio'=>null
                    ,'dFechaFin'=>null
                    ,'skPromotor'=>null
                    ,'skCorresponsalia'=>null
                    
                    ,'limit'        =>  null
                    ,'offset'       =>  null
                );
                
                public $tarifaRango = array(
                     'skRango'=>null
                    ,'skTarifa'=>null
                    ,'iRango1'=>null
                    ,'iRango2'=>null
                    ,'fTarifa'=>null
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
                $sql = "SELECT cat_empresas.*,rel_cat_empresas_cat_tipos_empresas.skTipoEmpresa, _status.sName AS status, _status.sHtml AS htmlStatus, 
                	promo1.sNombre AS promotor1, promo2.sNombre AS promotor2, corr.sNombre AS corresponsal
                        FROM cat_empresas 
                	INNER JOIN _status ON _status.skStatus = cat_empresas.skStatus 
                	LEFT JOIN rel_cat_empresas_cat_tipos_empresas ON rel_cat_empresas_cat_tipos_empresas.skEmpresa = cat_empresas.skEmpresa 
                        LEFT JOIN cat_promotores promo1 ON promo1.skPromotores =  cat_empresas.skPromotor1
                        LEFT JOIN cat_promotores promo2 ON promo2.skPromotores =  cat_empresas.skPromotor2
                        LEFT JOIN cat_empresas corr ON corr.skEmpresa = cat_empresas.skCorresponsalia
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
                //echo($sql);
                
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
            // OBTENER LOS TIPOS DE TRAMITE (IMPO,EXPO) //
            public function read_tipos_tramites(){
                $sql="SELECT tipTra.* FROM cat_tipos_tramites AS tipTra WHERE skStatus = 'AC' ORDER BY tipTra.sNombre ASC ";
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
            public function getConceptosEmpresa(){
                $sql = "SELECT * FROM rel_cat_empresas_tarifas_conceptos AS empTarCon WHERE empTarCon.skEmpresa = '".$this->empresas['skEmpresa']."' ";
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
            public function read_conceptos_tipos_empresas(){
                $sql="SELECT 
                con.skConcepto ,con.sNombre AS concepto
                ,di.skDivisa ,di.sName AS divisa
                ,tra.skTipoTramite ,tra.sNombre AS tramite
                ,conTar.fPrecioUnitario
                ,conTipEmp.skTipoEmpresa
                ,tipEmp.sNombre AS tipoEmpresa
                FROM
                rel_cat_conceptos_tipos_empresas AS conTipEmp
                INNER JOIN cat_conceptos AS con ON con.skConcepto = conTipEmp.skConcepto
                INNER JOIN rel_cat_conceptos_tarifas AS conTar ON conTar.skConcepto = con.skConcepto
                INNER JOIN cat_divisas AS di ON di.skDivisa = conTar.skDivisa
                INNER JOIN rel_cat_conceptos_tipos_tramites AS conTra ON conTra.skConcepto = con.skConcepto
                INNER JOIN cat_tipos_tramites AS tra ON tra.skTipoTramite = conTra.skTipoTramite
                INNER JOIN cat_tipos_empresas AS tipEmp ON tipEmp.skTipoEmpresa = conTipEmp.skTipoEmpresa WHERE con.skStatus = 'AC' ";
                if(!is_null($this->conTipEmp['skTipoEmpresa'])){
                    $sql .=" AND conTipEmp.skTipoEmpresa = '".$this->conTipEmp['skTipoEmpresa']."'";
                }
                if(!is_null($this->conTipEmp['skTipoTramite'])){
                    $sql .=" AND tra.skTipoTramite = '".$this->conTipEmp['skTipoTramite']."'";
                }
                $sql .= " ORDER BY con.sNombre ASC ";
                //exit($sql);
                $result = $this->db->query($sql);
                if(!$result){
                    return false;
                }
                return $result;
            }
            // READ DIVISAS //
            public function read_cat_divisas(){
                $sql="SELECT 
                divi.*
                FROM
                cat_divisas AS divi
                WHERE divi.skStatus = 'AC' ORDER BY divi.sName ASC ";
                //exit($sql);
                $result = $this->db->query($sql);
                if(!$result){
                    return false;
                }
                return $result;
            }
            // READ tiposTramites //
            function read_cat_tipos_tramites(){
                $sql="SELECT 
                tipTra.*
                FROM
                cat_tipos_tramites AS tipTra
                WHERE tipTra.skStatus = 'AC' ORDER BY tipTra.sNombre ASC ";
                //exit($sql);
                $result = $this->db->query($sql);
                if(!$result){
                    return false;
                }
                return $result;
            }
            // CREATE rel_cat_empresas_tarifas_conceptos (empTarCon) //
            function create_empTarCon(){
                $sql = "INSERT INTO rel_cat_empresas_tarifas_conceptos
                    (
                        skEmpresaTarifaConcepto
                        ,skEmpresa
                        ,skTipoTramite
                        ,skConcepto
                        ,skDivisa
                        ,fPrecioUnitario
                        ,skUserCreacion
                        ,dFechaCreacion
                    ) VALUES(
                        '".$this->empTarCon['skEmpresaTarifaConcepto']."',
                        '".$this->empTarCon['skEmpresa']."',
                        '".$this->empTarCon['skTipoTramite']."',
                        '".$this->empTarCon['skConcepto']."',
                        '".$this->empTarCon['skDivisa']."',
                        '".$this->empTarCon['fPrecioUnitario']."',
                        '".$_SESSION['session']['skUsers']."',
                        CURRENT_TIMESTAMP()

                    )";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->empTarCon['skEmpresaTarifaConcepto'];
                }else{
                    return false;
                }
            }
            function delete_empTarCon(){
                $sql = "DELETE FROM rel_cat_empresas_tarifas_conceptos WHERE skEmpresa = '".$this->empTarCon['skEmpresa']."' ";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            public function count_tarifas(){
                $sql="SELECT COUNT(*) AS total
                    FROM rel_empresas_tarifas AS tarifas
                    INNER JOIN _users usr ON usr.skUsers = tarifas.skUserCreacion
                    INNER JOIN cat_empresas ce ON ce.skEmpresa = tarifas.skEmpresa
                    INNER JOIN cat_empresas corr ON corr.skEmpresa = ce.skCorresponsalia
                    INNER JOIN cat_promotores pr1 ON pr1.skPromotores = ce.skPromotor1
                    INNER JOIN cat_promotores pr2 ON pr2.skPromotores = ce.skPromotor2 
                    INNER JOIN _status ON _status.skStatus = tarifas.skStatus
                    WHERE 1=1 ";
                if(!is_null($this->tarifas['skTarifa'])){
                    $sql .=" AND tarifas.skTarifa = '".$this->tarifas['skTarifa']."'";
                }
                if(!is_null($this->tarifas['skEmpresa'])){
                    $sql .=" AND tarifas.skEmpresa = '".$this->tarifas['skEmpresa']."'";
                }
                if(!is_null($this->tarifas['sTipoCambio'])){
                    $sql .=" AND tarifas.sTipoCambio = '".$this->tarifas['sTipoCambio']."'";
                }
                if(!is_null($this->tarifas['iTipoTarifa'])){
                    $sql .=" AND tarifas.iTipoTarifa = ".$this->tarifas['iTipoTarifa'];
                }
                if(!is_null($this->tarifas['fTarifa'])){
                    $sql .=" AND tarifas.fTarifa = ".$this->tarifas['fTarifa'];
                }
                if(!is_null($this->tarifas['fAgenteAduanal'])){
                    $sql .=" AND tarifas.fAgenteAduanal = ".$this->tarifas['fAgenteAduanal'];
                }
                if(!is_null($this->tarifas['fCorresponsal'])){
                    $sql .=" AND tarifas.fCorresponsal = ".$this->tarifas['fCorresponsal'];
                }
                if(!is_null($this->tarifas['fPromotor1'])){
                    $sql .=" AND tarifas.fPromotor1 = ".$this->tarifas['fPromotor1'];
                }
                if(!is_null($this->tarifas['fPromotor2'])){
                    $sql .=" AND tarifas.fPromotor2 = ".$this->tarifas['fPromotor2'];
                }
                if(!is_null($this->tarifas['skUserCreacion'])){
                    $sql .=" AND tarifas.skUserCreacion = '".$this->tarifas['skUserCreacion']."'";
                }
                if(!is_null($this->tarifas['skStatus'])){
                    $sql .=" AND tarifas.skStatus = '".$this->tarifas['skStatus']."'";
                }
                // FILTRO POR RANGO DE FECHAS //
                if(!is_null($this->tarifas['dFechaInicio'])){
                    if(!is_null($this->tarifas['dFechaFin'])){
                        $sql .= " AND (DATE_FORMAT(tarifas.dFechaCreacion,'%Y-%m-%d') >= '".date('Y-m-d',  strtotime($this->solreva['dFechaInicio']))."' AND DATE_FORMAT(tarifas.dFechaCreacion,'%Y-%m-%d') <= '".date('Y-m-d',  strtotime($this->solreva['dFechaFin']))."')";
                    }else{
                        $sql .= " AND (DATE_FORMAT(tarifas.dFechaCreacion,'%Y-%m-%d') = '".date('Y-m-d',  strtotime($this->solreva['dFechaInicio']))."' ";
                    }
                }
                // FILTRO POR PROMOTOR //
                if(!is_null($this->tarifas['skPromotor'])){
                    $sql .=" AND (pr1.skPromotores = '".$this->tarifas['skPromotor']."' OR pr2.skPromotores = '".$this->tarifas['skPromotor']."')";
                }
                // FILTRO POR CORRESPONSAL //
                if(!is_null($this->tarifas['skCorresponsalia'])){
                    $sql .=" AND corr.skEmpresa = '".$this->tarifas['skCorresponsalia']."'";
                }
                if(is_int($this->tarifas['limit'])){
                    if(is_int($this->tarifas['offset'])){
                        $sql .= " LIMIT ".$this->tarifas['offset']." , ".$this->tarifas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->tarifas['limit'];
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
            
            public function read_tarifas(){
                $sql="SELECT tarifas.*,
                    ce.sNombre AS cliente,
                    corr.sNombre AS corresponsal,
                    pr1.sNombre AS promotor1,
                    pr2.sNombre AS promotor2,
                    usr.sName AS autor,
                    _status.sHtml AS htmlStatus
                    FROM rel_empresas_tarifas AS tarifas
                    INNER JOIN _users usr ON usr.skUsers = tarifas.skUserCreacion
                    INNER JOIN cat_empresas ce ON ce.skEmpresa = tarifas.skEmpresa
                    INNER JOIN cat_empresas corr ON corr.skEmpresa = ce.skCorresponsalia
                    INNER JOIN cat_promotores pr1 ON pr1.skPromotores = ce.skPromotor1
                    INNER JOIN cat_promotores pr2 ON pr2.skPromotores = ce.skPromotor2 
                    INNER JOIN _status ON _status.skStatus = tarifas.skStatus 
                    WHERE 1=1 ";
                if(!is_null($this->tarifas['skTarifa'])){
                    $sql .=" AND tarifas.skTarifa = '".$this->tarifas['skTarifa']."'";
                }
                if(!is_null($this->tarifas['skEmpresa'])){
                    $sql .=" AND tarifas.skEmpresa = '".$this->tarifas['skEmpresa']."'";
                }
                if(!is_null($this->tarifas['sTipoCambio'])){
                    $sql .=" AND tarifas.sTipoCambio = '".$this->tarifas['sTipoCambio']."'";
                }
                if(!is_null($this->tarifas['iTipoTarifa'])){
                    $sql .=" AND tarifas.iTipoTarifa = ".$this->tarifas['iTipoTarifa'];
                }
                if(!is_null($this->tarifas['fTarifa'])){
                    $sql .=" AND tarifas.fTarifa = ".$this->tarifas['fTarifa'];
                }
                if(!is_null($this->tarifas['fAgenteAduanal'])){
                    $sql .=" AND tarifas.fAgenteAduanal = ".$this->tarifas['fAgenteAduanal'];
                }
                if(!is_null($this->tarifas['fCorresponsal'])){
                    $sql .=" AND tarifas.fCorresponsal = ".$this->tarifas['fCorresponsal'];
                }
                if(!is_null($this->tarifas['fPromotor1'])){
                    $sql .=" AND tarifas.fPromotor1 = ".$this->tarifas['fPromotor1'];
                }
                if(!is_null($this->tarifas['fPromotor2'])){
                    $sql .=" AND tarifas.fPromotor2 = ".$this->tarifas['fPromotor2'];
                }
                if(!is_null($this->tarifas['skUserCreacion'])){
                    $sql .=" AND tarifas.skUserCreacion = '".$this->tarifas['skUserCreacion']."'";
                }
                if(!is_null($this->tarifas['skStatus'])){
                    $sql .=" AND tarifas.skStatus = '".$this->tarifas['skStatus']."'";
                }
                // FILTRO POR RANGO DE FECHAS //
                if(!is_null($this->tarifas['dFechaInicio'])){
                    if(!is_null($this->tarifas['dFechaFin'])){
                        $sql .= " AND (DATE_FORMAT(tarifas.dFechaCreacion,'%Y-%m-%d') >= '".date('Y-m-d',  strtotime($this->solreva['dFechaInicio']))."' AND DATE_FORMAT(tarifas.dFechaCreacion,'%Y-%m-%d') <= '".date('Y-m-d',  strtotime($this->solreva['dFechaFin']))."')";
                    }else{
                        $sql .= " AND (DATE_FORMAT(tarifas.dFechaCreacion,'%Y-%m-%d') = '".date('Y-m-d',  strtotime($this->solreva['dFechaInicio']))."' ";
                    }
                }
                // FILTRO POR PROMOTOR //
                if(!is_null($this->tarifas['skPromotor'])){
                    $sql .=" AND (pr1.skPromotores = '".$this->tarifas['skPromotor']."' OR pr2.skPromotores = '".$this->tarifas['skPromotor']."')";
                }
                // FILTRO POR CORRESPONSAL //
                if(!is_null($this->tarifas['skCorresponsalia'])){
                    $sql .=" AND corr.skEmpresa = '".$this->tarifas['skCorresponsalia']."'";
                }
                if(is_int($this->tarifas['limit'])){
                    if(is_int($this->tarifas['offset'])){
                        $sql .= " LIMIT ".$this->tarifas['offset']." , ".$this->tarifas['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->tarifas['limit'];
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

            public function create_tarifa(){
                $sql="INSERT INTO rel_empresas_tarifas
                    (skTarifa,skEmpresa,sTipoCambio,iTipoTarifa,fTarifa,fAgenteAduanal,iTipoCalculoAA,fCorresponsal,iTipoCalculoCorresponsal,fPromotor1,iTipoCalculoPromotor1,fPromotor2,iTipoCalculoPromotor2,skUserCreacion,dFechaCreacion,skStatus)
                    VALUES (
                    '".$this->tarifas['skTarifa']."'
                    ,'".$this->tarifas['skEmpresa']."'
                    ,'".$this->tarifas['sTipoCambio']."'
                    ,".$this->tarifas['iTipoTarifa']."
                    ,".$this->tarifas['fTarifa']."
                    ,".$this->tarifas['fAgenteAduanal']."
                    ,".$this->tarifas['iTipoCalculoAA']."
                    ,".$this->tarifas['fCorresponsal']."
                    ,".$this->tarifas['iTipoCalculoCorresponsal']."
                    ,".$this->tarifas['fPromotor1']."
                    ,".$this->tarifas['iTipoCalculoPromotor1']."
                    ,".$this->tarifas['fPromotor2']."
                    ,".$this->tarifas['iTipoCalculoPromotor2']."
                    ,'".$_SESSION['session']['skUsers']."'
                    ,CURRENT_TIMESTAMP()
                    ,'".$this->tarifas['skStatus']."'
                    )";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->tarifas['skTarifa'];
                }else{
                    return false;
                }
            }
            
            public function terminarVigencia_tarifa(){
                $sql="UPDATE rel_empresas_tarifas SET skStatus = 'IN' WHERE skEmpresa = '".$this->tarifas['skEmpresa']."'";
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            
            public function create_Rank(){
                $sql = "INSERT INTO rel_tarifas_rangos (skTarifa,iRango1,iRango2,fTarifa) VALUES ('".$this->tarifas['skTarifa']."',".$this->tarifaRango['iRango1'].",".$this->tarifaRango['iRango2'].",".$this->tarifaRango['fTarifa'].")";
                //exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $this->tarifas['skTarifa'];
                }else{
                    return false;
                }
            }
	}
?>
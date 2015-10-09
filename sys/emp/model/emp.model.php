<?php
	Abstract Class Emp_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $areas = array(
                    'skAreas'       =>  ''
                    ,'sNombre'       =>  ''
                    ,'sTitulo'       =>  ''
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
                    $sql .=" skStatus = '".$this->departamentos['skStatus']."' ,";
                }
                $sql .= " skDepartamento = '".$this->departamentos['skDepartamento']."' WHERE skDepartamento = '".$this->departamentos['skDepartamento']."' LIMIT 1";
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
            
	}
?>
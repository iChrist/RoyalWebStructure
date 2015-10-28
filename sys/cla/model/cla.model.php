<?php
    Abstract Class Cla_Model Extends Core_Model {

        // PUBLIC VARIABLES //
        public $desArc = array(
             'skArchivoFraccionArancelaria' => NULL
            ,'skFraccionArancelariaDescripcion'  =>  NULL
            ,'sArchivo'     =>  NULL
            ,'skStatus'     =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );
        
        public $fraAraDes = array(
             'skFraccionArancelariaDescripcion' =>  NULL
            ,'skFraccionArancelaria'    =>  NULL
            ,'sDescripcion'  =>  NULL
            ,'sDescripcionIngles'   =>  NULL
            ,'sModelo'  =>  NULL
            ,'skStatus' =>  NULL
            ,'dFechaCreacion'   =>  NULL
            ,'skUsersCreacion'  =>  NULL
            ,'dFechaModificacion'   =>  NULL
            ,'skUsersModificacion'  =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );

        // cat_numerosParte_fraccionesFraccion
         public $numparfraran = array(
             'skNumeroParte'  =>  ''
            ,'sNombre'     =>  ''
            ,'sDescripcion'     =>  ''
            ,'skStatus'     =>  ''
            ,'dFechaCrecion'     =>  ''
            ,'skUsersCreacion'     =>  ''
            ,'dFechaModificacion'     =>  ''
            ,'skUsersModificacion'     =>  ''
            ,'limit'        =>  ''
            ,'offset'       =>  ''
        );

        public $numPar = array(
             'skNumeroParte' =>  NULL
            ,'sNombre'    =>  NULL
            ,'sDescripcion'  =>  NULL
            ,'skStatus' =>  NULL
            ,'dFechaCreacion'   =>  NULL
            ,'skUsersCreacion'  =>  NULL
            ,'dFechaModificacion'   =>  NULL
            ,'skUsersModificacion'  =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );

        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
            parent::__construct();
        }

        public function __destruct(){

        }
        
        /* COMIENZA MODULO clasifiación arancelaria */
        
        /* COMIENZA cat_descripcionFraccion_archivos */

        public function count_numerosParte(){
            $sql = "SELECT COUNT(*) AS total FROM cat_numerosParte WHERE 1=1 ";
            $sql = "	SELECT COUNT(a.skNumeroParte)AS total
					FROM (
							SELECT
								np.*, fnNombresFraccionesArancelarias(np.skNumeroParte)AS TodosLosNombres,
								fnNombresFraccionesArancelariasDescripciones(np.skNumeroParte)AS TodasLasDescripciones
							FROM
								cat_numerosParte np
						) as a
					WHERE 1 = 1 ";
           
			
			if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND skNumeroParte = '".$this->numPar['skNumeroParte']."'";
            }
            if(!empty($this->numPar['sNombre'])){
                $sql .=" AND (sNombre like '%".$this->numPar['sNombre']."%' or TodosLosNombres like '%".$this->numPar['sNombre']."%')";
            }
            if(!empty($this->numPar['sDescripcion'])){
                $sql .=" AND (sDescripcion like '%".$this->numPar['sDescripcion']."%' or TodosLosNombres like '%".$this->numPar['sDescripcion']."%')";
            }
            if(!empty($this->numPar['skStatus'])){
                $sql .=" AND skStatus like '%".$this->numPar['skStatus']."%'";
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

        public function read_like_numerosParte(){
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte AS numPar INNER JOIN _status ON _status.skStatus = numPar.skStatus WHERE 1=1 ";
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus 
					FROM (
							SELECT
								np.*, fnNombresFraccionesArancelarias(np.skNumeroParte)AS TodosLosNombres,
								fnNombresFraccionesArancelariasDescripciones(np.skNumeroParte)AS TodasLasDescripciones
							FROM
								cat_numerosParte np
						) AS numPar 
					INNER JOIN _status ON _status.skStatus = numPar.skStatus 
					WHERE 1=1 ";
            if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND numPar.skNumeroParte = '".$this->numPar['skNumeroParte']."'";
            }
            if(!empty($this->numPar['sNombre'])){
                $sql .=" AND (numPar.sNombre like '%".$this->numPar['sNombre']."%' or numPar.TodosLosNombres like '%".$this->numPar['sNombre']."%')";
            }
            if(!empty($this->numPar['sDescripcion'])){
                $sql .=" AND (numPar.sDescripcion like '%".$this->numPar['sDescripcion']."%' or numPar.TodasLasDescripciones like '%".$this->numPar['sDescripcion']."%')";
            }
            if(!empty($this->numPar['skStatus'])){
                $sql .=" AND numPar.skStatus like '%".$this->numPar['skStatus']."%'";
            }
            if(is_int($this->numPar['limit'])){
                if(is_int($this->numPar['offset'])){
                    $sql .= " LIMIT ".$this->numPar['offset']." , ".$this->numPar['limit'];
                }else{
                    $sql .= " LIMIT ".$this->numPar['limit'];
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
        
        public function read_equal_numPar(){
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte AS numPar INNER JOIN _status ON _status.skStatus = numPar.skStatus WHERE 1=1 ";
            if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND (numPar.skNumeroParte = '".$this->numPar['skNumeroParte']."') ";
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

        public function read_equal_numparfraran(){
            $sql = "SELECT numparfraran.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte_fraccionesArancelarias AS numparfraran INNER JOIN _status ON _status.skStatus = numparfraran.skStatus WHERE 1=1 ";
            if(!empty($this->numparfraran['skNumeroParte'])){
                $sql .=" AND (numparfraran.skNumeroParte = '".$this->numparfraran['skNumeroParte']."') ";
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

        public function read_equal_fraAraDes(){
            $sql = "SELECT fraAraDes.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_fraccionesArancelarias_descripcionFraccion AS fraAraDes INNER JOIN _status ON _status.skStatus = fraAraDes.skStatus WHERE 1=1 ";
            if(!empty($this->fraAraDes['skFraccionArancelaria'])){
                $sql .=" AND (fraAraDes.skFraccionArancelaria = '".$this->fraAraDes['skFraccionArancelaria']."') ";
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

        public function read_equal_desArc(){
            $sql = "SELECT desArc.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_descripcionFraccion_archivos AS desArc INNER JOIN _status ON _status.skStatus = desArc.skStatus WHERE 1=1 ";
            if(!empty($this->desArc['skFraccionArancelariaDescripcion'])){
                $sql .=" AND (desArc.skFraccionArancelariaDescripcion = '".$this->desArc['skFraccionArancelariaDescripcion']."') ";
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

        public function create_cat_descripcionFraccion_archivos(){
            $sql = "INSERT INTO cat_descripcionFraccion_archivos (skArchivoFraccionArancelaria,skFraccionArancelariaDescripcion,sArchivo,skStatus) "
                    . "VALUES ('".$this->desArc['skArchivoFraccionArancelaria']."','".$this->desArc['skFraccionArancelariaDescripcion']."','".$this->desArc['sArchivo']."','AC')";
            //echo $sql;
            $result = $this->db->query($sql); 
            if($result){
                return $this->desArc['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function update_cat_descripcionFraccion_archivos(){
            $sql = "UPDATE cat_descripcionFraccion_archivos SET "
                    . "";
            $result = $this->db->query($sql);echo '<hr>'.$sql;
            if($result){
                return $this->desArc['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function create_cat_fraccionesArancelarias_descripcionFraccion(){
            $sql = "INSERT INTO cat_fraccionesArancelarias_descripcionFraccion ("
                    . "skFraccionArancelariaDescripcion,"
                    . "skFraccionArancelaria,"
                    . "sDescripcion,"
                    . "sDescripcionIngles,"
                     . "skStatus,"
                    . "dFechaCreacion,"
                    . "skUsersCreacion"
                     . ") VALUES ("
                    . "'".$this->fraAraDes['skFraccionArancelariaDescripcion']."',"
                    . "'".$this->fraAraDes['skFraccionArancelaria']."',"
                    . "'".$this->fraAraDes['sDescripcion']."',"
                    . "'".$this->fraAraDes['sDescripcionIngles']."',"
                    . "'AC',"
                    . "CURRENT_TIMESTAMP,"
                    . "'".$this->fraAraDes['skUsersCreacion']."'"
                     . ")";
                 //  echo $sql;
                  
            $result = $this->db->query($sql);
            if($result){
                return $this->fraAraDes['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function update_cat_fraccionesArancelarias_descripcionFraccion(){
            $sql = "UPDATE cat_fraccionesArancelarias_descripcionFraccion SET "
                    . "sDescripcion = '".$this->fraAraDes['sDescripcion']."',"
                    . "sDescripcionIngles = '".$this->fraAraDes['sDescripcionIngles']."',"
                    . "sModelo = '".$this->fraAraDes['sModelo']."',"
                    . "skStatus = '".$this->fraAraDes['skStatus']."',"
                    . "dFechaModificacion = '".$this->fraAraDes['dFechaModificacion']."',"
                    . "skUsersModificacion = '".$this->fraAraDes['skUsersModificacion']."',"
                    . " skFraccionArancelariaDescripcion = '".$this->fraAraDes['skFraccionArancelariaDescripcion']."' WHERE skFraccionArancelariaDescripcion = '".$this->fraAraDes['skFraccionArancelariaDescripcion']."'";
            $result = $this->db->query($sql);
            if($result){
                return $this->fraAraDes['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        /* TERMINA cat_descripcionFraccion_archivos */
        
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */
        
        
        
        

        /* COMIENZA create_cat_numeros_partes */
        public function create_cat_numeroParte(){
            $sql = "INSERT INTO cat_numerosParte (skNumeroParte,sNombre,sDescripcion,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES 
            ('".$this->numPar['skNumeroParte']."',
            '".$this->numPar['sNombre']."',
            '".$this->numPar['sDescripcion']."',
            '".$this->numPar['skStatus']."',
             CURRENT_TIMESTAMP,
            '".$this->numPar['skUsersCreacion']."'
            )";
            
            //echo $sql;
           
            $result = $this->db->query($sql);
            if($result){
                return $this->numPar['skNumeroParte'];
            }else{
                return false;
            }
        }
          
          public function update_cat_numeros_partes(){
                $sql = "UPDATE cat_numerosParte SET ";
                
                if(!empty($this->numPar['sNombre'])){
                    $sql .=" sNombre = '".$this->numPar['sNombre']."' ,";
                }
                 if(!empty($this->numPar['sDescripcion'])){
                    $sql .=" sDescripcion = '".$this->numPar['sDescripcion']."' ,";
                }
                if(!empty($this->numPar['skStatus'])){
                    $sql .=" skStatus = '".$this->numPar['skStatus']."' ,";
                }
                $sql .= " skNumeroParte = '".$this->numPar['skNumeroParte']."' WHERE skNumeroParte = '".$this->numPar['skNumeroParte']."' LIMIT 1";
               
                $result = $this->db->query($sql);
                if($result){
                    return $this->numPar['skNumeroParte'];
                }else{
                    return false;
                }
            }
          /* TERMINA create_cat_numeros_partes */
        
        public function create_cat_numparfraran(){
            $sql = "INSERT INTO cat_numerosParte_fraccionesArancelarias (skFraccionArancelaria,skNumeroParte,sNombre,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES ('".$this->numparfraran['skFraccionArancelaria']."','".$this->numparfraran['skNumeroParte']."','".$this->numparfraran['sNombre']."',
                    '".$this->numparfraran['skStatus']."',CURRENT_TIMESTAMP,'".$this->numparfraran['skUsersCreacion']."')";
            $result = $this->db->query($sql);
           // echo $sql;
         
            if($result){
                return $this->numparfraran['skFraccionArancelaria'];
            }else{
                return false;
            }
        }
        
        public function update_numparfraran(){
                $sql = "UPDATE cat_numerosParte_fraccionesFraccion SET ";
                
                if(!empty($this->numparfraran['sNombre'])){
                    $sql .=" sNombre = '".$this->numparfraran['sNombre']."' ,";
                }
                 if(!empty($this->numparfraran['sDescripcion'])){
                    $sql .=" sDescripcion = '".$this->numparfraran['sDescripcion']."' ,";
                }
                if(!empty($this->numparfraran['skStatus'])){
                    $sql .=" skStatus = '".$this->numparfraran['skStatus']."' ,";
                }
                $sql .= " skFraccionArancelaria = '".$this->numparfraran['skFraccionArancelaria']."' WHERE skFraccionArancelaria = '".$this->numparfraran['skFraccionArancelaria']."' LIMIT 1";
             //   echo $sql;
              //  die();
                $result = $this->db->query($sql);
                if($result){
                    return $this->numparfraran['skFraccionArancelaria'];
                }else{
                    return false;
                }
            }
        
        
        

        
    }
?>
<?php
    Abstract Class Cla_Model Extends Core_Model {

        // PUBLIC VARIABLES //
        public $desArc = array(
             'skFraccionArancelariaDescripcion'  =>  NULL
            ,'sArchivo'     =>  NULL
            ,'skStatus'     =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );
        
        public $fraAraDes = array(
             'skFraccionArancelariaDescripcion' =>  NULL
            ,'skFraccionArancelaria'    =>  NULL
            ,'sDecripcion'  =>  NULL
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
        
        public $cat_numeros_partes = array(
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
            ,'sDecripcion'  =>  NULL
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
            if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND skNumeroParte = '".$this->numPar['skNumeroParte']."'";
            }
            if(!empty($this->numPar['sNombre'])){
                $sql .=" AND sNombre like '%".$this->numPar['sNombre']."%'";
            }
            if(!empty($this->numPar['sDecripcion'])){
                $sql .=" AND sDecripcion like '%".$this->numPar['sDecripcion']."%'";
            }
            if(!empty($this->numPar['skStatus'])){
                $sql .=" AND skStatus like '%".$this->numPar['skStatus']."%'";
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

        public function read_like_numerosParte(){
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte AS numPar INNER JOIN _status ON _status.skStatus = numPar.skStatus WHERE 1=1 ";
            if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND skNumeroParte = '".$this->numPar['skNumeroParte']."'";
            }
            if(!empty($this->numPar['sNombre'])){
                $sql .=" AND sNombre like '%".$this->numPar['sNombre']."%'";
            }
            if(!empty($this->numPar['sDecripcion'])){
                $sql .=" AND sDecripcion like '%".$this->numPar['sDecripcion']."%'";
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
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function read_equal_numerosParte(){
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte AS numPar INNER JOIN _status ON _status.skStatus = numPar.skStatus WHERE 1=1 ";
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
            $sql = "INSERT INTO cat_descripcionFraccion_archivos (skFraccionArancelariaDescripcion,sArchivo,skStatus) "
                    . "VALUES ('".$this->desArc['skFraccionArancelariaDescripcion']."','".$this->desArc['sArchivo']."','".$this->desArc['skStatus']."')";
            $result = $this->db->query($sql);echo '<hr>'.$sql;
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
                    . "sDecripcion,"
                    . "sDescripcionIngles,"
                    . "sModelo,"
                    . "skStatus,"
                    . "dFechaCreacion,"
                    . "skUsersCreacion,"
                    . "dFechaModificacion,"
                    . "skUsersModificacion"
                    . ") VALUES ("
                    . "'".$this->fraAraDes['skFraccionArancelariaDescripcion']."',"
                    . "'".$this->fraAraDes['skFraccionArancelaria']."',"
                    . "'".$this->fraAraDes['sDecripcion']."',"
                    . "'".$this->fraAraDes['sDescripcionIngles']."',"
                    . "'".$this->fraAraDes['sModelo']."',"
                    . "'".$this->fraAraDes['skStatus']."',"
                    . "'".$this->fraAraDes['dFechaCreacion']."',"
                    . "'".$this->fraAraDes['skUsersCreacion']."',"
                    . "'".$this->fraAraDes['dFechaModificacion']."',"
                    . "'".$this->fraAraDes['skUsersModificacion']."'"
                    . ")";
            $result = $this->db->query($sql);echo '<hr>'.$sql;
            if($result){
                return $this->fraAraDes['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function update_cat_fraccionesArancelarias_descripcionFraccion(){
            $sql = "UPDATE cat_fraccionesArancelarias_descripcionFraccion SET "
                    . "sDecripcion = '".$this->fraAraDes['sDecripcion']."',"
                    . "sDescripcionIngles = '".$this->fraAraDes['sDescripcionIngles']."',"
                    . "sModelo = '".$this->fraAraDes['sModelo']."',"
                    . "skStatus = '".$this->fraAraDes['skStatus']."',"
                    . "dFechaModificacion = '".$this->fraAraDes['dFechaModificacion']."',"
                    . "skUsersModificacion = '".$this->fraAraDes['skUsersModificacion']."'"
                    . " WHERE skFraccionArancelariaDescripcion = '".$this->fraAraDes['skFraccionArancelariaDescripcion']."'";
            $result = $this->db->query($sql);
            if($result){
                return $this->fraAraDes['skAreas'];
            }else{
                return false;
            }
        }
        /* TERMINA cat_descripcionFraccion_archivos */
        
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */
        
        
        
        

        /* COMIENZA create_cat_numeros_partes */
        /*public function create_cat_numeros_partes(){
            $sql = "INSERT INTO cat_numeros_partes (skNumeroParte,sNombre,sDescripcion,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES ('".$this->cat_numeros_partes['skNumeroParte']."','".$this->cat_numeros_partes['sNombre']."','".$this->cat_numeros_partes['sDescripcion']."','".$this->cat_numeros_partes['skStatus'].",'".$this->cat_numeros_partes['dFechaCreacion']."','".$this->cat_numeros_partes['skStatus']."',CURRENT_TIMESTAMP,'".$this->cat_numeros_partes['skUsersCreacion']."')";
            $result = $this->db->query($sql);
            if($result){
                return $this->cat_numeros_partes['skNumeroParte'];
            }else{
                return false;
            }
        }*/
          
          public function update_cat_numeros_partes(){
                $sql = "UPDATE cat_numeros_partes SET ";
                
                if(!empty($this->cat_numeros_partes['sNombre'])){
                    $sql .=" sNombre = '".$this->cat_numeros_partes['sNombre']."' ,";
                }
                 if(!empty($this->cat_numeros_partes['sDescripcion'])){
                    $sql .=" sDescripcion = '".$this->cat_numeros_partes['sDescripcion']."' ,";
                }
                if(!empty($this->cat_numeros_partes['skStatus'])){
                    $sql .=" skStatus = '".$this->cat_numeros_partes['skStatus']."' ,";
                }
                $sql .= " skNumeroParte = '".$this->cat_numeros_partes['skNumeroParte']."' WHERE skNumeroParte = '".$this->cat_numeros_partes['skNumeroParte']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->cat_numeros_partes['skAreas'];
                }else{
                    return false;
                }
            }
          /* TERMINA create_cat_numeros_partes */
        
        public function create_cat_numerosParte(){
            $sql = "INSERT INTO cat_numerosParte_fraccionesArancelarias (skFraccionArancelaria,skNumeroParte,sNombre,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES ('".$this->numparfraran['skFraccionArancelaria']."','".$this->numparfraran['skNumeroParte']."','".$this->numparfraran['sNombre']."',
                    '".$this->numparfraran['skStatus'].",'".$this->numparfraran['dFechaCreacion']."','".$this->numparfraran['skStatus']."',
                    CURRENT_TIMESTAMP,'".$this->numparfraran['skUsersCreacion']."')";
            $result = $this->db->query($sql);
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
                $sql .= " skFraccionArancelaria = '".$this->numparfraran['skNumeroParte']."' WHERE skFraccionArancelaria = '".$this->numparfraran['skFraccionArancelaria']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->numparfraran['skFraccionArancelaria'];
                }else{
                    return false;
                }
            }
        
        
        

        
    }
?>
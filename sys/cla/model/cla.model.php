<?php
    Abstract Class Cla_Model Extends Core_Model {

        // PUBLIC VARIABLES //
        public $cat_descripcionFraccion_archivos = array(
             'skFraccionArancelariaDescripcion'  =>  ''
            ,'sArchivo'     =>  ''
            ,'skStatus'     =>  ''
            ,'limit'        =>  ''
            ,'offset'       =>  ''
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

        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
            parent::__construct();
        }

        public function __destruct(){

        }
        
        /* COMIENZA MODULO clasifiación arancelaria */
        
        /* COMIENZA cat_descripcionFraccion_archivos */
        public function create_numparfraran(){
            $sql = "INSERT INTO cat_descripcionFraccion_archivos (skFraccionArancelariaDescripcion,sArchivo,skStatus) 
            VALUES ('".$this->numparfraran['skFraccionArancelariaDescripcion']."','".$this->numparfraran['sArchivo']."','".$this->numparfraran['skStatus']."')";
            $result = $this->db->query($sql);
            if($result){
                return $this->areas['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        /* TERMINA cat_descripcionFraccion_archivos */
        
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
       
       
       
       
       
       
       
       
       
       
       
       
       
       
        /* COMIENZA create_cat_numeros_partes */
        public function create_cat_numeros_partes(){
            $sql = "INSERT INTO cat_numeros_partes (skNumeroParte,sNombre,sDescripcion,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES ('".$this->cat_numeros_partes['skNumeroParte']."','".$this->cat_numeros_partes['sNombre']."','".$this->cat_numeros_partes['sDescripcion']."','".$this->cat_numeros_partes['skStatus'].",'".$this->cat_numeros_partes['dFechaCreacion']."','".$this->cat_numeros_partes['skStatus']."',CURRENT_TIMESTAMP,'".$this->cat_numeros_partes['skUsersCreacion']."')";
            $result = $this->db->query($sql);
            if($result){
                return $this->cat_numeros_partes['skNumeroParte'];
            }else{
                return false;
            }
        }
          
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
        
        public function create_cat_numeros_partes(){
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
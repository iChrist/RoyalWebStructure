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

        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
            parent::__construct();
        }

        public function __destruct(){

        }
        
        /* COMIENZA MODULO clasifiación arancelaria */
        
        /* COMIENZA cat_descripcionFraccion_archivos */
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
    }
?>
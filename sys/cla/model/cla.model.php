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
            $sql = "INSERT INTO cat_descripcionFraccion_archivos (skFraccionArancelariaDescripcion,sArchivo,skStatus) VALUES ('".$this->areas['skFraccionArancelariaDescripcion']."','".$this->areas['sArchivo']."','".$this->areas['skStatus']."')";
            $result = $this->db->query($sql);
            if($result){
                return $this->areas['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        /* TERMINA cat_descripcionFraccion_archivos */
        
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */
    }
?>
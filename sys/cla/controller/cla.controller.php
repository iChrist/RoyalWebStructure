<?php
    require_once(SYS_PATH."cla/model/cla.model.php");
    Class Cla_Controller Extends Cla_Model {
        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
                parent::__construct();
        }

        public function __destruct(){

        }

        /* COMIENZA MODULO clasifiación arancelaria */
        public function index(){
            //echo 432234234234;
            
            $this->desArc['skFraccionArancelariaDescripcion'] = !empty($_POST['skFraccionArancelariaDescripcion']) ? $_POST['skFraccionArancelariaDescripcion'] : substr(md5(microtime()), 1, 32);
            $this->create_cat_descripcionFraccion_archivos();
            
            $this->fraAraDes['skFraccionArancelariaDescripcion'] = !empty($_POST['skFraccionArancelariaDescripcion']) ? $_POST['skFraccionArancelariaDescripcion'] : substr(md5(microtime()), 1, 32);
            $this->create_cat_fraccionesArancelarias_descripcionFraccion();
            
            $this->desArc['sNombre'] = utf8_decode($_POST['sNombre']);
            
        }
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */    
    }
?>

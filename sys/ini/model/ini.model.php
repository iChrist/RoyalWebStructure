<?php
	Abstract Class Ini_Model Extends Core_Model {
                
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
            
            
                       
	}
?>
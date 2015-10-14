<?php
	require_once(SYS_PATH."ini/model/ini.model.php");
	Class Ini_Controller Extends Ini_Model {

		// PRIVATE VARIABLES //
                    private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
		
		}

                /* COMIENZA MODULO areas */
                 
                public function func_cata(){
                    
                    
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('func-cata', $this->data);
                }
                
                              
	}
?>

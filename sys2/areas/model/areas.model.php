<?php
	abstract class Areas_Model extends Core_Model {
		
		// PROTECTED VARIABLES //
			protected $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function index(){
			// OPERACIONES A BASE DE DATOS //
			echo "<br>--MODELO DE AREAS (otra carpeta)--<br>";
		}

	}
?>
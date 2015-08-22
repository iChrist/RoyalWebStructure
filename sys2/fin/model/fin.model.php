<?php
	abstract class Fin_Model extends Core_Model {
	
		// PRIVATE VARIABLES //
			private $_data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function index(){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

	}
?>
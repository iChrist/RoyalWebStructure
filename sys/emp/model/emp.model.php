<?php
	abstract class Emp_Model extends Core_Model {
	
		// PRIVATE VARIABLES //
			private $_data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function GetConsMod(){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules";
			//echo $sql;
			$result = $this->cone->query($sql);
			return $result;
		}
		
		public function GetConsEmp(){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules";
			//echo $sql;
			$result = $this->cone->query($sql);
			return $result;
		}

	}
?>
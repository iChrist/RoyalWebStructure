<?php
	abstract class Fin_Model extends Core_Model {
	
		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function getModulos(){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules";
			$result = $this->db->query($sql);

		}

		public function editorEntidad(){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules limit 1 ";
			$result = $this->db->query($sql);
			$this->data["EdicionEntidad"] = $result;


			$sql = "SELECT * FROM _modules";
			$result = $this->db->query($sql);
			$this->data["EdicionDomicilio"] = $result;

			return $this->data;

		}
		

		public function getEntidades(){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules";
			$result = $this->db->query($sql);
			return $result;
		}

		public function editSeccion($aaaa){
			// OPERACIONES A BASE DE DATOS //
			$sql = "SELECT * FROM _modules";
			$result = $this->db->query($sql);
			return $result;
		}

	}
?>
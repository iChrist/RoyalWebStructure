<?php
	echo "areas.controller.php<br>";
	require_once("../../sys/".$_GET["module"]."/model/areas.model.php");
	class Areas_Controller extends Areas_Model {
		
		protected $act = NULL;

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function index(){
			// REGLAS DE NEGOCIO //
			$data["datos"] = parent::index();
			$data["title"] = "Titulo";
			$this->load_view("index" , $data);
		}

		public function otro_metodo_1(){
			echo "otro_metodo_1<br>";
		}

		public function consulta(){
			echo "metodo consulta<br>";
			$this->load_view("index");
		}
	}
?>
<?php
	require_once("../../sys/".$_GET["pmodule"]."/model/areas.model.php");
	class Areas_Controller extends Areas_Model {
		
		protected $act = NULL;

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){

		}

		public function index(){
			if($_POST){
				echo "<hr><pre>".print_r($_POST,1)."</pre><hr>";
			}else{
				$data["datos"] = parent::index();
				$this->load_view("index" , $data);
			}
		}

		public function finanzas(){
			echo "<br>FINANZAS<br>";
		}

		public function otro_metodo_1(){
			header('Content-Type: application/json');
			$a = array("p1" => "c1","p2" => "c2","p3" => "c3");
			echo json_encode($a);
		}

		public function consulta(){
			// SWITCH
			echo "metodo Consulta<br>";
			$data["datos"] = parent::index();
			$data["title"] = "Titulo";
			$data["dia"] = "jueves";
			$this->load_view("index" , $data);
		}
	}
?>
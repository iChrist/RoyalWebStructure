<?php
	require_once(SYS_PATH.$_GET["sysModule"]."/model/".$_GET["sysModule"].".model.php");
	class Fin_Controller extends Fin_Model {

		// PRIVATE VARIABLES //
			private $_data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			if($this->is_view_required()){
				$this->load_view($_GET["sysFunction"], $this->_data);
			}
		}

		public function index(){
			$this->require_view(); echo "sf";
			$this->load_model("areas","areas/model/");
			Areas_Model::index();
			$this->load_model("otro");
			Otro_Model::index();
		}

		public function fin_ban_con(){
			$this->_data["datos"] = parent::index();
			
		}

		public function otro_metodo(){
			header('Content-Type: application/json');
			$a = array("p1" => "c1","p2" => "c2","p3" => "c3");
			echo json_encode($a);
		}
	}
?>
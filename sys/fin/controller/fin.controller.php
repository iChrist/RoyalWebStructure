<?php
	require_once(SYS_PATH.$_GET["sysModule"]."/model/".$_GET["sysModule"].".model.php");
	class Fin_Controller extends Fin_Model {

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			if($this->is_view_required()){
				$this->load_view($_GET["sysFunction"], $this->data);
			}
		}

		public function index(){
			$this->require_view();
			$this->data["datos"] = parent::getModulos();
		}

		public function fin_ban_con(){
			if($_POST){
				switch ($_POST["axn"]) {
					case 'value':
						# code...
						break;
					
					default:
						# code...
						break;
				}
				var_dump($_POST);
				$this->require_view(FALSE);
			}else{
				//$this->data["datos"] = parent::getModulos();
				//$this->data["comboEntidades"] = parent::getModulos();
					$this->data["infoEdicion"] = parent::editorEntidad();
					$this->load_model("otro");
				$_GET['v1'] = 34;
				if($_GET['v1']){
					//$this->data["infoEdicion"] = parent::editorEntidad();
				}
			}
			
			/*$this->load_model("otro");
			Otro_Model::index();
			$this->data["entidades"] = parent::getEntidades();*/
		}


		public function otro_metodo(){
			header('Content-Type: application/json');
			$a = array("p1" => "c1","p2" => "c2","p3" => "c3");
			echo json_encode($a);
		}
	}
?>
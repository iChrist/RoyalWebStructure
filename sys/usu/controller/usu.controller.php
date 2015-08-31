<?php
	require_once(SYS_PATH."usu/model/usu.model.php");
	class Usu_Controller extends Usu_Model {

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
			$this->require_view(FALSE);
			$this->data["datos"] = parent::verifyUser();
		}
	}
?>
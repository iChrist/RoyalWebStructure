<?php
	require_once(SYS_PATH."usu/model/usu.model.php");
	Class Usu_Controller Extends Usu_Model {

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			if($this->is_view_required()){
				$this->load_view($_GET["sysController"], $this->data);
			}
		}

		public function index(){
			$this->require_view(FALSE);
			$this->data["datos"] = parent::verifyUser();
		}
                
                public function usu_con(){
                    $this->require_view();
                }
	}
?>
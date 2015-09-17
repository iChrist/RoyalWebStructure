<?php
	require_once(SYS_PATH."perf/model/perf.model.php");
	Class Perf_Controller Extends Perf_Model {

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
            echo 'Index';
        }

		public function conf_perf_con(){
			//$this->require_view(); 
			$this->data["perfiles"] = parent::read();
		}

		public function conf_perf_form(){
			 //$this->require_view();
			 if($_POST){
			 	echo 34564564;
			 }else{ 
				$this->data["perfiles"] = parent::create();
			}
		}

	}
?>
<?php
	require_once(SYS_PATH.$_GET["sysModule"]."/model/".$_GET["sysModule"].".model.php");
	class Tra_Controller extends Tra_Model {

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
	}
?>
<?php
	require_once(SYS_PATH.$_GET["sysModule"]."/model/".$_GET["sysModule"].".model.php");
	class Emp_Controller extends Emp_Model {

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

		public function emp_soco_con(){
				/*$this->require_view();
				$this->_data['modulos']= $this->GetConsMod(); 
				$this->_data['empresas']=$this->GetConsEmp(); */
				//$this->load_view('index',array(),TRUE);
			//	$this->_data= parent::GetConsEmp(); 
			//	$this->_data= Emp_Model::GetConsEmp(); 
			
			
		}
	 
	 
	}
?>
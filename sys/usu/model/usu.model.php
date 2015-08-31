<?php
	Abstract Class Usu_Model Extends Core_Model {

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function getUsers(){
			$sql = "SELECT * FROM _modules";
			$result = $this->db->query($sql);

		}
                
                public function verifyUser($sUserName,$sPassword){
			$sql = "SELECT * FROM _users WHERE (sEmail = '".$sUserName."' OR sUserName = '".$sUserName."') AND (sPassword = '".$sPassword."') AND (skStatus = 'AC')";
			$result = $this->db->query($sql);
                        return $result;
		}
	}
?>
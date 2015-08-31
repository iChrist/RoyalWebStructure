<?php
	abstract class Usu_Model extends Core_Model {

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
			$sql = "SELECT * FROM _users WHERE (sEmail = '".$sUserName."' OR sUserName = '".$sUserName."') AND (sPassword = '".$sPassword."')";
			$result = $this->db->query($sql);
                        return $result;
		}
	}
?>
<?php
	Abstract Class Perf_Model Extends Core_Model {

		// PUBLIC VARIABLES //
			public $skProfiles;
			public $sName;
			public $skStatus;
			public $dCreated;

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		/*public function getUsers(){
			$sql = "SELECT * FROM _users";
			$result = $this->db->query($sql);

		}
                
                public function verifyUser($sUserName,$sPassword){
			$sql = "SELECT * FROM _users WHERE (sEmail = '".$sUserName."' OR sUserName = '".$sUserName."') AND (sPassword = '".$sPassword."') AND (skStatus = 'AC')";
			$result = $this->db->query($sql);
                        return $result;
		}*/
		public function create(){
                        $sql="SELECT REPLACE(uuid(),'-','') AS uuid"; 
                        $this->skProfiles = $this->db->query($sql)->fetch_assoc();
                        $sql= "INSERT INTO _profiles (skProfiles,sName,skStatus) VALUES ('".$this->skProfiles['uuid']."','$this->sName','$this->skStatus')";
			$result = $this->db->query($sql);
			if ($result) {
				return $this->skProfiles;
			}else{
				return false;
			}
		}

		public function read(){
			$sql= "SELECT * FROM _profiles";
                        if($this->skProfiles){
                            $sql .=" WHERE skProfiles = '$this->skProfiles'";
                        }
			$result = $this->db->query($sql);
                        return $result;
		}

		public function update(){
			$sql="UPDATE _profiles SET sName='$this->sName', skStatus='$this->skStatus' WHERE skProfiles='$this->skProfiles'";
			$result = $this->db->query($sql);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}

		public function delete(){
			$sql="UPDATE _profiles SET skStatus='$this->skStatus' WHERE skProfiles='$this->skProfiles'";
			$result = $this->db->query($sql);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}
	}
?>
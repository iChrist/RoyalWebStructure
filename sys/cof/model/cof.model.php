<?php
	Abstract Class Cof_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $users = array(
                    'skUsers'       =>  ''
                    ,'sName'        =>  ''
                    ,'sEmail'       =>  ''
                    ,'sUserName'    =>  ''
                    ,'sPassword'    =>  ''
                    ,'skStatus'     =>  ''
                    ,'dCreated'     =>  ''
                );
                public $skUsers;
                public $sName;
                public $sEmail;
                public $sUserName;
                public $sPassword;
                public $skStatus;
                public $dCreated;
                public $skProfiles;
                    
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
            
            public function create(){
                $this->skUsers = substr(md5(microtime()), 0, 32);
                $sql = "INSERT INTO _users (skUsers,sName,sEmail,sUserName,sPassword,skStatus) VALUES ('$this->skUsers','$this->sName','$this->sEmail','$this->sUserName','$this->sPassword','$this->skStatus')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->skUsers;
                }else{
                    return false;
                }
            }
            public function read_user(){
                $sql = "SELECT * FROM _users WHERE 1=1 ";
                if(!empty($this->skUsers)){
                    $sql .= " AND skUsers = '$this->skUsers' ";
                }
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            
            public function update(){
                
                $sql = "UPDATE _users SET sName='$this->sName', sEmail='$this->sEmail', sUserName='$this->sUserName', sPassword='$this->sPassword', skStatus='$this->skStatus' WHERE skUsers = '$this->skUsers' ";
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            
            public function delete(){
                
                $sql = "UPDATE _users SET skStatus='$this->skStatus' WHERE skUsers = '$this->skUsers' ";
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            
            public function count_user(){
                $sql = "SELECT COUNT(*) AS total FROM _users WHERE 1=1 ";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }

            
            public function getUsers(){
                    $sql = "SELECT * FROM _users";
                    $result = $this->db->query($sql);

            }

            public function verifyUser($sUserName,$sPassword){
                    $sql = "SELECT * FROM _users WHERE (sEmail = '".$sUserName."' OR sUserName = '".$sUserName."') AND (sPassword = '".$sPassword."') AND (skStatus = 'AC')";
                    $result = $this->db->query($sql);
                    return $result;
            }
            
            
            
           public function create_profile(){
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

		public function read_profile(){
			$sql= "SELECT pr.*, st.sName AS Estatus FROM _profiles pr
				INNER JOIN _status st ON st.skStatus = pr.skStatus";
                        if($this->skProfiles){
                            $sql .=" WHERE pr.skProfiles = '$this->skProfiles'";
                        }
                        $result = $this->db->query($sql);
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
			
		}

		public function update_profile(){
			$sql="UPDATE _profiles SET sName='$this->sName', skStatus='$this->skStatus' WHERE skProfiles='$this->skProfiles'";
			$result = $this->db->query($sql);
			if ($result) {
				return true;
			}else{
				return false;
			}
		}

		public function delete_profile(){
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
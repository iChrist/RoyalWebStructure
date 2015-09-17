<?php
	Abstract Class Usu_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $skUsers;
                public $sName;
                public $sEmail;
                public $sUserName;
                public $sPassword;
                public $skStatus;
                public $dCreated;
                    
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
            
            public function create(){
                $sql = "INSERT INTO (skUsers,sName,sEmail,sUserName,sPassword,skStatus) VALUES ('$this->skUsers','$this->sName','$this->sEmail','$this->sUserName','$this->sPassword','$this->skStatus')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->db->last_query();
                }else{
                    return false;
                }
            }
            public function read(){
                $sql = "SELECT * FROM _users";
                $result = $this->db->query($sql);
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
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
            
            

            
            public function getUsers(){
                    $sql = "SELECT * FROM _users";
                    $result = $this->db->query($sql);

            }

            public function verifyUser($sUserName,$sPassword){
                    $sql = "SELECT * FROM _users WHERE (sEmail = '".$sUserName."' OR sUserName = '".$sUserName."') AND (sPassword = '".$sPassword."') AND (skStatus = 'AC')";
                    $result = $this->db->query($sql);
                    return $result;
            }
	}
?>
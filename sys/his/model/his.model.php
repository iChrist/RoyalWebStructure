<?php
	Abstract Class His_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $access = array(
                    'sName'       		=>  ''
                    ,'skModules'   			=>  ''
                    ,'sIp'       			=>  ''
                    ,'dAccess'      			=>  ''
					,'limit'        			=>  ''
                    ,'offset'       			=>  ''
						
                );
				
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
			
            public function count_access(){

                $sql = " SELECT COUNT(_accessLog.skUsers)AS total  
						FROM _accessLog  
						INNER JOIN _users ON _users.skUsers = _accessLog.skUsers  
						WHERE 1=1 ";
                if(!empty($this->access['sName'])){
                    $sql .= " AND CONCAT(_users.sName,' ',_users.sLastNamePaternal,' ',_users.sLastNameMaternal) Like '%".$this->access['sName']."%' ";
                }
                if(!empty($this->access['skModules'])){
                    $sql .= " AND _accessLog.skModules like '%".$this->access['skModules']."%'";
                }
                if(!empty($this->access['sIp'])){
                    $sql .= " AND sIp like '%".$this->access['sIp']."%'";
                }
              //echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
			public function read_access(){
                $sql = " SELECT _accessLog.*,CONCAT(_users.sName,' ',_users.sLastNamePaternal,' ',_users.sLastNameMaternal) as sName
						FROM _accessLog 
						INNER JOIN _users ON _users.skUsers = _accessLog.skUsers 
						WHERE 1=1 ";
                if(!empty($this->access['sName'])){
                    $sql .= " AND CONCAT(_users.sName,' ',_users.sLastNamePaternal,' ',_users.sLastNameMaternal) Like '%".$this->access['sName']."%' ";
                }
                if(!empty($this->access['skModules'])){
                    $sql .= " AND _accessLog.skModules like '%".$this->access['.sName']."%'";
                }
                if(!empty($this->access['sIp'])){
                    $sql .= " AND _accessLog.sIp like '%".$this->access['sIp']."%'";
                }
         		$sql .= " ORDER BY _accessLog.dAccess DESC";
				if(is_int($this->access['limit'])){
                    if(is_int($this->access['offset'])){
                        $sql .= " LIMIT ".$this->access['offset']." , ".$this->access['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->access['limit'];
                    }
                }
				//echo $sql;die();
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }

			          
	}
?>
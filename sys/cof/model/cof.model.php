<?php
	Class Cof_Model Extends Core_Model {

            // PUBLIC VARIABLES //

				  public $users = array(
                    'skUsers'       		=>  ''
                    ,'skUsersDistinto'   	=>  ''
                    ,'sName'       			=>  ''
                    ,'sEmail'      			=>  ''
                    ,'sUserName'			=>  ''
                    ,'sPassword'    		=>  ''
                    ,'skStatus'     		=>  ''
                    ,'dCreated'     		=>  ''
                    ,'sGroup'=>''
                    ,'limit'        			=>  ''
                    ,'offset'       			=>  ''
                    ,'orderBy' => NULL
                );
                public $profiles = array(
                    'skProfiles'       	=>  ''
                    ,'sName'      		=>  ''
                     ,'skStatus'    	=>  ''
                    ,'dCreated'     	=>  ''
                    ,'limit'        		=>  ''
                    ,'offset'       		=>  ''
                );
								public $sucursales = array(
                    'skSucursal'       	=>  ''
                    ,'sNombre'      		=>  ''
                     ,'skEstatus'    	=>  ''
                    ,'limit'        		=>  ''
                    ,'offset'       		=>  ''
                );
                public $skUsers;
                public $skUsersDistinto;
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

            /**/
            public function read_status(){
                $sql = "SELECT * FROM _status";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            /**/
            public function create_Users(){

								$sql = "INSERT INTO _users (skUsers,sName,sLastNamePaternal,sLastNameMaternal,sEmail,sUserName,sPassword,skStatus,sGroup)
								VALUES ('".$this->users['skUsers']."','".$this->users['sName']."','".$this->users['sLastNamePaternal']."','".$this->users['sLastNameMaternal']."','".$this->users['sEmail']."','".$this->users['sUserName']."','".$this->users['sPassword']."','".$this->users['skStatus']."','".$this->users['sGroup']."')";
              //  echo "<br><br><br><br><br>".$sql;
                $result = $this->db->query($sql);
                if($result){
                    return $this->users['skUsers'];
                }else{
                    return false;
                }
            }
            public function read_user(){
                $sql = "SELECT DISTINCT _users.*, _status.sName AS status, _status.sHtml,
								us.skSocioEmpresa
								FROM _users
								INNER JOIN _status ON _status.skStatus = _users.skStatus
								INNER JOIN _users_profiles us ON us.skUsers = _users.skUsers
								WHERE 1=1 ";
                if(!empty($this->users['skUsersDistinto'])){
                    $sql .= " AND _users.skUsers <> '".$this->users['skUsersDistinto']."' ";
                }
								if(!empty($this->users['skUsers'])){
				                    $sql .= " AND _users.skUsers ='".$this->users['skUsers']."' ";
				                }
								if(!empty($this->users['sName'])){
				                    $sql .= " AND _users.sName = '".$this->users['sName']."'";
				                }
								if(!empty($this->users['sEmail'])){
				                    $sql .= " AND _users.sEmail = '".$this->users['sEmail']."'";
				                }
								if(!empty($this->users['sUserName'])){
				                    $sql .= " AND _users.sUserName = '".$this->users['sUserName']."'";
				                }
                                                if(!is_null($this->users['orderBy'])){
                                                    $sql .=" ORDER BY ".$this->users['orderBy'];
                                                }
				                if(is_int($this->users['limit'])){
				                    if(is_int($this->users['offset'])){
				                        $sql .= " LIMIT ".$this->users['offset']." , ".$this->users['limit'];
				                    }else{
				                        $sql .= " LIMIT ".$this->users['limit'];
				                    }
				                }
						//exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }

            public function read_user_profile(){
							$sql = "SELECT * FROM _users_profiles  WHERE 1=1 AND skUsers = '".$this->users['skUsers']."' ";
					    $result = $this->db->query($sql);
          		return $result;
            }

						public function read_user_sucursales(){
							$sql = "SELECT * FROM _users_sucursales  WHERE 1=1 AND skUsers = '".$this->users['skUsers']."' ";
					    $result = $this->db->query($sql);
          		return $result;
            }

            public function read_filter_user(){
                $sql = "SELECT _users.*, _status.sName AS status, _status.sHtml  FROM _users INNER JOIN _status ON _status.skStatus = _users.skStatus WHERE 1=1 ";
                if(!empty($this->users['skUsers'])){
                    $sql .= " AND skUsers = '".$this->users['skUsers']."' ";
                }
                if(!empty($this->users['sName'])){
                    $sql .= " AND _users.sName like '%".$this->users['sName']."%'";
                }
                if(!empty($this->users['sEmail'])){
                    $sql .= " AND sEmail like '%".$this->users['sEmail']."%'";
                }
                if(!empty($this->users['sUserName'])){
                    $sql .= " AND sUserName like '%".$this->users['sUserName']."%'";
                }
                if(!empty($this->users['skStatus'])){
                    $sql .= " AND _users.skStatus like '%".$this->users['skStatus']."%'";
                }
                if(is_int($this->users['limit'])){
                    if(is_int($this->users['offset'])){
                        $sql .= " LIMIT ".$this->users['offset']." , ".$this->users['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->users['limit'];
                    }
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

            public function update_Users(){

                $sql = "UPDATE _users
								SET sName='".$this->users['sName']."',
				                    sLastNamePaternal='".$this->users['sLastNamePaternal']."',
				                    sPassword='".$this->users['sPassword']."',
				                    sLastNameMaternal='".$this->users['sLastNameMaternal']."',
				                    sEmail='".$this->users['sEmail']."',
				                    sUserName='".$this->users['sUserName']."',
				                    sGroup='".$this->users['sGroup']."',
				                    skStatus='".$this->users['skStatus']."'
				                    WHERE skUsers = '".$this->users['skUsers']."'";
				          	$result = $this->db->query($sql);
										//echo $sql;die();
										$sql = "DELETE FROM _users_profiles  WHERE skUsers = '".$this->users['skUsers']."'";
				                $this->db->query($sql);
												if($result){
				                    return TRUE;
				                }else{
				                    return FALSE;
				                }
												$sql = "DELETE FROM _users_sucursales  WHERE skUsers = '".$this->users['skUsers']."'";

												die();

								        $this->db->query($sql);
				                if($result){
				                    return TRUE;
				                }else{
				                    return FALSE;
				                }
				      }

            public function delete(){
                $sql = "UPDATE _users SET skStatus='".$this->users['skStatus']."' WHERE skUsers = '".$this->users['skUsers']."' ";
                $result = $this->db->query($sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }

            public function count_user(){
                $sql = "SELECT COUNT(*) AS total FROM _users WHERE 1=1 ";
                if(!empty($this->users['skUsers'])){
                    $sql .= " AND skUsers = '".$this->users['skUsers']."' ";
                }
                if(!empty($this->users['sName'])){
                    $sql .= " AND _users.sName like '%".$this->users['sName']."%'";
                }
                if(!empty($this->users['sEmail'])){
                    $sql .= " AND sEmail like '%".$this->users['sEmail']."%'";
                }
                if(!empty($this->users['sUserName'])){
                    $sql .= " AND sUserName like '%".$this->users['sUserName']."%'";
                }
                if(!empty($this->users['skStatus'])){
                    $sql .= " AND _users.skStatus like '%".$this->users['skStatus']."%'";
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


            public function getUsers(){
                    $sql = "SELECT * FROM _users";
                    $result = $this->db->query($sql);

            }

            public function verifyUser($sUserName,$sPassword){
                    $sql = "SELECT * FROM _users WHERE (sEmail = '".$sUserName."' OR sUserName = '".$sUserName."') AND (sPassword = '".$sPassword."') AND (skStatus = 'AC')";
                    $result = $this->db->query($sql);
                    return $result;
            }
						public function verifyUserEmpresas($sUsuario){
                    $sql = "SELECT * FROM _users_profiles WHERE skUsers = '".$sUsuario."'";
                    $result = $this->db->query($sql);
                    return $result;
            }
						public function verifyUserSucursales($sUsuario){
                    $sql = "SELECT * FROM _users_profiles WHERE skUsers = '".$sUsuario."'";
                    $result = $this->db->query($sql);
                    return $result;
            }



           public function create_profile(){
           				 //$this->skProfiles['skProfiles'] = substr(md5(microtime()), 0, 32);
                         $sql= "INSERT INTO _profiles (skProfiles,sName,skStatus) VALUES ('".$this->profiles['skProfiles']."','".$this->profiles['sName']."','".$this->profiles['skStatus']."')";
                         //echo $sql;
                         //die();
									$result = $this->db->query($sql);
									if ($result) {
										return $this->profiles['skProfiles'];
									}else{
										return false;
									}
						}


           public function count_profile(){
                $sql = "SELECT COUNT(*) AS total FROM _profiles WHERE 1=1 ";
                if(!empty($this->skProfiles)){
                    $sql .= " AND skProfiles = '".$this->skProfiles."' ";
                }
                if(!empty($this->profiles['sName'])){
                    $sql .= " AND _profiles.sName like '%".$this->profiles['sName']."%'";
                }
                if(!empty($this->profiles['skStatus'])){
                    $sql .= " AND _profiles.skStatus like '%".$this->profiles['skStatus']."%'";
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

           public function read_filter_profile(){
                $sql = "SELECT _profiles.*, _status.sName AS status, _status.sHtml  FROM _profiles INNER JOIN _status ON _status.skStatus = _profiles.skStatus WHERE 1=1 ";
                if(!empty($this->skProfiles)){
                    $sql .= " AND skUsers = '$this->skProfiles' ";
                }
                if(!empty($this->profiles['sName'])){
                    $sql .= " AND _profiles.sName like '%".$this->profiles['sName']."%'";
                }

                if(!empty($this->profiles['skStatus'])){
                    $sql .= " AND _profiles.skStatus like '%".$this->profiles['skStatus']."%'";
                }
                if(is_int($this->profiles['limit'])){
                    if(is_int($this->profiles['offset'])){
                        $sql .= " LIMIT ".$this->profiles['offset']." , ".$this->profiles['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->profiles['limit'];
                    }
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

           public function read_profile(){
                $sql = "SELECT _profiles.*, _status.sName AS status, _status.sHtml  FROM _profiles INNER JOIN _status ON _status.skStatus = _profiles.skStatus WHERE 1=1 ";
                if(!empty($this->skProfiles)){
                    $sql .= " AND skProfiles = '".$this->skProfiles."' ";
                }

                if(!empty($this->profiles['sName'])){
                    $sql .= " AND sName = '".$this->profiles['sName']."'";
                }
                  if(is_int($this->profiles['limit'])){
                    if(is_int($this->profiles['offset'])){
                        $sql .= " LIMIT ".$this->profiles['offset']." , ".$this->profiles['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->profiles['limit'];
                    }
                }
               /* echo $sql;
                die();*/
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }


           public function update_profile(){
							 $sql = "	UPDATE _profiles
										SET sName='".$this->profiles['sName']."',
				 						skStatus='".$this->profiles['skStatus']."'
										WHERE skProfiles = '".$this->profiles['skProfiles']."' ";
									//	echo $sql;
										//die();
				                $result = $this->db->query($sql);
				                if($result){
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

	           public function consulta_Profile(){
							 $sql = " SELECT  ".
							 " pr.skProfiles , ".
							 " pr.sName, ".
							 " pr.skStatus, ".
							 " ce.sNombre AS empresaUsuario , usp.skSocioEmpresa, ".
							 " res.skEmpresa AS skEmpresaUsuario,rp.skSocioEmpresa AS skSocioPropietario,cep.skEmpresa AS skEmpresaPropietario ".
							 "	 FROM _users us ".
								"	 INNER JOIN _users_profiles usp ON usp.skUsers = us.skUsers ".
								"	 INNER JOIN _profiles pr ON pr.skProfiles = usp.skProfiles ".
								"	 INNER JOIN rel_empresas_socios res ON res.skSocioEmpresa = usp.skSocioEmpresa ".
								"	 INNER JOIN cat_empresas ce ON ce.skEmpresa = res.skEmpresa ".
								"	 LEFT JOIN rel_empresas_socios rp ON rp.skSocioEmpresa = res.skSocioEmpresaP ".
								"	 LEFT JOIN cat_empresas cep ON cep.skEmpresa = rp.skEmpresa ".
								"	 WHERE pr.skStatus = 'AC' AND us.skUsers ='".($_SESSION['session']['skUsers'])."'".
								(isset($var1) ? " AND usp.skProfiles = '".$var1."' " : '').
								(isset($var2) ? " AND usp.skSocioEmpresa = '".$var2."' " : '').
							  "  order by pr.sName ASC";
							$result = $this->db->query($sql);
							if ($result) {
 								return $result;
							}else{
								return false;
							}
						}
						public function consulta_Profile1($var1,$var2){
							$sql = " SELECT  ".
							" pr.skProfiles , ".
							" pr.sName, ".
							" pr.skStatus, ".
							" ce.sNombre AS empresaUsuario , usp.skSocioEmpresa, ".
							" res.skEmpresa AS skEmpresaUsuario,rp.skSocioEmpresa AS skSocioPropietario,cep.skEmpresa AS skEmpresaPropietario ".
							"	 FROM _users us ".
							 "	 INNER JOIN _users_profiles usp ON usp.skUsers = us.skUsers ".
							 "	 INNER JOIN _profiles pr ON pr.skProfiles = usp.skProfiles ".
							 "	 INNER JOIN rel_empresas_socios res ON res.skSocioEmpresa = usp.skSocioEmpresa ".
							 "	 INNER JOIN cat_empresas ce ON ce.skEmpresa = res.skEmpresa ".
							 "	 LEFT JOIN rel_empresas_socios rp ON rp.skSocioEmpresa = res.skSocioEmpresaP ".
							 "	 LEFT JOIN cat_empresas cep ON cep.skEmpresa = rp.skEmpresa ".
							 "	 WHERE pr.skStatus = 'AC' AND us.skUsers ='".($_SESSION['session']['skUsers'])."'".
							 (isset($var1) ? " AND usp.skProfiles = '".$var1."' " : '').
							 (isset($var2) ? " AND usp.skSocioEmpresa = '".$var2."' " : '').
							 "  order by pr.sName ASC";
						 $result = $this->db->query($sql);
						 if ($result) {
							 return $result;
						 }else{
							 return false;
						 }
					 }
           public function create_Users_profiles($valores) {
                    $sql = "INSERT INTO _users_profiles (skUsers, skProfiles, skSocioEmpresa ) VALUES ".$valores."";
                    //echo  $sql."<br><br><br>";die();
										$result = $this->db->query($sql);
                    if($result){
                        return true;
                    }else{
                        return false;
                    }
           }
           public function createPermissions($datos) {
                    $sql = "INSERT INTO _modules_profiles_permissions (skModule, skProfiles,skPermissions ) VALUES ".$datos."";
                    //echo $sql;
                    $result = $this->db->query($sql);
                    if($result){
                        return true;
                    }else{
                        return false;
                    }
           }
           public function delete_permission_profile($profile){
	                 $sql = " DELETE FROM _modules_profiles_permissions WHERE skProfiles = '".$profile."'";
                    //echo $sql;
                    $result = $this->db->query($sql);
                    if($result){
                        return true;
                    }else{
                        return false;
                    }

            }
					 public function read_sucursales(){
                 $sql = "SELECT cat_sucursales.*, _status.sName AS status, _status.sHtml  FROM cat_sucursales
								 INNER JOIN _status ON _status.skStatus = cat_sucursales.skEstatus WHERE 1=1 ";


                 $result = $this->db->query($sql);
                 if($result){
                     if($result->num_rows > 0){
                         return $result;
                     }else{
                         return false;
                     }
                 }
            }
						public function create_Users_sucursales($valores1) {
										 $sql = "INSERT INTO _users_sucursales (skUsers, skSucursal ) VALUES ".$valores1."";
										 //echo  $sql."<br><br><br>";die();
										 $result = $this->db->query($sql);
										 if($result){
												 return true;
										 }else{
												 return false;
										 }
						}
						public function read_empresas_usuarios(){
								$sql = ' SELECT ce.*,res.skSocioEmpresa, cte.sNombre AS tipoEmpresa  FROM cat_empresas ce
								INNER JOIN rel_empresas_socios res ON res.skEmpresa = ce.skEmpresa
								INNER JOIN cat_tipos_empresas cte ON cte.skTipoEmpresa = res.skTipoEmpresa
								ORDER BY ce.sNombre ASC';
								$result = $this->db->query($sql);
								if($result){
										return $result;
								}else{
										return false;
								}

						}
	}
?>

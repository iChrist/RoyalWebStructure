<?php
	Class Core_Model {
		
		// PUBLIC VARIABLES //
                public $skModule;
                public $tCodPrimerHijo;
                public $sParentModule;
                public $sModule;    
                public $sTitle;
                
                // PROTECTED VARIABLES //
			protected $db;

		// PRIVATE VARIABLES //
			private $data;

		public function __construct(){
			$this->db = mysqli_connect(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
			if (mysqli_connect_errno()){
				$text = "Failed to connect to database: ".mysqli_connect_error();
				$this->_error($text,500);
				die();
			}
			$this->_get_params();
			
			$this->require_view(TRUE);
			
		}

		public function __destruct(){
			if(!mysqli_connect_errno()){
                //mysqli_next_result($this->db);
				$this->db->close();
			}
		}
                
                protected function reconnect(){
                    mysqli_next_result($this->db);
                    $this->db->close();
                    $this->db = mysqli_connect(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
                }
                
		public function index(){
                    //echo "<hr><pre>".print_r($_GET,1)."</pre><hr>";
                    $this->load_controller($_GET["sysModule"] , $_GET["sysFunction"]);
		}
                

		private function _get_params(){
                    $_GET["sysModule"] = !empty($_GET["sysModule"]) ? str_replace("/","",$_GET["sysModule"]) : NULL;
                    $_GET["sysModule"] = !empty($_GET["sysModule"]) ? str_replace("-","_",$_GET["sysModule"]) : NULL;

                    $_GET["sysController"] = !empty($_GET["sysController"]) ? str_replace("/","",$_GET["sysController"]) : 'sys';
                    $_GET["sysController"] = !empty($_GET["sysController"]) ? str_replace("_","-",$_GET["sysController"]) : 'sys';

                    $_GET["sysFunction"] = !empty($_GET["sysController"]) ? str_replace("-","_",$_GET["sysController"]) : 'index';

                    $_GET["sysName"] = !empty($_GET["sysName"]) ? str_replace("/","",$_GET["sysName"]) : NULL;

                    $_GET["p1"] = !empty($_GET["p1"]) ? str_replace("/","",$_GET["p1"]) : NULL;
                    $_GET["p2"] = !empty($_GET["p2"]) ? str_replace("/","",$_GET["p2"]) : NULL;
                    $_GET["p3"] = !empty($_GET["p3"]) ? str_replace("/","",$_GET["p3"]) : NULL;
                    $_GET["p4"] = !empty($_GET["p4"]) ? str_replace("/","",$_GET["p4"]) : NULL;
                    $_GET["p5"] = !empty($_GET["p5"]) ? str_replace("/","",$_GET["p5"]) : NULL;
                    
                    $select = " SELECT DISTINCT".
                           " ss.skModule AS skModule,ss.sModule, ss.sParentModule, ss.iPosition, ss.sTitle,".
                           " sh.skModule AS tCodPrimerHijo, sh.sTitle AS tTituloPrimerHijo".
                           " FROM _modules ss".
                           " LEFT JOIN _modules sh ON sh.sParentModule = ss.skModule".
                           " WHERE ss.skModule='".$_GET["sysController"]."' AND ss.skStatus='AC'".
                           " ORDER BY ss.iPosition ASC, sh.iPosition LIMIT 1"; 
                    $result = $this->db->query($select);
                    $rSeccion = $result->fetch_assoc();
                    mysqli_free_result($result);
                    //mysqli_next_result($this->db);
                    $this->skModule =$rSeccion{'skModule'};
                    $this->tCodPrimerHijo =$rSeccion{'tCodPrimerHijo'};
                    $this->sParentModule = $rSeccion{'sParentModule'};
                    $this->sModule =$rSeccion['sModule'];    
                    $this->sTitle = $rSeccion['sTitle'];
		}

		protected function load_model($model = NULL, $path = NULL){
			if($path){
				if(file_exists(SYS_PATH.$path.$model.".model.php")){
					require_once(SYS_PATH.$path.$model.".model.php");
				}else{
					$text = "'".$model."' model not found.";
					$this->_error($text,404);
					die();
				}
			}else{
				if(file_exists(SYS_PATH.$_GET["sysModule"]."/model/".$model.".model.php")){
					require_once(SYS_PATH.$_GET["sysModule"]."/model/".$model.".model.php");
				}else{
					$text = "'".$model."' model not found.";
					$this->_error($text,404);
					die();
				}
			}
		}

		protected function load_controller($sysModule = NULL , $sysFunction = "index"){
                    if($sysModule == NULL){
                        if((isset($_SESSION['session']['skUsers'])) && (!empty($_SESSION['session']['skUsers']))){
                            if((isset($_SESSION['session']['skProfile'])) && (!empty($_SESSION['session']['skProfile']))){
                                require_once(CORE_PATH.'stage/header.php');
                                require_once(CORE_PATH.'stage/dashboard.php');
                                require_once(CORE_PATH.'stage/footer.php');
                            }else{
                               require_once(CORE_PATH.'profile.php');  
                            }
                        }else{
                            require_once(CORE_PATH."login.php");
                        }
                    }else{
                        if((isset($_SESSION['session']['skUsers'])) && (!empty($_SESSION['session']['skUsers']))){
                            if((isset($_SESSION['session']['skProfile'])) && (!empty($_SESSION['session']['skProfile']))){
                            
                                // VERIFICA SI EXISTE EL DIRECTORIO DEL MÓDULO.
                                if(is_dir(SYS_PATH.$sysModule."/")){
                                    // VERIFICA SI EXISTE EL CONTROLADOR DEL MÓDULO.
                                    if(file_exists(SYS_PATH.$sysModule."/controller/".$sysModule.".controller.php")){
                                        require_once(SYS_PATH.$sysModule."/controller/".$sysModule.".controller.php");
                                        $sysModule_controller = $sysModule."_Controller";
                                        $sysModule_model = new $sysModule_controller();
                                        if(method_exists($sysModule_model,$sysFunction)){
                                            $sql = "SELECT * FROM _modules WHERE skModule = '".$_GET["sysController"]."'";
                                            $result = $this->db->query($sql);
                                            if($result){
                                                if($result->num_rows > 0){
                                                    // VERIFICA LOS PERMISOS DEL USUARIO AUTENTICADO.
                                                    $_secutiry['_modules_profiles_permissions'] = $this->getModulesProfilesPermissions();
                                                    /*if(!empty($_secutiry['_modules_profiles_permissions'])){
                                                        if(array_key_exists('R' , $_secutiry['_modules_profiles_permissions'][$_GET['sysController']][$_SESSION['session']['skProfile']])){
                                                            $this->require_view(TRUE);
                                                            $sysModule_model->$sysFunction();
                                                        }else{
                                                            $this->require_view(FALSE);
                                                        }
                                                    }else{
                                                        $this->require_view(FALSE);
                                                    }*/
                                                    $this->require_view(TRUE);
                                                    $sysModule_model->$sysFunction();
                                                }else{
                                                    // VERIFICA LOS PERMISOS DEL USUARIO AUTENTICADO.
                                                    $this->require_view(FALSE);
                                                    $sysModule_model->$sysFunction();
                                                }
                                            }else{
                                                $text = "Object query not set.";
                                                $this->_error($text,500);
                                                die();
                                            }
                                        }else{
                                            $text = "Call to undefined method '".$sysFunction."' in '".$sysModule."' controller.";
                                            $this->_error($text,500);
                                            die();
                                        }
                                    }else{
                                        $text = "'".$sysModule."' controller not found.";
                                        $this->_error($text,404);
                                        die();
                                    }
                                }else{
                                    $text = "'".$sysModule."' is not a valid directory.";
                                    $this->_error($text,500);
                                    die();
                                }
                            }else{
                               require_once(CORE_PATH.'profile.php'); 
                            }
                        }else{
                            require_once(CORE_PATH.'login.php');
                        }
                    }
		}

		protected function load_view($view = "index", $data = array() , $templates = TRUE, $path = NULL){
			if(file_exists(SYS_PATH.$_GET["sysModule"]."/".$view.".php")){
				if($templates){
                                        $_secutiry['_users_profiles'] = $this->getUsersProfiles();
                                        $_secutiry['_modules_profiles_permissions'] = $this->getModulesProfilesPermissions();
                                        $_buttons = $this->getModulesButtons();
                                        
					require_once(CORE_PATH."stage/header.php");
                                        require_once(CORE_PATH."stage/buttons.php");
					include(SYS_PATH.$_GET["sysModule"]."/".$view.".php");
					require_once(CORE_PATH."stage/footer.php");
				}else{
					include(SYS_PATH.$_GET["sysModule"]."/".$view.".php");
				}
			}else{
				 $text = "'".$view."' view not found.";
				 $this->_error($text,404);
                                 die();
			}
		}

		protected function require_view($bool = TRUE){
			$_SESSION["sysRequireView"] = $bool;
		}

		protected function is_view_required(){
			return $_SESSION["sysRequireView"];
		}
                
                private function getModulesButtons(){
                    $sql = "CALL test('".$_GET['sysController']."');";
                    $result = $this->db->query($sql);
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $data[$row['iPosition']] = array(
                            'skModule' => $row['skModule']
                            ,'sParentModule' => $row['sParentModule']
                            ,'skButtons' => $row['skButtons']
                            ,'sHtml' => str_replace('{{url}}', SYS_URL.SYS_PROJECT.$row['sUrl'], htmlentities($row['sHtml'],ENT_QUOTES))
                            ,'skPermissions' => $row['skPermissions']
                            ,'sFunction' => $row['sFunction']
                            ,'iPosition' => $row['iPosition']
                        );
                    }
                    mysqli_free_result($result);
                    mysqli_next_result($this->db);
                    return $data;
                }
                
                public function getUsersProfiles(){
                    $sql = "SELECT up.skProfiles, p.sName FROM _users_profiles AS up
                        INNER JOIN _profiles AS p ON p.skProfiles = up.skProfiles
                        WHERE up.skUsers = '".$_SESSION['session']['skUsers']."'";
                    $result = $this->db->query($sql);
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        array_push($data, array(
                            'skProfiles'    =>  $row['skProfiles'],
                            'sName'         =>  $row['sName'],
                        ));
                    }
                    mysqli_free_result($result);
                    mysqli_next_result($this->db);
                    return $data;
                }
                
                public function getModulesProfilesPermissions(){
                    $sql = "CALL stpGetModulesProfilesPermissions('".$_GET['sysController']."','".$_SESSION['session']['skUsers']."', '".$_SESSION['session']['skProfile']."');";
                    $result = $this->db->query($sql);
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $data[$row['skModule']][$row['skProfiles']][$row['skPermissions']] = $row['sNamePermission'];
                    }
                    mysqli_free_result($result);
                    mysqli_next_result($this->db);
                    return $data;
                }
                
		public function _error(&$text, $error = 404){
                    require_once(CORE_PATH.$error.'.php');
                    exit;
                    //echo "<table border='1' style='width:100%;'><tr><td style='padding-top:20px;'><center><h3><span style='color:red;'>".$error." : </span>".$text."</h3></center></td></tr></table>";
		}
		
		
		public function breadcrumb(){
				$sql = "CALL stpConsultarBreadcrumb('".($_GET["sysController"] !='index' ? $_GET["sysController"] : 'sys')."',0); ";
				
					$result = $this->db->query($sql);	
					$html="";
					while($row= $result->fetch_assoc()){
					
							$html.='<li>
						<i class="fa fa-home"></i>
						<a href="'.SYS_URL.$row['sParentModule'].'/'.$row['skModule'].'/'.$row['sName'].'/">'.$row['sTitle'].'</a>
						<i class="fa fa-angle-right"></i>
					</li>';
							//$html.= $row['sPkModule']."<br>";
		
		
					}
					echo  $html;
					//return $result;
			
		}
		public function GetMenu($sMenu){
		
 						  $sql = " SELECT DISTINCT ss.skModule AS skModule,
						 	ss.iPosition AS iPosition,
							ss.sParentModule AS sParentModule,
							ss.sModule AS sModule,
							mi.sIcons  AS sIcons,
						 	ss.sTitle AS sTitle".
						  " FROM _modules ss".
						  " INNER JOIN _users su ON su.skUsers='".$_SESSION['session']['skUsers']."' ".
						  " INNER JOIN _modules_menu mm ON mm.skModule = ss.sKmodule  ".
						  "	LEFT JOIN _modules_icons mi ON mi.skModule = ss.sKmodule  ".
						//  (isset($_SESSION['sesionServicios']) ? " AND ss.bPublico=0" : " OR ss.bPublico=1").
						  " LEFT JOIN _modules_profiles_permissions ssp ON ssp.skProfiles = '".$_SESSION['session']['skProfile']."' AND ssp.sKmodule=ss.sKmodule ".
 						  " WHERE ". 
 						  " ss.skStatus='AC' ".
						  " AND mm.skMenu = '".$sMenu."'  ".
 						   (isset($_SESSION['session']) ? " AND (su.sGroup='A' OR ssp.skModule IS NOT NULL)" : "").
						 // (isset($_SESSION['session']) ? " AND ss.bPublico=0 AND (su.tCodGrupo='A' OR ssp.tCodSeccion IS NOT NULL)" : " AND ss.bPublico=1").
 						  " ORDER BY ss.iPosition ASC";	
						  //echo $sql;
						   $result = $this->db->query($sql);
						   	$data = array();
						  	  while($row = $result->fetch_assoc()){
		                          array_push($data, array(
		                            'skModule'    			=>  $row['skModule'],
		                            'iPosition'       		=>  $row['iPosition'],
		                            'sParentModule'         =>  $row['sParentModule'],
		                            'sModule'         		=>  $row['sModule'],
		                            'sTitle'         		=>  $row['sTitle'],
		                            'sIcons'         		=>  $row['sIcons'],
		                        ));
		                    }
		                    mysqli_free_result($result);
		                    //mysqli_next_result($this->db);
		                    return $data;
 						 
                      }
            public function GetSubMenuModuls($sSeccionParent){
		
 						  $sql = " SELECT DISTINCT ss.skModule AS skModule,
						 	ss.iPosition AS iPosition,
							ss.sParentModule AS sParentModule,
							ss.sModule AS sModule,
							mi.sIcons  AS sIcons,
							ss.sName AS sName,
						 	ss.sTitle AS sTitle,
						 	mm.skCaracteristic ".
 						  " FROM _modules ss".
						  " INNER JOIN _users su ON su.skUsers='".$_SESSION['session']['skUsers']."' ".
 						  "	LEFT JOIN _modules_icons mi ON mi.skModule = ss.sKmodule  ".
 						  " LEFT JOIN _modules_caracteristic mm ON mm.skModule = ss.sKmodule  ".
						//  (isset($_SESSION['sesionServicios']) ? " AND ss.bPublico=0" : " OR ss.bPublico=1").
						  " LEFT JOIN _modules_profiles_permissions ssp ON ssp.skProfiles = '".$_SESSION['session']['skProfile']."' AND ssp.sKmodule=ss.sKmodule ".
 						  " WHERE  ss.sParentModule = '".$sSeccionParent."' AND". 
 						  " ss.skStatus='AC'  AND mm.skCaracteristic IS NULL ".
  						   (isset($_SESSION['session']) ? " AND (su.sGroup='A' OR ssp.skModule IS NOT NULL)" : "").
						 // (isset($_SESSION['session']) ? " AND ss.bPublico=0 AND (su.tCodGrupo='A' OR ssp.tCodSeccion IS NOT NULL)" : " AND ss.bPublico=1").
 						  " ORDER BY ss.iPosition ASC";	
						  //echo $sql;
						   $result = $this->db->query($sql);
 						   $row_cnt = $result->num_rows;
						   $data = array();
						   	if($row_cnt){
						   	
						   	
						  	  while($row = $result->fetch_assoc()){
		                          array_push($data, array(
		                            'skModule'    			=>  $row['skModule'],
		                            'iPosition'       		=>  $row['iPosition'],
		                            'sParentModule'         =>  $row['sParentModule'],
		                            'sModule'         		=>  $row['sModule'],
		                            'sTitle'         		=>  $row['sTitle'],
		                            'sName'         		=>  $row['sName'],
		                            'sIcons'         		=>  $row['sIcons'],
		                        ));
		                    }
		                    mysqli_free_result($result);
		                    //mysqli_next_result($this->db);
		                    
		                          return $data;
		                    }else{
			                    //return 0;
		                    }
		              
 						 
                      }

	}
?>
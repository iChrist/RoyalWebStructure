<?php require_once("../../core/con/config.php");?>
<?php
	Class Core_Model {
		 
		
		// PROTECTED VARIABLES //
			protected $db;

		// PRIVATE VARIABLES //
			private $data;

		public function __construct(){
			$this->db = mysqli_connect(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
			if (mysqli_connect_errno()){
				$text = "Failed to connect to database: ".mysqli_connect_error();
				$this->_error($text);
				die();
			}
			$this->iniciarClase($datos);
			//$this->_get_params();
			$this->require_view(TRUE);
		}

		public function __destruct(){
			if(!mysqli_connect_errno()){
                                mysqli_next_result($this->db);
				$this->db->close();
			}
		}
		
		/*
		
Options -Indexes
Options +FollowSymLinks
RewriteEngine on

#	RoyalWen Routes	#
RewriteRule ^logout/$ core/logout.php [L,NC]
RewriteRule ^([a-zA-Z0-9\-_.]+)/(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)(?:([a-zA-Z0-9\-_.]+/)?)$ core/stage/index.php?sysProject=$1&sysModule=$2&sysController=$3&sysName=$4&p1=$5&p2=$6&p3=$7&p4=$8&p5=$9 [L,NC,QSA]

RewriteRule ^(wsv|wsdl)/([a-zA-Z]+)/$ core/stage/index.php?sysType=$1&sysModule=$2

AddCharset utf-8 .txt .html .htm .php .wsdl
		*/
			
		private function iniciarClase($datos)
		{
		$datos['module'] = ($datos['module'] ? $datos['module'] : "sys");
		$select = " SELECT DISTINCT".
				  " ss.skModule AS skModule,ss.sModule, ss.sParentModule, ss.iPosition, ss.sTitle,".
				  " sh.skModule AS tCodPrimerHijo, sh.sTitle AS tTituloPrimerHijo".
				  " FROM _modules ss". 
				  " LEFT JOIN _modules sh ON sh.sParentModule = ss.skModule".
				  " WHERE ss.skModule='".$datos['module']."' AND ss.skStatus='AC'".
				  " ORDER BY ss.iPosition ASC, sh.iPosition LIMIT 1";	
				//echo $select;  
				  $result = $this->db->query($select);
				  $rSeccion = $result->fetch_assoc();
				   mysqli_free_result($result);
                   mysqli_next_result($this->db);
 		$this->skModule =$rSeccion{'skModule'};
		$this->tCodPrimerHijo =$rSeccion{'tCodPrimerHijo'};
		$this->sParentModule = $rSeccion{'sParentModule'};
		$this->sModule =$Seccion{'sModule'};	
		$this->sTitle = $rSeccion{'sTitle'};
		
		}	

		/*public function index(){
			//echo "<hr><pre>".print_r($_GET,1)."</pre><hr>";
                        $this->load_controller($_GET["sysModule"] , $_GET["sysFunction"]);
		}*/

		private function _get_params(){
			$_GET["sysModule"] = !empty($_GET["sysModule"]) ? str_replace("/","",$_GET["sysModule"]) : NULL;
			$_GET["sysModule"] = !empty($_GET["sysModule"]) ? str_replace("-","_",$_GET["sysModule"]) : NULL;

			$_GET["sysController"] = !empty($_GET["sysController"]) ? str_replace("/","",$_GET["sysController"]) : 'index';
			$_GET["sysController"] = !empty($_GET["sysController"]) ? str_replace("_","-",$_GET["sysController"]) : 'index';
			
                        $_GET["sysFunction"] = !empty($_GET["sysController"]) ? str_replace("-","_",$_GET["sysController"]) : 'index';
			
			$_GET["sysName"] = !empty($_GET["sysName"]) ? str_replace("/","",$_GET["sysName"]) : NULL;
                        
			$_GET["p1"] = !empty($_GET["p1"]) ? str_replace("/","",$_GET["p1"]) : NULL;
			$_GET["p2"] = !empty($_GET["p2"]) ? str_replace("/","",$_GET["p2"]) : NULL;
			$_GET["p3"] = !empty($_GET["p3"]) ? str_replace("/","",$_GET["p3"]) : NULL;
			$_GET["p4"] = !empty($_GET["p4"]) ? str_replace("/","",$_GET["p4"]) : NULL;
			$_GET["p5"] = !empty($_GET["p5"]) ? str_replace("/","",$_GET["p5"]) : NULL;
		}

		protected function load_model($model = NULL, $path = NULL){
			if($path){
				if(file_exists(SYS_PATH.$path.$model.".model.php")){
					require_once(SYS_PATH.$path.$model.".model.php");
				}else{
					$text = "'".$model."' model not found.";
					$this->_error($text,"ERROR 404");
					die();
				}
			}else{
				if(file_exists(SYS_PATH.$_GET["sysModule"]."/model/".$model.".model.php")){
					require_once(SYS_PATH.$_GET["sysModule"]."/model/".$model.".model.php");
				}else{
					$text = "'".$model."' model not found.";
					$this->_error($text,"ERROR 404");
					die();
				}
			}
		}

		protected function load_controller($sysModule = NULL , $sysFunction = "index"){
                    if($sysModule == NULL){
                        if((isset($_SESSION['session']['skUsers'])) && (!empty($_SESSION['session']['skUsers']))){
                            require_once('../stage/header.php');
                            require_once('../stage/dashboard.php');
                            require_once('../stage/footer.php');
                        }else{
                            require_once(CORE_PATH."login.php");
                        }
                    }else{
                        if((isset($_SESSION['session']['skUsers'])) && (!empty($_SESSION['session']['skUsers']))){
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
                                                $this->require_view(TRUE);
                                                $sysModule_model->$sysFunction();
                                            }else{
                                                // VERIFICA LOS PERMISOS DEL USUARIO AUTENTICADO.
                                                $this->require_view(FALSE);
                                                $sysModule_model->$sysFunction();
                                            }
                                        }else{
                                            $text = "Object query not set.";
                                            $this->_error($text);
                                        }
                                    }else{
                                        $text = "Call to undefined method '".$sysFunction."' in '".$sysModule."' controller.";
                                        $this->_error($text);
                                    }
                                }else{
                                    $text = "'".$sysModule."' controller not found.";
                                    $this->_error($text,"ERROR 404");
                                }
                            }else{
                                $text = "'".$sysModule."' is not a valid directory.";
                                $this->_error($text);
                            }
                        }else{
                            require_once(CORE_PATH."login.php");
                        }
                    }
		}

		protected function load_view($view = "index", $data = array() , $templates = TRUE, $path = NULL){
			if(file_exists(SYS_PATH.$_GET["sysModule"]."/".$view.".php")){
				if($templates){
					require_once(CORE_PATH."stage/header.php");
                                        
                                        $_secutiry['_users_profiles'] = $this->getUsersProfiles();
                                        $_secutiry['_modules_profiles_permissions'] = $this->getModulesProfilesPermissions();
                                        $_buttons = $this->getModulesButtons();
                                        require_once(CORE_PATH."stage/buttons.php");
					include(SYS_PATH.$_GET["sysModule"]."/".$view.".php");
					require_once(CORE_PATH."stage/footer.php");
				}else{
					include(SYS_PATH.$_GET["sysModule"]."/".$view.".php");
				}
			}else{
				 $text = "'".$view."' view not found.";
				 $this->_error($text,"ERROR 404");
			}
		}

		protected function require_view($bool = TRUE){
			$_SESSION["sysRequireView"] = $bool;
		}

		protected function is_view_required(){
			return $_SESSION["sysRequireView"];
		}
                
                private function getModulesButtons(){
                    //$sql = "CALL stpGetModulesProfilesPermissions('".$_GET['sysController']."','".$_SESSION['skUsers']."', NULL);";
                    //$sql = "SELECT _modules_buttons.*, btn.skPermissions, REPLACE(btn.sHtml, '{{sTitle}}', btn.sTitle) AS sHtml FROM _modules_buttons INNER JOIN _buttons AS btn ON btn.skButtons = _modules_buttons.skButtons WHERE skModule = '".$_GET['sysController']."' ORDER BY _modules_buttons.iPosition ASC";
                    $sql = "CALL test('".$_GET['sysController']."');";
                    $result = $this->db->query($sql);
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $data[$row['iPosition']] = array(
                            'skModule' => $row['skModule'],
                            'sParentModule' => $row['sParentModule'],
                            'skButtons' => $row['skButtons'],
                            'sHtml' => $row['sHtml'],
                            'skPermissions' => $row['skPermissions'],
                            'sFunction' => $row['sFunction'],
                            'iPosition' => $row['iPosition']
                        );
                    }
                    //var_dump($data);
                    mysqli_free_result($result);
                    mysqli_next_result($this->db);
                    foreach($data AS $key){
                        var_dump($key['skModule']);
                        $sql = "CALL stpConsultarBreadcrumb('".$key['skModule']."',0);";
                        $records = $this->db->query($sql);
                        while($record = $records->fetch_assoc()){
                            var_dump($record);
                        }
                        echo '<hr>';
                        mysqli_free_result($records);
                        mysqli_next_result($this->db);
                    }
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
                    //$sql = "CALL stpGetModulesProfilesPermissions('".$_GET['sysController']."','".$_SESSION['skUsers']."','".$_SESSION['skProfile']."');";
                    $result = $this->db->query($sql);
                    $data = array();
                    while($row = $result->fetch_assoc()){
                        $data[$row['skModule']][$row['skProfiles']][$row['skPermissions']] = $row['sNamePermission'];
                    }
                    mysqli_free_result($result);
                    mysqli_next_result($this->db);
                    return $data;
                }
                
		public function _error(&$text, $error = "ERROR"){
			echo "<table border='1' style='width:100%;'><tr><td style='padding-top:20px;'><center><h3><span style='color:red;'>".$error." : </span>".$text."</h3></center></td></tr></table>";
		}
		
		
		public function breadcrumb(){
				$sql = "CALL stpConsultarBreadcrumb('".($_GET["sysController"] !='index' ? $_GET["sysController"] : 'sys')."',0); ";
				//echo $sql;
					$result = $this->db->query($sql);	
					$html="";
					while($row= $result->fetch_assoc()){
					
							$html.='<li>
							
						<i class="fa fa-home"></i>
						<a href="/sys/'.$row['skModule'].'/'.$row['sName'].'/">'.$row['sTitle'].'</a>
						<i class="fa fa-angle-right"></i>
					</li>';
							//$html.= $row['sPkModule']."<br>";
		
		
					}
					echo  $html;
					//return $result;
			
		}
		
		public function GetMenu($sMenu){
		
		/*$select = " SELECT DISTINCT ss.sKModule, ss.tCodVinculo, ss.tParametros, ss.ePosicion, ss.tCodPadre, ss.bFiltros,".
						  " ss.tTitulo, ss.tSubtitulo, ss.bOcultarTitulo, ss.bPublico".
						  " FROM sissecciones ss".
						  " INNER JOIN sisusuarios su ON su.eCodUsuario=".(int)$_SESSION['sesionServicios']['eCodUsuario'].
						  (isset($_SESSION['sesionServicios']) ? " AND ss.bPublico=0" : " OR ss.bPublico=1").
						  " LEFT JOIN sisseccionesperfiles ssp ON ssp.tCodPerfil = su.tCodPerfil AND ssp.tCodSeccion=ss.tCodSeccion ".
						  " WHERE  ss.eCodMenu = ".$eCodMenu." AND ss.tCodEstatus='AC' AND ss.bOcultarNavegacion IS NULL".
						  (isset($_SESSION['sesionServicios']) ? " AND ss.bPublico=0 AND (su.tCodGrupo='A' OR ssp.tCodSeccion IS NOT NULL)" : " AND ss.bPublico=1").
						  ($this->bMovil ? " AND ss.bMovil=1" : "").
						  " ORDER BY ss.ePosicion ASC";	*/
						  
						  
						  $select = " SELECT DISTINCT ss.sKModule,
						 	ss.iPosition,
							ss.sParentModule,
						 	ss.sTitle".
						  " FROM _modules ss".
						  " INNER JOIN _users su ON su.skUsers='".$_SESSION['session']['skUsers']."' ".
						//  (isset($_SESSION['sesionServicios']) ? " AND ss.bPublico=0" : " OR ss.bPublico=1").
						  " LEFT JOIN _modules_profiles_permissions ssp ON ssp.skProfiles = '".$_SESSION['session']['skProfile']."' AND ssp.sKmodule=ss.sKmodule ".
						  " WHERE ". 
						  //"ss.eCodMenu = '".$sMenu."' "
						  " ss.skStatus='AC' ".
						 // (isset($_SESSION['session']) ? " AND ss.bPublico=0 AND (su.tCodGrupo='A' OR ssp.tCodSeccion IS NOT NULL)" : " AND ss.bPublico=1").
						 // ($this->bMovil ? " AND ss.bMovil=1" : "").
						  " ORDER BY ss.iPosition ASC";	
						  
						  //echo $select;
	}


	}
?>
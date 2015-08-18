<?php
	class Core_Model extends MySql{

		public function __construct(){
			global $host_db;
			global $user_db;
			global $password_db;
			global $database_db;

			parent::__construct($host_db,$user_db,$password_db,$database_db);
		}

		public function __destruct(){
			
		}

		public function index(){
			$this->_getParams();
			//echo "<hr><pre>".print_r($_GET,1)."</pre><hr>";
			$this->load_controller($_GET["pmodule"] , $_GET["pcontroller"]);
		}

		public function load_controller($module = "login" , $controller = "index"){
			if($module == "login"){
				require_once("../login.php");
			}else{
				// VERIFICA SI EXISTE EL DIRECTORIO DEL MÓDULO.
				if(is_dir("../../sys/".$module."/")){
					// VERIFICA SI EXISTE EL CONTROLADOR DEL MÓDULO.
					if(file_exists("../../sys/".$module."/controller/".$module.".controller.php")){
						require_once("../../sys/".$module."/controller/".$module.".controller.php");
						$module_controller = $module."_Controller";
						$module_model = new $module_controller();
						if(method_exists($module_model,$controller)){
							$sql = "SELECT * FROM _modules WHERE sPkModule = '".$module."'";
							//$sql = "SELECT * FROM _modules WHERE sPkModule = 'fin'";
							$result = $this->query($sql);
						 	if($result->num_rows > 0){
						 		// VERIFICA LOS PERMISOS DEL USUARIO AUTENTICADO.
								$module_model->$controller();
							}else{
								// FUNCIÓN NO DECLARADA COMO MÓDULO.
								$module_model->$controller();
							}
						}else{
							$text = "Call to undefined method '".$controller."' in '".$module."' controller.";
							$this->error($text);
						}
					}else{
						$text = "'".$module."' controller not found.";
						$this->error($text,"ERROR 404");
					}
				}else{
					$text = "'".$module."' is not a valid directory.";
					$this->error($text);
				}
			}
		}

		public function load_view($view = NULL , $data = array() , $templates = TRUE){
			if(file_exists("../../sys/".$_GET["pmodule"]."/".$view.".view.php")){
				if($templates){
					require_once("../platform/header.php");
				}
				require_once("../../sys/".$_GET["pmodule"]."/".$view.".view.php");
				if($templates){
					require_once("../platform/footer.php");
				}
			}else{
				 $text = "'".$view."' view not found.";
				 $this->error($text,"ERROR 404");
			}
		}

		public function error(&$text,$error = "ERROR"){
			echo "<table border='1' style='width:100%;'><tr><td style='padding-top:20px;'><center><h3><span style='color:red;'>".$error." : </span>".$text."</h3></center></td></tr></table>";
		}

		private function _getParams(){
			$_GET["pmodule"] = !empty($_GET["pmodule"]) ? str_replace("/","",$_GET["pmodule"]) : 'login';
			$_GET["pmodule"] = !empty($_GET["pmodule"]) ? str_replace("-","_",$_GET["pmodule"]) : 'login';
			$_GET["pcontroller"] = !empty($_GET["pcontroller"]) ? str_replace("/","",$_GET["pcontroller"]) : 'index';
			$_GET["pcontroller"] = !empty($_GET["pcontroller"]) ? str_replace("-","_",$_GET["pcontroller"]) : 'index';
			$_GET["pname"] = !empty($_GET["pname"]) ? str_replace("/","",$_GET["pname"]) : NULL;
			$_GET["p1"] = !empty($_GET["p1"]) ? str_replace("/","",$_GET["p1"]) : NULL;
			$_GET["p2"] = !empty($_GET["p2"]) ? str_replace("/","",$_GET["p2"]) : NULL;
			$_GET["p3"] = !empty($_GET["p3"]) ? str_replace("/","",$_GET["p3"]) : NULL;
			$_GET["p4"] = !empty($_GET["p4"]) ? str_replace("/","",$_GET["p4"]) : NULL;
			$_GET["p5"] = !empty($_GET["p5"]) ? str_replace("/","",$_GET["p5"]) : NULL;
			$_GET["p6"] = !empty($_GET["p6"]) ? str_replace("/","",$_GET["p6"]) : NULL;
		}

	}
?>
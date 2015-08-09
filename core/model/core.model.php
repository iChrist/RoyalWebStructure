<?php
	echo "core.model.php<br>";
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
			echo "<hr><pre>".print_r($_GET,1)."</pre><hr>";
			$this->load_controller($_GET["module"] , $_GET["controller"]);
		}

		public function load_controller($module = "login" , $controller = "index"){
			if($module == "login"){
				// INCLUDE DE LOGIN //
				//require_once("../login.php");
			}else{
				if(file_exists("../../sys/".$module."/controller/".$module.".controller.php")){
					require_once("../../sys/".$module."/controller/".$module.".controller.php");
					$module_controller = $module."_Controller";
					$module_model = new $module_controller();
					if(method_exists($module_model,$controller)){
						$module_model->$controller();
					}else{
						$text = "Call to undefined method '".$controller."' in '".$module."' controller.";
						$this->error($text);
					}
				}else{
					$text = "'".$module."' controller not found.";
					$this->error($text,"ERROR 404");
				}
			}
		}

		public function load_view($view = NULL , $data = array()){
			if(file_exists("../../sys/".$_GET["module"]."/".$view.".view.php")){
				require_once("../../sys/".$_GET["module"]."/".$view.".view.php");
			}else{
				 $text = "'".$view."' view not found.";
				 $this->error($text,"ERROR 404");
			}
		}

		public function error(&$text,$error = "ERROR"){
			echo "<table border='1' style='width:100%;'><tr><td style='padding-top:20px;'><center><h3><span style='color:red;'>".$error." : </span>".$text."</h3></center></td></tr></table>";
		}

		private function _getParams(){
			$_GET["module"] = !empty($_GET["module"]) ? str_replace("/","",$_GET["module"]) : 'login';
			$_GET["module"] = !empty($_GET["module"]) ? str_replace("-","_",$_GET["module"]) : 'login';
			$_GET["controller"] = !empty($_GET["controller"]) ? str_replace("/","",$_GET["controller"]) : 'index';
			$_GET["controller"] = !empty($_GET["controller"]) ? str_replace("-","_",$_GET["controller"]) : 'index';
			$_GET["param1"] = !empty($_GET["param1"]) ? str_replace("/","",$_GET["param1"]) : NULL;
			$_GET["param2"] = !empty($_GET["param2"]) ? str_replace("/","",$_GET["param2"]) : NULL;
			$_GET["param3"] = !empty($_GET["param3"]) ? str_replace("/","",$_GET["param3"]) : NULL;
			$_GET["param4"] = !empty($_GET["param4"]) ? str_replace("/","",$_GET["param4"]) : NULL;
			$_GET["param5"] = !empty($_GET["param5"]) ? str_replace("/","",$_GET["param5"]) : NULL;
			$_GET["param6"] = !empty($_GET["param6"]) ? str_replace("/","",$_GET["param6"]) : NULL;
			$_GET["param7"] = !empty($_GET["param7"]) ? str_replace("/","",$_GET["param7"]) : NULL;
		}

	}
?>
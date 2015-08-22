<?php
	class Core_Model extends MySql{

		public function __construct(){
			parent::__construct(HOST_DB, USER_DB, PASSWORD_DB, DATABASE_DB);
			$this->_get_params();
			$this->require_view(TRUE);
		}

		public function __destruct(){
			
		}

		public function index(){
			echo "<hr><pre>".print_r($_GET,1)."</pre><hr>";
			$this->load_controller($_GET["sysModule"] , $_GET["sysController"]);
		}

		private function _get_params(){
			$_GET["sysModule"] = !empty($_GET["sysModule"]) ? str_replace("/","",$_GET["sysModule"]) : NULL;
			$_GET["sysModule"] = !empty($_GET["sysModule"]) ? str_replace("-","_",$_GET["sysModule"]) : NULL;

			$_GET["sysController"] = !empty($_GET["sysController"]) ? str_replace("/","",$_GET["sysController"]) : 'index';
			$_GET["sysFunction"] = !empty($_GET["sysController"]) ? str_replace("_","-",$_GET["sysController"]) : 'index';
			$_GET["sysController"] = !empty($_GET["sysController"]) ? str_replace("-","_",$_GET["sysController"]) : 'index';
			

			$this->sysName = !empty($_GET["sysName"]) ? str_replace("/","",$_GET["sysName"]) : NULL;
			$_GET["p1"] = !empty($_GET["p1"]) ? str_replace("/","",$_GET["p1"]) : NULL;
			$_GET["p2"] = !empty($_GET["p2"]) ? str_replace("/","",$_GET["p2"]) : NULL;
			$_GET["p3"] = !empty($_GET["p3"]) ? str_replace("/","",$_GET["p3"]) : NULL;
			$_GET["p4"] = !empty($_GET["p4"]) ? str_replace("/","",$_GET["p4"]) : NULL;
			$_GET["p5"] = !empty($_GET["p5"]) ? str_replace("/","",$_GET["p5"]) : NULL;
			//$_GET["p6"] = !empty($_GET["p6"]) ? str_replace("/","",$_GET["p6"]) : NULL;
		}

		public function load_model($model = NULL, $path = NULL){
			if($path){
				if(file_exists(SYS_PATH.$path.$model.".model.php")){
					require_once(SYS_PATH.$path.$model.".model.php");
				}else{
					$text = "'".$model."' model not found.";
					$this->_error($text,"ERROR 404");
					exit(0);
				}
			}else{
				if(file_exists(SYS_PATH.$_GET["sysModule"]."/model/".$model.".model.php")){
					require_once(SYS_PATH.$_GET["sysModule"]."/model/".$model.".model.php");
				}else{
					$text = "'".$model."' model not found.";
					$this->_error($text,"ERROR 404");
					exit(0);
				}
			}
		}

		public function load_controller($sysModule = NULL , $sysController = "index"){
			if($sysModule == NULL){
					require_once(CORE_PATH."stage/header.php");
					require_once(CORE_PATH."index.php");
					require_once(CORE_PATH."stage/footer.php");
			}else{
				// VERIFICA SI EXISTE EL DIRECTORIO DEL MÓDULO.
				if(is_dir(SYS_PATH.$sysModule."/")){
					// VERIFICA SI EXISTE EL CONTROLADOR DEL MÓDULO.
					if(file_exists(SYS_PATH.$sysModule."/controller/".$sysModule.".controller.php")){
						require_once(SYS_PATH.$sysModule."/controller/".$sysModule.".controller.php");
						$sysModule_controller = $sysModule."_Controller";
						$sysModule_model = new $sysModule_controller();
						if(method_exists($sysModule_model,$sysController)){
							$sql = "SELECT * FROM _modules WHERE sPkModule = '".$_GET["sysFunction"]."'";
							$result = $this->query($sql);
						 	if($result->num_rows > 0){
						 		// VERIFICA LOS PERMISOS DEL USUARIO AUTENTICADO.
						 		$this->require_view(TRUE);
								$sysModule_model->$sysController();
							}else{
								// VERIFICA LOS PERMISOS DEL USUARIO AUTENTICADO.
								$this->require_view(FALSE);
								$sysModule_model->$sysController();
							}
						}else{
							$text = "Call to undefined method '".$sysController."' in '".$sysModule."' controller.";
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
			}
		}

		public function load_view($view = "index", $data = array() , $templates = TRUE, $path = NULL){
			if(file_exists(SYS_PATH.$_GET["sysModule"]."/".$view.".php")){
				if($templates){
					//require_once(CORE_PATH."stage/header.php");
					require_once(SYS_PATH."assets/header.php");
					include(SYS_PATH.$_GET["sysModule"]."/".$view.".php");
					//require_once(CORE_PATH."stage/footer.php");
					require_once(SYS_PATH."assets/footer.php");
				}else{
					include(SYS_PATH.$_GET["sysModule"]."/".$view.".php");
				}
			}else{
				 $text = "'".$view."' view not found.";
				 $this->_error($text,"ERROR 404");
			}
		}

		public function require_view($bool = TRUE){
			$_SESSION["sysRequireView"] = $bool;
		}

		public function is_view_required(){
			return $_SESSION["sysRequireView"];
		}

		public function _error(&$text, $error = "ERROR"){
			echo "<table border='1' style='width:100%;'><tr><td style='padding-top:20px;'><center><h3><span style='color:red;'>".$error." : </span>".$text."</h3></center></td></tr></table>";
		}

	}
?>
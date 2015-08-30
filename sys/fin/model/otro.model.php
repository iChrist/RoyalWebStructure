<?php echo 4983743;
	abstract class Otro_Model extends Core_Model {
	
		// PRIVATE VARIABLES //
			private $_data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			
		}

		public function index(){
			echo "<br>--Otro modelo (misma carpeta)--<br>";
		

	}
?>
<?php
	require_once(SYS_PATH."pue/model/pue.model.php");
	Class pue_Controller Extends pue_Model {

		// PRIVATE VARIABLES //
                    private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
		
		}
                /*COMIENZA MODULO TIPOS DE CONTENEDORE */
                public function tipcon_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->contenedores_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['skTipoContenedor'])){
                                    $this->contenedores['skTipoContenedor'] = $_POST['skTipoContenedor'];
                                }
                                if(isset($_POST['sNombre'])){
                                    $this->contenedores['sNombre'] = $_POST['sNombre'];
                                }
                                if(isset($_POST['sNombreCorto'])){
                                    $this->contenedores['sNombreCorto'] = $_POST['sNombreCorto'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_areas();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->contenedores['limit'] = $records['limit'];
                                $this->contenedores['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_contenedores();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skTipoContenedor']));
                                    array_push($records['data'], array(
                                        $row['skTipoContenedor']
                                        ,$row['sNombre']
                                        ,$row['sNombreCorto']
                                        ,$row['htmlStatus']
                                        , !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.$actions['sHtml'].'</ul></div>' : ''
                                    ));
                                }

                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return true;
                                break;
                        }
                        return true;
                    } 
                }  
                /*TERMINA MODULO TIPOS DE CONTENEDORE */
				/*COMIENZA MODULO REGIMEN */
 
					public function regimenes_index(){
					if(isset($_GET['axn'])){
					switch ($_GET['axn']) {
					case 'pdf':
					$this->regimenes_pdf();
					break;
					case 'fetch_all':
					// PARAMETROS PARA FILTRADO //
					if(isset($_POST['sNombre'])){
						$this->regimenes['sNombre'] = $_POST['sNombre'];
					}
					if(isset($_POST['sDescripcion'])){
						$this->regimenes['sDescripcion'] = $_POST['sDescripcion'];
					}
					if(isset($_POST['skStatus'])){
						$this->regimenes['skStatus'] = $_POST['skStatus'];
					}
					
					// OBTENER REGISTROS //
					$total = parent::count_regimenes();
					$records = Core_Functions::table_ajax($total);
					if($records['recordsTotal'] === 0){
						header('Content-Type: application/json');
						echo json_encode($records);
						return false;
					}
					
					$this->regimenes['limit'] = $records['limit'];
					$this->regimenes['offset'] = $records['offset'];
					$this->data['data'] = parent::read_regimenes();
					
					if(!$this->data['data']){
						header('Content-Type: application/json');
						echo json_encode($records);
						return false;
					}
					
					while($row = $this->data['data']->fetch_assoc()){
						$actions = $this->printModulesButtons(2,array($row['skRegimen']));
						array_push($records['data'], array(
							 utf8_encode($row['sNombre'])
							,utf8_encode($row['sDescripcion'])
							,utf8_encode($row['htmlStatus'])
							, !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
						));
					}
					
					header('Content-Type: application/json');
					echo json_encode($records);
					return true;
					break;
					}
					return true;
					}
					
					// INCLUYE UN MODELO DE OTRO MODULO //
					$this->load_model('cof','cof');
					$this->data['status'] = Cof_Model::read_status();
					
					// RETORNA LA VISTA areas-index.php //
					$this->load_view('regimenes-index', $this->data);
					return true;
					}
					
					public function regimenes_form(){ 
					$this->data['message'] = '';
					$this->data['response'] = true;
					$this->data['datos'] = false;
					if($_POST){
					//exit('</pre>'.print_r($_POST,1).'</pre>');
					$this->regimenes['skRegimen'] = !empty($_POST['skRegimen']) ? $_POST['skRegimen'] : substr(md5(microtime()), 1, 32);
					$this->regimenes['sNombre'] = utf8_decode($_POST['sNombre']);
					$this->regimenes['sDescripcion'] = utf8_decode($_POST['sDescripcion']);
					$this->regimenes['skStatus'] = utf8_decode($_POST['skStatus']);
					if(empty($_POST['skRegimen'])){
					if(parent::create_regimenes()){
					$this->data['response'] = true;
					$this->data['message'] = 'Registro insertado con &eacute;xito.';
					header('Content-Type: application/json');
					echo json_encode($this->data);
					return true;
					}else{
					$this->data['response'] = false;
					$this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
					header('Content-Type: application/json');
					echo json_encode($this->data);
					return false;
					}
					}else{
					if(parent::update_regimenes()){
					$this->data['response'] = true;
					$this->data['message'] = 'Registro actualizado con &eacute;xito.';
					header('Content-Type: application/json');
					echo json_encode($this->data);
					return true;
					}else{
					$this->data['response'] = false;
					$this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
					header('Content-Type: application/json');
					echo json_encode($this->data);
					return false;
					}
					}
					}
					if(isset($_GET['p1'])){
					$this->regimenes['skRegimen'] = $_GET['p1'];
					$this->data['datos'] = parent::read_regimenes();
					}
					$this->load_view('regimenes-form', $this->data);
					return true;
					}
					
					public function regimenes_detail(){
					if(isset($_GET['p1'])){
					$this->regimenes['skRegimen'] = $_GET['p1'];
					$this->data['datos'] = parent::read_regimenes();
					}
					$this->load_view('regimenes-detail', $this->data);
					return true;
					}
				
					 private function regimenes_pdf(){
                    if(isset($_GET['p1'])){
                        $this->areas['skAreas'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_areas();
                    }
                    ob_start();
                    $this->load_view('areas-pdf', $this->data, FALSE, 'emp/pdf/');
                    $content = ob_get_clean();
                    $title = 'Areas';
                    Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                    return true;
                }

				
				/*TERMINA MODULO REGIMEN */
	}
?>

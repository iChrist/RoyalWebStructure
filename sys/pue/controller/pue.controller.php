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
				
	}
?>

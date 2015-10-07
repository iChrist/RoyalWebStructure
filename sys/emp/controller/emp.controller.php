<?php
	require_once(SYS_PATH."emp/model/emp.model.php");
	Class Emp_Controller Extends Emp_Model {

		// PRIVATE VARIABLES //
                    private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
		
		}

                /* COMIENZA MODULO areas */
                public function areas_index(){
                    if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                        
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sNombre'])){
                            $this->areas['sNombre'] = $_POST['sNombre'];
                        }
                        if(isset($_POST['sCorreo'])){
                            $this->areas['sCorreo'] = $_POST['sCorreo'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->areas['skStatus'] = $_POST['skStatus'];
                        }
                        
                        // TOTAL DE REGISTROS EN LA TABLA //
                        $getTotal = parent::count_areas()->fetch_assoc();
                        $iTotalRecords = $getTotal['total'];
                        // "LIMIT" TOTAL DE REGISTROS PARA MOSTRAR //
                        $iDisplayLength = intval($_REQUEST['length']);
                        $iDisplayLength = ($iDisplayLength < 0) ? $iTotalRecords : $iDisplayLength; 
                        // "OFFSET" //
                        $iDisplayStart = intval($_REQUEST['start']);
                        // PAGINA //
                        $sEcho = intval($_REQUEST['draw']);
                        
                        $this->areas['limit'] = $iDisplayLength;
                        $this->areas['offset'] = $iDisplayStart;
                        $this->data['areas'] = parent::read_like_areas();
                        
                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
                        
                        if($this->data['areas']){
                            while($row = $this->data['areas']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skAreas']));
                                $records["data"][] = array(
                                    htmlentities(utf8_encode($row['sNombre']), ENT_QUOTES)
                                    ,htmlentities(utf8_encode($row['sCorreo']), ENT_QUOTES)
                                    ,utf8_encode($row['htmlStatus'])
                                    , !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.$actions['sHtml'].'</ul></div>' : ''
                                    
                                );
                            }
                        }
                        $records["draw"] = $sEcho;
                        $records["recordsTotal"] = $iTotalRecords;
                        $records["recordsFiltered"] = $iTotalRecords;

                        echo json_encode($records);
                        return false;
                    }
                    
                    // INCLUYE UN MODELO DE OTRO MODULO //
                    $this->load_model('cof','cof');
                    $this->data['status'] = Cof_Model::read_status();
                    
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('areas-index', $this->data);
                }
                
                public function areas_form(){
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                        if(isset($_POST['axn']) && $_POST['axn'] == 'validarEmail'){
                            echo 'true';
                            return true;
                        }
                        $this->areas['skAreas'] = !empty($_POST['skAreas']) ? $_POST['skAreas'] : substr(md5(microtime()), 1, 32);
                        $this->areas['sNombre'] = $_POST['sNombre'];
                        $this->areas['sCorreo'] = $_POST['sCorreo'];
                        $this->areas['skStatus'] = $_POST['skStatus'];
                        if(empty($_POST['skAreas'])){
                            if(parent::create_areas()){
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro insertado con &eacute;xito.';
                                $this->data['datos'] = parent::read_equal_areas();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                $this->data['datos'] = $_POST;
                            }
                        }else{
                            if(parent::update_areas()){
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                                $this->data['datos'] = parent::read_equal_areas();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                                $this->data['datos'] = $_POST;
                            }
                        }
                    }
                    if(isset($_GET['p1'])){
                        $this->areas['skAreas'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_areas();
                    }
                    $this->load_view('areas-form', $this->data);
                    return true;
                }
                
                public function areas_detail(){
                   echo 'areas-detail'; 
                }
                /* TERMINA MODULO areas */
                
	}
?>

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
                        if(isset($_POST['nombre'])){
                            $this->users['nombre'] = $_POST['nombre'];
                        }
                        if(isset($_POST['correo'])){
                            $this->users['correo'] = $_POST['correo'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->users['skStatus'] = $_POST['skStatus'];
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
                        
                        $this->users['limit'] = $iDisplayLength;
                        $this->users['offset'] = $iDisplayStart;
                        $this->data['areas'] = parent::read_like_areas();
                        
                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
                        
                        if($this->data['areas']){
                            while($row = $this->data['areas']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skUsers']));
                                $records["data"][] = array(
                                    htmlentities(utf8_encode($row['nombre']), ENT_QUOTES)
                                    ,htmlentities(utf8_encode($row['correo']), ENT_QUOTES)
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
                    
                }
                
                public function areas_detail(){
                    
                }
                /* TERMINA MODULO areas */
                
	}
?>

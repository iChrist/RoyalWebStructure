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
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->areas_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['sNombre'])){
                                    $this->areas['sNombre'] = $_POST['sNombre'];
                                }
                                if(isset($_POST['sTitulo'])){
                                    $this->areas['sTitulo'] = $_POST['sTitulo'];
                                }
                                if(isset($_POST['skStatus'])){
                                    $this->areas['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_areas();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->areas['limit'] = $records['limit'];
                                $this->areas['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_areas();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skAreas']));
                                    array_push($records['data'], array(
                                         utf8_encode($row['sNombre'])
                                        ,utf8_encode($row['sTitulo'])
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
                    $this->load_view('areas-index', $this->data);
                    return true;
                }
                
                 
                public function areas_form(){ 
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        $this->areas['skAreas'] = !empty($_POST['skAreas']) ? $_POST['skAreas'] : substr(md5(microtime()), 1, 32);
                        $this->areas['sNombre'] = utf8_decode($_POST['sNombre']);
                        $this->areas['sTitulo'] = utf8_decode($_POST['sTitulo']);
                        $this->areas['skStatus'] = utf8_decode($_POST['skStatus']);
                        if(empty($_POST['skAreas'])){
                            if(parent::create_areas()){
                                $this->data['response'] = true;
                                $this->data['message'] = 'Registro insertado con &eacute;xito.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return true;
                            }else{
                                $this->data['response'] = true;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
                            }
                        }else{
                            if(parent::update_areas()){
                                $this->data['response'] = true;
                                $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return true;
                            }else{
                                $this->data['response'] = true;
                                $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
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
                    if(isset($_GET['p1'])){
                        $this->areas['skAreas'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_areas();
                    }
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->areas_pdf();
                                break;
                        }
                    }
                    $this->load_view('areas-detail', $this->data);
                    return true;
                }
                
                private function areas_pdf(){
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
                /* TERMINA MODULO areas */
                
                
                /*EMPIEZA MODULO DE DEPARTAMENTOS*/
                
                 
                
                public function departamentos_index(){
                    if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                        
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sNombre'])){
                            $this->departamentos['sNombre'] = $_POST['sNombre'];
                        }
                        
                        if(isset($_POST['skStatus'])){
                            $this->departamentos['skStatus'] = $_POST['skStatus'];
                        }
                        
                        // TOTAL DE REGISTROS EN LA TABLA //
                        $getTotal = parent::count_departamentos()->fetch_assoc();
                        $iTotalRecords = $getTotal['total'];
                        // "LIMIT" TOTAL DE REGISTROS PARA MOSTRAR //
                        $iDisplayLength = intval($_REQUEST['length']);
                        $iDisplayLength = ($iDisplayLength < 0) ? $iTotalRecords : $iDisplayLength; 
                        // "OFFSET" //
                        $iDisplayStart = intval($_REQUEST['start']);
                        // PAGINA //
                        $sEcho = intval($_REQUEST['draw']);
                        
                        $this->departamentos['limit'] = $iDisplayLength;
                        $this->departamentos['offset'] = $iDisplayStart;
                        $this->data['departamentos'] = parent::read_like_departamentos();
                        
                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
                        
                        if($this->data['departamentos']){
                            while($row = $this->data['departamentos']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skDepartamento']));
                                $records["data"][] = array(
                                    htmlentities(utf8_encode($row['sNombre']), ENT_QUOTES)
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
                    $this->load_view('departamentos-index', $this->data);
                }
                
                public function departamentos_form(){
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                         
                        $this->departamentos['skDepartamento'] = !empty($_POST['skDepartamento']) ? $_POST['skDepartamento'] : substr(md5(microtime()), 1, 32);
                        $this->departamentos['sNombre'] = htmlentities($_POST['sNombre'],ENT_QUOTES);
                         $this->departamentos['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        if(empty($_POST['skDepartamento'])){
                            if(parent::create_departamentos()){
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro insertado con &eacute;xito.';
                                $this->data['datos'] = parent::read_equal_departamentos();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                $this->data['datos'] = $_POST;
                            }
                        }else{
                            if(parent::update_departamentos()){
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                                $this->data['datos'] = parent::read_equal_departamentos();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                                $this->data['datos'] = $_POST;
                            }
                        }
                    }
                    if(isset($_GET['p1'])){
                        $this->departamentos['skDepartamento'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_departamentos();
                    }
                    $this->load_view('departamentos-form', $this->data);
                    return true;
                }
                
                /* TERMINA MODULO DE DEPARTAMENTOS*/
                
                
                                
                /*EMPIEZA MODULO DE TIPO DE EMPRESAS*/
                 public function tipemp_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->tipemp_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['sNombre'])){
                                    $this->tipoempresas['sNombre'] = $_POST['sNombre'];
                                }
                               
                                if(isset($_POST['skStatus'])){
                                    $this->tipoempresas['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_tipoempresas();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->tipoempresas['limit'] = $records['limit'];
                                $this->tipoempresas['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_tipoempresas();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skTipoEmpresa']));
                                    array_push($records['data'], array(
                                        $row['sNombre']
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
                    
                    // INCLUYE UN MODELO DE OTRO MODULO //
                    $this->load_model('cof','cof');
                    $this->data['status'] = Cof_Model::read_status();
                    
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('tipemp-index', $this->data);
                    return true;
                }
                	
                 public function tipemp_form(){
                  	$this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                         
                        $this->tipoempresas['skTipoEmpresa'] = !empty($_POST['skTipoEmpresa']) ? $_POST['skTipoEmpresa'] : substr(md5(microtime()), 1, 32);
                        $this->tipoempresas['sNombre'] = htmlentities($_POST['sNombre'],ENT_QUOTES);
                         $this->tipoempresas['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        if(empty($_POST['skTipoEmpresa'])){
                            if(parent::create_tipoempresas()){
                            	$this->data['response'] = true;
                                $this->data['message'] = 'Registro insertado con &eacute;xito.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return true;
                                
                            }else{
                            	 $this->data['response'] = true;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
                                
                            }
                        }else{
                            if(parent::update_tipoempresas()){
                            	 $this->data['response'] = true;
                                $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return true;
                            }else{
                            	 $this->data['response'] = true;
                                $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;

                              
                            }
                        }
                    }
                    if(isset($_GET['p1'])){
                        $this->tipoempresas['skTipoEmpresa'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_tipoempresas();
                    }
                    $this->load_view('tipemp-form', $this->data);
                    return true;
                }
                
                 /* EMPIEZA MODULO DE EMPRESAS*/
                 public function empresas_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->empresas_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['sRFC'])){
                                    $this->empresas['sRFC'] = $_POST['sRFC'];
                                }
                                if(isset($_POST['sNombre'])){
                                    $this->empresas['sNombre'] = $_POST['sNombre'];
                                }
                                 if(isset($_POST['sNombreCorto'])){
                                    $this->empresas['sNombreCorto'] = $_POST['sNombreCorto'];
                                }
                               
                                if(isset($_POST['skStatus'])){
                                    $this->empresas['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_empresas();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->empresas['limit'] = $records['limit'];
                                $this->empresas['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_empresas();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skEmpresa']));
                                    array_push($records['data'], array(
                                        $row['sRFC'],
                                        $row['sNombre'],
                                        $row['sNombreCorto'],
                                        $row['tipoEmpresa'],
                                         $row['dFechaCreacion'],
                                          $row['htmlStatus']
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
                    
                    // INCLUYE UN MODELO DE OTRO MODULO //
                    $this->load_model('cof','cof');
                    $this->data['status'] = Cof_Model::read_status();
                    
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('empresas-index', $this->data);
                    return true;
                }
                 
                /* TERMINA MODULO DE EMPRESAS */
                 
                 
                 
                
                
	}
?>

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
                    $cof = new Cof_Model();
                    $this->data['status'] = $cof->read_status();
                     
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('areas-index', $this->data);
                    return true;
                }
                
                 
                public function areas_form(){ 
                    if(isset($_GET['axn'])){
                        if($_GET['axn']==='fileUpload'){
                            $upload_handler = new UploadHandler();
                            return true;
                        }
                    }
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        //exit('</pre>'.print_r($_POST,1).'</pre>');
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
                
                /* COMIENZA MODULO promotores */
                
                public function promotores_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['sNombre'])){
                                    $this->promotores['sNombre'] = $_POST['sNombre'];
                                }
                                if(isset($_POST['sCorreo'])){
                                    $this->promotores['sCorreo'] = $_POST['sCorreo'];
                                }
                                if(isset($_POST['skStatus'])){
                                    $this->promotores['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_promotores();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->promotores['limit'] = $records['limit'];
                                $this->promotores['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_promotores();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skPromotores']));
                                    array_push($records['data'], array(
                                         utf8_encode($row['sNombre'])
                                        ,utf8_encode($row['sCorreo'])
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
                    $cof = new Cof_Model();
                    $this->data['status'] = $cof->read_status();

                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('promotores-index', $this->data);
                    return true;
                }

                public function promotores_form(){
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        //exit('</pre>'.print_r($_POST,1).'</pre>');
                        $this->promotores['skPromotores'] = !empty($_POST['skPromotores']) ? $_POST['skPromotores'] : substr(md5(microtime()), 1, 32);
                        $this->promotores['sNombre'] = utf8_decode($_POST['sNombre']);
                        $this->promotores['sCorreo'] = utf8_decode($_POST['sCorreo']);
                        $this->promotores['skStatus'] = utf8_decode($_POST['skStatus']);
                        if(empty($_POST['skPromotores'])){
                            if(!parent::create_promotores()){
                                $this->data['response'] = false;
                            }
                        }else{
                            if(!parent::update_promotores()){
                                $this->data['response'] = false;
                            }
                        }
                        // RETORNAMOS RESPUESTA //
                        if($this->data['response']){
                            $this->data['message'] = 'Registro guardado con &eacute;xito.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return true;
                        }else{
                            $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;
                        }
                    }
                    if(isset($_GET['p1'])){
                        $this->promotores['skPromotores'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_promotores();
                    }
                    $this->load_view('promotores-form', $this->data);
                    return true;
                }
                
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
                    $cof = new Cof_Model();
                    $this->data['status'] = $cof->read_status();
                   
                    
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
                            if(parent::update_departamentos()){
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
                    $cof = new Cof_Model();
                    $this->data['status'] = $cof->read_status();
                     
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('tipemp-index', $this->data);
                    return true;
                }
                	
                 public function tipemp_form(){
                  	$this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                         
                        $this->tipoempresas['skTipoEmpresaViejo'] = $_POST['skTipoEmpresaViejo'];
                        $this->tipoempresas['skTipoEmpresa'] = $_POST['skTipoEmpresa'];
                        
                        $this->tipoempresas['sNombre'] = htmlentities($_POST['sNombre'],ENT_QUOTES);
                         $this->tipoempresas['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        if(empty($_POST['skTipoEmpresaViejo'])){
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
                               
                                if(isset($_POST['skCorresponsalia'])){
                                    $this->empresas['skCorresponsalia'] = $_POST['skCorresponsalia'];
                                }
                                
                                if(isset($_POST['skPromotor'])){
                                    $this->empresas['skPromotor1'] = $_POST['skPromotor'];
                                    $this->empresas['skPromotor2'] = $_POST['skPromotor'];
                                }
                                
                                if(isset($_POST['skTipoEmpresa'])){
                                    $this->tipoempresas['skTipoEmpresa'] = $_POST['skTipoEmpresa'];
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
                                    $promotores= utf8_encode(!empty($row['promotor1']) ? $row['promotor1'] : '' ).'<br>'.utf8_encode(!empty($row['promotor2']) ? $row['promotor2'] : '' );
                                    array_push($records['data'], array(
                                        utf8_encode($row['sRFC']),
                                        utf8_encode($row['sNombre']),
                                        utf8_encode($row['sNombreCorto']),
                                        utf8_encode($row['tipoEmpresa']),
                                        utf8_encode($row['corresponsalia']),
                                        $promotores,
                                        utf8_encode($row['htmlStatus']),
                                         !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.$actions['sHtml'].'</ul></div>' : ''
                                    ));
                                }
                                  header('Content-Type: application/json');
                                echo json_encode($records);
                                return true;
                                break;
                        }
                        return true;
                    }
                    
                    // tiposEmpresas //
                    $this->data['tiposEmpresas'] = parent::read_equal_tipoempresas();
                    
                    // Empresas de tipo Corresponsalias //
                    $this->tipoempresas['skTipoEmpresa'] = 'CORR';
                    $this->data['corresponsalias'] = parent::read_like_empresas();
                    
                    // Promotores //
                    $this->data['promotores'] = parent::read_equal_promotores();
                    
                    // INCLUYE UN MODELO DE OTRO MODULO //
                    $this->load_model('cof','cof');
                    $cof = new Cof_Model();
                    $this->data['status'] = $cof->read_status();
                    
                    // RETORNA LA VISTA areas-index.php //
                    $this->load_view('empresas-index', $this->data);
                    return true;
                }
                 
               
                
                public function empresas_form(){
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    $this->data['tiposEmpresas'] = parent::read_equal_tipoempresas();
                    $this->load_model('cof','cof');
                    
                    // Catalogo Status //
                    $cof = new Cof_Model();
                    $this->data['status'] = $cof->read_status();
                    // Empresas de tipo Corresponsalias //
                    $this->tipoempresas['skTipoEmpresa'] = 'CORR';
                    $this->data['corresponsalias'] = parent::read_like_empresas();
                    // Promotores //
                    $this->data['promotores'] = parent::read_equal_promotores();
                    
                    	 if(isset($_POST['axn']))
                    	 {
                        	switch ($_POST['axn'])
		                        {
		                            case "validarRFC":
		                                // echo 'false'; -> Email no encontrado 
		                                // echo 'true';  -> Email encontrado
										
		                                $this->empresas['sRFC'] = htmlentities(($_POST['sRFC']));
										$this->empresas['skEmpresaDistinta'] = (($_POST['skEmpresa']));
		                                if(parent::read_empresa())
		                                {
		                                    echo 'false';
		                                }
		                                else
		                                {
		                                    echo 'true';
		                                }
		                                exit;
		                            break;
		                            
		                            
		                        }
		                   }
                    if($_POST){
                    
                         
                        $this->empresas['skEmpresa'] = !empty($_POST['skEmpresa']) ? $_POST['skEmpresa'] : substr(md5(microtime()), 1, 32);
                        $this->tipoempresas['skTipoEmpresa'] = htmlentities($_POST['skTipoEmpresa'],ENT_QUOTES);
                        $this->empresas['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        $this->empresas['sNombre'] = !empty($_POST['sNombre']) ? htmlentities($_POST['sNombre'],ENT_QUOTES) : "";
                        $this->empresas['sNombreCorto'] = !empty($_POST['sNombreCorto']) ? htmlentities($_POST['sNombreCorto'],ENT_QUOTES) : "";
                        $this->empresas['sRFC'] = !empty($_POST['sRFC']) ? htmlentities($_POST['sRFC'],ENT_QUOTES) : "";
                        $this->empresas['skCorresponsalia'] = $_POST['skCorresponsalia'];
                        $this->empresas['skPromotor1'] = $_POST['skPromotor1'];
                        $this->empresas['skPromotor2'] = $_POST['skPromotor2'];
                        
                        if(empty($_POST['skEmpresa'])){
                            if(parent::create_empresas()){
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
                            if(parent::update_empresas()){
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
                        $this->empresas['skEmpresa'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_empresas();
                        
                    }
                    $this->load_view('empresas-form', $this->data);
                    return true;
                }
                
                 /* TERMINA MODULO DE EMPRESAS */
                 
                
                // MODULO DE TARIFAS POR CLIENTE //
                public function tarifas_index(){
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->tarifas_pdf();
                                break;
                            case 'delete':
                                $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                                $this->data['response'] = false;
                                $this->data['datos'] = false;
                                if(isset($_GET['p1'])){
                                    $this->tarifas['skTarifa'] = $_GET['p1'];
                                    if(parent::delete_tarifa()){
                                        $this->data['response'] = true;
                                        $this->data['datos'] = true;
                                        $this->data['message'] = 'Registro eliminado con &eacute;xito.';
                                    }
                                }
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return true;
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                $this->tarifas['skStatus'] = !empty($_POST['skStatus']) ? ($_POST['skStatus'] != 'todos') ? $_POST['skStatus'] : null : 'AC';
                                if(!empty($_POST['skTarifa'])){
                                    $this->tarifas['skTarifa'] = $_POST['skTarifa'];
                                }
                                if(!empty($_POST['skEmpresa'])){
                                    $this->tarifas['skEmpresa'] = $_POST['skEmpresa'];
                                }
                                if(!empty($_POST['sTipoCambio'])){
                                    $this->tarifas['sTipoCambio'] = $_POST['sTipoCambio'];
                                }
                                if(!empty($_POST['iTipoTarifa'])){
                                    $this->tarifas['iTipoTarifa'] = $_POST['iTipoTarifa'];
                                }
                                if(!empty($_POST['fTarifa'])){
                                    $this->tarifas['fTarifa'] = $_POST['fTarifa'];
                                }
                                if(!empty($_POST['fAgenteAduanal'])){
                                    $this->tarifas['fAgenteAduanal'] = $_POST['fAgenteAduanal'];
                                }
                                if(!empty($_POST['fCorresponsal'])){
                                    $this->tarifas['fCorresponsal'] = $_POST['fCorresponsal'];
                                }
                                if(!empty($_POST['fPromotor1'])){
                                    $this->tarifas['fPromotor1'] = $_POST['fPromotor1'];
                                }
                                if(!empty($_POST['fPromotor2'])){
                                    $this->tarifas['fPromotor2'] = $_POST['fPromotor2'];
                                }
                                if(!empty($_POST['skUserCreacion'])){
                                    $this->tarifas['skUserCreacion'] = $_POST['skUserCreacion'];
                                }
                                
                                if(!empty($_POST['dFechaInicio'])){
                                    $this->tarifas['dFechaInicio'] = $_POST['dFechaInicio'];
                                }
                                if(!empty($_POST['dFechaFin'])){
                                    $this->tarifas['dFechaFin'] = $_POST['dFechaFin'];
                                }
                                //exit('<pre>'.print_r($this->tarifas,1).'</pre>');
                                // OBTENER REGISTROS //
                                $total = parent::count_tarifas();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }
                                $this->tarifas['limit'] = $records['limit'];
                                $this->tarifas['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_tarifas();
                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }
                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skTarifa']),$row['skUserCreacion']);
                                    $tarifa="";
                                    switch ($row['iTipoTarifa']) {
                                        case 1:
                                            $tarifa = " Por Monto Fijo";
                                            break;
                                        case 2:
                                            $tarifa = "Por Porcentaje";
                                            break;
                                        case 3:
                                            $tarifa = "Por Contenedor";
                                            break;
                                    }
                                    array_push($records['data'], array(
                                         utf8_encode($row['cliente'])
                                        ,utf8_encode($row['sTipoCambio'])
                                        ,utf8_encode($tarifa)
                                        ,date('d-m-Y',  strtotime($row['dFechaCreacion']))
                                        ,utf8_encode($row['fTarifa'])
                                        ,utf8_encode($row['fAgenteAduanal'])
                                        ,utf8_encode($row['fCorresponsal'])
                                        ,utf8_encode($row['fPromotor1'])
                                        ,utf8_encode($row['fPromotor2'])
                                        ,utf8_encode($row['autor'])
                                        ,utf8_encode($row['htmlStatus'])
                                       ,!empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                    ));
                                }
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return true;
                                break;
                        }
                        return true;
                    }
                    
                    $this->load_model('emp','emp');
                    $emp = new Emp_Model();
                    $emp->tipoempresas['skTipoEmpresa'] = 'CLIE';
                    $this->data['clientes'] = $emp->read_like_empresas();
                    $emp->tipoempresas['skTipoEmpresa'] = 'CORR';
                    $this->data['corresponsalias'] = $emp->read_like_empresas();
                    $this->data['promotores'] = $emp->read_like_promotores();
                    
                    $this->load_model('cof','cof');
                    $cof = new Cof_Model();
                    $cof->users['skStatus'] = 'AC';
                    $this->data['usuarios'] = $cof->read_user();
                    
                    $this->load_view('tarifas-index',$this->data);
                    return true;
                }
                
                public function tarifas_form(){
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        $_POST['axn'] = !empty($_POST['axn']) ? $_POST['axn'] : 'save';
                        switch ($_POST['axn']){           
                            case "obtenerDatos":
                                return true;
                                break;
                            case "save":
                                $this->tarifas['skTarifa'] = !empty($_POST['skTarifa']) ? $_POST['skTarifa'] : substr(md5(microtime()), 1, 32);
                                $this->tarifas['skEmpresa'] = !empty($_POST['skEmpresa']) ? $_POST['skEmpresa'] : null;
                                $this->tarifas['sTipoCambio'] = !empty($_POST['sTipoCambio']) ? $_POST['sTipoCambio'] : null;
                                $this->tarifas['iTipoTarifa'] = !empty($_POST['iTipoTarifa']) ? $_POST['iTipoTarifa'] : null;
                                
                                $this->tarifas['fAgenteAduanal'] = !empty($_POST['fAgenteAduanal']) ? $_POST['fAgenteAduanal'] : 'null';
                                $this->tarifas['fCorresponsal'] = !empty($_POST['fCorresponsal']) ? $_POST['fCorresponsal'] : 'null';
                                $this->tarifas['fPromotor1'] = !empty($_POST['fPromotor1']) ? $_POST['fPromotor1'] : 'null';
                                $this->tarifas['fPromotor2'] = !empty($_POST['fPromotor2']) ? $_POST['fPromotor2'] : 'null';
                                $this->tarifas['skStatus'] = 'AC';
                                switch ($this->tarifas['iTipoTarifa']) {
                                    case 1:
                                        $this->tarifas['fTarifa'] = !empty($_POST['fTarifa']) ? $_POST['fTarifa'] : 'null';
                                        break;
                                    case 2:
                                        $this->tarifas['fTarifa'] = !empty($_POST['fTarifaPropuesta']) ? $_POST['fTarifaPropuesta'] : 'null';
                                        break;
                                    case 3:
                                        $this->tarifas['fTarifa'] = null;
                                        break;
                                }
                                // DEFAULT //
                                $this->data['message'] = 'Registro guardado con &eacute;xito.';
                                parent::terminarVigencia_tarifa();
                                if(!parent::create_tarifa()){
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                }
                                /*if(empty($_POST['skTarifa'])){
                                    // CREATE //
                                    if(!parent::create_tarifa()){
                                        $this->data['response'] = false;
                                        $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                    }
                                }else{
                                    // UPDATE //
                                    if(!parent::update_tarifa()){
                                        $this->data['response'] = false;
                                        $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                    }
                                }*/
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return true;
                                break;
                        }
                    }
                    if(isset($_GET['p1'])){
                        $this->tarifas['skTarifa'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_tarifa();
                        
                    }
                    // CLIENTES //
                    $this->load_model('emp','emp');
                    $emp = new Emp_Model();
                    $emp->tipoempresas['skTipoEmpresa'] = 'CLIE';
                    $this->data['clientes'] = $emp->read_like_empresas();
                    
                    $this->load_view('tarifas-form',$this->data);
                    return true;
                }
                 
                
                
	}
?>

<?php
    require_once(SYS_PATH.$_GET['sysModule'].'/model/'.$_GET['sysModule'].'.model.php');
    Class Cla_Controller Extends Cla_Model {
        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
                parent::__construct();
                ini_set('memory_limit', '-1');
        }

        public function __destruct(){

        }
        // VERIFICA SI LA EMPRESA EXISTE O INSERTA NUEVA //
        private function exist_empresa($emp , &$sNombre){
            $emp->empresas['sNombre'] = $sNombre;
            $empresa = $emp->read_like_empresas();
            if(!$empresa){
                /*$emp->empresas['skEmpresa'] = substr(md5(microtime()), 1, 32);
                $emp->empresas['skTipoEmpresa'] = 'N/A';
                $emp->empresas['skStatus'] = 'AC';
                $skEmpresa = $emp->create_empresas();
                if(!$skEmpresa){
                    return false;
                }
                return array($skEmpresa,$sNombre);
                return true;*/
                return false;
            }else{
                $rEmpresa = $empresa->fetch_row();
                return array($rEmpresa[0] , $rEmpresa[1]);
            }
        }
        // IMPORTAR EXCEL //
        public function import_excel(&$data , &$dFechaImportacion , $validar = 0){
            ini_set('memory_limit', '-1');
            
            if($validar == 1){
                $this->cla['skClasificacion'] = $_GET['p1'];
                $this->delete_cla();
            }
            
            $sReferencia = NULL;
            $sPedimento = NULL;
            $sEmpresa = NULL;
            $skEmpresa = NULL;
            $skClasificacion = NULL;
            
            $this->cla['dFechaImportacion'] = $dFechaImportacion;
            $this->cla['valido'] = $validar;
            $this->cla['skStatus'] = 'AC';
            $this->cla['skUsersCreacion'] = $_SESSION['session']['skUsers'];
            
            $this->claMer['skStatus'] = 'AC';
            $this->claMer['skUsersCreacion'] = $_SESSION['session']['skUsers'];
            $this->claMer['dFechaImportacion'] = $dFechaImportacion;
               
            // CARGAMOS EL MODELO DE EMPRESAS //
            $this->load_model('emp','emp');
            $emp = new Emp_Model();
            
            //exit('<pre>'.print_r($data,1).'</pre>');
            if(!count($data)){
                return false;
            }
            $flag = true;
            $message = false;
            $cad  ="";
            $i = 0;
            $lineaExcel = 2;
            foreach($data AS $k => $v){
                // VERIFICACMOS QUE VENGA REFERENCIA Y PEDIMENTO //
                    if(empty($v['REFERENCIA']) && empty($v['PEDIMENTO'])){
                        continue;
                    }
                // VERIFICAMOS SI EXISTE EMPRESA O LA CREAMOS //
                    if($sEmpresa != trim(utf8_decode($v['CLIENTE'])," ")){
                        $cliente = addslashes(trim(utf8_decode($v['CLIENTE'])," "));
                        $empresa = $this->exist_empresa(new Emp_Model() , $cliente);
                        if(!$empresa){ 
                            $flag = false;
                            $message = "No est&aacute; registrado el cliente: '".$cliente."' en el sistema.";
                            $this->delete_cla();
                            $this->delete_claMer();
                            break;
                        }
                        $skEmpresa = $empresa[0];
                        $sEmpresa = $empresa[1];
                    }
                    
                $this->cla['skEmpresa'] = $skEmpresa;
                
                if(!isset($v['REFERENCIA'])){
                    $v['REFERENCIA'] = "";
                }
                $this->cla['sReferencia'] = addslashes(trim($v['REFERENCIA']," "));
                
                if(!isset($v['PEDIMENTO'])){
                    $v['PEDIMENTO'] = "";
                }
                $this->cla['sPedimento'] = addslashes(trim($v['PEDIMENTO']," "));

                if(!isset($v['F DE PREVIO'])){
                    $v['F DE PREVIO'] = NULL;
                }
                $this->cla['dFechaPrevio'] = addslashes(trim($v['F DE PREVIO']," "));
                $this->cla['dFechaPrevio'] =  NULL;
                if(!isset($v['FACTURA'])){
                    $v['FACTURA'] = "";
                }
                $this->cla['sFactura'] = addslashes(trim($v['FACTURA']," "));
                
                // OBTIENE LA CLASIFICACIÓN //
                    if(
                        $sReferencia === trim($v['REFERENCIA']," ")
                        && $sPedimento === trim($v['PEDIMENTO']," ")
                        && $sEmpresa === trim(utf8_decode($v['CLIENTE'])," ")
                    ){
                        $this->cla['skClasificacion'] = $skClasificacion;
                    }else{
                        $cla = $this->get_cla();
                        if(!$cla){
                            $this->cla['skClasificacion'] = substr(md5(microtime()), 1, 32);
                            $skClasificacion = $this->create_cla();
                            if(!$skClasificacion){ 
                                $flag = false;
                                $message = "La referencia: ".$this->cla['sReferencia']." con pedimento: ".$this->cla['sPedimento']." y empresa: ".$sEmpresa." ; Est&aacute duplicada con una empresa diferente. (Linea del Excel ".$lineaExcel.")";
                                $this->delete_cla();
                                $this->delete_claMer();
                                break;
                            }
                            $this->cla['skClasificacion'] = $skClasificacion;
                            $sReferencia = addslashes(trim($v['REFERENCIA']," "));
                            $sPedimento = addslashes(trim($v['PEDIMENTO']," "));
                        }else{
                            $rCla = $cla->fetch_assoc();
                            if($rCla['dFechaImportacion'] != $dFechaImportacion){
                                $flag = false;
                                $message = "La referencia: ".$this->cla['sReferencia']." con pedimento: ".$this->cla['sPedimento']." y empresa: ".$sEmpresa." ; Ya ha sido importada anteriormente.";
                                $this->cla['dFechaImportacion'] = $dFechaImportacion;
                                $this->claMer['dFechaImportacion'] = $dFechaImportacion;
                                $this->delete_cla();
                                $this->delete_claMer();
                                break; 
                            }
                            $this->cla['skClasificacion'] = $rCla['skClasificacion'];
                            $skClasificacion = $rCla['skClasificacion'];
                            $sReferencia = addslashes(trim($v['REFERENCIA']," "));
                            $sPedimento = addslashes(trim($v['PEDIMENTO']," "));
                        }
                    }
                // AGREGAMOS LAS FRACCIONES //
                        $this->claMer['skClasificacionMercancia'] = substr(md5(microtime()), 1, 32);
                        $this->claMer['skClasificacion'] = $skClasificacion;
                        
                        if(!isset($v['FRACCION'])){
                            $v['FRACCION'] = "N/A";
                        }
                        $this->claMer['sFraccion'] = addslashes(trim($v['FRACCION']," "));
     
                        if(!isset($v['DESCRIPCION'])){
                            $v['DESCRIPCION'] = "";
                        }
                        $this->claMer['sDescripcion'] = addslashes(trim(utf8_decode($v['DESCRIPCION'])," "));
                        
                        if(!isset($v['INGLES'])){
                            $v['INGLES'] = "";
                        }
                        $this->claMer['sDescripcionIngles'] = addslashes(trim(utf8_decode($v['INGLES'])," "));
                        
                        if(!isset($v['MODELO'])){
                            $v['MODELO'] = "";
                        }
                        $this->claMer['sNumeroParte'] = addslashes(trim($v['MODELO']," "));
                        
                        if(!isset($v['CONSECUTIVO'])){
                            $v['CONSECUTIVO'] = "";
                        }
                        $this->claMer['iSecuencia'] = addslashes(trim($v['CONSECUTIVO']," "));
                                
                        /*$getSecuencia = $this->getSecuencia();
                        $this->claMer['iSecuencia'] = 1;
                        if($getSecuencia){
                            $r = $getSecuencia->fetch_row();
                            $this->claMer['iSecuencia'] = !is_null($r[0]) ? ($r[0]+1) : 1;
                        }*/
                        $skClasificacionMercancia = $this->create_claMer();
                        if(!$skClasificacionMercancia){ 
                            $flag = false;
                            $message = "Hubo un error al registar la fraccion ".$this->claMer['sFraccion']." con numero de parte: ".$this->claMer['sNumeroParte']." , referencia: ".$this->cla['sReferencia']." y pedimento: ".$this->cla['sPedimento'];
                            $this->delete_cla();
                            $this->delete_claMer();
                            break;
                        }
                
                $i++;
                $lineaExcel++;
            }
            if(!$flag){
                return array(
                "response"=>false
                ,"message"=>$message
            );
            }
            return array(
                "response"=>true
                ,"message"=>"Importaci&oacute;n realizada con &eacute;xito"
            );
        }
        
        /* COMIENZA MODULO clasifiación arancelaria */
        public function claara_validar(){
            $year = date('Y');
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'delete':
                        $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                        $this->data['response'] = false;
                        $this->data['datos'] = false;
                        if(isset($_GET['p1'])){
                            $this->cla['skClasificacion'] = $_GET['p1'];
                            if($this->delete_cla()){
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
                        $this->cla['orderBy'] = "sPedimento";
                        $this->cla['year'] = $year;
                        $this->cla['valido']  = 0;
                        
                        if(isset($_POST['sReferencia'])){
                            $this->cla['sReferencia'] = $_POST['sReferencia'];
                        }
                        if(isset($_POST['sPedimento'])){
                            $this->cla['sPedimento'] = $_POST['sPedimento'];
                        }
                        if(isset($_POST['skEmpresa'])){
                            $this->cla['skEmpresa'] = $_POST['skEmpresa'];
                        }
                        if(isset($_POST['skCreador'])){
                            $this->cla['skCreador'] = $_POST['skCreador'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->cla['skStatus'] = $_POST['skStatus'];
                        }
                        // EXPORTACIÓN A EXCEL //
                        if(isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1){
                            $this->data['data'] = parent::read_filter_cla();
                            $this->claara_excel();
                            return true;
                            exit;
                        }
                        // OBTENER REGISTROS //
                        $total = parent::count_cla_referencias_pendientes();
                        $records = Core_Functions::table_ajax($total);
                        if($records['recordsTotal'] === 0){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }
                        
                        $this->cla['limit'] = $records['limit'];
                        $this->cla['offset'] = $records['offset'];
                        $this->data['data'] = parent::read_cla_referencias_pendientes();
                        
                        if(!$this->data['data']){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }
                        //exit('<pre>'.print_r($records['data'],1).'</pre>');
                        $i = 0;
                        while($row = $this->data['data']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skClasificacion']));
                                $records['data'][$i] = array(
                                 utf8_encode($row['sReferencia']) // REFERENCIA
                                ,utf8_encode($row['sPedimento']) // PEDIMENTO
                                ,utf8_encode($row['empresa']) // EMPRESA (CLIENTE)
                                ,utf8_encode($row['totalFracciones']) // total de fracciones
                                ,utf8_encode($row['autor']) // usersCreacion
                                
                                ,utf8_encode($row['htmlStatus']) // STATUS
                                , !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                
                                );
                                
                             $i++;   
                        }
                        header('Content-Type: application/json');
                        echo json_encode($records);
                        return true;
                        break;
                }
                if($_POST){
                    //exit('<pre>'.print_r($_GET,1).'</pre><br><hr><pre>'.print_r($_POST,1).'</pre>');
                    ini_set('memory_limit', '-1');
                    $dFechaImportacion = date('Y-m-d H:i:s');
                    $data = json_decode($_POST['sJson'],1);
                    $response = $this->import_excel($data[key($data)],$dFechaImportacion,1);
                    if($response['response']){
                        $this->data['response'] = $response['response'];
                        $this->data['message'] = $response['message'];
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return true;
                    }else{
                        $this->cla['dFechaImportacion'] = $dFechaImportacion;
                        $this->data['response'] = $response['response'];
                        $this->data['message'] = $response['message'];
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return false;
                    }
                    /*if(isset($_GET['p1'])){
                        $this->cla['skClasificacion'] = $_GET['p1'];
                        if(!$this->validarPrimeraClasifiacion()){
                            $this->data['response'] = false;
                            $this->data['message'] = 'Hubo un error al intentar validar la primera clasifiaci&oacute;n, intenta de nuevo.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;
                        }
                        $this->data['response'] = true;
                        $this->data['message'] = 'Se ha validado la primera clasificaci&oacute;n.';
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return true;
                    }*/
                    return true;
                }
                return true;
            }
            // INCLUYE EL MODELO DEL MODULO cof //
            $this->load_model('cof','cof');
            $cof = new Cof_Model();
            $this->data['status'] = $cof->read_status();
            
            // LISTAR TODOS LOS USUARIOS
            $this->data['users'] = $cof->read_user();
            
            // INCLUYE EL MODELO DEL MODULO emp //
            $this->load_model('emp','emp');
            $emp = new Emp_Model();
            $this->data['empresas'] = $emp->read_equal_empresas();
            
            // RETORNA LA VISTA >numPar-index.php //
            $this->load_view('claara-validar', $this->data);
            return true;
        }
        
        public function clara_index(){
            $this->claara_index(false);
        }
        
        public function claara_index($year = true){
            if($year){ 
                $year = date('Y');
            }else{
                $year = NULL;
            }
            ini_set('memory_limit', '-1');
            //exit('<pre>'.print_r($_GET,1).'</pre>');
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'pdf':
                        $this->claara_pdf();
                        break;
                    case 'fetch_all':
                        // PARAMETROS PARA FILTRADO //
                        $this->cla['orderBy'] = "sPedimento";
                        $this->cla['year'] = $year;
                        $this->cla['valido'] = 1;
                        
                        if(isset($_POST['sReferencia'])){
                            $this->cla['sReferencia'] = $_POST['sReferencia'];
                        }
                        if(isset($_POST['sPedimento'])){
                            $this->cla['sPedimento'] = $_POST['sPedimento'];
                        }
                        if(isset($_POST['skEmpresa'])){
                            $this->cla['skEmpresa'] = $_POST['skEmpresa'];
                        }
                        if(isset($_POST['sFraccion'])){
                            $this->claMer['sFraccion'] = $_POST['sFraccion'];
                        }
                        if(isset($_POST['sDescripcion'])){
                            $this->claMer['sDescripcion'] = $_POST['sDescripcion'];
                        }
                        if(isset($_POST['sDescripcionIngles'])){
                            $this->claMer['sDescripcionIngles'] = $_POST['sDescripcionIngles'];
                        }
                        if(isset($_POST['sNumeroParte'])){
                            $this->claMer['sNumeroParte'] = $_POST['sNumeroParte'];
                        }
                        if(isset($_POST['sFactura'])){
                            $this->cla['sFactura'] = $_POST['sFactura'];
                        }
                        if(isset($_POST['dFechaPrevio'])){
                            $this->cla['dFechaPrevio'] = $_POST['dFechaPrevio'];
                        }
                        if(isset($_POST['skCreador'])){
                            $this->cla['skCreador'] = $_POST['skCreador'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->cla['skStatus'] = $_POST['skStatus'];
                        }
                        
                        // EXPORTACIÓN A EXCEL //
                        if(isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1){
                            $this->data['data'] = parent::read_filter_cla();
                            $this->claara_excel();
                            return true;
                            exit;
                        }
                        // OBTENER REGISTROS //
                        $total = parent::count_cla();
                        $records = Core_Functions::table_ajax($total);
                        if($records['recordsTotal'] === 0){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }
                        
                        $this->cla['limit'] = $records['limit'];
                        $this->cla['offset'] = $records['offset'];
                        $this->data['data'] = parent::read_filter_cla();
                        
                        if(!$this->data['data']){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }
                        //exit('<pre>'.print_r($records['data'],1).'</pre>');
                        $i = 0;
                        while($row = $this->data['data']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skClasificacion']));
                                $records['data'][$i] = array(
                                 utf8_encode($row['sReferencia']) // REFERENCIA
                                ,utf8_encode($row['sPedimento']) // PEDIMENTO
                                ,utf8_encode($row['empresa']) // EMPRESA (CLIENTE)
                                
                                ,utf8_encode($row['sFraccion']) // FRACCIÓN
                                ,utf8_encode($row['sDescripcion']) // DESCRIPCIÓN
                                ,utf8_encode($row['sDescripcionIngles']) // DESCIPCIÓN INGLÉS
                                ,utf8_encode($row['sNumeroParte']) // NUMERO DE PARTE (MODELO)
                                
                                ,utf8_encode($row['dFechaPrevio']) // FECHA PREVIO
                                ,utf8_encode($row['sFactura']) // FACTURA
                                ,utf8_encode($row['usersCreacion']) // usersCreacion
                                
                                ,utf8_encode($row['htmlStatus']) // STATUS
                                , !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                
                                );
                                
                             $i++;   
                        }


                        /*$i = 0;
                        while($row = $this->data['data']->fetch_assoc()){
                            $actions = $this->printModulesButtons(2,array($row['skClasificacion']));
                            $this->claMer['skClasificacion'] = $row['skClasificacion'];
                            if(
                                   isset($_POST['sFraccion'])
                                || isset($_POST['sDescripcion'])
                                || isset($_POST['sDescripcionIngles'])
                                || isset($_POST['sNumeroParte'])
                            ){
                               $this->claMer['skClasificacion'] = NULL; 
                            }
                            $this->claMer['skStatus'] = 'AC';
                            $this->claMer['limit'] = $records['limit'];
                            $this->claMer['offset'] = $records['offset'];
                            //$claMer = $this->read_equal_claMer();
                            $claMer = $this->read_like_claMer();
                            if(!$claMer){
                                $records = array();
                                break;
                            }
                            while($rClaMer = $claMer->fetch_assoc()){
                                
                                $records['data'][$i] = array(
                                 utf8_encode($row['sReferencia']) // REFERENCIA
                                ,utf8_encode($row['sPedimento']) // PEDIMENTO
                                ,utf8_encode($row['empresa']) // EMPRESA (CLIENTE)
                                
                                ,utf8_encode($rClaMer['sFraccion']) // FRACCIÓN
                                ,utf8_encode($rClaMer['sDescripcion']) // DESCRIPCIÓN
                                ,utf8_encode($rClaMer['sDescripcionIngles']) // DESCIPCIÓN INGLÉS
                                ,utf8_encode($rClaMer['sNumeroParte']) // NUMERO DE PARTE (MODELO)
                                
                                ,utf8_encode($row['dFechaPrevio']) // FECHA PREVIO
                                ,utf8_encode($row['sFactura']) // FACTURA
                                ,utf8_encode($row['usersCreacion']) // usersCreacion
                                
                                ,utf8_encode($row['htmlStatus']) // STATUS
                                , !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                
                                );
                                
                             $i++;   
                            }
                        }*/
                        //exit('<pre>'.print_r($records,1).'</pre>');
                        header('Content-Type: application/json');
                        echo json_encode($records);
                        return true;
                        break;
                }
                return true;
            }
            
            // INCLUYE EL MODELO DEL MODULO cof //
            $this->load_model('cof','cof');
            $cof = new Cof_Model();
            $this->data['status'] = $cof->read_status();
            
            // LISTAR TODOS LOS USUARIOS
            $this->data['users'] = $cof->read_user();
            
            // INCLUYE EL MODELO DEL MODULO emp //
            $this->load_model('emp','emp');
            $emp = new Emp_Model();
            $this->data['empresas'] = $emp->read_equal_empresas();
            
            // RETORNA LA VISTA >numPar-index.php //
            $this->load_view('claara-index', $this->data);
            return true;
        }
        
        public function clara_form(){
            $this->claara_form();
        }
        
        public function claara_form(){
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'excel':
                        $this->claara_excel();
                        break;
                    case 'pdf':
                        $this->claara_pdf();
                        break;
                }
            }
            if(isset($_POST['axn'])){
                if($_POST['axn']=='json_excel'){
                    $dFechaImportacion = date('Y-m-d H:i:s');
                    ini_set('memory_limit', '-1');
                    $data = json_decode($_POST['sJson'],1);
                    $response = $this->import_excel($data[key($data)],$dFechaImportacion,0);
                    if($response['response']){
                        $this->data['response'] = $response['response'];
                        $this->data['message'] = $response['message'];
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return true;
                    }else{
                        $this->cla['dFechaImportacion'] = $dFechaImportacion;
                        $this->data['response'] = $response['response'];
                        $this->data['message'] = $response['message'];
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return false;
                    }
                }
                if($_POST['axn']=='listImg'){
                    $this->desArc['skFraccionArancelariaDescripcion'] = $_POST['skFraccionArancelariaDescripcion'];
                    $desArc = parent::read_equal_desArc();
                    $datos = array();
                    if(!$desArc){
                        header('Content-Type: application/json');
                        echo json_encode($datos);
                        return false;
                    }
                    while($_desArc = $desArc->fetch_assoc()){
                        $datos[] = array(
                             'src'=>utf8_encode(SYS_URL.$_GET['sysProject'].'/'.$_GET['sysModule'].'/files/claara-form/'.$_desArc['skFraccionArancelariaDescripcion'].'/'.$_desArc['sArchivo'])
                            ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                        );    
                    }
                    header('Content-Type: application/json');
                    echo json_encode($datos);
                    return true;
                }
            }

            /*if(isset($_GET['p2'])){
                $imagePath = isset($_GET['url']) ? $_GET['url'] : FALSE;
                $width = isset($_GET['width']) ? $_GET['width'] : 100;
                $height = isset($_GET['height']) ? $_GET['height'] : 100;	
                $imagePath = 'http://vision7.com.mx/admin/files/banner/1737876976dannycapdam.jpg';
                Core_Functions::thumbnailImage($imagePath,$width,$height);
                return true;
            }*/

            if($_POST){
                //exit('<pre>'.print_r($_POST,1).'</pre>');
             	$this->cla['skClasificacion'] = !empty($_POST['skClasificacion']) ? $_POST['skClasificacion'] : substr(md5(microtime()), 1, 32);
                $this->cla['sReferencia'] = !empty($_POST['sReferencia']) ? utf8_decode($_POST['sReferencia']) : NULL ;
                $this->cla['sPedimento'] = !empty($_POST['sPedimento']) ? utf8_decode($_POST['sPedimento']) : NULL ;
                $this->cla['skEmpresa'] = !empty($_POST['skEmpresa']) ? utf8_decode($_POST['skEmpresa']) : NULL ;
                $this->cla['sFactura'] = !empty($_POST['sFactura']) ? utf8_decode($_POST['sFactura']) : NULL ;
                $this->cla['dFechaPrevio'] = !empty($_POST['dFechaPrevio']) ? utf8_decode($_POST['dFechaPrevio']) : NULL ;
                $this->cla['skStatus'] = !empty($_POST['skStatus']) ? utf8_decode($_POST['skStatus']) : 'IN' ;
                $this->cla['dFechaCreacion'] = 'CURRENT_TIMESTAMP';
                $this->cla['skUsersCreacion'] = $_SESSION['session']['skUsers'];
                $this->cla['dFechaImportacion'] = date('Y-m-d H:i:s');
                $this->claMer['dFechaImportacion'] = date('Y-m-d H:i:s');
                
                
                $this->claMer['skStatus'] = !empty($_POST['skStatus']) ? utf8_decode($_POST['skStatus']) : 'IN' ;
                $this->claMer['dFechaCreacion'] = 'CURRENT_TIMESTAMP';
                $this->claMer['skUsersCreacion'] = $_SESSION['session']['skUsers'];
                $this->claMer['dFechaModificacion'] = 'CURRENT_TIMESTAMP';
                $this->claMer['skUsersModificacion'] = $_SESSION['session']['skUsers'];
                
                if(empty($_POST['skClasificacion'])){
                    $skClasificacion = $this->create_cla();
                    if(!$skClasificacion){
                        $this->delete_cla();
                        $this->delete_claMer();
                        $this->data['response'] = false;
                        $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return false;
                    }
                    $this->claMer['skClasificacion'] = $skClasificacion;
                    if(isset($_POST['sFraccion'])){
                        for($i=0;$i < count($_POST['sFraccion']);$i++){
                            $this->claMer['skClasificacionMercancia'] = substr(md5(microtime()), 1, 32);
                            $this->claMer['sFraccion'] = isset($_POST['sFraccion'][$i]) ? $_POST['sFraccion'][$i] : NULL;
                            $this->claMer['sNumeroParte'] = isset($_POST['sNumeroParte'][$i]) ? $_POST['sNumeroParte'][$i] : NULL;
                            $this->claMer['sDescripcion'] = isset($_POST['sDescripcion'][$i]) ? $_POST['sDescripcion'][$i] : NULL;
                            $this->claMer['sDescripcionIngles'] = isset($_POST['sDescripcionIngles'][$i]) ? $_POST['sDescripcionIngles'][$i] : NULL;
                            $skClasificacionMercancia = $this->create_claMer();
                            if(!$skClasificacionMercancia){
                                $this->delete_cla();
                                $this->delete_claMer();
                                $this->data['response'] = false;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
                                break;
                            }
                        }
                    }
                }else{
                    $this->cla['dFechaModificacion'] = 'CURRENT_TIMESTAMP';
                    $this->cla['skUsersModificacion'] = $_SESSION['session']['skUsers'];
                    $skClasificacion = $this->update_cla();
                    if(!$skClasificacion){
                        $this->delete_cla();
                        $this->delete_claMer();
                        $this->data['response'] = false;
                        $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return false;
                    }
                    $this->claMer['skClasificacion'] = $_POST['skClasificacion'];
                    $this->claMer['skStatus'] = 'IN';     
                    $this->delete_claMer();
                    if(isset($_POST['sFraccion'])){
                        $this->claMer['skStatus'] = 'AC'; 
                        for($i=0;$i < count($_POST['sFraccion']);$i++){
                            $this->claMer['skClasificacionMercancia'] = isset($_POST['skClasificacionMercancia'][$i]) ? $_POST['skClasificacionMercancia'][$i] : FALSE;
                            $this->claMer['sFraccion'] = isset($_POST['sFraccion'][$i]) ? $_POST['sFraccion'][$i] : NULL;
                            $this->claMer['sNumeroParte'] = isset($_POST['sNumeroParte'][$i]) ? $_POST['sNumeroParte'][$i] : NULL;
                            $this->claMer['sDescripcion'] = isset($_POST['sDescripcion'][$i]) ? $_POST['sDescripcion'][$i] : NULL;
                            $this->claMer['sDescripcionIngles'] = isset($_POST['sDescripcionIngles'][$i]) ? $_POST['sDescripcionIngles'][$i] : NULL;
                            
                            if($this->claMer['skClasificacionMercancia']){
                                $skClasificacionMercancia = $this->update_claMer();
                                if(!$skClasificacionMercancia){
                                    $this->delete_cla();
                                    $this->delete_claMer();
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                    header('Content-Type: application/json');
                                    echo json_encode($this->data);
                                    return false;
                                    break;
                                }
                            }else{
                                $this->claMer['skClasificacionMercancia'] = substr(md5(microtime()), 1, 32);
                                $skClasificacionMercancia = $this->create_claMer();
                                if(!$skClasificacionMercancia){
                                    $this->delete_cla();
                                    $this->delete_claMer();
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                                    header('Content-Type: application/json');
                                    echo json_encode($this->data);
                                    return false;
                                    break;
                                }
                            }
                        }
                    }
                }
                $this->data['response'] = true;
                $this->data['message'] = 'Operaci&oacute;n realizada con &eacute;xito.';
                header('Content-Type: application/json');
                echo json_encode($this->data);
                return true;
                
            }
            // MOSTRAR LA VISTA //
            if(isset($_GET['p1'])){
                // OBTENER NUMERO DE PARTE //
                $this->cla['skClasificacion'] = $_GET['p1'];
                $data = parent::read_equal_cla();
                if(!$data){
                    return false;
                }
                $i = 0;
                $records = array();
                while($row = $data->fetch_assoc()){
                    $records = array(
                         'skClasificacion' => $row['skClasificacion'] 
                        ,'skEmpresa' => $row['skEmpresa'] 
                        ,'sReferencia' => $row['sReferencia'] 
                        ,'sPedimento' => $row['sPedimento']
                        ,'dFechaPrevio' => $row['dFechaPrevio']
                        ,'sFactura' => $row['sFactura']
                        ,'skStatus' => $row['skStatus']
                        ,'dFechaCreacion' => $row['dFechaCreacion']
                        ,'skUsersCreacion' => $row['skUsersCreacion']
                        ,'dFechaModificacion' => $row['dFechaModificacion']
                        ,'skUsersModificacion' => $row['skUsersModificacion']
                        ,'dFechaImportacion' => $row['dFechaImportacion']
                    );
                    $this->claMer['skClasificacion'] = $row['skClasificacion'];
                    $this->claMer['skStatus'] = 'AC';
                    $claMer = parent::read_equal_claMer();
                    if($claMer){
                        while($rClaMer = $claMer->fetch_assoc()){
                            $records['mercancias'][$i] = array(
                                'skClasificacionMercancia'=>utf8_encode($rClaMer['skClasificacionMercancia']) // skClasificacionMercancia
                               ,'sFraccion'=>utf8_encode($rClaMer['sFraccion']) // FRACCIÓN
                               ,'sNumeroParte'=>utf8_encode($rClaMer['sNumeroParte']) // NUMERO DE PARTE (MODELO)
                               ,'sDescripcion'=>utf8_encode($rClaMer['sDescripcion']) // DESCRIPCIÓN
                               ,'sDescripcionIngles'=>utf8_encode($rClaMer['sDescripcionIngles']) // DESCIPCIÓN INGLÉS
                            );

                         $i++;   
                        }
                    }
                }
                $this->data['data']['clasificacion'] = $records;
                //exit('<pre>'.print_r($this->data['data']['clasificacion'],1).'</pre>');
            }
            
            // INCLUYE EL MODELO DEL MODULO emp //
            $this->load_model('emp','emp');
            $emp = new Emp_Model();
            $this->data['empresas'] = $emp->read_equal_empresas();
            
            $this->load_view('claara-form', $this->data);
            return true;
        }
        
        // OBTENER NUMERO DE PARTE //
        private function getNumeroParte(){
            $datos = array();
            $this->numPar['skNumeroParte'] = $_GET['p1'];
            $numPar = parent::read_equal_numPar();
            if($numPar){
                $a = 0;
                while($_numPar = $numPar->fetch_assoc()){
                    $datos['numPar'] = array(
                         'skNumeroParte'=>utf8_encode($_numPar['skNumeroParte'])
                        ,'sNombre'=>utf8_encode($_numPar['sNombre'])
                        ,'sDescripcion'=>utf8_encode($_numPar['sDescripcion'])
                        ,'skStatus'=>utf8_encode($_numPar['skStatus'])
                        ,'dFechaCreacion'=>!empty($_numPar['dFechaCreacion']) ? date("d-m-Y", strtotime($_numPar['dFechaCreacion'])) : ''
                        ,'skUsersCreacion'=>utf8_encode($_numPar['skUsersCreacion'])
                        ,'dFechaModificacion'=>!empty($_numPar['dFechaModificacion']) ? date("d-m-Y", strtotime($_numPar['dFechaModificacion'])) : ''
                        ,'skUsersModificacion'=>utf8_encode($_numPar['skUsersModificacion'])
                        ,'htmlStatus'=>utf8_encode($_numPar['htmlStatus'])
                    );
                    // OBTENER FRACCIONES ARANCELARIAS //
                    $this->numparfraran['skNumeroParte'] = $_numPar['skNumeroParte'];
                    $numparfraran = parent::read_equal_numparfraran();
                    if(!$numparfraran){ continue; }
                    $b = 0;
                    while($_numparfraran = $numparfraran->fetch_assoc()){
                        $datos['numPar']['numparfraran'][$b] = array(
                             'skFraccionArancelaria'=>utf8_encode($_numparfraran['skFraccionArancelaria'])
                            ,'skNumeroParte'=>utf8_encode($_numparfraran['skNumeroParte'])
                            ,'sNombre'=>utf8_encode($_numparfraran['sNombre'])
                            ,'skStatus'=>utf8_encode($_numparfraran['skStatus'])
                            ,'dFechaCreacion'=>!empty($_numparfraran['dFechaCreacion']) ? date("d-m-Y", strtotime($_numparfraran['dFechaCreacion'])) : ''
                            ,'skUsersCreacion'=>utf8_encode($_numparfraran['skUsersCreacion'])
                            ,'dFechaModificacion'=>!empty($_numparfraran['dFechaModificacion']) ? date("d-m-Y", strtotime($_numparfraran['dFechaModificacion'])) : ''
                            ,'skUsersModificacion'=>utf8_encode($_numparfraran['skUsersModificacion'])
                        );
                        $this->fraAraDes['skFraccionArancelaria'] = $_numparfraran['skFraccionArancelaria'];
                        $fraAraDes = parent::read_equal_fraAraDes();
                        if(!$fraAraDes){ continue; }
                        $c = 0;
                        while($_fraAraDes = $fraAraDes->fetch_assoc()){
                            $datos['numPar']['numparfraran'][$b]['fraAraDes'][$c] = array(
                                 'skFraccionArancelariaDescripcion'=>utf8_encode($_fraAraDes['skFraccionArancelariaDescripcion'])
                                ,'skFraccionArancelaria'=>utf8_encode($_fraAraDes['skFraccionArancelaria'])
                                ,'sDescripcion'=>utf8_encode($_fraAraDes['sDescripcion'])
                                ,'sDescripcionIngles'=>utf8_encode($_fraAraDes['sDescripcionIngles'])
                                ,'sModelo'=>utf8_encode($_fraAraDes['sModelo'])
                                ,'skStatus'=>utf8_encode($_fraAraDes['skStatus'])
                                ,'dFechaCreacion'=>!empty($_fraAraDes['dFechaCreacion']) ? date("d-m-Y", strtotime($_fraAraDes['dFechaCreacion'])) : ''
                                ,'skUsersCreacion'=>utf8_encode($_fraAraDes['skUsersCreacion'])
                                ,'dFechaModificacion'=>!empty($_fraAraDes['dFechaModificacion']) ? date("d-m-Y", strtotime($_fraAraDes['dFechaModificacion'])) : ''
                                ,'skUsersModificacion'=>utf8_encode($_fraAraDes['skUsersModificacion'])
                            );
                            $this->desArc['skFraccionArancelariaDescripcion'] = $_fraAraDes['skFraccionArancelariaDescripcion'];
                            $desArc = parent::read_equal_desArc();
                            if(!$desArc){ continue; }
                            $d = 0;
                            while($_desArc = $desArc->fetch_assoc()){
                                $datos['numPar']['numparfraran'][$b]['fraAraDes'][$c]['desArc'][$d] = array(
                                     'skArchivoFraccionArancelaria'=>utf8_encode($_desArc['skArchivoFraccionArancelaria'])
                                    ,'skFraccionArancelariaDescripcion'=>utf8_encode($_desArc['skFraccionArancelariaDescripcion'])
                                    ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                                    ,'skStatus'=>utf8_encode($_desArc['skStatus'])
                                );
                                $d++;     
                            }
                            $c++;
                        }
                        $b++;
                    }
                    $a++;
                }
            }
            //exit('<pre>'.print_r($datos,1).'</pre>');
            return $datos;
        }
        
        public function claara_detail(){
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_GET['p1'])){
                // OBTENER NUMERO DE PARTE //
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $numPar = parent::read_equal_numPar();
                if($numPar){
                    $this->data['datos'] = $this->getNumeroParte();
                }
            }
            //exit('<pre>'.print_r($this->data['datos'],1).'</pre>');
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'listImg':
                        $this->desArc['skFraccionArancelariaDescripcion'] = $_POST['skFraccionArancelariaDescripcion'];
                        $desArc = parent::read_equal_desArc();
                        $datos = array();
                        if(!$desArc){
                            header('Content-Type: application/json');
                            echo json_encode($datos);
                            return false;
                        }
                        while($_desArc = $desArc->fetch_assoc()){
                            $datos[] = array(
                                 'src'=>utf8_encode(SYS_URL.$_GET['sysProject'].'/'.$_GET['sysModule'].'/files/claara-form/'.$_desArc['skFraccionArancelariaDescripcion'].'/'.$_desArc['sArchivo'])
                                ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                            );    
                        }
                        header('Content-Type: application/json');
                        echo json_encode($datos);
                        return true;
                    break;
                    case 'pdf':
                        $this->claara_pdf();
                    break;
                }
            }

            if(isset($_POST['axn'])){
                if($_POST['axn']=='listImg'){
                    $this->desArc['skFraccionArancelariaDescripcion'] = $_POST['skFraccionArancelariaDescripcion'];
                    $desArc = parent::read_equal_desArc();
                    $datos = array();
                    if(!$desArc){
                        header('Content-Type: application/json');
                        echo json_encode($datos);
                        return false;
                    }
                    while($_desArc = $desArc->fetch_assoc()){
                        $datos[] = array(
                             'src'=>utf8_encode(SYS_URL.$_GET['sysProject'].'/'.$_GET['sysModule'].'/files/claara-form/'.$_desArc['skFraccionArancelariaDescripcion'].'/'.$_desArc['sArchivo'])
                            ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                        );    
                    }
                    header('Content-Type: application/json');
                    echo json_encode($datos);
                    return true;
                }
            }

            $this->load_view('claara-detail', $this->data);
            return true;
        }
        
        public function claara_fotos(){
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_POST)){
		if(isset($_POST['axn'])){
			switch ($_POST['axn']) {
		            	case 'buscarFotos':
				$path = SYS_PATH.$_GET['sysModule'].'/files/claara/files/';
				if(!empty($_POST['sFraccion'])){
					$path .= $_POST['sFraccion'].'/';
                    $this->claMerArc['sFraccion'] = $_POST['sFraccion'];
				}
				if(!empty($_POST['sFraccion']) && !empty($_POST['sNumeroParte'])){
					$path .= $_POST['sNumeroParte'].'/';
                    $this->claMerArc['sNumeroParte'] = $_POST['sNumeroParte'];
				}
                $this->data['datos'] = array();
                $result = parent::read_like_claMerArc();
                while($row = $result->fetch_assoc()){
                    array_push($this->data['datos'], array(
                        "sFraccion"=> $row['sFraccion'],
                        "sNumeroParte"=> $row['sNumeroParte'],
                        "sArchivo"=> SYS_URL.SYS_PROJECT.'/cla/files/claara/files/'.$row['sFraccion'].'/'.$row['sNumeroParte'].'/'.$row['sArchivo'],
                        "sThumbnail"=> SYS_URL.SYS_PROJECT.'/cla/files/claara/files/'.$row['sFraccion'].'/'.$row['sNumeroParte'].'/'.$row['sThumbnail']
                        )
                    );
                }
				//$path = SYS_PATH.$_GET['sysModule'].'/files/claara/files/';				
				//$path = SYS_PATH.$_GET['sysModule'].'/files/claara/files/F1/';
				//$path = SYS_PATH.$_GET['sysModule'].'/files/claara/files/F1/P1/';
				/*if(isset($path)){
					// FOREACH //
					$this->data['datos'] = array();				
					foreach(glob($path.'*') as $file){ //var_dump($file);	
                                            if(!empty($_POST['sFraccion']) && !empty($_POST['sNumeroParte'])){
                                                $pathImg = explode($_GET['sysProject'],$file);
                                                $file = SYS_URL.SYS_PROJECT.$pathImg[1];
                                                array_push($this->data['datos'], array(
                                                    "sFraccion"=> isset($_POST['sFraccion']) ? $_POST['sFraccion'] : "",
                                                    "sNumeroParte"=> isset($_POST['sNumeroParte']) ? $_POST['sNumeroParte'] : "",
                                                    "sArchivo"=>$file
                                                    )
                                                );
                                            }else{
                                                foreach(glob($file.'/'.'*') as $filename){//echo $filename.' ==> ';
                                                    if(is_dir($filename)){
                                                            //echo $filename.' ==> ';
                                                            foreach(glob($filename.'/'.'*') as $filename2){ 
                                                                    //echo $filename2.' -- >';
                                                                    $pathImg = explode($_GET['sysProject'],$filename2);
                                                                    $filename2 = SYS_URL.$_GET['sysProject'].$pathImg[1];
                                                                    $filename2 = SYS_URL.SYS_PROJECT.'/'.$_GET['sysModule'].'/claara-fotos/fotografias/?axn=getFoto&url='.SYS_URL.SYS_PROJECT.$pathImg[1];
                                                                    $filename2 = SYS_URL.SYS_PROJECT.$pathImg[1];
                                                                    //echo $pathImg[1].' -- >';
                                                                    $fra_NumPar = explode('/cla/files/claara/files/',$pathImg[1]);
                                                                    $fra_NumPar = explode('/',$fra_NumPar[1]);
                                                                    //echo $fra_NumPar[0];
                                                                    array_push($this->data['datos'], array(
                                                                        "sFraccion"=> $fra_NumPar[0],
                                                                        "sNumeroParte"=> $fra_NumPar[1],
                                                                        "sArchivo"=>$filename2
                                                                        )
                                                                    );			
                                                            }					
                                                    }else{
                                                            $pathImg = explode($_GET['sysProject'],$filename);
                                                            $filename = SYS_URL.$_GET['sysProject'].$pathImg[1];
                                                            $filename = SYS_URL.SYS_PROJECT.'/'.$_GET['sysModule'].'/claara-fotos/fotografias/?axn=getFoto&url='.SYS_URL.SYS_PROJECT.$pathImg[1];
                                                            $filename = SYS_URL.SYS_PROJECT.$pathImg[1];
                                                            //echo basename($filename) . "  --> ";
                                                            $fra_NumPar = explode('/cla/files/claara/files/',$pathImg[1]);
                                                            $fra_NumPar = explode('/',$fra_NumPar[1]);
                                                            //echo $fra_NumPar[0];
                                                            array_push($this->data['datos'], array(
                                                                "sFraccion"=> $fra_NumPar[0],
                                                                "sNumeroParte"=> $fra_NumPar[1],
                                                                "sArchivo"=>$filename
                                                                )
                                                            );					
                                                    }
                                                }//endforeach
                                            }
                                        }
				}*/
				if(!$this->data['datos']){
					$this->data['message'] = 'No hay fotografias para este registro.';
					$this->data['response'] = false;
					header('Content-Type: application/json');
	                        	echo json_encode($this->data);
	                        	return false;
				}
				$this->data['message'] = 'Fotografias obtenidas.';
				header('Content-Type: application/json');
                        	echo json_encode($this->data);
	                        return true;
				break;
                                
                                case 'getNumerosParte':
                                    $this->claMerArc['sFraccion'] = !empty($_POST['sFraccion']) ? $_POST['sFraccion'] : "";
                                    $numerosParte = $this->data['numerosParte'] = parent::read_numerosParteFotos();
                                    $data = array();
                                    if($numerosParte){
                                        while($row = $numerosParte->fetch_assoc()){
                                            array_push($data,$row['sNumeroParte']);
                                        }
                                    }
                                    header('Content-Type: application/json');
                                    echo json_encode($data);
                                    return true;
                                break;
			}//switch
		}
                if(!empty($_FILES['zip']['name'])){
                    $arrayZips = array("application/zip", "application/x-zip", "application/x-zip-compressed");
                    if(in_array($_FILES['zip']['type'] , $arrayZips)){
                        //exit('<pre>'.print_r($_FILES['zip'],1).'</pre>');
                        if( !$this->claara_zip() ){
                            $this->data['response'] = false;
                            $this->data['message'] = 'Hubo un error al subir el archivo ZIP.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;    
                        }
                        $this->data['response'] = true;
                        $this->data['message'] = 'Archivo ZIP subido con &eacute;xito.';
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return true; 
                    }else{
                        $this->data['response'] = false;
                        $this->data['message'] = 'El archivo que intenta subir no es un archivo ZIP.';
                        header('Content-Type: application/json');
                        echo json_encode($this->data);
                        return false;
                    }
                }
            }
		if(isset($_GET['axn'])){
			switch ($_GET['axn']) {
		            	case 'getFoto':
					$this->claara_getFoto();
                                    return true;
				break;
			}
		}
            $this->data['fracciones'] = parent::read_fraccionesFotos();
            //$this->data['numerosParte'] = parent::read_numerosParteFotos();
            $this->load_view('claara-fotos', $this->data);
            return true; 
        }
        
        public function claara_excel(){
            //exit('<pre>'.print_r($_POST,1));
            //exit('<pre>'.print_r($this->data['data'],1));
            //echo date('H:i:s') . ' Current memory usage: ' . (memory_get_usage(true) / 1024 / 1024) . " MB <hr>" . PHP_EOL;
            /*ini_set('memory_limit', '-1');
            if(isset($_GET['p1'])){
                $this->cla['skClasificacion'] = $_GET['p1'];
            }
            $this->data['data'] = parent::read_equal_cla();*/           
            if(!$this->data['data']){
                 header('Location: '.$_SERVER['HTTP_REFERER']); 
                return false;
            }
            require_once(CORE_PATH."assets/PHPExcel/Classes/PHPExcel/IOFactory.php");
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load(SYS_PATH."cla/files/claara/tplClasificacionMercancias.xlsx");
            $i = 2;
            while($row = $this->data['data']->fetch_assoc()){
                /*$this->claMer['skClasificacion'] = $row['skClasificacion'];
                $this->claMer['skStatus'] = 'AC';
                $claMer = $this->read_like_claMer();
                if(!$claMer){
                    break;
                }*/
                //while($rClaMer = $claMer->fetch_assoc()){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, utf8_encode($row['sReferencia']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, utf8_encode($row['sPedimento']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, utf8_encode($row['empresa']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, utf8_encode($row['sFraccion']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, utf8_encode($row['sDescripcion']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, utf8_encode($row['sDescripcionIngles']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, utf8_encode($row['sNumeroParte']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, utf8_encode($row['dFechaPrevio']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, utf8_encode($row['sFactura']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, utf8_encode($row['usersCreacion']));
                    $i++;   
                //}
            }

            // Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Reporte.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            //$objWriter->save(SYS_PATH.'cla/files/claara/Reporte.xlsx');
            $objWriter->save('php://output');


            //exit('<pre>'.print_r($records,1).'</pre>');
            exit;
        }
        
        public function claara_zip(){
            $destination = SYS_PATH.$_GET['sysModule'].'/files/claara/files/';
            if( !move_uploaded_file($_FILES['zip']['tmp_name'] , $destination.$_FILES['zip']['name']) ){
                return false;
            }
            $path = $destination.$_FILES['zip']['name'];
            //$path = $destination.'fotos.zip';
            $folder = null;
            $zip = new ZipArchive;
            if ($zip->open($path) === true) {
                for($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    $fileinfo = pathinfo($filename);
                    $pos = strrpos($filename, ".jpg");
                    if ($pos === false){
                        // type --> FOLDER //
                        $f = explode('/',$filename);
                        $ignore = $f[0];
                        foreach($f AS $k => &$v){
                            
                            if(!empty($v)){
                            	if($folder === null){
                            		$folder = $v;
                            	}else{
	                            	$folder .= '/'.$v;
                            	}
                				if($folder === $ignore){
                					$folder=null;				
                				}else{
                                    //echo $folder.' => ';
                                    if(!is_dir($destination.$folder)){
                                        mkdir($destination.$folder, 0777, true);
                                    }
                				}
                            }
                        }// foreach
                        
                    }else{
                        // type --> IMG //
                        //echo "zip://".$path."#".$filename.' => '.$destination.$fileinfo['basename'].'<br><br>';
            			$filenameOut = str_replace($ignore.'/', '', $filename);
            			//echo $filenameOut.' --> ';
            			$fraNum = explode('/',$filenameOut);
            			//echo '<pre>'.print_r($fraNum,1).'</pre>';
            			/*if(parent::claara_create){
                                    copy("zip://".$path."#".$filename , $destination.$filenameOut);
            			}*/
            			
                        //echo $destination.$filenameOut.' --> ';
                        if(!file_exists($destination.$filenameOut)){
                            copy("zip://".$path."#".$filename , $destination.$filenameOut);
                            $arc = explode('/',$filenameOut);
                            // Generate thumbnail //
                            $img = SYS_URL.SYS_PROJECT.'/cla/files/claara/files/'.$filenameOut;
                            //echo $img . ' ==> '. $destination.$arc[0].'/'.$arc[1].'/thumbnail_'.$arc[2];
                            $imagick = new \Imagick($img);
                            //$imagick->cropImage(400,400, 30,10);
                            $imagick->cropThumbnailImage(150,150);
                            $imagick->writeImage($destination.$arc[0].'/'.$arc[1].'/thumbnail_'.$arc[2]);

                            // Save img in database //
                            $this->claMerArc['skClasificacionMercanciaArchivo'] = substr(md5(microtime()), 1, 32);
                            $this->claMerArc['sFraccion'] = $arc[0];
                            $this->claMerArc['sNumeroParte'] = $arc[1]; 
                            $this->claMerArc['sArchivo'] = $arc[2];
                            $this->claMerArc['sThumbnail'] = 'thumbnail_'.$arc[2];
                            $this->claMerArc['skStatus'] = 'AC';
                            $this->create_claMerArc();
                        }


                }
                    $folder = null;
                    //copy("zip://".$path."#".$filename , $destination.$fileinfo['basename']);
                }                  
                $zip->close();
                unlink($path);
                //exit('SUCCESS');
                return true;
            }else{
                //exit('ERROR');
                return false;
            }
        }
        
        public function claara_getFoto(){
            $imagePath = isset($_GET['url']) ? $_GET['url'] : FALSE;
            $width = isset($_GET['width']) ? $_GET['width'] : 250;
            $height = isset($_GET['height']) ? $_GET['height'] : 250;
            if( !$imagePath ){
                return  false;
            }
            $imagick = new \Imagick($imagePath);
            $imagick->setbackgroundcolor('rgb(64, 64, 64)');
            $imagick->thumbnailImage($width, $height, true, false);
            header("Content-Type: image/jpg");
            echo $imagick->getImageBlob();
            return true;
        }
        
        private function claara_pdf(){
            if(isset($_GET['p1'])){
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $this->data['datos'] = parent::read_equal_numPar();
            }
            ob_start();
            $this->load_view('cla-pdf', $this->data, FALSE, 'cla/pdf/');
            $content = ob_get_clean();
            $title = '>numPar';
            Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
            return true;
        }
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */    
    }
?>

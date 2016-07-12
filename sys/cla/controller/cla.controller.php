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
                return false;
            }else{
                $rEmpresa = $empresa->fetch_row();
                return array($rEmpresa[0] , $rEmpresa[1]);
            }
        }
        // IMPORTAR EXCEL //
        public function import_excel(&$data , &$dFechaImportacion, $validar = 0){
            ini_set('memory_limit', '-1');
            
            $skClasificacion = NULL;
            $this->cla['valido'] = $validar;
            $this->cla['dFechaImportacion'] = $dFechaImportacion;
            $this->claMer['dFechaImportacion'] = $dFechaImportacion;
            $this->cla['skStatus'] = 'AC';
            $this->claMer['skStatus'] = 'AC';
            
            if($validar==0){
                $dFechaCreacion = date('Y-m-d H:i:s');
                $this->cla['skUsersCreacion'] = $_SESSION['session']['skUsers'];
                $this->cla['dFechaCreacion'] = $dFechaCreacion;
                $this->claMer['skUsersCreacion'] = $_SESSION['session']['skUsers'];
                $this->claMer['dFechaCreacion'] = $dFechaCreacion;
            }else{
                $dFechaModificacion = date('Y-m-d H:i:s');
                $this->cla['skUsersModificacion'] = $_SESSION['session']['skUsers'];
                //$this->cla['skUsersCreacion'] = $dFechaModificacion;
                $this->cla['dFechaModificacion'] = $dFechaImportacion;
                $this->claMer['skUsersModificacion'] = $_SESSION['session']['skUsers'];
                $this->claMer['dFechaModificacion'] = $dFechaModificacion;
            }
            
            //exit('<pre>'.print_r($data,1).'</pre>');
            if(!count($data)){
                return false;
            }
            $flag = true;
            $message = false;
            $lineaExcel = 2;
            $factura = "";
            $consecutivo = 0;
            $array_consecutivos = array();
            foreach($data AS $k => $v){
                // VERIFICACMOS QUE VENGA REFERENCIA Y PEDIMENTO //
                    if(empty($v['REFERENCIA']) && $lineaExcel==2){
                        $flag = false;
                        $message = "No se especificó la referencia en la Columna A2 del template.";
                        break;
                    }
                    
                if(!isset($v['F DE PREVIO'])){
                    $v['F DE PREVIO'] = NULL;
                }
                $this->cla['dFechaPrevio'] = addslashes(trim(utf8_decode($v['F DE PREVIO'])," "));
                $this->cla['dFechaPrevio'] =  '';
                if(!isset($v['FACTURA'])){
                    $v['FACTURA'] = "";
                }
                $this->claMer['sFactura'] = addslashes(trim(utf8_decode($v['FACTURA'])," "));
                // INICIA EL CONTADOR DEL CONSECUTIVO POR FACTURA //
                if(array_key_exists($this->claMer['sFactura'] , $array_consecutivos)){
                    $consecutivo++;
                    $array_consecutivos[$this->claMer['sFactura']] += 1;
                }else{
                  $consecutivo = 1;
                  $array_consecutivos[$this->claMer['sFactura']] = 1;
                }
                // SE CREA LA PRIMERA CLASIFICACION //
                    if($validar == 0 && $lineaExcel==2){
                        $this->cla['skClasificacion'] = substr(md5(microtime()), 1, 32);
                        if(!isset($v['REFERENCIA'])){
                            $v['REFERENCIA'] = "";
                        }
                        $this->cla['sReferencia'] = addslashes(trim(utf8_decode($v['REFERENCIA'])," "));
                        $skClasificacion = $this->create_cla();
                        if(!$skClasificacion){ 
                            $flag = false;
                            $message = "Hubo un error al registrar la primera clasificaci&oacute;n con la referencia: ".$this->cla['sReferencia'];
                            break;
                        }
                    }else if($validar == 1 && $lineaExcel==2){
                        // SE BUSCA LA REFERENCIA PARA SU VALIDACION //
                        $this->cla['sReferencia'] = addslashes(trim(utf8_decode($v['REFERENCIA'])," "));
                        $result = $this->get_cla();
                        if(!$result){
                            $flag = false;
                            $message = "No se encontró la referencia: ".$this->cla['sReferencia']." para validar.";
                            break;
                        }
                        $rCla = $result->fetch_assoc();
                        $this->delete_cla();
                        $this->cla['skClasificacion'] = $rCla['skClasificacion'];
                        $this->cla['skUsersCreacion'] = $rCla['skUsersCreacion'];
                        $this->cla['dFechaCreacion'] = $rCla['dFechaCreacion'];
                        $this->cla['dFechaModificacion'] = $dFechaImportacion;
                        $this->claMer['skUsersCreacion'] = $rCla['skUsersCreacion'];
                        $this->claMer['dFechaCreacion'] = $rCla['dFechaCreacion'];
                        $this->claMer['dFechaModificacion'] = $dFechaImportacion;
                        $skClasificacion = $this->create_cla();
                        if(!$skClasificacion){ 
                            $flag = false;
                            $message = "Hubo un error al al intentar validar la referencia: ".$this->cla['sReferencia'];
                            break;
                        }
                    }
                // AGREGAMOS LAS FRACCIONES //
                        $this->claMer['skClasificacionMercancia'] = substr(md5(microtime()), 1, 32);
                        $this->claMer['skClasificacion'] = $skClasificacion;
                        
                        if(!isset($v['FRACCION'])){
                            $v['FRACCION'] = "";
                        }
                        $this->claMer['sFraccion'] = addslashes(trim(utf8_decode($v['FRACCION'])," "));
     
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
                        $this->claMer['sNumeroParte'] = addslashes(trim(utf8_decode($v['MODELO'])," "));
                        
                        if(!isset($v['CONSECUTIVO'])){
                            $v['CONSECUTIVO'] = "";
                        }
                        $this->claMer['iSecuencia'] = $array_consecutivos[$this->claMer['sFactura']];
                             
                        $skClasificacionMercancia = $this->create_claMer();
                        if(!$skClasificacionMercancia){ 
                            $flag = false;
                            $message = "Hubo un error al registar la fraccion ".$this->claMer['sFraccion']." con numero de parte: ".$this->claMer['sNumeroParte']." en la referencia: ".$this->cla['sReferencia'];
                            $this->delete_cla();
                            $this->delete_claMer();
                            break;
                        }
                
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
        
        // MUESTRA EL RESULTADO DE TODAS LAS PRIMERAS CLASIFICACIONES //
        public function claara_result(){
            $this->claara_validar(true);
        }
        
        // MUESTRA LAS PRIMERAS CLASIFICACIONES AUN NO VALIDADAS //
        public function claara_validar($valido = false){
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
                        $this->cla['orderBy'] = "cla.dFechaCreacion DESC";
                        $this->cla['year'] = $year;
                        
                        $this->cla['valido']  = ($valido) ? null : 0;
                        if(isset($_POST['valido'])){
                            $this->cla['valido'] = $_POST['valido'];
                        }
                        
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
                        if(isset($_POST['skUsersCreacion'])){
                            $this->cla['skUsersCreacion'] = $_POST['skUsersCreacion'];
                        }
                        if(isset($_POST['skUsersModificacion'])){
                            $this->cla['skUsersModificacion'] = $_POST['skUsersModificacion'];
                        }
                        // EXPORTACIÓN A EXCEL //
                        if(isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1){
                            $this->cla['orderBy'] = "cla.sReferencia DESC , cla.dFechaCreacion DESC , claMer.sFactura ASC , claMer.iSecuencia ASC";
                            $this->data['data'] = parent::read_filter_cla();
                            $this->claara_excel();
                            return true;
                            exit;
                        }
                        //exit('<pre>'.print_r($_POST,1).'</pre>');
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
                            $segundaClasificacion = 'block';
                            if($row['valido']==0){
                                $segundaClasificacion = 'none';
                            }
                                $actions = $this->printModulesButtons(2,array($row['skClasificacion'],$segundaClasificacion));
                                //exit('<pre>'.print_r($actions,1).'</pre>');
                                $records['data'][$i] = array(
                                !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                ,($row['valido']==0) ? '<center><i class="fa fa-ban"></i></center>' : '<center><i class="fa fa-check"></i></center>'
                                ,utf8_encode($row['sReferencia']) // REFERENCIA
                                ,utf8_encode($row['sPedimento']) // PEDIMENTO
                                ,utf8_encode($row['empresa']) // EMPRESA (CLIENTE)
                                ,utf8_encode($row['totalFracciones']) // total de fracciones
                                ,utf8_encode($row['ejecutivo']) // skUsersCreacion
                                ,utf8_encode($row['clasificador']) // skUsersModificacion
                                
                                ,utf8_encode($row['htmlStatus']) // STATUS
                                
                                );
                                
                             $i++;   
                        }
                        header('Content-Type: application/json');
                        echo json_encode($records);
                        return true;
                        break;
                }
                return true;
            }
            // Validación de la 1ra Clasificación //
            if($_POST){
                //exit('<pre>'.print_r($_POST,1));
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
            
            if($valido){
                // RETORNA LA VISTA >claara_result.php //
                $this->load_view('claara-result', $this->data);
            }else{
                // RETORNA LA VISTA >claara_validar.php //
                $this->load_view('claara-validar', $this->data);
            }
            return true;
        }
        
        public function clara_index(){
            // OBTENER CLASIFICACIÓN DE MERCANCIAS //
                if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                    $this->getCatalogoClasificacion();
                    return true;
                }
            $this->load_view('clara-index', $this->data);
            return true;
            $this->claara_index(false);
        }
        
        public function getCatalogoClasificacion(){
            // PARAMETROS PARA FILTRADO //
                $this->cla['orderBy'] = "cla1.sReferencia DESC , cla1.dFechaCreacion DESC , claMer1.sFactura ASC , claMer1.iSecuencia ASC";
                /*if(isset($_GET['p1'])){
                    $this->cla['skClasificacion'] = $_GET['p1'];
                }
                if(isset($_POST['sReferencia'])){
                    $this->cla['sReferencia'] = $_POST['sReferencia'];
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
                    $this->claMer['sFactura'] = $_POST['sFactura'];
                }
                if(isset($_POST['iSecuencia'])){
                    $this->claMer['iSecuencia'] = $_POST['iSecuencia'];
                }*/
                // EXPORTACIÓN A EXCEL //
                if(isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1){
                    $this->data['data'] = parent::catalogoClasificacion(true);
                    $this->claara_excel();
                    return true;
                    exit;
                }
                // OBTENER REGISTROS //
                $total = parent::catalogoClasificacion(false);
                $records = Core_Functions::table_ajax($total);
                if($records['recordsTotal'] === 0){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }

                $this->cla['limit'] = $records['limit'];
                $this->cla['offset'] = $records['offset'];
                $this->data['data'] = parent::catalogoClasificacion(true);

                if(!$this->data['data']){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }
                $i = 0;
                while($row = $this->data['data']->fetch_assoc()){
                    $actions = $this->printModulesButtons(2,array($row['skClasificacion1']));
                    $records['data'][$i] = array(
                        ''
                        ,utf8_encode($row['sReferencia1'])
                        
                        ,utf8_encode($row['sFraccion1'])
                        ,utf8_encode($row['sFraccion2'])
                        
                        ,utf8_encode($row['sNumeroParte1'])
                        ,utf8_encode($row['sNumeroParte2'])
                        
                        ,utf8_encode($row['sDescripcion1'])
                        ,utf8_encode($row['sDescripcion2'])
                        
                        ,utf8_encode($row['sDescripcionIngles1'])
                        ,utf8_encode($row['sDescripcionIngles2'])
                        
                        ,utf8_encode($row['ejecutivo1'])
                        ,utf8_encode($row['ejecutivo2'])
                        
                        ,utf8_encode($row['clasificador1'])
                        //,utf8_encode($row['clasificador2'])
                        ,utf8_encode($row['ejecutivo2']) // Clasificador 2da
                        
                        ,utf8_encode($row['sFactura1'])
                        ,utf8_encode($row['sFactura2'])
                        
                        ,utf8_encode($row['iSecuencia1'])
                        ,utf8_encode($row['iSecuencia2'])
                        
                        ,utf8_encode($row['dFechaPrevio1'])
                        ,utf8_encode($row['dFechaPrevio2'])
                        
                        ,utf8_encode($row['dFechaCreacion1'])
                        ,utf8_encode($row['dFechaCreacion2'])
                        
                        ,utf8_encode($row['dFechaModificacion1'])
                        ,utf8_encode($row['dFechaModificacion2'])
                    );
                    $i++;   
                }
                header('Content-Type: application/json');
                echo json_encode($records);
                return true;
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
                        $this->cla['orderBy'] = "cla.sReferencia DESC , cla.dFechaCreacion DESC , claMer.sFactura ASC , claMer.iSecuencia ASC";
                        $this->cla['year'] = $year;
                        //$this->cla['valido'] = 1;
                        
                        if(isset($_GET['p1'])){
                            $this->cla['skClasificacion'] = $_GET['p1'];
                        }
                        if(isset($_POST['sReferencia'])){
                            $this->cla['sReferencia'] = $_POST['sReferencia'];
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
                            $this->claMer['sFactura'] = $_POST['sFactura'];
                        }
                        if(isset($_POST['iSecuencia'])){
                            $this->claMer['iSecuencia'] = $_POST['iSecuencia'];
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
                                ''
                                /*,utf8_encode($row['sReferencia']) // REFERENCIA
                                ,utf8_encode($row['sPedimento']) // PEDIMENTO
                                ,utf8_encode($row['empresa']) // EMPRESA (CLIENTE)*/
                                
                                ,utf8_encode($row['sFactura']) // FACTURA
                                ,utf8_encode($row['sFraccion']) // FRACCIÓN
                                ,utf8_encode($row['sDescripcion']) // DESCRIPCIÓN
                                ,utf8_encode($row['sDescripcionIngles']) // DESCIPCIÓN INGLÉS
                                ,utf8_encode($row['sNumeroParte']) // NUMERO DE PARTE (MODELO)
                                ,utf8_encode($row['iSecuencia']) // NUMERO DE PARTE (MODELO)
                                
                                /*,utf8_encode($row['dFechaPrevio']) // FECHA PREVIO
                                ,utf8_encode($row['ejecutivo']) // skUsersCreacion
                                ,utf8_encode($row['clasificador']) // skUsersModificacion*/
                                
                                ,utf8_encode($row['htmlStatus']) // STATUS
                                
                                );
                                
                             $i++;   
                        }
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
                    $response = $this->import_excel($data[key($data)],$dFechaImportacion);
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
            if($_POST){
                //exit('<pre>'.print_r($_POST,1).'</pre>');
             	$this->cla['skClasificacion'] = !empty($_POST['skClasificacion']) ? $_POST['skClasificacion'] : substr(md5(microtime()), 1, 32);
                $this->cla['sReferencia'] = !empty($_POST['sReferencia']) ? utf8_decode($_POST['sReferencia']) : NULL ;
                $this->cla['sPedimento'] = !empty($_POST['sPedimento']) ? utf8_decode($_POST['sPedimento']) : NULL ;
                $this->cla['skEmpresa'] = !empty($_POST['skEmpresa']) ? utf8_decode($_POST['skEmpresa']) : NULL ;
                $this->cla['dFechaPrevio'] = !empty($_POST['dFechaPrevio']) ? utf8_decode($_POST['dFechaPrevio']) : NULL ;
                $this->cla['skStatus'] = !empty($_POST['skStatus']) ? utf8_decode($_POST['skStatus']) : 'IN' ;
                $this->cla['dFechaCreacion'] = 'CURRENT_TIMESTAMP';
                $this->cla['skUsersCreacion'] = $_SESSION['session']['skUsers'];
                $this->cla['dFechaImportacion'] = date('Y-m-d H:i:s');
                
                $this->claMer['dFechaImportacion'] = date('Y-m-d H:i:s');
                $this->claMer['sFactura'] = !empty($_POST['sFactura']) ? utf8_decode($_POST['sFactura']) : NULL ;
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
                $data = parent::read_filter_cla();
                if(!$data){
                    return false;
                }
                //exit('<pre>'.print_r($data,1).'</pre>');
                $i = 0;
                $records = array();
                while($row = $data->fetch_assoc()){
                    $records = array(
                         'skClasificacion' => $row['skClasificacion'] 
                        ,'skEmpresa' => $row['skEmpresa'] 
                        ,'sReferencia' => $row['sReferencia'] 
                        ,'sPedimento' => $row['sPedimento']
                        ,'dFechaPrevio' => $row['dFechaPrevio']
                        ,'skStatus' => $row['skStatus']
                        ,'dFechaCreacion' => $row['dFechaCreacion']
                        ,'skUsersCreacion' => $row['skUsersCreacion']
                        ,'ejecutivo' => $row['ejecutivo']
                        ,'dFechaModificacion' => $row['dFechaModificacion']
                        ,'skUsersModificacion' => $row['skUsersModificacion']
                        ,'clasificador' => $row['clasificador']
                        ,'dFechaImportacion' => $row['dFechaImportacion']
                    );
                    $this->claMer['skClasificacion'] = $row['skClasificacion'];
                    $this->claMer['skStatus'] = 'AC';
                    $claMer = parent::read_equal_claMer();
                    if($claMer){
                        while($rClaMer = $claMer->fetch_assoc()){
                            $records['mercancias'][$i] = array(
                                'skClasificacionMercancia'=>utf8_encode($rClaMer['skClasificacionMercancia']) // skClasificacionMercancia
                               ,'sFactura'=>utf8_encode($rClaMer['sFactura']) // FRACCIÓN
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
        
        public function claara_excel(){         
            if(!$this->data['data']){
                 header('Location: '.$_SERVER['HTTP_REFERER']); 
                return false;
            }
            require_once(CORE_PATH."assets/PHPExcel/Classes/PHPExcel/IOFactory.php");
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load(SYS_PATH."cla/files/claara/tplClasificacionMercanciasExport.xlsx");
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
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, utf8_encode($row['iSecuencia']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, utf8_encode($row['ejecutivo']));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, utf8_encode($row['clasificador']));
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
        
// ******************************************************************* // 
                // COMIENZA SEGUNDA CLASIFICACIÓN //
// ******************************************************************* // 
        
        public function segcla_index(){
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'delete':
                        $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                        $this->data['response'] = false;
                        $this->data['datos'] = false;
                        if(isset($_GET['p1'])){
                            $this->cla['skClasificacion'] = $_GET['p1'];
                            if($this->deleteClasificacionSegunda()){
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
                        $this->cla['orderBy'] = "cla.dFechaCreacion DESC";
                        
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
                        if(isset($_POST['skUsersCreacion'])){
                            $this->cla['skUsersCreacion'] = $_POST['skUsersCreacion'];
                        }
                        if(isset($_POST['skUsersModificacion'])){
                            $this->cla['skUsersModificacion'] = $_POST['skUsersModificacion'];
                        }
                        // EXPORTACIÓN A EXCEL //
                        if(isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1){
                            $this->cla['orderBy'] = "cla.sReferencia DESC , cla.dFechaCreacion DESC , claMer.sFactura ASC , claMer.iSecuencia ASC";
                            $this->data['data'] = parent::segcla_form_getMercancias();
                            $this->claara_excel();
                            return true;
                            exit;
                        }
                        // OBTENER REGISTROS //
                        $total = parent::segcla_index_getClasificacion(true);
                        $records = Core_Functions::table_ajax($total);
                        if($records['recordsTotal'] === 0){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }
                        
                        $this->cla['limit'] = $records['limit'];
                        $this->cla['offset'] = $records['offset'];
                        $this->data['data'] = parent::segcla_index_getClasificacion(false);
                        
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
                                !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                ,utf8_encode($row['sReferencia']) // REFERENCIA
                                ,utf8_encode($row['sPedimento']) // PEDIMENTO
                                ,utf8_encode($row['empresa']) // EMPRESA (CLIENTE)
                                ,utf8_encode($row['totalFracciones']) // total de fracciones
                                ,utf8_encode($row['ejecutivo']) // skUsersCreacion
                                ,utf8_encode($row['clasificador']) // skUsersModificacion
                                );
                                
                             $i++;   
                        }
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
            
            // LISTAR TODOS LOS USUARIOS
            $this->data['users'] = $cof->read_user();
            
            // INCLUYE EL MODELO DEL MODULO emp //
            $this->load_model('emp','emp');
            $emp = new Emp_Model();
            $this->data['empresas'] = $emp->read_equal_empresas();
            
            $this->load_view('segcla-index',$this->data);
        }
        public function segcla_form(){
            ini_set('memory_limit', '-1');
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            // OBTIENE LA CLASIFICACIÓN SI VIENE EL PARÁMETRO p1 (skClasificacion) //
                if(isset($_GET['p1'])){
                    $this->cla['skClasificacion'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_cla_referencias_pendientes();
                }
            // validarReferencia //
                if(isset($_POST['axn']) && $_POST['axn'] == 'validarReferencia'){
                    $datos = array(
                        'sReferencia'=>(isset($_POST['sReferencia'])? $_POST['sReferencia'] : '')
                    );
                    if($this->validarReferencia($datos)){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                    return true;
                }
            // obtenerDatos //
                if(isset($_POST['axn']) && $_POST['axn'] == 'obtenerDatos'){
                    $this->load_controller('doc','obtenerDatos');
                    return true;
                }
            // OBTENER CLASIFICACIÓN DE MERCANCIAS //
                if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                    if(isset($_GET['p1']) || isset($_POST['sReferencia'])){
                        $this->segcla_form_getMercancias();
                    }else{
                        $records = array("data"=>array(),"draw"=>1,"recordsTotal"=>0,"recordsFiltered"=>0);
                        header('Content-Type: application/json');
                        echo json_encode($records);
                        return true;
                    }
                    return true;
                }
            // GUARDAR SEGUNDA CLASIFICACIÓN //
                if(isset($_POST['axn']) && $_POST['axn'] == 'insert'){
                    if(!empty($_POST['clasificacionSegundaMercancia'])){
                        $this->cla['skClasificacion'] = $_POST['skClasificacion'];
                        $data = json_decode($_POST['clasificacionSegundaMercancia'],1);
                        //exit('<pre>'.print_r($data[key($data)][0],1).'</pre>');
                        if(isset($data[key($data)][0]['REFERENCIA']) && $data[key($data)][0]['REFERENCIA'] == $_POST['sReferencia']){
                            $this->cla['skClasificacion'] = $_POST['skClasificacion'];
                            $deleteClasificacionSegunda = $this->deleteClasificacionSegunda();
                            if(!$deleteClasificacionSegunda){
                                $this->data['response'] = false;
                                $this->data['message'] = 'Hubo un error al registrar la segunda clasificación.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
                            }
                            $insertarClasificacionSegunda = $this->insertarClasificacionSegunda();
                            if(!$insertarClasificacionSegunda){
                                $this->data['response'] = false;
                                $this->data['message'] = 'Hubo un error al registrar la segunda clasificación.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
                            }
                            $dFechaImportacion = date('Y-m-d H:i:s');
                            $response = $this->import_excel_clasificacionSegunda($data[key($data)],$dFechaImportacion,1);
                            if(!$response['response']){
                                $this->data['response'] = false;
                                $this->data['message'] = 'Hubo un error al registrar la segunda clasificación.';
                                header('Content-Type: application/json');
                                echo json_encode($this->data);
                                return false;
                            }
                        }else{
                            $this->data['response'] = false;
                            $this->data['message'] = 'La referencia ingresada no coincide con el documento: '.$_POST['sReferencia'];
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;
                        }
                    }else{
                        $this->cla['skClasificacion'] = $_POST['skClasificacion'];
                        $deleteClasificacionSegunda = $this->deleteClasificacionSegunda();
                        if(!$deleteClasificacionSegunda){
                            $this->data['response'] = false;
                            $this->data['message'] = 'Hubo un error al registrar la segunda clasificación.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;
                        }
                        $insertarClasificacionSegunda = $this->insertarClasificacionSegunda();
                        if(!$insertarClasificacionSegunda){
                            $this->data['response'] = false;
                            $this->data['message'] = 'Hubo un error al registrar la segunda clasificación.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;
                        }
                        $insertarClasificacionSegundaMercancias = $this->insertarClasificacionSegundaMercancias();
                        if(!$insertarClasificacionSegundaMercancias){
                            $this->data['response'] = false;
                            $this->data['message'] = 'Hubo un error al registrar la segunda clasificación.';
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return false;
                        }
                    }
                    $this->data['message'] = 'Segunda clasificación guardada con exito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);
                    return true;
                }
            $this->load_view('segcla-form',$this->data);
        }
        
            public function segcla_form_getMercancias(){
                // PARAMETROS PARA FILTRADO //
                $this->cla['orderBy'] = "cla.sReferencia DESC , cla.dFechaCreacion DESC , claMer.sFactura ASC , claMer.iSecuencia ASC";
                
                //$this->cla['valido'] = 1;

                if(isset($_GET['p1'])){
                    $this->cla['skClasificacion'] = $_GET['p1'];
                }
                if(isset($_POST['sReferencia'])){
                    $this->cla['sReferencia'] = $_POST['sReferencia'];
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
                    $this->claMer['sFactura'] = $_POST['sFactura'];
                }
                if(isset($_POST['iSecuencia'])){
                    $this->claMer['iSecuencia'] = $_POST['iSecuencia'];
                }
                // EXPORTACIÓN A EXCEL //
                if(isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1){
                    $this->data['data'] = parent::segcla_form_getMercancias();
                    $this->claara_excel();
                    return true;
                    exit;
                }
                // OBTENER REGISTROS //
                $total = parent::segcla_form_count();
                $records = Core_Functions::table_ajax($total);
                if($records['recordsTotal'] === 0){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }

                $this->cla['limit'] = $records['limit'];
                $this->cla['offset'] = $records['offset'];
                $this->data['data'] = parent::segcla_form_getMercancias();

                if(!$this->data['data']){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }
                $i = 0;
                while($row = $this->data['data']->fetch_assoc()){
                    $actions = $this->printModulesButtons(2,array($row['skClasificacion']));
                    $records['data'][$i] = array(
                        ''
                        ,utf8_encode($row['sFactura']) // FACTURA
                        ,utf8_encode($row['sFraccion']) // FRACCIÓN
                        ,utf8_encode($row['sDescripcion']) // DESCRIPCIÓN
                        ,utf8_encode($row['sDescripcionIngles']) // DESCIPCIÓN INGLÉS
                        ,utf8_encode($row['sNumeroParte']) // NUMERO DE PARTE (MODELO)
                        ,utf8_encode($row['iSecuencia']) // NUMERO DE PARTE (MODELO)
                    );
                    $i++;   
                }
                header('Content-Type: application/json');
                echo json_encode($records);
                return true;
            }
            
            public function import_excel_clasificacionSegunda(&$data , &$dFechaImportacion, $validar = 1){
            ini_set('memory_limit', '-1');
            $skClasificacion = NULL;
            $this->cla['valido'] = $validar;
            $this->cla['dFechaImportacion'] = $dFechaImportacion;
            $this->claMer['dFechaImportacion'] = $dFechaImportacion;
            $this->cla['skStatus'] = 'AC';
            $this->claMer['skStatus'] = 'AC';
            
            $dFechaCreacion = date('Y-m-d H:i:s');
            $this->cla['skUsersCreacion'] = $_SESSION['session']['skUsers'];
            $this->cla['dFechaCreacion'] = $dFechaCreacion;
            $this->claMer['skUsersCreacion'] = $_SESSION['session']['skUsers'];
            $this->claMer['dFechaCreacion'] = $dFechaCreacion;
            
            if(!count($data)){
                return false;
            }
            $flag = true;
            $message = false;
            $lineaExcel = 2;
            $factura = "";
            $consecutivo = 0;
            $array_consecutivos = array();
            foreach($data AS $k => $v){
                // VERIFICACMOS QUE VENGA REFERENCIA Y PEDIMENTO //
                    if(empty($v['REFERENCIA']) && $lineaExcel==2){
                        $flag = false;
                        $message = "No se especificó la referencia en la Columna A2 del template.";
                        break;
                    }
                    
                if(!isset($v['F DE PREVIO'])){
                    $v['F DE PREVIO'] = NULL;
                }
                $this->cla['dFechaPrevio'] = addslashes(trim(utf8_decode($v['F DE PREVIO'])," "));
                $this->cla['dFechaPrevio'] =  '';
                if(!isset($v['FACTURA'])){
                    $v['FACTURA'] = "";
                }
                $this->claMer['sFactura'] = addslashes(trim(utf8_decode($v['FACTURA'])," "));
                // INICIA EL CONTADOR DEL CONSECUTIVO POR FACTURA //
                if(array_key_exists($this->claMer['sFactura'] , $array_consecutivos)){
                    $consecutivo++;
                    $array_consecutivos[$this->claMer['sFactura']] += 1;
                }else{
                  $consecutivo = 1;
                  $array_consecutivos[$this->claMer['sFactura']] = 1;
                }
                // SE CREA LA PRIMERA CLASIFICACION //
                    if($validar == 1 && $lineaExcel==2){
                        // SE BUSCA LA REFERENCIA PARA SU VALIDACION //
                        $this->cla['sReferencia'] = addslashes(trim(utf8_decode($v['REFERENCIA'])," "));
                        $result = parent::get_cla();
                        if(!$result){
                            $flag = false;
                            $message = "No se encontró la referencia: ".$this->cla['sReferencia']." para validar.";
                            break;
                        }
                        $rCla = $result->fetch_assoc();
                        $this->deleteClasificacionSegunda();
                        $this->cla['skClasificacion'] = $rCla['skClasificacion'];
                        $this->cla['skUsersCreacion'] = $rCla['skUsersCreacion'];
                        $this->cla['dFechaCreacion'] = $rCla['dFechaCreacion'];
                        $this->claMer['skUsersCreacion'] = $rCla['skUsersCreacion'];
                        $this->claMer['dFechaCreacion'] = $rCla['dFechaCreacion'];
                        $skClasificacion = $this->create_claSeg();
                        if(!$skClasificacion){ 
                            $flag = false;
                            $message = "Hubo un error al al intentar validar la referencia: ".$this->cla['sReferencia'];
                            break;
                        }
                    }
                // AGREGAMOS LAS FRACCIONES //
                        $this->claMer['skClasificacionMercancia'] = substr(md5(microtime()), 1, 32);
                        $this->claMer['skClasificacion'] = $skClasificacion;
                        
                        if(!isset($v['FRACCION'])){
                            $v['FRACCION'] = "";
                        }
                        $this->claMer['sFraccion'] = addslashes(trim(utf8_decode($v['FRACCION'])," "));
     
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
                        $this->claMer['sNumeroParte'] = addslashes(trim(utf8_decode($v['MODELO'])," "));
                        
                        if(!isset($v['CONSECUTIVO'])){
                            $v['CONSECUTIVO'] = "";
                        }
                        $this->claMer['iSecuencia'] = $array_consecutivos[$this->claMer['sFactura']];
                             
                        $skClasificacionMercancia = $this->create_claSegMer();
                        if(!$skClasificacionMercancia){ 
                            $flag = false;
                            $message = "Hubo un error al registar la fraccion ".$this->claMer['sFraccion']." con numero de parte: ".$this->claMer['sNumeroParte']." en la referencia: ".$this->cla['sReferencia'];
                            $this->deleteClasificacionSegunda();
                            break;
                        }
                
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
        // TEMRINA SEGUNDA CLASIFICACIÓN //
    }
?>

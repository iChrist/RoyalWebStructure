<?php
    require_once(SYS_PATH."pro/model/pro.model.php");
    Class Pro_Controller Extends Pro_Model {

            // PRIVATE VARIABLES //
                private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
				/*COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */
 
            public function pro_index(){
                if(isset($_GET['axn'])){
                    switch ($_GET['axn']) {
                        case 'pdf':
                            $this->pro_pdf();
                            break;
                        case 'delete':
                            $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                            $this->data['response'] = false;
                            $this->data['datos'] = false;
                            if(isset($_GET['p1'])){
                                $this->pro['skProforma'] = $_GET['p1'];
                                if($this->delete_pro()){
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
                            if(!empty($_POST['skProforma'])){
                                $this->pro['skProforma'] = $_POST['skProforma'];
                            }
                            if(!empty($_POST['sReferencia'])){
                                $this->pro['sReferencia'] = addslashes(utf8_decode($_POST['sReferencia']));
                            }
                            if(!empty($_POST['sObservaciones'])){
                                $this->pro['sObservaciones'] = addslashes(utf8_decode($_POST['sObservaciones']));
                            }
                            if(!empty($_POST['skUserCreacion'])){
                                $this->pro['skUserCreacion'] = $_POST['skUserCreacion'];
                            }
                            if(!empty($_POST['dFechaCreacion'])){
                                $this->pro['dFechaCreacion'] = date('Y-m-d',  strtotime($_POST['dFechaCreacion']));
                            }

                            if(!empty($_POST['skEmpresa'])){
                                $this->pro['skEmpresa'] = $_POST['skEmpresa'];
                            }

                            $this->pro['skStatus'] = 'AC';
                            //exit('<pre>'.print_r($this->pro,1).'</pre>');
                            // OBTENER REGISTROS //
                            $total = parent::count_pro();
                            $records = Core_Functions::table_ajax($total);
                            if($records['recordsTotal'] === 0){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            $this->pro['limit'] = $records['limit'];
                            $this->pro['offset'] = $records['offset'];
                            $this->data['data'] = parent::read_pro();
                            if(!$this->data['data']){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            while($row = $this->data['data']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skProforma']),$row['skUserCreacion']);
                                array_push($records['data'], array(
                                    !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                    ,utf8_encode($row['sReferencia'])
                                    ,utf8_encode($row['cliente'])
                                    ,utf8_encode($row['sObservaciones'])
                                    ,utf8_encode($row['autor'])
                                    ,utf8_encode($row['dFechaCreacion'])
                                   
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
                $cof->users['status'] = $cof->read_status();
                
                $this->data['users'] = $cof->read_user();

                $this->load_model('emp','emp');
                $objEmpresa = new Emp_Model();
                $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
                $this->data['clientes'] = $objEmpresa->read_like_empresas();
                

                // RETORNA LA VISTA pro-index.php //
                $this->load_view('pro-index', $this->data);
                return true;
            }
            
            public function pro_form(){ 
                $this->data['message'] = '';
                $this->data['response'] = true;
                $this->data['datos'] = false;
                if($_POST){
                    $_POST['axn'] = !empty($_POST['axn']) ? $_POST['axn'] : 'save';
                    switch ($_POST['axn']){
                        case "validarReferencia":
                            $this->solreva['sReferencia'] = $_POST['sReferencia'];
                            $this->data['data']=parent::read_referencia();
                            if(!$this->data['data']){
                                echo 'false';
                                return false;
                            }
                            echo 'true';
                            return true;
                            break;
                        case "obtenerDatos":
                            /*$this->solreva['sReferencia'] = $_POST['sReferencia'];
                            $this->data['data']=parent::read_referencia();
                            if(!$this->data['data']){
                                $this->data['response'] = false;
                                $this->data['datos'] = false;
                                return false;
                            }
                            $result['data'] = array();
                            while($row = $this->data['data']->fetch_assoc()){
                               $result['data']= array(
                                     "Empresa"=>utf8_encode($row['Empresa'])
                                    ,"skEmpresa"=>utf8_encode($row['skEmpresa'])
                                    ,"TipoServicio"=>utf8_encode($row['TipoServicio'])
                                    ,"Ejecutivo"=>utf8_encode($row['Ejecutivo'])
                                    ,"sMercancia"=>utf8_encode($row['sMercancia'])
                                    ,"sNumContenedor"=>utf8_encode($row['sNumContenedor'])
                                    ,"iBultos"=>utf8_encode($row['iBultos'])
                                    ,"fPeso"=>utf8_encode($row['fPeso'])
                                    ,"fVolumen"=>utf8_encode($row['fVolumen'])
                                    ,"sBlMaster"=>utf8_encode($row['sBlMaster'])
                                    ,"sBlHouse"=>utf8_encode($row['sBlHouse'])
                                );
                            }
                            header('Content-Type: application/json');
                            echo json_encode($result);*/
                            $this->load_controller('doc','obtenerDatos');
                            return true;
                            break;
                        case "save":
                            $this->pro['skProforma'] = !empty($_POST['skProforma']) ? $_POST['skProforma'] : substr(md5(microtime()), 1, 32);
                            $this->pro['sReferencia'] = !empty($_POST['sReferencia']) ? addslashes(utf8_decode($_POST['sReferencia'])) : null;
                            $this->pro['sObservaciones'] = !empty($_POST['sObservaciones']) ? addslashes(utf8_decode($_POST['sObservaciones'])) : null;
                            // DEFAULT //
                            $this->data['message'] = 'Registro guardado con &eacute;xito.';
                            if(empty($_POST['skProforma'])){
                                // CREATE //
                                if(!parent::create_pro()){
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                }
                            }else{
                                // UPDATE //
                                if(!parent::update_pro()){
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                }
                            }
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return true;
                            break;
                    }
                }
                if(isset($_GET['p1'])){
                    $this->pro['skProforma'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_pro();
                }
                $this->load_view('pro-form', $this->data);
                return true;
            }
            
            private function pro_pdf(){
                if(isset($_GET['p1'])){
                    $this->pro['skProforma'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_pro();
                }
                ob_start();
                $this->load_view('pro-pdf', $this->data, FALSE, 'pro/pdf/');
                $content = ob_get_clean();
                $title = 'DATOS DE PROFORMA';
                Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                return true;
            }
					
                                    
	}
?>

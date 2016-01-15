<?php
    require_once(SYS_PATH."fac/model/fac.model.php");
    Class Fac_Controller Extends Fac_Model {

            // PRIVATE VARIABLES //
                private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
				/*COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */
 
            public function facdat_index(){
                if(isset($_GET['axn'])){
                    switch ($_GET['axn']) {
                        case 'pdf':
                            $this->facdat_pdf();
                            break;
                        case 'delete':
                            $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                            $this->data['response'] = false;
                            $this->data['datos'] = false;
                            if(isset($_GET['p1'])){
                                $this->facdat['skFacturacion'] = $_GET['p1'];
                                if($this->delete_facdat()){
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
                            if(!empty($_POST['skFacturacion'])){
                                $this->facdat['skFacturacion'] = $_POST['skFacturacion'];
                            }
                            if(!empty($_POST['sReferencia'])){
                                $this->facdat['sReferencia'] = $_POST['sReferencia'];
                            }
                            if(!empty($_POST['dFechaFacturacion'])){
                                $this->facdat['dFechaFacturacion'] = date('Y-m-d',  strtotime($_POST['dFechaFacturacion']));
                            }
                            if(!empty($_POST['sFolio'])){
                                $this->facdat['sFolio'] = $_POST['sFolio'];
                            }
                            if(!empty($_POST['fImporte'])){
                                $this->facdat['fImporte'] = $_POST['fImporte'];
                            }
                            if(!empty($_POST['fIva'])){
                                $this->facdat['fIva'] = $_POST['fIva'];
                            }
                            if(!empty($_POST['fTotalFacturado'])){
                                $this->facdat['fTotalFacturado'] = $_POST['fTotalFacturado'];
                            }
                            if(!empty($_POST['fGanancia'])){
                                $this->facdat['fGanancia'] = $_POST['fGanancia'];
                            }
                            if(!empty($_POST['fAA'])){
                                $this->facdat['fAA'] = $_POST['fAA'];
                            }
                            if(!empty($_POST['fPromotor1'])){
                                $this->facdat['fPromotor1'] = $_POST['fPromotor1'];
                            }
                            if(!empty($_POST['fPromotor2'])){
                                $this->facdat['fPromotor2'] = $_POST['fPromotor2'];
                            }
                            if(!empty($_POST['skUserCreacion'])){
                                $this->facdat['skUserCreacion'] = $_POST['skUserCreacion'];
                            }
                            if(!empty($_POST['dFechaCreacion'])){
                                $this->facdat['dFechaCreacion'] = date('Y-m-d',  strtotime($_POST['dFechaCreacion']));
                            }
                            exit('<pre>'.print_r($this->facdat,1).'</pre>');
                            // OBTENER REGISTROS //
                            $total = parent::count_facdat();
                            $records = Core_Functions::table_ajax($total);
                            if($records['recordsTotal'] === 0){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            $this->facdat['limit'] = $records['limit'];
                            $this->facdat['offset'] = $records['offset'];
                            $this->data['data'] = parent::read_facdat();
                            if(!$this->data['data']){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            while($row = $this->data['data']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skFacturacion']),$row['skUserCreacion']);
                                array_push($records['data'], array(
                                     utf8_encode($row['sReferencia'])
                                    ,utf8_encode($row['dFechaFacturacion'])
                                    ,utf8_encode($row['sFolio'])
                                    ,utf8_encode($row['fImporte'])
                                    ,utf8_encode($row['fIva'])
                                    ,utf8_encode($row['fTotalFacturado'])
                                    ,utf8_encode($row['fGanancia'])
                                    ,utf8_encode($row['fAA'])
                                    ,utf8_encode($row['fPromotor1'])
                                    ,utf8_encode($row['fPromotor2'])
                                    ,utf8_encode($row['skUserCreacion'])
                                    ,utf8_encode($row['dFechaCreacion'])
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

                // INCLUYE UN MODELO DE OTRO MODULO //
                $this->load_model('cof','cof');
                $cof = new Cof_Model();
                $this->data['status'] = $cof->read_status();

                $this->load_model('emp','emp');
                $objEmpresa = new Emp_Model();
                $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
                $this->data['clientes'] = $objEmpresa->read_like_empresas();

                // RETORNA LA VISTA facdat-index.php //
                $this->load_view('facdat-index', $this->data);
                return true;
            }
            
            public function facdat_form(){ 
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
                            $this->facdat['skFacturacion'] = !empty($_POST['skFacturacion']) ? $_POST['skFacturacion'] : substr(md5(microtime()), 1, 32);
                            $this->facdat['sReferencia'] = !empty($_POST['sReferencia']) ? $_POST['sReferencia'] : null;
                            $this->facdat['dFechaFacturacion'] = !empty($_POST['dFechaFacturacion']) ? date('Y-m-d',  strtotime($_POST['dFechaFacturacion'])) : null;
                            $this->facdat['sFolio'] = !empty($_POST['sFolio']) ? $_POST['sFolio'] : null;
                            $this->facdat['fImporte'] = !empty($_POST['fImporte']) ? $_POST['fImporte'] : 0;
                            $this->facdat['fIva'] = !empty($_POST['fIva']) ? $_POST['fIva'] : 0;
                            $this->facdat['fTotalFacturado'] = !empty($_POST['fTotalFacturado']) ? $_POST['fTotalFacturado'] : 0;
                            $this->facdat['fGanancia'] = !empty($_POST['fGanancia']) ? $_POST['fGanancia'] : 0;
                            $this->facdat['fAA'] = !empty($_POST['fAA']) ? $_POST['fAA'] : 0;
                            $this->facdat['fPromotor1'] = !empty($_POST['fPromotor1']) ? $_POST['fPromotor1'] : 0;
                            $this->facdat['fPromotor2'] = !empty($_POST['fPromotor2']) ? $_POST['fPromotor2'] : 0;
                            // DEFAULT //
                            $this->data['message'] = 'Registro guardado con &eacute;xito.';
                            if(empty($_POST['skFacturacion'])){
                                // CREATE //
                                if(!parent::create_facdat()){
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                }
                            }else{
                                // UPDATE //
                                if(!parent::update_facdat()){
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
                    $this->facdat['skFacturacion'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_facdat();
                }
                $this->load_view('facdat-form', $this->data);
                return true;
            }
            
            private function facdat_pdf(){
                if(isset($_GET['p1'])){
                    $this->facdat['skFacturacion'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_facdat();
                }
                ob_start();
                $this->load_view('facdat-pdf', $this->data, FALSE, 'facdat/pdf/');
                $content = ob_get_clean();
                $title = 'DATOS DE FACTURACI&Oacute;N';
                Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                return true;
            }
					
                                    
	}
?>

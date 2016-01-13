<?php
    require_once(SYS_PATH."rev/model/rev.model.php");
    Class Fac_Controller Extends Fac_Model {

            // PRIVATE VARIABLES //
                private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
				/*COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */
 
            public function solreva_index(){
                if(isset($_GET['axn'])){
                    switch ($_GET['axn']) {
                        case 'pdf':
                            $this->solicitudrevalidacion_pdf();
                            break;
                        case 'delete':
                            $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                            $this->data['response'] = false;
                            $this->data['datos'] = false;
                            if(isset($_GET['p1'])){
                                $this->solreva['skSolicitudRevalidacion'] = $_GET['p1'];
                                if($this->delete_solreva()){
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
                            if(isset($_POST['skSolicitudRevalidacion'])){
                                    $this->solreva['skSolicitudRevalidacion'] = $_POST['skSolicitudRevalidacion'];
                            }
                            if(isset($_POST['sReferencia'])){
                                    $this->solreva['sReferencia'] = $_POST['sReferencia'];
                            }
                            // FILTRO POR FECHAS
                            $this->solreva['filtroFechas'] = !empty($_POST['filtroFechas']) ? $_POST['filtroFechas'] : 'Solicitud';

                            if(!empty($_POST['dFechaInicio'])){
                                $this->solreva['dFechaInicio'] = $_POST['dFechaInicio'];
                            }
                            if(!empty($_POST['dFechaFin'])){
                                $this->solreva['dFechaFin'] = $_POST['dFechaFin'];
                            }
                            // CLIENTE //
                            if(isset($_POST['skEmpresa'])){
                                $this->solreva['skEmpresa'] = $_POST['skEmpresa'];
                            }
                            //exit('<pre>'.print_r($this->solreva,1).'</pre>');
                            // OBTENER REGISTROS //
                            $total = parent::count_solreva();
                            $records = Core_Functions::table_ajax($total);
                            if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                            }
                            $this->solreva['limit'] = $records['limit'];
                            $this->solreva['offset'] = $records['offset'];
                            $this->data['data'] = parent::read_solreva();

                            if(!$this->data['data']){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            while($row = $this->data['data']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skSolicitudRevalidacion']));
                                array_push($records['data'], array(
                                         utf8_encode($row['Icono'])
                                        ,utf8_encode($row['sReferencia'])
                                        ,utf8_encode($row['UsuarioEjecutivo'])
                                        ,utf8_encode($row['Cliente'])
                                        ,utf8_encode($row['EmpresaNaviera'])
                                        ,utf8_encode($row['Tramitador'])
                                        ,utf8_encode($row['sObservaciones'])
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

                $this->load_model('emp','emp');
                $objEmpresa = new Emp_Model();
                $objEmpresa->tipoempresas['skTipoEmpresa'] = 'LINA';
                $this->data['empresas'] = $objEmpresa->read_like_empresas();
                $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
                $this->data['clientes'] = $objEmpresa->read_like_empresas();
                $this->load_model('cof','cof');
                $objUsuarios = new Cof_Model();
                $this->data['tramitadores'] = $objUsuarios->read_user();
                $this->load_model('cof','cof');
                $objEjecutivo = new Cof_Model();
                $this->data['ejecutivo'] = $objEjecutivo->read_user();
                $this->data['estatus'] = parent::read_estatus();

                // RETORNA LA VISTA areas-index.php //
                $this->load_view('solreva-index', $this->data);
                return true;
            }
            
            public function solreva_form(){ 
                $this->data['message'] = '';
                $this->data['response'] = true;
                $this->data['datos'] = false;
                if($_POST){
                    switch ($_POST['axn']){           
                        case "obtenerDatos":
		            return true;
                            break;
                        case "create":
                            break;
                    }
                }
                if(isset($_GET['p1'])){
                    $this->solreva['skSolicitudRevalidacion'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_solreva();
                    $this->data['rechazosSolicitud'] = parent::read_solreva_rechazos();
                }
                $this->load_view('solreva-form', $this->data);
                return true;
            }
            
            private function solicitudrevalidacion_pdf(){
                if(isset($_GET['p1'])){
                    $this->solreva['skSolicitudRevalidacion'] = $_GET['p1'];
                }
                ob_start();
                $this->load_view('solreva-pdf', $this->data, FALSE, 'rev/pdf/');
                $content = ob_get_clean();
                $title = 'Solicitud de revaldaci&oacute;n';
                Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                return true;
            }
					
                                    
	}
?>

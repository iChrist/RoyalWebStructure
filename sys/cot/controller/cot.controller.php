<?php
    require_once(SYS_PATH."cot/model/cot.model.php");
    Class Cot_Controller Extends Cot_Model {

            // PRIVATE VARIABLES //
                private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
				/*COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */

        public function cot_index(){
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'pdf':
                        $this->cot_pdf();
                        break;
                    case 'fetch_all':
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['skCotizacion'])){
                            $this->cotizaciones['skCotizacion'] = $_POST['skCotizacion'];
                        }
                        if(isset($_POST['skReferencia'])){
                            $this->cotizaciones['skReferencia'] = $_POST['skReferencia'];
                        }
                        if(isset($_POST['sPedimento'])){
                            $this->cotizaciones['sPedimento'] = $_POST['sPedimento'];
                        }
                        if(isset($_POST['skTipoServicio'])){
                            $this->cotizaciones['skTipoServicio'] = $_POST['skTipoServicio'];
                        }
                        if(isset($_POST['skTipoCobroCotizacion'])){
                            $this->cotizaciones['skTipoCobroCotizacion'] = $_POST['skTipoCobroCotizacion'];
                        }
                        if(isset($_POST['skTipoTramite'])){
                            $this->cotizaciones['skTipoTramite'] = $_POST['skTipoTramite'];
                        }
                        if(isset($_POST['skEmpresaImportador'])){
                            $this->cotizaciones['skEmpresaImportador'] = $_POST['skEmpresaImportador'];
                        }
                        if(isset($_POST['skEmpresaRecinto'])){
                            $this->cotizaciones['skEmpresaRecinto'] = $_POST['skEmpresaRecinto'];
                        }
                        if(isset($_POST['skEmpresaNaviera'])){
                            $this->cotizaciones['skEmpresaNaviera'] = $_POST['skEmpresaNaviera'];
                        }
                        if(isset($_POST['skEstatus'])){
                            $this->cotizaciones['skEstatus'] = $_POST['skEstatus'];
                        }
                        if(isset($_POST['dFechaCreacion'])){
                            $this->cotizaciones['dFechaCreacion'] = $_POST['dFechaCreacion'];
                        }
                        if(isset($_POST['skUsuario'])){
                            $this->cotizaciones['skUsuario'] = $_POST['skUsuario'];
                        }



                        // OBTENER REGISTROS //
                        $total = parent::count_cotizaciones();
                        $records = Core_Functions::table_ajax($total);
                        if($records['recordsTotal'] === 0){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }

                        $this->cotizacion['limit'] = $records['limit'];
                        $this->cotizacion['offset'] = $records['offset'];
                        $this->data['data'] = parent::read_like_cotizaciones();

                        if(!$this->data['data']){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }

                        while($row = $this->data['data']->fetch_assoc()){
                            $actions = $this->printModulesButtons(2,array($row['skCotizacion']));
                            array_push($records['data'], array(
                                !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                ,utf8_encode($row['skReferencia'])
                                ,utf8_encode($row['sPedimento'])
                                ,utf8_encode($row['EmpresaImportador'])
                                ,utf8_encode($row['EmpresaRecinto'])
                                ,utf8_encode($row['EmpresaNaviera'])
                                ,utf8_encode($row['TipoServicio'])
                                ,utf8_encode($row['TipoCobro'])
                                ,utf8_encode($row['TipoTramite'])
                                ,utf8_encode($row['TipoTranporte'])
                                ,utf8_encode($row['htmlStatus'])

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

            // RETORNA LA VISTA cot-index.php //
            $this->load_view('cot-index', $this->data);
            return true;
        }

            public function cot_form(){
                $this->data['message'] = '';
                $this->data['response'] = true;
                $this->data['datos'] = false;
                if($_POST){
                    $_POST['axn'] = !empty($_POST['axn']) ? $_POST['axn'] : 'save';
                    switch ($_POST['axn']){
                        case "validarReferencia":
                            $this->cotizaciones['sReferencia'] = $_POST['sReferencia'];
                            $this->data['data']=parent::read_referencia();
                            if(!$this->data['data']){
                                echo 'false';
                                return false;
                            }
                            echo 'true';
                            return true;
                            break;
                        case "obtenerDatos":
                            $this->cotizaciones['sReferencia'] = $_POST['sReferencia'];
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
                            echo json_encode($result);
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
                    $this->cotizacion['skCotizacion'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_pro();
                }
                $this->load_view('cot-form', $this->data);
                return true;
            }

            private function cot_pdf(){
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
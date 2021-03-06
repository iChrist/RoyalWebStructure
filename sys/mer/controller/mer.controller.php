<?php
    require_once(SYS_PATH.$_GET['sysModule'].'/model/'.$_GET['sysModule'].'.model.php');
    Class Mer_Controller Extends Mer_Model {
        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
                parent::__construct();
        }

        public function __destruct(){

        }

        /* COMIENZA MODULO clasifiación arancelaria */
        public function climer_index(){
            //exit('<pre>'.print_r($_GET,1).'</pre>');
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'pdf':
                        $this->claara_pdf();
                        break;
                    case 'fetch_all':
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sNombre'])){
                            $this->numPar['sNombre'] = $_POST['sNombre'];
                        }
                        if(isset($_POST['sDecripcion'])){
                            $this->numPar['sDecripcion'] = $_POST['sDecripcion'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->numPar['skStatus'] = $_POST['skStatus'];
                        }

                        // OBTENER REGISTROS //
                        $total = parent::count_numerosParte();
                        $records = Core_Functions::table_ajax($total);
                        if($records['recordsTotal'] === 0){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }

                        $this->numPar['limit'] = $records['limit'];
                        $this->numPar['offset'] = $records['offset'];
                        $this->data['data'] = parent::read_like_numerosParte();

                        if(!$this->data['data']){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }

                        while($row = $this->data['data']->fetch_assoc()){
                            $actions = $this->printModulesButtons(2,array($row['skNumeroParte']));
                            array_push($records['data'], array(
                                 utf8_encode($row['sNombre'])
                                ,utf8_encode($row['sDecripcion'])
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
            
            // RETORNA LA VISTA >numPar-index.php //
            $this->load_view('climer-index', $this->data);
            return true;
        }

        public function climer_form(){
            //if($_POST){ exit('<pre>'.print_r($_POST,1).'</pre>'); }
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            $this->load_model('emp','emp');
            $objEmpresa = new Emp_Model();
            $this->data['empresas'] = $objEmpresa->read_empresa();
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case "listarMercancias":
                        if(isset($_POST['sNombre'])){
                            $this->numPar['sNombre'] = $_POST['sNombre'];
                        }
                        $this->data['data'] = parent::read_like_numerosParte();
                        $records = array();
                        while($row = $this->data['data']->fetch_assoc()){
                            array_push($records, array(
                                 'id' => utf8_encode($row['skNumeroParte']) 
                                ,'sNombre' => utf8_encode($row['sNombre'])
                                ,'sDescripcion' => utf8_encode($row['sDescripcion'])
                            ));
                        }
                        echo json_encode($records);
                        return true;
                    break;
                }
                return true;
            }
            if($_POST){
                $this->empMer['skEmpresaMercancia'] = !empty($_POST['skEmpresaMercancia']) ? $_POST['skEmpresaMercancia'] : substr(md5(microtime()), 1, 32);
                $this->empMer['skEmpresa'] = utf8_decode($_POST['skEmpresa']);
                $this->empMer['sReferencia'] = utf8_decode($_POST['sReferencia']);
                $this->empMer['sPedimento'] = utf8_decode($_POST['sPedimento']);
                $this->empMer['sFactura'] = utf8_decode($_POST['sFactura']);
                $this->empMer['dFechaPrevio'] = date("Y-m-d", strtotime($_POST['dFechaPrevio']));
                $this->empMer['skStatus'] = utf8_decode($_POST['skStatus']);
                if(empty($_POST['skEmpresaMercancia'])){
                    if(parent::create_empMer()){
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
                    if(parent::update_empMer()){
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
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $this->data['datos'] = parent::read_equal_numPar();
            }
            $this->load_view('climer-form', $this->data);
            return true;
        }

        public function claara_detail(){
            if(isset($_GET['p1'])){
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $this->data['datos'] = parent::read_equal_numPar();
            }
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'pdf':
                        $this->claara_pdf();
                        break;
                }
            }
            $this->load_view('numPar-detail', $this->data);
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

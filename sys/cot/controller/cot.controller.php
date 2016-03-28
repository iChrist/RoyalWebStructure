<?php
    require_once(SYS_PATH."coti/model/coti.model.php");
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
                        default:
                            break;
                    }
                    return true;
                }

                // RETORNA LA VISTA pro-index.php //
                $this->load_view('coti-index', $this->data);
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
                            $this->solreva['sReferencia'] = $_POST['sReferencia'];
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
                    $this->pro['skProforma'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_pro();
                }
                $this->load_view('coti-form', $this->data);
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

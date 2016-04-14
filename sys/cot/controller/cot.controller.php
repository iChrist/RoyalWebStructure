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
        public function tipo_cambio(){
            $client = new SoapClient(null, array(
                'location' =>'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL',
                'uri'=>'http://DgieWSWeb/DgieWS?WSDL',
                'encoding'=> 'UTF-8'
            ));

            try {

                $result = $client->tiposDeCambioBanxico();

            } catch (SoapFault $ex) {

                return $this->error($ex->getMessage());

            }

            if( !$result) {

                return false;

            }

            $dom = new DomDocument();
            $dom->loadXML($result);

            $xmlDatos = $dom->getElementsByTagName('Obs');

            if( !$xmlDatos->length) {

                return false;

            }

            $itemDolar = $xmlDatos->item(0);
            $itemEuro = $xmlDatos->item(2);
            $itemDolarCanadiense = $xmlDatos->item(3);
            $itemYenCanadiense = $xmlDatos->item(4);

            if( !$itemDolar || !$itemDolarCanadiense || !$itemEuro || !$itemYenCanadiense) {

                return false;

            }

            $data = array(
                'USD' => array(
                    'moneda'=>'USD',
                    'descripcion'=>'Dolar',
                    'time'=>$itemDolar->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemDolar->getAttribute('OBS_VALUE')
                ),
                'EUR' => array(
                    'moneda'=>'EUR',
                    'descripcion'=>'Euro',
                    'time'=>$itemEuro->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemEuro->getAttribute('OBS_VALUE')
                ),
                'CAN' => array(
                    'moneda'=>'USD CAN',
                    'descripcion'=>'Dolar Canadiense',
                    'time'=>$itemDolarCanadiense->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemDolarCanadiense->getAttribute('OBS_VALUE')
                ),
                'YEN' => array(
                    'moneda'=>'YEN CAN',
                    'descripcion'=>'YEN Canadiense',
                    'time'=>$itemYenCanadiense->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemYenCanadiense->getAttribute('OBS_VALUE')
                )
            );
        }

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
                      case "getConceptos":
                          //$this->cotizaciones['skTipoTramite'] = $_POST['sReferencia'];
                          $this->cotizaciones['skTipoTramite'] = "IMPO";
                          $this->cotizaciones['skEmpresaImportador'] = "";
                          $this->cotizaciones['skEmpresaNaviera'] = "";
                          $this->cotizaciones['skEmpresaRecinto'] = "";
                          $this->data['conceptosPedimento']=parent::read_conceptos_pedimentos();
                          $this->data['conceptosNaviera']=parent::read_conceptos_naviera();
                          $this->data['conceptosRecinto']=parent::read_conceptos_recinto();
                          $this->data['conceptosDespacho']=parent::read_conceptos_despacho();
                          if(!$this->data['conceptosDespacho']){
                              echo 'false';
                              return false;
                          }
                          echo 'true';
                          return true;
                          break;
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
                                   ,"skTipoTramite"=>utf8_encode($row['skTipoTramite'])
                                    ,"Ejecutivo"=>utf8_encode($row['Ejecutivo'])
                                    ,"sMercancia"=>utf8_encode($row['sMercancia'])
                                    ,"sNumContenedor"=>utf8_encode($row['sNumContenedor'])
                                    ,"iBultos"=>utf8_encode($row['iBultos'])
                                    ,"fPeso"=>utf8_encode($row['fPeso'])
                                    ,"fVolumen"=>utf8_encode($row['fVolumen'])
                                    ,"sBlMaster"=>utf8_encode($row['sBlMaster'])
                                    ,"sBlHouse"=>utf8_encode($row['sBlHouse'])
                                    ,"skEmpresaNaviera"=>utf8_encode($row['skEmpresaNaviera'])
                                );
                            }
                            header('Content-Type: application/json');
                            echo json_encode($result);
                            return true;
                            break;
                        case "save":
                            $this->cotizaciones['skCotizacion'] = !empty($_POST['skCotizacion']) ? $_POST['skCotizacion'] : substr(md5(microtime()), 1, 32);
                            $this->cotizaciones['skEstatus']            = !empty($_POST['skEstatus']) ? addslashes(utf8_decode($_POST['skEstatus'])) : null;
                            $this->cotizaciones['skEmpresaImportador']  = !empty($_POST['skEmpresaImportador'])     ? addslashes(utf8_decode($_POST['skEmpresaImportador'])) : null;
                            $this->cotizaciones['skEmpresaNaviera']     = !empty($_POST['skEmpresaNaviera'])        ? addslashes(utf8_decode($_POST['skEmpresaNaviera'])) : null;
                            $this->cotizaciones['skEmpresaRecinto']     = !empty($_POST['skEmpresaRecinto'])        ? addslashes(utf8_decode($_POST['skEmpresaRecinto'])) : null;
                            $this->cotizaciones['skReferencia']         = !empty($_POST['skReferencia'])            ? addslashes(utf8_decode($_POST['skReferencia'])) : null;
                            $this->cotizaciones['skTipoServicio']       = !empty($_POST['skTipoServicio'])          ? addslashes(utf8_decode($_POST['skTipoServicio'])) : null;
                            $this->cotizaciones['skTipoCobroCotizacion'] = !empty($_POST['skTipoCobroCotizacion'])  ? addslashes(utf8_decode($_POST['skTipoCobroCotizacion'])) : null;
                            $this->cotizaciones['skTipoTramite']        = !empty($_POST['skTipoTramite'])           ? addslashes(utf8_decode($_POST['skTipoTramite'])) : null;
                            $this->cotizaciones['skTipoTransporte']     = !empty($_POST['skTipoTransporte'])        ? addslashes(utf8_decode($_POST['skTipoTransporte'])) : null;
                            $this->cotizaciones['fTipoCambio']          = !empty($_POST['fTipoCambio'])             ? addslashes(utf8_decode($_POST['fTipoCambio'])) : null;
                            $this->cotizaciones['sPedimento']           = !empty($_POST['sPedimento'])              ? addslashes(utf8_decode($_POST['sPedimento'])) : null;
                            $this->cotizaciones['fValorMercancia']      = !empty($_POST['fValorMercancia'])         ? addslashes(utf8_decode($_POST['fValorMercancia'])) : null;
                            $this->cotizaciones['fImporteTotal']        = !empty($_POST['fImporteTotal'])           ? addslashes(utf8_decode($_POST['fImporteTotal'])) : null;
                            $this->cotizaciones['sObservaciones']       = !empty($_POST['sObservaciones'])          ? addslashes(utf8_decode($_POST['sObservaciones'])) : null;
                            // DEFAULT //
                            $this->data['message'] = 'Registro guardado con &eacute;xito.';
                            if(empty($_POST['skCotizacion'])){
                                // CREATE //
                                $skCotizacion = parent::create_cotizaciones();
                                if($skCotizacion){
                                  //  $this->cotizaciones['skCotizacion'] = $skCotizacion;

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
                                // UPDATE //
                                if(parent::update_cotizaciones()){
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

                            break;
                    }
                }
                $this->load_model('emp','emp');
                $objEmpresaImpo = new Emp_Model();
                $objEmpresaImpo->tipoempresas['skTipoEmpresa'] = 'CLIE';
                $this->data['empresaImportador'] = $objEmpresaImpo->read_like_empresas();

                $objEmpresaNavi = new Emp_Model();
                $objEmpresaNavi->tipoempresas['skTipoEmpresa'] = 'LINA';
                $this->data['empresaNaviera'] = $objEmpresaNavi->read_like_empresas();

                $objEmpresaReci = new Emp_Model();
                $objEmpresaReci->tipoempresas['skTipoEmpresa'] = 'RECI';
                $this->data['empresaRecinto'] = $objEmpresaReci->read_like_empresas();
                $this->data['tipoTranporte'] = parent::read_cat_tipos_transportes();
                $this->data['tipoCotizacion'] = parent::read_cat_tipos_cotizaciones();
                $this->data['tipoTramite'] = parent::read_cat_tipos_tramites();
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

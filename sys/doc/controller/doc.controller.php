<?php
	require_once(SYS_PATH."doc/model/doc.model.php");
	Class doc_Controller Extends doc_Model {

		// PRIVATE VARIABLES //
                    private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
		
		}
				/*COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */
 
					public function docume_index(){
					if(isset($_GET['axn'])){
					switch ($_GET['axn']) {
                                        case 'pdf':
                                            $this->recepciondocumentos_pdf();
                                            break;
                                        case 'delete':
                                            $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                                            $this->data['response'] = false;
                                            $this->data['datos'] = false;
                                            if(isset($_GET['p1'])){
                                                $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
                                                if($this->delete_recepciondocumentos()){
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
					if(isset($_POST['skRecepcionDocumento'])){
						$this->recepciondocumentos['skRecepcionDocumento'] = $_POST['skRecepcionDocumento'];
					}
					if(isset($_POST['sReferencia'])){
						$this->recepciondocumentos['sReferencia'] = $_POST['sReferencia'];
					}
					if(isset($_POST['sPedimento'])){
						$this->recepciondocumentos['sPedimento'] = $_POST['sPedimento'];
					}
					if(isset($_POST['sMercancia'])){
						$this->recepciondocumentos['sMercancia'] = $_POST['sMercancia'];
					}
					
					if(isset($_POST['sObservaciones'])){
						$this->recepciondocumentos['sObservaciones'] = $_POST['sObservaciones'];
					}
                                        
                    if(isset($_POST['sNumContenedor'])){
						$this->recepciondocumentos['sNumContenedor'] = $_POST['sNumContenedor'];
					}
                    if(isset($_POST['iBultos'])){
						$this->recepciondocumentos['iBultos'] = $_POST['iBultos'];
					}
                    if(isset($_POST['fPeso'])){
						$this->recepciondocumentos['fPeso'] = $_POST['fPeso'];
					}
                    if(isset($_POST['fVolumen'])){
						$this->recepciondocumentos['fVolumen'] = $_POST['fVolumen'];
					}
					
					if(isset($_POST['skEmpresa'])){
                                            $this->recepciondocumentos['skEmpresa'] = $_POST['skEmpresa'];
					}
                                        if(isset($_POST['skCorresponsalia'])){
                                            $this->recepciondocumentos['skCorresponsalia'] = $_POST['skCorresponsalia'];
					}
                                        if(isset($_POST['skPromotores'])){
                                            $this->recepciondocumentos['skPromotor1'] = $_POST['skPromotores'];
                                            $this->recepciondocumentos['skPromotor2'] = $_POST['skPromotores'];
					}
					if(isset($_POST['skTipoTramite'])){
						$this->recepciondocumentos['skTipoTramite'] = $_POST['skTipoTramite'];
					}
					if(isset($_POST['skTipoServicio'])){
						$this->recepciondocumentos['skTipoServicio'] = $_POST['skTipoServicio'];
					}
                                        if(isset($_POST['sNumContenedor'])){
						$this->recepciondocumentos['sNumContenedor'] = $_POST['sNumContenedor'];
					}
					if(isset($_POST['skClaveDocumento'])){
						$this->recepciondocumentos['skClaveDocumento'] = $_POST['skClaveDocumento'];
					}

					if(!empty($_POST['dRecepcion'])){
						$this->recepciondocumentos['dRecepcion'] = date('Y-m-d',strtotime($_POST['dRecepcion']));
					}

					if(!empty($_POST['dFechaCreacion'])){
						$this->recepciondocumentos['dFechaCreacion'] = date('Y-m-d',strtotime($_POST['dFechaCreacion']));
					}

					if(isset($_POST['skStatus'])){
						$this->recepciondocumentos['skStatus'] = $_POST['skStatus'];
					}
					//exit('<pre>'.print_r($this->recepciondocumentos,1).'</pre>');
					// OBTENER REGISTROS //
					$total = parent::count_recepciondocumentos();
					$records = Core_Functions::table_ajax($total);
					if($records['recordsTotal'] === 0){
						header('Content-Type: application/json');
						echo json_encode($records);
						return false;
					}
					
					$this->recepciondocumentos['limit'] = $records['limit'];
					$this->recepciondocumentos['offset'] = $records['offset'];
                                        $this->recepciondocumentos['orderBy'] = 'rd.sPedimento';
                                        $this->recepciondocumentos['sortBy'] = 'DESC';
					$this->data['data'] = parent::read_recepciondocumentos();
					
					if(!$this->data['data']){
						header('Content-Type: application/json');
						echo json_encode($records);
						return false;
					}
					while($row = $this->data['data']->fetch_assoc()){
						$actions = $this->printModulesButtons(2,array($row['skRecepcionDocumento']),$row['skUsersCreacion']);
						array_push($records['data'], array(
							 utf8_encode($row['sReferencia'])
							,utf8_encode($row['sPedimento'])
							,utf8_encode($row['TipoTramite'])
							,utf8_encode($row['TipoServicio'].'<br>'.$row['sNumContenedor'])
							,utf8_encode($row['Empresa'])
                                                        ,utf8_encode($row['corresponsalia'])
                                                        ,utf8_encode($row['promotor1'].'<br>'.$row['promotor2'])
							,utf8_encode($row['skClaveDocumento'])
							,utf8_encode($row['sMercancia'])
							,utf8_encode($row['sObservaciones'])
							,date('d-m-Y',strtotime($row['dRecepcion'])).' '.$row['tRecepcion']
							,date('d-m-Y H:i:s',strtotime($row['dFechaCreacion']))
                                                        ,utf8_encode($row['autor'])
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
                                        
                                        $cof->users['skStatus'] = 'AC';
                                        $this->data['usuarios'] = $cof->read_user();
					
/*					$this->data['empresa'] = Cof_Model::read_status();
					$this->data['tipotramite'] = Cof_Model::read_status();
					$this->data['clavedocumento'] = Cof_Model::read_status();
					$this->data['coresponsalia'] = Cof_Model::read_status();
*/
 					$this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
                                        $objEmpresa->tipoempresas['skStatus'] = 'AC';
                                        $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
					$this->data['empresas'] = $objEmpresa->read_like_empresas();
                                        $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CORR';
                                        $this->data['corresponsalias'] = $objEmpresa->read_like_empresas();
                                        $this->data['promotores'] = $objEmpresa->read_like_promotores();
					$this->data['tipostramites'] = parent::read_tipos_tramites();
					$this->data['tiposservicios'] = parent::read_tipos_servicios();
					$this->data['clavedocumento'] = parent::read_clave_documento();
					$this->data['corresponsalia'] = parent::read_corresponsalia();
										


					// RETORNA LA VISTA areas-index.php //
					$this->load_view('docume-index', $this->data);
					return true;
					}
					
                                    public function docume_form(){
					$this->data['message'] = '';
					$this->data['response'] = true;
					$this->data['datos'] = false;
					// SACAMOS EL PEDIMENTO EN COLA //
                                        $maxPedimento = parent::getMaxPedimento();
                                        if($maxPedimento){
                                            $this->data['maxPedimento'] = $maxPedimento['sPedimento'] + 1;
                                        }else{
                                            $this->data['maxPedimento'] = '';
                                        }
                                        
					if($_POST){
					//exit('</pre>'.print_r($_POST,1).'</pre>');
					$this->recepciondocumentos['skRecepcionDocumento'] = !empty($_POST['skRecepcionDocumento']) ? $_POST['skRecepcionDocumento'] : substr(md5(microtime()), 1, 32);
					$this->recepciondocumentos['sReferencia'] = utf8_decode($_POST['sReferencia']);
					$this->recepciondocumentos['sPedimento'] = utf8_decode($_POST['sPedimento']);
					$this->recepciondocumentos['sMercancia'] = utf8_decode($_POST['sMercancia']);
					$this->recepciondocumentos['sObservaciones'] = utf8_decode($_POST['sObservaciones']);
					
					$this->recepciondocumentos['skEmpresa'] = utf8_decode($_POST['skEmpresa']);
					$this->recepciondocumentos['skTipoTramite'] = utf8_decode($_POST['skTipoTramite']);
					$this->recepciondocumentos['skTipoServicio'] = utf8_decode($_POST['skTipoServicio']);
					$this->recepciondocumentos['skClaveDocumento'] = utf8_decode($_POST['skClaveDocumento']);
                                        
                    $this->recepciondocumentos['sNumContenedor'] = utf8_decode(!empty($_POST['sNumContenedor']) ? $_POST['sNumContenedor'] : '');
                    $this->recepciondocumentos['iBultos'] = utf8_decode(!empty($_POST['iBultos']) ? $_POST['iBultos'] : 0);
                    $this->recepciondocumentos['fPeso'] = utf8_decode(!empty($_POST['fPeso']) ? $_POST['fPeso'] : 0);
                    $this->recepciondocumentos['fVolumen'] = utf8_decode(!empty($_POST['fVolumen']) ? $_POST['fVolumen'] : 0);

                    $this->recepciondocumentos['dRecepcion'] = utf8_decode(!empty($_POST['dRecepcion']) ? date('Y-m-d',strtotime($_POST['dRecepcion'])) : date('Y-m-d'));
                    $this->recepciondocumentos['tRecepcion'] = utf8_decode(!empty($_POST['tRecepcion']) ? $_POST['tRecepcion'] : date('H:i:s'));
					
						if(empty($_POST['skRecepcionDocumento'])){
                                                        $maxPedimento = parent::getMaxPedimento();
                                                        if($maxPedimento){
                                                            if($maxPedimento['sPedimento'] == $this->recepciondocumentos['sPedimento']){
                                                                $this->data['response'] = false;
								$this->data['errorPedimento'] = false;
                                                                $this->data['message'] = 'El pedimento '.$this->recepciondocumentos['sPedimento']." Ya ha sido utilizado, intenta con ".($maxPedimento['sPedimento'] + 1);
								header('Content-Type: application/json');
								echo json_encode($this->data);
								return false;
                                                            }
                                                        }
							if(parent::create_recepciondocumentos()){
                                                            //echo ('</pre>'.print_r($_FILES,1).'</pre>');
                                                            foreach($_FILES['skDocTipo'] AS $k=>$v){
                                                                if($k === 'name'){
                                                                    foreach($v AS $key => $val){
                                                                        // AQUI HACEMOS EL MOVE_UPLOADED_FILE //
                                                                        $fileName = time().$_FILES['skDocTipo']['name'][$key];
                                                                        if(move_uploaded_file($_FILES['skDocTipo']['tmp_name'][$key] , SYS_PATH.'/doc/files/'.$fileName)){
                                                                            $this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'] = substr(md5(microtime()), 1, 32);
                                                                            $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
                                                                            $this->recepcionDoc_docTipo['skDocTipo'] = $key;
                                                                            $this->recepcionDoc_docTipo['sFile'] = $fileName;
                                                                            parent::create_recepcionDoc_docTipo();
                                                                        }
                                                                    }
                                                                }
                                                            }
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
							//echo ('</pre>'.print_r($_POST,1).'</pre>');
							if(isset($_FILES)){
								$this->recepcionDoc_docTipo['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
								$this->recepcionDoc_docTipo['skStatus'] = 'IN';
                                parent::updateStatus_recepcionDoc_docTipo();
								foreach($_FILES['skDocTipo'] AS $k=>$v){
	                                if($k === 'name'){
	                                    foreach($v AS $key => $val){
	                                        // AQUI HACEMOS EL MOVE_UPLOADED_FILE //
	                                        $fileName = time().$_FILES['skDocTipo']['name'][$key];
	                                        if(move_uploaded_file($_FILES['skDocTipo']['tmp_name'][$key] , SYS_PATH.'/doc/files/'.$fileName)){
	                                            $this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'] = substr(md5(microtime()), 1, 32);
	                                            $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
	                                            $this->recepcionDoc_docTipo['skDocTipo'] = $key;
	                                            $this->recepcionDoc_docTipo['sFile'] = $fileName;
	                                            parent::create_recepcionDoc_docTipo();
	                                        }
	                                    }
	                                }
	                            }
	                            if(!empty($_POST['skDocTipo'])){
									foreach($_POST['skDocTipo'] AS $a=>$b){
										$this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'] = $b;
										$this->recepcionDoc_docTipo['skStatus'] = 'AC';
	                                    parent::updateStatus_recepcionDoc_docTipo();
									}
								}
                        	}
							if(parent::update_recepciondocumentos()){
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
                                        $this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
                                        $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
                                        $this->data['empresas'] = $objEmpresa->read_like_empresas();
					$this->data['tipostramites'] = parent::read_tipos_tramites();
					$this->data['tiposservicios'] = parent::read_tipos_servicios();
					$this->data['clavedocumento'] = parent::read_clave_documento();
					$this->data['docTipo'] = parent::read_equal_docTipo();
                                        
					if(isset($_GET['p1'])){
                                            $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
                                            $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $_GET['p1'];
                                            $this->data['datos'] = parent::read_recepciondocumentos();
                                            $this->data['filesDocTipo'] = parent::read_equal_recepcionDoc_docTipo();
                                            /*
                                             * ESTO ES PARA QUE SOLO PUEDA MODIFICAR EL USUARIO QUE CREÓ EL REGISTRO
                                             */
                                            $result = $this->data['datos']->fetch_assoc();
                                            $this->data['datos']->data_seek(0);
                                            $this->verify_access('W' , $result['skUsersCreacion']);
                                            /* FINALIZA SEGURIDAD DE AUTOR DE REGISTRO */
					}
                                        $this->load_view('docume-form', $this->data);
                                        return true;
                                    }
					
					
					public function docume_detail(){
					if(isset($_GET['p1'])){
					$this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
					$this->data['datos'] = parent::read_recepciondocumentos();
					}
					$this->load_view('docume-detail', $this->data);
					return true;
					}
                                        
                                        private function recepciondocumentos_pdf(){
                                            if(isset($_GET['p1'])){
                                                $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
                                                $this->data['datos'] = parent::read_recepciondocumentos();
                                            }
                                            ob_start();
                                            $this->load_view('docume-pdf', $this->data, FALSE, 'doc/pdf/');
                                            $content = ob_get_clean();
                                            $title = 'Recepci&oacute;n de documentos';
                                            Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                                            return true;
                                        }
					
					
					 public function clavdocu_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->clavdocu_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['skClaveDocumento'])){
                                    $this->clavdocu['skClaveDocumento'] = $_POST['skClaveDocumento'];
                                }
                                 if(isset($_POST['sNombre'])){
                                    $this->clavdocu['sNombre'] = $_POST['sNombre'];
                                }
                              
                                if(isset($_POST['skStatus'])){
                                    $this->clavdocu['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_clavdocu();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->clavdocu['limit'] = $records['limit'];
                                $this->clavdocu['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_clavdocu();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skClaveDocumento']));
                                    array_push($records['data'], array(
                                         utf8_encode($row['skClaveDocumento'])
                                        ,utf8_encode($row['sNombre'])
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
                    $this->load_view('clavdocu-index', $this->data);
                    return true;
                }
					 public function clavdocu_form(){
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                         
                        $this->clavdocu['skClaveDocumentoViejo'] = $_POST['skClaveDocumentoViejo'];
                        $this->clavdocu['skClaveDocumento'] = $_POST['skClaveDocumento'];
                        $this->clavdocu['sNombre'] = htmlentities($_POST['sNombre'],ENT_QUOTES);
                        $this->clavdocu['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        
                        
                        if(empty($_POST['skClaveDocumentoViejo'])){
                            if(parent::create_clavdocu()){
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
                            if(parent::update_clavdocu()){
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
                        $this->clavdocu['skClaveDocumento'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_clavdocu();
                    }
                    $this->load_view('clavdocu-form', $this->data);
                    return true;
                }
					 public function clavdocu_detail(){
                    if(isset($_GET['p1'])){
                        $this->clavdocu['skClaveDocumento'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_clavdocu();
                    }
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->clavdocu_pdf();
                                break;
                        }
                    }
                    $this->load_view('clavdocu-detail', $this->data);
                    return true;
                }
					  
					 public function correspo_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->correspo_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['skCorresponsalia'])){
                                    $this->correspo['skCorresponsalia'] = $_POST['skCorresponsalia'];
                                }
                                 if(isset($_POST['sNombre'])){
                                    $this->correspo['sNombre'] = $_POST['sNombre'];
                                }
                              
                                if(isset($_POST['skStatus'])){
                                    $this->correspo['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_correspo();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->correspo['limit'] = $records['limit'];
                                $this->correspo['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_correspo();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skCorresponsalia']));
                                    array_push($records['data'], array(
                                         utf8_encode($row['skCorresponsalia'])
                                        ,utf8_encode($row['sNombre'])
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
                    $this->load_view('correspo-index', $this->data);
                    return true;
                }
					 public function correspo_form(){
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                         
                        $this->correspo['skCorresponsaliaViejo'] = $_POST['skCorresponsaliaViejo'];
                        $this->correspo['skCorresponsalia'] = $_POST['skCorresponsalia'];
                        $this->correspo['sNombre'] = htmlentities($_POST['sNombre'],ENT_QUOTES);
                        $this->correspo['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        
                        
                        if(empty($_POST['skCorresponsaliaViejo'])){
                            if(parent::create_correspo()){
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
                            if(parent::update_correspo()){
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
                        $this->correspo['skCorresponsalia'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_correspo();
                    }
                    $this->load_view('correspo-form', $this->data);
                    return true;
                }
					  
            	// ARCHIVOS DE DOCUMENTACIÓN (RECEPCIÓN DE DOCUMENTOS) //
            	public function arcdocu_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'fetch_all':
                                
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['skDocTipo'])){
                                    $this->recepcionDoc_docTipo['skDocTipo'] = $_POST['skDocTipo'];
                                }
                                 if(isset($_POST['sNombre'])){
                                    $this->recepcionDoc_docTipo['sNombre'] = $_POST['sNombre'];
                                }
                              
                                if(isset($_POST['skStatus'])){
                                    $this->recepcionDoc_docTipo['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_docTipo();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->recepcionDoc_docTipo['limit'] = $records['limit'];
                                $this->recepcionDoc_docTipo['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_docTipo();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skDocTipo']));
                                    array_push($records['data'], array(
                                         utf8_encode($row['skDocTipo'])
                                        ,utf8_encode($row['sNombre'])
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
                    $this->load_view('arcdocu-index', $this->data);
                    return true;
                }
                
                public function arcdocu_form(){
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    if($_POST){
                        
                         
                        $this->recepcionDoc_docTipo['skDocTipoViejo'] = $_POST['skDocTipoViejo'];
                        $this->recepcionDoc_docTipo['skDocTipo'] = isset($_POST['skDocTipo']) ? $_POST['skDocTipo'] : $_POST['skDocTipoViejo'];
                        $this->recepcionDoc_docTipo['sNombre'] = htmlentities($_POST['sNombre'],ENT_QUOTES);
                        $this->recepcionDoc_docTipo['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
                        
                        
                        if(empty($_POST['skDocTipoViejo'])){
                            if(parent::create_docTipo()){
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
                            if(parent::update_docTipo()){
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
                        $this->recepcionDoc_docTipo['skDocTipo'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_docTipo();
                    }
                    $this->load_view('arcdocu-form', $this->data);
                    return true;
                }

				/*TERMINA MODULO CAPTURA DE DOCUMENTOS */
	}
?>

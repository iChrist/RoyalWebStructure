<?php
	require_once(SYS_PATH."rev/model/rev.model.php");
	Class rev_Controller Extends rev_Model {

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
                                                    parent::delete_revalidacionesRechazos();
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
					if(isset($_POST['skEmpresaNaviera'])){
						$this->solreva['skEmpresaNaviera'] = $_POST['skEmpresaNaviera'];
					}
					if(isset($_POST['skUsuarioSolicitud'])){
						$this->solreva['skUsuarioSolicitud'] = $_POST['skUsuarioSolicitud'];
					}
					if(isset($_POST['skUsuarioProceso'])){
						$this->solreva['skUsuarioProceso'] = $_POST['skUsuarioProceso'];
					}
					if(isset($_POST['skUsuarioCierre'])){
						$this->solreva['skUsuarioCierre'] = $_POST['skUsuarioCierre'];
					}
					if(isset($_POST['skUsuarioTramitador'])){
						$this->solreva['skUsuarioTramitador'] = $_POST['skUsuarioTramitador'];
					}
					if(isset($_POST['sObservaciones'])){
						$this->solreva['sObservaciones'] = $_POST['sObservaciones'];
					}
					if(isset($_POST['skEstatusRevalidacion'])){
						$this->solreva['skEstatusRevalidacion'] = $_POST['skEstatusRevalidacion'];
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
						
						$dFechaCreacion = !empty($row['dFechaCreacion']) ? date('d-m-Y H:i:s', strtotime($row['dFechaCreacion'])) : '-';
						$dFechaProceso = !empty($row['dFechaProceso']) ? date('d-m-Y H:i:s', strtotime($row['dFechaProceso'])) : '-';
						$dFechaCierre = !empty($row['dFechaCierre']) ? date('d-m-Y H:i:s', strtotime($row['dFechaCierre'])) : '-';
						$fechas = '<b>Solicitud:</b> '.$dFechaCreacion.'<br><b>Proceso:</b> '.$dFechaProceso.'<br><b>Cierre:</b> '.$dFechaCierre;
						
						array_push($records['data'], array(
						 	 utf8_encode($row['Icono'])
						 	,utf8_encode($row['sReferencia'])
						 	,$fechas
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
					
/*					$this->data['empresa'] = Cof_Model::read_status();
					$this->data['tipotramite'] = Cof_Model::read_status();
					$this->data['clavedocumento'] = Cof_Model::read_status();
					$this->data['coresponsalia'] = Cof_Model::read_status();
*/
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
                                        /*
					$this->data['estatus'] = parent::read_estatus();
					
					$this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
					$objEmpresa->tipoempresas['skTipoEmpresa'] = 'LINA';
					$this->data['empresas'] = $objEmpresa->read_like_empresas();
					
					$this->load_model('cof','cof');
					$objUsuarios = new Cof_Model();
					$this->data['tramitadores'] = $objUsuarios->read_user();
					
					$this->data['rechazos'] = parent::read_like_rechazos();
                                        */
					if(isset($_POST['axn']))
                    	 {
                        	switch ($_POST['axn'])
		                        {           
		                              case "obtenerDatos":
		                              	
  		                                $this->solreva['sReferencia'] = htmlentities($_POST['sReferencia']);
 		                                 $this->data['data']=parent::read_referencia();
 		                                 
 		                                 if(!$this->data['data']){
 		                                 	$this->data['response'] = false;
 		                                 	$this->data['message'] = 'La Referencia no existe.';
											header('Content-Type: application/json');
											echo json_encode($this->data);
											return false;
										}
										$result['data'] = array();
 		                                    while($row = $this->data['data']->fetch_assoc()){
 												array_push($result['data'], array(
													 utf8_encode($row['Empresa'])
													 ,utf8_encode($row['TipoServicio'])
						 							,utf8_encode($row['Ejecutivo'])
													,utf8_encode($row['sMercancia'])
													,utf8_encode($row['sNumContenedor'])
													,utf8_encode($row['iBultos'])
													,utf8_encode($row['fPeso'])
													,utf8_encode($row['fVolumen'])
												)
												);
											}
  											header('Content-Type: application/json');
											echo json_encode($result);
 		                               return true;
		                            break;

		                            
		                        }
		                   }


					if(isset($_POST['axn']))
                    	 {
                        	switch ($_POST['axn'])
		                        {
 		                             case "validarReferencia":
 										
		                                $this->solreva['sReferencia'] = htmlentities(($_POST['sReferencia']));
 		                                $this->data['revalidaciones']=parent::read_referencia();
 		                                if(parent::read_referencia())
		                                {
		                                    echo 'true';
		                                }
		                                else
		                                {
		                                    echo 'false';
		                                }
		                               return true;
		                            break;
		                            }
		               }
		                					
 					if($_POST){
					//exit('</pre>'.print_r($_POST,1).'</pre>');
					$this->solreva['skSolicitudRevalidacion'] = !empty($_POST['skSolicitudRevalidacion']) ? $_POST['skSolicitudRevalidacion'] : substr(md5(microtime()), 1, 32);
					$this->solreva['sReferencia'] = isset($_POST['sReferencia']) ? utf8_decode($_POST['sReferencia']) : null;
  					$this->solreva['sObservaciones'] = isset($_POST['sObservaciones']) ? utf8_decode($_POST['sObservaciones']) : null;
 					$this->solreva['skEmpresaNaviera'] = isset($_POST['skEmpresaNaviera']) ? utf8_decode($_POST['skEmpresaNaviera']) : null;
 					$this->solreva['skEstatusRevalidacion'] =  isset($_POST['skEstatusRevalidacion']) ? $_POST['skEstatusRevalidacion'] : null;
 					$this->solreva['skUsuarioTramitador'] = isset($_POST['skUsuarioTramitador']) ? $_POST['skUsuarioTramitador'] : null;
 					$this->solreva['sBL'] = isset($_POST['sBL']) ? $_POST['sBL'] : null;
 					$this->solreva['iPrioridad'] = isset($_POST['iPrioridad']) ? $_POST['iPrioridad'] : null;
 					$this->solreva['dFechaArriboBuque'] = isset($_POST['dFechaArriboBuque']) ? date('Y-m-d',strtotime($_POST['dFechaArriboBuque'])) : null;
 					$this->solreva['dEta'] = isset($_POST['dEta']) ? date('Y-m-d',strtotime($_POST['dEta'])) : null;
                                        if(!is_null($this->solreva['skEstatusRevalidacion']) && $this->solreva['skEstatusRevalidacion'] == 'PR'){
 						$this->solreva['dFechaProceso'] = 'CURRENT_TIMESTAMP()';
 						$this->solreva['skUsuarioProceso'] = $_SESSION['session']['skUsers'];
 					}elseif(!is_null($this->solreva['skEstatusRevalidacion']) && ($this->solreva['skEstatusRevalidacion'] == 'RV' || $this->solreva['skEstatusRevalidacion'] == 'RE') ){
 						$this->solreva['dFechaCierre'] = 'CURRENT_TIMESTAMP()';
 						$this->solreva['skUsuarioCierre'] = $_SESSION['session']['skUsers'];
 					}
                    //exit(var_dump($this->solreva));
 						if(empty($_POST['skSolicitudRevalidacion'])){
							
                                                    if(parent::create_solreva()){
							
							
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
							if(parent::update_solreva()){
							
							if(isset($_POST['skRechazo'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
									{
                                                                        parent::delete_revalidacionesRechazos();
										$count = count($_POST['skRechazo']);
										 $bandera = 1;
										 $valores = "";
										foreach ($_POST['skRechazo'] as $rechazo)
										{
											if( $bandera == $count )
											{
												$valores .= "('".$this->solreva['skSolicitudRevalidacion']."' , '".$rechazo."')";
											}
											else
											{
												$valores .= "('".$this->solreva['skSolicitudRevalidacion']."' , '".$rechazo."'),";
											}
											$bandera++;
										}
										$rRespuesta = parent::create_solreva_rechazos($valores);
									}
							
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
                                        
                                        $this->data['estatus'] = parent::read_estatus();
					
					$this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
					$objEmpresa->tipoempresas['skTipoEmpresa'] = 'LINA';
					$this->data['empresas'] = $objEmpresa->read_like_empresas();
					
					$this->load_model('cof','cof');
					$objUsuarios = new Cof_Model();
					$this->data['tramitadores'] = $objUsuarios->read_user();
					
					$this->data['rechazos'] = parent::read_like_rechazos();
                                        
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
                                                $solicitudRevalidacion = parent::read_solreva();
                                                if($solicitudRevalidacion){
                                                    $this->data['datos'] = $solicitudRevalidacion->fetch_assoc();
                                                }
                                                $rechazos = parent::read_like_rechazos();
                                                $this->data['rechazos'] = array();
                                                while($row = $rechazos->fetch_assoc()){
                                                    array_push($this->data['rechazos'], array(
                                                        'skRechazo'=>utf8_encode($row['skRechazo'])
                                                        ,'sNombre'=>utf8_encode($row['sNombre'])
                                                    ));
                                                }
                                                $rechazosSolicitud = parent::read_solreva_rechazos();
                                                $this->data['rechazosSolicitud'] = array();
                                                while($row = $rechazosSolicitud->fetch_assoc()){
                                                    array_push($this->data['rechazosSolicitud'], $row['skRechazo']);
                                                }
                                                $this->solreva['sReferencia'] = $this->data['datos']['sReferencia'];
 		                                		$recepcionDocumentos = parent::read_referencia();
                                                if($recepcionDocumentos){
                                                    $this->data['recepcionDocumentos'] = $recepcionDocumentos->fetch_assoc();
                                                }
                                            }
                                            //exit('<pre>'.print_r($this->data,1));
                                            ob_start();
                                            $this->load_view('solreva-pdf', $this->data, FALSE, 'rev/pdf/');
                                            $content = ob_get_clean();
                                            $title = 'Solicitud de revaldaci&oacute;n';
                                            Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                                            return true;
                                        }
					
                                    public function docume_detail(){
					if(isset($_GET['p1'])){
					$this->solreva['skSolicitudRevalidacion'] = $_GET['p1'];
					$this->data['datos'] = parent::read_recepciondocumentos();
					}
					$this->load_view('docume-detail', $this->data);
					return true;
					}

				/*TERMINA MODULO CAPTURA DE DOCUMENTOS */
				
				 public function rechazos_index(){
                    if(isset($_GET['axn'])){
                        switch ($_GET['axn']) {
                            case 'pdf':
                                $this->rechazos_pdf();
                                break;
                            case 'fetch_all':
                                // PARAMETROS PARA FILTRADO //
                                if(isset($_POST['sNombre'])){
                                    $this->rechazos['sNombre'] = $_POST['sNombre'];
                                }
                                if(isset($_POST['skUserCreacion'])){
                                    $this->rechazos['skUserCreacion'] = $_POST['skUserCreacion'];
                                }
                                if(isset($_POST['skStatus'])){
                                    $this->rechazos['skStatus'] = $_POST['skStatus'];
                                }

                                // OBTENER REGISTROS //
                                $total = parent::count_rechazos();
                                $records = Core_Functions::table_ajax($total);
                                if($records['recordsTotal'] === 0){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                $this->rechazos['limit'] = $records['limit'];
                                $this->rechazos['offset'] = $records['offset'];
                                $this->data['data'] = parent::read_like_rechazos();

                                if(!$this->data['data']){
                                    header('Content-Type: application/json');
                                    echo json_encode($records);
                                    return false;
                                }

                                while($row = $this->data['data']->fetch_assoc()){
                                    $actions = $this->printModulesButtons(2,array($row['skRechazo']));
                                    array_push($records['data'], array(
                                         utf8_encode($row['sNombre'])
                                        ,utf8_encode($row['UsuarioCreacion'])
                                        ,utf8_encode($row['dFechaCreacion'])
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
                    $this->load_view('rechazos-index', $this->data);
                    return true;
                }
				 
				 public function rechazos_form(){ 
                    if(isset($_GET['axn'])){
                        if($_GET['axn']==='fileUpload'){
                            $upload_handler = new UploadHandler();
                            return true;
                        }
                    }
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    if($_POST){
                        //exit('</pre>'.print_r($_POST,1).'</pre>');
                        $this->rechazos['skRechazo'] = !empty($_POST['skRechazo']) ? $_POST['skRechazo'] : substr(md5(microtime()), 1, 32);
                        $this->rechazos['sNombre'] = utf8_decode($_POST['sNombre']);
                         $this->rechazos['skStatus'] = utf8_decode($_POST['skStatus']);
                        if(empty($_POST['skRechazo'])){
                            if(parent::create_rechazos()){
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
                            if(parent::update_rechazos()){
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
                        $this->areas['skRechazo'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_equal_rechazos();
                    }
                    $this->load_view('rechazos-form', $this->data);
                    return true;
                }
	}
?>

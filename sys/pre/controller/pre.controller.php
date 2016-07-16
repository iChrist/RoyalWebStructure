<?php
	require_once(SYS_PATH.$_GET["sysModule"]."/model/".$_GET["sysModule"].".model.php");
	class Pre_Controller extends Pre_Model {

		private $data = array();

		public function __construct(){
		parent::__construct();
		}

		public function __destruct(){

		}
		public function previos_index(){
				if(isset($_GET['axn'])){
						switch ($_GET['axn']) {
								case 'pdf':
									$this->solicitudprevio_pdf();
								break;
								case 'fetch_all':
										// PARAMETROS PARA FILTRADO //
										if(!empty($_POST['skSolicitudPrevio'])){
												$this->previos['skSolicitudPrevio'] = $_POST['skSolicitudPrevio'];
										}
										if(!empty($_POST['ikSolicitudPrevio'])){
												$this->previos['ikSolicitudPrevio'] = $_POST['ikSolicitudPrevio'];
										}
										if(!empty($_POST['sReferencia'])){
												$this->previos['sReferencia'] = $_POST['sReferencia'];
										}
										if(!empty($_POST['sPedimento'])){
												$this->previos['sPedimento'] = $_POST['sPedimento'];
										}
										if(!empty($_POST['dFechaSolicitud'])){
												$this->previos['dFechaSolicitud'] = date('Y-m-d',  strtotime($_POST['dFechaSolicitud']));
										}
										if(!empty($_POST['dFechaPrevio'])){
												$this->previos['dFechaPrevio'] = date('Y-m-d',  strtotime($_POST['dFechaPrevio']));
										}
										if(!empty($_POST['dFechaApertura'])){
												$this->previos['dFechaApertura'] = date('Y-m-d',  strtotime($_POST['dFechaApertura']));
										}
										if(!empty($_POST['skUsuarioCreacion'])){
												$this->previos['skUsuarioCreacion'] = $_POST['skUsuarioCreacion'];
										}
										if(!empty($_POST['skUsuarioEjecutivo'])){
												$this->previos['skUsuarioEjecutivo'] = $_POST['skUsuarioEjecutivo'];
										}
										if(!empty($_POST['skUsuarioTramitador'])){
												$this->previos['skUsuarioTramitador'] = $_POST['skUsuarioTramitador'];
										}
										if(!empty($_POST['sMasterBL'])){
												$this->previos['sMasterBL'] = $_POST['sMasterBL'];
										}
										if(!empty($_POST['sSelloOrigen'])){
												$this->previos['sSelloOrigen'] = $_POST['sSelloOrigen'];
										}
										if(!empty($_POST['sSelloFinal'])){
												$this->previos['sSelloFinal'] = $_POST['sSelloFinal'];
										}
										if(!empty($_POST['sNumeroFactura'])){
												$this->previos['sNumeroFactura'] = $_POST['sNumeroFactura'];
										}
										if(!empty($_POST['sPais'])){
												$this->previos['sPais'] = $_POST['sPais'];
										}
										if(!empty($_POST['skEstatus'])){
												$this->previos['skEstatus'] = $_POST['skEstatus'];
										}

									//	$this->previos['skEstatus'] = 'AC';


										//exit('<pre>'.print_r($this->facdat,1).'</pre>');
										// OBTENER REGISTROS //
										$total = parent::count_previos();
										$records = Core_Functions::table_ajax($total);
										if($records['recordsTotal'] === 0){
												header('Content-Type: application/json');
												echo json_encode($records);
												return false;
										}
										$this->previos['limit'] = $records['limit'];
										$this->previos['offset'] = $records['offset'];
										$this->data['data'] = parent::read_like_previos();
										if(!$this->data['data']){
												header('Content-Type: application/json');
												echo json_encode($records);
												return false;
										}

										while($row = $this->data['data']->fetch_assoc()){
												$actions = $this->printModulesButtons(2,array($row['skSolicitudPrevio']));
												array_push($records['data'], array(
													!empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
														 ,utf8_encode($row['iconoEstatus'])
														,str_pad($row['codigo'], 7, "0", STR_PAD_LEFT)
														,($row['fechaSolicitud'] ? utf8_encode($row['fechaSolicitud']) : 'N/D')
														,($row['fechaPrevio'] ? utf8_encode($row['fechaPrevio']) : 'N/D')
														,($row['sReferencia'] ? utf8_encode($row['sReferencia']) : 'N/D')
														,($row['importador'] ? utf8_encode($row['importador']) : 'N/D')
														,($row['recinto'] ? utf8_encode($row['recinto']) : '')
														,($row['usuarioEjecutivo'] ? utf8_encode($row['usuarioEjecutivo']) : 'N/D')
														,($row['usuarioTramitador'] ? utf8_encode($row['usuarioTramitador']) : 'N/D')
														,($row['numeroFactura'] ? utf8_encode($row['numeroFactura']) : 'N/D')
														,($row['paisOrigen'] ? utf8_encode($row['paisOrigen']) : 'N/D')
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


				// RETORNA LA VISTA facdat-index.php //
				$this->load_view('previos-index', $this->data);
				return true;
		}
		public function previos_form(){
			$this->data['message'] = '';
			$this->data['response'] = true;
			$this->data['datos'] = false;
			$this->data['autoridades'] = parent::read_autoridades(); // Mandamos a llamar todos los perfiles para cargarlos en la vista
			$this->data['tiposPrevios'] = parent::read_tiposPrevios(); // Mandamos a llamar todos los perfiles para cargarlos en la vista

			if (isset($_POST['axn'])) {
					switch ($_POST['axn']) {
							case "validarReferencia":
									$this->solreva['sReferencia'] = htmlentities(($_POST['sReferencia']));
									$this->data['revalidaciones'] = parent::read_referencia();
									if (parent::read_referencia()) {
											echo 'true';
									} else {
											echo 'false';
									}
									return true;
							break;
							 case "obtenerDatos":
									$this->load_controller('doc','obtenerDatos');
									return true;
							break;
					}
			}
			if ($_POST) {
				$this->previos['skSolicitudPrevio'] = !empty($_POST['skSolicitudPrevio']) ? $_POST['skSolicitudPrevio'] : substr(md5(microtime()), 1, 32);
				$this->previos['sReferencia'] = utf8_decode(!empty($_POST['sReferencia']) ? $_POST['sReferencia'] : '');
				$this->previos['skUsuarioEjecutivo'] = utf8_decode(!empty($_POST['skUsuarioEjecutivo']) ? $_POST['skUsuarioEjecutivo'] : '');
				$this->previos['skSocioImportador'] = utf8_decode(!empty($_POST['skSocioImportador']) ? $_POST['skSocioImportador'] : '');
				$this->previos['skSocioPropietario'] = utf8_decode(!empty($_SESSION['session']['skSocioEmpresaPropietario']) ? $_SESSION['session']['skSocioEmpresaPropietario'] : '');

				$this->previos['skSocioRecinto'] = utf8_decode(!empty($_POST['skSocioRecinto']) ? $_POST['skSocioRecinto'] : '');
				$this->previos['skUsuarioTramitador'] = utf8_decode(!empty($_POST['skUsuarioTramitador']) ? $_POST['skUsuarioTramitador'] : '');
				$this->previos['dFechaSolicitud'] = utf8_decode(!empty($_POST['dFechaProgramacion']) ? date('Y-m-d', strtotime($_POST['dFechaProgramacion'])) : date('Y-m-d'));
				//$this->previos['dFechaSolicitud'] = utf8_decode(!empty($_POST['dFechaSolicitud']) ? date('Y-m-d', strtotime($_POST['dFechaSolicitud'])) : date('Y-m-d'));
				$this->previos['sSelloOrigen'] = addslashes(utf8_decode($_POST['sSelloOrigen']));
				$this->previos['sSelloFinal'] = addslashes(utf8_decode($_POST['sSelloFinal']));
				$this->previos['sNumeroFactura'] = addslashes(utf8_decode($_POST['sNumeroFactura']));
				$this->previos['sPais'] = addslashes(utf8_decode($_POST['sPais']));
				$this->previos['sObservacionesSolicitud'] = addslashes(utf8_decode($_POST['sObservacionesSolicitud']));
				if (!$_POST['skSolicitudPrevio']) {
					$skSolicitudPrevio = parent::create_previos();
					if($skSolicitudPrevio) {
						$bandera = 1;
						$bandera1 = 1;
							if(isset($_POST['skAutoridad'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
							{
									$count = count($_POST['skAutoridad']);
									$valores = "";
									foreach ($_POST['skAutoridad'] as $autoridades)
									{
										if( $bandera == $count )
										{
											$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$autoridades."')";
										}
										else
										{
											$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$autoridades."'),";
										}
										$bandera++;
									}
									$rRespuesta = parent::create_autoridades_previos($valores);
								}
							if(isset($_POST['skTipoPrevio'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
							{
										$count1 = count($_POST['skTipoPrevio']);
										$valores = "";
										foreach ($_POST['skTipoPrevio'] as $tipoPrevio)
										{
											if( $bandera1 == $count1 )
											{
												$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$tipoPrevio."')";
											}
											else
											{
												$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$tipoPrevio."'),";
											}
											$bandera1++;
										}
										$rRespuesta = parent::create_tiposPrevios_previos($valores);
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
						if(parent::update_previos()){
								$bandera = 1;
								$bandera1 = 1;
							if(isset($_POST['skAutoridad'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
							{
									$count = count($_POST['skAutoridad']);
									$valores = "";
									foreach ($_POST['skAutoridad'] as $autoridades)
									{
										if( $bandera == $count )
										{
											$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$autoridades."')";
										}
										else
										{
											$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$autoridades."'),";
										}
										$bandera++;
									}
									$rRespuesta = parent::create_autoridades_previos($valores);
								}
							if(isset($_POST['skTipoPrevio'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
							{
										$count = count($_POST['skTipoPrevio']);
										$valores = "";
										foreach ($_POST['skTipoPrevio'] as $tipoPrevio)
										{
											if( $bandera1 == $count )
											{
												$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$tipoPrevio."')";
											}
											else
											{
												$valores .= "('".$this->previos['skSolicitudPrevio']."' , '".$tipoPrevio."'),";
											}
											$bandera1++;
										}
										$rRespuesta = parent::create_tiposPrevios_previos($valores);
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


				} //Termina else de Editado o Registro Nuevo



			} //Termina if de datos de post
				$this->load_model('cof', 'cof');
				$objUsuarios = new Cof_Model();
				$this->data['ejecutivos'] = $objUsuarios->read_user();
				$this->data['tramitadores'] = $objUsuarios->read_user();

				$this->load_model('emp', 'emp');
				$objEmpresas = new Emp_Model();
				$objEmpresas->tipoempresas['skStatus'] = 'AC';
				$objEmpresas->tipoempresas['skTipoEmpresa'] = 'CLIE';
				$this->data['importador'] = $objEmpresas->read_like_empresas();
				$objEmpresas->tipoempresas['skTipoEmpresa'] = 'RECI';
				$this->data['recinto'] = $objEmpresas->read_like_empresas();


			if(isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
					$this->data['datos'] = parent::read_previos();

					$this->data['autoridadesPrevios'] = parent::read_previos_autoridades();
					$this->data['tiposPreviosPrevio'] = parent::read_previos_previos();

			}
			$this->load_view('previos-form', $this->data);
			return true;


		}
		public function prevaut_form(){
			$this->data['message'] = '';
			$this->data['response'] = true;
			$this->data['datos'] = false;
			if (isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
					$this->data['datos'] = parent::autcan_previo();
			}
			$this->load_view('prevaut-form', $this->data);
			return true;

		}
		public function preafo_form(){
			$this->data['message'] = '';
			$this->data['response'] = true;
			$this->data['datos'] = false;
			if (isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
					$this->data['datos'] = parent::preafo_previo();
			}
			$this->load_view('preafo-form', $this->data);
			return true;

		}
		public function preatr_form(){
			$this->data['message'] = '';
			$this->data['response'] = true;
			$this->data['datos'] = false;
			$this->previos['skSolicitudPrevio'] = !empty($_POST['skSolicitudPrevio']) ? $_POST['skSolicitudPrevio'] : '';
			$this->previos['skUsuarioTramitador'] = utf8_decode(!empty($_POST['skUsuarioTramitador']) ? $_POST['skUsuarioTramitador'] : '');
			if($_POST){
				if(parent::update_preatr_previos()){

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

			$this->load_model('cof', 'cof');
			$objUsuarios = new Cof_Model();
			$this->data['tramitadores'] = $objUsuarios->read_user();
			if (isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
					$this->data['datos'] = parent::preatr_form();
			}
			$this->load_view('preatr-form', $this->data);
			return true;

		}
		private function solicitudprevio_pdf() {
				if (isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
						$datos = parent::read_like_previos();
						if ($datos) {
								$this->data['datos'] = $datos->fetch_assoc();
								$result = 	$this->data['datos'] = $datos->fetch_assoc();
								//echo $result['sReferencia'];
								$this->previos['sReferencia'] = $result['sReferencia'];
								$this->data['clasificaciones'] = parent::read_filter_cla();
						}

				}

				$this->data['config'] = array(
						'title' => 'Reporte de Inspeccion de Mercancias'
						, 'date' => date('d-m-Y H:i:s')
						, 'company' => 'Gomez y Alvez'
						, 'address' => 'Manzanillo, Colima'
						, 'phone' => ''
						, 'website' => ''
						, 'background_image' => ''
						, 'header' => (CORE_PATH) . 'assets/pdf/tplHeaderPdf.php'
						, 'footer' => (CORE_PATH) . 'assets/pdf/tplFooterPdf.php'
					, 'style' => (CORE_PATH) . 'assets/pdf/tplStylePdf.php'
				);
				ob_start();
				$this->load_view('solpre-pdf', $this->data, FALSE, 'pre/pdf/');
				$content = ob_get_clean();
			//	echo $content;
			//	die();
				$title = 'Reporte de Inspeccion de Mercancias';
				Core_Functions::pdf($content, $this->data['config']['title'], 'P', 'A4', 'es', true, 'UTF-8', array(5, 5, 5, 5));
				return true;
		}
		public function predet_detail(){
			if (isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
					$this->data['datos'] = parent::detail_previo();
			}
			$this->load_view('predet-detail', $this->data);
			return true;
		}
	}
?>

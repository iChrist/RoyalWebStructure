<?php
	require_once(SYS_PATH.$_GET["sysModule"]."/model/".$_GET["sysModule"].".model.php");
	class Pre_Controller extends Pre_Model {

		// PRIVATE VARIABLES //
		/*private $_data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			if($this->is_view_required()){
				$this->load_view($_GET["sysFunction"], $this->_data);
			}
		}*/
		private $data = array();

		public function __construct(){
		parent::__construct();
		}

		public function __destruct(){

		}
		public function previos_index(){
				if(isset($_GET['axn'])){
						switch ($_GET['axn']) {
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
										$this->data['data'] = parent::read_previos();
										if(!$this->data['data']){
												header('Content-Type: application/json');
												echo json_encode($records);
												return false;
										}

										while($row = $this->data['data']->fetch_assoc()){
												$actions = $this->printModulesButtons(2,array($row['skSolicitudPrevio']),$row['skUsuarioCreacion']);
												array_push($records['data'], array(
													!empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
														 ,utf8_encode($row['Estatus'])
														,str_pad($row['ikSolicitudPrevio'], 7, "0", STR_PAD_LEFT)
														,utf8_encode($row['sReferencia'])
														,utf8_encode($row['dFechaSolicitud'])
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

			$this->load_model('cof', 'cof');
			$objUsuarios = new Cof_Model();
			$this->data['ejecutivos'] = $objUsuarios->read_user();
			$this->data['tramitadores'] = $objUsuarios->read_user();

			$this->previos['skSolicitudPrevio'] = !empty($_POST['skSolicitudPrevio']) ? $_POST['skSolicitudPrevio'] : substr(md5(microtime()), 1, 32);
			$this->previos['sReferencia'] = isset($_POST['sReferencia']) ? addslashes(utf8_decode($_POST['sReferencia'])) : null;
			$this->previos['sObservacionesSolicitud'] = isset($_POST['sObservacionesSolicitud']) ? addslashes(utf8_decode($_POST['sObservacionesSolicitud'])) : null;


			$this->data['autoridadesPrevios'] = parent::read_autoridades(); // Mandamos a llamar todos los perfiles para cargarlos en la vista
			$this->data['tiposPrevios'] = parent::read_tiposPrevios(); // Mandamos a llamar todos los perfiles para cargarlos en la vista
			if (isset($_GET['p1'])) {
					$this->previos['skSolicitudPrevio'] = $_GET['p1'];
					$this->data['datos'] = parent::read_previos();
			}
			$this->load_view('previos-form', $this->data);
			return true;


		}

	}
?>

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
					
					if(isset($_POST['skEmpresa'])){
						$this->recepciondocumentos['skEmpresa'] = $_POST['skEmpresa'];
					}
					if(isset($_POST['skTipoTramite'])){
						$this->recepciondocumentos['skTipoTramite'] = $_POST['skTipoTramite'];
					}
					if(isset($_POST['skTipoServicio'])){
						$this->recepciondocumentos['skTipoServicio'] = $_POST['skTipoServicio'];
					}
					if(isset($_POST['skClaveDocumento'])){
						$this->recepciondocumentos['skClaveDocumento'] = $_POST['skClaveDocumento'];
					}
					if(isset($_POST['skCorresponsalia'])){
						$this->recepciondocumentos['skCorresponsalia'] = $_POST['skCorresponsalia'];
					}
					if(isset($_POST['skStatus'])){
						$this->recepciondocumentos['skStatus'] = $_POST['skStatus'];
					}
					
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
					$this->data['data'] = parent::read_recepciondocumentos();
					
					if(!$this->data['data']){
						header('Content-Type: application/json');
						echo json_encode($records);
						return false;
					}
					 
					while($row = $this->data['data']->fetch_assoc()){
						$actions = $this->printModulesButtons(2,array($row['skRecepcionDocumento']));
						array_push($records['data'], array(
							 utf8_encode($row['sReferencia'])
							,utf8_encode($row['sPedimento'])
							,utf8_encode($row['TipoTramite'])
							,utf8_encode($row['TipoServicio'])
							,utf8_encode($row['Empresa'])
							,utf8_encode($row['ClaveDocumento'])
							,utf8_encode($row['Corresponsalia'])
							,utf8_encode($row['sMercancia'])
							,utf8_encode($row['sObservaciones'])
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
					
/*					$this->data['empresa'] = Cof_Model::read_status();
					$this->data['tipotramite'] = Cof_Model::read_status();
					$this->data['clavedocumento'] = Cof_Model::read_status();
					$this->data['coresponsalia'] = Cof_Model::read_status();
*/
 					$this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
					$this->data['empresas'] = $objEmpresa->read_empresa();
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
					$this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
					$this->data['empresas'] = $objEmpresa->read_empresa();
					$this->data['tipostramites'] = parent::read_tipos_tramites();
					$this->data['tiposservicios'] = parent::read_tipos_servicios();
					$this->data['clavedocumento'] = parent::read_clave_documento();
					$this->data['corresponsalia'] = parent::read_corresponsalia();
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
					$this->recepciondocumentos['skCorresponsalia'] = utf8_decode($_POST['skCorresponsalia']);
					
						if(empty($_POST['skRecepcionDocumento'])){
							if(parent::create_recepciondocumentos()){
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
					if(isset($_GET['p1'])){
					$this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
					$this->data['datos'] = parent::read_recepciondocumentos();
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

				/*TERMINA MODULO CAPTURA DE DOCUMENTOS */
	}
?>

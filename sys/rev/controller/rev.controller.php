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
					if(isset($_POST['skUsuarioTramitador'])){
						$this->solreva['skUsuarioTramitador'] = $_POST['skUsuarioTramitador'];
					}
					if(isset($_POST['skUsuarioRevalidacion'])){
						$this->solreva['skUsuarioRevalidacion'] = $_POST['skUsuarioRevalidacion'];
					}
					
					if(isset($_POST['sObservaciones'])){
						$this->solreva['sObservaciones'] = $_POST['sObservaciones'];
					}
					if(isset($_POST['skStatusRevalidacion'])){
						$this->solreva['skStatusRevalidacion'] = $_POST['skStatusRevalidacion'];
					}
					if(isset($_POST['skUsuarioRevalidacion'])){
						$this->solreva['skUsuarioRevalidacion'] = $_POST['skUsuarioRevalidacion'];
					}
					
					
					
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
							 utf8_encode($row['skEstatusRevalidacion'])
							 ,utf8_encode($row['sReferencia'])
 							,utf8_encode($row['EmpresaNaviera'])
							,utf8_encode($row['Tramitador'])
   							,utf8_encode($row['sObservaciones'])
							,utf8_encode($row['dFechaRevalidacion'])
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
					$objEmpresa->empresas['skTipoEmpresa'] = 'LINA';
					$this->data['empresas'] = $objEmpresa->read_like_empresas();
					$this->load_model('cof','cof');
					$objUsuarios = new Cof_Model();
					$this->data['tramitadores'] = $objUsuarios->read_user();
					

					// RETORNA LA VISTA areas-index.php //
					$this->load_view('solreva-index', $this->data);
					return true;
					}
					
					public function solreva_form(){ 
					$this->data['message'] = '';
					$this->data['response'] = true;
					$this->data['datos'] = false;
					$this->load_model('emp','emp');
					$objEmpresa = new Emp_Model();
					$objEmpresa->empresas['skTipoEmpresa'] = 'LINA';
					$this->data['empresas'] = $objEmpresa->read_like_empresas();
					
					$this->load_model('cof','cof');
					$objUsuarios = new Cof_Model();
					$this->data['tramitadores'] = $objUsuarios->read_user();
					
					if(isset($_POST['axn']))
                    	 {
                        	switch ($_POST['axn'])
		                        {
		                            case "retornarDatos":
		                                // echo 'false'; -> Email no encontrado 
		                                // echo 'true';  -> Email encontrado
										
		                                $this->solreva['sReferencia'] = htmlentities(($_POST['sReferencia']));
		                                $this->solreva['sCliente'] = htmlentities(($_POST['sReferencia']));
 		                                $this->data['datos']=parent::read_referencia();
 		                                if(parent::read_referencia())
		                                {
		                                    echo 'true';
		                                }
		                                else
		                                {
		                                    echo 'false';
		                                }
		                                exit;
		                            break;
		                            
		                            
		                        }
		                   }
					
 					if($_POST){
					//exit('</pre>'.print_r($_POST,1).'</pre>');
					$this->solreva['skSolicitudRevalidacion'] = !empty($_POST['skSolicitudRevalidacion']) ? $_POST['skSolicitudRevalidacion'] : substr(md5(microtime()), 1, 32);
					$this->solreva['sReferencia'] = utf8_decode($_POST['sReferencia']);
  					$this->solreva['sObservaciones'] = utf8_decode($_POST['sObservaciones']);
 					$this->solreva['skEmpresaNaviera'] = utf8_decode($_POST['skEmpresaNaviera']);
					$this->solreva['skUsuarioTramitador'] = utf8_decode($_POST['skUsuarioTramitador']);
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
					$this->solreva['skSolicitudRevalidacion'] = $_GET['p1'];
					$this->data['datos'] = parent::read_solreva();
					}
					$this->load_view('solreva-form', $this->data);
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

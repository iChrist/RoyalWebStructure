<?php
	require_once(SYS_PATH."con/model/con.model.php");
	Class Con_Controller Extends Con_Model {

		// PRIVATE VARIABLES //
                    private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){

		}

      /* COMIENZA MODULO conceptos */

      public function conceptos_index(){
          if(isset($_GET['axn'])){
              switch ($_GET['axn']) {
                  case 'pdf':
                      $this->conceptos_pdf();
                      break;
                  case 'fetch_all':
                      // PARAMETROS PARA FILTRADO //
                      if(isset($_POST['sNombre'])){
                          $this->conceptos['sNombre'] = $_POST['sNombre'];
                      }
                      if(isset($_POST['sNombreCorto'])){
                          $this->conceptos['sNombreCorto'] = $_POST['sNombreCorto'];
                      }
											if(isset($_POST['sDescripcion'])){
                          $this->conceptos['sDescripcion'] = $_POST['sDescripcion'];
                      }
                      if(isset($_POST['skStatus'])){
                          $this->conceptos['skStatus'] = $_POST['skStatus'];
                      }

                      // OBTENER REGISTROS //
                      $total = parent::count_conceptos();
                      $records = Core_Functions::table_ajax($total);
                      if($records['recordsTotal'] === 0){
                          header('Content-Type: application/json');
                          echo json_encode($records);
                          return false;
                      }

                      $this->conceptos['limit'] = $records['limit'];
                      $this->conceptos['offset'] = $records['offset'];
                      $this->data['data'] = parent::read_like_conceptos();

                      if(!$this->data['data']){
                          header('Content-Type: application/json');
                          echo json_encode($records);
                          return false;
                      }

                      while($row = $this->data['data']->fetch_assoc()){
                          $actions = $this->printModulesButtons(2,array($row['skConcepto']));
                          array_push($records['data'], array(
                               utf8_encode($row['sNombre'])
                              ,utf8_encode($row['sNombreCorto'])
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

          // RETORNA LA VISTA conceptos-index.php //
          $this->load_view('conceptos-index', $this->data);
          return true;
      }


      public function conceptos_form(){
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
              $this->conceptos['skConcepto'] = !empty($_POST['skConcepto']) ? $_POST['skConcepto'] : substr(md5(microtime()), 1, 32);
							$this->conceptos['sNombre'] = utf8_decode($_POST['sNombre']);
							$this->conceptos['sNombreCorto'] = utf8_decode($_POST['sNombreCorto']);
							$this->conceptos['sDescripcion'] = utf8_decode($_POST['sDescripcion']);
							$this->conceptos['fPrecioUnitario'] = utf8_decode($_POST['fPrecioUnitario']);
							$this->conceptos['skDivisa'] = utf8_decode($_POST['skDivisa']);
              $this->conceptos['skStatus'] = utf8_decode($_POST['skStatus']);
              if(empty($_POST['skConcepto'])){
                  if(parent::create_conceptos()){


									if(isset($_POST['skTipoTramite'])) // En esta parte guardaremos todos los tipos de tramite seleccionados para el nuevo concepto.
									{
										$count = count($_POST['skTipoTramite']);
										$bandera = 1;
										$valores = "";
										foreach ($_POST['skTipoTramite'] as $tramite)
										{
											if( $bandera == $count )
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$tramite."')";
											}
											else
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$tramite."'),";
											}
											$bandera++;
										}
										$rRespuesta = parent::create_tramite_concepto($valores);
									}

									if(isset($_POST['skTipoEmpresa'])) // En esta parte guardaremos todos los tipos de empresa seleccionados para el nuevo concepto.
									{
										$count = count($_POST['skTipoEmpresa']);
										$bandera = 1;
										$valores = "";
										foreach ($_POST['skTipoEmpresa'] as $empresa)
										{
											if( $bandera == $count )
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$empresa."')";
											}
											else
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$empresa."'),";
											}
											$bandera++;
										}
										$rRespuesta = parent::create_empresas_concepto($valores);
									}

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
                  if(parent::update_conceptos()){


									if(isset($_POST['skTipoTramite'])) // En esta parte guardaremos todos los tipos de tramite seleccionados para el nuevo concepto.
									{
										$count = count($_POST['skTipoTramite']);
										$bandera = 1;
										$valores = "";
										foreach ($_POST['skTipoTramite'] as $tramite)
										{
											if( $bandera == $count )
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$tramite."')";
											}
											else
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$tramite."'),";
											}
											$bandera++;
										}
										$rRespuesta = parent::create_tramite_concepto($valores);
									}

									if(isset($_POST['skTipoEmpresa'])) // En esta parte guardaremos todos los tipos de empresa seleccionados para el nuevo concepto.
									{
										$count = count($_POST['skTipoEmpresa']);
										$bandera = 1;
										$valores = "";
										foreach ($_POST['skTipoEmpresa'] as $empresa)
										{
											if( $bandera == $count )
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$empresa."')";
											}
											else
											{
												$valores .= "('".$this->conceptos['skConcepto']."' , '".$empresa."'),";
											}
											$bandera++;
										}
										$rRespuesta = parent::create_empresas_concepto($valores);
									}
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
              $this->conceptos['skConcepto'] = $_GET['p1'];
							$this->data['datos'] = parent::read_equal_conceptos();
							$this->data['tramitesconceptos'] = parent::read_tramites_conceptos();
							$this->data['empresasconceptos'] = parent::read_empresas_conceptos();
          }
          $this->load_view('conceptos-form', $this->data);
          return true;
      }

      public function conceptos_detail(){
          if(isset($_GET['p1'])){
              $this->conceptos['skConcepto'] = $_GET['p1'];
              $this->data['datos'] = parent::read_equal_conceptos();
          }
          if(isset($_GET['axn'])){
              switch ($_GET['axn']) {
                  case 'pdf':
                      $this->conceptos_pdf();
                      break;
              }
          }
          $this->load_view('conceptos-detail', $this->data);
          return true;
      }

      private function conceptos_pdf(){
          if(isset($_GET['p1'])){
              $this->conceptos['skConcepto'] = $_GET['p1'];
              $this->data['datos'] = parent::read_equal_conceptos();
          }
          ob_start();
          $this->load_view('conceptos-pdf', $this->data, FALSE, 'emp/pdf/');
          $content = ob_get_clean();
          $title = 'Conceptos';
          Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
          return true;
      }
      /* TERMINA MODULO Conceptos */



	}
?>

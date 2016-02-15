<?php
    require_once(SYS_PATH."glo/model/glo.model.php");
    Class glo_Controller Extends glo_Model {

            // PRIVATE VARIABLES //
                private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
				/*COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */
 
            public function glo_index(){
                if(isset($_GET['axn'])){
                    switch ($_GET['axn']) {
                        case 'pdf':
                            $this->glo_pdf();
                            break;
                        case 'delete':
                            $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                            $this->data['response'] = false;
                            $this->data['datos'] = false;
                            if(isset($_GET['p1'])){
                                $this->glo['skGlosa'] = $_GET['p1'];
                                if($this->delete_glo()){
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
                            if(!empty($_POST['skGlosa'])){
                                $this->glo['skGlosa'] = $_POST['skGlosa'];
                            }
                            if(!empty($_POST['sReferencia'])){
                                $this->glo['sReferencia'] = addslashes(utf8_decode($_POST['sReferencia']));
                            }
                            if(!empty($_POST['sObservacionesPedimento'])){
                                $this->glo['sObservacionesPedimento'] = addslashes(utf8_decode($_POST['sObservacionesPedimento']));
                            }
                            if(!empty($_POST['skUserCreacion'])){
                                $this->glo['skUserCreacion'] = $_POST['skUserCreacion'];
                            }
                            if(!empty($_POST['dFechaCreacion'])){
                                $this->glo['dFechaCreacion'] = date('Y-m-d',  strtotime($_POST['dFechaCreacion']));
                            }

                            if(!empty($_POST['skEmpresa'])){
                                $this->glo['skEmpresa'] = $_POST['skEmpresa'];
                            }

                            $this->glo['skStatus'] = 'AC';
                            //exit('<pre>'.print_r($this->glo,1).'</pre>');
                            // OBTENER REGISTROS //
                            $total = parent::count_glo();
                            $records = Core_Functions::table_ajax($total);
                            if($records['recordsTotal'] === 0){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            $this->glo['limit'] = $records['limit'];
                            $this->glo['offset'] = $records['offset'];
                            $this->data['data'] = parent::read_glo();
                            if(!$this->data['data']){
                                header('Content-Type: application/json');
                                echo json_encode($records);
                                return false;
                            }
                            while($row = $this->data['data']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skGlosa']),$row['skUserCreacion']);
                                array_push($records['data'], array(
                                     utf8_encode($row['sReferencia'])
                                    ,utf8_encode($row['cliente'])
                                    ,utf8_encode($row['sObservacionesPedimento'])
                                    ,utf8_encode($row['autor'])
                                    ,utf8_encode($row['dFechaCreacion'])
                                   ,!empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
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

                // RETORNA LA VISTA glo-index.php //
                $this->load_view('glo-index', $this->data);
                return true;
            }
            
            public function glo_form(){ 
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
                        case "getSecuencia":
                            $this->load_model('cla','cla');  
                            $cla = new Cla_Model();
                            $cla->cla['sReferencia'] = $_POST['sReferencia'];
                            $cla->claMer['iSecuencia'] = $_POST['iSecuencia'];
                            $this->data['data'] = $cla->read_like_claMer();
                            if(!$this->data['data']){
                                $this->data['response'] = false;
                                $this->data['datos'] = false;
                                return false;
                            }
                            $result = array();
                            while($row = $this->data['data']->fetch_assoc()){
                               $result = array(
                                     "skClasificacion"=>utf8_encode($row['skClasificacion'])
                                    ,"sFraccion"=>utf8_encode($row['sFraccion'])
                                    ,"sDescripcion"=>utf8_encode($row['sDescripcion'])
                                    ,"sDescripcionIngles"=>utf8_encode($row['sDescripcionIngles'])
                                    ,"sNumeroParte"=>utf8_encode($row['sNumeroParte'])
                                    ,"iSecuencia"=>utf8_encode($row['iSecuencia'])
                                );
                            }
                            header('Content-Type: application/json');
                            echo json_encode($result);
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
                            //exit(print_r($_POST,1));
                            $this->glo['skGlosa'] = !empty($_POST['skGlosa']) ? $_POST['skGlosa'] : substr(md5(microtime()), 1, 32);
                            $this->glo['sReferencia'] = !empty($_POST['sReferencia']) ? addslashes(utf8_decode($_POST['sReferencia'])) : null;
                            $this->glo['sObservacionesPedimento'] = !empty($_POST['sObservacionesPedimento']) ? addslashes(utf8_decode($_POST['sObservacionesPedimento'])) : null;
                            // DEFAULT //
                            if(empty($_POST['skGlosa'])){
								$this->data['message'] = 'Registro guardado con &eacute;xito.';
                                // CREATE //
                                if(!parent::create_glo()){
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                }else{
                                    $this->gloDocGlo['skGlosa'] = $this->glo['skGlosa'];
                                    // DOCUMENTOS FALTANTES PARA GLOSA (gloDocGlo) //
                                    parent::delete_gloDocGlo();
                                    if(!empty($_POST['docGlo'])){
                                        foreach($_POST['docGlo'] AS $k=>$v){
                                            $this->gloDocGlo['skDocGlosa'] = $v;
                                            parent::create_gloDocGlo();
                                        }
                                    }
									$this->gloPart['skGlosa'] = $this->glo['skGlosa'];
                                    // OBSERVACIONES A NIVEL PARTIDA (gloPart) //
                                    parent::delete_gloPart();
                                    if(!empty($_POST['sObservacionesPartida'])){
                                        foreach($_POST['sObservacionesPartida'] AS $k=>$v){
                                            $this->gloPart['skClasificacionMercancia'] =  !empty($_POST['skClasificacionMercancia']) ? $_POST['skClasificacionMercancia'] : null;
                                            $this->gloPart['sObservacionesPartida'] = $v['sObservacionesPartida'];
                                            parent::create_gloPart();
                                        }
                                    }
                                }
                            }else{
                                // UPDATE //
                            $this->data['message'] = 'Registro Actualizado con &eacute;xito.';
							
                                if(!parent::update_glo()){
                                    $this->data['response'] = false;
                                    $this->data['message'] = 'Hubo un error al intentar guardar el registro, intenta de nuevo.';
                                }else{
                                    $this->gloDocGlo['skGlosa'] = $this->glo['skGlosa'];
                                    // DOCUMENTOS FALTANTES PARA GLOSA (gloDocGlo) //
                                    parent::delete_gloDocGlo();
                                    if(!empty($_POST['docGlo'])){
                                        foreach($_POST['docGlo'] AS $k=>$v){
                                            $this->gloDocGlo['skDocGlosa'] = $v;
                                            parent::create_gloDocGlo();
                                        }
                                    }
									$this->gloPart['skGlosa'] = $this->glo['skGlosa'];
                                    // OBSERVACIONES A NIVEL PARTIDA (gloPart) //
                                    parent::delete_gloPart();
                                    if(!empty($_POST['sObservacionesPartida'])){
                                        foreach($_POST['c'] AS $k=>$v){
                                            $this->gloPart['skClasificacionMercancia'] =  (!empty($_POST['skClasificacionMercancia']) ? $_POST['skClasificacionMercancia'] : null);
                                            $this->gloPart['sObservacionesPartida'] = $v;
                                            parent::create_gloPart();
                                        }
                                    }
                                }
                            }
                            header('Content-Type: application/json');
                            echo json_encode($this->data);
                            return true;
                            break;
                    }
                }

                // cat_docGlosa //
                $this->docGlo['skStatus'] = 'AC';
                $this->docGlo['orderBy'] = 'docGlo.iPosition';
                $this->docGlo['sortBy'] = 'ASC';
                $docGlo = parent::read_docGlo();
                $r_docGlo = array();
                if($docGlo){
                    $i = 0;
                    while($r = $docGlo->fetch_assoc()){
                        $r_docGlo[$i] = array(
                             "skDocGlosa"=>utf8_encode($r['skDocGlosa'])
                            ,"skParent"=>utf8_encode($r['skParent'])
                            ,"sNombre"=>utf8_encode($r['sNombre'])
                            ,'children'=>array()
                        );
                        $this->docGlo['skParent'] = $r['skDocGlosa'];
                        $p_docGlo = parent::read_docGlo();
                        if($p_docGlo){
                            $temp = array();
                            $x = 0;
                            while($p = $p_docGlo->fetch_assoc()){
                                array_push($r_docGlo[$i]['children'] , array(
                                     "skDocGlosa"=>utf8_encode($p['skDocGlosa'])
                                    ,"skParent"=>utf8_encode($p['skParent'])
                                    ,"sNombre"=>utf8_encode($p['sNombre'])
                                ));
                            }
                        }
                        $i++;
                    }
                }
                $this->data['docGlo'] = $r_docGlo;
				
				$this->gloPart['skGlosa'] = $_GET['p1'];
				$gloPart = parent::read_gloPart();
                $r_gloPart = array();
                if($gloPart){
                    $i = 0;
                    while($r = $gloPart->fetch_assoc()){
                        $r_gloPart[$i] = array(
                             "skGlosa"=>utf8_encode($r['skGlosa'])
                            ,"skClasificacionMercancia"=>utf8_encode($r['skClasificacionMercancia'])
                            ,"sObservacionesPartida"=>utf8_encode($r['sObservacionesPartida'])
                         );
 
                        $i++;
                    }
                }
                $this->data['gloPart'] = $r_gloPart;
				
                //exit('<pre>'.print_r($this->data['docGlo'],1));
                
                if(isset($_GET['p1'])){
                    $this->glo['skGlosa'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_glo();
                }
                $this->load_view('glo-form', $this->data);
                return true;
            }
                        
            private function glo_pdf(){
                if(isset($_GET['p1'])){
                    $this->glo['skGlosa'] = $_GET['p1'];
                    $this->data['datos'] = parent::read_glo();
                }
                ob_start();
                $this->load_view('glo-pdf', $this->data, FALSE, 'glo/pdf/');
                $content = ob_get_clean();
                $title = 'DATOS DE gloFORMA';
                Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
                return true;
            }
					
                                    
	}
?>

<?php
    require_once(SYS_PATH.$_GET['sysModule'].'/model/'.$_GET['sysModule'].'.model.php');
    Class Cla_Controller Extends Cla_Model {
        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
                parent::__construct();
        }

        public function __destruct(){

        }

        /* COMIENZA MODULO clasifiación arancelaria */
        public function claara_index(){
            //exit('<pre>'.print_r($_GET,1).'</pre>');
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'pdf':
                        $this->claara_pdf();
                        break;
                    case 'fetch_all':
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sNombre'])){
                            $this->numPar['sNombre'] = $_POST['sNombre'];
                        }
                        if(isset($_POST['sDescripcion'])){
                            $this->numPar['sDescripcion'] = $_POST['sDescripcion'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->numPar['skStatus'] = $_POST['skStatus'];
                        }

                        // OBTENER REGISTROS //
                        $total = parent::count_numerosParte();
                        $records = Core_Functions::table_ajax($total);
                        if($records['recordsTotal'] === 0){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }

                        $this->numPar['limit'] = $records['limit'];
                        $this->numPar['offset'] = $records['offset'];
                        $this->data['data'] = parent::read_like_numerosParte();

                        if(!$this->data['data']){
                            header('Content-Type: application/json');
                            echo json_encode($records);
                            return false;
                        }

                        while($row = $this->data['data']->fetch_assoc()){
                            $actions = $this->printModulesButtons(2,array($row['skNumeroParte']));
                            array_push($records['data'], array(
                                 utf8_encode($row['sNombre'])
                                ,utf8_encode($row['sDescripcion'])
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
            $this->data['status'] = Cof_Model::read_status();
            
            // RETORNA LA VISTA >numPar-index.php //
            $this->load_view('claara-index', $this->data);
            return true;
        }
        
        public function claara_form(){
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_POST['axn'])){
                if($_POST['axn']=='listImg'){
                    $this->desArc['skFraccionArancelariaDescripcion'] = $_POST['skFraccionArancelariaDescripcion'];
                    $desArc = parent::read_equal_desArc();
                    $datos = array();
                    if(!$desArc){
                        header('Content-Type: application/json');
                        echo json_encode($datos);
                        return false;
                    }
                    while($_desArc = $desArc->fetch_assoc()){
                        $datos[] = array(
                             'src'=>utf8_encode(SYS_URL.$_GET['sysProject'].'/'.$_GET['sysModule'].'/files/claara-form/'.$_desArc['skFraccionArancelariaDescripcion'].'/'.$_desArc['sArchivo'])
                            ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                        );    
                    }
                    header('Content-Type: application/json');
                    echo json_encode($datos);
                    return true;
                }
            }
            if(isset($_GET['p2'])){
                $imagePath = isset($_GET['url']) ? $_GET['url'] : FALSE;
                $width = isset($_GET['width']) ? $_GET['width'] : 100;
                $height = isset($_GET['height']) ? $_GET['height'] : 100;	
                $imagePath = 'http://vision7.com.mx/admin/files/banner/1737876976dannycapdam.jpg';
                Core_Functions::thumbnailImage($imagePath,$width,$height);
                return true;
            }
            if(isset($_GET['p1'])){
                // OBTENER NUMERO DE PARTE //
                 $this->numPar['skNumeroParte'] = $_GET['p1'];
                $numPar = parent::read_equal_numPar();
                if($numPar){
                    $this->data['datos'] = $this->getNumeroParte();
                }
            }
          //  $this->load_view('claara-form', $this->data);
           // return true;

            if($_POST){
             	$this->numPar['skNumeroParte'] = !empty($_POST['skNumeroParte']) ? $_POST['skNumeroParte'] : substr(md5(microtime()), 1, 32);
                $this->numPar['sNombre'] = !empty($_POST['sNombre']) ? utf8_decode($_POST['sNombre']) : NULL ;
                $this->numPar['sDescripcion'] = !empty($_POST['sDescripcion']) ? utf8_decode($_POST['sDescripcion']) : NULL ;
                $this->numPar['skStatus'] = !empty($_POST['skStatus']) ? utf8_decode($_POST['skStatus']) : 'IN' ;
                $this->numPar['dFechaCreacion'] = 'CURRENT_TIMESTAMP';
                $this->numPar['skUsersCreacion'] = $_SESSION['session']['skUsers'];
               

                if(empty($_POST['skNumeroParte'])){
                  $flag = false;
                  $skNumeroParte = parent::create_cat_numeroParte();
                  if($skNumeroParte){
                    foreach($_POST['fraccionArancelaria'] as $campo=>$valor){
                        $this->numparfraran['skFraccionArancelaria'] = !empty($_POST['skFraccionArancelaria']) ? $_POST['skFraccionArancelaria'] : substr(md5(microtime()), 1, 32);
                        $this->numparfraran['skNumeroParte'] =  $this->numPar['skNumeroParte'] ;
                        $this->numparfraran['skStatus'] =  'AC' ;
                        $this->numparfraran['skUsersCreacion'] =  $this->numPar['skUsersCreacion'] ;
                        $this->numparfraran['sNombre'] = !empty($_POST['fraccionArancelaria'][$campo]['sNombre']) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sNombre']) : NULL ;
                        $skFraccionArancelaria = parent::create_cat_numparfraran();
                      if($skFraccionArancelaria){
                        if(isset($_POST['fraccionArancelaria'][$campo]['sDescripcion'])){   
                          foreach(($_POST['fraccionArancelaria'][$campo]['sDescripcion']) as $campo2=>$valor2){
                            $this->fraAraDes['skFraccionArancelariaDescripcion'] = !empty($_POST['skFraccionArancelariaDescripcion']) ? $_POST['skFraccionArancelariaDescripcion'] : substr(md5(microtime()), 1, 32);
                            $this->fraAraDes['skFraccionArancelaria'] =  $this->numparfraran['skFraccionArancelaria'] ;
                            $this->fraAraDes['skUsersCreacion'] =  $this->numparfraran['skUsersCreacion'] ;
                            $this->fraAraDes['sDescripcion'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) : NULL ;
                            $this->fraAraDes['sDescripcionIngles'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) : NULL ;
                            $skFraccionArancelariaDescripcion = parent::create_cat_fraccionesArancelarias_descripcionFraccion();    
                            //ARCHIVOS
                            if(isset($_FILES['fraccionArancelaria']['name'][$campo]['archivos'][$campo2])){
                              foreach($_FILES['fraccionArancelaria']['name'][$campo]['archivos'][$campo2] as $campo3=>$valor3){                                     
                                $this->desArc['skArchivoFraccionArancelaria'] = !empty($_FILES['skArchivoFraccionArancelaria']) ? $_FILES['skArchivoFraccionArancelaria'] : substr(md5(microtime()), 1, 32);
                                $this->desArc['skFraccionArancelariaDescripcion'] =  $this->fraAraDes['skFraccionArancelariaDescripcion'] ;
                                $this->desArc['sArchivo'] =  $_FILES['fraccionArancelaria']['name'][$campo]['archivos'][$campo2][$campo3] ;                             
                                // ESTA ES LA RUTA DONDE SE GUARDARAN LOS ARCHIVOS DEL MODULO (claara-form) //
                                $serv = SYS_PATH.$_GET['sysModule'].'/files/claara-form/';
                                //echo $serv;
                                $ruta = $serv .$this->desArc['skFraccionArancelariaDescripcion'];
                                if(!file_exists($ruta)){ 
                                  mkdir ($ruta,0777,true);
                                }
                                if (is_uploaded_file($_FILES['fraccionArancelaria']['tmp_name'][$campo]['archivos'][$campo][$campo3])){
                                  $nombreDirectorio = $ruta;
                                  $nombreFichero = $_FILES['fraccionArancelaria']['name'][$campo]['archivos'][$campo][$campo3];
                                  // echo "nombre Directorio: ".$nombreDirectorio;
                                  // echo "nombre Fichero: ".$nombreFichero;
                                  $nombreCompleto = $nombreFichero;

                                  $idUnico = time();
                                  $nombreFichero = $idUnico . "-" . $nombreFichero;

                                  move_uploaded_file($_FILES['fraccionArancelaria']['tmp_name'][$campo]['archivos'][$campo][$campo3], $nombreDirectorio."/".$nombreFichero);
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                  if($flag){
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
                  $skNumeroParte = parent::update_cat_numeros_partes();
                  if($skNumeroParte){
                    foreach($_POST['fraccionArancelaria'] as $campo=>$valor){
                      $this->numparfraran['skFraccionArancelaria'] = !empty($_POST['skFraccionArancelaria']) ? $_POST['skFraccionArancelaria'] : substr(md5(microtime()), 1, 32);
                      $this->numparfraran['skNumeroParte'] =  $this->numPar['skNumeroParte'] ;
                      $this->numparfraran['skStatus'] =  'AC' ;
                      $this->numparfraran['skUsersCreacion'] =  $this->numPar['skUsersCreacion'] ;
                      $this->numparfraran['sNombre'] = !empty($_POST['fraccionArancelaria'][$campo]['sNombre']) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sNombre']) : NULL ;            
                      if(empty($_POST['skFraccionArancelaria'])){
                        $skFraccionArancelaria = parent::create_cat_numparfraran();
                        if($skFraccionArancelaria){
                        
                        if(isset($_POST['fraccionArancelaria'][$campo]['sDescripcion'])){   
                          foreach(($_POST['fraccionArancelaria'][$campo]['sDescripcion']) as $campo2=>$valor2){
                          
                          $this->fraAraDes['skFraccionArancelariaDescripcion'] = !empty($_POST['skFraccionArancelariaDescripcion']) ? $_POST['skFraccionArancelariaDescripcion'] : substr(md5(microtime()), 1, 32);
                            $this->fraAraDes['skFraccionArancelaria'] =  $this->numparfraran['skFraccionArancelaria'] ;
                            $this->fraAraDes['skUsersCreacion'] =  $this->numparfraran['skUsersCreacion'] ;
                            $this->fraAraDes['sDescripcion'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) : NULL ;
                            $this->fraAraDes['sDescripcionIngles'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) : NULL ;
                            
                            
                            if(empty($_POST['skFraccionArancelariaDescripcion'])){
                            $skFraccionArancelariaDescripcion = parent::create_cat_fraccionesArancelarias_descripcionFraccion(); 
                               
                           
                            }else{
                            $skFraccionArancelariaDescripcion = parent::update_cat_fraccionesArancelarias_descripcionFraccion(); 

 	                            
                            }
                            //ARCHIVOS
                          
                          
                          }
                        }
                        
                        
                        
                        
                        
                        }            
                      }else{
                        $skFraccionArancelaria = parent::update_numparfraran();
                        if($skFraccionArancelaria){
                        
                        if(isset($_POST['fraccionArancelaria'][$campo]['sDescripcion'])){   
                          foreach(($_POST['fraccionArancelaria'][$campo]['sDescripcion']) as $campo2=>$valor2){
                          
                          $this->fraAraDes['skFraccionArancelariaDescripcion'] = !empty($_POST['skFraccionArancelariaDescripcion']) ? $_POST['skFraccionArancelariaDescripcion'] : substr(md5(microtime()), 1, 32);
                            $this->fraAraDes['skFraccionArancelaria'] =  $this->numparfraran['skFraccionArancelaria'] ;
                            $this->fraAraDes['skUsersCreacion'] =  $this->numparfraran['skUsersCreacion'] ;
                            $this->fraAraDes['sDescripcion'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) : NULL ;
                            $this->fraAraDes['sDescripcionIngles'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) : NULL ;
                            
                            
                            if(empty($_POST['skFraccionArancelariaDescripcion'])){
                            $skFraccionArancelariaDescripcion = parent::create_cat_fraccionesArancelarias_descripcionFraccion(); 
                               
                           
                            }else{
                            $skFraccionArancelariaDescripcion = parent::update_cat_fraccionesArancelarias_descripcionFraccion(); 

 	                            
                            }
                            //ARCHIVOS
                          
                          
                          }
                        }
                        
                        
                        
                        

                        }
                      }
                    }
                  }
                  // HACEMOS TRANSACIÓN AQUÍ //
                  $flag = true;
                  if($flag){
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
        }
        
        // OBTENER NUMERO DE PARTE //
        private function getNumeroParte(){
            $datos = array();
            $this->numPar['skNumeroParte'] = $_GET['p1'];
            $numPar = parent::read_equal_numPar();
            if($numPar){
                $a = 0;
                while($_numPar = $numPar->fetch_assoc()){
                    $datos['numPar'] = array(
                         'skNumeroParte'=>utf8_encode($_numPar['skNumeroParte'])
                        ,'sNombre'=>utf8_encode($_numPar['sNombre'])
                        ,'sDescripcion'=>utf8_encode($_numPar['sDescripcion'])
                        ,'skStatus'=>utf8_encode($_numPar['skStatus'])
                        ,'dFechaCreacion'=>!empty($_numPar['dFechaCreacion']) ? date("d-m-Y", strtotime($_numPar['dFechaCreacion'])) : ''
                        ,'skUsersCreacion'=>utf8_encode($_numPar['skUsersCreacion'])
                        ,'dFechaModificacion'=>!empty($_numPar['dFechaModificacion']) ? date("d-m-Y", strtotime($_numPar['dFechaModificacion'])) : ''
                        ,'skUsersModificacion'=>utf8_encode($_numPar['skUsersModificacion'])
                        ,'htmlStatus'=>utf8_encode($_numPar['htmlStatus'])
                    );
                    // OBTENER FRACCIONES ARANCELARIAS //
                    $this->numparfraran['skNumeroParte'] = $_numPar['skNumeroParte'];
                    $numparfraran = parent::read_equal_numparfraran();
                    if(!$numparfraran){ continue; }
                    $b = 0;
                    while($_numparfraran = $numparfraran->fetch_assoc()){
                        $datos['numPar']['numparfraran'][$b] = array(
                             'skFraccionArancelaria'=>utf8_encode($_numparfraran['skFraccionArancelaria'])
                            ,'skNumeroParte'=>utf8_encode($_numparfraran['skNumeroParte'])
                            ,'sNombre'=>utf8_encode($_numparfraran['sNombre'])
                            ,'skStatus'=>utf8_encode($_numparfraran['skStatus'])
                            ,'dFechaCreacion'=>!empty($_numparfraran['dFechaCreacion']) ? date("d-m-Y", strtotime($_numparfraran['dFechaCreacion'])) : ''
                            ,'skUsersCreacion'=>utf8_encode($_numparfraran['skUsersCreacion'])
                            ,'dFechaModificacion'=>!empty($_numparfraran['dFechaModificacion']) ? date("d-m-Y", strtotime($_numparfraran['dFechaModificacion'])) : ''
                            ,'skUsersModificacion'=>utf8_encode($_numparfraran['skUsersModificacion'])
                        );
                        $this->fraAraDes['skFraccionArancelaria'] = $_numparfraran['skFraccionArancelaria'];
                        $fraAraDes = parent::read_equal_fraAraDes();
                        if(!$fraAraDes){ continue; }
                        $c = 0;
                        while($_fraAraDes = $fraAraDes->fetch_assoc()){
                            $datos['numPar']['numparfraran'][$b]['fraAraDes'][$c] = array(
                                 'skFraccionArancelariaDescripcion'=>utf8_encode($_fraAraDes['skFraccionArancelariaDescripcion'])
                                ,'skFraccionArancelaria'=>utf8_encode($_fraAraDes['skFraccionArancelaria'])
                                ,'sDescripcion'=>utf8_encode($_fraAraDes['sDescripcion'])
                                ,'sDescripcionIngles'=>utf8_encode($_fraAraDes['sDescripcionIngles'])
                                ,'sModelo'=>utf8_encode($_fraAraDes['sModelo'])
                                ,'skStatus'=>utf8_encode($_fraAraDes['skStatus'])
                                ,'dFechaCreacion'=>!empty($_fraAraDes['dFechaCreacion']) ? date("d-m-Y", strtotime($_fraAraDes['dFechaCreacion'])) : ''
                                ,'skUsersCreacion'=>utf8_encode($_fraAraDes['skUsersCreacion'])
                                ,'dFechaModificacion'=>!empty($_fraAraDes['dFechaModificacion']) ? date("d-m-Y", strtotime($_fraAraDes['dFechaModificacion'])) : ''
                                ,'skUsersModificacion'=>utf8_encode($_fraAraDes['skUsersModificacion'])
                            );
                            $this->desArc['skFraccionArancelariaDescripcion'] = $_fraAraDes['skFraccionArancelariaDescripcion'];
                            $desArc = parent::read_equal_desArc();
                            if(!$desArc){ continue; }
                            $d = 0;
                            while($_desArc = $desArc->fetch_assoc()){
                                $datos['numPar']['numparfraran'][$b]['fraAraDes'][$c]['desArc'][$d] = array(
                                     'skArchivoFraccionArancelaria'=>utf8_encode($_desArc['skArchivoFraccionArancelaria'])
                                    ,'skFraccionArancelariaDescripcion'=>utf8_encode($_desArc['skFraccionArancelariaDescripcion'])
                                    ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                                    ,'skStatus'=>utf8_encode($_desArc['skStatus'])
                                );
                                $d++;     
                            }
                            $c++;
                        }
                        $b++;
                    }
                    $a++;
                }
            }
            return $datos;
        }
        
        public function claara_detail(){
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_GET['p1'])){
                // OBTENER NUMERO DE PARTE //
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $numPar = parent::read_equal_numPar();
                if($numPar){
                    $this->data['datos'] = $this->getNumeroParte();
                }
            }
            //exit('<pre>'.print_r($this->data['datos'],1).'</pre>');
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'listImg':
                        $this->desArc['skFraccionArancelariaDescripcion'] = $_POST['skFraccionArancelariaDescripcion'];
                        $desArc = parent::read_equal_desArc();
                        $datos = array();
                        if(!$desArc){
                            header('Content-Type: application/json');
                            echo json_encode($datos);
                            return false;
                        }
                        while($_desArc = $desArc->fetch_assoc()){
                            $datos[] = array(
                                 'src'=>utf8_encode(SYS_URL.$_GET['sysProject'].'/'.$_GET['sysModule'].'/files/claara-form/'.$_desArc['skFraccionArancelariaDescripcion'].'/'.$_desArc['sArchivo'])
                                ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                            );    
                        }
                        header('Content-Type: application/json');
                        echo json_encode($datos);
                        return true;
                    break;
                    case 'pdf':
                        $this->claara_pdf();
                    break;
                }
            }

            if(isset($_POST['axn'])){
                if($_POST['axn']=='listImg'){
                    $this->desArc['skFraccionArancelariaDescripcion'] = $_POST['skFraccionArancelariaDescripcion'];
                    $desArc = parent::read_equal_desArc();
                    $datos = array();
                    if(!$desArc){
                        header('Content-Type: application/json');
                        echo json_encode($datos);
                        return false;
                    }
                    while($_desArc = $desArc->fetch_assoc()){
                        $datos[] = array(
                             'src'=>utf8_encode(SYS_URL.$_GET['sysProject'].'/'.$_GET['sysModule'].'/files/claara-form/'.$_desArc['skFraccionArancelariaDescripcion'].'/'.$_desArc['sArchivo'])
                            ,'sArchivo'=>utf8_encode($_desArc['sArchivo'])
                        );    
                    }
                    header('Content-Type: application/json');
                    echo json_encode($datos);
                    return true;
                }
            }

            $this->load_view('claara-detail', $this->data);
            return true;
        }

        private function claara_pdf(){
            if(isset($_GET['p1'])){
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $this->data['datos'] = parent::read_equal_numPar();
            }
            ob_start();
            $this->load_view('cla-pdf', $this->data, FALSE, 'cla/pdf/');
            $content = ob_get_clean();
            $title = '>numPar';
            Core_Functions::pdf($content, $title, 'P', 'A4', 'es', true, 'UTF-8', array(3, 3, 3, 3));
            return true;
        }
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */    
    }
?>

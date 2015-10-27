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
            if($_POST){ exit('<pre>'.print_r($_FILES,1).'</pre>'); }
            $this->data['message'] = '';
            $this->data['response'] = true;
            $this->data['datos'] = false;
            if(isset($_GET['p1'])){
                // OBTENER NUMERO DE PARTE //
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $numPar = parent::read_equal_numPar();
                if($numPar){
                    $datos = array();
                    $a = 0;
                    while($_numPar = $numPar->fetch_assoc()){
                        $datos['numPar'][$a] = array(
                             utf8_encode($_numPar['skNumeroParte'])
                            ,utf8_encode($_numPar['sNombre'])
                            ,utf8_encode($_numPar['sDescripcion'])
                            ,utf8_encode($_numPar['skStatus'])
                            ,!empty($_numPar['dFechaCreacion']) ? date("d-m-Y", strtotime($_numPar['dFechaCreacion'])) : ''
                            ,utf8_encode($_numPar['skUsersCreacion'])
                            ,!empty($_numPar['dFechaModificacion']) ? date("d-m-Y", strtotime($_numPar['dFechaModificacion'])) : ''
                            ,utf8_encode($_numPar['skUsersModificacion'])
                        );
                        // OBTENER FRACCIONES ARANCELARIAS //
                        $this->numparfraran['skNumeroParte'] = $_numPar['skNumeroParte'];
                        $numparfraran = parent::read_equal_numparfraran();
                        if(!$numparfraran){ continue; }
                        $b = 0;
                        while($_numparfraran = $numparfraran->fetch_assoc()){
                            $datos['numPar'][$a]['numparfraran'][$b] = array(
                                 utf8_encode($_numparfraran['skFraccionArancelaria'])
                                ,utf8_encode($_numparfraran['skNumeroParte'])
                                ,utf8_encode($_numparfraran['sNombre'])
                                ,utf8_encode($_numparfraran['skStatus'])
                                ,!empty($_numparfraran['dFechaCreacion']) ? date("d-m-Y", strtotime($_numparfraran['dFechaCreacion'])) : ''
                                ,utf8_encode($_numparfraran['skUsersCreacion'])
                                ,!empty($_numparfraran['dFechaModificacion']) ? date("d-m-Y", strtotime($_numparfraran['dFechaModificacion'])) : ''
                                ,utf8_encode($_numparfraran['skUsersModificacion'])
                            );
                            $this->fraAraDes['skFraccionArancelaria'] = $_numparfraran['skFraccionArancelaria'];
                            $fraAraDes = parent::read_equal_fraAraDes();
                            if(!$fraAraDes){ continue; }
                            $c = 0;
                            while($_fraAraDes = $fraAraDes->fetch_assoc()){
                                $datos['numPar'][$a]['numparfraran'][$b]['fraAraDes'][$c] = array(
                                     utf8_encode($_fraAraDes['skFraccionArancelariaDescripcion'])
                                    ,utf8_encode($_fraAraDes['skFraccionArancelaria'])
                                    ,utf8_encode($_fraAraDes['sDescripcion'])
                                    ,utf8_encode($_fraAraDes['sDescripcionIngles'])
                                    ,utf8_encode($_fraAraDes['sModelo'])
                                    ,utf8_encode($_fraAraDes['skStatus'])
                                    ,!empty($_fraAraDes['dFechaCreacion']) ? date("d-m-Y", strtotime($_fraAraDes['dFechaCreacion'])) : ''
                                    ,utf8_encode($_fraAraDes['skUsersCreacion'])
                                    ,!empty($_fraAraDes['dFechaModificacion']) ? date("d-m-Y", strtotime($_fraAraDes['dFechaModificacion'])) : ''
                                    ,utf8_encode($_fraAraDes['skUsersModificacion'])
                                );
                                $this->desArc['skFraccionArancelariaDescripcion'] = $_fraAraDes['skFraccionArancelariaDescripcion'];
                                $desArc = parent::read_equal_desArc();
                                if(!$desArc){ continue; }
                                $d = 0;
                                while($_desArc = $desArc->fetch_assoc()){
                                    $datos['numPar'][$a]['numparfraran'][$b]['fraAraDes'][$c]['desArc'][$d] = array(
                                         utf8_encode($_desArc['skArchivoFraccionArancelaria'])
                                        ,utf8_encode($_desArc['skFraccionArancelariaDescripcion'])
                                        ,utf8_encode($_desArc['sArchivo'])
                                        ,utf8_encode($_desArc['skStatus'])
                                    );
                                    $d++;     
                                }
                                $c++;
                            }
                            $b++;
                        }
                        $a++;
                    }
                    $this->data['datos'] = $datos;
                }
                header('Content-Type: application/json');
                echo json_encode($this->data);
                exit;
                //exit('<pre>'.print_r($this->data,1).'</pre>');
            }
            $this->load_view('claara-form', $this->data);
            return true;
            $_POST = array(
                'skNumeroParte' => substr(md5(microtime()), 1, 32)
                ,'sNombre'  => 'sNombre'
                ,'sDescripcion' => 'sDescripcion'
                ,'skStatus'=>'AC'
                ,'dFechaCreacion'=>'CURRENT_TIMESTAMP'
                ,'skUsersCreacion'=>$_SESSION['session']['skUsers']
                    
                ,'fraccionArancelaria'=>array(
                    array(
                        'sNombre'=>'fraccion1'
                        ,'sDescripcion'=>array(
                             'dEsp1'
                            ,'dEsp2'
                        )
                        ,'sDescripcionIngles'=> array(
                             'dIng1'
                            ,'dIng2'
                        )
                        ,'archivos'=>array(
                            array(
                                 'file1.png'
                                ,'file111.png'
                            ),
                            array(
                                 'file2.png'
                                ,'file22.png'
                            )
                        )
                    ),
                    array(
                        'sNombre'=>'fraccion2'
                        ,'sDescripcion'=>array(
                             'dEspa1'
                            ,'dEspa2'
                        )
                        ,'sDescripcionIngles'=> array(
                             'dIngle1'
                            ,'dIngle2'
                        )
                    )
                )
            );
            echo "<PRE>";
          
            print_r($_POST);
            echo "<PRE>";
           // exit('<pre>'.print_r($_POST).'</pre>');
          /* foreach($_POST as $tCampo => $tValor){
           
           	echo $tValor['skNumeroParte'];
           }*/
           
				//$this->numPar['skNumeroParte'] = $_POST["skNumeroParte"] . "<br>";
				//echo $_POST["sNombre"] . "<br>";
				//echo $_POST["sDescripcion"] . "<br>";
				//echo $_POST["skStatus"] . "<br>";
				//echo $_POST["dFechaCreacion"] . "<br>";
				//echo $_POST["skUsersCreacion"] . "<br>";
				
				$this->numPar['skNumeroParte'] = !empty($_POST['skNumeroParte']) ? $_POST['skNumeroParte'] : substr(md5(microtime()), 1, 32);
                $this->numPar['sNombre'] = !empty($_POST['sNombre']) ? utf8_decode($_POST['sNombre']) : NULL ;
                $this->numPar['sDescripcion'] = !empty($_POST['sDescripcion']) ? utf8_decode($_POST['sDescripcion']) : NULL ;
                $this->numPar['skStatus'] = !empty($_POST['skStatus']) ? utf8_decode($_POST['skStatus']) : 'IN' ;
                $this->numPar['dFechaCreacion'] = 'CURRENT_TIMESTAMP';
                $this->numPar['skUsersCreacion'] = $_SESSION['session']['skUsers'];
				
				
                $skNumeroParte = parent::create_cat_numeroParte();
                    if($skNumeroParte){
                    
                    foreach($_POST['fraccionArancelaria'] as $campo=>$valor)
				{
					
					
					//	echo "<PRE>";
 						$this->numparfraran['skFraccionArancelaria'] = !empty($_POST['skFraccionArancelaria']) ? $_POST['skFraccionArancelaria'] : substr(md5(microtime()), 1, 32);
						$this->numparfraran['skNumeroParte'] =  $this->numPar['skNumeroParte'] ;
						$this->numparfraran['skStatus'] =  'AC' ;
						$this->numparfraran['skUsersCreacion'] =  $this->numPar['skUsersCreacion'] ;
						$this->numparfraran['sNombre'] = !empty($_POST['fraccionArancelaria'][$campo]['sNombre']) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sNombre']) : NULL ;
						$skFraccionArancelaria = parent::create_cat_numparfraran();
						    if($skFraccionArancelaria){
							    
							    if(isset($_POST['fraccionArancelaria'][$campo]['sDescripcion'])){	
							foreach(($_POST['fraccionArancelaria'][$campo]['sDescripcion']) as $campo2=>$valor2)
							{
 						$this->fraAraDes['skFraccionArancelariaDescripcion'] = !empty($_POST['skFraccionArancelariaDescripcion']) ? $_POST['skFraccionArancelariaDescripcion'] : substr(md5(microtime()), 1, 32);
  						$this->fraAraDes['skFraccionArancelaria'] =  $this->numparfraran['skFraccionArancelaria'] ;
 						$this->fraAraDes['skUsersCreacion'] =  $this->numparfraran['skUsersCreacion'] ;
  						$this->fraAraDes['sDescripcion'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcion'][$campo2]) : NULL ;
  						$this->fraAraDes['sDescripcionIngles'] = !empty($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) ? utf8_decode($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2]) : NULL ;
  		 							
  		 							$skFraccionArancelariaDescripcion = parent::create_cat_fraccionesArancelarias_descripcionFraccion();	
		 					
  		 						if(isset($_POST['fraccionArancelaria'][$campo]['archivos'][$campo2])){
				 						foreach($_POST['fraccionArancelaria'][$campo]['archivos'][$campo2] as $campo3=>$valor3)
										{
 			$this->desArc['skArchivoFraccionArancelaria'] = !empty($_POST['skArchivoFraccionArancelaria']) ? $_POST['skArchivoFraccionArancelaria'] : substr(md5(microtime()), 1, 32);
  			$this->desArc['skFraccionArancelariaDescripcion'] =  $this->fraAraDes['skFraccionArancelariaDescripcion'] ;
  			$this->desArc['sArchivo'] =  $_POST['fraccionArancelaria'][$campo]['archivos'][$campo2][$campo3] ;
  								$skArchivosFrancciones = parent::create_cat_descripcionFraccion_archivos();
  			
 			 							/*echo "<PRE>";
										 print_r($_POST['fraccionArancelaria'][$campo]['archivos'][$campo][$campo3])."<br>";
										echo "</PRE>";*/
										
										
				  						}
			  						}
		 						}
		 					}
  						}
 					

						
 					/*	if(isset($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'])){
	 						foreach(($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles']) as $campo2=>$valor2)
							{
 								echo "<PRE>";
 								print_r($_POST['fraccionArancelaria'][$campo]['sDescripcionIngles'][$campo2])."<br>";
 								echo "</PRE>";
 	 						}
 						}
 						*/
 						
 						/*if(isset($_POST['fraccionArancelaria'][$campo]['archivos'][$campo])){
	 						foreach($_POST['fraccionArancelaria'][$campo]['archivos'][$campo] as $campo2=>$valor2)
							{
 							echo "<PRE>";
							 print_r($_POST['fraccionArancelaria'][$campo]['archivos'][$campo][$campo2])."<br>";
							echo "</PRE>";
	  						}
  						}*/
						
 				}
                    
                        //$flag = true;
                        // HACEMOS FOREACH DE FRACCIONES //
                        // HACEMOS FOREACH DE DESCRIPCIONES //
                        // HACEMOS FOREACH DE ARCHIVOS (IMAGENES) //
                    }
                    	
            //exit('<pre>'.print_r($_POST,1).'</pre>');
             if($_POST){
               /* $this->numPar['skNumeroParte'] = !empty($_POST['skNumeroParte']) ? $_POST['skNumeroParte'] : substr(md5(microtime()), 1, 32);
                $this->numPar['sNombre'] = !empty($_POST['sNombre']) ? utf8_decode($_POST['sNombre']) : NULL ;
                $this->numPar['sDescripcion'] = !empty($_POST['sDescripcion']) ? utf8_decode($_POST['sDescripcion']) : NULL ;
                $this->numPar['skStatus'] = !empty($_POST['skStatus']) ? utf8_decode($_POST['skStatus']) : 'IN' ;
                $this->numPar['dFechaCreacion'] = 'CURRENT_TIMESTAMP';
                $this->numPar['skUsersCreacion'] = $_SESSION['session']['skUsers'];*/
                if(empty($_POST['skNumeroParte'])){
                    // HACEMOS TRANSACIÓN AQUÍ //
                    $flag = false;
                    $skNumeroParte = parent::create_cat_numeroParte();
                    if($skNumeroParte){
                        //$flag = true;
                        // HACEMOS FOREACH DE FRACCIONES //
                        // HACEMOS FOREACH DE DESCRIPCIONES //
                        // HACEMOS FOREACH DE ARCHIVOS (IMAGENES) //
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
            if(isset($_GET['p1'])){
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $this->data['datos'] = parent::read_equal_numPar();
            }
            $this->load_view('claara-form', $this->data);
            return true;
        }

        public function claara_detail(){
            if(isset($_GET['p1'])){
                $this->numPar['skNumeroParte'] = $_GET['p1'];
                $this->data['datos'] = parent::read_equal_numPar();
            }
            if(isset($_GET['axn'])){
                switch ($_GET['axn']) {
                    case 'pdf':
                        $this->claara_pdf();
                        break;
                }
            }
            $this->load_view('numPar-detail', $this->data);
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

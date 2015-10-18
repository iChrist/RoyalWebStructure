<?php
	require_once(SYS_PATH."cof/model/cof.model.php");
	Class Cof_Controller Extends Cof_Model {

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
		
		}

                /* COMIENZA MODULO USUARIOS */
                public function cof_usua_con(){
                    if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                        
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sName'])){
                            $this->users['sName'] = $_POST['sName'];
                        }
                        if(isset($_POST['sEmail'])){
                            $this->users['sEmail'] = $_POST['sEmail'];
                        }
                        if(isset($_POST['sUserName'])){
                            $this->users['sUserName'] = $_POST['sUserName'];
                        }
                        if(isset($_POST['skStatus'])){
                            $this->users['skStatus'] = $_POST['skStatus'];
                        }
                        
                        // TOTAL DE REGISTROS EN LA TABLA //
                        $getTotal = parent::count_user()->fetch_assoc();
                        $iTotalRecords = $getTotal['total'];
                        // "LIMIT" TOTAL DE REGISTROS PARA MOSTRAR //
                        $iDisplayLength = intval($_REQUEST['length']);
                        $iDisplayLength = ($iDisplayLength < 0) ? $iTotalRecords : $iDisplayLength; 
                        // "OFFSET" //
                        $iDisplayStart = intval($_REQUEST['start']);
                        // PAGINA //
                        $sEcho = intval($_REQUEST['draw']);
                        
                        $this->users['limit'] = $iDisplayLength;
                        $this->users['offset'] = $iDisplayStart;
                        $this->data['users'] = parent::read_filter_user();
                        
                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
                        
                        if($this->data['users']){
                            while($row = $this->data['users']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['skUsers']));
                                $records["data"][] = array(
                                    htmlentities(($row['sName']), ENT_QUOTES)
                                    ,htmlentities(($row['sEmail']), ENT_QUOTES)
                                    ,htmlentities(($row['sUserName']), ENT_QUOTES)
                                    ,htmlentities(($row['sPassword']), ENT_QUOTES)
                                    ,utf8_encode($row['sHtml'])
                                    , !empty($actions['sHtml']) ? '<div class="dropdown" style="position: absolute;"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.$actions['sHtml'].'</ul></div>' : ''
                                    
                                );
                            }
                        }
                        $records["draw"] = $sEcho;
                        $records["recordsTotal"] = $iTotalRecords;
                        $records["recordsFiltered"] = $iTotalRecords;

                        echo json_encode($records);
                        return false;
                    }
                    $this->data['status'] = parent::read_status();
                    $this->load_view('cof-usua-con', $this->data);
                }
                
                public function cof_usua_form(){
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    $this->data['profiles'] = parent::read_profile(); // Mandamos a llamar todos los perfiles para cargarlos en la vista
                    if(isset($_POST['axn']))
                    {
                        switch ($_POST['axn'])
                        {
                            case "validarEmail":
                                // echo 'false'; -> Email no encontrado 
                                // echo 'true';  -> Email encontrado
								
                                $this->users['sEmail'] = htmlentities(($_POST['sEmail']));
								$this->users['skUsersDistinto'] = htmlentities(($_POST['skUsers']));
                                if(parent::read_user())
                                {
                                    echo 'false';
                                }
                                else
                                {
                                    echo 'true';
                                }
                                exit;
                            break;
                            
                            case "validarUserName":
                                // echo 'false'; -> UserName no encontrado 
                                // echo 'true';  -> UserName encontrado
                                $this->users['sUserName'] = htmlentities(($_POST['sUserName']));
                                $this->users['skUsersDistinto'] = htmlentities(($_POST['skUsers']));
							    if(parent::read_user())
                                {
                                    echo 'false';
                                }
                                else
                                {
                                    echo 'true';
                                }
                                exit;
                            break;
                        }
                    }
                    
                    if($_POST){
                        
                        if($_GET['p1'] || $_POST['skUsers']){
							
                            $this->users['skUsers'] = isset($_GET['p1']) ? $_GET['p1'] : ($_POST['skUsers']);
                            $this->users['sName'] = htmlentities(($_POST['sName']));
                            $this->users['sLastNamePaternal'] = htmlentities(($_POST['sLastNamePaternal']));
                            $this->users['sLastNameMaternal'] = htmlentities(($_POST['sLastNameMaternal']));
                            $this->users['sPassword'] = htmlentities(($_POST['sPassword']));
                            $this->users['sEmail'] = htmlentities(($_POST['sEmail']));
                            $this->users['sUserName'] = htmlentities(($_POST['sUserName']));
                            $this->users['skStatus']= htmlentities(($_POST['skStatus']));
                            if(parent::update_Users()){
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro actualizado con &eacute;xito.';
							   	if(isset($_POST['skProfiles'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
								 {
                                    $count = count($_POST['skProfiles']);
                                    $bandera = 1;
                                    $valores = "";
                                    foreach ($_POST['skProfiles'] as $profiles)
                                    {
                                        if( $bandera == $count )
                                        {
                                            $valores .= "('".$this->users['skUsers']."' , '".$profiles."')";
                                        }
                                        else
                                        {
                                            $valores .= "('".$this->users['skUsers']."' , '".$profiles."'),";
                                        }
                                        $bandera++;
                                    }
                                    parent::create_Users_profiles($valores);
                                }
                                  $this->data['datos'] = parent::read_user();
								$this->data['perfilesusuarios'] = parent::read_user_profile();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                                  $this->data['datos'] = parent::read_user();
								$this->data['perfilesusuarios'] = parent::read_user_profile();
                            }
                            
                        }else{
                            $this->users['skUsers'] = substr(md5(microtime()), 1, 32); //Generación UUID.
                            $this->users['sName'] = htmlentities(($_POST['sName']));
                            $this->users['sLastNamePaternal'] = htmlentities(($_POST['sLastNamePaternal']));
                            $this->users['sLastNameMaternal'] = htmlentities(($_POST['sLastNameMaternal']));
                            $this->users['sEmail'] = htmlentities(($_POST['sEmail']));
                            $this->users['sUserName'] = htmlentities(($_POST['sUserName']));
                            $this->users['sPassword'] = htmlentities(($_POST['sPassword']));
                            $this->users['skStatus'] = htmlentities(($_POST['skStatus']));
                            $this->users['skUsers'] = parent::create_Users();
                            echo $this->users['skUsers']."<br>"."<br>"."<br>";
                            if($this->users['skUsers']){
                                if(isset($_POST['skProfiles'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
                                {
                                    $count = count($_POST['skProfiles']);
                                    $bandera = 1;
                                    $valores = "";
                                    foreach ($_POST['skProfiles'] as $profiles)
                                    {
                                        if( $bandera == $count )
                                        {
                                            $valores .= "('".$this->users['skUsers']."' , '".$profiles."')";
                                        }
                                        else
                                        {
                                            $valores .= "('".$this->users['skUsers']."' , '".$profiles."'),";
                                        }
                                        $bandera++;
                                    }
                                    parent::create_Users_profiles($valores);
                                }
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro insertado con &eacute;xito.';
                                $this->users['skUsers'] = $this->users['skUsers'];
                                $this->data['datos'] = parent::read_user();
								$this->data['perfilesusuarios'] = parent::read_user_profile();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                            }
                        }
                    }
					
                    if($_GET['p1']){
                        $this->users['skUsers'] = $_GET['p1'];
                        $this->data['datos'] = parent::read_user();
                        $this->data['perfilesusuarios'] = parent::read_user_profile();
                    }
                    $this->load_view('cof-usua-form', $this->data);
                }
                
                
                public function cof_usua_det(){
                    $this->data['datos'] = false;
                    $this->data['profiles'] = parent::read_profile(); // Mandamos a llamar todos los perfiles para cargarlos en la vista
                    if($_GET['p1'])
                    {
                        $this->skUsers = $_GET['p1'];
                        $this->data['datos'] = parent::read_user();
                        $this->data['perfilesusuarios'] = parent::read_user_profile();
                    }
                    $this->load_view('cof-usua-det', $this->data);
                }
                
                /* TERMINA MODULO USUARIOS */
                
	        public function cof_perf_con(){
	        	 if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                        
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sName'])){
                            $this->profiles['sName'] = $_POST['sName'];
                        }
                      
                        if(isset($_POST['skStatus'])){
                            $this->profiles['skStatus'] = $_POST['skStatus'];
                        }
                        
                        // TOTAL DE REGISTROS EN LA TABLA //
                        $getTotal = parent::count_profile()->fetch_assoc();
                        $iTotalRecords = $getTotal['total'];
                        // "LIMIT" TOTAL DE REGISTROS PARA MOSTRAR //
                        $iDisplayLength = intval($_REQUEST['length']);
                        $iDisplayLength = ($iDisplayLength < 0) ? $iTotalRecords : $iDisplayLength; 
                        // "OFFSET" //
                        $iDisplayStart = intval($_REQUEST['start']);
                        // PAGINA //
                        $sEcho = intval($_REQUEST['draw']);
                        
                        $this->profiles['limit'] = $iDisplayLength;
                        $this->profiles['offset'] = $iDisplayStart;
                        $this->data['profiles'] = parent::read_filter_profile();
                        
                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
                        
                        if($this->data['profiles']){
                            while($row = $this->data['profiles']->fetch_assoc()){
                               $actions = $this->printModulesButtons(2,array($row['skProfiles']));

                                $records["data"][] = array(
                                    htmlentities(($row['sName']), ENT_QUOTES)
                                      ,utf8_encode($row['sHtml'])
                                    , !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.$actions['sHtml'].'</ul></div>' : ''
                                );
                            }
                        }

                        $records["draw"] = $sEcho;
                        $records["recordsTotal"] = $iTotalRecords;
                        $records["recordsFiltered"] = $iTotalRecords;

                        echo json_encode($records);
                        return false;
                    }
                    $this->data['status'] = parent::read_status();
                    $this->load_view('cof-perf-con', $this->data);
	        
				//$this->require_view(); 
				/*$this->data["perfiles"] = parent::read_profile();
                                $this->load_view('cof-perf-con', $this->data);*/
			}

	        public function cof_perf_form(){
                    $this->data['message'] = '';
                    $this->data['response'] = true;
                    $this->data['datos'] = false;
                    
                  

                    if($_POST){
  	                    	// $this->skProfiles 	= isset($_GET['p1']) ? $_GET['p1'] : $_POST['skProfiles'];
  	                    	 $this->profiles['skProfiles'] = !empty($_POST['skProfiles']) ? $_POST['skProfiles'] : substr(md5(microtime()), 1, 32);
  	                    	 $this->profiles['sName'] = htmlentities($_POST['sName'],ENT_QUOTES);
  	                    	 $this->profiles['skStatus'] = htmlentities($_POST['skStatus'],ENT_QUOTES);
 	                        
	                        
	                    
	                        if(empty($_POST['skProfiles'])){
		                        if(parent::create_profile()){
		                        
		                        	foreach($_POST as $tCampo => $tValor){
										if(strstr($tCampo,"skModule")&&$tValor){ 
											$skModule = "'".$_POST["eSeccion".str_replace("skModule","",$tCampo)]."'";
											
											$seR	= (isset($_POST["R_".str_replace("skModule","",$tCampo)]) ? "'R'" : "NULL");
											$seW	= (isset($_POST["W_".str_replace("skModule","",$tCampo)]) ? "'W'" : "NULL");
											$seD	= (isset($_POST["D_".str_replace("skModule","",$tCampo)]) ? "'D'" : "NULL");
											$seA	= (isset($_POST["A_".str_replace("skModule","",$tCampo)]) ? "'A'" : "NULL");
												if(isset($_POST["R_".str_replace("skModule","",$tCampo)])){
 													  $datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seR.")";
		 											   parent::createPermissions($datos);
 													}
													if(isset($_POST["W_".str_replace("skModule","",$tCampo)])){
														$datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seW.")";
		 											   parent::createPermissions($datos);
 													}
													if(isset($_POST["D_".str_replace("skModule","",$tCampo)])){
															$datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seD.")";
															parent::createPermissions($datos);
 		 											}
		 											if(isset($_POST["A_".str_replace("skModule","",$tCampo)])){
															$datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seA.")";
															parent::createPermissions($datos);
 		 											}
 		 											}
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
                            if(parent::update_profile()){
                            	
	                    	 	parent::delete_permission_profile($_POST['skProfiles']);
	                    	 	foreach($_POST as $tCampo => $tValor){
												if(strstr($tCampo,"skModule")&&$tValor){ 
													$skModule = "'".$_POST["eSeccion".str_replace("skModule","",$tCampo)]."'";
													$seR	= (isset($_POST["R_".str_replace("skModule","",$tCampo)]) ? "'R'" : "NULL");
													$seW	= (isset($_POST["W_".str_replace("skModule","",$tCampo)]) ? "'W'" : "NULL");
													$seD	= (isset($_POST["D_".str_replace("skModule","",$tCampo)]) ? "'D'" : "NULL");
													$seA	= (isset($_POST["A_".str_replace("skModule","",$tCampo)]) ? "'A'" : "NULL");
													
													if(isset($_POST["R_".str_replace("skModule","",$tCampo)])){
												
													  $datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seR.")";
		 											   parent::createPermissions($datos);
															//$result=mysqli_query($this->cxsis,$select);
													}
													if(isset($_POST["W_".str_replace("skModule","",$tCampo)])){
														$datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seW.")";
		 											   parent::createPermissions($datos);
		 													//$result=mysqli_query($this->cxsis,$select);
													}
													if(isset($_POST["D_".str_replace("skModule","",$tCampo)])){
															$datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seD.")";
															parent::createPermissions($datos);
															//$result=mysqli_query($this->cxsis,$select);
		 											}
		 											if(isset($_POST["A_".str_replace("skModule","",$tCampo)])){
															$datos = "(".$skModule.",'".$_POST['skProfiles']."',".$seA.")";
															parent::createPermissions($datos);
															//$result=mysqli_query($this->cxsis,$select);
		 											}
												}
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
                    if(!empty($_GET['p1'])){
                        $this->skProfiles = $_GET['p1'];
                        $this->data['datos'] = parent::read_profile();
                    }
                    $this->load_view('cof-perf-form', $this->data);
             
                 }
		
		  
	}
?>

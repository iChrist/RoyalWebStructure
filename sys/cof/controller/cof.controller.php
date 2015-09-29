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
                        
                        /*echo '$iTotalRecords -> '.$iTotalRecords.'   ';
                        echo 'intval($_REQUEST["length"]) -> '.intval($_REQUEST['length']).'   ';
                        echo '$iDisplayLength -> '.$iDisplayLength.' ';
                        echo '$iDisplayStart -> '.$iDisplayStart.'   ';
                        echo '$sEcho -> '.$sEcho;*/
                        
                        $this->users['limit'] = $iDisplayLength;
                        $this->users['offset'] = $iDisplayStart;
                        $this->data['users'] = parent::read_user();
                        
                        if(!$this->data['users']){
                            return false;
                        }
                        
                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

                        while($row = $this->data['users']->fetch_assoc()){
                            $records["data"][] = array(
                                htmlentities(utf8_encode($row['sName']), ENT_QUOTES)
                                ,htmlentities(utf8_encode($row['sEmail']), ENT_QUOTES)
                                ,htmlentities(utf8_encode($row['sUserName']), ENT_QUOTES)
                                ,htmlentities(utf8_encode($row['sPassword']), ENT_QUOTES)
                                ,utf8_encode($row['sHtml'])
                                ,'<a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>'
                            );
                        }

                        $records["draw"] = $sEcho;
                        $records["recordsTotal"] = $iTotalRecords;
                        $records["recordsFiltered"] = $iTotalRecords;

                        echo json_encode($records);
                        return false;
                    }
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
                                $this->users['sEmail'] = $_POST['sEmail'];
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
                                $this->users['sUserName'] = $_POST['sUserName'];
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
                            $this->skUsers = isset($_GET['p1']) ? $_GET['p1'] : $_POST['skUsers'];
                            $this->sName = $_POST['sName'];
                            $this->sEmail = $_POST['sEmail'];
                            $this->sUserName = $_POST['sUserName'];
                            $this->skStatus = $_POST['skStatus'];
                            if(parent::update()){
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                            }
                        }else{
                            $this->skUsers = substr(md5(microtime()), 1, 32); //Generación UUID.
                            $this->sName = $_POST['sName'];
                            $this->sEmail = $_POST['sEmail'];
                            $this->sUserName = $_POST['sUserName'];
                            // $this->sPassword = substr(md5(microtime()), 1, 16); //Generación de Password aleatorio con longitud de 16 caracteres.
                            $this->sPassword = $_POST['sPassword'];
                            $this->skStatus = $_POST['skStatus'];
                            $this->skUsers = parent::create();
                            
                            if($this->skUsers){
                                if(isset($_POST['skProfiles'])) // En esta parte guardaremos todos los perfiles seleccionados para el nuevo usuario.
                                {
                                    $count = count($_POST['skProfiles']);
                                    $bandera = 1;
                                    $valores = "";
                                    foreach ($_POST['skProfiles'] as $profiles)
                                    {
                                        if( $bandera == $count )
                                        {
                                            $valores .= '("'.$this->skUsers.'" , "'.$profiles.'")';
                                        }
                                        else
                                        {
                                            $valores .= '("'.$this->skUsers.'" , "'.$profiles.'"),';
                                        }
                                        $bandera++;
                                    }
                                    parent::createDetail($valores);
                                }
                                $this->data['success'] = true;
                                $this->data['message'] = 'Registro insertado con &eacute;xito.';
                                $this->skUsers = $this->skUsers;
                                $this->data['datos'] = parent::read_user();
                            }else{
                                $this->data['error'] = true;
                                $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                            }
                        }
                    }
                    if($_GET['p1']){
                        $this->skUsers = $_GET['p1'];
                        $this->data['datos'] = parent::read_user();
                    }
                    $this->load_view('cof-usua-form', $this->data);
                }
                /* TERMINA MODULO USUARIOS */
                
	        public function cof_perf_con(){
				//$this->require_view(); 
				$this->data["perfiles"] = parent::read_profile();
                                $this->load_view('cof-perf-con', $this->data);
			}

		public function cof_perf_form(){
                    //$this->require_view();
                    $this->data["msg"] = '';
                    $this->data["datos"] = false;
                    if($_POST){
                        $this->sName = $_POST['sName'];
                        $this->skStatus = $_POST['skStatus'];
                        $id = parent::create_profile();
                        if($id){
                            $this->data["msg"] = 'GUADADO CON EXITO';
                        }else{
                            $this->data["msg"] = 'ERROR AL GUARDAR';
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

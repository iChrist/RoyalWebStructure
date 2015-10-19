<?php
	require_once(SYS_PATH."his/model/his.model.php");
	Class His_Controller Extends His_Model {

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
		
		}

                 /* COMIENZA MODULO accesos_index */
              
			    public function accesos_index(){
                    if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                  
                        // PARAMETROS PARA FILTRADO //
                        if(isset($_POST['sName'])){
                            $this->access['sName'] = utf8_decode($_POST['sName']);
                        }
                        if(isset($_POST['skModules'])){
                            $this->access['skModules'] = $_POST['skModules'];
                        }
                        if(isset($_POST['sIp'])){
                            $this->access['sIp'] = $_POST['sIp'];
                        }
                        // TOTAL DE REGISTROS EN LA TABLA //
                        $getTotal = parent::count_access()->fetch_assoc();
                        $iTotalRecords = $getTotal['total'];
                        // "LIMIT" TOTAL DE REGISTROS PARA MOSTRAR //
                        $iDisplayLength = intval($_REQUEST['length']);
                        $iDisplayLength = ($iDisplayLength < 0) ? $iTotalRecords : $iDisplayLength; 
                        // "OFFSET" //
                        $iDisplayStart = intval($_REQUEST['start']);
                        // PAGINA //
                        $sEcho = intval($_REQUEST['draw']);
                        
                        $this->access['limit'] = $iDisplayLength;
                        $this->access['offset'] = $iDisplayStart;
                        $this->data['access'] = parent::read_access();

                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
                        
                        if($this->data['access']){
                            while($row = $this->data['access']->fetch_assoc()){
                                $actions = $this->printModulesButtons(2,array($row['sName']));
                                $records["data"][] = array(
                                    utf8_encode(($row['sName']))
                                    ,utf8_encode(($row['skModules']))
                                    ,utf8_encode(($row['sIp']))
                                    ,utf8_encode(($row['dAccess']))
                                    , !empty($actions['sHtml']) ? '<div class="dropdown" style="position: absolute;"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                                    
                                );
                            }
                        }
                        $records["draw"] = $sEcho;
                        $records["recordsTotal"] = $iTotalRecords;
                        $records["recordsFiltered"] = $iTotalRecords;

                        echo json_encode($records);
                        return false;
                    }
                    $this->data['access'] = parent::read_access();
                    $this->load_view('accesos-index', $this->data);
                }
               
			    /* TERMINA MODULO accesos_index */
              
			    
	}
?>

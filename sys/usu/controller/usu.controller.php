<?php
	require_once(SYS_PATH."usu/model/usu.model.php");
	Class Usu_Controller Extends Usu_Model {

		// PRIVATE VARIABLES //
			private $data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){
			if($this->is_view_required()){
				$this->load_view($_GET["sysController"], $this->data);
			}
		}

		public function index(){
			$this->require_view(FALSE);
			$this->data["datos"] = parent::verifyUser();
		}
                
                public function usu_con(){
                    if(isset($_GET['axn']) && $_GET['axn'] == 'fetch_all'){
                        $this->require_view(FALSE);
                        $iTotalRecords = 178;
                        $iDisplayLength = intval($_REQUEST['length']);
                        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
                        $iDisplayStart = intval($_REQUEST['start']);
                        $sEcho = intval($_REQUEST['draw']);

                        $records = array();
                        $records["data"] = array(); 

                        $end = $iDisplayStart + $iDisplayLength;
                        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

                        $status_list = array(
                          array("success" => "Pending"),
                          array("info" => "Closed"),
                          array("danger" => "On Hold"),
                          array("warning" => "Fraud")
                        );

                        for($i = $iDisplayStart; $i < $end; $i++) {
                          $status = $status_list[rand(0, 2)];
                          $id = ($i + 1);
                          $records["data"][] = array(
                            '<input type="checkbox" name="id[]" value="'.$id.'">',
                            $id,
                            '12/09/2013',
                            'Jhon Doe',
                            'Jhon Doe',
                            '450.60$',
                            rand(1, 10),
                            '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
                            '<a href="javascript:;" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>',
                         );
                        }

                        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
                          $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                          $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
                        }

                        $records["draw"] = $sEcho;
                        $records["recordsTotal"] = $iTotalRecords;
                        $records["recordsFiltered"] = $iTotalRecords;

                        echo json_encode($records);
                        exit;
                    }
                    $this->require_view();
                }
                
                public function conf_usu_form(){
                    $this->require_view();
                    $this->data['message'] = '';
                    $this->data['success'] = false;
                    $this->data['error'] = false;
                    $this->data['datos'] = false;
                    if($_GET['p1']){
                        $this->skUsers = $_GET['p1'];
                        $this->data['datos'] = parent::read();
                    }
                    if($_POST){
                        
                    }
                }
	}
?>
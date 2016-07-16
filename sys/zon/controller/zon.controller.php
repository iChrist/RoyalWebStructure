<?php
require_once(SYS_PATH.$_GET['sysModule'].'/model/'.$_GET['sysModule'].'.model.php');
Class Zon_Controller Extends Zon_Model {
    
    // PUBLIC VARIABLES //
    
    // PRIVATE VARIABLES //
    private $data = array();

    public function __construct() {
        ini_set('memory_limit', '-1');
        parent::__construct();
    }

    public function __destruct() {

    }
    /* COMIENZA MODULO (ZON) */
    
    public function dropzone_index(){
        if(isset($_POST['axn']) && $_POST['axn']='insert'){
            if(isset($_FILES['myFiles'])){
                for($i = 0;$i<count($_FILES['myFiles']['name']);$i++){
                    $extension = explode('.',$_FILES['myFiles']['name'][$i]);
                    $extension = end($extension);
                    if(!@move_uploaded_file($_FILES['myFiles']['tmp_name'][$i], SYS_PATH.'zon/files/'.md5(microtime()).'.'.$extension)){
                        return FALSE;
                    }
                }
            }
            return TRUE;
        }
        $this->load_view('dropzone-form',$this->data,true);
    }
    
    /* TERMINA MODULO (ZON) */
}
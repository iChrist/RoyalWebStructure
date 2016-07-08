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
        $this->load_view('dropzone-form',$this->data,true);
    }
    
    /* TERMINA MODULO (ZON) */
}
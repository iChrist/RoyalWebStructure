<?php
require_once(SYS_PATH . "rex/model/rex.model.php");
Class Rex_Controller Extends Rex_Model {

    // PRIVATE VARIABLES //
    private $data = array();

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
    }

    public function __destruct() {

    }
    /* COMIENZA MODULO (REX) */
    
    public function rex_index()
    {
        $this->ref['id'] = 1;
        $this->ref['nombre'] = 'samuel';
        $areas = $this->getAreas('AC');
        $areas['otroDato'] = 'muajajaja';
        //$this->load_view('NombreArhivo' , $datosParaVista = array() , $bool = TRUE , $path = NULL);
        $this->load_view('rex-index1',$areas,false);
    }

    public function refe_index()
    {
        $this->load_view('refe-index',NULL,true);
    }    

    public function refe_form(){
        
        $this->data['message'] = '';
        $this->data['success'] = false;
        $this->data['datos'] = false;
        
        if(isset($_POST['axn']) && $_POST['axn'] =='insert'){
            return $this->refe_save();
        }
        if (isset($_POST['axn']) &&  $_POST['axn'] =='update') {
            return $this->refe_update();
        }
        if (isset($_GET["p1"])){
            $this->data['datos'] = $this->getReferencia($_GET["p1"]);
        }
        $this->load_view('refe-form',$this->data,true);
    }

    public function refe_save()
    {
        
        $le = $this->insertar();

        if(!$le){
            $this->data['message'] = "Hubo un error al guardar el registro ";
            $this->data['response'] = false;
            header('Content-Type: application/json');
            echo json_encode($this->data);
            return true;
        }else{
            $this->data['message'] = "Registros guardados exitosamente" ;
            $this->data['response'] = true;
            $this->data['success'] = true;
            header('Content-Type: application/json');
            echo json_encode($this->data);
            return true;
        }
    }

    public function refe_update()
    {
        $le = $this->updatear($_POST['skReferenciaExterna']);

        if(!$le){
            $this->data['message'] = "Hubo un error al actualizar el registro ";
            $this->data['response'] = false;
            header('Content-Type: application/json');
            echo json_encode($this->data);
            return true;
        }else{
            $this->data['message'] = "Registro actualizado exitosamente" ;
            $this->data['response'] = true;
            $this->data['success'] = true;
            header('Content-Type: application/json');
            echo json_encode($this->data);
            return true;
        }
    }

    public function jsonStatus()
    {
        $arr = $this->getStatus();
        if (!$arr) {
            header('Content-Type: application/json');
            echo json_encode(array());
        }else{
            header('Content-Type: application/json');
            echo json_encode($arr);
            return true;
        }
    }

    public function jsonAlmacenes()
    {
        $arr = $this->getAlmacenes();
        if (!$arr) {
            header('Content-Type: application/json');
            echo json_encode(array());
        }else{
            header('Content-Type: application/json');
            echo json_encode($arr);
            return true;
        }
    }    

    public function jsonSocioImportadores()
    {
       
        $arr = $this->getSociosImportador($_GET['p1']);
        if (!$arr) {
            header('Content-Type: application/json');
            echo json_encode(array());
            return false;
        }else{
            header('Content-Type: application/json');
            echo json_encode($arr);
            return true;
        }
    }

    

    /* TERMINA MODULO (REX) */
}
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
        if(isset($_GET['axn'])){
            switch ($_GET['axn']) {
                case 'fetch_all':
                    // PARAMETROS PARA FILTRADO //
                if(isset($_POST['sPedimento'])){
                    $this->areas['sPedimento'] = $_POST['sPedimento'];
                }
                if(isset($_POST['sReferencia'])){
                    $this->areas['sReferencia'] = $_POST['sReferencia'];
                }
                if(isset($_POST['sGuiaMaster'])){
                    $this->areas['sGuiaMaster'] = $_POST['sGuiaMaster'];
                }
                if(isset($_POST['sGuiaHouse'])){
                    $this->areas['sGuiaHouse'] = $_POST['sGuiaHouse'];
                }
                if(isset($_POST['dFechaCreacion'])){
                    $this->areas['dFechaCreacion'] = $_POST['dFechaCreacion'];
                }
                if(isset($_POST['dFechaPrevio'])){
                    $this->areas['dFechaPrevio'] = $_POST['dFechaPrevio'];
                }
                if(isset($_POST['dFechaDespacho'])){
                    $this->areas['dFechaDespacho'] = $_POST['dFechaDespacho'];
                }
                if(isset($_POST['dFechaClasificacion'])){
                    $this->areas['dFechaClasificacion'] = $_POST['dFechaClasificacion'];
                }
                if(isset($_POST['dFechaGlosa'])){
                    $this->areas['dFechaGlosa'] = $_POST['dFechaGlosa'];
                }
                if(isset($_POST['dFechaCapturaPedimento'])){
                    $this->areas['dFechaCapturaPedimento'] = $_POST['dFechaCapturaPedimento'];
                }
                if(isset($_POST['dFechaFacturacion'])){
                    $this->areas['dFechaFacturacion'] = $_POST['dFechaFacturacion'];
                }
                if(isset($_POST['iDeposito'])){
                    $this->areas['iDeposito'] = $_POST['iDeposito'];
                }
                if(isset($_POST['iSaldo'])){
                    $this->areas['iSaldo'] = $_POST['iSaldo'];
                }
                if(isset($_POST['sAlmacen'])){
                    $this->areas['sAlmacen'] = $_POST['sAlmacen'];
                }
                if(isset($_POST['sEstatus'])){
                    $this->areas['sEstatus'] = $_POST['sEstatus'];
                }
                if(isset($_POST['sSocioImportador'])){
                    $this->areas['sSocioImportador'] = $_POST['sSocioImportador'];
                }
                    // OBTENER REGISTROS //
                $total = parent::countGetReferenciasExternas();
                $records = Core_Functions::table_ajax($total);
                if($records['recordsTotal'] === 0){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }

                $this->areas['limit'] = $records['limit'];
                $this->areas['offset'] = $records['offset'];
                $this->data['data'] = parent::countGetReferenciasExternas(true);

                if(!$this->data['data']){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }

                while($row = $this->data['data']->fetch_assoc()){
                    $actions = $this->printModulesButtons(2,array($row['skReferenciaExterna']));
                    array_push($records['data'], array(
                         utf8_encode($row['sPedimento'])
                        ,utf8_encode($row['sReferencia'])
                        ,utf8_encode($row['sMercancia'])
                        ,utf8_encode($row['sGuiaMaster'])
                        ,utf8_encode($row['sGuiaHouse'])
                        ,utf8_encode($row['dFechaCreacion'])
                        ,utf8_encode($row['dFechaPrevio'])
                        ,utf8_encode($row['dFechaDespacho'])
                        ,utf8_encode($row['dFechaClasificacion'])
                        ,utf8_encode($row['dFechaGlosa'])
                        ,utf8_encode($row['dFechaCapturaPedimento'])
                        ,utf8_encode($row['dFechaFacturacion'])
                        ,utf8_encode($row['iDeposito'])
                        ,utf8_encode($row['iSaldo'])
                        ,utf8_encode($row['sAlmacen'])
                        ,utf8_encode($row['sEstatus'])
                        ,utf8_encode($row['sSocioImportador'])
                        ,!empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''));
                }

                header('Content-Type: application/json');
                echo json_encode($records);
                return true;
                break;
            }
            return true;
        }
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

        if (isset($_GET["p1"])){

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

        
    }

    

    /* TERMINA MODULO (REX) */
}
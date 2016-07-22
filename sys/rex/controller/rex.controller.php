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
        $this->ref['listAlmacenes'] = parent::getAlmacenes();
        $this->ref['listEstados'] =  parent::getStatus();
        //$refex = $this->getrefex('AC');

        //$this->load_view('NombreArhivo' , $datosParaVista = array() , $bool = TRUE , $path = NULL);
        $this->load_view('rex-index1',$refex,false);
    }

    public function refe_index()
    {
        $this->filters['listAlmacenes'] = parent::getAlmacenes();
        $this->filters['listEstados'] =  parent::getStatus();
        $this->filters['listSocios'] = parent::getSociosImportador($_SESSION['session']['skSocioEmpresaUsuario']);

        if(isset($_GET['axn'])){
            switch ($_GET['axn']) {
                case 'fetch_all':
                    // PARAMETROS PARA FILTRADO //
                if(isset($_POST['sPedimento'])){
                    $this->refex['sPedimento'] = $_POST['sPedimento'];
                }
                if(isset($_POST['sReferencia'])){
                    $this->refex['sReferencia'] = $_POST['sReferencia'];
                }
                if(isset($_POST['sGuiaMaster'])){
                    $this->refex['sGuiaMaster'] = $_POST['sGuiaMaster'];
                }
                if(isset($_POST['sGuiaHouse'])){
                    $this->refex['sGuiaHouse'] = $_POST['sGuiaHouse'];
                }
                if(isset($_POST['dFechaCreacion'])){
                    $this->refex['dFechaCreacion'] = $_POST['dFechaCreacion'];
                }
                if(isset($_POST['dFechaPrevio'])){
                    $this->refex['dFechaPrevio'] = $_POST['dFechaPrevio'];
                }
                if(isset($_POST['dFechaDespacho'])){
                    $this->refex['dFechaDespacho'] = $_POST['dFechaDespacho'];
                }
                if(isset($_POST['dFechaClasificacion'])){
                    $this->refex['dFechaClasificacion'] = $_POST['dFechaClasificacion'];
                }
                if(isset($_POST['dFechaGlosa'])){
                    $this->refex['dFechaGlosa'] = $_POST['dFechaGlosa'];
                }
                if(isset($_POST['dFechaCapturaPedimento'])){
                    $this->refex['dFechaCapturaPedimento'] = $_POST['dFechaCapturaPedimento'];
                }
                if(isset($_POST['dFechaFacturacion'])){
                    $this->refex['dFechaFacturacion'] = $_POST['dFechaFacturacion'];
                }
                if(isset($_POST['iDeposito'])){
                    $this->refex['iDeposito'] = $_POST['iDeposito'];
                }
                if(isset($_POST['iSaldo'])){
                    $this->refex['iSaldo'] = $_POST['iSaldo'];
                }
                if(isset($_POST['sAlmacen'])){
                    $this->refex['sAlmacen'] = $_POST['sAlmacen'];
                }
                if(isset($_POST['sEstatus'])){
                    $this->refex['sEstatus'] = $_POST['sEstatus'];
                }
                if(isset($_POST['sSocioImportador'])){
                    $this->refex['sSocioImportador'] = $_POST['sSocioImportador'];
                }
                if(isset($_POST['sMercancia'])){
                    $this->refex['sMercancia'] = $_POST['sMercancia'];
                }
                    // OBTENER REGISTROS //
                $total = parent::countGetReferenciasExternas();
                $records = Core_Functions::table_ajax($total);
                if($records['recordsTotal'] === 0){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }

                $this->refex['limit'] = $records['limit'];
                $this->refex['offset'] = $records['offset'];
                $this->data['data'] = parent::countGetReferenciasExternas(true);

                if(!$this->data['data']){
                    header('Content-Type: application/json');
                    echo json_encode($records);
                    return false;
                }

                while($row = $this->data['data']->fetch_assoc()){
                    $actions = $this->printModulesButtons(2,array($row['skReferenciaExterna']));
                    array_push($records['data'], array(
                        !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : ''
                        ,utf8_encode($row['sPedimento'])
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
                        ));
                }

                header('Content-Type: application/json');
                echo json_encode($records);
                return true;
                break;
            }
            return true;
        }
        $this->load_view('refe-index',$this->filters,true);
    }

    public function refe_form()
    {

        $this->data['message'] = '';
        $this->data['success'] = false;
        $this->data['datos'] = false;
        $this->data['tipoCambio'] = $this->tipo_cambio();
        // SACAMOS EL PEDIMENTO EN COLA //
        $maxPedimento = parent::getMaxPedimento();
        if ($maxPedimento) {
            $this->data['maxPedimento'] = $maxPedimento['sPedimento'] + 1;
        } else {
            $this->data['maxPedimento'] = '';
        }

        if(isset($_POST['axn']) && $_POST['axn'] =='insert'){
            return $this->refe_save($maxPedimento);
        }
        if (isset($_POST['axn']) &&  $_POST['axn'] =='update') {
            return $this->refe_update();
        }
        if (isset($_GET["p1"])){
            $this->data['datos'] =      parent::getReferencia($_GET["p1"]);
            $this->data['conceptosRef'] = parent::getConceptosReferencia($_GET["p1"]);
        }
        $this->load_view('refe-form',$this->data,true);
    }

    public function refe_save($maxPedimento)
    {

        $this->refex['sPedimento'] = utf8_decode($_POST['sPedimento']);
        if (parent::countGetReferenciasExternas(true)) {
            $this->data['response'] = false;
            $this->data['errorPedimento'] = false;
            $this->data['message'] = 'El pedimento ' . $this->refex['sPedimento'] . " Ya ha sido utilizado, intenta con " . ($maxPedimento['sPedimento'] + 1);
            header('Content-Type: application/json');
            echo json_encode($this->data);
            return false;
        }


        $le = parent::insertar();

        if(!$le){
            $this->data['message'] = "Hubo un error al guardar el registro ";
            $this->data['response'] = false;
            header('Content-Type: application/json');
            echo json_encode($this->data);
            return false;
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
        $le = parent::updatear($_POST['skReferenciaExterna']);

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
        $arr = parent::getStatus();
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
        $arr = parent::getAlmacenes();
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

            $arr = parent::getSociosImportador($_GET['p1']);
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

    public function tipo_cambio()
    {

         $client = new SoapClient(null, array(
                'location' =>'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL',
                'uri'=>'http://DgieWSWeb/DgieWS?WSDL',
                'encoding'=> 'UTF-8'
            ));

            try {

                $result = $client->tiposDeCambioBanxico();

            } catch (SoapFault $ex) {

                return $this->error($ex->getMessage());

            }

            if( !$result) {

                return false;

            }

            $dom = new DomDocument();
            $dom->loadXML($result);

            $xmlDatos = $dom->getElementsByTagName('Obs');

            if( !$xmlDatos->length) {

                return false;

            }

            $itemDolar = $xmlDatos->item(0);
            $itemEuro = $xmlDatos->item(2);
            $itemDolarCanadiense = $xmlDatos->item(3);
            $itemYenCanadiense = $xmlDatos->item(4);

            if( !$itemDolar || !$itemDolarCanadiense || !$itemEuro || !$itemYenCanadiense) {

                return false;

            }

           $data = array(
                'USD' => array(
                    'moneda'=>'USD',
                    'descripcion'=>'Dolar',
                    'time'=>$itemDolar->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemDolar->getAttribute('OBS_VALUE')
                ),
                'EUR' => array(
                    'moneda'=>'EUR',
                    'descripcion'=>'Euro',
                    'time'=>$itemEuro->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemEuro->getAttribute('OBS_VALUE')
                ),
                'CAN' => array(
                    'moneda'=>'USD CAN',
                    'descripcion'=>'Dolar Canadiense',
                    'time'=>$itemDolarCanadiense->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemDolarCanadiense->getAttribute('OBS_VALUE')
                ),
                'YEN' => array(
                    'moneda'=>'YEN CAN',
                    'descripcion'=>'YEN Canadiense',
                    'time'=>$itemYenCanadiense->getAttribute('TIME_PERIOD'),
                    'valor'=>$itemYenCanadiense->getAttribute('OBS_VALUE')
                )
            );
            return $data;
    }

    public function jsonConceptos()
    {
        if (isset($_POST["skSocioImportador"])) {
            //die(var_dump(parent::getConceptos($_POST["skEmpresa"])));
            header('Content-Type: application/json');
            echo json_encode(parent::getConceptos($_POST["skSocioImportador"]));
            return true;
        }else{
            return json_encode(array());
        }
    }

    public function rextfo_index()
    {
      $this->data['datos'] = parent::reexfo_referencias($_GET["p1"]);
      $this->load_view('rextfo_index',$refex,false);
    }


    /* Agregado de Fotos */
    public function reexfo_form()
    {
      $this->data['message'] = '';
      $this->data['response'] = true;
      $this->data['datos'] = false;
        if ($_POST) {
          $this->refex['skReferenciaExterna'] = $_POST['skReferenciaExterna'];
          $arrayFotos = (isset($_POST['myFiles']) ? $_POST['myFiles'] : array());

          if ($_POST['skReferenciaExterna']) {
              if (isset($_FILES['myFiles'])) {


                  for ($i = 0;$i < count($_FILES['myFiles']['name']);$i++) {
                      $extension = explode('.', $_FILES['myFiles']['name'][$i]);
                      $extension = end($extension);
                      $skFotoReferencia = md5(microtime());
                      $sUbicacionBDA = '/rex/fotos/'.$skFotoReferencia.'.'.$extension;
                      $sUbicacion = SYS_PATH.'rex/fotos/'.$skFotoReferencia.'.'.$extension;
                      if (!@move_uploaded_file($_FILES['myFiles']['tmp_name'][$i], $sUbicacion)) {
                          return false;
                      }
                      $this->refex['skReferenciaExterna'] = $_POST['skReferenciaExterna'];
                      $this->refex['skFotoReferencia'] = $skFotoReferencia;
                      $this->refex['sUbicacion'] = $sUbicacionBDA;
                      $skInsertadoFotos = parent::agregar_fotos_referencias();
                      if($skInsertadoFotos){
                        array_push($arrayFotos,$skFotoReferencia);
                      }
                  }
              }
          }
          $arrayNoEliminados = '';
          foreach($arrayFotos as $clave => $valor){
              $arrayNoEliminados.= ($arrayNoEliminados ? ",'".$valor."'" : "'".$valor."'");
          }
          $eliminadoFotos = parent::eliminar_fotos_referencias($arrayNoEliminados);
          if($eliminadoFotos){

              $this->data['response'] = true;
              $this->data['message'] = 'Registro actualizado con &eacute;xito.';
              header('Content-Type: application/json');
              echo json_encode($this->data);
              return true;
          }else{
            return FALSE;
          }


          return true;

        }


        if (isset($_GET['p1'])) {
           $this->refex['skReferenciaExterna'] = $_GET['p1'];
           $this->data['datos'] = parent::reexfo_referencias();
           $this->data['myFotos']= parent::listar_fotos_referencias();
        }
        $this->load_view('reexfo-form', $this->data);

        return true;
    }

    /* Agregado de Documentos */
    public function reexdo_form()
    {
      $this->data['message'] = '';
      $this->data['response'] = true;
      $this->data['datos'] = false;
        if ($_POST) {
          $this->refex['skReferenciaExterna'] = $_POST['skReferenciaExterna'];
          $arrayDocumentos = (isset($_POST['skDocTipo']) ? $_POST['skDocTipo'] : array());

            if ($_POST['skReferenciaExterna']) {

                // ELIMINAMOS LOS ARCHIVOS QUE HALLA ELIMINADO EL USUARIO //
                $datos = array('skReferenciaExterna'=>$_POST['skReferenciaExterna']);
                if(isset($_POST['skDocumentoReferencia'])){
                    $add_quotes = function ($str) {
                        return sprintf("'%s'", $str);
                    };
                    $datos = array(
                        'skReferenciaExterna'=>$_POST['skReferenciaExterna'],
                        'skDocumentoReferencia'=>implode(',',array_map($add_quotes,$_POST['skDocumentoReferencia']))
                    );
                }
                if(!parent::delete_referenciasExternas_documentos($datos)){
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al elmimar los documentos.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);
                    return FALSE;
                }
                // GUARDAMOS LOS ARCHIVOS POR $_FILES //
                if (isset($_FILES['skDocTipo'])) {
                    foreach ($_FILES['skDocTipo'] AS $k => $v) {
                        if ($k === 'name') {
                            foreach ($v AS $key => $val) {
                                if(!empty($_FILES['skDocTipo']['name'][$key])){
                                    $extension = explode('.', $_FILES['skDocTipo']['name'][$key]);
                                    $extension = end($extension);
                                    $skDocumentoReferencia = md5(microtime());
                                    $sUbicacionBDA = '/rex/documentos/'.$skDocumentoReferencia.'.'.$extension;
                                    $sUbicacion = SYS_PATH.'rex/documentos/'.$skDocumentoReferencia.'.'.$extension;
                                    if (!@move_uploaded_file($_FILES['skDocTipo']['tmp_name'][$key], $sUbicacion)) {
                                        $this->data['response'] = true;
                                        $this->data['message'] = 'Hubo un error al subir el documento.';
                                        header('Content-Type: application/json');
                                        echo json_encode($this->data);
                                        return FALSE;
                                    }
                                    $datos = array(
                                        'skDocumentoReferencia'=>$skDocumentoReferencia,
                                        'skReferenciaExterna'=>$_POST['skReferenciaExterna'],
                                        'sUbicacion'=>$sUbicacionBDA,
                                        'skDocTipo'=>$key
                                    );
                                    if(!parent::create_referenciasExternas_documentos($datos)){
                                        $this->data['response'] = true;
                                        $this->data['message'] = 'Hubo un error al guardar el documento.';
                                        header('Content-Type: application/json');
                                        echo json_encode($this->data);
                                        return FALSE;
                                    }
                                }
                            }
                        }
                    }
                }
            }

          $this->data['response'] = true;
          $this->data['message'] = 'Registro actualizado con &eacute;xito.';
          header('Content-Type: application/json');
          echo json_encode($this->data);
          return TRUE;

        }


        if (isset($_GET['p1'])) {
           $this->refex['skReferenciaExterna'] = $_GET['p1'];
           $this->data['datos'] = parent::reexfo_referencias();
           $this->data['myFotos'] = parent::listar_fotos_referencias();
           $this->data['filesDocTipo'] = parent::get_rel_referenciasExternas_documentos();
        }
        $this->data['docTipo'] = parent::get_cat_docTipo();
        $this->load_view('reexdo-form', $this->data);

        return TRUE;
    }

    public function reexde_detail()
    {
        if (isset($_GET['p1'])) {
            $this->refex['skReferenciaExterna'] = $_GET['p1'];
            $this->data['datos'] = parent::reexfo_referencias();
            $this->data['myFotos']= parent::listar_fotos_referencias();
            $this->data['filesDocTipo'] = parent::get_rel_referenciasExternas_documentos();
        }
        $this->load_view('reexde-detail', $this->data);

        return true;
    }
    public function reexfe_form()
    {
      $this->data['message'] = '';
      $this->data['response'] = true;
      $this->data['datos'] = false;
        if($_POST) {
            $this->refex['skReferenciaExterna'] = $_POST['skReferenciaExterna'];
            $this->refex['dFechaPrevio'] = utf8_decode(!empty($_POST['dFechaPrevio']) ? date('Y-m-d H:i:s', strtotime($_POST['dFechaPrevio'].$_POST['tHoraPrevio'])) : 'NULL');
            $this->refex['tHoraPrevio'] = utf8_decode(!empty($_POST['tHoraPrevio']) ? $_POST['tHoraPrevio'] : '');
            $this->refex['dFechaDespacho'] = utf8_decode(!empty($_POST['dFechaDespacho']) ? date('Y-m-d', strtotime($_POST['dFechaDespacho'].$_POST['tHoraDespacho'])) : 'NULL');
            $this->refex['tHoraDespacho'] = utf8_decode(!empty($_POST['tHoraDespacho']) ? $_POST['tHoraDespacho'] : '');
            $this->refex['dFechaClasificacion'] = utf8_decode(!empty($_POST['dFechaClasificacion']) ? date('Y-m-d', strtotime($_POST['dFechaClasificacion'].$_POST['tHoraClasificacion'])) : '');
            $this->refex['tHoraClasificacion'] = utf8_decode(!empty($_POST['tHoraClasificacion']) ? $_POST['tHoraClasificacion'] : '');
            $this->refex['dFechaGlosa'] = utf8_decode(!empty($_POST['dFechaGlosa']) ? date('Y-m-d', strtotime($_POST['dFechaGlosa'].$_POST['tHoraGlosa'])) : 'NULL');
            $this->refex['tHoraGlosa'] = utf8_decode(!empty($_POST['tHoraGlosa']) ? $_POST['tHoraGlosa'] : '');
            $this->refex['dFechaCapturaPedimento'] = utf8_decode(!empty($_POST['dFechaCapturaPedimento']) ? date('Y-m-d', strtotime($_POST['dFechaCapturaPedimento'].$_POST['tHoraCaptura'])) : 'NULL');
            $this->refex['tHoraCaptura'] = utf8_decode(!empty($_POST['tHoraCaptura']) ? $_POST['tHoraCaptura'] : '');
            $this->refex['dFechaRevalidacion'] = utf8_decode(!empty($_POST['dFechaRevalidacion']) ? date('Y-m-d', strtotime($_POST['dFechaRevalidacion'].$_POST['tHoraRevalidacion'])) : 'NULL');
            $this->refex['tHoraRevalidacion'] = utf8_decode(!empty($_POST['tHoraRevalidacion']) ? $_POST['tHoraRevalidacion'] : '');
            $this->refex['dFechaFacturacion'] = utf8_decode(!empty($_POST['dFechaFacturacion']) ? date('Y-m-d', strtotime($_POST['dFechaFacturacion'].$_POST['tHoraFacturacion'])) : 'NULL');
            $this->refex['tHoraFacturacion'] = utf8_decode(!empty($_POST['tHoraFacturacion']) ? $_POST['tHoraFacturacion'] : '');
          if ($_POST['skReferenciaExterna']) {
                $skReferenciaExterna = parent::editar_fechas_referencia();
                if(!$skReferenciaExterna){
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);
                    return true;
                }else{


                }


          }


          return true;

        }


        if (isset($_GET['p1'])) {
           $this->refex['skReferenciaExterna'] = $_GET['p1'];
           $this->data['datos'] = parent::reexfo_referencias();
        }
        $this->load_view('reexfe-form', $this->data);

        return true;
    }
    /* TERMINA MODULO (REX) */
}

<?php

require_once SYS_PATH.'doc/model/doc.model.php';

class Doc_Controller extends Doc_Model
{
    // PRIVATE VARIABLES //
    private $data = array();

    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', '-1');
    }

    public function __destruct()
    {
    }

    public function obtenerDatos($sReferencia = '')
    {
        $this->recepciondocumentos['sReferencia'] = htmlentities($_POST['sReferencia']);
        $this->data['data'] = $this->read_recepciondocumentos();

        if (!$this->data['data']) {
            $this->data['response'] = false;
            $this->data['message'] = 'La Referencia '.htmlentities($_POST['sReferencia']).' no existe.';
            header('Content-Type: application/json');
            echo json_encode($this->data);

            return false;
        }
        $html = '';
        while ($row = $this->data['data']->fetch_assoc()) {
            $html .= '<div class="col-md-6"><h3>Detalles: </h3>
                <table class="col-md-12 table table-striped">
                    <tr>
                        <th>Cliente:</th>
                        <th>Tipo Servicio:</th>
                        <th>Ejecutivo:</th>
                    </tr>
                    <tr>
                        <td>'.utf8_encode($row['Empresa']).'</td>
                        <td>'.utf8_encode($row['TipoServicio']).'</td>
                        <td>'.utf8_encode($row['autor']).'</td>
                    </tr>
                    <tr>
                        <th>BL Master:</th>
                        <th>Clave Documento:</th>
                        <th colspan="2">Mercancia:</th>
                    </tr>
                        <td>'.utf8_encode($row['sBlMaster']).'</td>
                        <td>'.utf8_encode($row['ClaveDocumento']).'</td>
                        <td>'.utf8_encode($row['sMercancia']).'</td>
                    </tr>
                </table></div><div class="col-md-6">';
            $this->mercancias['skRecepcionDocumento'] = $row['skRecepcionDocumento'];
            $mercancias = $this->read_mercancias();
            if ($mercancias) {
                if ($row['skTipoServicio'] == 'CSUE') {
                    $html .= '<h3>Mercancía: </h3>
                    <table class="col-md-12 table table-striped">
                    <tr>
                    <th>Bultos</th>
                    <th>Peso</th>
                    <th>Volumen</th>
                    </tr>';
                    while ($r = $mercancias->fetch_assoc()) {
                        $html .= '<tr>
                        <td>'.$r['iBultos'].'</td>
                        <td>'.$r['fPeso'].'</td>
                        <td>'.$r['fVolumen'].'</td>
                        </tr>';
                    }
                } elseif ($row['skTipoServicio'] == 'CONT') {
                    $html .= '<h3>Mercancía: </h3>
                    <table class="col-md-12 table table-striped">
                    <tr>
                    <th>BL House</th>
                    <th>Núm. Contenedor</th>
                    <th>Tipo Contenedor</th>
                    <th>Embalaje</th>
                    </tr>';
                    while ($r = $mercancias->fetch_assoc()) {
                        $html .= '<tr>
                        <td>'.$r['sBlhouse'].'</td>
                        <td>'.$r['sNumContenedor'].'</td>
                        <td>'.$r['embalaje'].'</td>
                        <td>'.$r['tipoContenedor'].'</td>
                        </tr>';
                    }
                }
                $html .= '</table>';
            }
            $html .= '</div><div class="clearfix"></div><hr>';
        }
        header('Content-Type: application/json');
        echo json_encode($html);

        return true;
    }

    public function migrate()
    {
        $sql = "SELECT * FROM royalweb_gya.ope_recepciones_documentos WHERE skTipoServicio = 'CONT'";
        $result = $this->db->query($sql);
        if (!$result) {
            exit('ERROR');
        }
        $cont = 0;
        //$this->db->autocommit(FALSE);
        //$this->db->begin_transaction();
        $flag = true;
        while ($row = $result->fetch_assoc()) {
            if (
                    strpos($row['sNumContenedor'], '/', 0) === false && strpos($row['sNumContenedor'], '-', 0) === false && strpos($row['sNumContenedor'], ',', 0) === false && strpos($row['sNumContenedor'], '-,', 0) === false
            ) {
                if (trim($row['sNumContenedor'])) {
                    ++$cont;
                    echo $cont.' : '.$row['sNumContenedor'].'<br>';
                    $sql = "INSERT INTO rel_recepciones_mercancias
                                    (skMercancia
                                    ,skRecepcionDocumento
                                    ,skEmbalaje
                                    ,skTipoContenedor
                                    ,sBlHouse
                                    ,sNumContenedor
                                    ,iBultos
                                    ,fPeso
                                    ,fVolumen)
                                    VALUES
                                    ('".addslashes(trim(substr(md5(microtime()), 0, 32), ' '))."'
                                    ,'".addslashes(trim($row['skRecepcionDocumento'], ' '))."'
                                    ,''
                                    ,''
                                    ,'".addslashes(trim($row['sBlHouse'], ' '))."'
                                    ,'".addslashes(trim($row['sNumContenedor'], ' '))."'
                                    ,''
                                    ,''
                                    ,''
                                    )";
                    $insert = $this->db->query($sql);
                    if (!$insert) {
                        $flag = false;
                    }
                }
            }
        }
        if ($flag) {
            //$this->db->commit();
            echo 'COMMIT : '.$cont;
        } else {
            //$this->db->rollback();
            echo 'ROLLBACK : '.$cont;
        }
    }

    public function migrate_haystack()
    {
        $haystack = ',';
        $sql = "SELECT * FROM ope_recepciones_documentos WHERE skTipoServicio = 'CONT'";
        $result = $this->db->query($sql);
        if (!$result) {
            exit('ERROR');
        }
        $cont = 0;
        //$this->db->autocommit(FALSE);
        //$this->db->begin_transaction();
        $flag = true;
        while ($row = $result->fetch_assoc()) {
            //echo '<pre>'.print_r($row,1).'</pre>';
            if (strpos($row['sNumContenedor'], $haystack, 0) === false) {
                // FALSE //
            } else {
                // TRUE //
                echo $row['sNumContenedor'].'<br>';
                $tmp = explode($haystack, $row['sNumContenedor']);
                foreach ($tmp as $k => $v) {
                    if (trim($v)) {
                        ++$cont;
                        echo $cont.' : '.$v.'<br>';
                        $sql = "INSERT INTO rel_recepciones_mercancias
                                        (skMercancia
                                        ,skRecepcionDocumento
                                        ,skEmbalaje
                                        ,skTipoContenedor
                                        ,sBlHouse
                                        ,sNumContenedor
                                        ,iBultos
                                        ,fPeso
                                        ,fVolumen)
                                        VALUES
                                        ('".addslashes(trim(substr(md5(microtime()), 0, 32), ' '))."'
                                        ,'".addslashes(trim($row['skRecepcionDocumento'], ' '))."'
                                        ,''
                                        ,''
                                        ,'".addslashes(trim($row['sBlHouse'], ' '))."'
                                        ,'".addslashes(trim($v, ' '))."'
                                        ,''
                                        ,''
                                        ,''
                                        )";
                        $insert = $this->db->query($sql);
                        if (!$insert) {
                            $flag = false;
                        }
                    }
                }
                echo '<hr>';
            }
        }
        if ($flag) {
            //$this->db->commit();
            echo 'COMMIT : '.$cont;
        } else {
            //$this->db->rollback();
            echo 'ROLLBACK : '.$cont;
        }
    }

    /* COMIENZA MODULO DE RECEPCION DE DOCUMENTOS */

    public function get_pdf()
    {
        if (!isset($_GET['p1'])) {
            $text = 'Falta identificador para generar el PDF.';
            $this->_error($text, 404);

            return false;
        }
        $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
        $this->data['datos'] = parent::read_recepciondocumentos();
        $this->data['config'] = array(
            'title' => 'Recepción de Documentos', 'date' => date('d-m-Y H:i:s'), 'company' => 'Gomez y Alvez', 'address' => 'Manzanillo, Colima', 'phone' => '3141102645', 'website' => 'www.grupoalvez.royalweb.com.mx', 'background_image' => (SYS_URL).'core/assets/img/logoPdf.png', 'header' => (CORE_PATH).'assets/pdf/tplHeaderPdf.php', 'footer' => (CORE_PATH).'assets/pdf/tplFooterPdf.php', 'style' => (CORE_PATH).'assets/pdf/tplStylePdf.php',
        );
        ob_start();
        $this->load_view('test-pdf', $this->data, false, 'doc/pdf/');
        $content = ob_get_clean();
        Core_Functions::pdf($content, $this->data['config']['title'], 'P', 'A4', 'es', true, 'UTF-8', array(5, 5, 5, 5));

        return true;
    }

    public function docume_index()
    {
        if (isset($_GET['axn'])) {
            switch ($_GET['axn']) {
                case 'pdf':
                    $this->recepciondocumentos_pdf();
                    break;
                case 'delete':
                    $this->data['message'] = 'Hubo un error al intentar eliminar el registro, intenta de nuevo.';
                    $this->data['response'] = false;
                    $this->data['datos'] = false;
                    if (isset($_GET['p1'])) {
                        $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
                        if ($this->delete_recepciondocumentos()) {
                            $this->data['response'] = true;
                            $this->data['datos'] = true;
                            $this->data['message'] = 'Registro eliminado con &eacute;xito.';
                        }
                    }
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                    break;
                case 'fetch_all':
                    // PARAMETROS PARA FILTRADO //
                    if (isset($_POST['skRecepcionDocumento'])) {
                        $this->recepciondocumentos['skRecepcionDocumento'] = $_POST['skRecepcionDocumento'];
                    }
                    if (isset($_POST['sReferencia'])) {
                        $this->recepciondocumentos['sReferencia'] = $_POST['sReferencia'];
                    }
                    if (isset($_POST['sPedimento'])) {
                        $this->recepciondocumentos['sPedimento'] = $_POST['sPedimento'];
                    }
                    if (isset($_POST['sMercancia'])) {
                        $this->recepciondocumentos['sMercancia'] = $_POST['sMercancia'];
                    }

                    if (isset($_POST['sObservaciones'])) {
                        $this->recepciondocumentos['sObservaciones'] = $_POST['sObservaciones'];
                    }

                    if (isset($_POST['sNumContenedor'])) {
                        $this->recepciondocumentos['sNumContenedor'] = $_POST['sNumContenedor'];
                    }
                    if (isset($_POST['iBultos'])) {
                        $this->recepciondocumentos['iBultos'] = $_POST['iBultos'];
                    }
                    if (isset($_POST['fPeso'])) {
                        $this->recepciondocumentos['fPeso'] = $_POST['fPeso'];
                    }
                    if (isset($_POST['fVolumen'])) {
                        $this->recepciondocumentos['fVolumen'] = $_POST['fVolumen'];
                    }

                    if (isset($_POST['skEmpresa'])) {
                        $this->recepciondocumentos['skEmpresa'] = $_POST['skEmpresa'];
                    }
                    if (isset($_POST['skCorresponsalia'])) {
                        $this->recepciondocumentos['skCorresponsalia'] = $_POST['skCorresponsalia'];
                    }
                    if (isset($_POST['skPromotores'])) {
                        $this->recepciondocumentos['skPromotor1'] = $_POST['skPromotores'];
                        $this->recepciondocumentos['skPromotor2'] = $_POST['skPromotores'];
                    }
                    if (isset($_POST['skTipoTramite'])) {
                        $this->recepciondocumentos['skTipoTramite'] = $_POST['skTipoTramite'];
                    }
                    if (isset($_POST['sBlMaster'])) {
                        $this->recepciondocumentos['sBlMaster'] = $_POST['sBlMaster'];
                    }
                    if (isset($_POST['sBlHouse'])) {
                        $this->recepciondocumentos['sBlHouse'] = $_POST['sBlHouse'];
                    }
                    if (isset($_POST['skTipoServicio'])) {
                        $this->recepciondocumentos['skTipoServicio'] = $_POST['skTipoServicio'];
                    }
                    if (isset($_POST['sNumContenedor'])) {
                        $this->recepciondocumentos['sNumContenedor'] = $_POST['sNumContenedor'];
                    }
                    if (isset($_POST['skClaveDocumento'])) {
                        $this->recepciondocumentos['skClaveDocumento'] = $_POST['skClaveDocumento'];
                    }

                    if (!empty($_POST['dRecepcion'])) {
                        $this->recepciondocumentos['dRecepcion'] = date('Y-m-d', strtotime($_POST['dRecepcion']));
                    }
                    if (!empty($_POST['dRecepcionFin'])) {
                        $this->recepciondocumentos['dRecepcionFin'] = date('Y-m-d', strtotime($_POST['dRecepcionFin']));
                    }

                    if (!empty($_POST['dFechaCreacion'])) {
                        $this->recepciondocumentos['dFechaCreacion'] = date('Y-m-d', strtotime($_POST['dFechaCreacion']));
                    }
                    if (!empty($_POST['dFechaCreacionFin'])) {
                        $this->recepciondocumentos['dFechaCreacionFin'] = date('Y-m-d', strtotime($_POST['dFechaCreacionFin']));
                    }

                    if (isset($_POST['skUsers'])) {
                        $this->recepciondocumentos['skUsersCreacion'] = $_POST['skUsers'];
                    }

                    if (isset($_POST['skStatus'])) {
                        $this->recepciondocumentos['skStatus'] = $_POST['skStatus'];
                    }
                    //exit('<pre>'.print_r($this->recepciondocumentos,1).'</pre>');
                    if (isset($_POST['exportExcel']) && $_POST['exportExcel'] == 1) {
                        //exit('<pre>'.print_r($_POST,1).'</pre>');
                        $this->data['data'] = parent::read_recepciondocumentos();
                        $this->docume_excel();

                        return true;
                        exit;
                    }
                    // OBTENER REGISTROS //
                    $total = parent::count_recepciondocumentos();
                    $records = Core_Functions::table_ajax($total);
                    if ($records['recordsTotal'] === 0) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    $this->recepciondocumentos['limit'] = $records['limit'];
                    $this->recepciondocumentos['offset'] = $records['offset'];
                    $this->recepciondocumentos['orderBy'] = 'rd.sPedimento';
                    $this->recepciondocumentos['sortBy'] = 'DESC';
                    $this->data['data'] = parent::read_recepciondocumentos();

                    if (!$this->data['data']) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }
                    while ($row = $this->data['data']->fetch_assoc()) {
                        $actions = $this->printModulesButtons(2, array($row['skRecepcionDocumento']), $row['skUsersCreacion']);
                        $datosServicio = '<b>'.$row['TipoServicio'].'</b>';
                        // OBTENEMOS LAS MERCANCIAS //
                        $this->mercancias['skRecepcionDocumento'] = $row['skRecepcionDocumento'];
                        $mercancias = parent::read_mercancias();
                        if ($mercancias) {
                            while ($rmercancias = $mercancias->fetch_assoc()) {
                                if ($row['skTipoServicio'] == 'CONT') {
                                    $datosServicio .= '<br> BL House: '.$rmercancias['sBlhouse'].' | Contenedor: '.$rmercancias['sNumContenedor'];
                                } elseif ($row['skTipoServicio'] == 'CSUE') {
                                    $datosServicio .= '<br> Bultos: '.$rmercancias['iBultos'].' | Peso: '.$rmercancias['fPeso'].' | Volumen: '.$rmercancias['fVolumen'];
                                }
                            }
                        }
                        array_push($records['data'], array(
                            !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : '', utf8_encode($row['sReferencia']), utf8_encode($row['sPedimento']), utf8_encode($row['sBlMaster']), utf8_encode($row['TipoTramite']), utf8_encode($datosServicio), utf8_encode($row['Empresa']), utf8_encode($row['corresponsalia']), utf8_encode($row['promotor1'].'<br>'.$row['promotor2']), utf8_encode($row['skClaveDocumento']), utf8_encode($row['sMercancia']), utf8_encode($row['sObservaciones']), date('d-m-Y', strtotime($row['dRecepcion'])).' '.$row['tRecepcion'], date('d-m-Y H:i:s', strtotime($row['dFechaCreacion'])), utf8_encode($row['autor']),
                                //, utf8_encode($row['htmlStatus'])
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
        $this->load_model('cof', 'cof');
        $cof = new Cof_Model();
        $this->data['status'] = $cof->read_status();

        $cof->users['skStatus'] = 'AC';
        $cof->users['orderBy'] = '_users.sName ASC';
        $this->data['usuarios'] = $cof->read_user();

        /* 					$this->data['empresa'] = Cof_Model::read_status();
          $this->data['tipotramite'] = Cof_Model::read_status();
          $this->data['clavedocumento'] = Cof_Model::read_status();
          $this->data['coresponsalia'] = Cof_Model::read_status();
         */
        $this->load_model('emp', 'emp');
        $objEmpresa = new Emp_Model();
        $objEmpresa->tipoempresas['skStatus'] = 'AC';
        $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
        $this->data['empresas'] = $objEmpresa->read_like_empresas();
        $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CORR';
        $this->data['corresponsalias'] = $objEmpresa->read_like_empresas();
        $this->data['promotores'] = $objEmpresa->read_like_promotores();
        $this->data['tipostramites'] = parent::read_tipos_tramites();
        $this->data['tiposservicios'] = parent::read_tipos_servicios();
        $this->data['clavedocumento'] = parent::read_clave_documento();
        $this->data['corresponsalia'] = parent::read_corresponsalia();

        // RETORNA LA VISTA areas-index.php //
        $this->load_view('docume-index', $this->data);

        return true;
    }

    public function docume_form()
    {
        $this->data['message'] = '';
        $this->data['response'] = true;
        $this->data['datos'] = false;
        // SACAMOS EL PEDIMENTO EN COLA //
        $maxPedimento = parent::getMaxPedimento();
        if ($maxPedimento) {
            $this->data['maxPedimento'] = $maxPedimento['sPedimento'] + 1;
        } else {
            $this->data['maxPedimento'] = '';
        }

        if ($_POST) {

            //exit('</pre>'.print_r($_POST,1).'</pre>');
            if (empty($_POST['skRecepcionDocumento'])) {
                $this->recepciondocumentos['sPedimento'] = utf8_decode($_POST['sPedimento']);
                if (parent::read_recepciondocumentos()) {
                    $this->data['response'] = false;
                    $this->data['errorPedimento'] = false;
                    $this->data['message'] = 'El pedimento '.$this->recepciondocumentos['sPedimento'].' Ya ha sido utilizado, intenta con '.($maxPedimento['sPedimento'] + 1);
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            }
            $this->recepciondocumentos['skRecepcionDocumento'] = !empty($_POST['skRecepcionDocumento']) ? $_POST['skRecepcionDocumento'] : substr(md5(microtime()), 1, 32);
            $this->recepciondocumentos['sReferencia'] = addslashes(utf8_decode($_POST['sReferencia']));
            $this->recepciondocumentos['sPedimento'] = addslashes(utf8_decode($_POST['sPedimento']));
            $this->recepciondocumentos['sBlMaster'] = !empty($_POST['sBlMaster']) ? addslashes(utf8_decode($_POST['sBlMaster'])) : '';
            $this->recepciondocumentos['sMercancia'] = addslashes(utf8_decode($_POST['sMercancia']));
            $this->recepciondocumentos['sObservaciones'] = addslashes(utf8_decode($_POST['sObservaciones']));
            $this->recepciondocumentos['skEmpresa'] = utf8_decode($_POST['skEmpresa']);
            $this->recepciondocumentos['skTipoTramite'] = utf8_decode($_POST['skTipoTramite']);
            $this->recepciondocumentos['skTipoServicio'] = utf8_decode($_POST['skTipoServicio']);
            $this->recepciondocumentos['skClaveDocumento'] = utf8_decode($_POST['skClaveDocumento']);
            $this->recepciondocumentos['dRecepcion'] = utf8_decode(!empty($_POST['dRecepcion']) ? date('Y-m-d', strtotime($_POST['dRecepcion'])) : date('Y-m-d'));
            $this->recepciondocumentos['tRecepcion'] = utf8_decode(!empty($_POST['tRecepcion']) ? $_POST['tRecepcion'] : date('H:i:s'));
            //exit('<pre>'.print_r($this->recepciondocumentos,1));
            if (empty($_POST['skRecepcionDocumento'])) {
                $skRecepcionDocumento = parent::create_recepciondocumentos();
                if ($skRecepcionDocumento) {
                    $this->mercancias['skRecepcionDocumento'] = $skRecepcionDocumento;
                    if ($_POST['skTipoServicio'] == 'CONT') { // CONTENEDORES
                        if (isset($_POST['sNumContenedor'])) {
                            for ($i = 0; $i < count($_POST['sNumContenedor']); ++$i) {
                                $this->mercancias['skMercancia'] = substr(md5(microtime()), 1, 32);
                                $this->mercancias['sBlhouse'] = addslashes(utf8_decode($_POST['sBlhouse'][$i]));
                                $this->mercancias['sNumContenedor'] = addslashes(utf8_decode($_POST['sNumContenedor'][$i]));
                                $this->mercancias['skTipoContenedor'] = addslashes(utf8_decode($_POST['skTipoContenedor'][$i]));
                                $this->mercancias['skEmbalaje'] = addslashes(utf8_decode($_POST['skEmbalaje'][$i]));
                                if (!empty($this->mercancias['sNumContenedor'])) {
                                    parent::create_mercancias();
                                }
                            }
                        }
                    } elseif ($_POST['skTipoServicio'] == 'CSUE') { // CARGA SUELTA
                        if (isset($_POST['iBultos'])) {
                            for ($i = 0; $i < count($_POST['iBultos']); ++$i) {
                                $this->mercancias['skMercancia'] = substr(md5(microtime()), 1, 32);
                                $this->mercancias['iBultos'] = addslashes(utf8_decode($_POST['iBultos'][$i]));
                                $this->mercancias['fPeso'] = addslashes(utf8_decode($_POST['fPeso'][$i]));
                                $this->mercancias['fVolumen'] = addslashes(utf8_decode($_POST['fVolumen'][$i]));
                                if (!empty($this->mercancias['iBultos']) && !empty($this->mercancias['fPeso']) && !empty($this->mercancias['fVolumen'])) {
                                    parent::create_mercancias();
                                }
                            }
                        }
                    }
                    //echo ('</pre>'.print_r($_FILES,1).'</pre>');
                    if (isset($_FILES['skDocTipo'])) {
                        foreach ($_FILES['skDocTipo'] as $k => $v) {
                            if ($k === 'name') {
                                foreach ($v as $key => $val) {
                                    // AQUI HACEMOS EL MOVE_UPLOADED_FILE //
                                    $fileName = time().$_FILES['skDocTipo']['name'][$key];
                                    if (move_uploaded_file($_FILES['skDocTipo']['tmp_name'][$key], SYS_PATH.'/doc/files/'.$fileName)) {
                                        $this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'] = substr(md5(microtime()), 1, 32);
                                        $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
                                        $this->recepcionDoc_docTipo['skDocTipo'] = $key;
                                        $this->recepcionDoc_docTipo['sFile'] = $fileName;
                                        parent::create_recepcionDoc_docTipo();
                                    }
                                }
                            }
                        }
                    }
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro insertado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = false;
                    $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            } else {
                //echo ('</pre>'.print_r($_POST,1).'</pre>');
                $this->mercancias['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
                parent::delete_mercancias();
                if ($_POST['skTipoServicio'] == 'CONT') { // CONTENEDORES
                    if (isset($_POST['sNumContenedor'])) {
                        for ($i = 0; $i < count($_POST['sNumContenedor']); ++$i) {
                            $this->mercancias['skMercancia'] = substr(md5(microtime()), 1, 32);
                            $this->mercancias['sBlhouse'] = addslashes(utf8_decode($_POST['sBlhouse'][$i]));
                            $this->mercancias['sNumContenedor'] = addslashes(utf8_decode($_POST['sNumContenedor'][$i]));
                            $this->mercancias['skTipoContenedor'] = addslashes(utf8_decode($_POST['skTipoContenedor'][$i]));
                            $this->mercancias['skEmbalaje'] = addslashes(utf8_decode($_POST['skEmbalaje'][$i]));
                            if (!empty($this->mercancias['sNumContenedor'])) {
                                parent::create_mercancias();
                            }
                        }
                    }
                } elseif ($_POST['skTipoServicio'] == 'CSUE') { // CARGA SUELTA
                    if (isset($_POST['iBultos'])) {
                        for ($i = 0; $i < count($_POST['iBultos']); ++$i) {
                            $this->mercancias['skMercancia'] = substr(md5(microtime()), 1, 32);
                            $this->mercancias['iBultos'] = addslashes(utf8_decode($_POST['iBultos'][$i]));
                            $this->mercancias['fPeso'] = addslashes(utf8_decode($_POST['fPeso'][$i]));
                            $this->mercancias['fVolumen'] = addslashes(utf8_decode($_POST['fVolumen'][$i]));
                            if (!empty($this->mercancias['iBultos']) && !empty($this->mercancias['fPeso']) && !empty($this->mercancias['fVolumen'])) {
                                parent::create_mercancias();
                            }
                        }
                    }
                }
                if (isset($_FILES['skDocTipo'])) {
                    $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
                    $this->recepcionDoc_docTipo['skStatus'] = 'IN';
                    parent::updateStatus_recepcionDoc_docTipo();
                    foreach ($_FILES['skDocTipo'] as $k => $v) {
                        if ($k === 'name') {
                            foreach ($v as $key => $val) {
                                // AQUI HACEMOS EL MOVE_UPLOADED_FILE //
                                $fileName = time().$_FILES['skDocTipo']['name'][$key];
                                if (move_uploaded_file($_FILES['skDocTipo']['tmp_name'][$key], SYS_PATH.'/doc/files/'.$fileName)) {
                                    $this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'] = substr(md5(microtime()), 1, 32);
                                    $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $this->recepciondocumentos['skRecepcionDocumento'];
                                    $this->recepcionDoc_docTipo['skDocTipo'] = $key;
                                    $this->recepcionDoc_docTipo['sFile'] = $fileName;
                                    parent::create_recepcionDoc_docTipo();
                                }
                            }
                        }
                    }
                    if (!empty($_POST['skDocTipo'])) {
                        foreach ($_POST['skDocTipo'] as $a => $b) {
                            $this->recepcionDoc_docTipo['skRecepcionDoc_docTipo'] = $b;
                            $this->recepcionDoc_docTipo['skStatus'] = 'AC';
                            parent::updateStatus_recepcionDoc_docTipo();
                        }
                    }
                }
                if (parent::update_recepciondocumentos()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = false;
                    $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            }
        }
        $this->load_model('emp', 'emp');
        $objEmpresa = new Emp_Model();
        $objEmpresa->tipoempresas['skTipoEmpresa'] = 'CLIE';
        $this->data['empresas'] = $objEmpresa->read_like_empresas();
        $this->data['tipostramites'] = parent::read_tipos_tramites();
        $this->data['tiposservicios'] = parent::read_tipos_servicios();
        $this->data['clavedocumento'] = parent::read_clave_documento();
        $this->data['docTipo'] = parent::read_equal_docTipo();
        $this->data['mercancias'] = false;
        $this->data['embalajes'] = parent::read_cat_embalajes();

        if (isset($_GET['p1'])) {
            $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
            $this->recepcionDoc_docTipo['skRecepcionDocumento'] = $_GET['p1'];
            $this->data['datos'] = parent::read_recepciondocumentos();
            $this->data['filesDocTipo'] = parent::read_equal_recepcionDoc_docTipo();
            // Retorna las mercancias (rel_recepciones_mercancias) //
            $this->mercancias['skRecepcionDocumento'] = $_GET['p1'];
            $this->data['mercancias'] = parent::read_mercancias();

            /*
             * ESTO ES PARA QUE SOLO PUEDA MODIFICAR EL USUARIO QUE CREÓ EL REGISTRO
             */
            $result = $this->data['datos']->fetch_assoc();
            $this->data['datos']->data_seek(0);
            $this->verify_access('W', $result['skUsersCreacion']);
            /* FINALIZA SEGURIDAD DE AUTOR DE REGISTRO */
        }
        $this->load_view('docume-form', $this->data);

        return true;
    }

    public function docume_excel()
    {
        //echo date('H:i:s') . ' Current memory usage: ' . (memory_get_usage(true) / 1024 / 1024) . " MB <hr>" . PHP_EOL;
        ini_set('memory_limit', '-1');
        require_once CORE_PATH.'assets/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load(SYS_PATH.'doc/files/docume/tplRecepcionDocumentos.xlsx');
        $i = 2;
        $this->data['data'] = parent::read_recepciondocumentos();
        while ($row = $this->data['data']->fetch_assoc()) {

            //OBTENER PROMOROTES //
            $promotores = $row['promotor1'];
            if (!empty($row['promotor2'])) {
                $promotores .= ' | '.$row['promotor2'];
            }

            // OBTENEMOS LAS MERCANCIAS //
            $datosServicio = $row['TipoServicio'];
            $this->mercancias['skRecepcionDocumento'] = $row['skRecepcionDocumento'];
            $mercancias = parent::read_mercancias();
            if ($mercancias) {
                while ($rmercancias = $mercancias->fetch_assoc()) {
                    if ($row['skTipoServicio'] == 'CONT') {
                        $datosServicio .= "\nBL House: ".$rmercancias['sBlhouse'].' | Contenedor: '.$rmercancias['sNumContenedor'];
                    } elseif ($row['skTipoServicio'] == 'CSUE') {
                        $datosServicio .= "\nBultos: ".$rmercancias['iBultos'].' | Peso: '.$rmercancias['fPeso'].' | Volumen: '.$rmercancias['fVolumen'];
                    }
                }
            }

            //exit('<pre>'.print_r($mercancias,1).'</pre>');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, utf8_encode($row['sReferencia']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, utf8_encode($row['sPedimento']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, utf8_encode($row['sBlMaster']));
            //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, utf8_encode($row['sBlHouse']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, utf8_encode($row['TipoTramite']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, utf8_encode($datosServicio));
            $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, utf8_encode($row['Empresa']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, utf8_encode($row['corresponsalia']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, utf8_encode($promotores));
            $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, utf8_encode($row['skClaveDocumento']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, utf8_encode($row['sMercancia']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, utf8_encode($row['sObservaciones']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, date('d-m-Y', strtotime($row['dRecepcion'])).' '.$row['tRecepcion']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i, date('d-m-Y H:i:s', strtotime($row['dFechaCreacion'])));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i, utf8_encode($row['autor']));
            ++$i;
        }
        //exit('<pre>'.print_r($objPHPExcel,1).'<pre>');
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="RecepcionDocumentos.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //$objWriter->save(SYS_PATH.'doc/files/docume/RecepcionDocumentos.xlsx');
        $objWriter->save('php://output');

        //exit('<pre>'.print_r($records,1).'</pre>');
        exit;
    }

    public function docume_detail()
    {
        if (isset($_GET['p1'])) {
            $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
            $this->data['datos'] = parent::read_recepciondocumentos();
        }
        $this->load_view('docume-detail', $this->data);

        return true;
    }

    private function recepciondocumentos_pdf()
    {
        if (isset($_GET['p1'])) {
            $this->recepciondocumentos['skRecepcionDocumento'] = $_GET['p1'];
            $datos = parent::read_recepciondocumentos();
            if ($datos) {
                $this->data['datos'] = $datos->fetch_assoc();
            }
            // OBTENEMOS LAS MERCANCIAS //
            $this->data['mercancias'] = '';
            $this->mercancias['skRecepcionDocumento'] = $_GET['p1'];
            $mercancias = parent::read_mercancias();
            if ($mercancias) {
                while ($rmercancias = $mercancias->fetch_assoc()) {
                    if ($this->data['datos']['skTipoServicio'] == 'CONT') {
                        $this->data['mercancias'] .= '<br> <b>BL House:</b> '.$rmercancias['sBlhouse'].' <b>| Contenedor:</b> '.$rmercancias['sNumContenedor'];
                    } elseif ($this->data['datos']['skTipoServicio'] == 'CSUE') {
                        $this->data['mercancias'] .= '<br> <b>Bultos:</b> '.$rmercancias['iBultos'].' <b>| Peso:</b> '.$rmercancias['fPeso'].' <b>| Volumen:</b> '.$rmercancias['fVolumen'];
                    }
                }
            }
        }

        $this->data['config'] = array(
            'title' => 'Recepción de Documentos', 'date' => date('d-m-Y H:i:s'), 'company' => 'Gomez y Alvez', 'address' => 'Manzanillo, Colima', 'phone' => '', 'website' => '', 'background_image' => (SYS_URL).'core/assets/img/logoPdf.png', 'header' => (CORE_PATH).'assets/pdf/tplHeaderPdf.php', 'footer' => (CORE_PATH).'assets/pdf/tplFooterPdf.php', 'style' => (CORE_PATH).'assets/pdf/tplStylePdf.php',
        );
        ob_start();
        $this->load_view('docume-pdf', $this->data, false, 'doc/pdf/');
        $content = ob_get_clean();
        $title = 'Recepci&oacute;n de documentos';
        Core_Functions::pdf($content, $this->data['config']['title'], 'P', 'A4', 'es', true, 'UTF-8', array(5, 5, 5, 5));

        return true;
    }

    public function clavdocu_index()
    {
        if (isset($_GET['axn'])) {
            switch ($_GET['axn']) {
                case 'pdf':
                    $this->clavdocu_pdf();
                    break;
                case 'fetch_all':
                    // PARAMETROS PARA FILTRADO //
                    if (isset($_POST['skClaveDocumento'])) {
                        $this->clavdocu['skClaveDocumento'] = $_POST['skClaveDocumento'];
                    }
                    if (isset($_POST['sNombre'])) {
                        $this->clavdocu['sNombre'] = $_POST['sNombre'];
                    }

                    if (isset($_POST['skStatus'])) {
                        $this->clavdocu['skStatus'] = $_POST['skStatus'];
                    }

                    // OBTENER REGISTROS //
                    $total = parent::count_clavdocu();
                    $records = Core_Functions::table_ajax($total);
                    if ($records['recordsTotal'] === 0) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    $this->clavdocu['limit'] = $records['limit'];
                    $this->clavdocu['offset'] = $records['offset'];
                    $this->data['data'] = parent::read_like_clavdocu();

                    if (!$this->data['data']) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    while ($row = $this->data['data']->fetch_assoc()) {
                        $actions = $this->printModulesButtons(2, array($row['skClaveDocumento']));
                        array_push($records['data'], array(
                            utf8_encode($row['skClaveDocumento']), utf8_encode($row['sNombre']), utf8_encode($row['htmlStatus']), !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : '',
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
        $this->load_model('cof', 'cof');
        $cof = new Cof_Model();
        $this->data['status'] = $cof->read_status();

        // RETORNA LA VISTA areas-index.php //
        $this->load_view('clavdocu-index', $this->data);

        return true;
    }

    public function clavdocu_form()
    {
        $this->data['message'] = '';
        $this->data['success'] = false;
        $this->data['error'] = false;
        $this->data['datos'] = false;
        if ($_POST) {
            $this->clavdocu['skClaveDocumentoViejo'] = $_POST['skClaveDocumentoViejo'];
            $this->clavdocu['skClaveDocumento'] = $_POST['skClaveDocumento'];
            $this->clavdocu['sNombre'] = htmlentities($_POST['sNombre'], ENT_QUOTES);
            $this->clavdocu['skStatus'] = htmlentities($_POST['skStatus'], ENT_QUOTES);

            if (empty($_POST['skClaveDocumentoViejo'])) {
                if (parent::create_clavdocu()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro insertado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            } else {
                if (parent::update_clavdocu()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            }
        }
        if (isset($_GET['p1'])) {
            $this->clavdocu['skClaveDocumento'] = $_GET['p1'];
            $this->data['datos'] = parent::read_equal_clavdocu();
        }
        $this->load_view('clavdocu-form', $this->data);

        return true;
    }

    public function clavdocu_detail()
    {
        if (isset($_GET['p1'])) {
            $this->clavdocu['skClaveDocumento'] = $_GET['p1'];
            $this->data['datos'] = parent::read_equal_clavdocu();
        }
        if (isset($_GET['axn'])) {
            switch ($_GET['axn']) {
                case 'pdf':
                    $this->clavdocu_pdf();
                    break;
            }
        }
        $this->load_view('clavdocu-detail', $this->data);

        return true;
    }

    public function correspo_index()
    {
        if (isset($_GET['axn'])) {
            switch ($_GET['axn']) {
                case 'pdf':
                    $this->correspo_pdf();
                    break;
                case 'fetch_all':
                    // PARAMETROS PARA FILTRADO //
                    if (isset($_POST['skCorresponsalia'])) {
                        $this->correspo['skCorresponsalia'] = $_POST['skCorresponsalia'];
                    }
                    if (isset($_POST['sNombre'])) {
                        $this->correspo['sNombre'] = $_POST['sNombre'];
                    }

                    if (isset($_POST['skStatus'])) {
                        $this->correspo['skStatus'] = $_POST['skStatus'];
                    }

                    // OBTENER REGISTROS //
                    $total = parent::count_correspo();
                    $records = Core_Functions::table_ajax($total);
                    if ($records['recordsTotal'] === 0) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    $this->correspo['limit'] = $records['limit'];
                    $this->correspo['offset'] = $records['offset'];
                    $this->data['data'] = parent::read_like_correspo();

                    if (!$this->data['data']) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    while ($row = $this->data['data']->fetch_assoc()) {
                        $actions = $this->printModulesButtons(2, array($row['skCorresponsalia']));
                        array_push($records['data'], array(
                            utf8_encode($row['skCorresponsalia']), utf8_encode($row['sNombre']), utf8_encode($row['htmlStatus']), !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : '',
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
        $this->load_model('cof', 'cof');
        $cof = new Cof_Model();
        $this->data['status'] = $cof->read_status();

        // RETORNA LA VISTA areas-index.php //
        $this->load_view('correspo-index', $this->data);

        return true;
    }

    public function correspo_form()
    {
        $this->data['message'] = '';
        $this->data['success'] = false;
        $this->data['error'] = false;
        $this->data['datos'] = false;
        if ($_POST) {
            $this->correspo['skCorresponsaliaViejo'] = $_POST['skCorresponsaliaViejo'];
            $this->correspo['skCorresponsalia'] = $_POST['skCorresponsalia'];
            $this->correspo['sNombre'] = htmlentities($_POST['sNombre'], ENT_QUOTES);
            $this->correspo['skStatus'] = htmlentities($_POST['skStatus'], ENT_QUOTES);

            if (empty($_POST['skCorresponsaliaViejo'])) {
                if (parent::create_correspo()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro insertado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            } else {
                if (parent::update_correspo()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            }
        }
        if (isset($_GET['p1'])) {
            $this->correspo['skCorresponsalia'] = $_GET['p1'];
            $this->data['datos'] = parent::read_equal_correspo();
        }
        $this->load_view('correspo-form', $this->data);

        return true;
    }

    // ARCHIVOS DE DOCUMENTACIÓN (RECEPCIÓN DE DOCUMENTOS) //
    public function arcdocu_index()
    {
        if (isset($_GET['axn'])) {
            switch ($_GET['axn']) {
                case 'fetch_all':

                    // PARAMETROS PARA FILTRADO //
                    if (isset($_POST['skDocTipo'])) {
                        $this->recepcionDoc_docTipo['skDocTipo'] = $_POST['skDocTipo'];
                    }
                    if (isset($_POST['sNombre'])) {
                        $this->recepcionDoc_docTipo['sNombre'] = $_POST['sNombre'];
                    }

                    if (isset($_POST['skStatus'])) {
                        $this->recepcionDoc_docTipo['skStatus'] = $_POST['skStatus'];
                    }

                    // OBTENER REGISTROS //
                    $total = parent::count_docTipo();
                    $records = Core_Functions::table_ajax($total);
                    if ($records['recordsTotal'] === 0) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    $this->recepcionDoc_docTipo['limit'] = $records['limit'];
                    $this->recepcionDoc_docTipo['offset'] = $records['offset'];
                    $this->data['data'] = parent::read_like_docTipo();

                    if (!$this->data['data']) {
                        header('Content-Type: application/json');
                        echo json_encode($records);

                        return false;
                    }

                    while ($row = $this->data['data']->fetch_assoc()) {
                        $actions = $this->printModulesButtons(2, array($row['skDocTipo']));
                        array_push($records['data'], array(
                            utf8_encode($row['skDocTipo']), utf8_encode($row['sNombre']), utf8_encode($row['htmlStatus']), !empty($actions['sHtml']) ? '<div class="dropdown"><button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default btn-xs dropdown-toggle">Acciones<span class="caret"></span></button><ul aria-labelledby="dropdownMenu1" class="dropdown-menu">'.utf8_encode($actions['sHtml']).'</ul></div>' : '',
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
        $this->load_model('cof', 'cof');
        $cof = new Cof_Model();
        $this->data['status'] = $cof->read_status();

        // RETORNA LA VISTA areas-index.php //
        $this->load_view('arcdocu-index', $this->data);

        return true;
    }

    public function arcdocu_form()
    {
        $this->data['message'] = '';
        $this->data['success'] = false;
        $this->data['error'] = false;
        $this->data['datos'] = false;
        if ($_POST) {
            $this->recepcionDoc_docTipo['skDocTipoViejo'] = $_POST['skDocTipoViejo'];
            $this->recepcionDoc_docTipo['skDocTipo'] = isset($_POST['skDocTipo']) ? $_POST['skDocTipo'] : $_POST['skDocTipoViejo'];
            $this->recepcionDoc_docTipo['sNombre'] = htmlentities($_POST['sNombre'], ENT_QUOTES);
            $this->recepcionDoc_docTipo['skStatus'] = htmlentities($_POST['skStatus'], ENT_QUOTES);

            if (empty($_POST['skDocTipoViejo'])) {
                if (parent::create_docTipo()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro insertado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al intentar insertar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            } else {
                if (parent::update_docTipo()) {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Registro actualizado con &eacute;xito.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return true;
                } else {
                    $this->data['response'] = true;
                    $this->data['message'] = 'Hubo un error al intentar actualizar el registro, intenta de nuevo.';
                    header('Content-Type: application/json');
                    echo json_encode($this->data);

                    return false;
                }
            }
        }
        if (isset($_GET['p1'])) {
            $this->recepcionDoc_docTipo['skDocTipo'] = $_GET['p1'];
            $this->data['datos'] = parent::read_equal_docTipo();
        }
        $this->load_view('arcdocu-form', $this->data);

        return true;
    }

    /* TERMINA MODULO CAPTURA DE DOCUMENTOS */
}

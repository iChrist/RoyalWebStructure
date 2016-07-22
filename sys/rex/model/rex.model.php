<?php
Class Rex_Model Extends Core_Model {

    // PUBLIC VARIABLES //
    public $ref = array(
        'id'=>null,
        'nombre'=>null
    );

    public $refex = array(
      'skReferenciaExterna'=>null,
      'skFotoReferencia'=>null,
      'codigo'=>null,
      'sUbicacion'=>null

        );
    // PRIVATE VARIABLES //
    private $data = array();

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {

    }

    /* COMIENZA MODULO (REX) */

    public function getMaxPedimento() {
        $sql = "SELECT MAX(sPedimento) AS sPedimento FROM ope_referenciasExternas WHERE skEstatus != 'EL' ";
        //exit($sql);
        $result = $this->db->query($sql);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getrefex($skStatus = null)
    {
        $sql = "SELECT * FROM refex";
        if($skStatus != null){ $sql .=" WHERE skStatus = '$skStatus'"; }
        $result = $this->db->query($sql);
        if(!$result){
            return false;
        }
        $records = array();
        while($row = $result->fetch_assoc()){
            array_push($records , $row);
        }
        return $records;
    }

    public function insertar()
    {

        $skReferenciaExterna =  substr(md5(microtime()), 1, 32);

        $fechas = array(
            'dFechaPrevio'              => (
                    $_POST["dFechaPrevio"] !== NULL &&
                    $_POST["dFechaPrevio"] !== "" &&
                    isset($_POST["dFechaPrevio"]))?
            "'".DateTime::createFromFormat('d-m-Y', $_POST["dFechaPrevio"])->format('Y-m-d')."'" :  NULL ,

            'dFechaDespacho'            => (
                    $_POST["dFechaDespacho"] !== NULL &&
                    $_POST["dFechaDespacho"] !== "" &&
                    isset($_POST["dFechaDespacho"]))?
            "'".DateTime::createFromFormat('d-m-Y', $_POST["dFechaDespacho"])->format('Y-m-d') ."'":  NULL,

            'dFechaClasificacion'       => (
                    $_POST["dFechaClasificacion"] !== NULL &&
                    $_POST["dFechaClasificacion"] !== "" &&
                    isset($_POST["dFechaClasificacion"]))?
            "'". DateTime::createFromFormat('d-m-Y', $_POST["dFechaClasificacion"])->format('Y-m-d') ."'" :  NULL,

            'dFechaGlosa'               => (
                    $_POST["dFechaGlosa"] !== NULL &&
                    $_POST["dFechaGlosa"] !== "" &&
                    isset($_POST["dFechaGlosa"])) ?
            "'".DateTime::createFromFormat('d-m-Y', $_POST["dFechaGlosa"])->format('Y-m-d')."'":  NULL,

            'dFechaCapturaPedimento'    => (
                    $_POST["dFechaCapturaPedimento"] !== NULL &&
                    $_POST["dFechaCapturaPedimento"] !== "" &&
                    isset($_POST["dFechaCapturaPedimento"])) ?
            "'".DateTime::createFromFormat('d-m-Y', $_POST["dFechaCapturaPedimento"])->format('Y-m-d')."'":  NULL,

            'dFechaRevalidacion'        => (
                    $_POST["dFechaRevalidacion"] !== NULL &&
                    $_POST["dFechaRevalidacion"] !== "" &&
                    isset($_POST["dFechaRevalidacion"])) ?
            "'".DateTime::createFromFormat('d-m-Y', $_POST["dFechaRevalidacion"])->format('Y-m-d') ."'":  NULL,

            'dFechaFacturacion'         => (
                    $_POST["dFechaRevalidacion"] !== NULL &&
                    $_POST["dFechaRevalidacion"] !== "" &&
                    isset($_POST["dFechaRevalidacion"])) ?
            "'".DateTime::createFromFormat('d-m-Y', $_POST["dFechaRevalidacion"])->format('Y-m-d')."'":  NULL
            );

        $sql_insert = "
            INSERT INTO `ope_referenciasExternas` (
                `skReferenciaExterna`,
                `skSocioPropietario`,
                `skEmpresaPropietario`,
                `skSocioImportador`,
                `skAlmacen`,
                `skEstatus`,
                `sPedimento`,
                `sReferencia`,
                `sMercancia`,
                `sGuiaMaster`,
                `sGuiaHouse`,
                `iBultos`,
                `skUsuarioCreacion`,
                `dFechaCreacion`,
                `dFechaPrevio`,
                `dFechaDespacho`,
                `dFechaClasificacion`,
                `dFechaGlosa`,
                `dFechaCapturaPedimento`,
                `dFechaRevalidacion`,
                `dFechaFacturacion`,
                `iDeposito`,
                `iSaldo`,
                dTipoCambio
            )

            VALUES (
                '$skReferenciaExterna',
                '" . $this->db->real_escape_string($_SESSION["session"]["skSocioEmpresaPropietario"]) . "',
                '" . $this->db->real_escape_string($_SESSION["session"]["skEmpresaPropietario"])."',
                '" . $this->db->real_escape_string($_POST["skSocioImportador"]) . "',
                '" . $this->db->real_escape_string($_POST["skAlmacen"]) . "',
                '" . $this->db->real_escape_string($_POST["skEstatus"]) . "',
                '" . $this->db->real_escape_string($_POST["sPedimento"]) . "',
                '" . $this->db->real_escape_string($_POST["sReferencia"]) . "',
                '" . $this->db->real_escape_string($_POST["sMercancia"]) . "',
                '" . $this->db->real_escape_string($_POST["sGuiaMaster"]) . "',
                '" . $this->db->real_escape_string($_POST["sGuiaHouse"]) . "',
                '" . $_POST["iBultos"]."',
                '" . $_SESSION["session"]["skUsers"]."',
                     NOW(),
                " . $fechas["dFechaPrevio"] .",
                " . $fechas["dFechaDespacho"].",
                " . $fechas["dFechaClasificacion"].",
                " . $fechas["dFechaGlosa"].",
                " . $fechas["dFechaCapturaPedimento"].",
                " . $fechas["dFechaRevalidacion"].",
                " . $fechas["dFechaFacturacion"].",
                '" . $_POST["iDeposito"]."',
                '" . $_POST["iSaldo"]."',
                '" . $_POST["fTipoCambio"]."');" ;
            if (isset($_POST["conceptos"]) && isset($_POST["iCantidad"])) {
                for ($i= 0; $i < count($_POST["conceptos"]); $i++) {
                    $this->insertConceptos(
                        $skReferenciaExterna,
                        $_POST["conceptos"][$i],
                        $_POST["iCantidad"][$i],
                        $_POST["subtotal"][$i],
                        $_POST["fPrecioUnitario"][$i],
                        $_POST["divisa"][$i]);

            }
        }


        if (isset($_POST) ) {

            $result = $this->db->query($sql_insert);
            return true;
        }else{
            return false;
        }

    }

    public function updatear($skReferenciaExterna = NULL)
    {
        if ($skReferenciaExterna == NULL && $skReferenciaExterna != '') {
            return false;
        }

        $this->deleteConceptos($skReferenciaExterna);
        $sql_update = "
            UPDATE `ope_referenciasExternas` SET
                `skSocioPropietario` = '".$this->db->real_escape_string($_SESSION["session"]["skSocioEmpresaPropietario"])."',
                `skEmpresaPropietario` = '" . $this->db->real_escape_string($_SESSION["session"]["skEmpresaPropietario"])."',
                `skSocioImportador` = '" . $this->db->real_escape_string($_POST["skSocioImportador"]) . "',
                `skAlmacen` = '" . $this->db->real_escape_string($_POST["skAlmacen"]) . "',
                `skEstatus` = '" . $this->db->real_escape_string($_POST["skEstatus"]) . "',
                `sPedimento` ='" . $this->db->real_escape_string($_POST["sPedimento"]) . "',
                `sReferencia` = '" . $this->db->real_escape_string($_POST["sReferencia"]) . "',
                `sMercancia` = '" . $this->db->real_escape_string($_POST["sMercancia"]) . "',
                `sGuiaMaster` = '" . $this->db->real_escape_string($_POST["sGuiaMaster"]) . "',
                `sGuiaHouse` = '" . $this->db->real_escape_string($_POST["sGuiaHouse"]) . "',
                `iBultos` = '".$_POST["iBultos"]."',
                `dFechaPrevio` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaPrevio"])->format('Y-m-d')."',
                `dFechaDespacho` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaDespacho"])->format('Y-m-d')."',
                `dFechaClasificacion` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaClasificacion"])->format('Y-m-d')."',
                `dFechaGlosa` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaGlosa"])->format('Y-m-d')."',
                `dFechaCapturaPedimento` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaCapturaPedimento"])->format('Y-m-d')."',
                `dFechaRevalidacion` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaRevalidacion"])->format('Y-m-d')."',

                `dFechaFacturacion` = '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaFacturacion"])->format('Y-m-d')."',
                `iDeposito` = '".$_POST["iDeposito"]."',
                `iSaldo` = '".$_POST["iSaldo"]."',
                `dTipoCambio` = '".$_POST["fTipoCambio"]."'

                WHERE `skReferenciaExterna` = '$skReferenciaExterna';" ;

        if (isset($_POST["conceptos"]) && isset($_POST["iCantidad"])) {

            for ($i= 0; $i < count($_POST["conceptos"]); $i++) {
                $this->insertConceptos(
                    $skReferenciaExterna,
                    $_POST["conceptos"][$i],
                    $_POST["iCantidad"][$i],
                    $_POST["subtotal"][$i],
                    $_POST["fPrecioUnitario"][$i],
                    $_POST["divisa"][$i]);
            }
        }

        if (isset($_POST) ) {
            $result = $this->db->query($sql_update);
            return true;
        }else{
            return false;
        }
    }

    public function getReferencia($skID = NULL)
    {
        $r = $this->db->query("SELECT * FROM ope_referenciasExternas WHERE skReferenciaExterna = '$skID'");
        if ($this->db->affected_rows > 0){
            return $r->fetch_assoc();
        }else{
            return false;
        }
    }

    public function getAlmacenes()
    {
        $sql_almacenes = 'SELECT * FROM cat_almacenes;';
        $r = $this->db->query($sql_almacenes);

        if ($this->db->affected_rows > 0){
            $arg = array();
            while ($row = $r->fetch_assoc()) {
                array_push($arg, $row);
            }
            return $arg;
        }else{
            return false;
        }
    }

    public function getStatus()
    {
        $sql_status = 'SELECT * FROM cat_estatus;';
        $r = $this->db->query($sql_status);
        if ($this->db->affected_rows > 0){
            $arg = array();
            while ($row = $r->fetch_assoc()) {
                array_push($arg, $row);
            }
            return $arg;
        }else{
            return false;
        }
    }

    public function getSociosImportador($socioEmpresaP = false )
    {

        $sql_socios = "SELECT
                rel_empresas_socios.skSocioEmpresa,
                rel_empresas_socios.skEmpresa,
                cat_empresas.sNombre as 'Empresa'
                FROM
                    rel_empresas_socios
                        INNER JOIN
                    cat_empresas ON (cat_empresas.skEmpresa = rel_empresas_socios.skEmpresa)
                WHERE
                    skSocioEmpresaP = '$socioEmpresaP'
                    AND skTipoEmpresa = 'CLIE'
                ORDER BY sNombre;";
        //die($sql_socios);
        $r = $this->db->query($sql_socios);

        if ($this->db->affected_rows > 0){
            $arg = array();
            while ($row = $r->fetch_assoc()) {
                array_push($arg, $row);
            }
            return $arg;
        }else{
            return false;
        }
    }

    public function selectAllope()
    {
        $sql_select_all = "
        SELECT
            ope_referenciasExternas.skReferenciaExterna,
            ope_referenciasExternas.sPedimento,
            ope_referenciasExternas.sReferencia,
            ope_referenciasExternas.sMercancia,
            ope_referenciasExternas.sGuiaMaster,
            ope_referenciasExternas.sGuiaHouse,
            ope_referenciasExternas.dFechaCreacion,
            ope_referenciasExternas.dFechaPrevio,
            ope_referenciasExternas.dFechaDespacho,
            ope_referenciasExternas.dFechaClasificacion,
            ope_referenciasExternas.dFechaGlosa,
            ope_referenciasExternas.dFechaCapturaPedimento,
            ope_referenciasExternas.dFechaFacturacion,
            ope_referenciasExternas.iDeposito,
            ope_referenciasExternas.iSaldo,
            cat_almacenes.sNombre AS 'sAlmacen',
            cat_estatus.sNombre AS 'sEstatus',
            cat_empresas.sNombre AS 'sSocioImportador'
        FROM
            ope_referenciasExternas
                INNER JOIN
            cat_almacenes ON (cat_almacenes.skAlmacen = ope_referenciasExternas.skAlmacen)
                INNER JOIN
            cat_estatus ON (cat_estatus.skEstatus = ope_referenciasExternas.skEstatus)
                INNER JOIN
            cat_empresas ON (cat_empresas.skEmpresa = ope_referenciasExternas.skSocioImportador);";

        $r = $this->db->query($sql_select_all);

        if ($this->db->affected_rows > 0){
            $arg = array();
            while ($row = $r->fetch_assoc()) {
                array_push($arg, $row);
            }
            return $arg;
        }else{
            return false;
        }
    }

    public function countGetReferenciasExternas($get = false)
{
    $getol = "
        ope_referenciasExternas.skReferenciaExterna,
        ope_referenciasExternas.sPedimento,
        ope_referenciasExternas.sReferencia,
        ope_referenciasExternas.sMercancia,
        ope_referenciasExternas.sGuiaMaster,
        ope_referenciasExternas.sGuiaHouse,
        ope_referenciasExternas.dFechaCreacion,
        ope_referenciasExternas.dFechaPrevio,
        ope_referenciasExternas.dFechaDespacho,
        ope_referenciasExternas.dFechaClasificacion,
        ope_referenciasExternas.dFechaGlosa,
        ope_referenciasExternas.dFechaCapturaPedimento,
        ope_referenciasExternas.dFechaFacturacion,
        ope_referenciasExternas.iDeposito,
        ope_referenciasExternas.iSaldo,
        cat_almacenes.sNombre AS 'sAlmacen',
        cat_estatus.sNombre AS 'sEstatus',
        cat_empresas.sNombre AS 'sSocioImportador'
    ";
    $justcount = "count(*) as 'total'";
    $camposPorRetornar = ($get) ? $getol : $justcount;
    $sql = "
    SELECT
        $camposPorRetornar
    FROM
        ope_referenciasExternas
            INNER JOIN
        cat_almacenes ON (cat_almacenes.skAlmacen = ope_referenciasExternas.skAlmacen)
            INNER JOIN
        cat_estatus ON (cat_estatus.skEstatus = ope_referenciasExternas.skEstatus)
            LEFT JOIN  rel_empresas_socios resa ON resa.skSocioEmpresa = ope_referenciasExternas.skSocioImportador
            LEFT JOIN  cat_empresas ON (cat_empresas.skEmpresa = resa.skEmpresa)
    WHERE 1 = 1";
    if ($get){
        if(!empty($this->refex['sPedimento'])){
            $sql .=" AND ope_referenciasExternas.sPedimento = '".$this->refex['sPedimento']."'";
        }
        if(!empty($this->refex['sReferencia'])){
            $sql .=" AND ope_referenciasExternas.sReferencia like '%".$this->refex['sReferencia']."%'";
        }
        if(!empty($this->refex['sMercancia'])){
            $sql .=" AND ope_referenciasExternas.sMercancia like '%".$this->refex['sMercancia']."%'";
        }
        if(!empty($this->refex['sGuiaMaster'])){
            $sql .=" AND ope_referenciasExternas.sGuiaMaster like '%".$this->refex['sGuiaMaster']."%'";
        }
        if(!empty($this->refex['sGuiaHouse'])){
            $sql .=" AND ope_referenciasExternas.sGuiaHouse like '%".$this->refex['sGuiaHouse']."%'";
        }
        if(!empty($this->refex['dFechaCreacion'])){
            $sql .=" AND ope_referenciasExternas.dFechaCreacion like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaCreacion'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['dFechaPrevio'])){
            $sql .=" AND ope_referenciasExternas.dFechaPrevio like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaPrevio'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['dFechaDespacho'])){
            $sql .=" AND ope_referenciasExternas.dFechaDespacho like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaDespacho'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['dFechaClasificacion'])){
            $sql .=" AND ope_referenciasExternas.dFechaClasificacion like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaClasificacion'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['dFechaGlosa'])){
            $sql .=" AND ope_referenciasExternas.dFechaGlosa like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaGlosa'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['dFechaCapturaPedimento'])){
            $sql .=" AND ope_referenciasExternas.dFechaCapturaPedimento like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaCapturaPedimento'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['dFechaFacturacion'])){
            $sql .=" AND ope_referenciasExternas.dFechaFacturacion like '%".
            DateTime::createFromFormat('Y-m-d H:i:s', $this->refex['dFechaFacturacion'])->format('Y-m-d H:i:s')
            ."%'";
        }
        if(!empty($this->refex['iDeposito'])){
            $sql .=" AND ope_referenciasExternas.iDeposito like '%".$this->refex['iDeposito']."%'";
        }
        if(!empty($this->refex['iSaldo'])){
            $sql .=" AND ope_referenciasExternas.iSaldo like '%".$this->refex['iSaldo']."%'";
        }
        if(!empty($this->refex['sAlmacen'])){
            $sql .=" AND cat_almacenes.skAlmacen = '".$this->refex['sAlmacen']."'";
        }
        if(!empty($this->refex['sEstatus'])){
            $sql .=" AND cat_estatus.skEstatus = '".$this->refex['sEstatus']."'";
        }
        if(!empty($this->refex['sSocioImportador'])){
            $sql .=" AND resa.skSocioEmpresa = '".$this->refex['sSocioImportador']."'";
        }
       // die($sql);
    }
    $result = $this->db->query($sql);
    if($result){
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }else{
        return false;
    }
}


    public function getConceptos($skSocioImportador)
    {

        $sql = "
        SELECT
            rcetc.skTipoTramite,
            ca.skConcepto,
            ca.skStatus,
            ca.sNombreCorto,
            ca.sNombre,
            ca.sDescripcion,
            ca.skDivisa,
            ca.fPrecioUnitario
        FROM rel_cat_empresas_tarifas_conceptos rcetc
        INNER JOIN cat_conceptos ca ON (ca.skConcepto = rcetc.skConcepto)
        INNER JOIN rel_empresas_socios ce ON (rcetc.skEmpresa = ce.skEmpresa)
        WHERE ce.skSocioEmpresa = '$skSocioImportador';";

        $r = $this->db->query($sql);

        if ($this->db->affected_rows > 0){
            $arg = array();
            while ($row = $r->fetch_assoc()) {
                array_push($arg, $row);
            }
            return $arg;
        }else {

            $sql_todosConceptos = "
                SELECT

                    cc.skConcepto,
                    cc.skStatus,
                    cc.sNombreCorto,
                    cc.sNombre,
                    cc.sDescripcion,
                    cc.skDivisa,
                    cc.fPrecioUnitario
                FROM
                    cat_conceptos cc
                        INNER JOIN
                    rel_cat_conceptos_tipos_empresas rccte ON (cc.skConcepto = rccte.skConcepto)
                WHERE
                    rccte.skTipoEmpresa = 'rext' ";
            $r = $this->db->query($sql_todosConceptos);
            $arg = array();

            while ($row = $r->fetch_assoc()) {
                array_push($arg, $row);
            }

            return $arg;
        }
    }

    public function insertConceptos($skReferenciaExterna,$skConcepto,$iCantidad,$dImporte,$dPrecioUnitario,$skDivisa)
    {
        $skReferenciaExternaConcepeteto =  substr(md5(microtime()), 1, 32);
        $sql = "
        INSERT INTO
        `rel_referenciasExternas_conceptos` (
            `skReferenciaExternaConcepto`,
            `skReferenciaExterna`,
            `skConcepto`,
            `dImporte`,
            `iCantidad`,
            `dPrecioUnitario`,
            `skDivisa`
            )
        VALUES (
            '$skReferenciaExternaConcepeteto',
            '$skReferenciaExterna',
            '$skConcepto',
            '$dImporte',
            '$iCantidad',
            '$dPrecioUnitario',
            '$skDivisa'
            );";
        //die($sql);

        $r = $this->db->query($sql);

        if ($this->db->affected_rows > 0){
            return $r;
        }else{
            return false;
        }
    }

    public function deleteConceptos($skReferenciaExterna)
    {

        $sql ="
            DELETE FROM `rel_referenciasExternas_conceptos`
            WHERE `skReferenciaExterna`='$skReferenciaExterna';";

        $r = $this->db->query($sql);

        if ($this->db->affected_rows > 0){
            return $r;
        }else{
            return false;
        }
    }

    public function getConceptosReferencia($skReferenciaExterna)
    {
        $sql = "
        SELECT
            iCantidad,
            rel_referenciasExternas_conceptos.skDivisa,
            dPrecioUnitario,
            dImporte,
            cat_conceptos.sNombre,
            cat_conceptos.skConcepto,
            ope_referenciasExternas.dTipoCambio
        FROM
            rel_referenciasExternas_conceptos
                INNER JOIN
            cat_conceptos ON (rel_referenciasExternas_conceptos.skConcepto = cat_conceptos.skConcepto)
                INNER JOIN
            ope_referenciasExternas ON (ope_referenciasExternas.skReferenciaExterna = rel_referenciasExternas_conceptos.skReferenciaExterna)
        WHERE
            rel_referenciasExternas_conceptos.skReferenciaExterna = '$skReferenciaExterna';";

        $r = $this->db->query($sql);

        if ($this->db->affected_rows > 0){
            return $r;
        }else{
            return false;
        }
    }
    public function reexfo_referencias()
    {
        $sql = "
        SELECT
        ore.skReferenciaExterna,
        LPAD(ore.ikReferenciaExterna, 5, '0') AS codigo,
        cei.sNombre AS Importador,
        cep.sNombre AS Propietario,
        cer.sNombre AS Promotor,
        ca.sNombre AS Almacen,
        ce.sNombre AS Estatus,
        ore.sPedimento AS Pedimento,
        ore.sReferencia AS Referencia,
        ore.sMercancia AS Mercancia,
        ore.sGuiaMaster AS GuiaMaster,
        ore.sGuiaHouse AS GuiaHouse,
        ore.iBultos AS iBultos,
        ore.dFechaCreacion AS FechaCreacion,
        ore.dFechaPrevio AS FechaPrevio,
        DATE_FORMAT(ore.dFechaPrevio, '%k:%i:%s') AS tHoraPrevio,
        ore.dFechaDespacho AS FechaDespacho,
        DATE_FORMAT(ore.dFechaDespacho, '%k:%i:%s') AS tHoraDespacho,
        ore.dFechaClasificacion AS FechaClasificacion,
        DATE_FORMAT(ore.dFechaClasificacion, '%k:%i:%s') AS tHoraClasificacion,
        ore.dFechaGlosa AS FechaGlosa,
        DATE_FORMAT(ore.dFechaGlosa, '%k:%i:%s') AS tHoraGlosa,
        ore.dFechaCapturaPedimento AS FechaCapturaPedimento,
        DATE_FORMAT(ore.dFechaCapturaPedimento, '%k:%i:%s') AS tHoraCaptura,
        ore.dFechaRevalidacion AS FechaRevalidacion,
        DATE_FORMAT(ore.dFechaRevalidacion, '%k:%i:%s') AS tHoraRevalidacion,
        ore.dFechaFacturacion AS FechaFacturacion,
        DATE_FORMAT(ore.dFechaFacturacion, '%k:%i:%s') AS tHoraFacturacion,
        ore.dTipoCambio AS TipoCambio,
        ore.iDeposito AS Deposito,
        ore.iSaldo AS Saldo,
	      us.sName AS UsuarioCreacion
        FROM ope_referenciasExternas ore
        LEFT JOIN rel_empresas_socios resi ON resi.skSocioEmpresa = ore.skSocioImportador
        LEFT JOIN cat_empresas cei ON cei.skEmpresa = resi.skEmpresa
        LEFT JOIN rel_empresas_socios resp ON resp.skSocioEmpresa = ore.skSocioPropietario
        LEFT JOIN cat_empresas cep ON cep.skEmpresa = resp.skEmpresa
        LEFT JOIN rel_empresas_socios resr ON resr.skSocioEmpresa = ore.skSocioPromotor
        LEFT JOIN cat_empresas cer ON cer.skEmpresa = resr.skEmpresa
        LEFT JOIN cat_almacenes ca ON ca.skAlmacen = ore.skAlmacen
        LEFT JOIN cat_estatus ce ON ce.skEstatus = ore.skEstatus
        LEFT JOIN _users us	 ON us.skUsers = ore.skUsuarioCreacion
        WHERE ore.skReferenciaExterna = '".$this->refex['skReferenciaExterna']."' ";
                    //Poner el numero de previo
        //  echo $sql; die();
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }
    }
    public function listar_fotos_referencias(){
      $sql="SELECT * FROM rel_referenciasExternas_fotos WHERE skReferenciaExterna ='".$this->refex['skReferenciaExterna']."' AND skEstatus = 'AC' ";
      //exit($sql);
          $result = $this->db->query($sql);
      if ($result) {
          if ($result->num_rows > 0) {
              return $result;
          } else {
              return false;
          }
      }
    }
    public function agregar_fotos_referencias(){

      $sql = "INSERT INTO rel_referenciasExternas_fotos
                          (skFotoReferencia, skReferenciaExterna,
                           skUsuarioCreacion,skEstatus,sUbicacion,dFechaCreacion )
                           VALUES (
                          '".$this->refex['skFotoReferencia']."',
                          '".$this->refex['skReferenciaExterna']."',
                          '".$_SESSION['session']['skUsers']."',
                          'AC',
                          '".$this->refex['sUbicacion']."',
                          CURRENT_TIMESTAMP()
                           )";
      //echo  $sql."<br><br><br>";die();
      $result = $this->db->query($sql);
      if ($result) {
          return true;
      } else {

          return false;
      }
    }
    public function eliminar_fotos_referencias($arrayNoEliminados){
        $sql="UPDATE rel_referenciasExternas_fotos
              SET skEstatus='EL'
              WHERE skFotoReferencia NOT IN(".$arrayNoEliminados.")";
              $result = $this->db->query($sql);
              if ($result) {
                  return true;
              } else {

                  return false;
              }

    }
    // INSERTAR DOCUMENTOS DE REFERENCIAS EXTERNAS //
    public function create_referenciasExternas_documentos($datos = array()){
        if($datos){
            $sql = "INSERT INTO rel_referenciasExternas_documentos (skDocumentoReferencia,skReferenciaExterna,skUsuarioCreacion,skEstatus,sUbicacion,dFechaCreacion,skDocTipo) VALUES (
                '".$datos['skDocumentoReferencia']."',
                '".$datos['skReferenciaExterna']."',
                '".$_SESSION['session']['skUsers']."',
                'AC',
                '".$datos['sUbicacion']."',
                CURRENT_TIMESTAMP,
                '".$datos['skDocTipo']."'
                )";
            //exit('<pre>'.print_r($sql,1).'</pre>');
            $result = $this->db->query($sql);
            if (!$result) {
                return false;
            }
            return true;
        }
        return false;
        //rel_tiposDocumentos_modulos
    }
    // GET DOCUMENTOS PARA REFERENCIAS EXTERNAS //
    public function get_cat_docTipo(){
        $sql = "SELECT * FROM rel_tiposDocumentos_modulos tdm
            INNER JOIN cat_docTipo dt ON dt.skDocTipo = tdm.skDocTipo WHERE dt.skStatus = 'AC' AND tdm.skModulo = 'reexdo-form' ";
        //exit('<pre>'.print_r($sql,1).'</pre>');
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }
    }
    // GET REL DOCUMENTOS DE REFERENCIA EXTERNA  //
    public function get_rel_referenciasExternas_documentos() {
        $sql = "SELECT rexDoc.*, dt.sNombre FROM rel_referenciasExternas_documentos AS rexDoc INNER JOIN cat_docTipo dt ON dt.skDocTipo = rexDoc.skDocTipo WHERE rexDoc.skEstatus = 'AC' AND rexDoc.skReferenciaExterna = '".$this->refex['skReferenciaExterna']."' ";
        //exit('<pre>'.print_r($sql,1).'</pre>');
        $result = $this->db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }
    }
    // ELIMINADO LOGICO DE DOCUMENTOS DE REFERENCIA EXTERNA //
    public function delete_referenciasExternas_documentos($datos = array()){
        if($datos){
            $sql = "UPDATE rel_referenciasExternas_documentos SET skEstatus = 'DE' WHERE skEstatus != 'DE' ";
            if(isset($datos['skReferenciaExterna']) && !empty($datos['skReferenciaExterna'])){
               $sql .= " AND skReferenciaExterna = '".$datos['skReferenciaExterna']."'";
            }
            if(isset($datos['skDocumentoReferencia']) && !empty($datos['skDocumentoReferencia'])){
                $sql .= " AND skDocumentoReferencia NOT IN (".$datos['skDocumentoReferencia'].")";
            }
            //exit('<pre>'.print_r($sql,1).'</pre>');
            $result = $this->db->query($sql);
            if ($result) {
                return true;
            }else{
                return false;
            }
        }
        return true;
    }
    /*
    dFechaDespacho='".$this->refex['dFechaDespacho']."',
    dFechaClasificacion='".$this->refex['dFechaClasificacion']."',
    dFechaGlosa='".$this->refex['dFechaGlosa']."',
    dFechaCapturaPedimento='".$this->refex['dFechaCapturaPedimento']."',
    dFechaRevalidacion='".$this->refex['dFechaRevalidacion']."',
    dFechaFacturacion='".$this->refex['dFechaFacturacion']."'
    */
    public function editar_fechas_referencia(){
        $sql="UPDATE ope_referenciasExternas
              SET dFechaPrevio='".$this->refex['dFechaPrevio']."'
              dFechaDespacho='".$this->refex['dFechaDespacho']."',
              dFechaClasificacion='".$this->refex['dFechaClasificacion']."',
              dFechaGlosa='".$this->refex['dFechaGlosa']."',
              dFechaCapturaPedimento='".$this->refex['dFechaCapturaPedimento']."',
              dFechaRevalidacion='".$this->refex['dFechaRevalidacion']."',
              dFechaFacturacion='".$this->refex['dFechaFacturacion']."'
              WHERE skReferenciaExterna ='".$this->refex['skReferenciaExterna']."'";

              $result = $this->db->query($sql);
              if ($result) {
                  return $this->refex['skReferenciaExterna'];
              } else {
                  return false;
              }

    }
    /* TERMINA MODULO (REX) */
}

<?php
Class Rex_Model Extends Core_Model {

    // PUBLIC VARIABLES //
    public $ref = array(
        'id'=>null,
        'nombre'=>null
    );
    // PRIVATE VARIABLES //
    private $data = array();

    public function __construct() {
        parent::__construct();
    }

    public function __destruct() {
        
    }
    
    /* COMIENZA MODULO (REX) */
    public function getAreas($skStatus = null)
    {
        $sql = "SELECT * FROM areas";
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
                `iSaldo`
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
                '".$_POST["iBultos"]."', 
                '".$_SESSION["session"]["skUsers"]."', 
                NOW(), 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaPrevio"])->format('Y-m-d')."', 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaDespacho"])->format('Y-m-d')."', 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaClasificacion"])->format('Y-m-d')."', 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaGlosa"])->format('Y-m-d')."', 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaCapturaPedimento"])->format('Y-m-d')."', 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaRevalidacion"])->format('Y-m-d')."', 
                '".DateTime::createFromFormat('d-m-Y', $_POST["dFechaFacturacion"])->format('Y-m-d')."', 
                '".$_POST["iDeposito"]."', 
                '".$_POST["iSaldo"]."');" ;
        //die($sql_insert);

        if (isset($_POST) ) {
            
            $result = $this->db->query($sql_insert);
            return true;

        }else{
            return false;
        }
        
    }

    public function updatear($skReferenciaExterna = NULL){
        if ($skReferenciaExterna == NULL && $skReferenciaExterna != '') {
            return false;
        }
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
                `iSaldo` = '".$_POST["iSaldo"]."'

                WHERE `skReferenciaExterna` = '$skReferenciaExterna';" ;
        //die($sql_update);
        

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
        $lecua = ($get) ? $getol : $justcount;
        $sql = "        
        SELECT 
            $lecua
        FROM
            ope_referenciasExternas
                INNER JOIN
            cat_almacenes ON (cat_almacenes.skAlmacen = ope_referenciasExternas.skAlmacen)
                INNER JOIN
            cat_estatus ON (cat_estatus.skEstatus = ope_referenciasExternas.skEstatus)
                INNER JOIN
            cat_empresas ON (cat_empresas.skEmpresa = ope_referenciasExternas.skSocioImportador) 
        WHERE 1 = 1";

        if ($get){

            if(!empty($this->areas['sPedimento'])){
                $sql .=" AND ope_referenciasExternas.sPedimento = '".$this->areas['sPedimento']."'";
            }
            if(!empty($this->areas['sReferencia'])){
                $sql .=" AND ope_referenciasExternas.sReferencia like '%".$this->areas['sReferencia']."%'";
            }
            if(!empty($this->areas['sMercancia'])){
                $sql .=" AND ope_referenciasExternas.sMercancia like '%".$this->areas['sMercancia']."%'";
            }
            if(!empty($this->areas['sGuiaMaster'])){
                $sql .=" AND ope_referenciasExternas.sGuiaMaster like '%".$this->areas['sGuiaMaster']."%'";
            }
            if(!empty($this->areas['sGuiaHouse'])){
                $sql .=" AND ope_referenciasExternas.sGuiaHouse = '".$this->areas['sGuiaHouse']."'";
            }
            if(!empty($this->areas['dFechaCreacion'])){
                $sql .=" AND ope_referenciasExternas.dFechaCreacion like '%".$this->areas['dFechaCreacion']."%'";
            }
            if(!empty($this->areas['dFechaPrevio'])){
                $sql .=" AND ope_referenciasExternas.dFechaPrevio like '%".$this->areas['dFechaPrevio']."%'";
            }
            if(!empty($this->areas['dFechaDespacho'])){
                $sql .=" AND ope_referenciasExternas.dFechaDespacho like '%".$this->areas['dFechaDespacho']."%'";
            }        
            if(!empty($this->areas['dFechaClasificacion'])){
                $sql .=" AND ope_referenciasExternas.dFechaClasificacion like '%".$this->areas['dFechaClasificacion']."%'";
            }
            if(!empty($this->areas['dFechaGlosa'])){
                $sql .=" AND ope_referenciasExternas.dFechaGlosa like '%".$this->areas['dFechaGlosa']."%'";
            }
            if(!empty($this->areas['dFechaCapturaPedimento'])){
                $sql .=" AND ope_referenciasExternas.dFechaCapturaPedimento like '%".$this->areas['dFechaCapturaPedimento']."%'";
            }
            if(!empty($this->areas[''])){
                $sql .=" AND ope_referenciasExternas.dFechaFacturacion like '%".$this->areas['']."%'";
            }
            if(!empty($this->areas['dFechaFacturacion'])){
                $sql .=" AND ope_referenciasExternas.iDeposito like '%".$this->areas['dFechaFacturacion']."%'";
            }
            if(!empty($this->areas['iSaldo'])){
                $sql .=" AND ope_referenciasExternas.iSaldo like '%".$this->areas['iSaldo']."%'";
            }
            if(!empty($this->areas['sAlmacen'])){
                $sql .=" AND cat_almacenes.sNombre like '%".$this->areas['sAlmacen']."%'";
            }
            if(!empty($this->areas['sEstatus'])){
                $sql .=" AND cat_estatus.sNombre like '%".$this->areas['sEstatus']."%'";
            }
            if(!empty($this->areas['sSocioImportador'])){
                $sql .=" AND cat_empresas.sNombre like '%".$this->areas['sSocioImportador']."%'";
            }
        }
        $result = $this->db->query($sql);
        if($result){
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }
    }



    /* TERMINA MODULO (REX) */
}
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
    public function getAreas($skStatus = null){
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

    public function insertar(){

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
        if ($socioEmpresaP === false || $socioEmpresaP != '') {
            return false;
        }
        
        $sql_socios = "SELECT 
                rel_empresas_socios.skSocioEmpresa,
                rel_empresas_socios.skEmpresa,
                cat_empresas.sNombre as ''
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

    /* TERMINA MODULO (REX) */
}
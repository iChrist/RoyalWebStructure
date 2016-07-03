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

    public function insertar($pedimento = null,$referencia = null){

        $sql_insert = "
            INSERT INTO `royalweb_test_gya`.`ope_referenciasExternas` (
                `skReferenciaExterna`, 
                `skSocioPropietario`, 
                `skEmpresaPropietario`, 
                `skSocioImportador`, 
                `skSocioPromotor`, 
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
                'LeReferenciaExterna',  
                'SocioPropietario', 
                'EMpresaPropietario', 
                'SocioImportador', 
                NULL, 
                'amlsc', 
                'status', 
                'Pedimentoquepide', 
                'Referencia', 
                'MecanciaSwag', 
                'GuiaMaster', 
                'GuiaJAUS', 
                '666', 
                'skUsairuoCreacion', 
                'LeFechaCreacion', 
                'LeFechaPrevio', 
                'LeFechaDespacho', 
                'LeFechaClasificacion', 
                'LeFechaGlosa', 
                'LeFechaCapturaPedimento', 
                'LeFechaRevalicadion', 
                'LeFechaFacturaciaoon', 
                '3', 
                '33333'
            );" ;

        if ($pedimento != null && $referencia != null ) {
            $sql = "INSERT INTO `ope_referenciasExternas` (`sPedimento`, `sReferencia`) VALUES ('$pedimento', '$referencia');";
            $result = $this->db->query($sql);
            return true;

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
<?php
    Class Cla_Model Extends Core_Model {

        // PUBLIC VARIABLES //
       
        /* COMIENZA CLASIFICACIÓN DE MERCANCIAS */
        public $claExcel = array(
             'sReferencia'=>NULL
            ,'sPedimento'=>NULL
            ,'skEmpresa'=>NULL
            ,'sFraccion'=>NULL
            ,'sDescripcion'=>NULL
            ,'sDescripcionIngles'=>NULL
            ,'sNumeroParte'=>NULL
            ,'dFechaPrevio'=>NULL
            ,'sFactura'=>NULL
        );
        public $cla = array(
             'skClasificacion' => NULL
            ,'sReferencia' => NULL
            ,'dFechaPrevio' => NULL
            ,'sFactura' => NULL
            ,'skStatus' => NULL
            ,'dFechaCreacion' => NULL
            ,'skUsersCreacion' => NULL
            ,'dFechaModificacion' => NULL
            ,'skUsersModificacion' => NULL
            ,'dFechaImportacion' => NULL
            ,'valido' => NULL
            
            ,'skEmpresa' => NULL
            ,'sPedimento' => NULL
            ,'year'=>NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
            ,'orderBy' => NULL
        );
        
        public $claMer = array(
             'skClasificacionMercancia' => NULL
            ,'skClasificacion' => NULL
            ,'sFraccion' => NULL
            ,'sDescripcion' => NULL
            ,'sDescripcionIngles' => NULL
            ,'sNumeroParte' => NULL
            ,'skStatus' => NULL
            ,'dFechaCreacion' => NULL
            ,'skUsersCreacion' => NULL
            ,'dFechaModificacion' => NULL
            ,'skUsersModificacion' => NULL
            ,'iSecuencia'=>NULL
            ,'dFechaImportacion'=>NULL
            
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
            ,'orderBy' => NULL
        );
        
        public $claMerArc = array(
             'skClasificacionMercanciaArchivo' => NULL
            ,'sFraccion' => NULL
            ,'sNumeroParte' => NULL
            ,'sArchivo' => NULL
            ,'sThumbnail' => NULL
            ,'skStatus' => NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );
        /* TERMINA CLASIFICACIÓN DE MERCANCIAS */
        
        
        public $desArc = array(
             'skArchivoFraccionArancelaria' => NULL
            ,'skFraccionArancelariaDescripcion'  =>  NULL
            ,'sArchivo'     =>  NULL
            ,'skStatus'     =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );
        
        public $fraAraDes = array(
             'skFraccionArancelariaDescripcion' =>  NULL
            ,'skFraccionArancelaria'    =>  NULL
            ,'sDescripcion'  =>  NULL
            ,'sDescripcionIngles'   =>  NULL
            ,'sModelo'  =>  NULL
            ,'skStatus' =>  NULL
            ,'dFechaCreacion'   =>  NULL
            ,'skUsersCreacion'  =>  NULL
            ,'dFechaModificacion'   =>  NULL
            ,'skUsersModificacion'  =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );

        // cat_numerosParte_fraccionesFraccion
         public $numparfraran = array(
             'skNumeroParte'  =>  ''
            ,'sNombre'     =>  ''
            ,'sDescripcion'     =>  ''
            ,'skStatus'     =>  ''
            ,'dFechaCrecion'     =>  ''
            ,'skUsersCreacion'     =>  ''
            ,'dFechaModificacion'     =>  ''
            ,'skUsersModificacion'     =>  ''
            ,'limit'        =>  ''
            ,'offset'       =>  ''
        );

        public $numPar = array(
             'skNumeroParte' =>  NULL
            ,'sNombre'    =>  NULL
            ,'sDescripcion'  =>  NULL
            ,'skStatus' =>  NULL
            ,'dFechaCreacion'   =>  NULL
            ,'skUsersCreacion'  =>  NULL
            ,'dFechaModificacion'   =>  NULL
            ,'skUsersModificacion'  =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );

        // PRIVATE VARIABLES //
            private $data = array();

        public function __construct(){
            parent::__construct();
        }

        public function __destruct(){

        }
        
        /* COMIENZA CLASIFICACIÓN DE MERCANCIAS */
        
        public function count_cla(){
            $sql = "SELECT COUNT(*) AS total FROM cat_clasificacion AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }
            if(!empty($this->cla['valido'])){
                $sql .=" AND cla.valido = ".$this->cla['valido'];
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND emp.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".$this->cla['sReferencia']."%'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND rd.sPedimento like '%".$this->cla['sPedimento']."%'";
            }
            if(!empty($this->cla['dFechaPrevio'])){
                $sql .=" AND cla.dFechaPrevio like '%".$this->cla['dFechaPrevio']."%'";
            }
            if(!empty($this->cla['sfactura'])){
                $sql .=" AND cla.sfactura like '%".$this->cla['sfactura']."%'";
            }
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus like '%".$this->cla['skStatus']."%'";
            }
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
// FILTRADO PARA LA CLASIFICACIÓN ARANCELARIA //
        public function count_cla_referencias_pendientes(){
            $sql = "SELECT COUNT(*) AS total FROM cat_clasificacion AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }
            if(!empty($this->cla['valido'])){
                $sql .=" AND cla.valido = ".$this->cla['valido'];
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND emp.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".$this->cla['sReferencia']."%'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND rd.sPedimento like '%".$this->cla['sPedimento']."%'";
            }
            
            if(!empty($this->cla['orderBy'])){
                $sql .=" ORDER BY ".$this->cla['orderBy'];
            }
            if(is_int($this->cla['limit'])){
                if(is_int($this->cla['offset'])){
                    $sql .= " LIMIT ".$this->cla['offset']." , ".$this->cla['limit'];
                }else{
                    $sql .= " LIMIT ".$this->cla['limit'];
                }
            }
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function read_cla_referencias_pendientes(){
            $sql="SELECT COUNT(*) AS totalFracciones, cla.skClasificacion, cla.sReferencia, cla.valido, cla.skUsersCreacion, rd.sPedimento, emp.sNombre AS empresa, u.sName AS autor, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }
            if($this->cla['valido'] === 0 || $this->cla['valido'] === 1){
                $sql .=" AND cla.valido = ".$this->cla['valido'];
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND emp.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".$this->cla['sReferencia']."%'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND rd.sPedimento like '%".$this->cla['sPedimento']."%'";
            }
            
            // AGRUPAMOS LA CLASIFICACION PARA EL CONTEO DE FRACCIONES //
            $sql .=" GROUP BY cla.skClasificacion ";
            
            if(!empty($this->cla['orderBy'])){
                $sql .=" ORDER BY ".$this->cla['orderBy'];
            }
            if(is_int($this->cla['limit'])){
                if(is_int($this->cla['offset'])){
                    $sql .= " LIMIT ".$this->cla['offset']." , ".$this->cla['limit'];
                }else{
                    $sql .= " LIMIT ".$this->cla['limit'];
                }
            }
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function read_filter_cla(){
            $sql = "SELECT cla.*, rd.sPedimento, emp.sNombre AS empresa, claMer.sFraccion, claMer.sDescripcion, claMer.sDescripcionIngles, claMer.sNumeroParte, claMer.iSecuencia, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS usersCreacion, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else if($this->cla['year'] != null){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }
            if(!empty($this->cla['valido'])){
                $sql .=" AND cla.valido = ".$this->cla['valido'];
            }
            if(!empty($this->cla['skClasificacion'])){
                $sql .=" AND cla.skClasificacion = '".$this->cla['skClasificacion']."'";
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND emp.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".$this->cla['sReferencia']."%'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND rd.sPedimento like '%".$this->cla['sPedimento']."%'";
            }
            if(!empty($this->cla['dFechaPrevio'])){
                $sql .=" AND cla.dFechaPrevio like '%".$this->cla['dFechaPrevio']."%'";
            }
            if(!empty($this->cla['sFactura'])){
                $sql .=" AND cla.sFactura like '%".$this->cla['sFactura']."%'";
            }
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus like '%".$this->cla['skStatus']."%'";
            }
            /* COMIENZA CLAMER */
            if(!empty($this->claMer['sFraccion'])){
                $sql .=" AND claMer.sFraccion like '".$this->claMer['sFraccion']."%'";
            }
            if(!empty($this->claMer['sDescripcion'])){
                $sql .=" AND claMer.sDescripcion like '%".$this->claMer['sDescripcion']."%'";
            }
            if(!empty($this->claMer['sDescripcionIngles'])){
                $sql .=" AND claMer.sDescripcionIngles like '%".$this->claMer['sDescripcionIngles']."%'";
            }
            if(!empty($this->claMer['sNumeroParte'])){
                $sql .=" AND claMer.sNumeroParte like '".$this->claMer['sNumeroParte']."%'";
            }
            /* TERMINA CLAMER */

            if(!empty($this->cla['orderBy'])){
                $sql .=" ORDER BY ".$this->cla['orderBy'];
            }
            if(is_int($this->cla['limit'])){
                if(is_int($this->cla['offset'])){
                    $sql .= " LIMIT ".$this->cla['offset']." , ".$this->cla['limit'];
                }else{
                    $sql .= " LIMIT ".$this->cla['limit'];
                }
            }
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }

        public function read_like_cla(){
            $sql = "SELECT cla.*, emp.sNombre AS empresa, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS usersCreacion, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_empresas AS emp ON emp.skEmpresa = cla.skEmpresa "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND cla.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".$this->cla['sReferencia']."%'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND cla.sPedimento like '%".$this->cla['sPedimento']."%'";
            }
            if(!empty($this->cla['dFechaPrevio'])){
                $sql .=" AND cla.dFechaPrevio like '%".$this->cla['dFechaPrevio']."%'";
            }
            if(!empty($this->cla['sFactura'])){
                $sql .=" AND cla.sFactura like '%".$this->cla['sFactura']."%'";
            }
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus like '%".$this->cla['skStatus']."%'";
            }
            
            if(!empty($this->cla['orderBy'])){
                $sql .=" ORDER BY ".$this->cla['orderBy'];
            }
            if(is_int($this->cla['limit'])){
                if(is_int($this->cla['offset'])){
                    $sql .= " LIMIT ".$this->cla['offset']." , ".$this->cla['limit'];
                }else{
                    $sql .= " LIMIT ".$this->cla['limit'];
                }
            }
            //echo $sql;
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function read_equal_cla(){
            /*$sql = "SELECT cla.*, emp.sNombre AS empresa, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_empresas AS emp ON emp.skEmpresa = cla.skEmpresa WHERE 1=1 ";*/
            $sql = "SELECT cla.*, emp.sNombre AS empresa, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS usersCreacion, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_empresas AS emp ON emp.skEmpresa = cla.skEmpresa "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            if(!empty($this->cla['skClasificacion'])){
                $sql .=" AND (cla.skClasificacion = '".$this->cla['skClasificacion']."') ";
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
        
        public function validarPrimeraClasifiacion(){
            $sql = "UPDATE cat_clasificacion SET valido = 1 WHERE skClasificacion = '".$this->cla['skClasificacion']."'";
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        
        public function get_cla(){
            $sql = "SELECT cla.* FROM cat_clasificacion cla WHERE cla.sReferencia = '".$this->cla['sReferencia']."'";
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        public function create_claExcel(){
            $sql = "INSERT INTO cat_claExcel 
                (sReferencia,sFraccion,sDescripcion,sDescripcionIngles,sNumeroParte,dFechaPrevio,sFactura)VALUES
                (
                '".$this->claExcel['sReferencia']."',
                '".$this->claExcel['sFraccion']."',
                '".$this->claExcel['sDescripcion']."',
                '".$this->claExcel['sDescripcionIngles']."',
                '".$this->claExcel['sNumeroParte']."',
                '".$this->claExcel['dFechaPrevio']."',
                '".$this->claExcel['sFactura']."'
                );";
                exit($sql);
                $result = $this->db->query($sql);
                if($result){
                    return $sql;
                }else{
                    return false;
                }
        }
        
        public function create_cla(){
            $sql = "INSERT INTO cat_clasificacion 
            (skClasificacion,sReferencia,dFechaPrevio,sFactura,skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion,dFechaImportacion,valido) 
            VALUES 
            ('".$this->cla['skClasificacion']."',
            '".$this->cla['sReferencia']."',
            '".$this->cla['dFechaPrevio']."',
            '".$this->cla['sFactura']."',
            '".$this->cla['skStatus']."',
            '".$this->cla['dFechaCreacion']."',
            '".$this->cla['skUsersCreacion']."',
            '".$this->cla['dFechaModificacion']."',
            '".$this->cla['skUsersModificacion']."',
            '".$this->cla['dFechaImportacion']."',
            ".$this->cla['valido']."
            );";
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                return $this->cla['skClasificacion'];
            }else{
                return false;
            }
        }
        
        public function update_cla(){
            $sql = "UPDATE cat_clasificacion SET "
                . "sReferencia = '".$this->cla['sReferencia']."',"
                . "dFechaPrevio = '".$this->cla['dFechaPrevio']."',"
                . "sFactura = '".$this->cla['sFactura']."',"
                . "skStatus = '".$this->cla['skStatus']."',"
                . "dFechaModificacion = '".$this->cla['dFechaModificacion']."',"
                . "skUsersModificacion = '".$this->cla['skUsersModificacion']."'"
                . " WHERE skClasificacion = '".$this->cla['skClasificacion']."';";
            $result = $this->db->query($sql);
            if($result){
                return $this->cla['skClasificacion'];
            }else{
                return false;
            }
        }
        
        public function delete_cla(){
            $sql = "DELETE FROM cat_clasificacion WHERE 1=1 ";
            if(!empty($this->cla['sReferencia'])){
                $sql.=" AND sReferencia = '".$this->cla['sReferencia']."' ";
            }
            if(!empty($this->cla['skClasificacion'])){
                $sql.=" AND skClasificacion = '".$this->cla['skClasificacion']."' ";
            }
            /*if(!empty($this->cla['dFechaImportacion'])){
                $sql.=" AND dFechaImportacion = '".$this->cla['dFechaImportacion']."' ";
            }*/
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        
/* cat_clasificacionMercancia */
        public function read_like_claMer(){
            $sql = "SELECT claMer.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacionMercancia AS claMer "
                . "INNER JOIN _status ON _status.skStatus = claMer.skStatus "
                . "INNER JOIN cat_clasificacion cla ON cla.skClasificacion = claMer.skClasificacion WHERE 1=1 ";
            if(!empty($this->claMer['skClasificacionMercancia'])){
                $sql .=" AND (claMer.skClasificacionMercancia = '".$this->claMer['skClasificacionMercancia']."') ";
            }
            if(!empty($this->claMer['skClasificacion'])){
                $sql .=" AND (claMer.skClasificacion = '".$this->claMer['skClasificacion']."') ";
            }
            if(!empty($this->claMer['sFraccion'])){
                $sql .=" AND claMer.sFraccion like '%".$this->claMer['sFraccion']."%'";
            }
            if(!empty($this->claMer['sDescripcion'])){
                $sql .=" AND claMer.sDescripcion like '%".$this->claMer['sDescripcion']."%'";
            }
            if(!empty($this->claMer['sDescripcionIngles'])){
                $sql .=" AND claMer.sDescripcionIngles like '%".$this->claMer['sDescripcionIngles']."%'";
            }
            if(!empty($this->claMer['sNumeroParte'])){
                $sql .=" AND claMer.sNumeroParte like '%".$this->claMer['sNumeroParte']."%'";
            }
            if(!empty($this->claMer['skStatus'])){
                $sql .=" AND claMer.skStatus like '%".$this->claMer['skStatus']."%'";
            }
            if(!empty($this->claMer['iSecuencia'])){
                $sql .=" AND claMer.iSecuencia = '".$this->claMer['iSecuencia']."'";
            }
            
            // FILTRADO PÒR sReferencia //
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia = '".$this->cla['sReferencia']."'";
            }
            
            
            if(!empty($this->claMer['orderBy'])){
                $sql .=" ORDER BY ".$this->claMer['orderBy'];
            }
            if(is_int($this->claMer['limit'])){
                if(is_int($this->claMer['offset'])){
                    $sql .= " LIMIT ".$this->claMer['offset']." , ".$this->claMer['limit'];
                }else{
                    $sql .= " LIMIT ".$this->claMer['limit'];
                }
            }
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        public function read_equal_claMer(){
            $sql = "SELECT claMer.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacionMercancia AS claMer "
                . "INNER JOIN _status ON _status.skStatus = claMer.skStatus WHERE 1=1 ";
            if(!empty($this->claMer['skClasificacionMercancia'])){
                $sql .=" AND (claMer.skClasificacionMercancia = '".$this->claMer['skClasificacionMercancia']."') ";
            }
            if(!empty($this->claMer['skClasificacion'])){
                $sql .=" AND (claMer.skClasificacion = '".$this->claMer['skClasificacion']."') ";
            }
            if(!empty($this->claMer['skStatus'])){
                $sql .=" AND (claMer.skStatus = '".$this->claMer['skStatus']."') ";
            }
            if(is_int($this->claMer['limit'])){
                if(is_int($this->claMer['offset'])){
                    $sql .= " LIMIT ".$this->claMer['offset']." , ".$this->claMer['limit'];
                }else{
                    $sql .= " LIMIT ".$this->claMer['limit'];
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
        
        public function getSecuencia(){
            $sql = "SELECT max(iSecuencia) FROM cat_clasificacionMercancia AS claMer WHERE 
                skClasificacion = '".$this->cla['skClasificacion']."'";
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function create_claMer(){
            $sql = "INSERT INTO cat_clasificacionMercancia 
            (skClasificacionMercancia,skClasificacion,sFraccion,sDescripcion,sDescripcionIngles,sNumeroParte,skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion,iSecuencia,dFechaImportacion) 
            VALUES 
            ('".$this->claMer['skClasificacionMercancia']."',
            '".$this->claMer['skClasificacion']."',
            '".$this->claMer['sFraccion']."',
            '".$this->claMer['sDescripcion']."',
            '".$this->claMer['sDescripcionIngles']."',
            '".$this->claMer['sNumeroParte']."',
            '".$this->claMer['skStatus']."',
            '".$this->claMer['dFechaCreacion']."',
            '".$this->claMer['skUsersCreacion']."',
            '".$this->claMer['dFechaModificacion']."',
            '".$this->claMer['skUsersModificacion']."',
            '".$this->claMer['iSecuencia']."',
            '".$this->claMer['dFechaImportacion']."'
            );";
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                return $this->claMer['skClasificacionMercancia'];
            }else{
                //echo "  ".$sql."  ";
                return false;
            }
        }
        
        public function update_claMer(){
            $sql = "UPDATE cat_clasificacionMercancia SET "
                . "sFraccion = '".$this->claMer['sFraccion']."',"
                . "sDescripcion = '".$this->claMer['sDescripcion']."',"
                . "sDescripcionIngles = '".$this->claMer['sDescripcionIngles']."',"
                . "sNumeroParte = '".$this->claMer['sNumeroParte']."',"
                . "skStatus = '".$this->claMer['skStatus']."',"
                . "dFechaModificacion = '".$this->claMer['dFechaModificacion']."',"
                . "skUsersModificacion = '".$this->claMer['skUsersModificacion']."'"
                . " WHERE skClasificacionMercancia = '".$this->claMer['skClasificacionMercancia']."';";
            $result = $this->db->query($sql);
            if($result){
                return $this->cla['skClasificacion'];
            }else{
                return false;
            }
        }
        
        public function delete_claMer(){
            $sql = "DELETE FROM cat_clasificacionMercancia WHERE 1=1 ";
            if(!empty($this->claMer['skClasificacion'])){
                $sql.=" AND skClasificacion = '".$this->claMer['skClasificacion']."' ";
            }
            if(!empty($this->claMer['dFechaImportacion'])){
                $sql.=" AND dFechaImportacion = '".$this->claMer['dFechaImportacion']."' ";
            }
            //exit($sql);
            $result = $this->db->query($sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        
/* cat_clasificacionMercancia_archivos */
        
        public function read_fraccionesFotos(){
            $sql = "SELECT DISTINCT claMerArc.sFraccion FROM cat_clasificacionMercancia_archivos AS claMerArc WHERE claMerArc.skStatus = 'AC' ";
            if(!empty($this->claMerArc['sFraccion'])){
                $sql .=" AND (claMerArc.sFraccion = '".$this->claMerArc['sFraccion']."') ";
            }
            if(!empty($this->claMerArc['sNumeroParte'])){
                $sql .=" AND (claMerArc.sNumeroParte = '".$this->claMerArc['sNumeroParte']."') ";
            }
            $sql .=" ORDER BY claMerArc.sFraccion ASC ";
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function read_numerosParteFotos(){
            $sql = "SELECT DISTINCT claMerArc.sNumeroParte FROM cat_clasificacionMercancia_archivos AS claMerArc WHERE claMerArc.skStatus = 'AC' ";
            if(!empty($this->claMerArc['sFraccion'])){
                $sql .=" AND (claMerArc.sFraccion = '".$this->claMerArc['sFraccion']."') ";
            }
            if(!empty($this->claMerArc['sNumeroParte'])){
                $sql .=" AND (claMerArc.sNumeroParte = '".$this->claMerArc['sNumeroParte']."') ";
            }
            $sql .=" ORDER BY claMerArc.sNumeroParte ASC ";
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }

        public function read_equal_claMerArc(){
            $sql = "SELECT claMerArc.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacionMercancia_archivos AS claMerArc "
                . "INNER JOIN _status ON _status.skStatus = claMerArc.skStatus WHERE 1=1 ";
            if(!empty($this->claMerArc['skClasificacionMercanciaArchivo'])){
                $sql .=" AND (claMerArc.skClasificacionMercanciaArchivo = '".$this->claMerArc['skClasificacionMercanciaArchivo']."') ";
            }
            if(!empty($this->claMerArc['sFraccion'])){
                $sql .=" AND (claMerArc.sFraccion = '".$this->claMerArc['sFraccion']."') ";
            }
            if(!empty($this->claMerArc['sNumeroParte'])){
                $sql .=" AND (claMerArc.sNumeroParte = '".$this->claMerArc['sNumeroParte']."') ";
            }
            if(!empty($this->claMerArc['sArchivo'])){
                $sql .=" AND (claMerArc.sArchivo = '".$this->claMerArc['sArchivo']."') ";
            }
            if(!empty($this->claMerArc['sThumbnail'])){
                $sql .=" AND (claMerArc.sThumbnail = '".$this->claMerArc['sThumbnail']."') ";
            }
            if(!empty($this->claMerArc['skStatus'])){
                $sql .=" AND (claMerArc.skStatus = '".$this->claMerArc['skStatus']."') ";
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
        public function read_like_claMerArc(){
            $sql = "SELECT claMerArc.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacionMercancia_archivos AS claMerArc "
                . "INNER JOIN _status ON _status.skStatus = claMerArc.skStatus WHERE 1=1 ";
            if(!empty($this->claMerArc['sFraccion'])){
                $sql .=" AND (claMerArc.sFraccion like '%".$this->claMerArc['sFraccion']."%') ";
            }
            if(!empty($this->claMerArc['sNumeroParte'])){
                $sql .=" AND (claMerArc.sNumeroParte like '%".$this->claMerArc['sNumeroParte']."%') ";
            }
            if(!empty($this->claMerArc['sArchivo'])){
                $sql .=" AND (claMerArc.sArchivo like '%".$this->claMerArc['sArchivo']."%') ";
            }
            if(!empty($this->claMerArc['sThumbnail'])){
                $sql .=" AND (claMerArc.sThumbnail like '%".$this->claMerArc['sThumbnail']."%') ";
            }
            if(!empty($this->claMerArc['skStatus'])){
                $sql .=" AND (claMerArc.skStatus = '".$this->claMerArc['skStatus']."') ";
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
        public function create_claMerArc(){
            $sql = "INSERT INTO cat_clasificacionMercancia_archivos 
            (skClasificacionMercanciaArchivo,sFraccion,sNumeroParte,sArchivo,sThumbnail,skStatus) 
            VALUES 
            ('".$this->claMerArc['skClasificacionMercanciaArchivo']."',
            '".$this->claMerArc['sFraccion']."',
            '".$this->claMerArc['sNumeroParte']."',
            '".$this->claMerArc['sArchivo']."',
            '".$this->claMerArc['sThumbnail']."',
            '".$this->claMerArc['skStatus']."'
            )";
            $result = $this->db->query($sql);
            if($result){
                return $this->claMerArc['skClasificacionMercanciaArchivo'];
            }else{
                return false;
            }
        }

        public function update_claMerArc(){
            $sql = "UPDATE cat_clasificacionMercancia_archivos SET "
                . "sFraccion = '".$this->claMer['sFraccion']."',"
                . "sNumeroParte = '".$this->claMer['sNumeroParte']."',"
                . "sArchivo = '".$this->claMer['sArchivo']."',"
                . "sThumbnail = '".$this->claMer['sThumbnail']."',"
                . "skStatus = '".$this->claMer['skStatus']."',"
                . " WHERE skClasificacionMercanciaArchivo = '".$this->claMer['skClasificacionMercanciaArchivo']."';";
            $result = $this->db->query($sql);
            if($result){
                return $this->cla['skClasificacion'];
            }else{
                return false;
            }
        }
        /* TERMINA CLASIFICACIÓN DE MERCANCIAS */
        
        
        /* COMIENZA MODULO clasifiación arancelaria */
        
        /* COMIENZA cat_descripcionFraccion_archivos */

        public function count_numerosParte(){
            $sql = "SELECT COUNT(*) AS total FROM cat_numerosParte WHERE 1=1 ";
            $sql = "	SELECT COUNT(a.skNumeroParte)AS total
					FROM (
							SELECT
								np.*, fnNombresFraccionesArancelarias(np.skNumeroParte)AS TodosLosNombres,
								fnNombresFraccionesArancelariasDescripciones(np.skNumeroParte)AS TodasLasDescripciones
							FROM
								cat_numerosParte np
						) as a
					WHERE 1 = 1 ";
           
			
			if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND skNumeroParte = '".$this->numPar['skNumeroParte']."'";
            }
            if(!empty($this->numPar['sNombre'])){
                $sql .=" AND (sNombre like '%".$this->numPar['sNombre']."%' or TodosLosNombres like '%".$this->numPar['sNombre']."%')";
            }
            if(!empty($this->numPar['sDescripcion'])){
                $sql .=" AND (sDescripcion like '%".$this->numPar['sDescripcion']."%' or TodosLosNombres like '%".$this->numPar['sDescripcion']."%')";
            }
            if(!empty($this->numPar['skStatus'])){
                $sql .=" AND skStatus like '%".$this->numPar['skStatus']."%'";
            }
			//echo $sql;die();
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }

        public function read_like_numerosParte(){
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte AS numPar INNER JOIN _status ON _status.skStatus = numPar.skStatus WHERE 1=1 ";
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus 
					FROM (
							SELECT
								np.*, fnNombresFraccionesArancelarias(np.skNumeroParte)AS TodosLosNombres,
								fnNombresFraccionesArancelariasDescripciones(np.skNumeroParte)AS TodasLasDescripciones
							FROM
								cat_numerosParte np
						) AS numPar 
					INNER JOIN _status ON _status.skStatus = numPar.skStatus 
					WHERE 1=1 ";
            if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND numPar.skNumeroParte = '".$this->numPar['skNumeroParte']."'";
            }
            if(!empty($this->numPar['sNombre'])){
                $sql .=" AND (numPar.sNombre like '%".$this->numPar['sNombre']."%' or numPar.TodosLosNombres like '%".$this->numPar['sNombre']."%')";
            }
            if(!empty($this->numPar['sDescripcion'])){
                $sql .=" AND (numPar.sDescripcion like '%".$this->numPar['sDescripcion']."%' or numPar.TodasLasDescripciones like '%".$this->numPar['sDescripcion']."%')";
            }
            if(!empty($this->numPar['skStatus'])){
                $sql .=" AND numPar.skStatus like '%".$this->numPar['skStatus']."%'";
            }
            if(is_int($this->numPar['limit'])){
                if(is_int($this->numPar['offset'])){
                    $sql .= " LIMIT ".$this->numPar['offset']." , ".$this->numPar['limit'];
                }else{
                    $sql .= " LIMIT ".$this->numPar['limit'];
                }
            }
			//echo $sql;die();
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                    return $result;
                }else{
                    return false;
                }
            }
        }
        
        public function read_equal_numPar(){
            $sql = "SELECT numPar.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte AS numPar INNER JOIN _status ON _status.skStatus = numPar.skStatus WHERE 1=1 ";
            if(!empty($this->numPar['skNumeroParte'])){
                $sql .=" AND (numPar.skNumeroParte = '".$this->numPar['skNumeroParte']."') ";
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

        public function read_equal_numparfraran(){
            $sql = "SELECT numparfraran.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_numerosParte_fraccionesArancelarias AS numparfraran INNER JOIN _status ON _status.skStatus = numparfraran.skStatus WHERE 1=1 ";
            if(!empty($this->numparfraran['skNumeroParte'])){
                $sql .=" AND (numparfraran.skNumeroParte = '".$this->numparfraran['skNumeroParte']."') ";
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

        public function read_equal_fraAraDes(){
            $sql = "SELECT fraAraDes.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_fraccionesArancelarias_descripcionFraccion AS fraAraDes INNER JOIN _status ON _status.skStatus = fraAraDes.skStatus WHERE 1=1 ";
            if(!empty($this->fraAraDes['skFraccionArancelaria'])){
                $sql .=" AND (fraAraDes.skFraccionArancelaria = '".$this->fraAraDes['skFraccionArancelaria']."') ";
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

        public function read_equal_desArc(){
            $sql = "SELECT desArc.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_descripcionFraccion_archivos AS desArc INNER JOIN _status ON _status.skStatus = desArc.skStatus WHERE 1=1 ";
            if(!empty($this->desArc['skFraccionArancelariaDescripcion'])){
                $sql .=" AND (desArc.skFraccionArancelariaDescripcion = '".$this->desArc['skFraccionArancelariaDescripcion']."') ";
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

        public function create_cat_descripcionFraccion_archivos(){
            $sql = "INSERT INTO cat_descripcionFraccion_archivos (skArchivoFraccionArancelaria,skFraccionArancelariaDescripcion,sArchivo,skStatus) "
                    . "VALUES ('".$this->desArc['skArchivoFraccionArancelaria']."','".$this->desArc['skFraccionArancelariaDescripcion']."','".$this->desArc['sArchivo']."','AC')";
            $result = $this->db->query($sql); 
            if($result){
                return $this->desArc['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function update_cat_descripcionFraccion_archivos(){
            $sql = "UPDATE cat_descripcionFraccion_archivos SET "
                    . "";
            $result = $this->db->query($sql);echo '<hr>'.$sql;
            if($result){
                return $this->desArc['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function create_cat_fraccionesArancelarias_descripcionFraccion(){
            $sql = "INSERT INTO cat_fraccionesArancelarias_descripcionFraccion ("
                    . "skFraccionArancelariaDescripcion,"
                    . "skFraccionArancelaria,"
                    . "sDescripcion,"
                    . "sDescripcionIngles,"
                     . "skStatus,"
                    . "dFechaCreacion,"
                    . "skUsersCreacion"
                     . ") VALUES ("
                    . "'".$this->fraAraDes['skFraccionArancelariaDescripcion']."',"
                    . "'".$this->fraAraDes['skFraccionArancelaria']."',"
                    . "'".$this->fraAraDes['sDescripcion']."',"
                    . "'".$this->fraAraDes['sDescripcionIngles']."',"
                    . "'AC',"
                    . "CURRENT_TIMESTAMP,"
                    . "'".$this->fraAraDes['skUsersCreacion']."'"
                     . ")";
                 //  echo $sql;
                  
            $result = $this->db->query($sql);
            if($result){
                return $this->fraAraDes['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        
        public function update_cat_fraccionesArancelarias_descripcionFraccion(){
            $sql = "UPDATE cat_fraccionesArancelarias_descripcionFraccion SET "
                    . "sDescripcion = '".$this->fraAraDes['sDescripcion']."',"
                    . "sDescripcionIngles = '".$this->fraAraDes['sDescripcionIngles']."',"
                    . "sModelo = '".$this->fraAraDes['sModelo']."',"
                    . "skStatus = '".$this->fraAraDes['skStatus']."',"
                    . "dFechaModificacion = '".$this->fraAraDes['dFechaModificacion']."',"
                    . "skUsersModificacion = '".$this->fraAraDes['skUsersModificacion']."',"
                    . " skFraccionArancelariaDescripcion = '".$this->fraAraDes['skFraccionArancelariaDescripcion']."' WHERE skFraccionArancelariaDescripcion = '".$this->fraAraDes['skFraccionArancelariaDescripcion']."'";
            $result = $this->db->query($sql);
            if($result){
                return $this->fraAraDes['skFraccionArancelariaDescripcion'];
            }else{
                return false;
            }
        }
        /* TERMINA cat_descripcionFraccion_archivos */
        
        /* TERMINA MODULO DE EMPRESAS clasifiación arancelaria */
        
        
        
        

        /* COMIENZA create_cat_numeros_partes */
        public function create_cat_numeroParte(){
            $sql = "INSERT INTO cat_numerosParte (skNumeroParte,sNombre,sDescripcion,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES 
            ('".$this->numPar['skNumeroParte']."',
            '".$this->numPar['sNombre']."',
            '".$this->numPar['sDescripcion']."',
            '".$this->numPar['skStatus']."',
             CURRENT_TIMESTAMP,
            '".$this->numPar['skUsersCreacion']."'
            )";
            
            //echo $sql;
           
            $result = $this->db->query($sql);
            if($result){
                return $this->numPar['skNumeroParte'];
            }else{
                return false;
            }
        }
          
          public function update_cat_numeros_partes(){
                $sql = "UPDATE cat_numerosParte SET ";
                
                if(!empty($this->numPar['sNombre'])){
                    $sql .=" sNombre = '".$this->numPar['sNombre']."' ,";
                }
                 if(!empty($this->numPar['sDescripcion'])){
                    $sql .=" sDescripcion = '".$this->numPar['sDescripcion']."' ,";
                }
                if(!empty($this->numPar['skStatus'])){
                    $sql .=" skStatus = '".$this->numPar['skStatus']."' ,";
                }
                $sql .= " skNumeroParte = '".$this->numPar['skNumeroParte']."' WHERE skNumeroParte = '".$this->numPar['skNumeroParte']."' LIMIT 1";
               
                $result = $this->db->query($sql);
                if($result){
                    return $this->numPar['skNumeroParte'];
                }else{
                    return false;
                }
            }
          /* TERMINA create_cat_numeros_partes */
        
        public function create_cat_numparfraran(){
            $sql = "INSERT INTO cat_numerosParte_fraccionesArancelarias (skFraccionArancelaria,skNumeroParte,sNombre,skStatus,dFechaCreacion,skUsersCreacion) 
            VALUES ('".$this->numparfraran['skFraccionArancelaria']."','".$this->numparfraran['skNumeroParte']."','".$this->numparfraran['sNombre']."',
                    '".$this->numparfraran['skStatus']."',CURRENT_TIMESTAMP,'".$this->numparfraran['skUsersCreacion']."')";
            $result = $this->db->query($sql);
           // echo $sql;
         
            if($result){
                return $this->numparfraran['skFraccionArancelaria'];
            }else{
                return false;
            }
        }
        
        public function update_numparfraran(){
                $sql = "UPDATE cat_numerosParte_fraccionesFraccion SET ";
                
                if(!empty($this->numparfraran['sNombre'])){
                    $sql .=" sNombre = '".$this->numparfraran['sNombre']."' ,";
                }
                 if(!empty($this->numparfraran['sDescripcion'])){
                    $sql .=" sDescripcion = '".$this->numparfraran['sDescripcion']."' ,";
                }
                if(!empty($this->numparfraran['skStatus'])){
                    $sql .=" skStatus = '".$this->numparfraran['skStatus']."' ,";
                }
                $sql .= " skFraccionArancelaria = '".$this->numparfraran['skFraccionArancelaria']."' WHERE skFraccionArancelaria = '".$this->numparfraran['skFraccionArancelaria']."' LIMIT 1";
             //   echo $sql;
              //  die();
                $result = $this->db->query($sql);
                if($result){
                    return $this->numparfraran['skFraccionArancelaria'];
                }else{
                    return false;
                }
            }
        
        
        

        
    }
?>

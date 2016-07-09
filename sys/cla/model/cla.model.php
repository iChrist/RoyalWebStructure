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
            /*if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }*/
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
            if(!empty($this->cla['dFechaPrevio'])){
                $sql .=" AND cla.dFechaPrevio like '%".$this->cla['dFechaPrevio']."%'";
            }
            /*if(!empty($this->cla['sfactura'])){
                $sql .=" AND cla.sfactura like '%".$this->cla['sfactura']."%'";
            }*/
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus like '%".$this->cla['skStatus']."%'";
            }
            /* COMIENZA CLAMER */
            if(!empty($this->claMer['sFactura'])){
                $sql .=" AND claMer.sFactura like '%".$this->claMer['sFactura']."%'";
            }
            if(!empty($this->claMer['iSecuencia'])){
                $sql .=" AND claMer.iSecuencia like '%".$this->claMer['iSecuencia']."%'";
            }
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
            /*if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }*/
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
            $sql="SELECT COUNT(*) AS totalFracciones, cla.skClasificacion, cla.sReferencia, cla.valido, cla.skUsersCreacion, rd.sPedimento, emp.sNombre AS empresa, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS ejecutivo, CONCAT(usr.sName,' ',usr.sLastNamePaternal,' ',usr.sLastNameMaternal) AS clasificador, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion "
                . "LEFT JOIN _users AS usr ON usr.skUsers = cla.skUsersModificacion WHERE 1=1 ";
            /*if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }*/
            if($this->cla['valido'] === 0 || $this->cla['valido'] === 1){
                $sql .=" AND cla.valido = ".$this->cla['valido'];
            }
            if(!empty($this->cla['skClasificacion'])){
                $sql .=" AND cla.skClasificacion = '".$this->cla['skClasificacion']."'";
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND emp.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".trim($this->cla['sReferencia'])."%'";
            }
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus = '".$this->cla['skStatus']."'";
            }
            if(!empty($this->cla['skUsersCreacion'])){
                $sql .=" AND cla.skUsersCreacion = '".$this->cla['skUsersCreacion']."'";
            }
            if(!empty($this->cla['skUsersModificacion'])){
                $sql .=" AND cla.skUsersModificacion = '".$this->cla['skUsersModificacion']."'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND rd.sPedimento like '%".trim($this->cla['sPedimento'])."%'";
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
            $sql = "SELECT cla.*, rd.sPedimento, emp.sNombre AS empresa, claMer.sFactura, claMer.sFraccion, claMer.sDescripcion, claMer.sDescripcionIngles, claMer.sNumeroParte, claMer.iSecuencia, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS ejecutivo, CONCAT(usr.sName,' ',usr.sLastNamePaternal,' ',usr.sLastNameMaternal) AS clasificador, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacion AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion "
                . "LEFT JOIN _users AS usr ON usr.skUsers = cla.skUsersModificacion WHERE 1=1 ";
            /*if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else if($this->cla['year'] != null){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }*/
            if($this->cla['valido'] === 0 || $this->cla['valido'] === 1){
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
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus like '%".$this->cla['skStatus']."%'";
            }
            /* COMIENZA CLAMER */
            if(!empty($this->claMer['sFactura'])){
                $sql .=" AND claMer.sFactura like '%".$this->claMer['sFactura']."%'";
            }
            if(!empty($this->claMer['iSecuencia'])){
                $sql .=" AND claMer.iSecuencia like '%".$this->claMer['iSecuencia']."%'";
            }
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
            /*if(!empty($this->cla['year'])){
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') = '".$this->cla['year']."'";
            }else{
                $sql .=" AND DATE_FORMAT(cla.dFechaCreacion,'%Y') < '".date('Y')."'";
            }*/
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
            (skClasificacion,sReferencia,dFechaPrevio,skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion,dFechaImportacion,valido) 
            VALUES 
            ('".$this->cla['skClasificacion']."',
            '".$this->cla['sReferencia']."',
            '".$this->cla['dFechaPrevio']."',
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
            (skClasificacionMercancia,skClasificacion,sFactura,sFraccion,sDescripcion,sDescripcionIngles,sNumeroParte,skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion,iSecuencia,dFechaImportacion) 
            VALUES 
            ('".$this->claMer['skClasificacionMercancia']."',
            '".$this->claMer['skClasificacion']."',
            '".$this->claMer['sFactura']."',
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
                . "sFactura = '".$this->claMer['sFactura']."',"
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
        
// ******************************************************************* // 
                // COMIENZA SEGUNDA CLASIFICACIÓN //
// ******************************************************************* // 
        
        public function validarReferencia($datos = array()){
            $sql = "SELECT * FROM ope_recepciones_documentos rd WHERE rd.sReferencia = '".trim($datos['sReferencia'])."'";
            $result = $this->db->query($sql);
            if($result){
                if($result->num_rows > 0){
                   return true; 
                }else{
                    return false;
                }
            }
        }
        public function existeSegundaClasificacion(){
            if(!empty($this->cla['skClasificacion'])){
                $sql = "SELECT * FROM cat_clasificacionSegunda WHERE skClasificacion = '".$this->cla['skClasificacion']."'";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
            if(!empty($this->cla['sReferencia'])){
                $sql = "SELECT * FROM cat_clasificacionSegunda WHERE sReferencia = '".$this->cla['sReferencia']."'";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
            return false;
        }
        public function segcla_index_getClasificacion($total = false){
            if($total){
                $sql = "SELECT COUNT(*) AS total FROM cat_clasificacionSegunda AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            }else{
            $sql="SELECT COUNT(*) AS totalFracciones, cla.skClasificacion, cla.sReferencia, cla.valido, cla.skUsersCreacion, rd.sPedimento, emp.sNombre AS empresa, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS ejecutivo, CONCAT(usr.sName,' ',usr.sLastNamePaternal,' ',usr.sLastNameMaternal) AS clasificador, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_clasificacionSegunda AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN cat_clasificacionSegundaMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion "
                . "LEFT JOIN _users AS usr ON usr.skUsers = cla.skUsersModificacion WHERE 1=1 ";
            }
            if(!empty($this->cla['skClasificacion'])){
                $sql .=" AND cla.skClasificacion = '".$this->cla['skClasificacion']."'";
            }
            if(!empty($this->cla['skEmpresa'])){
                $sql .=" AND emp.skEmpresa like '%".$this->cla['skEmpresa']."%'";
            }
            if(!empty($this->cla['sReferencia'])){
                $sql .=" AND cla.sReferencia like '%".trim($this->cla['sReferencia'])."%'";
            }
            if(!empty($this->cla['sPedimento'])){
                $sql .=" AND rd.sPedimento like '%".trim($this->cla['sPedimento'])."%'";
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
        public function segcla_form_getMercancias(){
            $clasificacion = "cat_clasificacion"; $clasificacionMercancia = "cat_clasificacionMercancia";
            if($this->existeSegundaClasificacion()){
                $clasificacion = "cat_clasificacionSegunda"; $clasificacionMercancia = "cat_clasificacionSegundaMercancia";
            }
            $sql = "SELECT cla.*, rd.sPedimento, emp.sNombre AS empresa, claMer.sFactura, claMer.sFraccion, claMer.sDescripcion, claMer.sDescripcionIngles, claMer.sNumeroParte, claMer.iSecuencia, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS ejecutivo, CONCAT(usr.sName,' ',usr.sLastNamePaternal,' ',usr.sLastNameMaternal) AS clasificador, _status.sName AS status, _status.sHtml AS htmlStatus FROM ".$clasificacion." AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN ".$clasificacionMercancia." AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion "
                . "LEFT JOIN _users AS usr ON usr.skUsers = cla.skUsersModificacion WHERE 1=1 ";
            
            $this->segcla_form_criteriosMercancia($sql);
            
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
        public function segcla_form_count(){
            $clasificacion = "cat_clasificacion"; $clasificacionMercancia = "cat_clasificacionMercancia";
            if($this->existeSegundaClasificacion()){
                $clasificacion = "cat_clasificacionSegunda"; $clasificacionMercancia = "cat_clasificacionSegundaMercancia";
            }
            $sql = "SELECT COUNT(*) AS total FROM ".$clasificacion." AS cla "
                . "INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia "
                . "INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa "
                . "INNER JOIN _status ON _status.skStatus = cla.skStatus "
                . "INNER JOIN ".$clasificacionMercancia." AS claMer ON claMer.skClasificacion = cla.skClasificacion "
                . "INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion WHERE 1=1 ";
            $this->segcla_form_criteriosMercancia($sql);
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
        public function segcla_form_criteriosMercancia(&$sql){
            if($this->cla['valido'] === 0 || $this->cla['valido'] === 1){
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
            if(!empty($this->cla['skStatus'])){
                $sql .=" AND cla.skStatus like '%".$this->cla['skStatus']."%'";
            }
            /* COMIENZA CLAMER */
            if(!empty($this->claMer['sFactura'])){
                $sql .=" AND claMer.sFactura like '%".$this->claMer['sFactura']."%'";
            }
            if(!empty($this->claMer['iSecuencia'])){
                $sql .=" AND claMer.iSecuencia like '%".$this->claMer['iSecuencia']."%'";
            }
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
            return $sql;
        }
        public function deleteClasificacionSegunda(){
            $sql = "DELETE FROM cat_clasificacionSegunda WHERE skClasificacion = '".$this->cla['skClasificacion']."'";
            $result = $this->db->query($sql);
            if(!$result){
                return false;
            }
            return true;
        }
        public function insertarClasificacionSegunda(){
            $sql = "INSERT INTO cat_clasificacionSegunda (SELECT
                skClasificacion,sReferencia,NULL,'AC','".date('Y-m-d H:i:s')."','".$_SESSION['session']['skUsers']."',NULL,NULL,'".date('Y-m-d H:i:s')."',1
                FROM cat_clasificacion c1 WHERE c1.skClasificacion = '".$this->cla['skClasificacion']."')";
            $result = $this->db->query($sql);
            if(!$result){
                return false;
            }
            return true;
        }
        
        public function insertarClasificacionSegundaMercancias(){
            $sql = "INSERT INTO cat_clasificacionSegundaMercancia (SELECT
                skClasificacionMercancia,skClasificacion,sFactura,sFraccion,sDescripcion,sDescripcionIngles,sNumeroParte,'AC','".date('Y-m-d H:i:s')."','".$_SESSION['session']['skUsers']."',NULL,NULL,iSecuencia,'".date('Y-m-d H:i:s')."'
                FROM cat_clasificacionMercancia cm1 WHERE cm1.skClasificacion = '".$this->cla['skClasificacion']."')";
            $result = $this->db->query($sql);
            if(!$result){
                return false;
            }
            return true;
        }
        public function create_claSeg(){
            $sql = "INSERT INTO cat_clasificacionSegunda 
            (skClasificacion,sReferencia,dFechaPrevio,skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion,dFechaImportacion,valido) 
            VALUES 
            ('".$this->cla['skClasificacion']."',
            '".$this->cla['sReferencia']."',
            '".$this->cla['dFechaPrevio']."',
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
        public function create_claSegMer(){
            $sql = "INSERT INTO cat_clasificacionSegundaMercancia 
            (skClasificacionMercancia,skClasificacion,sFactura,sFraccion,sDescripcion,sDescripcionIngles,sNumeroParte,skStatus,dFechaCreacion,skUsersCreacion,dFechaModificacion,skUsersModificacion,iSecuencia,dFechaImportacion) 
            VALUES 
            ('".$this->claMer['skClasificacionMercancia']."',
            '".$this->claMer['skClasificacion']."',
            '".$this->claMer['sFactura']."',
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
                return false;
            }
        }
        // TERMINA SEGUNDA CLASIFICACIÓN //

        
    }
?>

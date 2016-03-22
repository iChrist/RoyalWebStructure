<?php
	 Class Con_Model Extends Core_Model {

            // PUBLIC VARIABLES //
                public $conceptos = array(
                    'skConcepto'       	=>  ''
                    ,'sNombre'     		 	=>  ''
										,'sNombreCorto'     =>  ''
										,'sDescripcion'     =>  ''
                    ,'skStatus'     		=>  ''
                    ,'limit'        		=>  ''
                    ,'offset'       		=>  ''
                );




//cat_divisas
//cat_conceptos
//rel_cat_conceptos_tipos_tramite
//rel_cat_conceptos_tipos_socios
//rel_cat_conceptos_tarifas
//rel_cat_empresas_conceptos_tarifas
            // PRIVATE VARIABLES //
            private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }

            /* COMIENZA MODULO Conceptos */
            public function count_conceptos(){
                $sql = "SELECT COUNT(*) AS total FROM cat_conceptos WHERE 1=1 ";
                if(!empty($this->conceptos['skConcepto'])){
                    $sql .=" AND skConcepto = '".$this->conceptos['skConcepto']."'";
                }
                if(!empty($this->conceptos['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->conceptos['sNombre']."%'";
                }
								if(!empty($this->conceptos['sNombreCorto'])){
                    $sql .=" AND sNombreCorto like '%".$this->conceptos['sNombreCorto']."%'";
                }
                if(!empty($this->conceptos['sDescripcion'])){
                    $sql .=" AND sDescripcion like '%".$this->conceptos['sDescripcion']."%'";
                }
                if(!empty($this->conceptos['skStatus'])){
                    $sql .=" AND cat_conceptos.skStatus like '%".$this->conceptos['skStatus']."%'";
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

            public function read_equal_conceptos(){
                $sql = "SELECT cat_conceptos.*, _status.sName AS status, _status.sHtml AS htmlStatus
								FROM cat_conceptos INNER JOIN _status ON _status.skStatus = cat_conceptos.skStatus WHERE 1=1 ";
                if(!empty($this->conceptos['skConcepto'])){
                    $sql .=" AND skConcepto = '".$this->conceptos['skConcepto']."'";
                }
                if(!empty($this->conceptos['sNombre'])){
                    $sql .=" AND sNombre = '".$this->conceptos['sNombre']."'";
                }
								if(!empty($this->conceptos['sNombreCorto'])){
                    $sql .=" AND sNombreCorto = '".$this->conceptos['sNombreCorto']."'";
                }
                if(!empty($this->conceptos['sDescripcion'])){
                    $sql .=" AND sDescripcion = '".$this->conceptos['sDescripcion']."'";
                }
                if(!empty($this->conceptos['conceptos'])){
                    $sql .=" AND cat_conceptos.skStatus = '".$this->conceptos['skStatus']."'";
								}
                if(is_int($this->conceptos['limit'])){
                    if(is_int($this->conceptos['offset'])){
                        $sql .= " LIMIT ".$this->conceptos['offset']." , ".$this->conceptos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->conceptos['limit'];
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

            public function read_like_conceptos(){
                $sql = "SELECT cat_conceptos.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM cat_conceptos INNER JOIN _status ON _status.skStatus = cat_conceptos.skStatus WHERE 1=1 ";
                if(!empty($this->conceptos['skConcepto'])){
                    $sql .=" AND skConcepto = '".$this->conceptos['skConcepto']."'";
                }
                if(!empty($this->conceptos['sNombre'])){
                    $sql .=" AND sNombre like '%".$this->conceptos['sNombre']."%'";
                }
                if(!empty($this->conceptos['sTitulo'])){
                    $sql .=" AND sTitulo like '%".$this->conceptos['sTitulo']."%'";
                }
                if(!empty($this->conceptos['skStatus'])){
                    $sql .=" AND cat_conceptos.skStatus like '%".$this->conceptos['skStatus']."%'";
                }
                if(is_int($this->conceptos['limit'])){
                    if(is_int($this->conceptos['offset'])){
                        $sql .= " LIMIT ".$this->conceptos['offset']." , ".$this->conceptos['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->conceptos['limit'];
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

            public function create_conceptos(){
                $sql = "INSERT INTO cat_conceptos (skConcepto,sNombre,sNombreCorto,sDescripcion,skStatus) VALUES ('".$this->conceptos['skConcepto']."','".$this->conceptos['sNombre']."','".$this->conceptos['sNombreCorto']."','".$this->conceptos['sDescripcion']."','".$this->conceptos['skStatus']."')";
                $result = $this->db->query($sql);
                if($result){
                    return $this->conceptos['cat_conceptos'];
                }else{
                    return false;
                }
            }

            public function update_conceptos(){
                $sql = "UPDATE cat_conceptos SET ";
                if(!empty($this->conceptos['sNombre'])){
                    $sql .=" sNombre = '".$this->conceptos['sNombre']."' ,";
                }
                if(!empty($this->conceptos['sNombreCorto'])){
                    $sql .=" sNombreCorto = '".$this->conceptos['sNombreCorto']."' ,";
                }
								if(!empty($this->conceptos['sDescripcion'])){
                    $sql .=" sDescripcion = '".$this->conceptos['sDescripcion']."' ,";
                }
                if(!empty($this->conceptos['skStatus'])){
                    $sql .=" skStatus = '".$this->conceptos['skStatus']."' ,";
                }
                $sql .= " skConcepto = '".$this->conceptos['skConcepto']."' WHERE skConcepto = '".$this->conceptos['skConcepto']."' LIMIT 1";
                $result = $this->db->query($sql);
                if($result){
                    return $this->conceptos['skConcepto'];
                }else{
                    return false;
                }
            }

            public function delete_conceptos(){
                $sql = "UPDATE cat_conceptos SET skStatus = 'DE' WHERE skConcepto = '".$this->conceptos['skConcepto']."' LIMIT 1 ";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            /* TERMINA MODULO Conceptos */


	}
?>

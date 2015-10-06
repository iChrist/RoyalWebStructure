<?php
	Abstract Class Emp_Model Extends Core_Model {
                
            // PUBLIC VARIABLES //
                public $areas = array(
                    'skAreas'       =>  ''
                    ,'nombre'       =>  ''
                    ,'correo'       =>  ''
                    ,'skStatus'     =>  ''
                    ,'limit'        =>  ''
                    ,'offset'       =>  ''
                );
                    
            // PRIVATE VARIABLES //
                    private $data = array();

            public function __construct(){
                    parent::__construct();
            }

            public function __destruct(){

            }
            
            /* COMIENZA MODULO areas */
            public function count_areas(){
                $sql = "SELECT COUNT(*) AS total FROM areas WHERE 1=1 ";
                if(!empty($this->areas['skAreas'])){
                    $sql .=" AND skAreas = '".$this->areas['skAreas']."'";
                }
                if(!empty($this->areas['nombre'])){
                    $sql .=" AND nombre like '%".$this->areas['nombre']."%'";
                }
                if(!empty($this->areas['correo'])){
                    $sql .=" AND correo like '%".$this->areas['correo']."%'";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" AND skStatus like '%".$this->areas['skStatus']."%'";
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
            
            public function read_equal_areas(){
                $sql = "SELECT areas.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM areas INNER JOIN _status ON _status.skStatus = areas.skStatus WHERE 1=1 ";
                if(!empty($this->areas['skAreas'])){
                    $sql .=" AND skAreas = '".$this->areas['skAreas']."'";
                }
                if(!empty($this->areas['nombre'])){
                    $sql .=" AND nombre = '".$this->areas['nombre']."'";
                }
                if(!empty($this->areas['correo'])){
                    $sql .=" AND correo = '".$this->areas['correo']."'";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" AND skStatus = '".$this->areas['skStatus']."'";
                }
                if(is_int($this->users['limit'])){
                    if(is_int($this->users['offset'])){
                        $sql .= " LIMIT ".$this->users['offset']." , ".$this->users['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->users['limit'];
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
            
            public function read_like_areas(){
                $sql = "SELECT areas.*, _status.sName AS status, _status.sHtml AS htmlStatus FROM areas INNER JOIN _status ON _status.skStatus = areas.skStatus WHERE 1=1 ";
                if(!empty($this->areas['skAreas'])){
                    $sql .=" AND skAreas = '".$this->areas['skAreas']."'";
                }
                if(!empty($this->areas['nombre'])){
                    $sql .=" AND nombre like '%".$this->areas['nombre']."%'";
                }
                if(!empty($this->areas['correo'])){
                    $sql .=" AND correo like '%".$this->areas['correo']."%'";
                }
                if(!empty($this->areas['skStatus'])){
                    $sql .=" AND skStatus like '%".$this->areas['skStatus']."%'";
                }
                if(is_int($this->users['limit'])){
                    if(is_int($this->users['offset'])){
                        $sql .= " LIMIT ".$this->users['offset']." , ".$this->users['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->users['limit'];
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
            
            public function create_areas(){
                $sql = "SELECT * FROM areas";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            
            public function update_areas(){
                $sql = "SELECT * FROM areas";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            public function delete_areas(){
                $sql = "SELECT * FROM areas";
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }
            /* TERMINA MODULO areas */
	}
?>
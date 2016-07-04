<?php
    Abstract Class Mer_Model Extends Core_Model {

        // PUBLIC VARIABLES //
        public $empMer = array(
             'skEmpresaMercancia'      =>  NULL
            ,'skEmpresa'    => NULL
            ,'sReferencia'      =>  NULL
            ,'sPedimento'      =>  NULL
            ,'dFechaPrevio'     => NULL
            ,'skStatus'     =>  NULL
            ,'limit'        =>  NULL
            ,'offset'       =>  NULL
        );
        
        public function create_empMer(){
            $sql = "INSERT INTO ope_empresas_mercancias (skEmpresaMercancia,skEmpresa,sReferencia,sPedimento,dFechaPrevio,skStatus)"
                    . " VALUES ("
                    . "'".$this->empMer['skEmpresaMercancia']."'"
                    . ",'".$this->empMer['skEmpresa']."',"
                    . ",'".$this->empMer['sReferencia']."',"
                    . "'".$this->empMer['sPedimento']."',"
                    . "'".$this->empMer['dFechaPrevio']."',"
                    . "'".$this->empMer['skStatus']."')";
            $result = $this->db->query($sql);
            if($result){
                return $this->empMer['skEmpresaMercancia'];
            }else{
                return false;
            }
        }
        
        public function update_empMer(){
            $sql = "UPDATE ope_empresas_mercancias SET ";
            if(!empty($this->empMer['skEmpresa'])){
                $sql .=" skEmpresa = '".$this->empMer['skEmpresa']."' ,";
            }
            if(!empty($this->empMer['sReferencia'])){
                $sql .=" sReferencia = '".$this->empMer['sReferencia']."' ,";
            }
            if(!empty($this->empMer['sPedimento'])){
                $sql .=" sPedimento = '".$this->empMer['sPedimento']."' ,";
            }
            if(!empty($this->empMer['dFechaPrevio'])){
                $sql .=" dFechaPrevio = '".$this->empMer['dFechaPrevio']."' ,";
            }
            if(!empty($this->empMer['skStatus'])){
                $sql .=" skStatus = '".$this->empMer['skStatus']."' ,";
            }
            $sql .= " skEmpresaMercancia = '".$this->empMer['skEmpresaMercancia']."' WHERE skEmpresaMercancia = '".$this->empMer['skEmpresaMercancia']."' LIMIT 1";
            $result = $this->db->query($sql);
            if($result){
                return $this->empMer['skEmpresaMercancia'];
            }else{
                return false;
            }
        }
    }
?>
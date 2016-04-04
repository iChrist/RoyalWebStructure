<?php
	Class Cot_Model Extends Core_Model {

						// PUBLIC VARIABLES //
                public $cotizaciones = array(
                    'skCotizacion'       				=>  ''
                    ,'skReferencia'     		 		=>  ''
										,'sPedimento'     					=>  ''
										,'skTipoServicio'     			=>  ''
										,'skTipoCobroCotizacion'    =>  ''
										,'skTipoTramite'     				=>  ''
										,'skEmpresaImportador'    	=>  ''
										,'skEmpresaRecinto'    			=>  ''
										,'skEmpresaNaviera'    			=>  ''
										,'dFechaCreacion'    				=>  ''
										,'skEstatus'  							=>  ''
                    ,'limit'        						=>  ''
                    ,'offset'       						=>  ''
                );

            // PRIVATE VARIABLES //
            private $data = array();

            public function __construct(){
                parent::__construct();
            }
            public function __destruct(){

            }

						/* COMIENZA MODULO Cotizaciones */
            public function count_cotizaciones(){
                $sql = "SELECT COUNT(*) AS total FROM ope_cotizaciones WHERE 1=1 ";
                if(!empty($this->cotizaciones['skCotizacion'])){
                    $sql .=" AND skCotizacion = '".$this->cotizaciones['skCotizacion']."'";
                }
                if(!empty($this->cotizaciones['skReferencia'])){
                    $sql .=" AND skReferencia = '".$this->cotizaciones['skReferencia']."'";
                }
								if(!empty($this->cotizaciones['sPedimento'])){
                    $sql .=" AND sPedimento = '".$this->cotizaciones['sPedimento']."'";
                }
                if(!empty($this->cotizaciones['skTipoServicio'])){
                    $sql .=" AND skTipoServicio = '".$this->cotizaciones['skTipoServicio']."'";
                }
								if(!empty($this->cotizaciones['skTipoCobroCotizacion'])){
                    $sql .=" AND skTipoCobroCotizacion = '".$this->cotizaciones['skTipoCobroCotizacion']."'";
                }
								if(!empty($this->cotizaciones['skTipoTramite'])){
                    $sql .=" AND skTipoTramite = '".$this->cotizaciones['skTipoTramite']."'";
                }
								if(!empty($this->cotizaciones['skEmpresaImportador'])){
                    $sql .=" AND skEmpresaImportador = '".$this->cotizaciones['skEmpresaImportador']."'";
                }
								if(!empty($this->cotizaciones['skEmpresaRecinto'])){
                    $sql .=" AND skEmpresaRecinto = '".$this->cotizaciones['skEmpresaRecinto']."'";
                }
								if(!empty($this->cotizaciones['skEmpresaNaviera'])){
                    $sql .=" AND skEmpresaNaviera ='".$this->cotizaciones['skEmpresaNaviera']."'";
                }
								if(!is_null($this->cotizaciones['dFechaCreacion'])){
                    $sql .=" AND dFechaCreacion = '".$this->cotizaciones['dFechaCreacion']."'";
                }
                if(!empty($this->cotizaciones['skStatus'])){
                    $sql .=" AND cat_cotizaciones.skStatus like '%".$this->cotizaciones['skStatus']."%'";
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

						public function read_like_cotizaciones(){
                $sql = "SELECT opc.*,
									_status.sName AS status,
									_status.sHtml AS htmlStatus,
									cei.sNombre AS EmpresaImportador,
									cer.sNombre AS EmpresaRecinto,
									cen.sNombre AS EmpresaNaviera,
									cte.sNombre AS TipoServicio,
									ctcc.sNombre AS TipoCobro,
									ctt.sNombre AS TipoTramite,
									ctr.sNombre AS TipoTranporte
									FROM ope_cotizaciones opc
									INNER JOIN _status ON _status.skStatus = opc.skEstatus
									INNER JOIN cat_empresas cei ON cei.skEmpresa = opc.skEmpresaImportador
									INNER JOIN cat_empresas cer ON cer.skEmpresa = opc.skEmpresaRecinto
									INNER JOIN cat_empresas cen ON cen.skEmpresa = opc.skEmpresaNaviera
									INNER JOIN cat_tipos_servicios cte ON cte.skTipoServicio = opc.skTipoServicio
									INNER JOIN cat_tipos_cobros_cotizaciones ctcc ON ctcc.skTipoCobroCotizacion = opc.skTipoCobroCotizacion
									INNER JOIN cat_tipos_tramites ctt ON ctt.skTipoTramite = opc.skTipoTramite
									INNER JOIN cat_tipos_transportes ctr ON ctr.skTipoTransporte = opc.skTipoTransporte
									WHERE 1=1 ";
		          	if(!empty($this->cotizaciones['skCotizacion'])){
                    $sql .=" AND opc.skCotizacion = '".$this->cotizaciones['skCotizacion']."'";
                }
								if(!empty($this->cotizaciones['skReferencia'])){
                    $sql .=" AND opc.skReferencia = '".$this->cotizaciones['skReferencia']."'";
                }
								if(!empty($this->cotizaciones['sPedimento'])){
                    $sql .=" AND opc.sPedimento = '".$this->cotizaciones['sPedimento']."'";
                }
                if(!empty($this->cotizaciones['skTipoServicio'])){
                    $sql .=" AND opc.skTipoServicio = '".$this->cotizaciones['skTipoServicio']."'";
                }
								if(!empty($this->cotizaciones['skTipoCobroCotizacion'])){
                    $sql .=" AND opc.skTipoCobroCotizacion = '".$this->cotizaciones['skTipoCobroCotizacion']."'";
                }
								if(!empty($this->cotizaciones['skTipoTramite'])){
                    $sql .=" AND opc.skTipoTramite = '".$this->cotizaciones['skTipoTramite']."'";
                }
								if(!empty($this->cotizaciones['skEmpresaImportador'])){
                    $sql .=" AND opc.skEmpresaImportador = '".$this->cotizaciones['skEmpresaImportador']."'";
                }
								if(!empty($this->cotizaciones['skEmpresaRecinto'])){
                    $sql .=" AND opc.skEmpresaRecinto = '".$this->cotizaciones['skEmpresaRecinto']."'";
                }
								if(!empty($this->cotizaciones['skEmpresaNaviera'])){
                    $sql .=" AND opc.skEmpresaNaviera ='".$this->cotizaciones['skEmpresaNaviera']."'";
                }
								if(!empty($this->cotizaciones['dFechaCreacion'])){
                    $sql .=" AND opc.dFechaCreacion = '".$this->cotizaciones['dFechaCreacion']."'";
                }
                if(!empty($this->cotizaciones['skStatus'])){
                    $sql .=" AND opc.skStatus like '%".$this->cotizaciones['skStatus']."%'";
                }
                if(is_int($this->cotizaciones['limit'])){
                    if(is_int($this->cotizaciones['offset'])){
                        $sql .= " LIMIT ".$this->cotizaciones['offset']." , ".$this->cotizaciones['limit'];
                    }else{
                        $sql .= " LIMIT ".$this->cotizaciones['limit'];
                    }
                }
								/*echo $sql;
								die();*/
                $result = $this->db->query($sql);
                if($result){
                    if($result->num_rows > 0){
                        return $result;
                    }else{
                        return false;
                    }
                }
            }






	}

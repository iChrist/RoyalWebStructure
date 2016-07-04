<?php
	abstract class Pre_Model extends Core_Model {

		// PRIVATE VARIABLES //
		public $previos = array(
				'skSolicitudPrevio'=>null
				,'ikSolicitudPrevio'=>null
				,'sReferencia'=>null
				,'sPedimento'=>null
				,'dFechaSolicitud'=>null
				,'dFechaPrevio'=>null
				,'dFechaApertura'=>null
				,'skUsuarioCreacion'=>null
				,'skUsuarioEjecutivo'=>null
				,'skUsuarioTramitador'=>null
				,'sMasterBL'=>null
				,'sSelloOrigen'=>null
				,'sSelloFinal'=>null
				,'sNumeroFactura'=>null
				,'sPais'=>null
				,'skStatus'=>null
				,'skEmpresa'=>null
				,'limit'=>null
				,'offset'=>null
				);
			private $_data = array();

		public function __construct(){
			parent::__construct();
		}

		public function __destruct(){

		}
		public function read_previos(){
				$sql = "SELECT 	osp.*,
				cs.sName AS Estatus,
				cs.sHtml As Icono
				FROM ope_solicitudes_previos  osp
				LEFT JOIN _status  cs ON cs.skStatus = osp.skEstatus
				WHERE 1=1";

				$result = $this->db->query($sql);
				if($result){
						if($result->num_rows > 0){
								return $result;
						}else{
								return false;
						}
				}
		}
		public function count_previos(){
				$sql = "SELECT COUNT(*) AS total FROM ope_solicitudes_previos  WHERE 1=1 ";

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
		public function read_referencia() {
        $sql = "SELECT 	rd.*,
        st.sName AS status,
        us.sName AS Ejecutivo,
        ce.sNombre AS Empresa,
        ctt.sNombre AS TipoTramite,
        cts.sNombre AS TipoServicio,
        ccd.sNombre AS ClaveDocumento,
        st.sHtml
        FROM ope_recepciones_documentos rd
        INNER JOIN _status  st ON st.skStatus = rd.skStatus
        INNER JOIN cat_empresas  ce ON ce.skEmpresa = rd.skEmpresa
        INNER JOIN cat_tipos_tramites  ctt ON ctt.skTipoTramite = rd.skTipoTramite
        INNER JOIN cat_tipos_servicios  cts ON cts.skTipoServicio = rd.skTipoServicio
        INNER JOIN cat_claves_documentos  ccd ON ccd.skClaveDocumento = rd.skClaveDocumento
        INNER JOIN _users us ON us.skUsers = rd.skUsersCreacion
        INNER JOIN _status ON _status.skStatus = rd.skStatus
        WHERE 1=1 ";

        if (!empty($this->solreva['sReferencia'])) {
            $sql .=" AND rd.sReferencia = '" . $this->solreva['sReferencia'] . "'";
        }
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
		public function create_previos() {
        $sql = "INSERT INTO ope_solicitudes_previos (
																skSolicitudPrevio,
																skEstatus,
																skSocioImportador,
																skSocioPropietario,
																skSocioRecinto,
																dFechaSolicitud,
																skUsuarioCreacion,
																skUsuarioEjecutivo,
																skUsuarioTramitador,
																sObservacionesSolicitud,
																sMasterBL,
																sContenedor,
																sSelloOrigen,
																sSelloFinal,
																sNumeroFactura,
																sPais)
						VALUES ('". $this->previos['skSolicitudPrevio']."',
										'NU',
  									'".$this->previos['skSocioImportador']."',
										'".$this->previos['skSocioPropietario']."',
										'".$this->previos['skSocioRecinto']."',
 										CURRENT_TIMESTAMP(),
										'".$_SESSION['session']['skUsers']."',
										'".$this->previos['skUsuarioEjecutivo']."',
										'".$this->previos['skUsuarioTramitador']."',
										'".$this->previos['sObservacionesSolicitud']."',
										'".$this->previos['sMasterBL']."',
										'".$this->previos['sContenedor']."',
										'".$this->previos['sSelloOrigen']."',
										'".$this->previos['sSelloFinal']."',
										'".$this->previos['sNumeroFactura']."',
                    '".$this->previos['sPais'] . "')";
        //exit($sql);
        $result = $this->db->query($sql);
        if ($result) {
            return $this->previos['skSolicitudPrevio'];
        } else {
            return false;
        }
    }
		public function read_autoridades(){
					$sql = "SELECT cat_autoridades.*, _status.sName AS status, _status.sHtml  FROM cat_autoridades
					INNER JOIN _status ON _status.skStatus = cat_autoridades.skEstatus WHERE 1=1 ";


					$result = $this->db->query($sql);
					if($result){
							if($result->num_rows > 0){
									return $result;
							}else{
									return false;
							}
					}
		 }
		 public function read_tiposPrevios(){
 					$sql = "SELECT cat_tiposPrevios.*, _status.sName AS status, _status.sHtml  FROM cat_tiposPrevios
 					INNER JOIN _status ON _status.skStatus = cat_tiposPrevios.skEstatus WHERE 1=1 ";


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
?>

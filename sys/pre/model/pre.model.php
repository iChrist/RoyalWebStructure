<?php
    abstract class Pre_Model extends Core_Model
    {
        // PRIVATE VARIABLES //
        public $previos = array(
                'skSolicitudPrevio' => '', 'ikSolicitudPrevio' => '', 'sReferencia' => '', 'sPedimento' => '', 'dFechaSolicitud' => '', 'dFechaPrevio' => '', 'dFechaApertura' => '', 'skUsuarioCreacion' => '', 'skUsuarioEjecutivo' => '', 'skUsuarioTramitador' => '', 'skSocioPropietario' => '', 'skSocioImportador' => '', 'sMasterBL' => '', 'sContenedor' => '', 'sSelloOrigen' => '', 'sSelloFinal' => '', 'sNumeroFactura' => '', 'sPais' => '', 'skStatus' => '', 'skEmpresa' => '', 'skFotoPrevio' => '','sUbicacion' => '','limit' => '', 'offset' => '',
                );
        private $_data = array();

        public function __construct()
        {
            parent::__construct();
        }

        public function __destruct()
        {
        }
        public function read_like_previos()
        {
            $sql = "SELECT LPAD(osp.ikSolicitudPrevio, 5, '0') AS codigo,
							osp.skSolicitudPrevio AS skSolicitudPrevio,
							osp.sReferencia AS sReferencia,
							ce.sNombre AS Estatus,
							ce.sIcono AS iconoEstatus,
							cei.sNombre AS importador,
							cep.sNombre AS propietario,
							cer.sNombre AS recinto,
							osp.sMasterBL AS mbl,
							osp.sContenedor AS contenedor,
							osp.sSelloOrigen AS selloOrigen,
							osp.sSelloFinal AS selloFinal,
							osp.sNumeroFactura AS numeroFactura,
							osp.sPais AS paisOrigen,
							osp.dFechaSolicitud AS fechaSolicitud,
							osp.dFechaProgramacion AS fechaProgramacion,
							osp.dFechaPrevio AS fechaPrevio,
							osp.dFechaApertura AS fechaApertura,
							us.sName AS usuarioCreacion,
							usj.sName AS usuarioEjecutivo,
							ust.sName AS usuarioTramitador
						FROM ope_solicitudes_previos osp
						LEFT JOIN cat_estatus ce ON ce.skEstatus = osp.skEstatus
						LEFT JOIN rel_empresas_socios resi ON resi.skSocioEmpresa = osp.skSocioImportador
						LEFT JOIN cat_empresas cei ON cei.skEmpresa = resi.skEmpresa
						LEFT JOIN rel_empresas_socios resp ON resp.skSocioEmpresa = osp.skSocioPropietario
						LEFT JOIN cat_empresas cep ON cep.skEmpresa = resp.skEmpresa
						LEFT JOIN rel_empresas_socios resr ON resr.skSocioEmpresa = osp.skSocioRecinto
						LEFT JOIN cat_empresas cer ON cer.skEmpresa = resr.skEmpresa
						LEFT JOIN _users us ON us.skUsers = osp.skUsuarioCreacion
						LEFT JOIN _users usj ON usj.skUsers = osp.skUsuarioEjecutivo
						LEFT JOIN _users ust ON ust.skUsers = osp.skUsuarioTramitador
						WHERE 1=1";
            $sql .= ' ORDER BY osp.ikSolicitudPrevio DESC ';

            $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function read_previos()
        {
            $sql = "SELECT 	osp.*,
						cs.sNombre AS Estatus,
						cs.sIcono As Icono
						FROM ope_solicitudes_previos  osp
						LEFT JOIN cat_estatus  cs ON cs.skEstatus = osp.skEstatus
						WHERE skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."'";
            $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function update_previos()
        {
            $sql = "UPDATE ope_solicitudes_previos
							SET skSocioImportador='".$this->previos['skSocioImportador']."',
									skSocioPropietario='".$this->previos['skSocioPropietario']."',
									skSocioRecinto='".$this->previos['skSocioRecinto']."',
									skUsuarioEjecutivo='".$this->previos['skUsuarioEjecutivo']."',
									dFechaSolicitud='".$this->previos['dFechaSolicitud']."',
									skUsuarioTramitador='".$this->previos['skUsuarioTramitador']."',
									sSelloOrigen='".$this->previos['sSelloOrigen']."',
									sSelloFinal='".$this->previos['sSelloFinal']."',
									sNumeroFactura='".$this->previos['sNumeroFactura']."',
									sObservacionesSolicitud='".$this->previos['sObservacionesSolicitud']."',
									sPais='".$this->previos['sPais']."'
									WHERE skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."'";
            $result = $this->db->query($sql);
            $sql = "DELETE FROM rel_solicitudesPrevio_Autoridades  WHERE skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."'";
            $result1 = $this->db->query($sql);
            if (!$result1) {
                return false;
            }
            $sql = "DELETE FROM rel_solicitudesPrevios_tiposPrevio  WHERE skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."'";
            $result2 = $this->db->query($sql);
            if (!$result2) {
                return false;
            }

            return $this->previos['skSolicitudPrevio'];
        }
        public function count_previos()
        {
            $sql = 'SELECT COUNT(*) AS total FROM ope_solicitudes_previos  WHERE 1=1 ';

                //exit($sql);
                $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function read_referencia()
        {
            $sql = 'SELECT 	rd.*,
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
		        WHERE 1=1 ';

            if (!empty($this->solreva['sReferencia'])) {
                $sql .= " AND rd.sReferencia = '".$this->solreva['sReferencia']."'";
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
        public function create_previos()
        {
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
																sReferencia,
																sPedimento,
																sContenedor,
																sSelloOrigen,
																sSelloFinal,
																sNumeroFactura,
																sPais)
						VALUES ('".$this->previos['skSolicitudPrevio']."',
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
										'".$this->previos['sReferencia']."',
										'".$this->previos['sPedimento']."',
										'".$this->previos['sContenedor']."',
										'".$this->previos['sSelloOrigen']."',
										'".$this->previos['sSelloFinal']."',
										'".$this->previos['sNumeroFactura']."',
                    '".$this->previos['sPais']."')";

            $result = $this->db->query($sql);
            if ($result) {
                return $this->previos['skSolicitudPrevio'];
            } else {
                return false;
            }
        }
        public function read_autoridades()
        {
            $sql = 'SELECT cat_autoridades.*, _status.sName AS status, _status.sHtml  FROM cat_autoridades
					INNER JOIN _status ON _status.skStatus = cat_autoridades.skEstatus WHERE 1=1 ';

            $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function read_tiposPrevios()
        {
            $sql = 'SELECT cat_tiposPrevios.*, _status.sName AS status, _status.sHtml  FROM cat_tiposPrevios
 					INNER JOIN _status ON _status.skStatus = cat_tiposPrevios.skEstatus WHERE 1=1 ';

            $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function autcan_previo()
        {
            $sql = "SELECT LPAD(osp.ikSolicitudPrevio, 5, '0') AS codigo,
							osp.skSolicitudPrevio AS skSolicitudPrevio,
							osp.sReferencia AS sReferencia,
							ce.sNombre AS Estatus,
							ce.sIcono AS iconoEstatus,
							cei.sNombre AS importador,
							cep.sNombre AS propietario,
							cer.sNombre AS recinto,
							osp.sMasterBL AS mbl,
							osp.sContenedor AS contenedor,
							osp.sSelloOrigen AS selloOrigen,
							osp.sSelloFinal AS selloFinal,
							osp.sNumeroFactura AS numeroFactura,
							osp.sPais AS paisOrigen,
							osp.dFechaSolicitud AS fechaSolicitud,
							osp.dFechaProgramacion AS fechaProgramacion,
							osp.dFechaPrevio AS fechaPrevio,
							osp.dFechaApertura AS fechaApertura,
							us.sName AS usuarioCreacion,
							usj.sName AS usuarioEjecutivo,
							ust.sName AS usuarioTramitador
						FROM ope_solicitudes_previos osp
						INNER JOIN cat_estatus ce ON ce.skEstatus = osp.skEstatus
						INNER JOIN rel_empresas_socios resi ON resi.skSocioEmpresa = osp.skSocioImportador
						INNER JOIN cat_empresas cei ON cei.skEmpresa = resi.skEmpresa
						INNER JOIN rel_empresas_socios resp ON resp.skSocioEmpresa = osp.skSocioPropietario
						INNER JOIN cat_empresas cep ON cep.skEmpresa = resp.skEmpresa
						INNER JOIN rel_empresas_socios resr ON resr.skSocioEmpresa = osp.skSocioRecinto
						INNER JOIN cat_empresas cer ON cer.skEmpresa = resr.skEmpresa
						INNER JOIN _users us ON us.skUsers = osp.skUsuarioCreacion
						INNER JOIN _users usj ON usj.skUsers = osp.skUsuarioEjecutivo
						INNER JOIN _users ust ON ust.skUsers = osp.skUsuarioTramitador
						WHERE osp.skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."' ";
                        //Poner el numero de previo
                        $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function read_previos_autoridades()
        {
            $sql = "SELECT * FROM rel_solicitudesPrevio_Autoridades  WHERE 1=1 AND skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."' ";
            $result = $this->db->query($sql);

            return $result;
        }
        public function read_previos_previos()
        {
            $sql = "SELECT * FROM rel_solicitudesPrevios_tiposPrevio  WHERE 1=1 AND skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."' ";
            $result = $this->db->query($sql);

            return $result;
        }

        public function create_autoridades_previos($valores1)
        {
            $sql = 'INSERT INTO rel_solicitudesPrevio_Autoridades (skSolicitudPrevio, skAutoridad ) VALUES '.$valores1.'';
                         //echo  $sql."<br><br><br>";die();
                         $result = $this->db->query($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        public function create_tiposPrevios_previos($valores)
        {
            $sql = 'INSERT INTO rel_solicitudesPrevios_tiposPrevio (skSolicitudPrevio, skTipoPrevio ) VALUES '.$valores.'';
                         //echo  $sql."<br><br><br>";die();
                         $result = $this->db->query($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        public function detail_previo()
        {
            $sql = "SELECT LPAD(osp.ikSolicitudPrevio, 5, '0') AS codigo,
							osp.skSolicitudPrevio AS skSolicitudPrevio,
							osp.sReferencia AS sReferencia,
							ce.sNombre AS Estatus,
							ce.sIcono AS iconoEstatus,
							cei.sNombre AS importador,
							cep.sNombre AS propietario,
							cer.sNombre AS recinto,
							osp.sMasterBL AS mbl,
							osp.sContenedor AS contenedor,
							osp.sSelloOrigen AS selloOrigen,
							osp.sSelloFinal AS selloFinal,
							osp.sNumeroFactura AS numeroFactura,
							osp.sPais AS paisOrigen,
							osp.dFechaSolicitud AS fechaSolicitud,
							osp.dFechaProgramacion AS fechaProgramacion,
							osp.dFechaPrevio AS fechaPrevio,
							osp.dFechaApertura AS fechaApertura,
							us.sName AS usuarioCreacion,
							usj.sName AS usuarioEjecutivo,
							ust.sName AS usuarioTramitador
						FROM ope_solicitudes_previos osp
						INNER JOIN cat_estatus ce ON ce.skEstatus = osp.skEstatus
						INNER JOIN rel_empresas_socios resi ON resi.skSocioEmpresa = osp.skSocioImportador
						INNER JOIN cat_empresas cei ON cei.skEmpresa = resi.skEmpresa
						INNER JOIN rel_empresas_socios resp ON resp.skSocioEmpresa = osp.skSocioPropietario
						INNER JOIN cat_empresas cep ON cep.skEmpresa = resp.skEmpresa
						INNER JOIN rel_empresas_socios resr ON resr.skSocioEmpresa = osp.skSocioRecinto
						INNER JOIN cat_empresas cer ON cer.skEmpresa = resr.skEmpresa
						INNER JOIN _users us ON us.skUsers = osp.skUsuarioCreacion
						INNER JOIN _users usj ON usj.skUsers = osp.skUsuarioEjecutivo
						INNER JOIN _users ust ON ust.skUsers = osp.skUsuarioTramitador
						WHERE osp.skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."' ";
                        //Poner el numero de previo
                        $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function preafo_previo()
        {
            $sql = "SELECT LPAD(osp.ikSolicitudPrevio, 5, '0') AS codigo,
							osp.skSolicitudPrevio AS skSolicitudPrevio,
							osp.sReferencia AS sReferencia,
							ce.sNombre AS Estatus,
							ce.sIcono AS iconoEstatus,
							cei.sNombre AS importador,
							cep.sNombre AS propietario,
							cer.sNombre AS recinto,
							osp.sMasterBL AS mbl,
							osp.sContenedor AS contenedor,
							osp.sSelloOrigen AS selloOrigen,
							osp.sSelloFinal AS selloFinal,
							osp.sNumeroFactura AS numeroFactura,
							osp.sPais AS paisOrigen,
							osp.dFechaSolicitud AS fechaSolicitud,
							osp.dFechaProgramacion AS fechaProgramacion,
							osp.dFechaPrevio AS fechaPrevio,
							osp.dFechaApertura AS fechaApertura,
							us.sName AS usuarioCreacion,
							usj.sName AS usuarioEjecutivo,
							ust.sName AS usuarioTramitador
						FROM ope_solicitudes_previos osp
						INNER JOIN cat_estatus ce ON ce.skEstatus = osp.skEstatus
						INNER JOIN rel_empresas_socios resi ON resi.skSocioEmpresa = osp.skSocioImportador
						INNER JOIN cat_empresas cei ON cei.skEmpresa = resi.skEmpresa
						INNER JOIN rel_empresas_socios resp ON resp.skSocioEmpresa = osp.skSocioPropietario
						INNER JOIN cat_empresas cep ON cep.skEmpresa = resp.skEmpresa
						INNER JOIN rel_empresas_socios resr ON resr.skSocioEmpresa = osp.skSocioRecinto
						INNER JOIN cat_empresas cer ON cer.skEmpresa = resr.skEmpresa
						INNER JOIN _users us ON us.skUsers = osp.skUsuarioCreacion
						INNER JOIN _users usj ON usj.skUsers = osp.skUsuarioEjecutivo
						INNER JOIN _users ust ON ust.skUsers = osp.skUsuarioTramitador
						WHERE osp.skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."' ";
                        //Poner el numero de previo
                        $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function preatr_form()
        {
            $sql = "SELECT LPAD(osp.ikSolicitudPrevio, 5, '0') AS codigo,
							osp.skSolicitudPrevio AS skSolicitudPrevio,
							osp.sReferencia AS sReferencia,
							ce.sNombre AS Estatus,
							ce.sIcono AS iconoEstatus,
							cei.sNombre AS importador,
							cep.sNombre AS propietario,
							cer.sNombre AS recinto,
							osp.sMasterBL AS mbl,
							osp.sContenedor AS contenedor,
							osp.sSelloOrigen AS selloOrigen,
							osp.sSelloFinal AS selloFinal,
							osp.sNumeroFactura AS numeroFactura,
							osp.sPais AS paisOrigen,
							osp.dFechaSolicitud AS fechaSolicitud,
							osp.dFechaProgramacion AS fechaProgramacion,
							osp.dFechaPrevio AS fechaPrevio,
							osp.dFechaApertura AS fechaApertura,
							us.sName AS usuarioCreacion,
							usj.sName AS usuarioEjecutivo,
							ust.sName AS usuarioTramitador,
							osp.skUsuarioTramitador
						FROM ope_solicitudes_previos osp
						INNER JOIN cat_estatus ce ON ce.skEstatus = osp.skEstatus
						INNER JOIN rel_empresas_socios resi ON resi.skSocioEmpresa = osp.skSocioImportador
						INNER JOIN cat_empresas cei ON cei.skEmpresa = resi.skEmpresa
						INNER JOIN rel_empresas_socios resp ON resp.skSocioEmpresa = osp.skSocioPropietario
						INNER JOIN cat_empresas cep ON cep.skEmpresa = resp.skEmpresa
						INNER JOIN rel_empresas_socios resr ON resr.skSocioEmpresa = osp.skSocioRecinto
						INNER JOIN cat_empresas cer ON cer.skEmpresa = resr.skEmpresa
						INNER JOIN _users us ON us.skUsers = osp.skUsuarioCreacion
						INNER JOIN _users usj ON usj.skUsers = osp.skUsuarioEjecutivo
						INNER JOIN _users ust ON ust.skUsers = osp.skUsuarioTramitador
						WHERE osp.skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."' ";
                        //Poner el numero de previo
                        $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
        public function update_preatr_previos()
        {
            $sql = "UPDATE ope_solicitudes_previos
							SET skUsuarioTramitador='".$this->previos['skUsuarioTramitador']."'
							WHERE skSolicitudPrevio = '".$this->previos['skSolicitudPrevio']."'";
            $result = $this->db->query($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
        public function read_filter_cla()
        {
            $sql = "SELECT cla.*, rd.sPedimento, emp.sNombre AS empresa, claMer.sFactura, claMer.sFraccion, claMer.sDescripcion, claMer.sDescripcionIngles, claMer.sNumeroParte, claMer.iSecuencia, CONCAT(u.sName,' ',u.sLastNamePaternal,' ',u.sLastNameMaternal) AS ejecutivo, CONCAT(usr.sName,' ',usr.sLastNamePaternal,' ',usr.sLastNameMaternal) AS clasificador, _status.sName AS status, _status.sHtml AS htmlStatus"
                        .' FROM cat_clasificacion AS cla '
                        .'INNER JOIN ope_recepciones_documentos rd ON rd.sReferencia = cla.sReferencia '
                        .'INNER JOIN cat_empresas emp ON emp.skEmpresa = rd.skEmpresa '
                        .'INNER JOIN _status ON _status.skStatus = cla.skStatus '
                        .'INNER JOIN cat_clasificacionMercancia AS claMer ON claMer.skClasificacion = cla.skClasificacion '
                        .'INNER JOIN _users AS u ON u.skUsers = cla.skUsersCreacion '
                        .'LEFT JOIN _users AS usr ON usr.skUsers = cla.skUsersModificacion WHERE 1=1 ';

            if (!empty($this->previos['sReferencia'])) {
                $sql .= " AND cla.sReferencia = '".$this->previos['sReferencia']."'";
            }

            //exit($sql);
                $result = $this->db->query($sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    return $result;
                } else {
                    return false;
                }
            }
        }
				public function agregar_fotos_previos(){

					$sql = "INSERT INTO rel_solicitudesPrevios_fotos
															(skFotoPrevio, skSolicitudPrevio,
															 skUsuarioCreacion,skEstatus,sUbicacion,dFechaCreacion )
															 VALUES (
															'".$this->previos['skFotoPrevio']."',
															'".$this->previos['skSolicitudPrevio']."',
															'".$_SESSION['session']['skUsers']."',
															'AC',
															'".$this->previos['sUbicacion']."',
															CURRENT_TIMESTAMP()
															 )";
					//echo  $sql."<br><br><br>";die();
					$result = $this->db->query($sql);
					if ($result) {
							return true;
					} else {

							return false;
					}
				}
				public function listar_fotos_previos(){
					$sql="SELECT * FROM rel_solicitudesPrevios_fotos WHERE skSolicitudPrevio ='".$this->previos['skSolicitudPrevio']."' AND skEstatus = 'AC' ";
					//exit($sql);
							$result = $this->db->query($sql);
					if ($result) {
							if ($result->num_rows > 0) {
									return $result;
							} else {
									return false;
							}
					}
				}
				public function eliminar_fotos_previos($arrayNoEliminados){
						$sql="UPDATE rel_solicitudesPrevios_fotos
									SET skEstatus='EL'
									WHERE skFotoPrevio NOT IN(".$arrayNoEliminados.")";
									$result = $this->db->query($sql);
									if ($result) {
											return true;
									} else {

											return false;
									}

				}
    }

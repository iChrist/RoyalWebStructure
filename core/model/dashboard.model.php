<?php
        Class darshboard_model Extends Core_Model {

          public function numUser(){
            $sql = "SELECT count(*) AS Numero FROM _users";
            //echo $sql;
            $result = $this->db->query("$sql");
             $rSeccion = $result->fetch_assoc();
            mysqli_free_result($result);
            //echo $rSeccion{'Numero'};
            //var_dump($result);

            echo $html='<div class="col-md-3 col-sm-6">
    					<div class="circle-stat stat-block">
    						<div class="visual">
    							<input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+'.$rSeccion{'Numero'}.'" data-max="100" data-min="-100"/>
    						</div>
    						<div class="details">
    							<div class="title">
    								 <a href="/RoyalWebStructure/sys/cof/cof-usua-con/usuarios/">Usuarios</a>
    							</div>


    						</div>
    					</div>
    				</div>';



          }
          public function numEmpresas(){
            $sql = "SELECT count(*) AS Numero FROM cat_empresas WHERE  skStatus='AC'";
            //echo $sql;
            $result = $this->db->query("$sql");
             $rSeccion = $result->fetch_assoc();
            mysqli_free_result($result);
            //echo $rSeccion{'Numero'};
            //var_dump($result);

            echo $html='<div class="col-md-3 col-sm-6">
              <div class="circle-stat stat-block">
                <div class="visual">
                  <input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+'.$rSeccion{'Numero'}.'" data-max="10000" data-min="-100"/>
                </div>
                <div class="details">
                  <div class="title">
                     <a href="/RoyalWebStructure/sys/emp/empresas-index/empresas/">Empresas</a>
                  </div>


                </div>
              </div>
            </div>';



          }
          public function numReferencias(){
            $sql = "SELECT count(*) AS Numero FROM ope_recepciones_documentos";
            //echo $sql;
            $result = $this->db->query("$sql");
             $rSeccion = $result->fetch_assoc();
            mysqli_free_result($result);
            //echo $rSeccion{'Numero'};
            //var_dump($result);

            echo $html='<div class="col-md-3 col-sm-6">
              <div class="circle-stat stat-block">
                <div class="visual">
                  <input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+'.$rSeccion{'Numero'}.'" data-max="10000" data-min="-100"/>
                </div>
                <div class="details">
                  <div class="title">
                     <a href="/RoyalWebStructure/sys/doc/docume-index/docume-index/">Referencias</a>
                  </div>


                </div>
              </div>
            </div>';



          }
          public function numRevalidaciones(){
            $sql = "SELECT count(*) AS Numero FROM ope_solicitud_revalidacion";
            //echo $sql;
            $result = $this->db->query("$sql");
             $rSeccion = $result->fetch_assoc();
            mysqli_free_result($result);
            //echo $rSeccion{'Numero'};
            //var_dump($result);

            echo $html='<div class="col-md-3 col-sm-6">
              <div class="circle-stat stat-block">
                <div class="visual">
                  <input class="knobify" data-width="115" data-thickness=".2" data-skin="tron" data-displayprevious="true" value="+'.$rSeccion{'Numero'}.'" data-max="10000" data-min="-100"/>
                </div>
                <div class="details">
                  <div class="title">
                     <a href="/RoyalWebStructure/sys/rev/solreva-index/solicitud-de-revalidacion/">Solicitudes <br >de Revalidaci&oacute;n</a>
                  </div>


                </div>
              </div>
            </div>';
          }
          public function numRefeano(){
            $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion < '2016-01-01 00:00:00'";
                  //echo $sql;
                  $result = $this->db->query("$sql");
                  $rano15 = $result->fetch_assoc();

                  $sql="SELECT count(*) AS Refe
                        FROM ope_recepciones_documentos
                        WHERE dFechaCreacion > '2016-01-01 00:00:00'";
                         $result = $this->db->query("$sql");
                        $rano16 = $result->fetch_assoc();
                  //mysqli_free_result($result);

                  echo "['Año', 'Referencia' ],
                  ['2015', ".$rano15['Refe']."],
                  ['2016', ".$rano16['Refe']."]";
          }
          public function numRefeMes(){
            $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion  BETWEEN '2016-01-01 00:00:00' AND '2016-02-01 00:00:00'  ";
                  //echo $sql;
                  $result = $this->db->query("$sql");
                  $ranoEne = $result->fetch_assoc();

                  $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion BETWEEN '2016-02-01 00:00:00' AND '2016-03-01 00:00:00' ";
                  $result = $this->db->query("$sql");
                  $ranoFeb = $result->fetch_assoc();

                  $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion BETWEEN '2016-03-01 00:00:00' AND '2016-04-01 00:00:00' ";
                  $result = $this->db->query("$sql");
                  $ranoMar = $result->fetch_assoc();

                  $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion BETWEEN '2016-04-01 00:00:00' AND '2016-05-01 00:00:00' ";
                  $result = $this->db->query("$sql");
                  $ranoAbr = $result->fetch_assoc();

                  $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion BETWEEN '2016-05-01 00:00:00' AND '2016-06-01 00:00:00' ";
                  $result = $this->db->query("$sql");
                  $ranoMay = $result->fetch_assoc();
                  $sql="SELECT count(*) AS Refe
                  FROM ope_recepciones_documentos
                  WHERE dFechaCreacion BETWEEN '2016-06-01 00:00:00' AND '2016-07-01 00:00:00' ";
                  $result = $this->db->query("$sql");
                  $ranoJun = $result->fetch_assoc();
                  //mysqli_free_result($result);

                  echo "['Mes', 'Referencia' ],
                  ['Enero', ".$ranoEne['Refe']."],
                  ['Febrero', ".$ranoFeb['Refe']."],
                  ['Marzo', ".$ranoMar['Refe']."],
                  ['Abril', ".$ranoAbr['Refe']."],
                  ['Mayo', ".$ranoMay['Refe']."],
                  ['Junio', ".$ranoJun['Refe']."]";
          }
            public function referenciasEjecutivo(){
              $sql="CALL stpEstadisticaReferencia (2016,NULL,NULL,NULL,NULL,NULL,NULL,'UC','ME') ";
              $cadena ="['Ejecutivo', 'ENE','FEB','MAR','ABR','MAY','JUN' ],";
              $result = $this->db->query($sql);
                while($row = $result->fetch_assoc()){
                  $cadena.="['".$row['CAT']."', ".$row['ENE'].",".$row['FEB'].",".$row['MAR'].",".$row['ABR'].",".$row['MAY'].",".$row['JUN']." ],";
                }

              echo $cadena;
            }
            public function refEjecTot(){
              $sql="CALL stpEstadisticaReferencia (2016,NULL,NULL,NULL,NULL,NULL,NULL,'UC','TO') ";
              $cadena ="['Ejecutivo', 'Total' ],";
              $result = $this->db->query($sql);
                while($row = $result->fetch_assoc()){
                //  $cadena.="['".$row['CAT']."', ".$row['TOT']."],";
                }
              echo $cadena;
            }
	}
?>

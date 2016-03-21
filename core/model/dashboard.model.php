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
	}
?>

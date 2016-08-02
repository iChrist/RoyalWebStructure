<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <div class="table-container">
            <div class="table-actions-wrapper"> <span></span>
                <div class="table-group-actions pull-right"> <span></span>
                    <!--<button type="button" class="btn btn-sm btn-default" id="enable_filter"><i class="fa fa-search"></i> Buscar</button>-->
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                <thead>
                    <tr role="row" class="heading">
                        <th nowrap>Acciones</th>
                        <th nowrap>E</th>
                        <th nowrap>Código</th>
                        <th nowrap>Fecha de Solicitud</th>
                        <th nowrap>Fecha de Programaci&oacute;n</th>
                        <th nowrap>Referencia</th>
                        <th nowrap>Importador</th>
                        <th nowrap>Recinto</th>
                        <th nowrap>Ejecutivo</th>
                        <th nowrap>Tramitador</th>
                        <th nowrap>Numero de Factura</th>
                        <th width="100%">Pais Origen</th>
                    </tr>
                    <tr role="row" class="filter">
                      <td >
                          <div aria-label="Acciones" role="group" class="btn-group btn-group-xs" style="width:100px">
                              <button class="btn btn-xs btn-default filter-submit margin-bottom"><i class="fa fa-search"></i> Buscar</button>
                              <button class="btn btn-xs btn-warning filter-cancel"><i class="fa fa-refresh"></i></button>
                          </div>
                      </td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                            <input type="text" class="form-control form-filter" id="dFechaSolicitud" name="dFechaSolicitud" placeholder="Fecha Solicitud">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                      </td>
                      <td>
                        <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                            <input type="text" class="form-control form-filter" name="dFechaInicioProgramacion" placeholder="Fecha Inicio">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                        <div class="input-group input-group-sm date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                            <input type="text" class="form-control form-filter" name="dFechaFinProgramacion" placeholder="Fecha Fin">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                      </td>
                      <td>
                        <input type="text" class="form-control form-filter input-sm" name="sReferencia" placeholder="Referencia">
                      </td>
                      <td><select name="skSocioImportador" class="form-control form-filter input-sm">
                              <option value="">- Importador -</option>
                              <?php
                              if ($data['clientes']) {
                                  while ($row = $data['clientes']->fetch_assoc()) {
                                      ?>
                                      <option value="<?php echo $row['skSocioEmpresa']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                                      <?php
                                  }//ENDIF
                              }//ENDWHILE
                              ?>
                          </select></td>
                          <td><select name="skSocioRecinto" class="form-control form-filter input-sm">
                                  <option value="">- Recinto -</option>
                                  <?php
                                  if ($data['recintos']) {
                                      while ($row = $data['recintos']->fetch_assoc()) {
                                          ?>
                                          <option value="<?php echo $row['skSocioEmpresa']; ?>"> <?php echo utf8_encode($row['sNombre']); ?> </option>
                                          <?php
                                      }//ENDIF
                                  }//ENDWHILE
                                  ?>
                              </select></td>
                              <td><select name="skUsuarioEjecutivo" class="form-control form-filter input-sm">
                                      <option value="">- Ejecutivo -</option>
                                      <?php
                                      if ($data['users']) {
                                          while ($row = $data['users']->fetch_assoc()) {
                                              ?>
                                              <option value="<?php echo $row['skUsers']; ?>"> <?php echo utf8_encode($row['sName']); ?> </option>
                                              <?php
                                          }//ENDIF
                                      }//ENDWHILE
                                      ?>
                                  </select></td>
                                  <td><select name="skUsuarioTramitador" class="form-control form-filter input-sm">
                                          <option value="">- Tramitador -</option>
                                          <?php
                                          if ($data['usersTramitador']) {
                                              while ($row = $data['usersTramitador']->fetch_assoc()) {
                                                  ?>
                                                  <option value="<?php echo $row['skUsers']; ?>"> <?php echo utf8_encode($row['sName']); ?> </option>
                                                  <?php
                                              }//ENDIF
                                          }//ENDWHILE
                                          ?>
                                      </select></td>
                      <td>
                        <input type="text" class="form-control form-filter input-sm" name="sNumeroFactura" placeholder="Nº Factura">
                      </td>
                      <td>
                        <input type="text" class="form-control form-filter input-sm" name="sPais" placeholder="Pais de Origen">
                      </td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function(){
   // init ajax table //
   TableAjax.init('?axn=fetch_all');
});
</script>

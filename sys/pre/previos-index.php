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
                        <th nowrap>Fecha de Previo</th>
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
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
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

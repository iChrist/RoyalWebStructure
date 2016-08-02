<?php
    $result = array();
    if ($data['datos']) {
        $result = $data['datos']->fetch_assoc();
    }



?>
<!-- BEGIN PAGE LEVEL STYLES (DROPZONE) -->
<!-- END PAGE LEVEL STYLES (DROPZONE) -->
<form id="_save" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="skReferenciaExterna"  id="skReferenciaExterna" value="<?php echo (isset($result['skReferenciaExterna'])) ? $result['skReferenciaExterna'] : ''; ?>">
    <div class="form-body">
      <div class="row">
            <label class="text-right col-md-2"><b>C&oacute;digo</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['codigo'] ? utf8_encode($result['codigo']) : ' N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Estatus</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Estatus'] ? utf8_encode($result['Estatus']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
            <label class="text-right col-md-2"><b>Referencia</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Referencia'] ? utf8_encode($result['Referencia']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Pedimento</b></label>
            <div class="col-md-4">
              <p class="text-left">
                <?php echo $result['Pedimento'] ? utf8_encode($result['Pedimento']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <!--/row-->
      <div class="row">
            <label class="text-right col-md-2"><b>Propietario</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Propietario'] ? utf8_encode($result['Propietario']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Fecha Creacion</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['FechaCreacion'] ? date('d/m/Y H:i:s', strtotime($result['FechaCreacion'])) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Cliente</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['Importador'] ? utf8_encode($result['Importador']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Usuario Creación</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['UsuarioCreacion'] ? utf8_encode($result['UsuarioCreacion']) : 'N/D'; ?>
              </p>
            </div>
      </div>



      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Guia Master</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['GuiaMaster'] ? utf8_encode($result['GuiaMaster']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Guia House</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo $result['GuiaHouse'] ? utf8_encode($result['GuiaHouse']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Mercanc&iacute;a</b></label>
            <div class="col-md-10">
              <p class="text-left">
                 <?php echo $result['Mercancia'] ? utf8_encode($result['Mercancia']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
            <label class="text-right col-md-2"><b>Almac&eacute;n</b></label>
            <div class="col-md-4">
              <p class="text-left">
                 <?php echo (isset($result['Almacen'])) ? utf8_encode($result['Almacen']) : 'N/D'; ?>
              </p>
            </div>
            <label class="text-right col-md-2"><b>Nº de Bultos</b></label>
            <div class="col-md-4">
              <p class="">
                 <?php echo (isset($result['iBultos'])) ? utf8_encode($result['iBultos']) : 'N/D'; ?>
              </p>
            </div>
        <!--/span-->
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Previo</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaPrevio" name="dFechaPrevio" class="form-control" value="<?php echo (isset($result['FechaPrevio']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaPrevio']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraPrevio" name="tHoraPrevio" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraPrevio']) ? utf8_encode($result['tHoraPrevio']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>

      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Despacho</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaDespacho" name="dFechaDespacho" class="form-control" value="<?php echo (isset($result['FechaDespacho']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaDespacho']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraDespacho" name="tHoraDespacho" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraDespacho']) ? utf8_encode($result['tHoraDespacho']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Calisificaci&oacute;n</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaClasificacion" name="dFechaClasificacion" class="form-control" value="<?php echo (isset($result['FechaClasificacion']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaClasificacion']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraClasificacion" name="tHoraClasificacion" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraClasificacion']) ? utf8_encode($result['tHoraClasificacion']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Glosa</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaGlosa" name="dFechaGlosa" class="form-control" value="<?php echo (isset($result['FechaGlosa']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaGlosa']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraGlosa" name="tHoraGlosa" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraGlosa']) ? utf8_encode($result['tHoraGlosa']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Captura Pedimento</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaCapturaPedimento" name="dFechaCapturaPedimento" class="form-control" value="<?php echo (isset($result['FechaCapturaPedimento']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaCapturaPedimento']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraCaptura" name="tHoraCaptura" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraCaptura']) ? utf8_encode($result['tHoraCaptura']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Revalidaci&oacute;n</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaRevalidacion" name="dFechaRevalidacion" class="form-control" value="<?php echo (isset($result['FechaRevalidacion']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaRevalidacion']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraRevalidacion" name="tHoraRevalidacion" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraRevalidacion']) ? utf8_encode($result['tHoraRevalidacion']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2">Fecha de Facturaci&oacute;n</label>
          <div class="col-md-2">
              <div data-date-format="dd-mm-yyyy" class="input-group input-medium date date-picker">
                  <input type="text" id="dFechaFacturacion" name="dFechaFacturacion" class="form-control" value="<?php echo (isset($result['FechaFacturacion']) ? utf8_encode(date('d-m-Y', strtotime($result['FechaFacturacion']))) : '') ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
        </div>
          <label class="control-label col-md-1"></label>
           <div class="col-md-2">
              <div class="input-group bootstrap-timepicker">
                  <input type="text" id="tHoraFacturacion" name="tHoraFacturacion" class="form-control timepicker-24" value="<?php echo (isset($result['tHoraFacturacion']) ? utf8_encode($result['tHoraFacturacion']) : ' '); ?>">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
                  </span>
              </div>
          </div>
      </div>
    </div>
</form>
<div class="clearfix"></div>
<script type="text/javascript">

    $(document).ready(function(){

      /* VALIDATIONS */
          isValid = $("#_save").validate({
              errorElement: 'span', //default input error message container
              errorClass: 'help-block', // default input error message class
              focusInvalid: false, // do not focus the last invalid input
              ignore: "",
              rules:{

              },
              invalidHandler: function (event, validator) { //alerta de error de visualización en forma de presentar
                  $('.alert-success').hide();
                  $('.alert-danger').show();
                  App.scrollTo($('.alert-danger'), -200);
              },
              errorPlacement: function (error, element) { // hacer la colocación de error para cada tipo de entrada
                  var icon = $(element).parent('.input-icon').children('i');
                  icon.removeClass('fa-check').addClass("fa-warning");
                  icon.attr("data-original-title", $('.alert-danger').text()).tooltip({'container': 'body'});
                  if (element.parent(".input-group").size() > 0) {
                      error.insertAfter(element.parent(".input-group"));
                  } else if (element.attr("data-error-container")) {
                      error.appendTo(element.attr("data-error-container"));
                  } else if (element.parents('.radio-list').size() > 0) {
                      error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                  } else if (element.parents('.radio-inline').size() > 0) {
                      error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                  } else if (element.parents('.checkbox-list').size() > 0) {
                      error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                  } else if (element.parents('.checkbox-inline').size() > 0) {
                      error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                  } else {
                      error.insertAfter(element); // Para otros insumos, sólo realizar comportamiento predeterminado (llamar messages)
                  }
              },
              highlight: function (element) { // entradas de error Hightlight
                  $(element).closest('.form-group').addClass('has-error'); // conjunto de clases de error
              },
              unhighlight: function (element) { // revertir el cambio realizado por hightlight
              },
              success: function (label, element) {
                  var icon = $(element).parent('.input-icon').children('i');
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // conjunto de clases de éxito con el grupo control
                  icon.removeClass("fa-warning").addClass("fa-check");
              }
          });


    });
</script>

      </div>
   </div>
   <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->



<!-- COMIENZA VENTANA MODAL PARA ELIMINACIÓN !-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="_deleteModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Confirmar eliminaci&oacute;n de registro</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <center><h3>&iquest;Desea confirmar la eliminación del siguiente registro?</h3></center>
            <div id="_deleteModalRecord"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="_deleteCancel();">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="_deleteConfirm(_deleteConfirmUrl);">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- TERMINA VENTANA MODAL PARA ELIMINACIÓN !-->


<!-- COMIENZA VENTANA MODAL PARA ELIMINACIÓN !-->
<div class="modal fade _default-modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title _default-modal-title" id="gridSystemModalLabel"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="_default-modal-content"></div>
            <div class="_default-modal-record"></div>
        </div>
      </div>
      <div class="modal-footer _default-modal-buttons">
        <button type="button" class="btn btn-default _default-modal-cancel" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary _default-modal-ok">Aceptar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- TERMINA VENTANA MODAL PARA ELIMINACIÓN !-->





<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 <a href="http://royalweb.com.mx" target="_blank" class="footer-inner"><?php echo date('Y')?> &copy; RoyalWeb</a>
	</div>
	<div class="footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN CORE DYNAMICALLY HTML USING JAVASCRIPT -->
<div style="display:none;" id="_delete"></div>
<!-- END CORE DYNAMICALLY HTML USING JAVASCRIPT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>!-->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-mixitup/jquery.mixitup.min.js"></script>

<script src="<?php echo SYS_URL; ?>core/assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery.peity.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN AJAX TABLE SCRIPTS & PLUGINS -->
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo SYS_URL; ?>core/assets/lib/app.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/lib/portfolio.js"></script>
<script src="<?php echo SYS_URL; ?>core/assets/lib/index.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/lib/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<!-- VALIDATION PLUGINS -->
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-validation/js/additional-methods.min.js"></script>

<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/lib/datatable.js"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/lib/table-ajax.js"></script>
<!-- END AJAX TABLE SCRIPTS & PLUGINS -->

<!-- TOAST SCRIPTS -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="<?php echo SYS_URL; ?>core/assets/lib/ui-toastr.js"></script>

<!-- FILE UPLOAD PLUGIN -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<!-- File Upload Plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/lib/form-fileupload.js"></script>
<!-- autocomplete plugin -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>


<!-- BEGIN RoyalWeb CORE SCRIPTS -->
<!--<script src="<?php echo SYS_URL; ?>core/assets/lib/core.js" type="text/javascript"></script>-->
<!-- END RoyalWeb CORE SCRIPTS -->

<!-- FILE UPLOAD TEMPLATE !-->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-success start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Subir</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-danger cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn btn-danger delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash-o"></i>
                            <span>Eliminar</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn btn-warning cancel btn-sm">
                            <i class="fa fa-ban"></i>
                            <span>Cancelar</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>

<script type="text/javascript">
jQuery(document).ready(function() {
   App.init(); // initlayout and core plugins
   Portfolio.init();
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initPeityElements();
   Index.initKnowElements();

   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
   UIToastr.init();

   //FormFileUpload.init();

    $('.date-picker').datepicker({
        autoclose: true
    });
    $('.timepicker-12').timepicker({
        autoclose: true
    });
    $('.timepicker-24').timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false
    });
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

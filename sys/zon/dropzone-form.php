<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo SYS_URL ?>core/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->
<form action="<?php echo SYS_URL ?>core/assets/plugins/dropzone/upload.php" class="dropzone" id="my-dropzone">
</form>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo SYS_URL ?>core/assets/plugins/dropzone/dropzone.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo SYS_URL ?>core/assets/lib/app.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/lib/form-dropzone.js"></script>
<script>
jQuery(document).ready(function() {
   // initiate layout and plugins
   App.init();
         FormDropzone.init();
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
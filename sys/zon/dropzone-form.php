<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo SYS_URL ?>core/assets/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->

<div class="dropzone" id="myDropzone"></div>

<!-- BEGIN PAGE LEVEL PLUGINS (DROPZONE) -->
<script src="<?php echo SYS_URL ?>core/assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo SYS_URL ?>core/assets/lib/form-dropzone.js"></script>
<!-- END PAGE LEVEL PLUGINS (DROPZONE) -->
<script>
jQuery(document).ready(function() {
   // initiate layout and plugins
    //App.init();
    //FormDropzone.init();
    
    Dropzone.options.myDropzone = {
        url: "krkdfk",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        }
        else { done(); }
        }
    };
    
});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
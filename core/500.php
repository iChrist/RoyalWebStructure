<!DOCTYPE html>
<!-- 
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>ERROR 500</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo SYS_URL; ?>core/assets/plugins/select2/select2.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo SYS_URL; ?>core/assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/pages/error.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo SYS_URL; ?>core/assets/img/favicon.png"/>

</head>
<!-- BEGIN BODY -->
<body class="page-500-full-page">
<div class="row">
	<div class="col-md-12 page-500">
		<div class=" number">
			 500
		</div>
		<div class=" details">
			<h3>&iexcl;EROR!</h3>
			<p>
                            <?php echo isset($text) ? $text : 'Internal Server Error.'; ?><br/>
                            <a href="<?php echo SYS_URL; ?>">Ir a inicio.</a>
			</p>
			<!--<form action="#">
                            <div class="input-group input-medium">
                                    <input type="text" class="form-control" placeholder="keyword...">
                                    <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                    </span>
                            </div>
			</form>!-->
		</div>
	</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/select2/select2.min.js"></script>!-->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo SYS_URL; ?>core/assets/lib/app.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  App.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
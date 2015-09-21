<?php
    $error_login;
    $error_message;
    if($_POST){
        require_once(SYS_PATH."usu/controller/usu.controller.php");
        $usu = new Usu_Controller();
        $result = $usu->verifyUser($_POST['sUserName'], $_POST['sPassword']);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                //$_SESSION['session']['skProfile'] = 'profile2';
                $_SESSION['session']['skUsers'] = $row['skUsers'];	
                $_SESSION['session']['sName'] = $row['sName'];
                $_SESSION['session']['sUserName'] = $row['sUserName'];
                $_SESSION['session']['sEmail'] = $row['sEmail'];
                $_SESSION['session']['sGroup'] = $row['sGroup'];
            }
            header('Location: '.$_SERVER['REQUEST_URI']);
        }else{
                $error_login = 1;
                $error_message = '<center>El correo o la contrase&nacute;a son incorrectos, verificalos por favor.</center>';
        }
    }
?>
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
<title>Iniciar sesi&oacute;n</title>
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
<link href="<?php echo SYS_URL; ?>core/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo SYS_URL; ?>core/assets/img/favicon.png"/>

</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="<?php echo SYS_URL; ?>">
	<img src="<?php echo SYS_URL; ?>core/assets/img/RoyalWeb-White.png" alt="RoyalWeb" width="130px" height="50px" />
        </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="" method="post">
		<h3 class="form-title">Iniciar sesi&oacute;n</h3>
		<div class="alert alert-danger <?php echo !empty($error_login) ? 'display-block' : 'display-hide';?>">
			<button class="close" data-close="alert"></button>
			<span>
				<?php echo !empty($error_message) ? 'Usuario o contrase&ntilde;a invalida.': 'Ingresa el usuario y la contrase&ntilde;a.';?> 
			</span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Usuario</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Usuario" name="sUserName"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Contrase&ntilde;a</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Contrase&ntilde;a" name="sPassword"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Recordarme </label>
			<button type="submit" class="btn btn-info pull-right">
			Iniciar sesi&oacute;n </button>
		</div>
		<div class="forget-password">
			<h4>&#191;Olvidaste tu contrase&ntilde;a&#63;</h4>
			<p>
				No te preocupes, da click <a href="javascript:;" id="forget-password">aqu&iacute;</a>
				para recuperar tu contrase&ntilde;a.
			</p>
		</div>
		<!--<div class="create-account">
			<p>
				 Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">Create an account</a>
			</p>
		</div>!-->
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="index.html" method="post">
		<h3>&#191;Olvidaste tu contrase&ntilde;a&#63;</h3>
		<p>
			Ingresa tu correo electr&oacute;nico para recuperar tu contrase&ntilde;a.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Correo electr&oacute;nico" name="sEmail"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default">
			<i class="m-icon-swapleft"></i> Regresar </button>
			<button type="submit" class="btn btn-info pull-right">
			Enviar </button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    <a href="http://royalweb.com.mx" target="_blank" class="copyright"><?php echo date('Y')?> &copy; RoyalWeb</a>
</div>
<!-- END COPYRIGHT -->
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
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SYS_URL; ?>core/assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo SYS_URL; ?>core/assets/lib/app.js" type="text/javascript"></script>
<script src="<?php echo SYS_URL; ?>core/assets/lib/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  App.init();
  Login.init();
  var action = location.hash.substr(1);
          if (action == 'createaccount') {
              $('.register-form').show();
              $('.login-form').hide();
              $('.forget-form').hide();
          } else if (action == 'forgetpassword')  {
              $('.register-form').hide();
              $('.login-form').hide();
              $('.forget-form').show();
          }
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php 
    global $core;
?>  
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <!--<![endif]-->
        <!-- BEGIN HEAD -->
    <html lang="en" class="no-js">
    <head>
    <meta charset="utf-8"/>
    <title><?php echo utf8_encode($core->sTitle); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="RoyalWeb" name="author"/>
    <meta name="MobileOptimized" content="320">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- SELECT2 AUTOCOMPLETE !-->
<link href="<?php echo SYS_URL; ?>core/assets/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<!--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />-->
<!-- NOTIFICATIONS !-->
<link href="<?php echo SYS_URL; ?>core/assets/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<!-- FILE UPLOADS !-->
<link href="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="<?php echo SYS_URL; ?>core/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
<!-- !-->
<link href="<?php echo SYS_URL; ?>core/assets/plugins/typeahead/typeahead.css" rel="stylesheet"/>

<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo SYS_URL; ?>core/assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo SYS_URL; ?>core/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo SYS_URL; ?>core/assets/plugins/jstree/dist/themes/default/style.min.css"/>
<!-- END THEME STYLES -->
<!-- BEGIN RoyalWeb CORE CSS -->
<link href="<?php echo SYS_URL; ?>core/assets/css/core.css" rel="stylesheet" type="text/css"/>
<!-- END RoyalWeb CORE CSS -->
<script src="<?php echo SYS_URL; ?>core/assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<!-- BEGIN RoyalWeb CORE SCRIPTS -->
<script src="<?php echo SYS_URL; ?>core/assets/lib/core.js" type="text/javascript"></script>
<!-- END RoyalWeb CORE SCRIPTS -->
<link rel="shortcut icon" href="<?php echo SYS_URL; ?>core/assets/img/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
            <a href="<?php echo SYS_URL; ?>">
                <img src="<?php echo SYS_URL; ?>core/assets/img/RoyalWeb-White.png" alt="logo" style="width:110px;height:40px;margin:5px;"/>
            </a>
        </div>
        <form class="search-form search-form-header" role="form" action="index.html">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input type="text" class="form-control input-sm" name="query" placeholder="Buscar...">
            </div>
        </form>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="<?php echo SYS_URL; ?>core/assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
			<!-- END TODO DROPDOWN -->
			<li class="devider">
				 &nbsp;
			</li>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="assets/img/avatar3_small.jpg"/>
				<span class="username username-hide-on-mobile"><?php echo $_SESSION['session']['sName'];?> </span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="extra_profile.html"><i class="fa fa-user"></i> Mi perfil</a>
					</li>
					 
					<li class="divider">
					</li>
					<li>
						<a href="<?php echo SYS_URL; ?>logout/"><i class="fa fa-key"></i>Cerrar sesion </a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<form class="search-form" role="form" action="index.html" method="get">
						<div class="input-icon right">
							<i class="icon-magnifier"></i>
							<input type="text" class="form-control" name="query" placeholder="Search...">
						</div>
					</form>
				</li>
					
				<?php
 				$sMenu="LAT";
 				//print_r($core->GetMenu($sMenu));
				$array = $core->GetMenu($sMenu);
 				 for($i=0;$i<count($array);$i++) {
	 				  $datos = $core->GetSubMenuModuls($array[$i]['skModule']);
	 				//  echo print_r($datos);
	 				echo '<li class="start">
					<a href="'.(count($datos)!=0 ? "javascript:;" : SYS_URL."sys/").'">
					<i class="'.($array[$i]['sIcons'] ? $array[$i]['sIcons'] : '').'"></i>
					<span class="title">'.$array[$i]['sTitle'].'</span>';
					 if(count($datos)==0){ echo '<span class="selected"></span></a>';}else{
						 echo '<span class="arrow "></span></a>';
						echo ' <ul class="sub-menu">';
						 for($j=0;$j<count($datos);$j++) {
			 				  $datModul = $core->GetSubMenuModuls($datos[$j]['skModule']);
			 				 echo '<li>
									<a href="javascript:;">
									<i class="'.$datos[$j]['sIcons'].'"></i>
									'.utf8_encode($datos[$j]['sTitle']).' 
									'.(count($datModul)!=0 ? "<span class=\"arrow \"></span>" : "").'
									';
									 
									echo '</a>';
									 echo'<ul class="sub-menu">';
									 for($k=0;$k<count($datModul);$k++) {
									 
 									echo '	<li >
											<a  href="'.SYS_URL."sys/".$datModul[$k]['sModule']."/".$datModul[$k]['skModule']."/".$datModul[$k]['sName']."/".'"> '.utf8_encode($datModul[$k]['sTitle']).'</a>
										</li>
										 ';
										
									

									 }
									echo '</ul>	</li>';
			 				 }
 					echo '</ul>';
 					 }
 					echo '</li>';
 					}				 
				 				
				?>
				
			</ul>
								<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			 
			<?php 
                            require_once(CORE_PATH.'stage/breadcrumb.php');
                        ?>
			<!-- END PAGE HEADER-->
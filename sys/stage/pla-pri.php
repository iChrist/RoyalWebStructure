<? require_once("../../core/model/core.model.php");?>
<?     $core = new Core_Model(array('module'=>$_GET['skModule'])); ?>    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
    <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
        <!-- BEGIN HEAD -->
    <head>
    <meta charset="utf-8"/>
    <title> <?=utf8_encode($core->sTitle);?> </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="../../core/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../core/assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="../../core/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../core/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!-- BEGIN RoyalWeb CORE CSS -->
<link href="../../core/assets/css/core.css" rel="stylesheet" type="text/css"/>
<!-- END RoyalWeb CORE CSS -->
<link rel="shortcut icon" href="favicon.ico"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
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
            <a href="index.html">
                <img src="assets/img/logo.png" alt="Estructura"/>
            </a>
        </div>
        <form class="search-form search-form-header" role="form" action="index.html">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input type="text" class="form-control input-sm" name="query" placeholder="Search...">
            </div>
        </form>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
			<li class="dropdown" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="icon-bell"></i>
				<span class="badge badge-success">
				2</span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							 Tienes 2 notificaciones nuevas
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-success">
								<i class="fa fa-plus"></i>
								</span>
								Nuevo Usuario Registrado <span class="time">
								3 Minutos </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-danger">
								<i class="fa fa-bolt"></i>
								</span>
								Registro de Documentacion <span class="time">
								5 Minutos</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="#">Ver todas las Notificaciones <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</li>
			<!-- END NOTIFICATION DROPDOWN -->
			<!-- BEGIN INBOX DROPDOWN -->
			<li class="dropdown" id="header_inbox_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="icon-envelope-open"></i>
				<span class="badge badge-info">
				5 </span>
				</a>
				<ul class="dropdown-menu extended inbox">
					<li>
						<p>
							Tienes 4 Mensajes Nuevos
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
								<img src="./assets/img/avatar2.jpg" alt=""/>
								</span>
								<span class="subject">
								<span class="from">
								Christian Jimenez</span>
								<span class="time">
								Justo Ahora </span>
								</span>
								<span class="message">
								Ver nuevas . </span>
								</a>
							</li>
							
						</ul>
					</li>
					<li class="external">
						<a href="inbox.html">Ver todos los Correos <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</li>
			<!-- END INBOX DROPDOWN -->
			<!-- BEGIN TODO DROPDOWN -->
			<li class="dropdown" id="header_task_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="icon-calendar"></i>
				<span class="badge badge-warning">
				5 </span>
				</a>
				<ul class="dropdown-menu extended tasks">
					<li>
						<p>
							 Ustedes tiene 3 Tareas Pendientes
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">
								Referencia pedimento 20000019238</span>
								<span class="percent">
								30% </span>
								</span>
								<span class="progress">
								<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">
								40% Completa </span>
								</span>
								</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li class="external">
						<a href="#">Ver tareas pendientes <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</li>
			<!-- END TODO DROPDOWN -->
			<li class="devider">
				 &nbsp;
			</li>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="assets/img/avatar3_small.jpg"/>
				<span class="username username-hide-on-mobile">Luis Valdez </span>
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
				<li class="start active ">
					<a href="index.html">
					<i class="icon-home"></i>
					<span class="title">Inicio</span>
					<span class="selected"></span>
					</a>
				</li>
				<li >
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Opciones</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="layout_sidebar_fixed.html">
							<i class="icon-settings"></i>
							Configuraci&oacute;n</a>
						</li>
						<li>
							<a href="layout_sidebar_closed.html">
							<i class="icon-book-open"></i>
							Log de Mensajes</a>
						</li>
						<li>
							<a href="layout_boxed_page.html">
							<i class="icon-pin"></i>
							Mensajes</a>
						</li>
					</ul>
				</li>
				<li >
					<a href="javascript:;">
					<i class="fa fa-archive"></i>
					<span class="title">Catalogos</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="ui_general.html">
							Empresas</a>
							
						</li>
						<li>
							<a href="ui_buttons.html">
							Finanzas</a>
						</li>
					</ul>
				</li>
				<li >
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Operaciones</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="form_controls.html">
							Empresas</a>
						</li>
						<li>
							<a href="form_layouts.html">
							Finanzas</a>
						</li>
					</ul>
				</li>
				<li >
					<a href="javascript:;">
					<i class="icon-folder-alt"></i>
					<span class="title">Consultas</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="page_locked.html">
							Empresas</a>
						</li>
						<li>
							<a href="page_blog.html">
							Finanzas</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="icon-pie-chart"></i>
					<span class="title">Estadisticas</span>
					<span class="arrow "></span>
 					</a>
								<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			 
			<? require_once("../stage/breadcrumb.php");?>
			<? require_once("../stage/footer.php");?>
			<!-- END PAGE HEADER-->
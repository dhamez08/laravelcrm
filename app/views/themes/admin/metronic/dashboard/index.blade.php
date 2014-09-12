@extends( $master_view )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/global/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop
@section('body-header')
<div class="{{{$header_class}}}">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
			<img class="logo-default" alt="logo" src="../../assets/admin/layout/img/logo_123crm.png">
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->

		<!-- BEGIN HORIZANTAL MENU -->
		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
		<div class="hor-menu hor-menu-light hidden-sm hidden-xs">
			<ul class="nav navbar-nav">
				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
				<li class="classic-menu-dropdown active">
					<a href="index_3.html">
					<i class="fa fa-home"></i>  Dashboard <span class="selected">
					</span>
					</a>
				</li>
				<li class="classic-menu-dropdown">
					<a href="client_dashboard.html">
					<i class="fa fa-users"></i>  Clients
					</a>
				</li>
				<li class="classic-menu-dropdown">
					<a href="index_3.html">
					<i class="fa fa-calendar"></i>  Calendar
					</a>
				</li>
				<li class="classic-menu-dropdown">
					<a href="index_3.html">
					<i class="fa fa-bar-chart-o"></i>  Sales Pipeline
					</a>
				</li>
				<li class="classic-menu-dropdown">
					<a href="index_3.html">
					<i class="fa fa-briefcase"></i>  Document Library
					</a>
				</li>
				<li class="classic-menu-dropdown">
					<a href="index_3.html">
					<i class="fa fa-bullseye"></i>  Marketing
					</a>
				</li>
				<li class="classic-menu-dropdown">
					<a href="index_3.html">
					<i class="fa fa-file-text-o"></i>  Accounting
					</a>
				</li>
			</ul>
		</div>
		<!-- END HORIZANTAL MENU -->

		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a data-target=".navbar-collapse" data-toggle="collapse" class="menu-toggler responsive-toggler" href="javascript:;">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<li id="header_notification_bar" class="dropdown dropdown-extended dropdown-notification">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					7 </span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<p>
								 You have 14 new notifications
							</p>
						</li>
						<li>
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="overflow: hidden; width: auto; height: 250px;" class="dropdown-menu-list scroller" data-initialized="1">
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-plus"></i>
									</span>
									New user registered. <span class="time">
									Just now </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Server #12 overloaded. <span class="time">
									15 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									Server #2 not responding. <span class="time">
									22 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									Application error. <span class="time">
									40 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Database overloaded 68%. <span class="time">
									2 hrs </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									2 user IP blocked. <span class="time">
									5 hrs </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									Storage Server #4 not responding. <span class="time">
									45 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									System Error. <span class="time">
									55 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Database overloaded 68%. <span class="time">
									2 hrs </span>
									</a>
								</li>
							</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
						</li>
						<li class="external">
							<a href="#">
							See all notifications <i class="m-icon-swapright"></i>
							</a>
						</li>
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<li id="header_inbox_bar" class="dropdown dropdown-extended dropdown-inbox">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
					<i class="icon-envelope-open"></i>
					<span class="badge badge-default">
					4 </span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<p>
								 You have 12 new messages
								 <button class="btn btn-info btn-xs pull-right"><i class="fa fa-plus"></i></button>
							</p>
						</li>
						<li>
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="overflow: hidden; width: auto; height: 250px;" class="dropdown-menu-list scroller" data-initialized="1">
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" src="../../assets/admin/layout/img/avatar2.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Lisa Wong </span>
									<span class="time">
									Just Now </span>
									</span>
									<span class="message">
									Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" src="../../assets/admin/layout/img/avatar3.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Richard Doe </span>
									<span class="time">
									16 mins </span>
									</span>
									<span class="message">
									Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" src="../../assets/admin/layout/img/avatar1.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Bob Nilson </span>
									<span class="time">
									2 hrs </span>
									</span>
									<span class="message">
									Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" src="../../assets/admin/layout/img/avatar2.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Lisa Wong </span>
									<span class="time">
									40 mins </span>
									</span>
									<span class="message">
									Vivamus sed auctor 40% nibh congue nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" src="../../assets/admin/layout/img/avatar3.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Richard Doe </span>
									<span class="time">
									46 mins </span>
									</span>
									<span class="message">
									Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
							</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
						</li>
						<li class="external">
							<a href="inbox.html">
							See all messages <i class="m-icon-swapright"></i>
							</a>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
				<!-- BEGIN TODO DROPDOWN -->
				<li id="header_task_bar" class="dropdown dropdown-extended dropdown-tasks">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
					<i class="icon-calendar"></i>
					<span class="badge badge-default">
					3 </span>
					</a>
					<ul class="dropdown-menu extended tasks">
						<li>
							<p>
								 You have 12 pending tasks
								 <button class="btn btn-info btn-xs pull-right"><i class="fa fa-plus"></i></button>
							</p>
						</li>
						<li>
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="overflow: hidden; width: auto; height: 250px;" class="dropdown-menu-list scroller" data-initialized="1">
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									New release v1.2 </span>
									<span class="percent">
									30% </span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-success" style="width: 40%;">
									<span class="sr-only">
									40% Complete </span>
									</span>
									</span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									Application deployment </span>
									<span class="percent">
									65% </span>
									</span>
									<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" class="progress-bar progress-bar-danger" style="width: 65%;">
									<span class="sr-only">
									65% Complete </span>
									</span>
									</span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									Mobile app release </span>
									<span class="percent">
									98% </span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="98" class="progress-bar progress-bar-success" style="width: 98%;">
									<span class="sr-only">
									98% Complete </span>
									</span>
									</span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									Database migration </span>
									<span class="percent">
									10% </span>
									</span>
									<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" class="progress-bar progress-bar-warning" style="width: 10%;">
									<span class="sr-only">
									10% Complete </span>
									</span>
									</span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									Web server upgrade </span>
									<span class="percent">
									58% </span>
									</span>
									<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="58" class="progress-bar progress-bar-info" style="width: 58%;">
									<span class="sr-only">
									58% Complete </span>
									</span>
									</span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									Mobile development </span>
									<span class="percent">
									85% </span>
									</span>
									<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar progress-bar-success" style="width: 85%;">
									<span class="sr-only">
									85% Complete </span>
									</span>
									</span>
									</a>
								</li>
								<li>
									<a href="#">
									<span class="task">
									<span class="desc">
									New UI release </span>
									<span class="percent">
									18% </span>
									</span>
									<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="18" class="progress-bar progress-bar-important" style="width: 18%;">
									<span class="sr-only">
									18% Complete </span>
									</span>
									</span>
									</a>
								</li>
							</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
						</li>
						<li class="external">
							<a href="#">
							See all tasks <i class="m-icon-swapright"></i>
							</a>
						</li>
					</ul>
				</li>
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown dropdown-user">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
					<img src="../../assets/admin/layout/img/avatar3_small.jpg" class="img-circle" alt="">
					<span class="username username-hide-on-mobile">
					Bob </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="extra_profile.html">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-gear"></i> Settings
							</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="login.html">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<li style="display:none" class="dropdown dropdown-quick-sidebar-toggler">
					<a class="dropdown-toggle" href="javascript:;">
					<i class="icon-logout"></i>
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
@stop

@section('body-content')
	@section('innerpage-main-content')
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<div class="page-sidebar-wrapper">
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<div class="page-sidebar navbar-collapse collapse" style="">
					<!-- BEGIN SIDEBAR MENU -->
					<ul data-slide-speed="200" data-auto-scroll="true" class="page-sidebar-menu page-sidebar-menu-light page-sidebar-menu-hover-submenu">
						<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
						<li class="sidebar-toggler-wrapper">
							<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
							<div class="sidebar-toggler">
							</div>
							<!-- END SIDEBAR TOGGLER BUTTON -->
						</li>
						<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
						<li class="sidebar-search-wrapper">
							<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
							<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
							<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
							<form method="POST" action="extra_search.html" class="sidebar-search ">
								<a class="remove" href="javascript:;">
								<i class="icon-close"></i>
								</a>
								<div class="input-group">
									<input type="text" placeholder="Search..." class="form-control">
									<span class="input-group-btn">
									<a class="btn submit" href="javascript:;"><i class="icon-magnifier"></i></a>
									</span>
								</div>
							</form>
							<!-- END RESPONSIVE QUICK SEARCH FORM -->
						</li>
						<li class="start active open">
							<a href="javascript:;">
							<i class="icon-home"></i>
							<span class="title">Dashboard</span>
							<span class="selected"></span>
							<span class="arrow open"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="index.html">
									<i class="icon-bar-chart"></i>
									Default Dashboard</a>
								</li>
								<li>
									<a href="index_2.html">
									<i class="icon-bulb"></i>
									New Dashboard #1</a>
								</li>
								<li class="active">
									<a href="index_3.html">
									<i class="icon-graph"></i>
									New Dashboard #2</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-basket"></i>
							<span class="title">eCommerce</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="ecommerce_index.html">
									<i class="icon-home"></i>
									Dashboard</a>
								</li>
								<li>
									<a href="ecommerce_orders.html">
									<i class="icon-basket"></i>
									Orders</a>
								</li>
								<li>
									<a href="ecommerce_orders_view.html">
									<i class="icon-tag"></i>
									Order View</a>
								</li>
								<li>
									<a href="ecommerce_products.html">
									<i class="icon-handbag"></i>
									Products</a>
								</li>
								<li>
									<a href="ecommerce_products_edit.html">
									<i class="icon-pencil"></i>
									Product Edit</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-rocket"></i>
							<span class="title">Page Layouts</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="layout_horizontal_sidebar_menu.html">
									Horizontal &amp; Sidebar Menu</a>
								</li>
								<li>
									<a href="index_horizontal_menu.html">
									Dashboard &amp; Mega Menu</a>
								</li>
								<li>
									<a href="layout_horizontal_menu1.html">
									Horizontal Mega Menu 1</a>
								</li>
								<li>
									<a href="layout_horizontal_menu2.html">
									Horizontal Mega Menu 2</a>
								</li>
								<li>
									<a href="layout_fontawesome_icons.html">
									<span class="badge badge-roundless badge-danger">new</span>Layout with Fontawesome Icons</a>
								</li>
								<li>
									<a href="layout_glyphicons.html">
									Layout with Glyphicon</a>
								</li>
								<li>
									<a href="layout_full_height_portlet.html">
									<span class="badge badge-roundless badge-success">new</span>Full Height Portlet</a>
								</li>
								<li>
									<a href="layout_full_height_content.html">
									<span class="badge badge-roundless badge-warning">new</span>Full Height Content</a>
								</li>
								<li>
									<a href="layout_search_on_header1.html">
									Search Box On Header 1</a>
								</li>
								<li>
									<a href="layout_search_on_header2.html">
									Search Box On Header 2</a>
								</li>
								<li>
									<a href="layout_sidebar_search_option1.html">
									Sidebar Search Option 1</a>
								</li>
								<li>
									<a href="layout_sidebar_search_option2.html">
									Sidebar Search Option 2</a>
								</li>
								<li>
									<a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-warning">new</span>Right Sidebar Page</a>
								</li>
								<li>
									<a href="layout_sidebar_fixed.html">
									Sidebar Fixed Page</a>
								</li>
								<li>
									<a href="layout_sidebar_closed.html">
									Sidebar Closed Page</a>
								</li>
								<li>
									<a href="layout_ajax.html">
									Content Loading via Ajax</a>
								</li>
								<li>
									<a href="layout_disabled_menu.html">
									Disabled Menu Links</a>
								</li>
								<li>
									<a href="layout_blank_page.html">
									Blank Page</a>
								</li>
								<li>
									<a href="layout_boxed_page.html">
									Boxed Page</a>
								</li>
								<li>
									<a href="layout_language_bar.html">
									Language Switch Bar</a>
								</li>
							</ul>
						</li>
						<!-- BEGIN FRONTEND THEME LINKS -->
						<li>
							<a href="javascript:;">
							<i class="icon-star"></i>
							<span class="title">
							Frontend Themes </span>
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li data-original-title="Complete eCommerce Frontend Theme For Metronic Admin" data-html="true" data-placement="right" data-container="body" class="tooltips">
									<a target="_blank" href="http://keenthemes.com/preview/index.php?theme=metronic_frontend&amp;page=shop-index.html">
									<span class="title">
									eCommerce Frontend </span>
									</a>
								</li>
								<li data-original-title="Complete Corporate Frontend Theme For Metronic Admin" data-html="true" data-placement="right" data-container="body" class="tooltips">
									<a target="_blank" href="http://keenthemes.com/preview/index.php?theme=metronic_frontend">
									<span class="title">
									Corporate Frontend </span>
									</a>
								</li>
								<li data-original-title="Complete One Page Parallax Frontend Theme For Metronic Admin" data-html="true" data-placement="right" data-container="body" class="tooltips">
									<a target="_blank" href="http://keenthemes.com/preview/index.php?theme=metronic_frontend&amp;page=onepage-index.html">
									<span class="title">
									One Page Parallax Frontend </span>
									</a>
								</li>
							</ul>
						</li>
						<!-- END FRONTEND THEME LINKS -->
						<li>
							<a href="javascript:;">
							<i class="icon-diamond"></i>
							<span class="title">UI Features</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="ui_general.html">
									General Components</a>
								</li>
								<li>
									<a href="ui_buttons.html">
									Buttons</a>
								</li>
								<li>
									<a href="ui_icons.html">
									<span class="badge badge-roundless badge-danger">new</span>Font Icons</a>
								</li>
								<li>
									<a href="ui_colors.html">
									Flat UI Colors</a>
								</li>
								<li>
									<a href="ui_typography.html">
									Typography</a>
								</li>
								<li>
									<a href="ui_tabs_accordions_navs.html">
									Tabs, Accordions &amp; Navs</a>
								</li>
								<li>
									<a href="ui_tree.html">
									<span class="badge badge-roundless badge-danger">new</span>Tree View</a>
								</li>
								<li>
									<a href="ui_page_progress_style_1.html">
									<span class="badge badge-roundless badge-warning">new</span>Page Progress Bar</a>
								</li>
								<li>
									<a href="ui_blockui.html">
									Block UI</a>
								</li>
								<li>
									<a href="ui_notific8.html">
									Notific8 Notifications</a>
								</li>
								<li>
									<a href="ui_toastr.html">
									Toastr Notifications</a>
								</li>
								<li>
									<a href="ui_alert_dialog_api.html">
									<span class="badge badge-roundless badge-danger">new</span>Alerts &amp; Dialogs API</a>
								</li>
								<li>
									<a href="ui_session_timeout.html">
									Session Timeout</a>
								</li>
								<li>
									<a href="ui_idle_timeout.html">
									User Idle Timeout</a>
								</li>
								<li>
									<a href="ui_modals.html">
									Modals</a>
								</li>
								<li>
									<a href="ui_extended_modals.html">
									Extended Modals</a>
								</li>
								<li>
									<a href="ui_tiles.html">
									Tiles</a>
								</li>
								<li>
									<a href="ui_datepaginator.html">
									<span class="badge badge-roundless badge-success">new</span>Date Paginator</a>
								</li>
								<li>
									<a href="ui_nestable.html">
									Nestable List</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-puzzle"></i>
							<span class="title">UI Components</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="components_pickers.html">
									Pickers</a>
								</li>
								<li>
									<a href="components_dropdowns.html">
									Custom Dropdowns</a>
								</li>
								<li>
									<a href="components_form_tools.html">
									Form Tools</a>
								</li>
								<li>
									<a href="components_editors.html">
									Markdown &amp; WYSIWYG Editors</a>
								</li>
								<li>
									<a href="components_ion_sliders.html">
									Ion Range Sliders</a>
								</li>
								<li>
									<a href="components_noui_sliders.html">
									NoUI Range Sliders</a>
								</li>
								<li>
									<a href="components_jqueryui_sliders.html">
									jQuery UI Sliders</a>
								</li>
								<li>
									<a href="components_knob_dials.html">
									Knob Circle Dials</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-settings"></i>
							<span class="title">Form Stuff</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="form_controls.html">
									Form Controls</a>
								</li>
								<li>
									<a href="form_layouts.html">
									Form Layouts</a>
								</li>
								<li>
									<a href="form_editable.html">
									<span class="badge badge-roundless badge-warning">new</span>Form X-editable</a>
								</li>
								<li>
									<a href="form_wizard.html">
									Form Wizard</a>
								</li>
								<li>
									<a href="form_validation.html">
									Form Validation</a>
								</li>
								<li>
									<a href="form_image_crop.html">
									<span class="badge badge-roundless badge-danger">new</span>Image Cropping</a>
								</li>
								<li>
									<a href="form_fileupload.html">
									Multiple File Upload</a>
								</li>
								<li>
									<a href="form_dropzone.html">
									Dropzone File Upload</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-logout"></i>
							<span class="title">Quick Sidebar</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">

								<li>
									<a href="quick_sidebar_push_content.html">
									Push Content</a>
								</li>
								<li>
									<a href="quick_sidebar_over_content.html">
									Over Content</a>
								</li>
								<li>
									<a href="quick_sidebar_over_content_transparent.html">
									Over Content &amp; Transparent</a>
								</li>
								<li>
									<a href="quick_sidebar_on_boxed_layout.html">
									Boxed Layout</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-envelope-open"></i>
							<span class="title">Email Templates</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="email_newsletter.html">
									Responsive Newsletter<br>
									 Email Template</a>
								</li>
								<li>
									<a href="email_system.html">
									Responsive System<br>
									 Email Template</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-docs"></i>
							<span class="title">Pages</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="page_portfolio.html">
									<i class="icon-feed"></i>
									<span class="badge badge-warning badge-roundless">new</span>Portfolio</a>
								</li>
								<li>
									<a href="page_timeline.html">
									<i class="icon-clock"></i>
									<span class="badge badge-info">4</span>Timeline</a>
								</li>
								<li>
									<a href="page_coming_soon.html">
									<i class="icon-flag"></i>
									Coming Soon</a>
								</li>
								<li>
									<a href="page_blog.html">
									<i class="icon-speech"></i>
									Blog</a>
								</li>
								<li>
									<a href="page_blog_item.html">
									<i class="icon-link"></i>
									Blog Post</a>
								</li>
								<li>
									<a href="page_news.html">
									<i class="icon-eye"></i>
									<span class="badge badge-success">9</span>News</a>
								</li>
								<li>
									<a href="page_news_item.html">
									<i class="icon-bell"></i>
									News View</a>
								</li>
								<li>
									<a href="page_about.html">
									<i class="icon-users"></i>
									About Us</a>
								</li>
								<li>
									<a href="page_contact.html">
									<i class="icon-envelope-open"></i>
									Contact Us</a>
								</li>
								<li>
									<a href="page_calendar.html">
									<i class="icon-calendar"></i>
									<span class="badge badge-danger">14</span>Calendar</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-present"></i>
							<span class="title">Extra</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="extra_profile.html">
									User Profile</a>
								</li>
								<li>
									<a href="extra_lock.html">
									Lock Screen</a>
								</li>
								<li>
									<a href="extra_faq.html">
									FAQ</a>
								</li>
								<li>
									<a href="inbox.html">
									<span class="badge badge-danger">4</span>Inbox</a>
								</li>
								<li>
									<a href="extra_search.html">
									Search Results</a>
								</li>
								<li>
									<a href="extra_invoice.html">
									Invoice</a>
								</li>
								<li>
									<a href="extra_pricing_table.html">
									Pricing Tables</a>
								</li>
								<li>
									<a href="extra_404_option1.html">
									404 Page Option 1</a>
								</li>
								<li>
									<a href="extra_404_option2.html">
									404 Page Option 2</a>
								</li>
								<li>
									<a href="extra_404_option3.html">
									404 Page Option 3</a>
								</li>
								<li>
									<a href="extra_500_option1.html">
									500 Page Option 1</a>
								</li>
								<li>
									<a href="extra_500_option2.html">
									500 Page Option 2</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-folder"></i>
							<span class="title">Multi Level Menu</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="icon-settings"></i> Item 1 <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="javascript:;">
											<i class="icon-user"></i>
											Sample Link 1 <span class="arrow"></span>
											</a>
											<ul class="sub-menu">
												<li>
													<a href="#"><i class="icon-power"></i> Sample Link 1</a>
												</li>
												<li>
													<a href="#"><i class="icon-paper-plane"></i> Sample Link 1</a>
												</li>
												<li>
													<a href="#"><i class="icon-star"></i> Sample Link 1</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="#"><i class="icon-camera"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="icon-link"></i> Sample Link 2</a>
										</li>
										<li>
											<a href="#"><i class="icon-pointer"></i> Sample Link 3</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="javascript:;">
									<i class="icon-globe"></i> Item 2 <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#"><i class="icon-tag"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="icon-pencil"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="icon-graph"></i> Sample Link 1</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">
									<i class="icon-bar-chart"></i>
									Item 3 </a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-user"></i>
							<span class="title">Login Options</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="login.html">
									Login Form 1</a>
								</li>
								<li>
									<a href="login_soft.html">
									Login Form 2</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-briefcase"></i>
							<span class="title">Data Tables</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="table_basic.html">
									Basic Datatables</a>
								</li>
								<li>
									<a href="table_responsive.html">
									Responsive Datatables</a>
								</li>
								<li>
									<a href="table_managed.html">
									Managed Datatables</a>
								</li>
								<li>
									<a href="table_editable.html">
									Editable Datatables</a>
								</li>
								<li>
									<a href="table_advanced.html">
									Advanced Datatables</a>
								</li>
								<li>
									<a href="table_ajax.html">
									Ajax Datatables</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-wallet"></i>
							<span class="title">Portlets</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="portlet_general.html">
									General Portlets</a>
								</li>
								<li>
									<a href="portlet_general2.html">
									<span class="badge badge-roundless badge-danger">new</span>New Portlets #1</a>
								</li>
								<li>
									<a href="portlet_general3.html">
									<span class="badge badge-roundless badge-danger">new</span>New Portlets #2</a>
								</li>
								<li>
									<a href="portlet_ajax.html">
									Ajax Portlets</a>
								</li>
								<li>
									<a href="portlet_draggable.html">
									Draggable Portlets</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="icon-pointer"></i>
							<span class="title">Maps</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="maps_google.html">
									Google Maps</a>
								</li>
								<li>
									<a href="maps_vector.html">
									Vector Maps</a>
								</li>
							</ul>
						</li>
						<li class="last ">
							<a href="charts.html">
							<i class="icon-bar-chart"></i>
							<span class="title">Visual Charts</span>
							</a>
						</li>
					</ul>
					<!-- END SIDEBAR MENU -->
				</div>
			</div>
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content" style="min-height:330px">
					<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
					<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="portlet-config" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
									<h4 class="modal-title">Modal title</h4>
								</div>
								<div class="modal-body">
									 Widget settings form goes here
								</div>
								<div class="modal-footer">
									<button class="btn blue" type="button">Save changes</button>
									<button data-dismiss="modal" class="btn default" type="button">Close</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
					<!-- BEGIN STYLE CUSTOMIZER -->
					<div style="display:none" class="theme-panel hidden-xs hidden-sm">
						<div class="toggler">
						</div>
						<div class="toggler-close">
						</div>
						<div class="theme-options">
							<div class="theme-option theme-colors clearfix">
								<span>
								THEME COLOR </span>
								<ul>
									<li data-original-title="Default" data-container="body" data-style="default" class="color-default current tooltips">
									</li>
									<li data-original-title="Dark Blue" data-container="body" data-style="darkblue" class="color-darkblue tooltips">
									</li>
									<li data-original-title="Blue" data-container="body" data-style="blue" class="color-blue tooltips">
									</li>
									<li data-original-title="Grey" data-container="body" data-style="grey" class="color-grey tooltips">
									</li>
									<li data-original-title="Light" data-container="body" data-style="light" class="color-light tooltips">
									</li>
									<li data-original-title="Light 2" data-html="true" data-container="body" data-style="light2" class="color-light2 tooltips">
									</li>
								</ul>
							</div>
							<div class="theme-option">
								<span>
								Layout </span>
								<select class="layout-option form-control input-small">
									<option selected="selected" value="fluid">Fluid</option>
									<option value="boxed">Boxed</option>
								</select>
							</div>
							<div class="theme-option">
								<span>
								Header </span>
								<select class="page-header-option form-control input-small">
									<option selected="selected" value="fixed">Fixed</option>
									<option value="default">Default</option>
								</select>
							</div>
							<div class="theme-option">
								<span>
								Sidebar Mode</span>
								<select class="sidebar-option form-control input-small">
									<option value="fixed">Fixed</option>
									<option selected="selected" value="default">Default</option>
								</select>
							</div>
							<div class="theme-option">
								<span>
								Sidebar Menu </span>
								<select class="sidebar-menu-option form-control input-small">
									<option selected="selected" value="accordion">Accordion</option>
									<option value="hover">Hover</option>
								</select>
							</div>
							<div class="theme-option">
								<span>
								Sidebar Style </span>
								<select class="sidebar-style-option form-control input-small">
									<option selected="selected" value="default">Default</option>
									<option value="light">Light</option>
								</select>
							</div>
							<div class="theme-option">
								<span>
								Sidebar Position </span>
								<select class="sidebar-pos-option form-control input-small">
									<option selected="selected" value="left">Left</option>
									<option value="right">Right</option>
								</select>
							</div>
							<div class="theme-option">
								<span>
								Footer </span>
								<select class="page-footer-option form-control input-small">
									<option value="fixed">Fixed</option>
									<option selected="selected" value="default">Default</option>
								</select>
							</div>
						</div>
					</div>
					<!-- END STYLE CUSTOMIZER -->
					<!-- BEGIN PAGE HEADER-->
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-user"></i>
								<a href="index.html">Andrew Manifield</a>
								<!-- <i class="fa fa-angle-right"></i> -->
							</li>
							<li>
								<i class="fa fa-user"></i>
								<a href="#">Richard Joseph Porter</a>
								<!-- <i class="fa fa-angle-right"></i> -->
							</li>
							<li>
								<i class="fa fa-user"></i>
								<a href="#">Steve Warden</a>
							</li>
						</ul>
						<div style="width:20%" class="page-toolbar">
							<div class="pull-right">
								<div class="input-group">
									<input type="text" placeholder="Search" class="form-control">
									<span class="input-group-btn">
									<button type="button" class="btn blue"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<h3 class="page-title">
					Dashboard <small>dashboard &amp; statistics</small>
					</h3>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
		<div class="row">
		  <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12"><div class="row">
		<div class="col-md-12 col-sm-12">
							<div class="portlet light tasks-widget">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-share font-green-haze hide"></i>
										<span class="caption-subject font-green-haze bold uppercase">Tasks</span>
										<span class="caption-helper">tasks summary...</span>
									</div>
									<div class="actions">
										<div class="btn-group">
											<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn green-haze btn-circle btn-sm">
											More <i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="#">
													<i class="i"></i> All Project </a>
												</li>
												<li class="divider">
												</li>
												<li>
													<a href="#">
													AirAsia </a>
												</li>
												<li>
													<a href="#">
													Cruise </a>
												</li>
												<li>
													<a href="#">
													HSBC </a>
												</li>
												<li class="divider">
												</li>
												<li>
													<a href="#">
													Pending <span class="badge badge-danger">
													4 </span>
													</a>
												</li>
												<li>
													<a href="#">
													Completed <span class="badge badge-success">
													12 </span>
													</a>
												</li>
												<li>
													<a href="#">
													Overdue <span class="badge badge-warning">
													9 </span>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="task-content">
										<div style="position: relative; overflow: hidden; width: auto; height: 305px;" class="slimScrollDiv"><div data-initialized="1" data-rail-visible1="1" data-always-visible="1" style="overflow: hidden; width: auto; height: 305px;" class="scroller">
											<!-- START TASK LIST -->
											<ul class="task-list">
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Present 2013 Year IPO Statistics at Board Meeting </span>
														<span class="label label-sm label-success">Company</span>
														<span class="task-bell">
														<i class="fa fa-bell-o"></i>
														</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Hold An Interview for Marketing Manager Position </span>
														<span class="label label-sm label-danger">Marketing</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														AirAsia Intranet System Project Internal Meeting </span>
														<span class="label label-sm label-success">AirAsia</span>
														<span class="task-bell">
														<i class="fa fa-bell-o"></i>
														</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Technical Management Meeting </span>
														<span class="label label-sm label-warning">Company</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Kick-off Company CRM Mobile App Development </span>
														<span class="label label-sm label-info">Internal Products</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Prepare Commercial Offer For SmartVision Website Rewamp </span>
														<span class="label label-sm label-danger">SmartVision</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Sign-Off The Comercial Agreement With AutoSmart </span>
														<span class="label label-sm label-default">AutoSmart</span>
														<span class="task-bell">
														<i class="fa fa-bell-o"></i>
														</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li>
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														Company Staff Meeting </span>
														<span class="label label-sm label-success">Cruise</span>
														<span class="task-bell">
														<i class="fa fa-bell-o"></i>
														</span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
												<li class="last-line">
													<div class="task-checkbox">
														<div class="checker"><span><input type="checkbox" value="" class="liChild"></span></div>
													</div>
													<div class="task-title">
														<span class="task-title-sp">
														KeenThemes Investment Discussion </span>
														<span class="label label-sm label-warning">KeenThemes </span>
													</div>
													<div class="task-config">
														<div class="task-config-btn btn-group">
															<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a href="#">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a href="#">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												</li>
											</ul>
											<!-- END START TASK LIST -->
										</div><div style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 265.7857142857143px; display: block; background: rgb(187, 187, 187);" class="slimScrollBar"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);" class="slimScrollRail"></div></div>
									</div>
									<div class="task-footer">
										<div class="btn-arrow-link pull-right">
											<a href="#">See All Records</a>
											<i class="icon-arrow-right"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
			</div><div class="row"><div class="col-md-12 col-sm-12">
							<!-- BEGIN PORTLET-->
							<div class="portlet light">
								<div class="portlet-title tabbable-line">
									<div class="caption">
										<i class="icon-globe font-green-sharp"></i>
										<span class="caption-subject font-green-sharp bold uppercase">Feeds</span>
									</div>
									<ul class="nav nav-tabs">
										<li class="active">
											<a data-toggle="tab" href="#tab_1_1">
											<i class="fa fa-facebook"></i> Facebook </a>
										</li>
										<li class="">
											<a data-toggle="tab" href="#tab_1_2">
											<i class="fa fa-twitter"></i> Twitter </a>
										</li>
										<li class="">
											<a data-toggle="tab" href="#tab_1_3">
											<i class="fa fa-linkedin"></i> Linkedin </a>
										</li>
									</ul>
								</div>
								<div class="portlet-body tabbable-line">
									<!--BEGIN TABS-->
									<div class="tab-content">
										<div id="tab_1_1" class="tab-pane active">
											<div style="position: relative; overflow: hidden; width: auto; height: 339px;" class="slimScrollDiv"><div data-initialized="1" data-rail-visible="0" data-always-visible="1" style="overflow: hidden; width: auto; height: 339px;" class="scroller">
												<ul class="feeds">
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 You have 4 pending tasks. <span class="label label-sm label-info">
																		Take action <i class="fa fa-share"></i>
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New version v1.4 just lunched!
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 20 mins
															</div>
														</div>
														</a>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-danger">
																		<i class="fa fa-bolt"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 Database server #12 overloaded. Please fix the issue.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 24 mins
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-info">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 30 mins
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 40 mins
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-warning">
																		<i class="fa fa-plus"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 1.5 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
																		Overdue </span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 2 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-default">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 3 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-warning">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 5 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-info">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 18 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-default">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 21 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-info">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 22 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-default">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 21 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-info">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 22 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-default">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 21 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-info">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 22 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-default">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 21 hours
															</div>
														</div>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-info">
																		<i class="fa fa-bullhorn"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received. Please take care of it.
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 22 hours
															</div>
														</div>
													</li>
												</ul>
											</div><div style="width: 7px; position: absolute; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; top: 149px; height: 189.95206611570245px; display: block; background: rgb(187, 187, 187);" class="slimScrollBar"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);" class="slimScrollRail"></div></div>
										</div>
										<div id="tab_1_2" class="tab-pane">
											<div style="position: relative; overflow: hidden; width: auto; height: 290px;" class="slimScrollDiv"><div data-initialized="1" data-rail-visible1="1" data-always-visible="1" style="overflow: hidden; width: auto; height: 290px;" class="scroller">
												<ul class="feeds">
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 10 mins
															</div>
														</div>
														</a>
													</li>
													<li>
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-danger">
																		<i class="fa fa-bolt"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 Order #24DOP4 has been rejected. <span class="label label-sm label-danger ">
																		Take action <i class="fa fa-share"></i>
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 24 mins
															</div>
														</div>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
													<li>
														<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
														</a>
													</li>
												</ul>
											</div><div style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; display: block; background: rgb(187, 187, 187);" class="slimScrollBar"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);" class="slimScrollRail"></div></div>
										</div>
										<div id="tab_1_3" class="tab-pane">
											<div style="position: relative; overflow: hidden; width: auto; height: 290px;" class="slimScrollDiv"><div data-initialized="1" data-rail-visible1="1" data-always-visible="1" style="overflow: hidden; width: auto; height: 290px;" class="scroller">
												<div class="row">
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Robert Nilson </a>
																<span class="label label-sm label-success label-mini">
																Approved </span>
															</div>
															<div>
																 29 Jan 2013 10:45AM
															</div>
														</div>
													</div>
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Lisa Miller </a>
																<span class="label label-sm label-info">
																Pending </span>
															</div>
															<div>
																 19 Jan 2013 10:45AM
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Eric Kim </a>
																<span class="label label-sm label-info">
																Pending </span>
															</div>
															<div>
																 19 Jan 2013 12:45PM
															</div>
														</div>
													</div>
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Lisa Miller </a>
																<span class="label label-sm label-danger">
																In progress </span>
															</div>
															<div>
																 19 Jan 2013 11:55PM
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Eric Kim </a>
																<span class="label label-sm label-info">
																Pending </span>
															</div>
															<div>
																 19 Jan 2013 12:45PM
															</div>
														</div>
													</div>
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Lisa Miller </a>
																<span class="label label-sm label-danger">
																In progress </span>
															</div>
															<div>
																 19 Jan 2013 11:55PM
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Eric Kim </a>
																<span class="label label-sm label-info">
																Pending </span>
															</div>
															<div>
																 19 Jan 2013 12:45PM
															</div>
														</div>
													</div>
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Lisa Miller </a>
																<span class="label label-sm label-danger">
																In progress </span>
															</div>
															<div>
																 19 Jan 2013 11:55PM
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Eric Kim </a>
																<span class="label label-sm label-info">
																Pending </span>
															</div>
															<div>
																 19 Jan 2013 12:45PM
															</div>
														</div>
													</div>
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Lisa Miller </a>
																<span class="label label-sm label-danger">
																In progress </span>
															</div>
															<div>
																 19 Jan 2013 11:55PM
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Eric Kim </a>
																<span class="label label-sm label-info">
																Pending </span>
															</div>
															<div>
																 19 Jan 2013 12:45PM
															</div>
														</div>
													</div>
													<div class="col-md-6 user-info">
														<img class="img-responsive" src="../../assets/admin/layout/img/avatar.png" alt="">
														<div class="details">
															<div>
																<a href="#">
																Lisa Miller </a>
																<span class="label label-sm label-danger">
																In progress </span>
															</div>
															<div>
																 19 Jan 2013 11:55PM
															</div>
														</div>
													</div>
												</div>
											</div><div style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 219.01041666666669px; display: block; background: rgb(187, 187, 187);" class="slimScrollBar"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);" class="slimScrollRail"></div></div>
										</div>
									</div>
									<!--END TABS-->
								</div>
							</div>
							<!-- END PORTLET-->
						</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet solid grey-cararra bordered">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bullhorn"></i>Sales
							</div>
							<div class="actions">
								<div class="btn-group pull-right">
									<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="btn grey-steel btn-sm dropdown-toggle" href="">
									Filter <span class="fa fa-angle-down">
									</span>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="javascript:;">
											Q1 2014 <span class="label label-sm label-default">
											past </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											Q2 2014 <span class="label label-sm label-default">
											past </span>
											</a>
										</li>
										<li class="active">
											<a href="javascript:;">
											Q3 2014 <span class="label label-sm label-success">
											current </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											Q4 2014 <span class="label label-sm label-warning">
											upcoming </span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div id="site_activities_loading" style="display: none;">
								<img alt="loading" src="../../assets/admin/layout/img/loading.gif">
							</div>
							<div class="display-none" id="site_activities_content" style="display: block;">
								<div style="height: 228px; padding: 0px; position: relative;" id="site_activities">
								<canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 654px; height: 228px;" width="654" height="228"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 21px; text-align: center;">DEC</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 90px; text-align: center;">JAN</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 158px; text-align: center;">FEB</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 224px; text-align: center;">MAR</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 293px; text-align: center;">APR</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 360px; text-align: center;">MAY</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 430px; text-align: center;">JUN</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 499px; text-align: center;">JUL</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 565px; text-align: center;">AUG</div><div style="position: absolute; max-width: 65px; font: small-caps 400 10px/18px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 209px; left: 635px; text-align: center;">SEP</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; font: small-caps 400 10px/14px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 197px; left: 19px; text-align: right;">0</div><div style="position: absolute; font: small-caps 400 10px/14px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 149px; left: 7px; text-align: right;">500</div><div style="position: absolute; font: small-caps 400 10px/14px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 100px; left: 1px; text-align: right;">1000</div><div style="position: absolute; font: small-caps 400 10px/14px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 52px; left: 1px; text-align: right;">1500</div><div style="position: absolute; font: small-caps 400 10px/14px &quot;Open Sans&quot;,sans-serif; color: rgb(111, 123, 138); top: 3px; left: 1px; text-align: right;">2000</div></div></div><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 654px; height: 228px;" width="654" height="228"></canvas></div>
							</div>
							<div style="margin: 20px 0 10px 30px">
								<div class="row">
									<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-success">
										Something 1: </span>
										<h3>$13,234</h3>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-info">
										Something 2: </span>
										<h3>$134,900</h3>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-danger">
										Something 3: </span>
										<h3>$1,134</h3>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-warning">
										Something 4: </span>
										<h3>235090</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>

		</div>


		</div>
		  <div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
		<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="dashboard-stat blue-madison">
								<div class="visual">
									<i class="fa fa-gbp"></i>
								</div>
								<div class="details">
									<div class="number">
										 £5,432.10
									</div>
									<div class="desc">
										 Sales Month To Date
									</div>
								</div>
								<a href="#" class="more">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="dashboard-stat red-intense">
								<div class="visual">
									<i class="fa fa-bar-chart-o"></i>
								</div>
								<div class="details">
									<div class="number">
										 30.25%
									</div>
									<div class="desc">
										 Conversion Month To Date
									</div>
								</div>
								<a href="#" class="more">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="dashboard-stat green-haze">
								<div class="visual">
									<i class="fa fa-gbp"></i>
								</div>
								<div class="details">
									<div class="number">
										 £545.50
									</div>
									<div class="desc">
										 Pipeline Total Value
									</div>
								</div>
								<a href="#" class="more">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="dashboard-stat purple-plum">
								<div class="visual">
									<i class="fa fa-gbp"></i>
								</div>
								<div class="details">
									<div class="number">
										 £350.25
									</div>
									<div class="desc">
										 Pipeline Expected Value
									</div>
								</div>
								<a href="#" class="more">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
					</div><div class="row">
		<div class="col-md-12 col-sm-12">
							<div class="portlet light ">
								<div class="portlet-title">
									<div class="caption">
										<i class="icon-share font-blue-steel hide"></i>
										<span class="caption-subject font-blue-steel bold uppercase">Recent Activities</span>
									</div>
									<div class="actions">
										<div class="btn-group">
											<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-sm btn-default btn-circle">
											Filter By <i class="fa fa-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><div class="checker"><span><input type="checkbox"></span></div> Finance</label>
												<label><div class="checker"><span class="checked"><input type="checkbox" checked=""></span></div> Membership</label>
												<label><div class="checker"><span><input type="checkbox"></span></div> Customer Support</label>
												<label><div class="checker"><span class="checked"><input type="checkbox" checked=""></span></div> HR</label>
												<label><div class="checker"><span><input type="checkbox"></span></div> System</label>
											</div>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div style="position: relative; overflow: hidden; width: auto; height: 300px;" class="slimScrollDiv"><div data-initialized="1" data-rail-visible="0" data-always-visible="1" style="overflow: hidden; width: auto; height: 300px;" class="scroller">
										<ul class="feeds">
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-info">
																<i class="fa fa-check"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 You have 4 pending tasks. <span class="label label-sm label-warning ">
																Take action <i class="fa fa-share"></i>
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 Just now
													</div>
												</div>
											</li>
											<li>
												<a href="#">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bar-chart-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 Finance Report for year 2013 has been released.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 20 mins
													</div>
												</div>
												</a>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-danger">
																<i class="fa fa-user"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 You have 5 pending membership that requires a quick review.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 24 mins
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-info">
																<i class="fa fa-shopping-cart"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 New order received with <span class="label label-sm label-success">
																Reference Number: DR23923 </span>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 30 mins
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-user"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 You have 5 pending membership that requires a quick review.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 24 mins
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-default">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
																Overdue </span>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 2 hours
													</div>
												</div>
											</li>
											<li>
												<a href="#">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-default">
																<i class="fa fa-briefcase"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 IPO Report for year 2013 has been released.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 20 mins
													</div>
												</div>
												</a>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-info">
																<i class="fa fa-check"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 You have 4 pending tasks. <span class="label label-sm label-warning ">
																Take action <i class="fa fa-share"></i>
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 Just now
													</div>
												</div>
											</li>
											<li>
												<a href="#">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-danger">
																<i class="fa fa-bar-chart-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 Finance Report for year 2013 has been released.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 20 mins
													</div>
												</div>
												</a>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-default">
																<i class="fa fa-user"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 You have 5 pending membership that requires a quick review.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 24 mins
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-info">
																<i class="fa fa-shopping-cart"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 New order received with <span class="label label-sm label-success">
																Reference Number: DR23923 </span>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 30 mins
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-user"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 You have 5 pending membership that requires a quick review.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 24 mins
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-warning">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
																Overdue </span>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 2 hours
													</div>
												</div>
											</li>
											<li>
												<a href="#">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-info">
																<i class="fa fa-briefcase"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																 IPO Report for year 2013 has been released.
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 20 mins
													</div>
												</div>
												</a>
											</li>
										</ul>
									</div><div style="width: 7px; position: absolute; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; top: 0px; height: 191.89765458422175px; display: block; background: rgb(187, 187, 187);" class="slimScrollBar"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);" class="slimScrollRail"></div></div>
									<div class="scroller-footer">
										<div class="btn-arrow-link pull-right">
											<a href="#">See All Records</a>
											<i class="icon-arrow-right"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
		</div><div class="row"><div class="col-md-12 col-sm-12">
							<!-- BEGIN PORTLET-->
							<div class="portlet box blue-madison calendar">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-calendar"></i>Calendar
									</div>
								</div>
								<div class="portlet-body light-grey">
									<div id="calendar" class="fc fc-ltr"><table style="width:100%" class="fc-header"><tbody><tr><td class="fc-header-left"><span class="fc-header-title"><h2>September 2014</h2></span></td><td class="fc-header-center"></td><td class="fc-header-right"><span class="fc-button fc-button-prev fc-state-default fc-corner-left" unselectable="on" style="-moz-user-select: none;"><span class="fc-text-arrow">‹</span></span><span class="fc-button fc-button-next fc-state-default" unselectable="on" style="-moz-user-select: none;"><span class="fc-text-arrow">›</span></span><span class="fc-button fc-button-today fc-state-default fc-state-disabled" unselectable="on" style="-moz-user-select: none;">today</span><span class="fc-button fc-button-month fc-state-default fc-state-active" unselectable="on" style="-moz-user-select: none;">month</span><span class="fc-button fc-button-agendaWeek fc-state-default" unselectable="on" style="-moz-user-select: none;">week</span><span class="fc-button fc-button-agendaDay fc-state-default fc-corner-right" unselectable="on" style="-moz-user-select: none;">day</span></td></tr></tbody></table><div style="position: relative;" class="fc-content"><div style="position: relative; -moz-user-select: none;" class="fc-view fc-view-month fc-grid" unselectable="on"><div style="position:absolute;z-index:8;top:0;left:0" class="fc-event-container"><div style="position: absolute; left: 92px; background-color: rgb(248, 203, 0); width: 84px; top: 41.1334px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-title">All Day Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div style="position: absolute; left: 3px; background-color: rgb(137, 196, 244); width: 351px; top: 115.133px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-title">Long Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div style="position: absolute; left: 181px; background-color: rgb(243, 86, 93); width: 84px; top: 135.133px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-time">4p</span><span class="fc-event-title">Repeating Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div style="position: absolute; left: 181px; background-color: rgb(27, 188, 155); width: 84px; top: 214.7px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-time">4p</span><span class="fc-event-title">Repeating Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div style="position: absolute; left: 448px; width: 84px; top: 115.133px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-time">10:30a</span><span class="fc-event-title">Meeting</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div style="position: absolute; left: 448px; background-color: rgb(149, 165, 166); width: 84px; top: 153.133px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-time">12p</span><span class="fc-event-title">Lunch</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div style="position: absolute; left: 537px; background-color: rgb(155, 89, 182); width: 84px; top: 115.133px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end"><div class="fc-event-inner"><span class="fc-event-time">7p</span><span class="fc-event-title">Birthday Party</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><a style="position: absolute; left: 3px; background-color: rgb(248, 203, 0); width: 173px; top: 367.267px;" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" href="http://google.com/"><div class="fc-event-inner"><span class="fc-event-title">Click for Google</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></a></div><table cellspacing="0" style="width:100%" class="fc-border-separate"><thead><tr class="fc-first fc-last"><th class="fc-day-header fc-sun fc-widget-header fc-first" style="width: 89px;">Sun</th><th class="fc-day-header fc-mon fc-widget-header" style="width: 89px;">Mon</th><th class="fc-day-header fc-tue fc-widget-header" style="width: 89px;">Tue</th><th class="fc-day-header fc-wed fc-widget-header" style="width: 89px;">Wed</th><th class="fc-day-header fc-thu fc-widget-header" style="width: 89px;">Thu</th><th class="fc-day-header fc-fri fc-widget-header" style="width: 89px;">Fri</th><th class="fc-day-header fc-sat fc-widget-header fc-last">Sat</th></tr></thead><tbody><tr class="fc-week fc-first"><td data-date="2014-08-31" class="fc-day fc-sun fc-widget-content fc-other-month fc-past fc-first"><div style="min-height: 73px;"><div class="fc-day-number">31</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-01" class="fc-day fc-mon fc-widget-content fc-past"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-02" class="fc-day fc-tue fc-widget-content fc-past"><div><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-03" class="fc-day fc-wed fc-widget-content fc-past"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-04" class="fc-day fc-thu fc-widget-content fc-past"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-05" class="fc-day fc-fri fc-widget-content fc-past"><div><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-06" class="fc-day fc-sat fc-widget-content fc-past fc-last"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td data-date="2014-09-07" class="fc-day fc-sun fc-widget-content fc-past fc-first"><div style="min-height: 72px;"><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td><td data-date="2014-09-08" class="fc-day fc-mon fc-widget-content fc-past"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td><td data-date="2014-09-09" class="fc-day fc-tue fc-widget-content fc-past"><div><div class="fc-day-number">9</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td><td data-date="2014-09-10" class="fc-day fc-wed fc-widget-content fc-past"><div><div class="fc-day-number">10</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td><td data-date="2014-09-11" class="fc-day fc-thu fc-widget-content fc-past"><div><div class="fc-day-number">11</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td><td data-date="2014-09-12" class="fc-day fc-fri fc-widget-content fc-today fc-state-highlight"><div><div class="fc-day-number">12</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td><td data-date="2014-09-13" class="fc-day fc-sat fc-widget-content fc-future fc-last"><div><div class="fc-day-number">13</div><div class="fc-day-content"><div style="position: relative; height: 77px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td data-date="2014-09-14" class="fc-day fc-sun fc-widget-content fc-future fc-first"><div style="min-height: 72px;"><div class="fc-day-number">14</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td><td data-date="2014-09-15" class="fc-day fc-mon fc-widget-content fc-future"><div><div class="fc-day-number">15</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td><td data-date="2014-09-16" class="fc-day fc-tue fc-widget-content fc-future"><div><div class="fc-day-number">16</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td><td data-date="2014-09-17" class="fc-day fc-wed fc-widget-content fc-future"><div><div class="fc-day-number">17</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td><td data-date="2014-09-18" class="fc-day fc-thu fc-widget-content fc-future"><div><div class="fc-day-number">18</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td><td data-date="2014-09-19" class="fc-day fc-fri fc-widget-content fc-future"><div><div class="fc-day-number">19</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td><td data-date="2014-09-20" class="fc-day fc-sat fc-widget-content fc-future fc-last"><div><div class="fc-day-number">20</div><div class="fc-day-content"><div style="position: relative; height: 57px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td data-date="2014-09-21" class="fc-day fc-sun fc-widget-content fc-future fc-first"><div style="min-height: 72px;"><div class="fc-day-number">21</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-09-22" class="fc-day fc-mon fc-widget-content fc-future"><div><div class="fc-day-number">22</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-09-23" class="fc-day fc-tue fc-widget-content fc-future"><div><div class="fc-day-number">23</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-09-24" class="fc-day fc-wed fc-widget-content fc-future"><div><div class="fc-day-number">24</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-09-25" class="fc-day fc-thu fc-widget-content fc-future"><div><div class="fc-day-number">25</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-09-26" class="fc-day fc-fri fc-widget-content fc-future"><div><div class="fc-day-number">26</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-09-27" class="fc-day fc-sat fc-widget-content fc-future fc-last"><div><div class="fc-day-number">27</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td data-date="2014-09-28" class="fc-day fc-sun fc-widget-content fc-future fc-first"><div style="min-height: 72px;"><div class="fc-day-number">28</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-29" class="fc-day fc-mon fc-widget-content fc-future"><div><div class="fc-day-number">29</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-09-30" class="fc-day fc-tue fc-widget-content fc-future"><div><div class="fc-day-number">30</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-10-01" class="fc-day fc-wed fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-10-02" class="fc-day fc-thu fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-10-03" class="fc-day fc-fri fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td><td data-date="2014-10-04" class="fc-day fc-sat fc-widget-content fc-other-month fc-future fc-last"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position: relative; height: 20px;">&nbsp;</div></div></div></td></tr><tr class="fc-week fc-last"><td data-date="2014-10-05" class="fc-day fc-sun fc-widget-content fc-other-month fc-future fc-first"><div style="min-height: 74px;"><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-10-06" class="fc-day fc-mon fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-10-07" class="fc-day fc-tue fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-10-08" class="fc-day fc-wed fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-10-09" class="fc-day fc-thu fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">9</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-10-10" class="fc-day fc-fri fc-widget-content fc-other-month fc-future"><div><div class="fc-day-number">10</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td data-date="2014-10-11" class="fc-day fc-sat fc-widget-content fc-other-month fc-future fc-last"><div><div class="fc-day-number">11</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr></tbody></table></div></div>
									</div>
								</div>
							</div>
							<!-- END PORTLET-->
						</div>

		</div>

		</div>
		</div>
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
			<!-- END CONTENT -->
			<!-- BEGIN QUICK SIDEBAR -->
			<a class="page-quick-sidebar-toggler" href="javascript:;"><i class="icon-close"></i></a>
			<div class="page-quick-sidebar-wrapper">
				<div class="page-quick-sidebar">
					<div class="nav-justified">
						<ul class="nav nav-tabs nav-justified">
							<li class="active">
								<a data-toggle="tab" href="#quick_sidebar_tab_1">
								Users <span class="badge badge-danger">2</span>
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#quick_sidebar_tab_2">
								Alerts <span class="badge badge-success">7</span>
								</a>
							</li>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								More<i class="fa fa-angle-down"></i>
								</a>
								<ul role="menu" class="dropdown-menu pull-right">
									<li>
										<a data-toggle="tab" href="#quick_sidebar_tab_3">
										<i class="icon-bell"></i> Alerts </a>
									</li>
									<li>
										<a data-toggle="tab" href="#quick_sidebar_tab_3">
										<i class="icon-info"></i> Notifications </a>
									</li>
									<li>
										<a data-toggle="tab" href="#quick_sidebar_tab_3">
										<i class="icon-speech"></i> Activities </a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a data-toggle="tab" href="#quick_sidebar_tab_3">
										<i class="icon-settings"></i> Settings </a>
									</li>
								</ul>
							</li>
						</ul>
						<div class="tab-content">
							<div id="quick_sidebar_tab_1" class="tab-pane active page-quick-sidebar-chat">
								<div class="page-quick-sidebar-list" style="position: relative; overflow: hidden; width: auto; height: 317px;"><div data-wrapper-class="page-quick-sidebar-list" data-rail-color="#ddd" class="page-quick-sidebar-chat-users" data-height="317" style="overflow: hidden; width: auto; height: 317px;" data-initialized="1">
									<h3 class="list-heading">Staff</h3>
									<ul class="media-list list-items">
										<li class="media">
											<div class="media-status">
												<span class="badge badge-success">8</span>
											</div>
											<img alt="..." src="../../assets/admin/layout/img/avatar3.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Bob Nilson</h4>
												<div class="media-heading-sub">
													 Project Manager
												</div>
											</div>
										</li>
										<li class="media">
											<img alt="..." src="../../assets/admin/layout/img/avatar1.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Nick Larson</h4>
												<div class="media-heading-sub">
													 Art Director
												</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="badge badge-danger">3</span>
											</div>
											<img alt="..." src="../../assets/admin/layout/img/avatar4.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Deon Hubert</h4>
												<div class="media-heading-sub">
													 CTO
												</div>
											</div>
										</li>
										<li class="media">
											<img alt="..." src="../../assets/admin/layout/img/avatar2.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Ella Wong</h4>
												<div class="media-heading-sub">
													 CEO
												</div>
											</div>
										</li>
									</ul>
									<h3 class="list-heading">Customers</h3>
									<ul class="media-list list-items">
										<li class="media">
											<div class="media-status">
												<span class="badge badge-warning">2</span>
											</div>
											<img alt="..." src="../../assets/admin/layout/img/avatar6.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Lara Kunis</h4>
												<div class="media-heading-sub">
													 CEO, Loop Inc
												</div>
												<div class="media-heading-small">
													 Last seen 03:10 AM
												</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="label label-sm label-success">new</span>
											</div>
											<img alt="..." src="../../assets/admin/layout/img/avatar7.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Ernie Kyllonen</h4>
												<div class="media-heading-sub">
													 Project Manager,<br>
													 SmartBizz PTL
												</div>
											</div>
										</li>
										<li class="media">
											<img alt="..." src="../../assets/admin/layout/img/avatar8.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Lisa Stone</h4>
												<div class="media-heading-sub">
													 CTO, Keort Inc
												</div>
												<div class="media-heading-small">
													 Last seen 13:10 PM
												</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="badge badge-success">7</span>
											</div>
											<img alt="..." src="../../assets/admin/layout/img/avatar9.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Deon Portalatin</h4>
												<div class="media-heading-sub">
													 CFO, H&amp;D LTD
												</div>
											</div>
										</li>
										<li class="media">
											<img alt="..." src="../../assets/admin/layout/img/avatar10.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Irina Savikova</h4>
												<div class="media-heading-sub">
													 CEO, Tizda Motors Inc
												</div>
											</div>
										</li>
										<li class="media">
											<div class="media-status">
												<span class="badge badge-danger">4</span>
											</div>
											<img alt="..." src="../../assets/admin/layout/img/avatar11.jpg" class="media-object">
											<div class="media-body">
												<h4 class="media-heading">Maria Gomez</h4>
												<div class="media-heading-sub">
													 Manager, Infomatic Inc
												</div>
												<div class="media-heading-small">
													 Last seen 03:10 AM
												</div>
											</div>
										</li>
									</ul>
								</div><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; height: 132.571px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(221, 221, 221); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
								<div class="page-quick-sidebar-item">
									<div class="page-quick-sidebar-chat-user">
										<div class="page-quick-sidebar-nav">
											<a class="page-quick-sidebar-back-to-list" href="javascript:;"><i class="icon-arrow-left"></i>Back</a>
										</div>
										<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 212px;"><div class="page-quick-sidebar-chat-user-messages" data-height="212" style="overflow: hidden; width: auto; height: 212px;" data-initialized="1">
											<div class="post out">
												<img src="../../assets/admin/layout/img/avatar3.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Bob Nilson</a>
													<span class="datetime">20:15</span>
													<span class="body">
													When could you send me the report ? </span>
												</div>
											</div>
											<div class="post in">
												<img src="../../assets/admin/layout/img/avatar2.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Ella Wong</a>
													<span class="datetime">20:15</span>
													<span class="body">
													Its almost done. I will be sending it shortly </span>
												</div>
											</div>
											<div class="post out">
												<img src="../../assets/admin/layout/img/avatar3.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Bob Nilson</a>
													<span class="datetime">20:15</span>
													<span class="body">
													Alright. Thanks! :) </span>
												</div>
											</div>
											<div class="post in">
												<img src="../../assets/admin/layout/img/avatar2.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Ella Wong</a>
													<span class="datetime">20:16</span>
													<span class="body">
													You are most welcome. Sorry for the delay. </span>
												</div>
											</div>
											<div class="post out">
												<img src="../../assets/admin/layout/img/avatar3.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Bob Nilson</a>
													<span class="datetime">20:17</span>
													<span class="body">
													No probs. Just take your time :) </span>
												</div>
											</div>
											<div class="post in">
												<img src="../../assets/admin/layout/img/avatar2.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Ella Wong</a>
													<span class="datetime">20:40</span>
													<span class="body">
													Alright. I just emailed it to you. </span>
												</div>
											</div>
											<div class="post out">
												<img src="../../assets/admin/layout/img/avatar3.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Bob Nilson</a>
													<span class="datetime">20:17</span>
													<span class="body">
													Great! Thanks. Will check it right away. </span>
												</div>
											</div>
											<div class="post in">
												<img src="../../assets/admin/layout/img/avatar2.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Ella Wong</a>
													<span class="datetime">20:40</span>
													<span class="body">
													Please let me know if you have any comment. </span>
												</div>
											</div>
											<div class="post out">
												<img src="../../assets/admin/layout/img/avatar3.jpg" alt="" class="avatar">
												<div class="message">
													<span class="arrow"></span>
													<a class="name" href="#">Bob Nilson</a>
													<span class="datetime">20:17</span>
													<span class="body">
													Sure. I will check and buzz you if anything needs to be corrected. </span>
												</div>
											</div>
										</div><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; height: 64.948px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
										<div class="page-quick-sidebar-chat-user-form">
											<div class="input-group">
												<input type="text" placeholder="Type a message here..." class="form-control">
												<div class="input-group-btn">
													<button class="btn blue" type="button"><i class="icon-paper-clip"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="quick_sidebar_tab_2" class="tab-pane page-quick-sidebar-alerts">
								<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 317px;"><div class="page-quick-sidebar-alerts-list" data-height="317" style="overflow: hidden; width: auto; height: 317px;" data-initialized="1">
									<h3 class="list-heading">General</h3>
									<ul class="feeds list-items">
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-check"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 4 pending tasks. <span class="label label-sm label-warning ">
															Take action <i class="fa fa-share"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 Just now
												</div>
											</div>
										</li>
										<li>
											<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-bar-chart-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Finance Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
											</a>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 5 pending membership that requires a quick review.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 24 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-shopping-cart"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received with <span class="label label-sm label-success">
															Reference Number: DR23923 </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 30 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 5 pending membership that requires a quick review.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 24 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Web server hardware needs to be upgraded. <span class="label label-sm label-warning">
															Overdue </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 2 hours
												</div>
											</div>
										</li>
										<li>
											<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 IPO Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
											</a>
										</li>
									</ul>
									<h3 class="list-heading">System</h3>
									<ul class="feeds list-items">
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-check"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 4 pending tasks. <span class="label label-sm label-warning ">
															Take action <i class="fa fa-share"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 Just now
												</div>
											</div>
										</li>
										<li>
											<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">
															<i class="fa fa-bar-chart-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Finance Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
											</a>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 5 pending membership that requires a quick review.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 24 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-shopping-cart"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received with <span class="label label-sm label-success">
															Reference Number: DR23923 </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 30 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 5 pending membership that requires a quick review.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 24 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-warning">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
															Overdue </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 2 hours
												</div>
											</div>
										</li>
										<li>
											<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 IPO Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
											</a>
										</li>
									</ul>
								</div><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
							</div>
							<div id="quick_sidebar_tab_3" class="tab-pane page-quick-sidebar-settings">
								<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 317px;"><div class="page-quick-sidebar-settings-list" data-height="317" style="overflow: hidden; width: auto; height: 317px;" data-initialized="1">
									<h3 class="list-heading">General Settings</h3>
									<ul class="list-items borderless">
										<li>
											 Enable Notifications <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-success">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="success" data-size="small" checked="" class="make-switch"></div></div>
										</li>
										<li>
											 Allow Tracking <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-info">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="info" data-size="small" class="make-switch"></div></div>
										</li>
										<li>
											 Log Errors <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-danger">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="danger" data-size="small" checked="" class="make-switch"></div></div>
										</li>
										<li>
											 Auto Sumbit Issues <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-warning">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="warning" data-size="small" class="make-switch"></div></div>
										</li>
										<li>
											 Enable SMS Alerts <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-success">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="success" data-size="small" checked="" class="make-switch"></div></div>
										</li>
									</ul>
									<h3 class="list-heading">System Settings</h3>
									<ul class="list-items borderless">
										<li>
											 Security Level
											<select class="form-control input-inline input-sm input-small">
												<option value="1">Normal</option>
												<option selected="" value="2">Medium</option>
												<option value="e">High</option>
											</select>
										</li>
										<li>
											 Failed Email Attempts <input value="5" class="form-control input-inline input-sm input-small">
										</li>
										<li>
											 Secondary SMTP Port <input value="3560" class="form-control input-inline input-sm input-small">
										</li>
										<li>
											 Notify On System Error <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-danger">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="danger" data-size="small" checked="" class="make-switch"></div></div>
										</li>
										<li>
											 Notify On SMTP Error <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-small bootstrap-switch-animate"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-warning">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" data-off-text="OFF" data-off-color="default" data-on-text="ON" data-on-color="warning" data-size="small" checked="" class="make-switch"></div></div>
										</li>
									</ul>
									<div class="inner-content">
										<button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
									</div>
								</div><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END QUICK SIDEBAR -->
		</div>
	@show
@stop

@section('script-footer')
	@parent

	@section('footer-custom-js')
	<script>
		jQuery(document).ready(function() {
		   Index.init();
		   Index.initDashboardDaterange();
		   Index.initJQVMAP(); // init index page's custom scripts
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts
		   Index.initChat();
		   Index.initMiniCharts();
		   Index.initIntro();
		   Tasks.initDashboardWidget();

		   $('.account_details').slimScroll({
				height: '350px'
		   });
		});
	</script>
	@stop
@stop


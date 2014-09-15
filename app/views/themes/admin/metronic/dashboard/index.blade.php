@extends( $master_view )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
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
			@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.logo' )
			@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.horizontalMenu' )
			@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.topNavMenu' )
		</div>
		<!-- END HEADER INNER -->
	</div>
@show

@section('body-content')
	<div class="clearfix"></div>
	@section('innerpage-main-content')
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.leftSidebar' )
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.headerClientList' )
					<!-- Dashboard Title -->
					@section('innerpage-page-title')
						<h3 class="page-title">
							{{{$pageTitle or 'Dashboard'}}} <small>{{{$pageSubTitle or ''}}}</small>
						</h3>
					@show
					<!-- Dashboard Title -->
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row {{{$contentClass or 'dashboard'}}}">
						@section('innerpage-content')
							@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.dashboardContent' )
						@show
					</div>
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
			<!-- END CONTENT -->
			<!-- BEGIN QUICK SIDEBAR -->
				@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.quickSidebar' )
			<!-- END QUICK SIDEBAR -->
		</div>
	@show
@show

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


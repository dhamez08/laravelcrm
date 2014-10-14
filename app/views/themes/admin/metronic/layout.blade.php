@section('begin-of-page')
	<!DOCTYPE html>
	<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
	<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
	<!--[if !IE]><!-->
	<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
@show

@section('begin-head')
	<!-- BEGIN HEAD -->
	<head>
		@section('head-meta')
			<meta charset="utf-8"/>
			<title>{{{ $pageTitle or 'CRM Administration' }}}</title>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta content="width=device-width, initial-scale=1" name="viewport"/>
			<meta content="" name="description"/>
			<meta content="" name="author"/>
		@show

		@section('head-css')
			<!-- BEGIN GLOBAL MANDATORY STYLES -->
			<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
			<link href="{{$asset_path}}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
			<!-- END GLOBAL MANDATORY STYLES -->

			<!-- BEGIN PAGE LEVEL STYLES -->
			@yield('head-page-level-css')
			<link href="{{$asset_path}}/global/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/typeahead/typeahead.css">
			<!-- END PAGE LEVEL STYLES -->

			<!-- BEGIN THEME STYLES -->
			<link href="{{$asset_path}}/global/css/components.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/global/css/plugins.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/layout/css/layout.css" rel="stylesheet" type="text/css"/>
			<link href="{{$asset_path}}/layout/css/custom.css" rel="stylesheet" type="text/css"/>
			<!-- END THEME STYLES -->
			<link rel="shortcut icon" href="favicon.ico"/>
		@show

		@section('head-js')
		@show

		@yield('head-custom-css')
		@yield('head-custom-js')
	</head>
	<!-- END HEAD -->
@show

@section('begin-body')
	<body class="{{{ $html_body_class or 'one23-body' }}}">
@show

@yield('body-header')
@yield('body-content')
@yield('body-modals')

@section('body-footer')
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
			 2014 &copy; Metronic by keenthemes.
		</div>
		<div class="page-footer-tools">
			<span class="go-top">
			<i class="fa fa-angle-up"></i>
			</span>
		</div>
	</div>
	{{\Task\TaskController::get_instance()->modalCreateTask()}}
	<!-- END FOOTER -->
@show

@section('script-footer')
	@section('footer-css')

	@show

	@section('footer-js')
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->
		<!--[if lt IE 9]>
		<script src="{{$asset_path}}/global/plugins/respond.min.js"></script>
		<script src="{{$asset_path}}/global/plugins/excanvas.min.js"></script>
		<![endif]-->
		<script src="{{$asset_path}}/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
		<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<script src="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
		<script src="{{$asset_path}}/global/plugins/fullcalendar/fullcalendar/moment.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/fullcalendar/fullcalendar/fullcalendar211.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="{{$asset_path}}/global/scripts/metronic.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/layout/scripts/layout.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/layout/scripts/demo.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/pages/scripts/index.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/pages/scripts/tasks.js" type="text/javascript"></script>
		<script src="{{$asset_path}}/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
		<script type='text/javascript'>
			var baseURL = "{{url('/')}}";
			jQuery(document).ready(function() {
				var url = baseURL + '/clients/typeahead-client';
				Layout.init(); // init layout
				GetClient.init('get-clients', '.getclient', url, '#customer_id', 'Name');
				CreateTask.init('.openModal','.ajaxModal');
			});
		</script>
	@show

	@yield('footer-custom-css')
	@yield('footer-custom-js')
@show

@section('end-of-page')
	</body>
</html>
@show

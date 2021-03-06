@extends( $master_view )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/fullcalendar/fullcalendar/fullcalendar211.min.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/fullcalendar/fullcalendar/fullcalendar211.print.css" type="text/css">
	<link href="{{$asset_path}}/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="{{$asset_path}}/pages/css/client_summary.css" rel="stylesheet"/>
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
@stop

@section('body-content')
	<div class="clearfix"></div>
	@section('innerpage-main-content')
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			@section('left-sidebar')
				@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.leftSidebar' )
			@show
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					@section('pagebar')
						@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.headerClientList' )
					@show
					<!-- Dashboard Title -->
					@section('innerpage-page-title')
						<h3 class="page-title">
							{{-- {{{$pageTitle or 'Dashboard'}}} <small>{{{$pageSubTitle or ''}}}</small> --}}
						</h3>
					@show
					<!-- Dashboard Title -->
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row {{{$contentClass or 'dashboard'}}}">
						@section('innerpage-action-msg')
							@if ($errors->all())
								<div class="alert alert-danger fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
									{{ HTML::ul($errors->all(),array('class' => 'list-unstyled')) }}
								</div>
							@endif

							@if (Session::has('message'))
								<div class="alert alert-{{Session::has('alertClass') ? Session::get('alertClass'):'success'}}">
									{{ Session::get('message') }}
									<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								</div>
							@endif

							<div id="ajax-loading-bar" class="col-md-12 text-center hidden" style="padding: 15px 0px;">
								<img src="{{$asset_path}}/global/img/ajax-loading-bar.gif" />
							</div>
						@show

						@section('invoice-topbar')
							@if(\Request::segment(1) == 'invoice')
								@include($view_path . '.invoice.dashboard.topbar-stats')
							@endif
						@show

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
			<!--	@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.quickSidebar') -->
			<!-- END QUICK SIDEBAR -->
		</div>
	@show
@stop

@section('script-footer')
	@parent

	@section('footer-custom-js')
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client_summary.js"></script>
	<!--
	<script src="{{$asset_path}}/global/plugins/ckeditor/ckeditor.js"></script>
	<script src="{{$asset_path}}/global/plugins/ckeditor/adapters/jquery.js"></script>-->
	<script>
		jQuery(document).ready(function() {
			//Summary.init();
            Summary.init_toggler();
		});
	</script>
    <script type="text/javascript">
        $('.easy-pie-chart .number.conversion_30days ').easyPieChart({
            animate: 1000,
            size: 75,
            lineWidth: 3,
            barColor: Metronic.getBrandColor('yellow')
        });

        $('.easy-pie-chart .number.conversion_90days').easyPieChart({
            animate: 1000,
            size: 75,
            lineWidth: 3,
            barColor: Metronic.getBrandColor('green')
        });

        $('.easy-pie-chart .number.conversion_360days').easyPieChart({
            animate: 1000,
            size: 75,
            lineWidth: 3,
            barColor: Metronic.getBrandColor('red')
        });
    </script>	
	@stop
@stop


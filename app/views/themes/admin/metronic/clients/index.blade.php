@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
	@stop
@stop
@section('body-content')
	@parent
	@section('left-sidebar')
		@include($view_path.'.clients.partials.leftSidebar')
	@stop
	@section('pagebar')
		@parent
		@include($view_path.'.clients.partials.subPagebar')
	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('innerpage-content')
		<div class="col-md-2">
			<!-- CLIENT LEFT SIDEBAR -->
			@include($view_path.'.clients.partials.leftColumn')
			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-md-8">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.partials.centerColumn')
			<!-- END CENTER COLUMN -->		
		</div>
		<div class="col-md-2">
			<!-- ADS -->
			@include($view_path.'.clients.partials.rightColumn')
			<!-- END ADS -->
		</div>
	@stop
@stop

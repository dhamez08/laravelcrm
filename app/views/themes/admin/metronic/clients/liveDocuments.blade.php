@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
	@stop

    @section('head-custom-css')
        @parent
        <link href="{{$asset_path}}/pages/css/client-summary-sidebar.css" rel="stylesheet"/>
        <style type="text/css">
		.portlet-body {
			height: 400px;
		}
        </style>
    @stop
@stop
@section('body-content')
	@parent
	@section('left-sidebar')
        @include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.leftSidebar' )
		@if( isset($clientId) )
			@include($view_path.'.clients.partials.leftSidebar')
		@endif
	@stop
	@section('pagebar')
		@parent
		{{--@include($view_path.'.clients.partials.subPagebar')--}}
	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('innerpage-content')

		<div class="col-lg-2 col-md-3 col-sm-3 col-summary">
			<!-- CLIENT LEFT SIDEBAR -->
			@if( $customer->type == 2 )
				@include($view_path.'.clients.company.leftColumn')
			@else
				@include($view_path.'.clients.partials.leftColumn')
			@endif
			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-lg-10 col-md-9 col-sm-9 col-summary">
			<div class="row">
				<!-- CENTER COLUMN -->
				@include($view_path.'.clients.partials.center_column.'.$center_column_view)
				<!-- END CENTER COLUMN -->
			</div>
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		@parent
	@stop
@stop

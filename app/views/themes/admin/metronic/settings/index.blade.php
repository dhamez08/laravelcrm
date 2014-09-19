@extends( $dashboard_index )
@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/layout/css/settings.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END PAGE LEVEL SCRIPTS -->
@stop
@section('body-content')
	@parent
	@section('innerpage-content')
		@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.nav' )
	@stop
@stop

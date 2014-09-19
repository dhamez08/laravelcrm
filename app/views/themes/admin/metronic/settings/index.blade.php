@extends( $dashboard_index )
@section('body-content')
	@parent
	@section('innerpage-content')
		@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.nav' )
	@stop
@stop

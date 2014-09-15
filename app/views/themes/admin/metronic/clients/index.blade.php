@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
	@stop
@stop
@section('body-content')
	@parent
	@section('innerpage-content')
		<h1>Clients page!</h1>
	@stop
@stop

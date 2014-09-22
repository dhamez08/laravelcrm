@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
		<div class="col-md-12">
			<h1>Hello, this is the edit custom form page!</h1>
		</div>
		@stop
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	@stop
@stop

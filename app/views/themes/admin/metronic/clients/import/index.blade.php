@extends( $page_view )
@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/layout/css/settings.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END PAGE LEVEL SCRIPTS -->
@stop
@section('body-content')
	@parent
	@section('innerpage-page-title')
	@stop
	@section('innerpage-content')
		@parent
		@section('portlet-tab')
		@stop
		@section('portlet-content')
			<div class="row" style="margin-top:50px">
				<div class="col-md-12">
					
					@include( \DashboardEntity::get_instance()->getView() . '.clients.import.input')
				</div>
			</div>
		@stop
	@stop
@stop

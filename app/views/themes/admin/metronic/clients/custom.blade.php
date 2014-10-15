@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
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
		<div class="col-md-3">
			<!-- CLIENT LEFT SIDEBAR -->
			@if( $customer->type == 2 )
				@include($view_path.'.clients.company.leftColumn')
			@else
				@include($view_path.'.clients.partials.leftColumn')
			@endif

			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-md-6">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.partials.center_column.'.$center_column_view)
			<!-- END CENTER COLUMN -->
		</div>
		<div class="col-md-3">
			<!-- ADS -->
			@include($view_path.'.clients.partials.rightColumn')
			<!-- END ADS -->
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		

	@stop
@stop

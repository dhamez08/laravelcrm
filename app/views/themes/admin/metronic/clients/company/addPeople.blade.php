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
		{{-- @include($view_path.'.clients.partials.subPagebar') --}}
	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('innerpage-content')
		<div class="col-lg-2 col-md-3 col-sm-3 col-summary">
			<!-- CLIENT LEFT SIDEBAR -->
			@include($view_path.'.clients.company.leftColumn')
			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-lg-10 col-md-9 col-sm-9 col-summary">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.company.addInputCenter')
			<!-- END CENTER COLUMN -->
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		@parent
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
		<script>
			jQuery(document).ready(function() {
				addPhone.init();
				addEmail.init();
				addPartner.init();
				addChildren.init();
				addressLookup.init();
				addWebsite.init();
			});
		</script>
	@stop
@stop

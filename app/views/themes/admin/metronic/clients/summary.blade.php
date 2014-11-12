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
		<div id="client-tags-dis" class="col-md-12 col-summary client-tags">
			<p>
				<i class="icon-tag"></i>
				<span id="client-profile-tags-list">
					<span>Building and Contents</span>, 
					<span>Web Desing</span>, 
					<span>SEO</span>,
					<span>Graphic Design</span>,
					<span>Google Lead</span>
				</span>
				<a href="#" id="edit-tags-button">Edit Tags</a>
			</p>
			<p id="edit-tags-inputs" class="col-md-12 hide">
				<input id="tags_1" type="text" class="form-control tags" value="Building and Contents,Web Desing,SEO,Graphic Design,Google Lead"/>
			</p>	
		</div>		
		<div class="col-md-2 col-summary">
			<!-- CLIENT LEFT SIDEBAR -->
			@if( $customer->type == 2 )
				@include($view_path.'.clients.company.leftColumn')
			@else
				@include($view_path.'.clients.partials.leftColumn')
			@endif

			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-md-8 col-summary">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.partials.center_column.'.$center_column_view)
			<!-- END CENTER COLUMN -->
		</div>
		<div class="col-md-2 col-summary">
			<!-- ADS -->
			@include($view_path.'.clients.partials.rightColumn')
			<!-- END ADS -->
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
		<script src="{{$asset_path}}/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/notes.js"></script>

		<script> 
        jQuery(document).ready(function() {
        	deletePhone.init();
        	deleteURL.init();
        	deleteEmail.init();
        	deletePerson.init();
        	Notes.init();
        	SendIndividualSMS.init();
        });

		</script>
	@stop
@stop

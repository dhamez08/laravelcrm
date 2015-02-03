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

		<!-- BEGIN:File Upload Plugin JS files-->
		<!-- The Templates plugin is included to render the upload/download listings -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
		<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
		<!-- The Canvas to Blob plugin is included for image resizing functionality -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
		<!-- blueimp Gallery script -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
		<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
		<!-- The File Upload processing plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
		<!-- The File Upload image preview & resize plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
		<!-- The File Upload audio preview plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
		<!-- The File Upload video preview plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
		<!-- The File Upload validation plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
		<!-- The File Upload user interface plugin -->
		<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>

		<script src="{{$asset_path}}/pages/scripts/form-fileupload.js"></script>
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->


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
		<script>
        jQuery(document).ready(function() {
        	$(document).bind('drop dragover', function (e) {
				e.preventDefault();
			});
        	FormFileUpload.init();
        	deleteFiles.init();
        	jQuery('a.clientFiles').each(function(){
				jQuery(this).editable({
					send:'always',
					ajaxOptions: {
						dataType: 'json'
					},
					success: function(response, newValue) {
						if(!response) {
							return "Unknown error!";
						}

						if(response.result === false) {
							 return response.message;
						}
					}
				});
			});
        });
		</script>
	@stop
@stop

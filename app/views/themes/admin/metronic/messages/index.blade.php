@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
		<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
		<link href="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.css">
		<link href="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
		<!-- BEGIN:File Upload Plugin CSS files-->
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
		<!-- END:File Upload Plugin CSS files-->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="{{$asset_path}}/pages/css/inbox.css" rel="stylesheet" type="text/css"/>

		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/select2/select2.css"/>
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/jquery-multi-select/css/multi-select.css"/>
		<!-- END PAGE LEVEL STYLES -->

		<style type="text/css">
		.select2-container-multi .select2-choices {
			border: 0px !important;
		}
		.select2-container-multi.select2-container-disabled .select2-choices {
			background-color: #fff !important;
		}
		</style>
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row inbox">
				<div class="col-md-2">
					<ul class="inbox-nav margin-bottom-10">
						<li class="compose-btn">
							<a href="{{ url('messages/compose') }}" data-title="Compose" class="btn green">
							<i class="fa fa-edit"></i> Compose </a>
						</li>
						<li class="inbox {{ $message_title=='Inbox' ? 'active':'' }}">
							<a href="{{ url('messages/inbox') }}" class="btn" data-title="Inbox">
							@if($UnreadMessagesCount)
								Inbox({{ $UnreadMessagesCount }})
							@else
								Inbox
							@endif
							</a>
							<b></b>
						</li>
						<li class="sent {{ $message_title=='Sent' ? 'active':'' }}">
							<a class="btn" href="{{ url('messages/sent') }}" data-title="Sent">
							Sent </a>
							<b></b>
						</li>
						<li class="draft {{ $message_title=='Draft' ? 'active':'' }}">
							<a class="btn" href="{{ url('messages/draft') }}" data-title="Draft">
							Draft </a>
							<b></b>
						</li>
						<li class="trash {{ $message_title=='Trash' ? 'active':'' }}">
							<a class="btn" href="{{ url('messages/trash') }}" data-title="Trash">
							Trash </a>
							<b></b>
						</li>
					</ul>
				</div>
				<div class="col-md-10">
					<div class="inbox-header">
						<h1 class="pull-left">{{ $message_title }}</h1>
						<form class="form-inline pull-right" action="index.html">
							<div class="input-group input-medium">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="input-group-btn">
								<button type="button" class="btn green"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</form>
					</div>
					<div class="inbox-loading">
						 Loading...
					</div>
					<div class="inbox-content">
						@include($view_path.'.messages.partials.'.$center_view)
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script src="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<!-- BEGIN:File Upload Plugin JS files-->
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
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


	<script type="text/javascript" src="{{$asset_path}}/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
	<script src="{{$asset_path}}/pages/scripts/components-dropdowns.js"></script>
	<script src="{{$asset_path}}/pages/scripts/ui-blockui.js"></script>

	<script>
	var BASE_URL = '{{ url('/') }}';
	var ASSET_PATH = '{{$asset_path}}';
	var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';
	</script>

	<script src="{{$asset_path}}/pages/scripts/messages.js?v=0.7" type="text/javascript"></script>
	<script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
		   Messages.init();
		   ComponentsDropdowns.init();
		   ComponentsEditors.init();

		    $(".note-image-dialog .close").bind("click", function() {
            	$(".note-image-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

			$(".note-video-dialog .close").bind("click", function() {
            	$(".note-video-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

			$(".note-link-dialog .close").bind("click", function() {
            	$(".note-link-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

            $(".note-help-dialog .modal-close").bind("click", function() {
            	$(".note-help-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });
		  
		});
	</script>
	@stop
@stop

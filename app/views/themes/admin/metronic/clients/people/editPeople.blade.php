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
		<div class="col-md-4">
			<!-- CLIENT LEFT SIDEBAR -->
			@include($view_path.'.clients.partials.leftColumn')
			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-md-8">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.people.editInputCenter')
			<!-- END CENTER COLUMN -->
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
		    <tr class="template-upload fade">
		        <td>
		            <span class="preview"></span>
		        </td>
		        <td>
		            <p class="name">{%=file.name%}</p>
		            <strong class="error text-danger label label-danger"></strong>
		        </td>
		        <td>
		            <p class="size">Processing...</p>
		            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
		            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
		            </div>
		        </td>
		        <td>
		            {% if (!i && !o.options.autoUpload) { %}
		                <button class="btn btn-sm blue start" disabled>
		                    <i class="fa fa-upload"></i>
		                    <span>Start</span>
		                </button>
		            {% } %}
		            {% if (!i) { %}
		                <button class="btn btn-sm red cancel">
		                    <i class="fa fa-ban"></i>
		                    <span>Cancel</span>
		                </button>
		            {% } %}
		        </td>
		    </tr>
		{% } %}
		</script>
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
			{% for (var i=0, file; file=o.files[i]; i++) { %}
			    <tr class="template-download fade">
			        <td>
			            <span class="preview">
			                {% if (file.thumbnailUrl) { %}
			                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
			                {% } %}
			            </span>
			        </td>
			        <td>
			            <p class="name">
			                {% if (file.url) { %}
			                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
			                {% } else { %}
			                    <span>{%=file.name%}</span>
			                {% } %}
			            </p>
			            {% if (file.error) { %}
			                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
			            {% } %}
			        </td>
			        <td>
			            <span class="size">{%=o.formatFileSize(file.size)%}</span>
			        </td>
			        <td>
			            {% if (file.deleteUrl) { %}
			                <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
			                    <i class="fa fa-trash-o"></i>
			                    <span>Delete</span>
			                </button>
			                <input type="checkbox" name="delete" value="1" class="toggle">
			            {% } else { %}
			                <button class="btn yellow cancel btn-sm">
			                    <i class="fa fa-ban"></i>
			                    <span>Cancel</span>
			                </button>
			            {% } %}
			        </td>
			    </tr>
			{% } %}
		</script>

		<script src="{{$asset_path}}/global/plugins/dropzone/dropzone.js"></script>

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

		<script src="{{$asset_path}}/pages/scripts/form-fileupload.js"></script>

		<script>
        jQuery(document).ready(function() {
        	FormFileUpload.init();
        });
		</script>
	@stop
@stop

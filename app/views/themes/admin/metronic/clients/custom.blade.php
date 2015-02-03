@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/pages/css/client_summary.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
		<link href="{{$asset_path}}/global/plugins/star-rating/css/star-rating.css" rel="stylesheet" type="text/css"/>

		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
		
		<style>
		span#content-form-spinner {
		    -animation: spin .7s infinite linear;
		    -webkit-animation: spin2 .7s infinite linear;
		    font-size: 50px;
			margin-left: auto;
			left: 50%;
			color: gray;
			margin-top: 50px;
			margin-bottom: 50px;
		}

		@-webkit-keyframes spin2 {
		    from { -webkit-transform: rotate(0deg);}
		    to { -webkit-transform: rotate(360deg);}
		}

		@keyframes spin {
		    from { transform: scale(1) rotate(0deg);}
		    to { transform: scale(1) rotate(360deg);}
		}
		.portlet.light.bordered > .portlet-title {
			border: 0px;
		}

		.radio input[type=radio] {
			position: relative;
			float:left;
		}

		.checkbox input[type=checkbox] {
			position: relative;
			float:left;
		}

		#content-form-data input[type="text"] {
			border:0px;
			font-weight: bold;
		}
		#content-form-data select {
		    -webkit-appearance: none;
		    -moz-appearance: none;
		    text-indent: 1px;
		    text-overflow: '';
		}
		#content-form-data .form-control[disabled] {
			background: none;
			cursor: default;
			border: 0px;
			font-weight: bold;
			padding-left: 0px;
		}

		.portlet-body {
			height: 400px;
		}		
		</style>
	@stop
@stop
@section('body-content')
	@parent
	@section('left-sidebar')
		@include($view_path.'.clients.partials.leftSidebar')
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
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/opportunities.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/notes.js"></script>
	<script type="text/javascript">

		$(".view-data-form").on("click", function(e) {
			e.preventDefault();
			$this = $(this);

			$("#form-data-modal #content-form-action").hide();
			$("#form-data-modal").modal("show");

			$.get("{{ url('settings/custom-forms/form-data') }}/"+$this.attr("data-ref-id"), function(responce) {
				$("#form-data-modal input.content-hidden-form").val(responce);
				$("#form-data-modal input.title-hidden-form").val($this.attr("data-form-name"));
				$("#form-data-modal #content-form-data").html(responce);
				$("#form-data-modal #content-form-name").html($this.attr("data-form-name"));
				$("#form-data-modal #content-form-action").show();
			});
		});

		$(document).on("ready", function() {
			deletePhone.init();
        	deleteURL.init();
        	deleteEmail.init();
        	deletePerson.init();
        	Notes.init();
		});
	</script>

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
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/dropbox-file.js"></script>
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

		<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
		    <tr class="template-upload fade">
		        <td>
		            <span class="preview"></span>
		        </td>
		        <td>
					<p class="name">
						{% if( file.name.length > 17 ){ %}
							...{%=file.name.slice(17)%}
						{% }else{ %}
							{%=file.name%}
						{% } %}
					</p>
					<strong class="error text-danger label label-danger"></strong>
					{{--Form::text('caption[{%=file.name%}]',null,array('class'=>'form-control','placeholder'=>'Add Description'))--}}
					<div>
						<p class="size">Processing...</p>
						<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
						<div class="progress-bar progress-bar-success" style="width:0%;"></div>
						</div>
					</div>
					<div>
						{% if (!i && !o.options.autoUpload) { %}
							<button class="btn btn-xs blue start hidden" disabled>
								<i class="fa fa-upload"></i>
								<span>Start</span>
							</button>
						{% } %}
						{% if (!i) { %}
							<button class="btn btn-xs red cancel">
								<i class="fa fa-ban"></i>
								<span>Cancel</span>
							</button>
						{% } %}
					</div>
		        </td>
		    </tr>
		{% } %}
		</script>
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">

		</script>
		<script>
        jQuery(document).ready(function() {
        	$(document).bind('drop dragover', function (e) {
				e.preventDefault();
			});
        	FormFileUpload.init();
        	deleteFiles.init();
        	DropBoxIntegrationFile.init(baseURL);
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

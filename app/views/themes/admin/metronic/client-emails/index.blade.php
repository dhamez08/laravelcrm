@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
		<link href="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
		<link href="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
		<!-- BEGIN:File Upload Plugin CSS files-->
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
		<!-- END:File Upload Plugin CSS files-->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="{{$asset_path}}/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL STYLES -->
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
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<form class="inbox-compose form-horizontal" id="fileupload" action="#" method="POST" enctype="multipart/form-data">
							{{ Form::token() }}
							<input type="hidden" name="to_name" value="{{ $customer->first_name . ' ' . $customer->last_name }}" />
								<div class="inbox-compose-btn">
									<button class="btn blue"><i class="fa fa-check"></i>Send</button>
									<button onclick="history.back(-1)" class="btn inbox-discard-btn cancel-btn">Cancel</button>
								</div>
								<div class="inbox-form-group mail-to">
									<label class="control-label">To:</label>
									<div class="controls controls-to">
										<input type="text" value="{{ $client_email }}" class="form-control" name="to">
										<span class="inbox-cc-bcc">
										<span class="inbox-cc">
										Cc </span>
										<span class="inbox-bcc">
										Bcc </span>
										</span>
									</div>
								</div>
								<div class="inbox-form-group input-cc display-hide">
									<a href="javascript:;" class="close">
									</a>
									<label class="control-label">Cc:</label>
									<div class="controls controls-cc">
										<input type="text" name="cc" class="form-control">
									</div>
								</div>
								<div class="inbox-form-group input-bcc display-hide">
									<a href="javascript:;" class="close">
									</a>
									<label class="control-label">Bcc:</label>
									<div class="controls controls-bcc">
										<input type="text" name="bcc" class="form-control">
									</div>
								</div>
								<div class="inbox-form-group">
									<label class="control-label">Subject:</label>
									<div class="controls">
										<input type="text" class="form-control" name="subject" id="email_subject">
									</div>
								</div>
								<div class="inbox-form-group">
									<label class="control-label">Files:</label>
									<div class="controls">
										<select id="client_files" name="client_files" class="form-control">
				                            <option value="">Select Files</option>
				                            <?php 
					                        $client_files = \CustomerFiles\CustomerFilesEntity::get_instance()->getFilesByClient(isset($customer) ? $customer->id:'');
					                        $document_libraries = \DocumentLibrary\DocumentLibraryEntity::get_instance()->documents();
					                        ?>
					                        @if(count($client_files)>0)
					                            <optgroup label="Client Files">
					                            @foreach($client_files as $file)
					                              <option value="documents/{{ $file->filename }}">{{ $file->name }} - {{ date('d/m/Y H:i',strtotime($file->created_at)) }}</option>
					                            @endforeach
					                            </optgroup>
					                        @endif
					                        @if(count($document_libraries)>0)
					                            <optgroup label="Document Library">
					                            @foreach($document_libraries as $file)
					                              <option value="document/library/own/{{ $file->filename }}">{{ $file->name }} - {{ date('d/m/Y H:i',strtotime($file->created_at)) }}</option>
					                            @endforeach
					                            </optgroup>
					                        @endif
				                        </select>
									</div>
								</div>
								<?php $templates = \EmailTemplate\EmailTemplateEntity::get_instance()->getTemplatesByLoggedUser(); ?>
								@if(count($templates)>0)
								<div class="inbox-form-group">
									<label class="control-label">Template:</label>
									<div class="controls">
										<select id="email_template" name="email_template" class="form-control">
				                            <option value="">No template required</option>
				                            @foreach($templates as $template)
				                            <option value="{{ $template->id }}">{{ $template->name }}</option>
				                            @endforeach
				                        </select>
									</div>
								</div>
								@endif
								<?php $emailsignatures = \EmailSignature\EmailSignatureEntity::get_instance()->getEmailSignaturesByLoggedUser(); ?>
								@if(count($emailsignatures)>0)
								<div class="inbox-form-group">
									<label class="control-label">Signature:</label>
									<div class="controls">
										<select id="email_signature" name="email_signature" class="form-control">
				                            <option value="">Select Signature (applied when sent)</option>
				                            @foreach($emailsignatures as $signature)
				                            <option value="{{ $signature->id }}">{{ $signature->name }}</option>
				                            @endforeach
				                        </select>
									</div>
								</div>
								@endif
								<div class="inbox-form-group">
									<textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea>
								</div>
								<div class="inbox-compose-attachment">
									<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
									<span class="btn green fileinput-button">
									<i class="fa fa-plus"></i>
									<span>
									Add local files... </span>
									<input type="file" name="files[]" multiple>
									</span>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" class="table table-striped margin-top-10">
									<tbody class="files">
									</tbody>
									</table>
								</div>
								<script id="template-upload" type="text/x-tmpl">
								{% for (var i=0, file; file=o.files[i]; i++) { %}
							    <tr class="template-upload fade">
							        <td class="name" width="30%"><span>{%=file.name%}</span></td>
							        <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
							        {% if (file.error) { %}
							            <td class="error" width="20%" colspan="2"><span class="label label-danger">Error</span> {%=file.error%}</td>
							        {% } else if (o.files.valid && !i) { %}
							            <td>
							                <p class="size">{%=o.formatFileSize(file.size)%}</p>
							                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
							                   <div class="progress-bar progress-bar-success" style="width:0%;"></div>
							                   </div>
							            </td>
							        {% } else { %}
							            <td colspan="2"></td>
							        {% } %}
							        <td class="cancel" width="10%" align="right">{% if (!i) { %}
							            <button class="btn btn-sm red cancel">
							                       <i class="fa fa-ban"></i>
							                       <span>Cancel</span>
							                   </button>
							        {% } %}</td>
							    </tr>
							{% } %}
								</script>
								<!-- The template to display files available for download -->
								<script id="template-download" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
							    <tr class="template-download fade">
							        {% if (file.error) { %}
							            <td class="name" width="30%"><span>{%=file.name%}</span></td>
							            <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
							            <td class="error" width="30%" colspan="2"><span class="label label-danger">Error</span> {%=file.error%}</td>
							        {% } else { %}
							            <td class="name" width="30%">
							                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
							            </td>
							            <td class="size" width="40%"><span>{%=o.formatFileSize(file.size)%}</span></td>
							            <td colspan="2"></td>
							        {% } %}
							        <td class="delete" width="10%" align="right">
							            <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							                <i class="fa fa-times"></i>
							            </button>
							        </td>
							    </tr>
							{% } %}
								</script>
								<div class="inbox-compose-btn">
									<button class="btn blue"><i class="fa fa-check"></i>Send</button>
									<button onclick="history.back(-1)" class="btn inbox-discard-btn cancel-btn">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
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
	<script src="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
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

	<script>
	var BASE_URL = '{{ url('/') }}';
	var ASSET_PATH = '{{$asset_path}}';
	var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';
	</script>

	<script src="{{$asset_path}}/pages/scripts/client-email.js" type="text/javascript"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
		   ClientEmail.init();
		});
	</script>
	@stop
@stop

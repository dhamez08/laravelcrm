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
							<input type="hidden" name="client_ref" value="[REF:{{ $customer->ref }}]" />
							<input type="hidden" name="customer_id" value="{{ $customer->id }}" />
								<div class="inbox-compose-btn">
									<button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
									<button type="button" onclick="history.back(-1);" class="btn inbox-discard-btn">Cancel</button>
									<button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
								</div>
								<div class="inbox-form-group mail-to">
									<label class="control-label">To:</label>
									<div class="controls controls-to">
										<select id="select2_user" class="form-control select2" multiple disabled>
										@foreach($customers->get() as $customer1)
											<option value="{{ $customer1->id }}" {{ $customer->id==$customer1->id ? 'selected="selected"':'' }}>{{ $customer1->first_name . " " . $customer1->last_name }}</option>
										@endforeach
										</select>
										<input type="hidden" name="to[]" value="{{ $customer->id }}" />
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
									{{
										Form::text(
											'subject',
											null,
											array(
												'class'=>'form-control',
												'id'=>'email_subject'
											)
										);
									}}
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
					                              <option value="{{ $file->name }}|documents/{{ $file->filename }}">{{ $file->name }} - {{ date('d/m/Y H:i',strtotime($file->created_at)) }}</option>
					                            @endforeach
					                            </optgroup>
					                        @endif
					                        @if(count($document_libraries)>0)
					                            <optgroup label="Document Library">
					                            @foreach($document_libraries as $file)
					                              <option value="{{ $file->name }}|document/library/own/{{ $file->filename }}">{{ $file->name }} - {{ date('d/m/Y H:i',strtotime($file->created_at)) }}</option>
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
								<div class="inbox-form-group row">
									<!-- <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea> -->
									<div class="col-md-9">
									{{
										Form::textarea(
											'message',
											null,
											array(
												'class'=>'form-control',
												'id'=>'message'
											)
										);
									}}
									</div>
									<div class="col-md-3" style="padding:0px;padding-right:30px;">
										<h2>Dynamic Fields</h2>
										<select id="custom_form" class="form-control">
				                            <option value="0">Choose a Form</option>
				                            <option value="customer">---Customer Information---</option>
				                            <option value="custom_fields">---Custom Fields---</option>
				                        <?php
				                        $forms = \CustomForm\CustomFormEntity::get_instance()->getFormsByLoggedUser();
				                        ?>
				                        @foreach($forms as $form)
				                        	<option value="{{ $form->id }}">{{ $form->name }}</option>
				                        @endforeach
				                        </select>

				                        <div id="fields_container" style="margin-top:15px;min-height:230px;">
				                        	<div class="scroller" style="height:230px" data-always-visible="0" data-rail-visible="0" data-rail-color="red" data-handle-color="green">
				                        	<table class="table table-bordered table-hover">
												<tbody>
												</tbody>
											</table>
				                        	</div>
				                        </div>
									</div>
								</div>
								<!--
								<div class="inbox-compose-attachment">
									<span class="btn green fileinput-button">
									<i class="fa fa-plus"></i>
									<span>
									Add local files... </span>
									<input type="file" name="files[]" multiple>
									</span>
									<table role="presentation" class="table table-striped margin-top-10">
									<tbody class="files">
									</tbody>
									</table>
								</div> -->
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
									<button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
									<button type="button" onclick="history.back(-1);" class="btn inbox-discard-btn">Cancel</button>
									<button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
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

	<script src="{{$asset_path}}/pages/scripts/client-email.js?v=0.3" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>


	<script type="text/javascript">
		jQuery(document).ready(function() {
			ComponentsEditors.init();
		    ClientEmail.init();
		   
		   ComponentsDropdowns.init();

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

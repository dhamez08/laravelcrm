<form class="inbox-compose form-horizontal" id="fileupload" action="{{ url('messages/compose') }}" method="POST" enctype="multipart/form-data">
{{ Form::token() }}
	<div class="inbox-compose-btn">
		<button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
		<button type="button" data-dismiss="modal" class="btn inbox-discard-btn">Cancel</button>
		<button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
	</div>
	<div class="inbox-form-group mail-to">
		<label class="control-label">To:</label>
		<div class="controls controls-to">
			<select id="select2_user" name="to[]" class="form-control select2" multiple required>
			@foreach($customers->get() as $customer)
				<option value="{{ $customer->id }}">{{ $customer->first_name . " " . $customer->last_name }}</option>
			@endforeach
			</select>
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
			<input type="email" name="cc" class="form-control">
		</div>
	</div>
	<div class="inbox-form-group input-bcc display-hide">
		<a href="javascript:;" class="close">
		</a>
		<label class="control-label">Bcc:</label>
		<div class="controls controls-bcc">
			<input type="email" name="bcc" class="form-control">
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
					'id'=>'email_subject',
					'required'
				)
			);
		}}
		</div>
	</div>
	<div class="inbox-form-group">
		<label class="control-label">Files:</label>
		<div class="controls">
			<select id="client_files" multiple name="client_files[]" class="select2 form-control">
	            <?php 
	            $client_files = \CustomerFiles\CustomerFilesEntity::get_instance()->getFilesByUser(\Auth::id());
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
	<!-- <div class="inbox-compose-attachment">
		<span class="btn green fileinput-button">
		<i class="fa fa-plus"></i>
		<span>
		Add files... </span>
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
		<button type="button" data-dismiss="modal" class="btn inbox-discard-btn">Cancel</button>
		<button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
	</div>
</form>
<!-- modal for sending email -->
  <div class="modal fade mySmallModalLabel" id="send-email-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content container-fluid">
              <div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal">
                		  <span aria-hidden="true">x</span>
                		  <span class="sr-only">Close</span>
                	</button>
              	  <h4 class="modal-title">Send Email</h4>
              </div>
            <div class="modal-body">
                <div class="row">
        	      	<div class="col-md-12">
                    <?php $templates = \EmailTemplate\EmailTemplateEntity::get_instance()->getTemplatesByLoggedUser(); ?>

                    @if(count($templates)>0)
                      <div class="row">
                        <div class="col-md-6">
                          <label for="email_template" class="control-label">Select Template (if required):</label>
                          <select id="email_template" name="email_template" class="form-control">
                            <option value="">No template required</option>
                            @foreach($templates as $template)
                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    @endif
                      <div class="row">
                        <div class="col-md-6">
                          <label for="email_to" class="control-label">To:</label>
                          <input type="text" name="email_to" class="form-control" />
                        </div>
                        <div class="col-md-6">
                          <label for="email_subject" class="control-label">Subject:</label>
                          <input type="text" name="email_subject" class="form-control" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="email_body" class="control-label">Email Body:</label>
                          {{
                            Form::textarea
                            (
                              'email_body', '', array('class' => 'form-control', 'required' => 'required')
                            )
                          }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="email_files" class="control-label">Attach Files:</label>
                          <select name="email_files" class="form-control">
                            <option></option>
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
                      <?php $emailsignatures = \EmailSignature\EmailSignatureEntity::get_instance()->getEmailSignaturesByLoggedUser(); ?>

                      @if(count($emailsignatures)>0)
                      <div class="row">
                        <div class="col-md-6">
                          <label for="email_signature" class="control-label">Select Signature (applied when sent):</label>
                          <select id="email_signature" name="email_signature" class="form-control">
                            <option value="">No signature required</option>
                            @foreach($emailsignatures as $signature)
                            <option value="{{ $signature->id }}">{{ $signature->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      @endif
        	      	</div>
                </div>
              	<div class="row" style="margin-top:15px;">
          	      	<div class="col-md-12">
                        <button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
              	      	<button type="button" class="btn blue">Send</button>
          	      	</div>
              	</div>
            </div>

          </div>
      </div>
  </div>
  <!-- end modal -->

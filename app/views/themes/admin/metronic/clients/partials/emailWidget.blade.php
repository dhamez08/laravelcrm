@section('head-custom-css')
  @parent
  <link href="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.css">
  <link href="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
@stop
<div class="modal fade emailMessage" tabindex="-1" role="dialog" aria-labelledby="emailMessage" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="ModalLabel">Send Email Message to {{$currentClient->displayCustomerName()}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <!-- Start Email Compose -->
                <form class="inbox-compose form-horizontal" id="fileupload" action="{{url('email/client',array('customer'=>$customer->id))}}" method="POST" enctype="multipart/form-data">
                  {{ Form::token() }}
                  <input type="hidden" name="template_type" value="text" />
                  <input type="hidden" name="template_id" value="" />
                  <input type="hidden" name="to_name" value="{{ $currentClient->displayCustomerName() }}" />
                  <input type="hidden" name="client_ref" value="[REF:{{ $customer->ref }}]" />
                  <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
                  <div class="inbox-compose-btn">
                    <button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
                    <button type="button" data-dismiss="modal" class="btn inbox-discard-btn">Cancel</button>
                    <button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
                  </div>
                  <div class="inbox-form-group mail-to">
                    <label class="control-label">To:</label>
                    <div class="controls controls-to">
                      <select id="select2_user2" class="select2" multiple placeholder="Select Customer's Email" style="width:720px;" name="mailcustomer">
                        @if( $email->count() > 0 )
                          @foreach($email->get() as $mail)
                            <option value="{{ $customer->id }}" selected="selected">{{ $mail->email }}</option>
                          @endforeach
                       @endif
                      </select>
						<span class="inbox-cc-bcc" style="cursor: pointer">
							<span class="inbox-to">To<small>(any email)</small></span>
							<span class="inbox-cc">	Cc </span>
							<span class="inbox-bcc">Bcc </span>
						</span>
                      <input type="hidden" name="to[]" value="{{ $customer->id }}" />
                      </div>
					
                    </div>
				  <div class="inbox-form-group input-to display-hide">
						  <a href="javascript:;" class="close" style="margin-top:40px;margin-right:5px">;
                        </a>
                        <label class="control-label">To (any email):</label>
                        <div class="controls controls-to">
                          <input type="text" name="mailto" class="form-control">
                        </div>
                      </div>
                      <div class="inbox-form-group input-cc display-hide">
						  <a href="javascript:;" class="close" style="margin-top:40px;margin-right:5px">;
                        </a>
                        <label class="control-label">Cc:</label>
                        <div class="controls controls-cc">
                          <input type="text" name="cc" class="form-control">
                        </div>
                      </div>
                      <div class="inbox-form-group input-bcc display-hide">
                        <a href="javascript:;" class="close" style="margin-top:40px;margin-right:5px">
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
                      <?php
                        $templates = \EmailTemplate\EmailTemplateEntity::get_instance()->getTemplatesByLoggedUser();
                        $html_templates = \User\User::find(\Auth::id())->userEmailTemplate()->get();
                      ?>
                        @if(count($templates)>0)

                      <div class="inbox-form-group">
                        <label class="control-label">Template:</label>
                        <div class="controls">
                          <select id="email_template" name="email_template" class="form-control">
                            <option data-template-type="text" value="">No template required</option>
                            <option value="" disabled>Plain Text</option>
                            @foreach($templates as $template)
                            <option data-template-type="text" value="{{ $template->id }}">{{ $template->name }}</option>
                            @endforeach
                            <option value="" disabled>HTML Template</option>
                            @foreach($html_templates as $html_template)
                            <option data-template-type="html" value="{{ $html_template['id'] }}">{{ $html_template['name'] }}</option>
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
                      <iframe id="template-view" style="width:100%; margin-top:20px; height: 500px" seamless="true" class="html hide"></iframe>
                      <div id="text-view" class="inbox-form-group row">
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
                  <div class="inbox-compose-btn">
                  <button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
                  <button type="button" data-dismiss="modal" class="btn inbox-discard-btn">Cancel</button>
                  <button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
                </div>
              </form>
            <!-- End Email Compose -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@section('footer-custom-js')
  @parent
  <script src="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
  <script src="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
  <script src="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>

  <script src="{{$asset_path}}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="{{$asset_path}}/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <!--<script type="text/javascript" src="{{$asset_path}}/global/plugins/select2/select2.min.js"></script>-->
  <script type="text/javascript" src="{{$asset_path}}/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script src="{{$asset_path}}/pages/scripts/components-dropdowns.js"></script>
  <script src="{{$asset_path}}/pages/scripts/ui-blockui.js"></script>

  <script>
  var BASE_URL = '{{ url('/') }}';
  var ASSET_PATH = '{{$asset_path}}';
  var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';
  </script>

  <script src="{{$asset_path}}/pages/scripts/client-email.js?v=0.4" type="text/javascript"></script>
  <script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
  <script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {
    ComponentsEditors.init();
    ClientEmail.init();

    ComponentsDropdowns.init();
  });
  </script>
@stop

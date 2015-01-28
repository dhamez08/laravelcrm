@section('head-custom-css')
  @parent
  <link href="{{$asset_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.css">
  <link href="{{$asset_path}}/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
  <link href="{{$asset_path}}/pages/css/email-marketing.css" rel="stylesheet"/>
  <link href="{{$asset_path}}/pages//css/portfolio.css" rel="stylesheet"/>
@stop
<div class="modal fade emailMessage" tabindex="-1" role="dialog" aria-labelledby="emailMessage" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="ModalLabel">Send Marketing Email</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <!-- Start Email Compose -->
                <form class="inbox-compose form-horizontal" id="fileupload" action="" method="POST" enctype="multipart/form-data">
                  {{ Form::token() }}
                  <input type="hidden" name="to_name" value="" />
                  <input type="hidden" name="client_ref" value="" />
                  <input type="hidden" name="customer_id" value="" />
                  <div class="inbox-compose-btn">
                    <button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
                    <button type="button" data-dismiss="modal" class="btn inbox-discard-btn">Cancel</button>
                  </div>
                  <div class="inbox-form-group mail-to">
                    <label class="control-label">Select Customer(s):</label>
                    <div class="controls controls-to">
                      <select id="select2_user" class="form-control select2" placeholder="Select Customer's Email">
                          @if (count($customer_emails) > 0)
                              @foreach($customer_emails as $mail)
                                <option value="{{ $mail['id']}}" data-fullname="{{ $mail['fullname']}}" data-email="{{ $mail['email'] }}" selected="selected">{{$mail['fullname']}} - {{ $mail['email'] }}</option>
                              @endforeach
                          @endif
                      </select>
                      </div>
                      </div>
                    <div class="inbox-form-group mail-to">
                        <label class="control-label">To:</label>
                        <div class="controls controls-to">
                            <ul class="mix-filter" id="email-list">

                            </ul>
                            <input type="hidden" name="to[]" value="" />
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
                        <label class="control-label">Template:</label>
                        <div class="controls">
                          <select id="email_template" name="email_template" class="form-control">
                            <option value="">Textile Template</option>

                          </select>
                        </div>
                      </div>

                      <div class="inbox-form-group row template-preview-container">
                        <!-- <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea> -->
                        <div class="col-md-12">
                          <iframe seamless="seamless" class="template-preview" src="{{asset('public/documents/templates/textile/right_sidebar.html')}}"></iframe>
                        </div>
                      </div>
                  <div class="inbox-compose-btn">
                  <button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
                  <button type="button" onclick="history.back(-1);" class="btn inbox-discard-btn">Cancel</button>
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
    <script src="{{$asset_path}}/pages/scripts/marketing-email.js" type="text/javascript"></script>
    <script>
        MarketingEmail.init();
    </script>
@stop

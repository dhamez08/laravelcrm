@extends( $dashboard_index )
@section('begin-head')
@parent
@section('head-page-level-css')
    @parent
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{$asset_path}}/pages//css/portfolio.css" rel="stylesheet"/>
    <link href="{{$asset_path}}/pages//css/email-marketing.css" rel="stylesheet"/>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop
@stop

@section('body-content')
@parent
@section('innerpage-content')
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
                <label class="control-label">To:</label>
                <div class="controls controls-to">
                    <select id="select2_user" class="form-control select2" placeholder="Select Customer's Email">
                        @if (count($customer_emails) > 0)
                            @foreach($customer_emails as $mail)
                                <option value="{{ $mail['id']}}" selected="selected">{{$mail['fullname']}} - {{ $mail['email'] }}</option>
                            @endforeach
                        @endif

                    </select>
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
                <label class="control-label">Files:</label>
                <div class="controls">
                    <select id="client_files" name="client_files" class="form-control">

                    </select>
                </div>
            </div>

            <div class="inbox-form-group">
                <label class="control-label">Template:</label>
                <div class="controls">
                    <select id="email_template" name="email_template" class="form-control">
                        <option value="">No template required</option>

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
                <button type="submit" name="btn_action" value="draft" class="btn">Draft</button>
            </div>
        </form>
        <!-- End Email Compose -->
    </div>
</div>
@stop
@stop
@section('script-footer')
@parent
@section('footer-custom-js')
@parent
@stop
@stop

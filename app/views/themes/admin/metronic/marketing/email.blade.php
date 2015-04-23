@extends( $dashboard_index )
@section('begin-head')
@parent
@section('head-page-level-css')
@parent
<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.css">

@stop
@stop

@section('body-content')
@parent
@section('innerpage-content')
<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
    <div class="portlet-title">
        <div class="caption">
            @section('portlet-captions')
            {{{$portlet_title or 'Portlet Title'}}}
            @show
        </div>
    </div>
    <div class="portlet-body {{{$portlet_body_class or ''}}}">
        <div class="portlet-tabs">
            <div class="tab-content">
                @section('portlet-content')
                {{ Form::open(
                        array(
                            'url' => 'marketing/send-email',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'role'=>'form',
                        )
                    )
                }}
                <div class="row-fluid">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Enter your message below</h3>
                            </div>
                            <div class="panel-body">
                                {{--
                                <div class="alert alert-warning">
                                    If you would like each message to start with "Hi <i>FirstName</i>.", pleach check the box below. Please remember that this will increase the character count so it may require additional SMS credits to send. A summary of the message is provided in the next page.
                                </div>
                                --}}

                                <span class="hidden"><input type="checkbox" name="personalised" /> Personalise message</span>
                                <div class="form-group" style="margin-left:0px">
                                    <label>Subject</label>
                                    <input type="text" class="form-control input-large" name="subject"/>
                                    @foreach($emails as $email)
                                        <input type="hidden" name="email[]" value="{{$email}}"/>
                                    @endforeach
                                </div>

                                <div class="form-group" style="margin-left:0px">
                                    <label>Template Type</label>
                                    <select class="form-control input-large" id="template-type" name="template_type">
                                        <option value="0" disabled="true">Select Template</option>
                                        <option value="plain">Plain Text</option>
                                        <option value="html">HTML Template</option>
                                    </select>
                                </div>


                                <div class="form-group html hide" style="margin-left:0px">
                                    <label>Select Template</label>
                                    <select class="form-control input-large" id="user_email_template" name="template_id">
                                        <option value="0" disabled="true" selected="true">Select Template</option>
                                        @foreach(\User\User::find(\Auth::id())->userEmailTemplate()->get() as $template)
                                            <option value="{{$template['id']}}">{{$template['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group plain-text" style="margin-left:0px">
                                    <label>Select Template</label>
                                    <select class="form-control input-large" id="personal_email_template" name="personal_template_id">
                                        <option value="0">Select Template</option>
                                        @foreach(\User\User::find(\Auth::id())->emailTemplate()->where('type',2)->get() as $template)
                                            <option value="{{$template->id}}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <textarea rows="7" style="width:100%; margin-top:20px" id="message" name="message" class="plain-text" placeholder="Enter your message ...">{{ \Session::get('sms_session.message') }}</textarea>
                                        <iframe id="template-view" style="width:100%; margin-top:20px; height: 500px" seamless="true" class="html hide"></iframe>
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
                                            <div style="height:230px;overflow-y:scroll" data-always-visible="0" data-rail-visible="0" data-rail-color="red" data-handle-color="green">
                                                <table class="table table-bordered table-hover">
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <p id="sms_message_counter"></p>-->
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ url('marketing/send-client-email') }}" class="btn blue">Back</a>
                {{Form::submit('Send Email',array('class'=>"btn blue"))}}
                {{ Form::close()}}
                @show
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
<script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script>
    $('#message').summernote({height: 300});
    $('#template-type').change(function(){
        var template_type = $(this).val();
        if(template_type == 'html'){
            $('.html').removeClass('hide');
            $('.plain-text').addClass('hide');
            $('.note-editor').addClass('hide');
        } else if(template_type == 'plain') {
            $('.html').addClass('hide');
            $('.plain-text').removeClass('hide');
            $('.note-editor').removeClass('hide');
        }
    });

    $("select#custom_form").live("change", function() {
        $this = $(this);
        $("#fields_container table tbody").html('');
        //show loading
        Metronic.blockUI({
            target: '#fields_container',
            boxed: true,
            message: 'Processing...'
        });

        var row='';
        $.get(baseURL+'/settings/custom-forms/fields/'+$this.val(), function(response) {
            var form_name = response.form.name;
            $.each(response.build, function(i, item) {
                //row+='<tr><td><input type="text" value="['+form_name+':'+item.field_name+']" class="form-control" style="border:0px" /></td></tr>';
                if($this.val()=='customer')
                    row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+item.field_name+'}</a></td></tr>';
                else
                    row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">['+form_name+':'+item.field_name+']</a></td></tr>';
            });

            $("#fields_container table tbody").append(row);

            Metronic.unblockUI('#fields_container');
        }).error(function() {
            Metronic.unblockUI('#fields_container');
        });
    });

    $('#user_email_template').change(function(){
        var data = new Object();
        data.template_id = $(this).val();

        $.ajax({
            type: "GET",
            url: 'ajax-edit-template',
            data: data,
            success: function(response)
            {
                var body = $('#template-view').contents().find('body');
                body.html('');
                body.append('<style>'+response.style+'</style>');
                body.append(response.source_code);
            },
            dataType: 'json'
        });
    });

    var isValid = 0;

    $("input[name=subject]").live("click", function() {
        isValid = 1;
        console.log('test');
    });

    $(document).click(function(event) {
        if(!$(event.target).closest('input[name=subject]').length) {
            isValid = 0;
        }
    });

    $("a.custom_form_link").live("click", function() {
        console.log(isValid)
        if(isValid==1) {
            var selection = document.getSelection();
            var cursorPos = selection.anchorOffset;
            var oldContent = selection.anchorNode.nodeValue;
            var toInsert = $(this).html();
            if(oldContent!=null) {
                var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
                selection.anchorNode.nodeValue = newContent;
            } else {
                $("input[name=subject]").val($("input[name=subject]").val()+''+toInsert+'');
            }
        }
    });

    $('#personal_email_template').change(function(){
        $.ajax({
            type: "GET",
            url: 'personal-template/'+$(this).val(),
            success: function(response)
            {
                $('#message').val(response.body);
                $('#message').code(response.body);
            },
            dataType: 'json'
        });
    });
</script>
@stop
@stop

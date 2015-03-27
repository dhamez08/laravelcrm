@extends( $dashboard_index )
@section('begin-head')
@parent
@section('head-page-level-css')
@parent
<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
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
                                    <label>Template Type</label>
                                    <select class="form-control input-large" id="sms_template">
                                        <option value="0" disabled="true">Select Template</option>
                                        <option value="">Plain Text</option>
                                        <option value="">HTML Template</option>
                                    </select>
                                </div>


                                <div class="form-group" style="margin-left:0px">
                                    <label>Select Template</label>
                                    <select class="form-control input-large" id="user_email_template">
                                        <option value="0">Select Template</option>
                                        @foreach(\User\User::find(\Auth::id())->userEmailTemplate()->get() as $template)
                                            <option>{{$template['id']}}</option>
                                        @endforeach
                                    </select>
                                </div>

<!--                                <textarea rows="7" style="width:100%; margin-top:20px" id="message" name="message" placeholder="Enter your message ...">{{ \Session::get('sms_session.message') }}</textarea>-->
                                <iframe id="template-view" style="width: 960px; height: 500px" seamless="true"></iframe>
<!--                                <p id="sms_message_counter"></p>-->
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ url('marketing/send-client-email') }}" class="btn blue">Back</a>
                {{Form::submit('Next Step',array('class'=>"btn blue"))}}
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
<script>
    $('#user_email_template').change(function(){
        var data = new Object();
        data.template_id = $(this).val();

        $.ajax({
            type: "GET",
            url: 'ajax-edit-template',
            data: data,
            success: function(response)
            {
                console.log(response.source_code);

                var body = $('#template-view').contents().find('body');
                body.html('');
                body.append(response.source_code);
            },
            dataType: 'json'
        });
    });
</script>
@stop
@stop

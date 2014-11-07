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
						@if( count($list_number) > 0 )
						<div class="row-fluid">
							<div class="span12 well">
								<h5 style="margin-top:0px;">Attach File</h5>
								{{\File\ClientFileController::get_instance()->getMediaWidget(\Auth::id())}}
							</div>
						</div>
						{{ Form::open(
							array(
									'action' => array('Marketing\MarketingController@postSendSmsVerify'),
									'method' => 'POST',
									'class' => 'form-horizontal',
									'role'=>'form',
								)
							)
						}}
							<div class="row-fluid">
								<div class="span12 well">
									<h5 style="margin-top:0px;">Attach File</h5>
									<div class="file-list">
										@if( $sms_files->count() > 0 )
											<select name="attach_file[]" multiple>
												@foreach($sms_files->get() as $files)
													<option value="{{$files->id}}">
														{{$files->file}}
													</option>
												@endforeach
											</select>
										@else
												<h4>Upload file first click "Add new"</h4>
										@endif
									</div>
								</div>
							</div>

							<div class="row-fluid">
								<div class="span12 well">
									<h5 style="margin-top:0px;">Personalised Message</h5>
									If you would like each message to start "Hi <i>First Name</i>." please tick the box below. Please remember this will increase the character count, so may require additional sms credits to send. We will give you a summary on the next page.
									<input type="checkbox" name="personalised" />
								</div>
							</div>

							<div class="row-fluid">
								<div class="span12 well">
									<h5 style="margin-top:0px;">Enter your message below</h5>
									<textarea rows="7" style="width:70%;" id="message" name="message" placeholder="Enter your message ..."></textarea>
									<p id="sms_message_counter"></p>
								</div>
							</div>
							{{Form::submit('Next Step',array('class'=>"btn blue"))}}
						{{ Form::close()}}
						@endif
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
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/sms-files.js"></script>
	<script>
	$(document).ready(function(){
		SMSFileUpload.init(baseURL + '/smsfile/ajax-files');
		$("#message").keyup(function() {
			var smsCount = $("#message").val().length;
			var smsNeeded = Math.ceil(smsCount/160);
			$("#sms_message_counter").html("Character count without personalised message is <strong>"+smsCount+"</strong> and will use "+smsNeeded+" credits per message.");
		});
	});
	</script>
	@stop
@stop

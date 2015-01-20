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
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Upload File</h3>
									</div>									
									<div class="panel-body">
										{{\File\ClientFileController::get_instance()->getMediaWidget(\Auth::id())}}
									</div>
								</div>
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
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Files List</h3>
									</div>									
									<div class="panel-body">
										{{ Form::open(
											array(
													'action' => array('Marketing\MarketingController@postSendSmsVerify'),
													'method' => 'POST',
													'class' => 'form-horizontal',
													'role'=>'form',
												)
											)
										}}

										<div class="alert alert-warning">
											Select file(s) to be attached in your SMS message If your file is not on the list, upload it using the tool above.
										</div>

										<table class="table table-condensed">
											<tbody>
											@if( count($sms_files) > 0 )
												@foreach($sms_files as $files)
												<tr>
													<td style="width:1%">{{ Form::checkbox('attach_file[]', $files->id) }}</td>
													<td style="width:1%">{{ $files->file }}</td>
													<td><a href="{{ url('public/documents/' . $files->file) }}" target="_blank">View File</a></td>
												</tr>
												@endforeach
											@endif		
											</tbody>
										</table>


										
									</div>
								</div>								
							</div>
						</div>

						<div class="row-fluid">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Enter your message below</h3>
									</div>
									<div class="panel-body">

										<div class="alert alert-warning">
											If you would like each message to start with "Hi <i>FirstName</i>.", pleach check the box below. Please remember that this will increase the character count so it may require additional SMS credits to send. A summary of the message is provided in the next page.
										</div>

										<input type="checkbox" name="personalised" /> Personalise message
										
										<textarea rows="7" style="width:100%; margin-top:20px" id="message" name="message" placeholder="Enter your message ..."></textarea>
										<p id="sms_message_counter"></p>
									</div>										
								</div>
							</div>
						</div>

						<a href="{{ url('marketing/send-client-sms') }}" class="btn blue">Back</a> 
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

<div class="modal-header">
	<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
	<h4 class="modal-title">{{$pageTitle}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			{{Form::open(
					array(
						'action' => array(
							'SMS\SMSController@postAjaxUploadFile'
						),
						'role'=>'form',
						'files'=> true,
						'class'=>'form-horizontalx',
						'id'=>'sms-file-upload'
					)
				)
			}}
				<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							{{Form::file('smsfile')}}
							<span class="help-block">You can upload file here if its not available in the "file attach dropdown"</span>
							<button type="submit" data-loading-text="Please wait file is uploading..." autocomplete="off" class="btn btn-primary btn-xs file-attach">Upload File</button>
							<div class="ajax-container-msg-file-attach hide" >
								<ul class="list-group ajax-error-msg">
									<li class="list-group-item list-group-item-danger">asd</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				{{Form::hidden('customerid',$customerId,array('id'=>'customerid'))}}
			{{Form::close()}}
			{{ Form::open(
				array(
						'action' => array(
							'SMS\SMSController@postAjaxSendIndividualSms',
							'customerid'=>$customerId
						),
						'method' => 'POST',
						'role'=>'form',
						'id'=>'sendIndividualSMS'
					)
				)
			}}
			<div class="form-group">
				<label>Mobile Number</label>
				{{Form::hidden('mobile_number',$mobile_number)}}
				<p>{{$mobile_number}}</p>
			</div>
			<div class="form-group">
				<label>SMS</label>
				{{Form::textarea(
					'note',
					null,
					array(
							'class'=>'form-control',
							'id'=>'message'
						)
					)
				}}
				<p id="sms_message_counter"></p>
			</div>
			<div class="alert alert-success success-file-attach alert-dismissible hide" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Success!</strong> <p class="success-msg"></p>
			</div>
			<div class="form-group">
				<label>Choose File to attach</label>
				<div class="file-list">
					@if( $customerFiles->count() )
						<select name="attach_file" style="width:80%;">
							<option value="0">Select File</option>
							@foreach($customerFiles->get() as $files)
								<option value="{{$files->id}}">{{$files->filename}}</option>
							@endforeach
						</select>
					@endif
				</div>
			</div>
			<button type="submit" class="btn btn-primary send-individual-sms" data-loading-text="Please wait sending SMS..." autocomplete="off">Send SMS</button>
			<div class="ajax-container-msg hide" >
			  	<ul class="list-group ajax-error-msg">
			  	</ul>
			</div>
			{{Form::hidden('customerid',$customerId,array('id'=>'customerid'))}}
			{{Form::hidden('redirect',null,array('id'=>'redirect'))}}
			{{Form::close()}}
		</div>
	</div>
</div>
<div class="modal-footer">
	<button data-dismiss="modal" class="btn default" type="button">Close</button>
</div>
<script type="text/javascript" src="{{$asset_path}}/pages/scripts/sms-files.js"></script>
<script>
jQuery(document).ready(function(){
	SMSFileUpload.init(baseURL + '/sms/ajax-files/' + '<?php echo $customerId; ?>');
	jQuery("#message").keyup(function() {
		var smsCount = jQuery("#message").val().length;
		var smsNeeded = Math.ceil(smsCount/160);
		jQuery("#sms_message_counter").html("Character count without personalised message is <strong>"+smsCount+"</strong> and will use "+smsNeeded+" credits per message.");
	});
});
</script>

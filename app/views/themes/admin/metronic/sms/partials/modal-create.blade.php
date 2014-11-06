<div class="modal-header">
	<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
	<h4 class="modal-title">{{$pageTitle}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open(
				array(
						'action' => array(
							'SMS\SMSController@postAjaxSendIndividualSms',
							'customerid'=>$customerId
						),
						'method' => 'POST',
						'role'=>'form',
						'files' => true,
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
			<div class="form-group">
				<label>Choose File to attach</label>
				@if( $customerFiles->count() )
					<select name="attach_file">
						<option value="0">Select File</option>
						@foreach($customerFiles->get() as $files)
							<option value="{{$files->id}}">{{$files->filename}}</option>
						@endforeach
					</select>
				@endif
			</div>
			<div class="form-group">
				<label>Attach File</label>
				{{Form::file('smsfile')}}
			</div>
			<button type="submit" class="btn btn-primary" id="sendIndividualSMS">Send SMS</button>
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
<script>
jQuery(document).ready(function(){
	jQuery("#message").keyup(function() {
		var smsCount = jQuery("#message").val().length;
		var smsNeeded = Math.ceil(smsCount/160);
		jQuery("#sms_message_counter").html("Character count without personalised message is <strong>"+smsCount+"</strong> and will use "+smsNeeded+" credits per message.");
	});
});
</script>

@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- END PAGE LEVEL SCRIPTS -->
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
						{{ Form::open(
							array(
									'action' => array('Marketing\MarketingController@postSendSms'),
									'method' => 'POST',
									'class' => 'form-horizontal',
									'role'=>'form',
								)
							)
						}}
							<div class="row-fluid">
								<div class="span8 well">
									<div class="row-fluid">
										<div class="span12 well">
											<h5 style="margin-top:0px;">Message Recipient(s)</h5>
											@if( count($list_number) > 0 )
												@foreach($list_number as $val)
													<p>{{$index_num++}}) {{$val['number']}}</p>
												@endforeach
												<hr>
												<p>Total Recipients : {{count($list_number)}}</p>
												<p>Required Credits : {{$sms_session['required_credits']}}</p>
											@endif
										</div>
									</div>
								</div>
							</div>

							<div class="row-fluid">
								<div class="span12 well">
									<h5 style="margin-top:0px;">Message Body</h5>
									@if($sms_session['personalised'])
										<p>Hi <em>First Name</em></p>
									@endif
									<p>{{$sms_session['message']}}</p>
								</div>
							</div>
							<a href="{{ url('marketing/message-sms') }}" class="btn blue">Back</a> 
							{{Form::submit('Send Message',array('class'=>"btn blue"))}}
							{{(\Textlocal\TextlocalEntity::get_instance()->getSendSmsTest()) ? 'Test mode':''}}
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
	<script>
	$(document).ready(function(){

		$("#message").keyup(function() {
			var smsCount = $("#message").val().length;
			var smsNeeded = Math.ceil(smsCount/160);
			$("#sms_message_counter").html("Character count without personalised message is <strong>"+smsCount+"</strong> and will use "+smsNeeded+" credits per message.");
		});
	});
	</script>
	@stop
@stop

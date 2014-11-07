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
					<h3>Current SMS credit : {{$sms_credit}}</h3>
					{{(\Textlocal\TextlocalEntity::get_instance()->getSendSmsTest()) ? 'Test mode':''}}
					@section('portlet-content')
						<table class="table table-striped table-advance table-hover">
							<thead>
								<tr>
									<th>Date</th>
									<th>To</th>
									<th>From</th>
									<th>Message</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@if( $sms_sent->count() > 0 )
									@foreach($sms_sent->get() as $report_item)
										<tr>
											<td>{{$report_item->created_at}}</td>
											<td>{{$report_item->textlocal_msg_recipient}}</td>
											<td>{{$report_item->from}}</td>
											<td>{{$report_item->message}}</td>
											<td>
												{{--
													\SMSReport\SMSReportEntity::get_instance()->getMsgStatus(\Textlocal\TextlocalEntity::get_instance()->getMsgStatusID($report_item->textlocal_msg_id))
												--}}
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					@show
					@if( $sms_credit > 0 )
						<a href="{{url('marketing/send-client-sms')}}" class="btn btn-primary">Send SMS</a>
					@endif
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
	@stop
@stop

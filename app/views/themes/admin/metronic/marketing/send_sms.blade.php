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
						{{-- @if( $list_customer->count() > 0 ) --}}
							{{Form::open(
								array(
									'action' => array('Marketing\MarketingController@getSendClientSms'),
									'method' => 'GET',
									'class' => 'form-horizontal',
									'role'=>'form',
								)
							)}}
								@if( $tags )
									<label>Tags: </label>
									{{
										Form::select(
											'tags',
											array('0'=>'Select') + $tags->lists('tag','id'),
											isset($tag_id) ? $tag_id:null
										);
									}}
								@endif
								&nbsp;&nbsp;
								<label>Age: </label>
								{{ Form::number('age_min', \Input::get('age_min'), array('placeholder' => 'Minimum Age')) }} - {{ Form::number('age_max', \Input::get('age_max'), array('placeholder' => 'Maximum Age')) }}
								&nbsp;&nbsp;
								<label>Marital Status: </label>
								{{ Form::select('marital_status', Config::get('crm.marital_status'), \Input::get('marital_status')) }}
								{{Form::submit('Apply Filters',array('class'=>"btn blue btn-xs"))}}
							{{Form::close()}}
							<p></p>
							{{ Form::open(
								array(
										'action' => array('Marketing\MarketingController@postSendSmsMessage'),
										'method' => 'POST',
										'class' => 'form-horizontal',
										'role'=>'form',
									)
								)
							}}
								<table class="table table-striped table-advance table-hover">
									<thead>
										<tr>
											<th>
												<input type="checkbox" id="check_all_customers">
												Person's Name and Mobile Number
											</th>
										</tr>
									</thead>
									<tbody>
										@foreach( $list_customer->get() as $val_customer)
											@if( $val_customer->telephone->count() == 1 )
												<tr>
													<td>
														@if( is_null($tag_id) )

																<input type="checkbox" name="sendsms[{{$val_customer->id}}][clientid]" value="{{$val_customer->id}}" {{ !empty($checked_customers[$val_customer->id]) ? 'checked' : '' }} />
																{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}
																@foreach($val_customer->telephone as $phone)
																	<span class="label label-info"><i class="fa fa-mobile"></i> {{$phone->number}}</span>
																	<input type="hidden" name="sendsms[{{$val_customer->id}}][number]" value="{{$phone->number}}" />
																	<input type="hidden" name="sendsms[{{$val_customer->id}}][name]" value="{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}" />
																@endforeach
														@else
															@if( in_array($tag_id,$val_customer->my_tag->lists('tag_id')) )
																	<input type="checkbox" name="sendsms[{{$val_customer->id}}][clientid]" value="{{$val_customer->id}}" {{ !empty($checked_customers[$val_customer->id]) ? 'checked' : '' }} />
																	{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}
																	@foreach($val_customer->telephone as $phone)
																		<span class="label label-info"><i class="fa fa-mobile"></i> {{$phone->number}}</span>
																		<input type="hidden" name="sendsms[{{$val_customer->id}}][number]" value="{{$phone->number}}" />
																		<input type="hidden" name="sendsms[{{$val_customer->id}}][name]" value="{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}" />
																	@endforeach
															@endif
														@endif
													</td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
								<a href="{{ url('marketing') }}" class="btn blue">Back</a> 
								@if( $sms_credit > 0 )
									{{Form::submit('Next Step',array('class'=>"btn blue"))}}
								@endif
							{{ Form::close()}}
							{{-- @endif --}}
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
	<script type="text/javascript">
	$('#check_all_customers').change(function() {
		var table_body = $(this).closest('table').find('tbody');
		var checkedClass = $(this).is(":checked") ? 'checked' : '';
		table_body.find('input[type="checkbox"]').prop('checked', $(this).is(":checked"));
		table_body.find('input[type="checkbox"]').uniform({checkedClass: checkedClass});
	});
	</script>
	@stop
@stop

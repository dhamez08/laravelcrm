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
						@if( $list_customer->count() > 0 )
							{{Form::open(
								array(
									'action' => array('Marketing\MarketingController@getIndex'),
									'method' => 'GET',
									'class' => 'form-horizontal',
									'role'=>'form',
								)
							)}}
								@if( $tags )
									{{
										Form::select(
											'tags',
											array_merge(array('0'=>'Select All'),$tags->lists('tag','id')),
											isset($tag_id) ? $tag_id:null
										);
									}}
								@endif
								{{Form::submit('Filter Client by tag',array('class'=>"btn blue btn-sm"))}}
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

																<input type="checkbox" name="sendsms[{{$val_customer->id}}][clientid]" value="{{$val_customer->id}}" />
																{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}
																@foreach($val_customer->telephone as $phone)
																	<input type="hidden" name="sendsms[{{$val_customer->id}}][number]" value="{{$phone->number}}" />
																	<input type="hidden" name="sendsms[{{$val_customer->id}}][name]" value="{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}" />
																@endforeach
														@else
															@if( in_array($tag_id,$val_customer->my_tag->lists('tag_id')) )
																	<input type="checkbox" name="sendsms[{{$val_customer->id}}][clientid]" value="{{$val_customer->id}}" />
																	{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}
																	@foreach($val_customer->telephone as $phone)
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
								@if( $sms_credit > 0 )
									{{Form::submit('Next Step',array('class'=>"btn blue"))}}
								@endif
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
	@stop
@stop

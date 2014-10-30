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
						<h1>Form</h1>
						@if( $list_customer->count() > 0 )
						{{ Form::open(
							array(
									'action' => array('Marketing\MarketingController@postSendSmsMessage'),
									'method' => 'POST',
									'class' => 'form-horizontal',
									'role'=>'form',
								)
							)
						}}
							<ul class="">
								@foreach( $list_customer->get() as $val_customer)
									@if( $val_customer->telephone->count() == 1 )
										<li>
											<input type="checkbox" name="sendsms[{{$val_customer->id}}][clientid]" value="{{$val_customer->id}}" />
											{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}
											@foreach($val_customer->telephone as $phone)
												<input type="hidden" name="sendsms[{{$val_customer->id}}][number]" value="{{'44' . substr($phone->number, 1)}}" />
												<input type="hidden" name="sendsms[{{$val_customer->id}}][name]" value="{{$val_customer->title}} {{$val_customer->first_name}} {{$val_customer->last_name}}" />
												- {{'44' . substr($phone->number, 1)}}
											@endforeach
										</li>
									@endif
								@endforeach
							</ul>
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
	@stop
@stop

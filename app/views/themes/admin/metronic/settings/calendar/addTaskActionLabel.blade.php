@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			{{ Form::open(
				array(
						'action' => array('Settings\TaskLabelController@postAddActionLabel'),
						'method' => 'POST',
						'role'=>'form',
						'class'=>'horizontal-form'
					)
				)
			}}
				<div class="form-body">
					<div class="col-md-12">
						{{Form::submit('Add Action Label',array('class'=>'btn blue'))}}
						<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/task-label')}}">Cancel</a>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-body">
									<div class="row">
										@include( \DashboardEntity::get_instance()->getView() . '.settings.calendar.partials.taskInputLabel' )
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						{{Form::submit('Add Action Label',array('class'=>'btn blue'))}}
						<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/task-label')}}">Cancel</a>
						<p></p>
						<p></p>
					</div>
				</div>
			{{Form::close()}}
		@stop
	@stop
@stop

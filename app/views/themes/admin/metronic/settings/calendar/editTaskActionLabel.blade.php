@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			{{ Form::model(
				$task,
				array(
						'action' => array(
							'Settings\TaskLabelController@putActionLabelUpdate',
							'id'		=>	$task->id,
							'userId'	=> $task->user_id,
						),
						'method' => 'PUT',
						'role'=>'form',
						'class'=>'horizontal-form'
					)
				)
			}}

				<div class="form-body">
					<div class="col-md-12">
						{{Form::submit('Update Action Label',array('class'=>'btn blue'))}}
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
						{{Form::submit('Update Action Label',array('class'=>'btn blue'))}}
						<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/task-label')}}">Cancel</a>
						<p></p>
						<p></p>
					</div>
				</div>
			{{Form::close()}}
		@stop
	@stop
@stop

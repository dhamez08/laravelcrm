@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
	{{ Form::open(
		array(
				'action' => array('Settings\TaskLabelController@postAddActionLabel'),
				'method' => 'POST',
				'role'=>'form',
				'class'=>'form-horizontal'
			)
		)
	}}
		<div class="col-md-12">
			<div class="container-fluid">
				<div class="form-body">
					<div class="row">
						@include( \DashboardEntity::get_instance()->getView() . '.settings.calendar.partials.taskInputLabel' )
					</div>
				</div>
				<div class="form-actions">
					{{Form::submit('Add Action Label',array('class'=>'btn green'))}}
					<button class="btn default" type="button">Cancel</button>
				</div>
			</div>
		</div>
	{{Form::close()}}
	@stop
@stop

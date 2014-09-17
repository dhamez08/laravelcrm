@extends( $dashboard_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	{{ Form::open(
		array(
				'action' => array('User\UserController@postAdditionalUser'),
				'method' => 'POST',
				'role'=>'form',
				'class'=>'form-horizontal'
			)
		)
	}}
		<div class="col-md-4">
			<div class="container-fluid">
				<h3>User Information</h3>
				<div class="form-body">
					<div class="row">
						@include( \DashboardEntity::get_instance()->getView() . '.settings.users.partials.userInput' )
					</div>
				</div>
				<div class="form-actions">
					{{Form::submit('Add User',array('class'=>'btn green'))}}
					<button class="btn default" type="button">Cancel</button>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<h3>Set User Permision</h3>
			@include( \DashboardEntity::get_instance()->getView() . '.settings.users.partials.userPermission' )
		</div>
	{{Form::close()}}
	@stop
@stop

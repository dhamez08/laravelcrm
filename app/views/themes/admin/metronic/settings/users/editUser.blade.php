@extends( $dashboard_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	{{
		Form::model(
			$user,
			array(
				'action' => array('User\UserController@putAdditionalUserUpdate', $user->id),
				'method' => 'PUT'
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
				<p></p>
				<div class="form-actions">
					{{Form::submit('Update User',array('class'=>'btn green'))}}
					<button class="btn default" type="button">Cancel</button>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<h3>Set User Permision</h3>
			{{--@include( \DashboardEntity::get_instance()->getView() . '.settings.users.partials.userPermission' )--}}
		</div>
	{{Form::close()}}
	@stop
@stop

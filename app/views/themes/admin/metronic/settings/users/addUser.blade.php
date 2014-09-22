@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			{{ Form::open(
				array(
						'action' => array('User\UserController@postAdditionalUser'),
						'method' => 'POST',
						'role'=>'form',
						'class'=>'horizontal-form'
					)
				)
			}}
			<div class="form-body">
				<div class="col-md-12">
					{{Form::submit('Add User',array('class'=>"btn blue"))}}
					<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/users')}}">Cancel</a>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="container-fluid">
							<h3>User Information</h3>
							<div class="form-body">
								<div class="row">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.users.partials.userInput' )
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<h3>Set User Permision</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.settings.users.partials.userPermission' )
					</div>
				</div>
			</div>
			{{Form::close()}}
		@stop
	@stop
@stop

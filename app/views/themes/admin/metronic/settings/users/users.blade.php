@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			<a class="btn {{{$dashboard_class or 'blue'}}}" href="{{url('settings/users/add-aditional-user')}}">Add Additional User </a>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							 Name
						</th>
						<th>
							 Action
						</th>
					</tr>
				</thead>
				<tbody>
					@if( $users->count() > 0 )
						@foreach( $users->get() as $list )
							<tr>
								<td>
									<h4>
										<a href="{{action('User\UserController@getAddtionalUserEdit', $list->user->id)}}" role="button">{{$list->user->first_name}} {{$list->user->last_name}}</a>
									</h4>
								</td>
								<td>
									<a class="btn btn-warning btn-xs" href="{{$list->user->id}}" role="button">Delete</a>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		@stop
	@stop
@stop

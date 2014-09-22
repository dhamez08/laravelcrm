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
						<th colspan="2">
							 Action
						</th>
					</tr>
				</thead>
				<tbody>
					@if( $users->count() > 0 )
						@foreach( $users->get() as $list )
							<tr>
								<td>
									{{$list->user->first_name}} {{$list->user->last_name}}
								</td>
								<td>
									<a class="btn btn-primary btn-xs" href="{{action('User\UserController@getAddtionalUserEdit', $list->user->id)}}" role="button">Edit</a>
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

@extends( $dashboard_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	<div class="col-md-12">
		<h3><a href="{{url('settings/users/add-aditional-user')}}" class="btn green">Add Additional User</a></h3>
	</div>
	<div class="col-md-12">
		@if( $users->count() > 0 )
			<ul class="list-group user-list">
				@foreach( $users->get() as $list )
					<li class="list-group-item">{{$list->user->first_name}} {{$list->user->last_name}}</li>
				@endforeach
			</ul>
		@endif
	</div>
	@stop
@stop

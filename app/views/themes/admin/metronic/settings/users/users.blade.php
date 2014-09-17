@extends( $dashboard_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	<div class="col-md-12">
		<h3><a href="{{url('settings/users/add-aditional-user')}}" class="btn green">Add Additional User</a></h3>
	</div>
	@stop
@stop

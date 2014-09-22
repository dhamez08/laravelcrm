@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			<a class="btn {{{$dashboard_class or 'blue'}}}" href="{{url('settings/task-label/add-action-label')}}">Add Action Label </a>
			<table class="table table-hover">
			  <thead>
				<tr>
				  <th>Action Name</th>
				  <th>Icon</th>
				  <th>Color</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
				@if($labelAction->count() > 0)
					@foreach($labelAction->get() as $row)
							<tr>
							  <td><h4><a href="{{action('Settings\TaskLabelController@getActionLabelEdit',$row->id)}}">{{$row->action_name}}</a></h4></td>
							  <td><span><i class="fa {{$row->icons}} fa-2x"></i></span></td>
							  <td><span class="swatch" style="height: 40px;width:50px;display:inline-block;background-color: {{$row->color}}"></span></td>
							  <td><a class="btn btn-warning btn-xs" href="{{action('Settings\TaskLabelController@getDelete',$row->id)}}" onclick="return confirm('Are you sure you want to Delete this action?')">Delete</a></td>
							</tr>
					@endforeach
				@endif
			  </tbody>
			</table>
		@stop
	@stop
@stop

@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
	<div class="col-md-12">
		<h3><a href="{{url('settings/task-label/add-action-label')}}" class="btn green">Add Action Label</a></h3>
	</div>
	<div class="col-md-12">
		<div class="list-task-settings">
			<table class="table table-hover table-bordered">
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
							  <td><h2><a href="{{action('Settings\TaskLabelController@getActionLabelEdit',$row->id)}}">{{$row->action_name}}</a></h2></td>
							  <td><span><i class="fa {{$row->icons}} fa-2x"></i></span></td>
							  <td><span class="swatch" style="height: 40px;width:50px;display:inline-block;background-color: {{$row->color}}"></span></td>
							  <td><h5><a href="{{action('Settings\TaskLabelController@getDelete',$row->id)}}" onclick="return confirm('Are you sure you want to Delete this action?')">Delete</a></h5></td>
							</tr>
					@endforeach
				@endif
			  </tbody>
			</table>
		</div>
	</div>
	@stop
@stop

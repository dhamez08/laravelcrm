@extends( $settings_index )
@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
	<div class="col-md-12">
		<h3><a href="{{url('settings/task-label/add-action-label')}}" class="btn green">Add Action Label</a></h3>
	</div>
	<div class="col-md-12">

	</div>
	@stop
@stop

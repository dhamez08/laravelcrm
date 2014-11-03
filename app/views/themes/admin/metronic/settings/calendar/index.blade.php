@extends( $settings_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="{{$asset_path}}/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
		
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/select2/select2.css"/>
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/jquery-multi-select/css/multi-select.css"/>
		<!-- END PAGE LEVEL STYLES -->
	@stop
@stop
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
@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script type="text/javascript" src="{{$asset_path}}/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
	<script src="{{$asset_path}}/pages/scripts/components-dropdowns.js"></script>
	<script src="{{$asset_path}}/pages/scripts/ui-blockui.js"></script>

	<script>
	var BASE_URL = '{{ url('/') }}';
	var ASSET_PATH = '{{$asset_path}}';
	var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';
	</script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
		   ComponentsDropdowns.init();
		});
	</script>
	@stop
@stop

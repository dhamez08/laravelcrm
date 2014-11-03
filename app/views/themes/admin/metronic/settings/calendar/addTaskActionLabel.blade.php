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
			{{ Form::open(
				array(
						'action' => array('Settings\TaskLabelController@postAddActionLabel'),
						'method' => 'POST',
						'role'=>'form',
						'class'=>'horizontal-form'
					)
				)
			}}
				<div class="form-body">
					<div class="col-md-12">
						{{Form::submit('Add Action Label',array('class'=>'btn blue'))}}
						<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/task-label')}}">Cancel</a>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-body">
									<div class="row">
										@include( \DashboardEntity::get_instance()->getView() . '.settings.calendar.partials.taskInputLabel' )
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						{{Form::submit('Add Action Label',array('class'=>'btn blue'))}}
						<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/task-label')}}">Cancel</a>
						<p></p>
						<p></p>
					</div>
				</div>
			{{Form::close()}}
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

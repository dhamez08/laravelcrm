@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
	@stop
	@section('head-custom-css')
		@parent
		<style>
			.portlet.calendar .fc-button {
				top: -83px;
			}
		</style>		
	@stop
@stop
@section('body-content')
	@parent
	@section('innerpage-page-title')

	@stop
	@section('innerpage-content')

		<div class="portlet box {{{$dashboard_class or 'blue'}}} calendar">
			<div class="portlet-title">
				<div class="caption">					
					@section('portlet-captions')
						<i class="fa fa-{{{$fa_icons or 'cog'}}}"></i>{{{$portlet_title or 'Portlet Title'}}}
					@show
					<a href="{{url('task')}}" class="btn btn-default">Task List</a>
				</div>
			</div>
			<div class="portlet-body {{{$portlet_body_class or ''}}}">

					<form class="form-inline" method="get" id="status_sort" style="margin-bottom:10px">
						<a href="{{url('clients/create-client-task?redirect=task')}}" data-target=".createTask" data-toggle="modal" class="btn btn-default btn-sm openModal">
						<i class="fa fa-plus"></i> Create Task</a>					    
					    <label for="action" class="control-label">Action: </label>
						{{
							Form::select(
								'action[]',
								array('' => 'All Actions') + $taskLabel,
								\Input::get('action'),
								array('class' => 'form-control')								
							);
						}}

						<label for="client" class="control-label hidden">Client: </label>
						{{ 
							Form::select(
								'client[]', 
								array('' => 'All Clients') + $client, 
								\Input::get('client'),
								array('class' => 'form-control hidden')
							) 
						}}

						<label for="user" class="control-label">Tasks for: </label>
						{{
							Form::select(
								'user[]',
								$user_list,
								\Input::get('user', 'all'),
								array('class' => 'form-control')
							)
						}}
  
					    <button type="submit" class="btn blue">Apply Filters</button>
					</form>				

				<div class="row">
					<div class="col-md-12">
						<div id="taskcalendar"></div>
					</div>
				</div>
			</div>
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/calendar.js"></script>
		<script>
	    jQuery(document).ready(function() {
	    	TaskCalendar.init(baseURL, '{{$google_calendar}}');
	    });
		</script>
	@stop
@stop

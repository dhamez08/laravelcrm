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
@stop
@section('body-content')
	@parent
	@section('innerpage-page-title')

	@stop
	@section('innerpage-content')
		<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
			<div class="portlet-title">
				<div class="caption">
					@section('portlet-captions')
						<i class="fa fa-{{{$fa_icons or 'cog'}}}"></i>{{{$portlet_title or 'Portlet Title'}}}
					@show
				</div>
			</div>
			<div class="portlet-body {{{$portlet_body_class or ''}}}">
					<div class="tabbable portlet-tabs">
						<ul role="tablist" class="nav nav-tabs">
							  <li class=""><a href="{{url('calendar')}}">Calendar</a></li>
							  <li class="active"><a href="{{url('task')}}">Task List</a></li>
						</ul>
						<div class="tab-content">
							<p>
							<a href="{{url('clients/create-client-task?redirect=task')}}" data-target=".createTask" data-toggle="modal" class="btn btn-default btn-sm openModal">
							<i class="fa fa-plus"></i> Create Task</a>
							</p>
							<!-- START TASK LIST -->
							<ul class="task-list list-group">
								@if($tasks->count()>0)
									@foreach($tasks->get() as $task)
										<li class="list-group-item">
											<div class="task-title">
												@if($task->date < \Carbon\Carbon::now())
													<span class="label label-danger">
													Overdue {{\Carbon\Carbon::parse($task->date)->diffForHumans()}}
													</span>
												@endif
												&nbsp;
												<span class="task-title-sp">
													<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
														{{$task->name}}
													</a>
												</span>
												<span class="label label-sm" style="background-color:{{$task->label->color}}">
													{{$task->label->action_name}}
												</span>
												&nbsp;
												<span>
													For
													<a href="{{action('Clients\ClientsController@getClientSummary',array('id'=>$task->customer_id))}}">
													@if( $task->client->type == 2 )
														{{$task->client->company_name}}
													@else
														{{$task->client->title}} {{$task->client->first_name}} {{$task->client->last_name}}
													@endif
													</a>
												</span>
												<span class="task-bell">
													<i class="fa {{$task->label->icons}}"></i>
												</span>

												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a class="complete-task" href="{{action('Task\TaskController@getCompleteTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
															<i class="fa fa-check"></i> Complete </a>
														</li>
														<li>
															<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
															<i class="fa fa-pencil"></i> Edit </a>
														</li>
														<li>
															<a class="delete-task" href="{{action('Task\TaskController@getCancelTask',array('id'=>$task->id,'customerid'=>$task->customer_id))}}">
															<i class="fa fa-trash-o"></i> Cancel </a>
														</li>
													</ul>
												</div>

										</li>
									@endforeach
								@endif
							</ul>
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
	    	TaskCalendar.init(baseURL);
	    });
		</script>
	@stop
@stop

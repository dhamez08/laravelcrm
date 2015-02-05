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
		<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable tasks-widget">
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
							{{ Form::open(array('method' => 'GET', 'role' => 'form')) }}
							<div class="row">
								<div class="col-md-12">
									<label>Action:</label>
									{{
										Form::select(
											'action[]',
											$taskLabel,
											\Input::get('action'),
											array('multiple')
										);
									}}													
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">

									<div class="portlet box blue" style="margin-top:10px; margin-bottom:10px">
										<div class="portlet-title">
											<div class="caption caption-mini">
												<i class="fa fa-cogs"></i>Advanced Filters
											</div>
											<div class="tools">
												<a href="javascript:;" class="expand">
												</a>
											</div>
										</div>
										<div class="portlet-body" style="display:none">
											<div class="row">
												<div class="col-md-12" style="margin: 10px 10px;">
													<label>Client: </label>
													{{ 
														Form::select(
															'client[]', 
															$client, 
															\Input::get('client'),
															array('multiple')
														) 
													}}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	

							{{Form::submit('Apply Filters',array('class'=>"btn blue btn-sm"))}}

							{{ Form::close() }}	

							<p></p>					

							<p>Overdue : {{$tasks['due']->all}}</p>
							<!-- START TASK LIST -->
							<ul class="task-list">
								@if(count($tasks['total']) > 0)
									@foreach($tasks['data'] as $task)
										<li class="list-unstyled">
											<div class="task-title">
												{{\Carbon\Carbon::parse($task->created_at)->toDateString()}}
												&nbsp;
												<span class="task-title-sp">
													<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
														{{$task->displayName()}}
													</a>
												</span>
												{{$task->displayHtmlLabelIcon()}}
												&nbsp;
												<span>
													For
													<a href="{{action('Clients\ClientsController@getClientSummary',array('id'=>$task->customer_id))}}">
													{{$task->displayTaskFullName()}}
													</a>
												</span>
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
													<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a class="complete-task" href="{{action('Task\TaskController@getCompleteTask',array('id'=>$task->id,'customerid'=>$task->customer_id))}}">
															<i class="fa fa-check"></i> Complete </a>
														</li>
														<li>
															<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id))}}">
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
							<p>Today : {{$tasks['due']->today}}</p>
							<p>Next Seven Days : {{$tasks['due']->seven}}</p>
							<p>Future : {{$tasks['due']->future}}</p>
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
		<script type="text/javascript">
			$('select[name="action[]"]').select2({
				width: '100%'
			});
			$('select[name="client[]"]').select2({
				width: '80%'
			});			
		</script>		
	@stop
@stop

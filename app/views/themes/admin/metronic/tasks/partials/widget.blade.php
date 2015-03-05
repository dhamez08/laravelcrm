<!-- BEGIN Portlet PORTLET-->
<div class="portlet {{ $portletClass or 'portlet-sortable light bordered' }}">
	<div class="portlet-title">
		<div class="caption {{ $portletCaptionClass or 'font-green-sharp' }}">
			<i class="fa fa-check-square-o"></i>
			<span class="caption-subject bold uppercase">Task</span>
		</div>
		<div class="actions pull-left" style="margin-left: 5px">
			<a
				class="btn btn-icon-only btn-circle btn-sm green-meadow openModal"
				data-toggle="modal"
				data-target=".createTask"
				href="{{action(
						'Clients\ClientsController@getCreateClientTask',
						array(
							'customerid'=>isset($customerId) ? $customerId:'')
						)
					}}">
				<i class="fa fa-plus"></i>
			</a>
		</div>
	</div>
	<div class="portlet-body">

		<p class="task-accordion-head">Overdue : <span class="badge badge-danger">{{$tasks['due']->all}}</span></p>
		{{ 
			Form::open(
				array(
					'action' => array(
						'Task\TaskController@postBulkCancelTask'
					),
					'style' => 'display:none',
					'role' => 'form'
				)
			) 
		}}
		@if(count($tasks['tasks']['overdue']) > 0)

			@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'tasks_check_all', 'table_target' => '#table-task-list'))

		@endif
		<div class="scroller" style="height:256px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<table class="table table-condensed table-feeds" id="table-task-list">
				<tbody>
				@if(count($tasks['tasks']['overdue']) > 0)
					@foreach($tasks['tasks']['overdue'] as $task)
						<tr>
							<td style="width:1%">
								{{ Form::checkbox('tasks_to_delete[]', $task->id) }}
							</td>
							<td class="text-center">
								<div class="label label-sm label-info label-icon">
									<i class="fa {{ $task->label->icons }}"></i>
								</div>
							</td>
							<td>
								{{$task->displayHtmlLabelIcon(false)}}
							</td>
							<td>
								<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
									{{$task->displayName()}}
								</a>								
							</td>
							<td>
								<small class="muted">on {{\Carbon\Carbon::parse($task->date)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($task->date)->format('H:i')}}</small>
							</td>
							<td>
								<a href="{{
				 						action('Task\TaskController@getCancelTask',
				 							array('id'=>$task->id,'customerid'=>$task->customer_id))
			 							}}" class="pull-right delete-task" title="Delete Task"><i class="icon-trash"></i> 
			 					</a>								
							</td>
						</tr>
					@endforeach
				@endif					
				</tbody>
			</table>
		</div>
		{{ Form::close() }}


		<p class="task-accordion-head">Today : <span class="badge badge-warning">{{$tasks['due']->today}}</span></p>
		{{ 
			Form::open(
				array(
					'action' => array(
						'Task\TaskController@postBulkCancelTask'
					),
					'style' => 'display:none',
					'role' => 'form'
				)
			) 
		}}
		@if(count($tasks['tasks']['today']) > 0)

			@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'tasks_check_all', 'table_target' => '#table-task-list-today'))

		@endif
		<div class="scroller" style="height:256px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<table class="table table-condensed table-feeds" id="table-task-list-today">
				<tbody>
				@if(count($tasks['tasks']['today']) > 0)
					@foreach($tasks['tasks']['today'] as $task)
						<tr>
							<td style="width:1%">
								{{ Form::checkbox('tasks_to_delete[]', $task->id) }}
							</td>
							<td class="text-center">
								<div class="label label-sm label-info label-icon">
									<i class="fa {{ $task->label->icons }}"></i>
								</div>
							</td>
							<td>
								{{$task->displayHtmlLabelIcon(false)}}
							</td>
							<td>
								<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
									{{$task->displayName()}}
								</a>								
							</td>
							<td>
								<small class="muted">on {{\Carbon\Carbon::parse($task->date)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($task->date)->format('H:i')}}</small>
							</td>
							<td>
								<a href="{{
				 						action('Task\TaskController@getCancelTask',
				 							array('id'=>$task->id,'customerid'=>$task->customer_id))
			 							}}" class="pull-right delete-task" title="Delete Task"><i class="icon-trash"></i> 
			 					</a>								
							</td>
						</tr>
					@endforeach
				@endif					
				</tbody>
			</table>
		</div>
		{{ Form::close() }}

		<p class="task-accordion-head">Next Seven Days : <span class="badge badge-info">{{$tasks['due']->seven}}</span></p>
		{{ 
			Form::open(
				array(
					'action' => array(
						'Task\TaskController@postBulkCancelTask'
					),
					'style' => 'display:none',
					'role' => 'form'
				)
			) 
		}}
		@if(count($tasks['tasks']['seven']) > 0)

			@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'tasks_check_all', 'table_target' => '#table-task-list-seven'))

		@endif
		<div class="scroller" style="height:256px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<table class="table table-condensed table-feeds" id="table-task-list-seven">
				<tbody>
				@if(count($tasks['tasks']['seven']) > 0)
					@foreach($tasks['tasks']['seven'] as $task)
						<tr>
							<td style="width:1%">
								{{ Form::checkbox('tasks_to_delete[]', $task->id) }}
							</td>
							<td class="text-center">
								<div class="label label-sm label-info label-icon">
									<i class="fa {{ $task->label->icons }}"></i>
								</div>
							</td>
							<td>
								{{$task->displayHtmlLabelIcon(false)}}
							</td>
							<td>
								<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
									{{$task->displayName()}}
								</a>								
							</td>
							<td>
								<small class="muted">on {{\Carbon\Carbon::parse($task->date)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($task->date)->format('H:i')}}</small>
							</td>
							<td>
								<a href="{{
				 						action('Task\TaskController@getCancelTask',
				 							array('id'=>$task->id,'customerid'=>$task->customer_id))
			 							}}" class="pull-right delete-task" title="Delete Task"><i class="icon-trash"></i> 
			 					</a>								
							</td>
						</tr>
					@endforeach
				@endif					
				</tbody>
			</table>
		</div>
		{{ Form::close() }}


		<p class="task-accordion-head">Future : <span class="badge badge-default">{{$tasks['due']->future}}</span></p>
		{{ 
			Form::open(
				array(
					'action' => array(
						'Task\TaskController@postBulkCancelTask'
					),
					'style' => 'display:none',
					'role' => 'form'
				)
			) 
		}}
		@if(count($tasks['tasks']['future']) > 0)

			@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'tasks_check_all', 'table_target' => '#table-task-list-future'))

		@endif
		<div class="scroller" style="height:256px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<table class="table table-condensed table-feeds" id="table-task-list-future">
				<tbody>
				@if(count($tasks['tasks']['future']) > 0)
					@foreach($tasks['tasks']['future'] as $task)
						<tr>
							<td style="width:1%">
								{{ Form::checkbox('tasks_to_delete[]', $task->id) }}
							</td>
							<td class="text-center">
								<div class="label label-sm label-info label-icon">
									<i class="fa {{ $task->label->icons }}"></i>
								</div>
							</td>
							<td>
								{{$task->displayHtmlLabelIcon(false)}}
							</td>
							<td>
								<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
									{{$task->displayName()}}
								</a>								
							</td>
							<td>
								<small class="muted">on {{\Carbon\Carbon::parse($task->date)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($task->date)->format('H:i')}}</small>
							</td>
							<td>
								<a href="{{
				 						action('Task\TaskController@getCancelTask',
				 							array('id'=>$task->id,'customerid'=>$task->customer_id))
			 							}}" class="pull-right delete-task" title="Delete Task"><i class="icon-trash"></i> 
			 					</a>								
							</td>
						</tr>
					@endforeach
				@endif					
				</tbody>
			</table>
		</div>
		{{ Form::close() }}
	</div>
</div>
<!-- END Portlet PORTLET-->

@section('footer-custom-js')
	@parent
    <script>
    jQuery(document).ready(function() {
        $('.task-accordion-head').click(function(){ $(this).next('form').slideToggle() });
    });
    </script>
@stop

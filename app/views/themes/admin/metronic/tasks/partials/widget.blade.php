<!-- BEGIN Portlet PORTLET-->
<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title">
		<div class="caption font-green-sharp">
			<i class="fa fa-check-square-o font-green-sharp"></i>
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
		<p>Overdue : {{$tasks['due']->all}}</p>
		{{ 
			Form::open(
				array(
					'action' => array(
						'Task\TaskController@postBulkCancelTask'
					),
					'role' => 'form'
				)
			) 
		}}
		@if(count($tasks['total']) > 0)
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-xs btn-danger pull-left"><i class="fa fa-trash"></i> Bulk Delete</button>
			</div>
		</div>
		@endif
		<div class="scroller" style="height:256px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<table class="table table-condensed table-feeds">
				<tbody>
				@if(count($tasks['total']) > 0)
					@foreach($tasks['data'] as $task)
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
		<p>Today : {{$tasks['due']->today}}</p>
		<p>Next Seven Days : {{$tasks['due']->seven}}</p>
		<p>Future : {{$tasks['due']->future}}</p>
	</div>
</div>
<!-- END Portlet PORTLET-->

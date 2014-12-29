<!-- BEGIN Portlet PORTLET-->
<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title">
		<div class="caption font-green-sharp">
			<i class="fa fa-check-square-o font-green-sharp"></i>
			<span class="caption-subject bold uppercase">Task</span>
		</div>
		<div class="actions">
			<a href="{{action(
						'Clients\ClientsController@getCreateClientTask',
						array(
							'customerid'=>isset($customerId) ? $customerId:'')
						)
					}}"
				data-target=".createTask"
				data-toggle="modal"
				class="btn btn-default btn-sm openModal">
			<i class="fa fa-plus"></i> Add </a>
		</div>
	</div>
	<div class="portlet-body">
		<p>Overdue : {{$tasks['due']->all}}</p>
		<div class="scroller" style="height:256px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<!-- START TASK LIST -->
			<!--
			<ul class="feeds hidden">
				@if(count($tasks['total']) > 0)
					@foreach($tasks['data'] as $task)
						<li>
							<div class="col1" style="width:70% !important">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa {{ $task->label->icons }}"></i>
										</div>
										{{$task->displayHtmlLabelIcon(false)}}
									</div>
									<div class="cont-col2">
										<div class="desc" style="margin-left:120px">
											<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
												{{$task->displayName()}}
											</a>
										</div>										
									</div>
								</div>
							</div>
							<div class="col2" style="width:30% !important">
								<div class="cont">
									<div class="cont-col1">
										<small class="muted">on {{\Carbon\Carbon::parse($task->created_at)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($task->created_at)->format('H:i')}}</small>
									</div>
									<div class="cont-col2">
										<a href="{{
						 						action('Task\TaskController@getCancelTask',
						 							array('id'=>$task->id,'customerid'=>$task->customer_id))
					 							}}" class="pull-right delete-task" title="Delete Task"><i class="icon-trash"></i> </a>
									</div>									
								</div>
							</div>
						</li>
					@endforeach
				@endif
			</ul>
			-->
			<table class="table table-condensed table-feeds">
				<tbody>
				@if(count($tasks['total']) > 0)
					@foreach($tasks['data'] as $task)
						<tr>
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
								<small class="muted">on {{\Carbon\Carbon::parse($task->created_at)->format('d/m/Y')}} at {{\Carbon\Carbon::parse($task->created_at)->format('H:i')}}</small>
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
		<p>Today : {{$tasks['due']->today}}</p>
		<p>Next Seven Days : {{$tasks['due']->seven}}</p>
		<p>Future : {{$tasks['due']->future}}</p>
	</div>
</div>
<!-- END Portlet PORTLET-->

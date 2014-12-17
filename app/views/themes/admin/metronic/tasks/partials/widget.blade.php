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
			<ul class="task-list">
				@if(count($tasks['total']) > 0)
					@foreach($tasks['data'] as $task)
						<li class="">
							<div class="task-title">
								{{--$task->displayHtmlTaskDue()--}}
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
								<div class="task-config">
									<div class="task-config-btn btn-group hide">
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
								</div>
						</li>
					@endforeach
				@endif
			</ul>
		</div>
		<p>Today : {{$tasks['due']->today}}</p>
		<p>Next Seven Days : {{$tasks['due']->seven}}</p>
		<p>Future : {{$tasks['due']->future}}</p>
	</div>
</div>
<!-- END Portlet PORTLET-->

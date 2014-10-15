<div class="modal-header">
	<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
	<h4 class="modal-title">{{$pageTitle}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			{{ Form::model(
				$tasks,
				array(
						'action' => array('Task\TaskController@putAjaxUpdateTask','taskid'=>$tasks->id),
						'method' => 'PUT',
						'role'=>'form',
						'id'=>'createTask',
					)
				)
			}}
			  <div class="form-group">
			    <label>Description</label>
			    {{Form::text('name',$tasks->name,array('class'=>'form-control'))}}
			  </div>
			  <div class="form-group">
			    <label>Link To</label>
			    {{
					Form::text(
						'getclient',
						$client_linkTo,
						array(
							'class'=>'form-control typeahead getclient',
							'autocomplete'=>'off',
						)
					)
			    }}
			    {{Form::hidden('customer_id',$tasks->customer_id,array('id'=>'customer_id'))}}
			  </div>
			  <div class="form-group">
			    <label>Date</label>
				<div class="row">
					<div class="col-xs-4">
					{{
						Form::text(
							'task_date',
							$theDate->year.'-'.$theDate->month.'-'.$theDate->day,
							array(
								'class'=>'form-control input-sm input-sm',
								'data-provide'=>'datepicker',
								'data-date-format'=>'yyyy-mm-dd'
							)
						);
					}}
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    <label>Start Time</label>
			    <div class="row">
					<div class="col-xs-4">
					{{
						Form::select(
							'task_hour',
							$getTime,
							$theDate->hour,
							array(
								'class'=>'form-control',
								'id'=>'task_hour',
							)
						)
					}}
					</div>
					<div class="col-xs-4">
					{{
						Form::select(
							'task_min',
							$getMin,
							$theDate->minute,
							array(
								'class'=>'form-control',
								'id'=>'task_min',
							)
						)
					}}
					</div>
				</div>
			  </div>
			  <div class="form-group">
					{{Form::checkbox('time_not_required',null,false,array('id'=>'time_not_required'))}}
					End Time is not required.
			  </div>
			  <div class="form-group">
				<label>End Time</label>
				<div class="row">
					<div class="col-xs-4">
					{{
						Form::select(
							'end_task_hour',
							$getTime,
							$endDate->hour,
							array(
								'class'=>'form-control',
								'id'=>'end_task_hour',
							)
						)
					}}
					</div>
					<div class="col-xs-4">
					{{
						Form::select(
							'end_task_min',
							$getMin,
							isset($endDate->minute)?$endDate->minute:'30',
							array(
								'class'=>'form-control',
								'id'=>'end_task_min',
							)
						)
					}}
					</div>
				</div>
			   </div>
			    <div class="form-group">
					<label>Action</label>
					{{
						Form::select(
							'task_setting',
							$taskLabel,
							null,
							array(
								'class'=>'form-control',
							)
						)
					}}
			   </div>
			   <div class="form-group">
					<label>Reminder</label>
					{{
						Form::select(
							'remind_mins',
							$remindMin,
							null,
							array(
								'class'=>'form-control',
							)
						)
					}}
			   </div>
			  {{Form::hidden('redirect',$redirectURL)}}
			  <button type="submit" class="btn btn-default">Submit</button>
				  @if($from == 'calendar')
					  <a class="btn btn-primary "
						 href="{{action('Calendar\CalendarController@getCompleteTask',
							array('id'=>$tasks->id,'customerid'=>$tasks->customer_id)
						 )}}">
					  Complete Task
					  </a>
				  @else
					  <a class="btn btn-primary "
						 href="{{action('Task\TaskController@getCompleteTask',
							array('id'=>$tasks->id,'customerid'=>$tasks->customer_id)
						 )}}">
					  Complete Task
					  </a>
				  @endif
				<a class="btn btn-primary "
					 href="{{
						 action('Task\TaskController@getCancelTask',
						 array('id'=>$tasks->id,'customerid'=>$tasks->customer_id))
					 }}"
				>
				 Delete Task
				</a>
			  <div class="ajax-container-msg hide" >
			  	<ul class="list-group ajax-error-msg">
			  	</ul>
			  </div>
			{{Form::close()}}
		</div>
	</div>
</div>
<div class="modal-footer">
	<button data-dismiss="modal" class="btn default" type="button">Close</button>
</div>

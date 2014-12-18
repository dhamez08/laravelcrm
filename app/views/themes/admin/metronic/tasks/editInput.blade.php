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
						'class'=>'form-horizontal'
					)
				)
			}}
				<div class="form-group">
					<label class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
					   {{Form::text('name',$tasks->name,array('class'=>'form-control'))}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Link To</label>
					<div class="col-sm-10">
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
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Date and Time</label>
					<div class="col-sm-4">
						{{
							Form::text(
								'task_date',
								$theDate->day.'/'.$theDate->month.'/'.$theDate->year,
								array(
									'class'=>'form-control input-sm input-sm',
									'id'=>'task_date'
								)
							);
						}}
					</div>
					<div class="col-sm-3">
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
					<div class="col-sm-3">
						{{
							Form::select(
								'task_min',
								$getMin,
								//isset($startMinute) ? $startMinute:null,
								$theDate->minute,
								array(
									'class'=>'form-control',
									'id'=>'task_min',
								)
							)
						}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">End Time is not required.</label>
					<div class="col-sm-6">
						{{Form::checkbox('time_not_required',null,($endDate->hour == '00' && $endDate->minute == '00') ? true:false,array('id'=>'time_not_required'))}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">End Time</label>
					<div class="col-sm-5">
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
					<div class="col-sm-5">
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
				<div class="form-group">
					<label class="col-sm-2 control-label">Action</label>
					<div class="col-sm-10">
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
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Reminder</label>
					<div class="col-sm-10">
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
				</div>
			  {{Form::hidden('redirect',null,array('id'=>'redirect'))}}
			  <button type="submit" class="btn btn-primary">Update</button>

				<a class="btn btn-primary complete-task"
					 href="{{action('Task\TaskController@getCompleteTask',
						array('id'=>$tasks->id,'customerid'=>$tasks->customer_id))
					}}"
				>
				  Complete Task
				</a>
				<a class="btn btn-primary delete-task"
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

<div class="modal-header">
	<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
	<h4 class="modal-title">{{$pageTitle}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open(
				array(
						'action' => array('Task\TaskController@postAjaxCreateTask'),
						'method' => 'POST',
						'role'=>'form',
						'id'=>'createTask',
					)
				)
			}}
			  <div class="form-group">
			    <label>Description</label>
			    {{Form::text('task_name',null,array('class'=>'form-control'))}}
			  </div>
			  <div class="form-group">
			    <label>Link To</label>
			    {{
					Form::text(
						'getclient',
						isset($clientName) ? $clientName:null,
						array(
							'class'=>'form-control typeahead getclient',
							'autocomplete'=>'off',
						)
					)
			    }}
			    {{Form::hidden('customer_id',isset($currentClient) ? $currentClient->id:null,array('id'=>'customer_id'))}}
			  </div>
			  <div class="form-group">
			    <label>Date</label>
				<div class="row">
					<div class="col-xs-4">
					{{
						Form::text(
							'task_date',
							null,
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
							null,
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
							null,
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
							null,
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
							'30',
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
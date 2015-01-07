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
						'class'=>'form-horizontal'
					)
				)
			}}
			<div class="form-group">
				<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
				   {{Form::text('task_name',null,array('class'=>'form-control'))}}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Link To</label>
				<div class="col-sm-10">
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
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Date and Time</label>
				<div class="col-sm-4">
					{{
						Form::text(
							'task_date',
							isset($start) ? $start:null,
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
							isset($startHour) ? $startHour:null,
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
							isset($startMinute) ? $startMinute:null,
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
					{{Form::checkbox('time_not_required',null,false,array('id'=>'time_not_required'))}}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">End Time</label>
				<div class="col-sm-5">
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
				<div class="col-sm-5">
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

			<div class="form-group">
				<div class="col-sm-12">
					<ul class="nav nav-tabs">
						@if(empty($chosen_note))
						<li class="active">
							<a href="#note_custom" data-toggle="tab" data-tab="note_custom" class="note-tab-types">
								Manual Note 
							</a>
						</li>
						@endif
						<li class="{{ empty($chosen_note) ? '' : 'active' }}">
							<a href="#note_existing" data-toggle="tab" data-tab="note_existing" class="note-tab-types">
								Existing Note 
							</a>				
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade {{ empty($chosen_note) ? 'active in' : '' }}" id="note_custom">
							{{ Form::textarea('custom_note', null, array('class' => 'form-control', 'placeholder' => 'Enter note here (optional)')) }}
						</div>
						<div class="tab-pane fade {{ !empty($chosen_note) ? 'active in' : '' }}" id="note_existing">
							{{ \Notes\NotesController::get_instance()->getIndex(isset($currentClient->id) ? $currentClient->id : null, '', $existingNoteViewType, $chosen_note, $notesOtherData) }}
						</div>
					</div>
				</div>
			</div>

			{{ 
				Form::hidden(
					'note_type', 
					empty($chosen_note) ? 'note_custom' : 'note_existing', 
					array('id' => 'note_type')
				) 
			}}

			  {{Form::hidden('redirect',null,array('id'=>'redirect'))}}
			  <button type="submit" class="btn btn-primary">Create</button>
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

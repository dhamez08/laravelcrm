<form role="form">
  <div class="form-group">
    <label>Description</label>
    {{Form::text('task_name',null,array('class'=>'form-control'))}}
  </div>
  <div class="form-group">
    <label>Link To</label>
    {{
		Form::text(
			'getclient',null,
			array(
				'class'=>'form-control typeahead getclient',
				'autocomplete'=>'off',
			)
		)
    }}
    {{Form::hidden('customer_id',null,array('id'=>'customer_id'))}}
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
		{{Form::checkbox('time_not_required',null,false,array('id'=>'time_not_required'))}}
		Time is not required ( All day task )
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
  <button type="submit" class="btn btn-default">Submit</button>
</form>

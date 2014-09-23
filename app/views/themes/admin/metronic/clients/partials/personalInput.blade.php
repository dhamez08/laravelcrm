<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Title</label>
	{{
		Form::select(
			'title',
			$title,
			null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">First Name</label>
	{{
		Form::text(
			'first_name',
			null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Surname</label>
	{{
		Form::text(
			'last_name',
			null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Date of Birth: DD/MM/YYYY</label>
	{{
		Form::text(
			'dob',
			null,
			array(
				'class'=>'form-control input-sm',
				'data-provide'=>'datepicker',
				'data-date-format'=>'dd/mm/yyyy'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Job Title:</label>
	{{
		Form::text(
			'job',
			null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Marital Status</label>
	{{
		Form::select(
			'marital_status',
			$maritalStatus,
			null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Number of Children</label>
	{{
		Form::selectRange(
			'noc',
			1,8,
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'noc'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Living Status</label>
	{{
		Form::select(
			'living_status',
			$livingStatus,
			null,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Employment Status</label>
	{{
		Form::select(
			'employment_status',
			$employmentStatus,
			null,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>
<div class="col-xs-1">
	<div class="form-group">
	<label class="control-label">Smoker?</label>
	{{
		Form::checkbox(
			'smoker',
			0,
			null,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>

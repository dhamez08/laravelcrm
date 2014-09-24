<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Title</label>
	{{
		Form::select(
			'partner_title',
			$title,
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
	<label class="control-label">First Name</label>
	{{
		Form::text(
			'partner_first_name',
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
	<label class="control-label">Surname</label>
	{{
		Form::text(
			'partner_last_name',
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
	<label class="control-label">Date of Birth</label>
	{{
		Form::text(
			'partner_dob',
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
<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Job Title</label>
	{{
		Form::text(
			'partner_job',
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
<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Employment Status</label>
	{{
		Form::select(
			'partner_employment_status',
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
			'partner_smoker',
			1,
			false,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>

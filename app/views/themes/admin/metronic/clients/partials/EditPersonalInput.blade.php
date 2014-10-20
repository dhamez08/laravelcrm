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
<div class="col-xs-5">
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
<div class="col-xs-5">
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
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">Date of Birth</label>
	{{
		Form::text(
			'dob',
			($customer->dob == '0000-00-00' ) ? '':\Clients\ClientEntity::get_instance()->convertDate($customer->dob),
			array(
				'class'=>'form-control input-sm',
				'data-provide'=>'datepicker',
				'data-date-format'=>'dd/mm/yyyy'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">Job Title</label>
	{{
		Form::text(
			'job_title',
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
	<label class="control-label">Marital Status</label>
	{{
		Form::select(
			'marital_status',
			$maritalStatus,
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'marital_status'
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
			1,
			false,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>

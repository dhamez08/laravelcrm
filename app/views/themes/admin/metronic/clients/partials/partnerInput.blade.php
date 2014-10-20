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
			'partner_job_title',
			isset($partner->partner_job_title) ? $partner->partner_job_title:null,
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
			'partner_living_status',
			$livingStatus,
			isset($partner->partner_living_status) ? $partner->partner_living_status:null,
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
			isset($partner->partner_employment_status) ? $partner->partner_employment_status:null,
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
			isset($partner->partner_smoker) ? $partner->partner_smoker:1,
			isset($partner->partner_smoker) ? ( $partner->partner_smoker == 0 )? false:true : false,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>

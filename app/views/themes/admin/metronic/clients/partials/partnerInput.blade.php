<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">Title</label>
		<div class="col-md-9">
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
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">First Name</label>
		<div class="col-md-9">
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
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">SurName</label>
		<div class="col-md-9">
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
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">Date of Birth (dd/mm/yyyy)</label>
		<div class="col-md-9">
			{{
				Form::text(
					'partner_dob',
					null,
					array(
						'class'=>'form-control input-sm inputdatepicker',
						'data-provide'=>'datepicker',
						'data-date-format'=>'dd/mm/yyyy',
						'placeholder'=>'dd/mm/yyyy',
					)
				);
			}}
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">Job Title</label>
		<div class="col-md-9">
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
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">Living Status</label>
		<div class="col-md-9">
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
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">Employment Status</label>
		<div class="col-md-9">
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
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label col-md-3">Smoker?</label>
		<div class="col-md-1">
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
</div>

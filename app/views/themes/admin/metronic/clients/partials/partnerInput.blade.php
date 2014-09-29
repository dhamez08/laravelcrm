@if( isset($customer) )
	@if( $customer->customerAssociatedTo($customer->id)->count() > 0 )
		@foreach( $customer->customerAssociatedTo($customer->id)->get() as $family )
			@if( $family->relationship == 'Spouse/Partner' )
				<?php
					$partner_job_title = $family->job_title;
					$partner_first_name = $family->partner_first_name;
					$partner_last_name = $family->partner_last_name;
					$partner_dob = $family->partner_dob;
				?>
			@endif
		@endforeach
	@endif
@endif
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
				'data-date-format'=>'yyyy-mm-dd'
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

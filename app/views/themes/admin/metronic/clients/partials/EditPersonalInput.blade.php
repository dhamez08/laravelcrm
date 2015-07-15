<div class="form-group">
	<label class="control-label col-md-3">Title</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">First Name</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Surname</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Date of Birth (dd/mm/yyyy)</label>
	<div class="col-md-9">
	{{
		Form::text(
			'dob',
			($customer->dob == '0000-00-00' ) ? '':\Clients\ClientEntity::get_instance()->convertDate($customer->dob),
			array(
				'class'=>'form-control input-sm dob',
				'data-provide'=>'datepicker',
				'data-date-format'=>'dd/mm/yyyy'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Job Title</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Marital Status</label>
	<div class="col-md-3">
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
	{{--
	<label class="control-label col-md-3">Number of Children</label>
	<div class="col-md-3">
		@if(false)
			<p>{{count($children)}}</p>
		@else
			{{
				Form::select(
					'noc',
					range(0,10),
					null,
					array(
						'class'=>'form-control input-sm',
						'id'=>'noc',
					)
				);
			}}
		@endif
	</div>
	--}}	
</div>
<div class="form-group">
	<label class="control-label col-md-3">Living Status</label>
	<div class="col-md-3">
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
	<label class="control-label col-md-3">Employment Status</label>
	<div class="col-md-3">
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
<div class="form-group">
	<label class="control-label col-md-3">Smoker ?</label>
	<div class="col-md-1">
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

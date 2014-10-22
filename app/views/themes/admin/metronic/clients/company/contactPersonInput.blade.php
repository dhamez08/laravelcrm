<div class="form-group">
	<label class="control-label col-md-3">Title</label>
	<div class="col-md-2">
	{{
		Form::select(
			'title',
			$title,
			isset($contactPerson) ? $contactPerson->title:null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">First Name</label>
	<div class="col-md-4">
	{{
		Form::text(
			'first_name',
			isset($contactPerson) ? $contactPerson->first_name:null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Surname</label>
	<div class="col-md-4">
	{{
		Form::text(
			'last_name',
			isset($contactPerson) ? $contactPerson->last_name:null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Job Title</label>
	<div class="col-md-4">
	{{
		Form::text(
			'job_title',
			isset($contactPerson) ? $contactPerson->job_title:null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Email Address</label>
	<div class="col-md-4">
	{{
		Form::text(
			'contact_email',
			isset($contactPerson) ? $contactPerson->email:null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Telephone Number</label>
	<div class="col-md-4">
	{{
		Form::text(
			'contact_phone',
			isset($contactPerson) ? $contactPerson->telephone_day:null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>

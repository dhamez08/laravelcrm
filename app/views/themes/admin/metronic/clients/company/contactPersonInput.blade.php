<div class="col-xs-2">
	<div class="form-group">
	<label class="control-label">Title</label>
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
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">First Name</label>
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
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Surname</label>
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
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Job Title</label>
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
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Email Address</label>
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
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Telephone Number</label>
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

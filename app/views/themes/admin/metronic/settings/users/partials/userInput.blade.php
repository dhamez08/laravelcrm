<div class="form-group">
	<div class="col-xs-10">
	<label class="control-label">Username</label>
	{{
		Form::text(
			'username',
			null,
			array(
				'class'=>'form-control'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<div class="col-xs-10">
	<label class="control-label">Password</label>
	{{
		Form::password(
			'password',
			array(
				'class'=>'form-control'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<div class="col-xs-10">
		<label class="control-label">First Name</label>
		{{
			Form::text(
				'first_name',
				null,
				array(
					'class'=>'form-control'
				)
			);
		}}
	</div>
</div>
<div class="form-group">
	<div class="col-xs-10">
		<label class="control-label">Surname</label>
		{{
			Form::text(
				'last_name',
				null,
				array(
					'class'=>'form-control'
				)
			);
		}}
	</div>
</div>
<div class="form-group">
	<div class="col-xs-10">
		<label class="control-label">Email</label>
		{{
			Form::text(
				'email',
				null,
				array(
					'class'=>'form-control'
				)
			);
		}}
	</div>
</div>

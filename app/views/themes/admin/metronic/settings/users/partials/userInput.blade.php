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
	@if( isset($user) )
		<p class="text-muted">Leave blank to keep existing</p>
	@endif
	<p class="text-muted"></p>
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

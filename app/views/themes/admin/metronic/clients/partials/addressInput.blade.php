<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">House Number</label>
	{{
		Form::text(
			'house_number',
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
	<label class="control-label">Post Code</label>
	<div class="input-group">
		{{
			Form::text(
				'first_name',
				null,
				array(
					'class'=>'form-control input-sm',
					'id'=>'postcode'
				)
			);
		}}
		<span class="input-group-btn">
	        <button class="btn btn-default input-sm address-lookup" type="button">Find Address</button>
	    </span>
	</div>
	</div>
</div>
<div class="col-xs-12">
	<div class="form-group">
	{{
		Form::textarea(
			'address_line_1',
			null,
			array(
				'class'=>'form-control input-sm',
				'rows'=>5,
				'cols'=>8,
				'style'=>'resize:none;',
				'id'=>'address1'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">Town</label>
	{{
		Form::text(
			'town',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'town'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">County</label>
	{{
		Form::text(
			'county',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'county'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Post Code</label>
	{{
		Form::text(
			'postcode',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'postcode_final'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-4">
	<div class="form-group">
	<label class="control-label">Type</label>
	{{
		Form::select(
			'type',
			$addressType,
			null,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3">House Number</label>
	<div class="col-md-4">
	{{
		Form::text(
			'address_line_2',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'address_line_2'
			)
		);
	}}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Post Code</label>
	<div class="col-md-4">
		{{
			Form::text(
				'postcode',
				isset($postcode) ? $postcode:null,
				array(
					'class'=>'form-control input-sm',
					'id'=>'postcode'
				)
			);
		}}
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3">Address</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Town</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">County</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Type</label>
	<div class="col-md-9">
	{{
		Form::select(
			'address_type',
			$addressType,
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'address_type'
			)
		);
	}}
	</div>
</div>

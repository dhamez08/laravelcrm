<div class="form-group">
	<label class="control-label col-md-3">House Number</label>
	<div class="col-md-9">
		{{
			Form::text(
				'address_line_2',
				isset($customer->address()->first()->address_line_2) ? $customer->address()->first()->address_line_2:null,
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
	<div class="col-md-9">
		{{
			Form::text(
				'postcode',
				isset($customer->address()->first()->postcode) ? $customer->address()->first()->postcode:null,
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
				isset($customer->address()->first()->address_line_1) ? $customer->address()->first()->address_line_1:null,
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
				isset($customer->address()->first()->town) ? $customer->address()->first()->town:null,
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
				isset($customer->address()->first()->county) ? $customer->address()->first()->county:null,
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
			isset($customer->address()->first()->address_type) ? $customer->address()->first()->address_type:null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'address_type'
			)
		);
	}}
	</div>
</div>
@if( isset($customer) )
{{Form::hidden('address_id', $customer->address()->first()->id)}}
@endif

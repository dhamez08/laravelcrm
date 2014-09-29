@if( isset($customer ) )
	@if( $customer->address()->count() > 0 )
		@foreach($customer->address()->get() as $address)
			<?php
				$address_line_2 = $address->address_line_2;
				$postcode 		= $address->postcode;
				$address_line_1 = $address->address_line_1;
				$town 			= $address->town;
				$address_type 	= $address->type;
				$county 		= $address->county;
			?>
		@endforeach
	@endif
@endif
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">House Number</label>
	{{
		Form::text(
			'address_line_2',
			isset($address_line_2) ? $address_line_2:null,
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
				'postcode',
				isset($postcode) ? $postcode:null,
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
			isset($address_line_1) ? $address_line_1:null,
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
			isset($town) ? $town:null,
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
			isset($county) ? $county:null,
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
	<label class="control-label">Type</label>
	{{
		Form::select(
			'address_type',
			$addressType,
			isset($address_type) ? $address_type:null,
			array(
				'class'=>'form-control input-sm',
			)
		);
	}}
	</div>
</div>

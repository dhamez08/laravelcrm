<div class="well" id="well-{{ $index }}" style="display:none">
	<div class="form-group hidden">
		<label class="control-label col-md-3">House Number</label>
		<div class="col-md-9">
			{{
				Form::text(
					'address['.$index.'][address_line_2]',
					isset($val->address_line_2) ? $val->address_line_2 : null,
					array(
						'class'=>'form-control input-sm',
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
				'address['.$index.'][address_type]',
				$addressType,
				ucfirst($index),
				array(
					'class'=>'form-control input-sm',
					'disabled' => true
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
					'address['.$index.'][address_line_1]',
					isset($val->address_line_1) ? $val->address_line_1 : null,
					array(
						'class'=>'form-control input-sm',
						'rows'=>5,
						'cols'=>8,
						'style'=>'resize:none;',
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
					'address['.$index.'][town]',
					isset($val->town) ? $val->town : null,
					array(
						'class'=>'form-control input-sm',
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
					'address['.$index.'][county]',
					isset($val->county) ? $val->county : null,
					array(
						'class'=>'form-control input-sm',
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
					'address['.$index.'][postcode]',
					isset($val->postcode) ? $val->postcode : null,
					array(
						'class'=>'form-control input-sm',
					)
				);
			}}
		</div>
	</div>

	@if(isset($val->id))
		{{ Form::hidden('address['.$index.'][id]', $val->id) }}
	@endif

</div>
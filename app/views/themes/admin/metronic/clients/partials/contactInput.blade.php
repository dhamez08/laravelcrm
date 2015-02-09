<div id="clone-phone">
	<div class="phone-wrapper">
		<div class="well">
			<div class="form-group">
				<label class="control-label col-md-3">Number</label>
				<div class="col-md-8">
				{{
					Form::text(
						'telephone[0][number]',
						null,
						array(
							'class'=>'form-control input-sm'
						)
					);
				}}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Type</label>
				<div class="col-md-4">
				{{
					Form::select(
						'telephone[0][for]',
						$phoneFor,
						null,
						array(
							'class'=>'form-control input-sm',
							'id'=>'basePhone'
						)
					);
				}}
				</div>
			</div>
		</div>
	</div>
</div>
{{--
<div class="col-md-12">
	<button class="btn green btn-xs add-phone" type="button">Add Phone number</button>
</div>
--}}
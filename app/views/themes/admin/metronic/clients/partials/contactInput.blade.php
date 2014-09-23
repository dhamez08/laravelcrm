<div id="clone-phone">
	<div class="row phone-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
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
		<div class="col-xs-4">
			<div class="form-group">
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
<div class="">
	<button class="btn green btn-xs add-phone" type="button">Add Phone number</button>
</div>

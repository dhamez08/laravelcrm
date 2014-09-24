<div id="clone-email">
	<div class="row email-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
			{{
				Form::email(
					'email[0][mail]',
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
					'email[0][for]',
					$emailFor,
					null,
					array(
						'class'=>'form-control input-sm',
						'id'=>'baseEmail'
					)
				);
			}}
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12">
	<button class="btn green btn-xs add-email" type="button">Add Email</button>
</div>

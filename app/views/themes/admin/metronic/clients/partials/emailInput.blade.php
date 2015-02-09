<div id="clone-email">
	<div class="email-wrapper">
		<div class="well">
			<div class="form-group">
				<label class="control-label col-md-3">Email</label>
				<div class="col-md-8">
					{{
						Form::email(
							'emails[0][mail]',
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
							'emails[0][for]',
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
</div>
{{-- 
<div class="col-xs-12">
	<button class="btn green btn-xs add-email" type="button">Add Email</button>
</div>
--}}

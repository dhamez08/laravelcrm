<div id="edit-clone-email">
	<div class="row email-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
			{{
				Form::email(
					'edit_emails['.$emailIdx.'][mail]',
					$val->email,
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
					'edit_emails['.$emailIdx.'][for]',
					$emailFor,
					$val->type,
					array(
						'class'=>'form-control input-sm',
					)
				);
			}}
			</div>
		</div>
		{{Form::hidden('edit_emails['.$emailIdx.'][id]',$val->id)}}
	</div>
</div>


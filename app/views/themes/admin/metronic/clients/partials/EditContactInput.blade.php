<div id="edit-clone-phone">
	<div class="row phone-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
			{{
				Form::text(
					'telephone['.$telephoneIdx.'][number]',
					$val->number,
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
					'telephone['.$telephoneIdx.'][for]',
					$phoneFor,
					$val->type,
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


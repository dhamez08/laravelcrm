<div class="row children-wrapper">
	<div class="col-xs-3">
		<div class="form-group">
		<label class="control-label">First Name</label>
		{{
			Form::text(
				'children[0][firstname]',
				null,
				array(
					'class'=>'form-control input-sm'
				)
			);
		}}
		</div>
	</div>
	<div class="col-xs-3">
		<div class="form-group">
		<label class="control-label">Last Name</label>
		{{
			Form::text(
				'children[0][lastname]',
				null,
				array(
					'class'=>'form-control input-sm'
				)
			);
		}}
		</div>
	</div>
	<div class="col-xs-2">
		<div class="form-group">
		<label class="control-label">Date of Birth</label>
		{{
			Form::text(
				'children[0][dob]',
				null,
				array(
					'class'=>'form-control input-sm',
					'data-provide'=>'datepicker',
					'data-date-format'=>'yyyy-mm-dd'
				)
			);
		}}
		</div>
	</div>
	<div class="col-xs-2">
		<div class="form-group">
		<label class="control-label">Relation To Client</label>
		{{
			Form::select(
				'children[0][relation_to_client]',
				$relationToClient,
				null,
				array(
					'class'=>'form-control input-sm',
					'id'=>'baseRelationToClient',
				)
			);
		}}
		</div>
	</div>
</div>
<div id="clone-children"></div>



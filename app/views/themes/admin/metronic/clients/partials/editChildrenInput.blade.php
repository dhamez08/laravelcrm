<div class="row children-wrapper">
	<div class="col-xs-3">
		<div class="form-group">
		<label class="control-label">First Name</label>
		{{
			Form::text(
				'children['.$childrenIdx.'][firstname]',
				$val->first_name,
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
				'children['.$childrenIdx.'][lastname]',
				$val->last_name,
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
				'children['.$childrenIdx.'][dob]',
				$val->dob,
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
				'children['.$childrenIdx.'][relation_to_client]',
				$relationToClient,
				$val->relationship,
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



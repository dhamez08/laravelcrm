<div class="well">
	<div class="row children-wrapper">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-md-3">First Name</label>
				<div class="col-md-9">
					{{
						Form::text(
							'edit_children['.$childrenIdx.'][firstname]',
							$val->first_name,
							array(
								'class'=>'form-control input-sm'
							)
						);
					}}					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-md-3">Last Name</label>
				<div class="col-md-9">
					{{
						Form::text(
							'edit_children['.$childrenIdx.'][lastname]',
							$val->last_name,
							array(
								'class'=>'form-control input-sm'
							)
						);
					}}
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-md-3">Date of Birth</label>
				<div class="col-md-9">
					{{
						Form::text(
							'edit_children['.$childrenIdx.'][dob]',
							\Carbon\Carbon::parse($val->dob)->format('d/m/Y'),
							array(
								'class'=>'form-control input-sm',
								'data-provide'=>'datepicker',
								'data-date-format'=>'dd/mm/yyyy'
							)
						);
					}}
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-md-3">Relation To Client</label>
				<div class="col-md-9">
					{{
						Form::select(
							'edit_children['.$childrenIdx.'][relation_to_client]',
							$relationToClient,
							$val->relationship,
							array(
								'class'=>'form-control input-sm',
							)
						);
					}}					
				</div>
			</div>
		</div>
		{{Form::hidden('edit_children['.$childrenIdx.'][id]',$val->children_id)}}
	</div>

	<div class="row">
		<div class="col-md-12">
			<a href="{{ url('clients/confirm-child-delete/' . $val->children_id . '/' . $val->associated . '/' . $val->children_id . csrf_token()) }}" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i></a>
		</div>
	</div>

</div>
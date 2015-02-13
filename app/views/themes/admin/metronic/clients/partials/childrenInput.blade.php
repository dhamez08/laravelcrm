<div id="clone-children">
	<div class="well">
		<div class="row children-wrapper">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">First Name</label>
					<div class="col-md-9">
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
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Last Name</label>
					<div class="col-md-9">
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
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Date of Birth</label>
					<div class="col-md-9">
						{{
							Form::text(
								'children[0][dob]',
								null,
								array(
									'class'=>'form-control input-sm inputdatepicker',
									'data-provide'=>'datepicker',
									'data-date-format'=>'dd/mm/yyyy',
									'placeholder'=>'dd/mm/yyyy'
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
		</div>
	</div>
</div>
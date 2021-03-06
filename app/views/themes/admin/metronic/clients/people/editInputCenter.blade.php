<div class="panel panel-default">
	<div class="panel-body">
		{{ Form::model(
			$customer,
			array(
					'action' => array('Clients\ClientsController@putFamilyPerson',$customer->id),
					'method' => 'PUT',
					'role'=>'form',
				)
			)
		}}
		<div class="form-body">
			<div class="row">
				<div class="col-xs-2">
					<div class="form-group">
						<label class="control-label">Title</label>
						{{
							Form::select(
								'title',
								$title,
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
						<label class="control-label">First Name</label>
						{{
							Form::text(
								'first_name',
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
						<label class="control-label">Last Name</label>
						{{
							Form::text(
								'last_name',
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
							'dob',
							($customer->dob == '0000-00-00' ) ? '':null,
							array(
								'class'=>'form-control input-sm input-sm dob',
								'data-date-format'=>'dd/mm/yyyy'
							)
						);
					}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					<div class="form-group">
						<label class="control-label">Relationship</label>
						{{
							Form::select(
								'relationship',
								$peopleRelationship,
								null,
								array(
									'class'=>'form-control input-sm'
								)
							);
						}}
					</div>
				</div>
			</div>
			<div class="col-md-12">
				{{Form::submit('Update',array('class'=>"btn blue"))}}
				<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('clients/people/' . $belongToPartner->id)}}">Cancel</a>
			</div>
		</div>
		{{
			Form::hidden(
				'belongtopartner',
				$belongToPartner->id,
				array(
					'class'=>'form-control input-sm'
				)
			);
		}}
		{{Form::close()}}
	</div>
</div>


{{var_dump($title)}}
{{var_dump($peopleRelationship)}}
<div class="panel panel-default">
	<div class="panel-body">
		{{ Form::open(
			array(
					'action' => array('Clients\ClientsController@postFamilyPerson'),
					'method' => 'POST',
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
							null,
							array(
								'class'=>'form-control input-sm input-sm',
								'data-provide'=>'datepicker',
								'data-date-format'=>'yyyy-mm-dd'
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
				{{Form::submit('Add People',array('class'=>"btn blue"))}}
				<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('clients/client-summary/' . $customer->id)}}">Cancel</a>
			</div>
		</div>
		{{
			Form::hidden(
				'clientId',
				$customer->id,
				array(
					'class'=>'form-control input-sm'
				)
			);
		}}
		{{Form::close()}}
	</div>
</div>


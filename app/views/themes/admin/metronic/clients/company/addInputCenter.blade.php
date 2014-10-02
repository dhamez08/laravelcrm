<div class="panel panel-default">
	<div class="panel-body">
		{{ Form::open(
			array(
					'action' => array('Clients\ClientsController@postCompanyPerson'),
					'method' => 'POST',
					'role'=>'form',
				)
			)
		}}
		<div class="form-body">
			<div class="row">
				<div class="col-xs-6">
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
				<div class="col-xs-6">
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
				<div class="col-xs-4">
					<div class="form-group">
						<label class="control-label">Job Title</label>
						{{
							Form::text(
								'job_title',
								isset($contactPerson) ? $contactPerson->job_title:null,
								array(
									'class'=>'form-control input-sm'
								)
							);
						}}
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<h3 class="form-section">Address</h3>
				@include( \DashboardEntity::get_instance()->getView() . '.clients.company.addressInput' )
			</div>
			<div class="col-md-12">
				<h3 class="form-section">Telephone Number</h3>
				@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.contactInput' )
			</div>
			<div class="col-md-12">
				<h3 class="form-section">Email</h3>
				@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.emailInput' )
			</div>
			<div class="col-md-12">
				<h3 class="form-section">Website</h3>
				@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.urlInput' )
			</div>
		</div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div class="row">
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


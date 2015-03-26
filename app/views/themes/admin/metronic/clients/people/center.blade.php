<div class="panel panel-default">
	<div class="panel-body">

		<div class="row">
			<div class="col-md-12">
				<a href="{{ action('Clients\ClientsController@getAddCompanyPerson', array($customer->id)) }}" class="btn btn-info"><i class="fa fa-plus"></i> Add New Employee</a>
				<a href="{{ action('Clients\ClientsController@getImportPerson') }}" class="btn btn-info"><i class="fa fa-plus"></i> Import Employee List</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-advance table-hover">
					<thead>
						<tr>
							<th>
								Name
							</th>
							<th>
								Job Title
							</th>
							<th>
								Date of birth
							</th>
							<th>
								Address
							</th>
							<th>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						@if( $customer->customerAssociatedTo($customer->id)->count() > 0 )
							@foreach( $customer->customerAssociatedTo($customer->id)->orderBy('created_at','desc')->get() as $family )
							<tr>
								<td>
									<a href="{{action('Clients\ClientsController@getEditFamilyPerson',array('personId'=>$family->id))}}">
										{{$family->first_name.' '.$family->last_name}}
									</a>
								</td>
								<td>
									{{ $family->job_title }}
								</td>
								<td>
									{{ !empty($family->dob) && $family->dob != '0000-00-00' ? $currentClient->parseDate($family->dob) : ''}}
								</td>
								<td>
									{{ isset(\Clients\Clients::find($family->id)->address->address_line_1) ? \Clients\Clients::find($family->id)->address->address_line_1 : '' }}
								</td>
								<td>
									<a href="{{ action('Clients\ClientsController@getEdit', array($family->id)) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-body">
		<h3>People associated with {{$customer->company_name}}</h3>
		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Date of birth
					</th>
					<th>
						Relationship
					</th>
					<th>

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
							{{$currentClient->parseDate($family->dob)}}
						</td>
						<td>
							{{$family->relationship}}
						</td>
						<td>
							action
						</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>


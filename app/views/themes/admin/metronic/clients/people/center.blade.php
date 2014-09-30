<div class="panel panel-default">
	<div class="panel-body">
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
							@if( $family->relationship == 'Spouse/Partner' )
								<a href="#">
									{{$family->first_name.' '.$family->last_name}}
								</a>
							@else
								{{$family->first_name.' '.$family->last_name}}
							@endif

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


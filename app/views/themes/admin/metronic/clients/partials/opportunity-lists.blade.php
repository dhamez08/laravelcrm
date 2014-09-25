<div class="row">
	<div class="col-md-12">
	@if(count($opportunities)>0)
		<table class="table">
			<thead>
				<tr>
					<th>Opportunity</th>
					<th>Milestone</th>
					<th>Value</th>
					<th>Close Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($opportunities as $opportunity)
				<tr>
					<td>{{ $opportunity->name }}</td>
					<td>{{ $opportunity->milestone }}({{ $opportunity->probability }}%)</td>
					<td>£{{ $opportunity->value }}</td>
					<td>{{ date('d/m/Y',strtotime($opportunity->close_date)) }}</td>
					<td>
						<a href="javascript:void(0)" class="btn btn-sm blue editOpportunity" opportunity-id="{{ $opportunity->id }}"><i class="fa fa-edit"></i> Edit</a>
						<a href="#" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Remove</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@else
		<div style="padding:15px">
			Currently no opportunities for this client.
		</div>
	@endif
	</div>
</div>
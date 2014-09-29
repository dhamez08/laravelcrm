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
			<?php
			$tags = array();
			foreach($opportunity->tags as $tag) {
				$tags[] = $tag->opp_tag;
			}
			?>
				<tr>
					<td>
						<a href="javascript:void()" class="hastooltip" data-toggle="tooltip" data-placement="right" title="{{ $opportunity->text }}">{{ $opportunity->name }}</a>
						<br />
						@if($opportunity->status==0)
							<strong>Open</strong>
						@else
							<strong>Closed</strong>
						@endif
					</td>
					<td>{{ $opportunity->milestone }}({{ $opportunity->probability }}%)</td>
					<td>£{{ $opportunity->value }}</td>
					<td>{{ date('d/m/Y',strtotime($opportunity->close_date)) }}</td>
					<td align="right">
						<input type="hidden" id="opportunity_edit_name_{{ $opportunity->id }}" value="{{ $opportunity->name }}">
						<input type="hidden" id="opportunity_edit_desc_{{ $opportunity->id }}" value="{{ $opportunity->text }}">
						<input type="hidden" id="opportunity_edit_milestone_{{ $opportunity->id }}" value="{{ $opportunity->milestone }}">
						<input type="hidden" id="opportunity_edit_probability_{{ $opportunity->id }}" value="{{ $opportunity->probability }}">
						<input type="hidden" id="opportunity_edit_value_{{ $opportunity->id }}" value="{{ $opportunity->value }}">
						<input type="hidden" id="opportunity_edit_status_{{ $opportunity->id }}" value="{{ $opportunity->status }}">
						<input type="hidden" id="opportunity_edit_tags_{{ $opportunity->id }}" value="{{ implode(',',$tags); }}">
						<input type="hidden" id="opportunity_edit_close_date_{{ $opportunity->id }}" value="{{ date('d/m/Y',strtotime($opportunity->close_date)) }}">
						<a href="javascript:void(0)" class="btn btn-sm blue editOpportunity" opportunity-id="{{ $opportunity->id }}"><i class="fa fa-edit"></i> Edit</a>
						<a href="{{ url('clients/delete-opportunities/'.$opportunity->id) }}" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Remove</a>
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
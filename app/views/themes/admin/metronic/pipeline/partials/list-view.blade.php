@extends( $pipeline_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			<div class="row">
				<div class="col-md-6">
					<form class="form-inline" method="get" id="status_sort">
					    <label for="status" class="control-label">Filter by status or milestone:</label>
					    <select id="status" name="status" class="form-control" onchange="this.form.submit()">
					    <optgroup label="Status">
					    <option value="">All (open &amp; closed)</option>
					    <option value="open" <?php if ($selected_status=="open") { echo 'selected="selected"'; } ?>>Open</option>
					    <option value="closed" <?php if ($selected_status=="closed") { echo 'selected="selected"'; } ?>>Closed</option>
					    <option value="closed30" <?php if ($selected_status=="closed30") { echo 'selected="selected"'; } ?>>Closed in last 30 days</option>
					    <option value="closed90" <?php if ($selected_status=="closed90") { echo 'selected="selected"'; } ?>>Closed in last 90 days</option>
					    <option value="closedyear" <?php if ($selected_status=="closedyear") { echo 'selected="selected"'; } ?>>Closed in the last year</option>
					    </optgroup>
					    <optgroup label="Milestone">
					    <option value="suspect" <?php if ($selected_status=="suspect") { echo 'selected="selected"'; } ?>>Milestone is Suspect</option>
					    <option value="prospect" <?php if ($selected_status=="prospect") { echo 'selected="selected"'; } ?>>Milestone is Prospect</option>
					    <option value="champion" <?php if ($selected_status=="champion") { echo 'selected="selected"'; } ?>>Milestone is Champion</option>
					    <option value="opportunity" <?php if ($selected_status=="opportunity") { echo 'selected="selected"'; } ?>>Milestone is Opportunity</option>
					    <option value="proposal" <?php if ($selected_status=="proposal") { echo 'selected="selected"'; } ?>>Milestone is Proposal</option>
					    <option value="verbal" <?php if ($selected_status=="verbal") { echo 'selected="selected"'; } ?>>Milestone is Verbal</option>
					    <option value="lost" <?php if ($selected_status=="lost") { echo 'selected="selected"'; } ?>>Milestone is Lost</option>
					    <option value="won" <?php if ($selected_status=="won") { echo 'selected="selected"'; } ?>>Milestone is Won</option>
					    </optgroup>
					    </select>
					    @if(count($opp_tags)>0)
						<label for="tag" class="control-label">Tag:</label>
						<select name="tag" id="tag" class="form-control" onchange="this.form.submit()">
							<option value=""></option>
							@foreach($opp_tags as $tag)
								<option value="{{ $tag->id }}" @if($selected_tag==$tag->id) selected="selected" @endif>{{ $tag->tag }}</option>
							@endforeach
						</select>
						@endif
					    
						@if(\Session::get("role")==1)
					    <label for="user" class="control-label">User:</label>
					    <select id="user" name="user" class="form-control" onchange="this.form.submit()">
					    <option value="">Myself Only</option>
						<option value="all" <?php if (\Input::get("user")=="all") { echo 'selected="selected"'; } ?>>All Users</option>
					    @if(count($group)>0)
					        @foreach($group as $user)
					        	<option value="{{ $g->user_id }}" @if($user->user_id==\Input::get('user')) selected="selected" @endif>{{ $user->first_name . ' ' . $user->last_name . ' (' . $user->username . ')' }}</option>
					        @endforeach
					    @endif
					    </select>
					    @endif  
					    <button type="submit" class="btn blue">Apply</button>
					    </form>
				</div>
			</div>
			<div class="row" style="margin-top:20px">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th><strong>Client</strong></th>
										<th><strong>Opportunity</strong></th>
										<th><strong>Milestone</strong></th>
										<th><strong>Expected Value</strong></th>
										<th><strong>Expected Close Date</strong></th>
										<th><strong>Status</strong></th>
									</tr>
								</thead>
								<tbody>
								@foreach($list as $opp)
									<tr>
										<td>{{ $opp->client }}</td>
										<td>{{ $opp->name }} ({{ $opp->probability }}%)</td>
										<td>{{ $opp->milestone }}</td>
										<td>&pound;{{ $opp->value_calc }}</td>
										<td>{{ date("jS F Y", strtotime($opp->close_date)) }}</td>
										<td>{{ $opp->status==0 ? 'Open':'Closed' }}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		@stop
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	@stop
@stop

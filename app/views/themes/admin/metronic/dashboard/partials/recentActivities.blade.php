<div class="portlet box blue-steel">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-bell-o"></i>Recent Activities
		</div>
		<div class="actions">
			<div class="btn-group">
				<a class="btn btn-sm btn-default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				Filter By <i class="fa fa-angle-down"></i>
				</a>				
				<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
					<form method="get">
					@if(isset($user_list) && isset($selectedOption))
						@foreach($user_list as $ulKey => $ulVal)
						<label><input type="radio" onclick="$(this).closest('form').submit()" name="recentActivitiesUserFilter" value="{{ $ulKey }}" {{ $selectedOption['recentActivitiesUserFilter'] == $ulKey ? 'checked' : '' }}/>{{ $ulVal }}</label>
						@endforeach
					@endif
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="portlet-body">
		<div class="scroller" style="height: 600px;" data-always-visible="1" data-rail-visible="0">
			<ul class="feeds">
				@if(isset($recentActivities) && count($recentActivities) > 0)
					@foreach($recentActivities as $activity)
					<li>
						<div class="col1">
							<div class="cont">
								<div class="cont-col1">
									<div class="label label-sm label-info">
										<i class="fa {{ $activity['icon'] }}"></i>
									</div>
								</div>
								<div class="cont-col2">
									<div class="desc">
										{{ $activity['log'] }}
									</div>
								</div>
							</div>
						</div>
						<div class="col2">
							<div class="date">
								{{ $activity['date'] }}
							</div>
						</div>
					</li>
					@endforeach
				@else
					<div class="alert alert-info">No recent activities.</div>
				@endif
			</ul>
		</div>
		<div class="scroller-footer hidden">
			<div class="btn-arrow-link pull-right">
				<a href="#">See All Records</a>
				<i class="icon-arrow-right"></i>
			</div>
		</div>
	</div>
</div>
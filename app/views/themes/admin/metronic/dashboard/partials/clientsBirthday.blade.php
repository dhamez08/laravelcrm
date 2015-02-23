<div class="portlet box green-haze tasks-widget">
	<div class="portlet-title">
		<div class="caption">
			Clients Birthdays
		</div>
		<div class="tools hidden">
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="" class="reload">
			</a>
		</div>
		<div class="actions hidden">
			<div class="btn-group">
				<a class="btn btn-default btn-sm" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				More <i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="#">
						<i class="i"></i> All Project </a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="#">
						AirAsia </a>
					</li>
					<li>
						<a href="#">
						Cruise </a>
					</li>
					<li>
						<a href="#">
						HSBC </a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="#">
						Pending <span class="badge badge-danger">
						4 </span>
						</a>
					</li>
					<li>
						<a href="#">
						Completed <span class="badge badge-success">
						12 </span>
						</a>
					</li>
					<li>
						<a href="#">
						Overdue <span class="badge badge-warning">
						9 </span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="portlet-body">
		<p>Birthdays this week</p>
		@if(isset($clientBirthdays['thisWeek']) && count($clientBirthdays['thisWeek']) > 0)
		<ul>
			@foreach($clientBirthdays['thisWeek'] as $clientBdayThisWeek)
				<li>{{ $clientBdayThisWeek->first_name }} {{ $clientBdayThisWeek->last_name }}  <span class="label label-info"> {{ \Carbon\Carbon::parse($clientBdayThisWeek->dob)->format('m/d/Y') }} </label></li>
			@endforeach
		</ul>
		@else
			<div class="alert alert-info">None of your clients have a birthday this week.</div>
		@endif		
		<p>Birthdays this month</p>
		@if(isset($clientBirthdays['thisMonth']) && count($clientBirthdays['thisMonth']) > 0)
		<ul>
			@foreach($clientBirthdays['thisMonth'] as $clientBdayThisMonth)
				<li>{{ $clientBdayThisMonth->first_name }} {{ $clientBdayThisMonth->last_name }}  <span class="label label-info"> {{ \Carbon\Carbon::parse($clientBdayThisMonth->dob)->format('m/d/Y') }} </label></li>
			@endforeach
		</ul>
		@else
			<div class="alert alert-info">None of your clients have a birthday this month.</div>
		@endif
	</div>
</div>
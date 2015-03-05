<div class="portlet box green-haze tasks-widget">
	<div class="portlet-title">
		<div class="caption">
			Clients Birthdays
		</div>
	</div>
	<div class="portlet-body">
		<p class="birthday-accordion-head">Birthdays this week</p>
		@if(isset($clientBirthdays['thisWeek']) && count($clientBirthdays['thisWeek']) > 0)
		<ul style="display:none">
			@foreach($clientBirthdays['thisWeek'] as $clientBdayThisWeek)
				<li>{{ $clientBdayThisWeek->first_name }} {{ $clientBdayThisWeek->last_name }}  <span class="label label-info"> {{ \Carbon\Carbon::parse($clientBdayThisWeek->dob)->format('m/d/Y') }} </label></li>
			@endforeach
		</ul>
		@else
			<div class="alert alert-info">None of your clients have a birthday this week.</div>
		@endif		
		<p class="birthday-accordion-head">Birthdays this month</p>
		@if(isset($clientBirthdays['thisMonth']) && count($clientBirthdays['thisMonth']) > 0)
		<ul style="display:none">
			@foreach($clientBirthdays['thisMonth'] as $clientBdayThisMonth)
				<li>{{ $clientBdayThisMonth->first_name }} {{ $clientBdayThisMonth->last_name }}  <span class="label label-info"> {{ \Carbon\Carbon::parse($clientBdayThisMonth->dob)->format('m/d/Y') }} </label></li>
			@endforeach
		</ul>
		@else
			<div class="alert alert-info">None of your clients have a birthday this month.</div>
		@endif
	</div>
</div>

@section('footer-custom-js')
	@parent
    <script>
    jQuery(document).ready(function() {
        $('.birthday-accordion-head').click(function(){ $(this).next('ul').slideToggle() });
    });
    </script>
@stop
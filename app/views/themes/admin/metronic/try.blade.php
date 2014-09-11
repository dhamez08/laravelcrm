@extends( $master_view )

@section('body-content')
	@parent

	@section('innerpage-main-content')
		{{--\Dashboard\DashboardController::displayAccountDetails()--}}
	@stop
@stop

@section('body-footer')

@show

@section('script-footer')
	@parent

	@section('footer-custom-js')
		<script>
			jQuery(document).ready(function() {
			   Index.init();
			   Index.initDashboardDaterange();
			   Index.initJQVMAP(); // init index page's custom scripts
			   Index.initCalendar(); // init index page's custom scripts
			   Index.initCharts(); // init index page's custom scripts
			   Index.initChat();
			   Index.initMiniCharts();
			   Index.initIntro();
			   Tasks.initDashboardWidget();

			   $('.account_details').slimScroll({
					height: '350px'
			   });
			});
		</script>
	@stop
@stop

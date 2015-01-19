@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/pages/css/profile.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
		<div class="col-md-12">
			<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs" role="tablist">
					<li class="{{(\Session::has('profile')) ? ((\Session::get('profile') == 'account-overview' ) ? ' active': '') : ' active' }}">
						<a href="#tab_overview" data-toggle="tab">
						Overview </a>
					</li>
					<li class="{{(\Session::has('profile') && \Session::get('profile') == 'account-settings') ? ' active': ''}}">
						<a href="#tab_account_settings" data-toggle="tab">
						Account Settings </a>
					</li>
					<li class="{{(\Session::has('profile') && \Session::get('profile') == 'account-current-projects') ? ' active': ''}}">
						<a href="#tab_current_projects" data-toggle="tab">
						Current Projects </a>
					</li>
					<li  class="{{(\Session::has('profile') && \Session::get('profile') == 'account-help-settings') ? ' active': ''}}">
						<a href="#tab_help_settings" data-toggle="tab">
						Help & Settings </a>
					</li>
				</ul>
				<div class="tab-content">
					@include( \DashboardEntity::get_instance()->getView() . '.profile.partials.overview' )
					@include( \DashboardEntity::get_instance()->getView() . '.profile.partials.account')
					@include( \DashboardEntity::get_instance()->getView() . '.profile.partials.currentProjects')
					@include( \DashboardEntity::get_instance()->getView() . '.profile.partials.helpSettings' )
				</div>
			</div>
		</div>
	@stop
@stop
@section('script-footer')
	@parent
	<script type="text/javascript" src="{{$asset_path}}	/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
	<script type="text/javascript">
		$('#gcal-help').popover({
			content: function() {
				return $('#gcal-help-content').html();
			},
			html: true,
			title: 'How to obtain Google Calendar ID',
			trigger: 'click hover',
			container: 'body'
		});
	</script>		
@stop

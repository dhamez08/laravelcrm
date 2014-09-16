@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
		<div class="col-md-12">
			<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">
					<li class="{{ $tabActive=='client' ? 'active':'' }}">
						<a href="#tab_client" data-toggle="tab">
						Client </a>
					</li>
					<li class="{{ $tabActive=='opportunities' ? 'active':'' }}">
						<a href="#tab_opportunities" data-toggle="tab">
						Opportunities </a>
					</li>
				</ul>
				<div class="tab-content">
					@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.tags.client' )
					@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.tags.opportunities' )
				</div>
			</div>
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	<script type="text/javascript" src="{{$asset_path}}/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
	@parent
	@stop
@stop
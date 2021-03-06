@extends( $dashboard_index )
@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/layout/css/settings.css" rel="stylesheet" type="text/css" id="style_color"/>
	<!-- END PAGE LEVEL SCRIPTS -->
@stop
@section('body-content')
	@parent
	@section('innerpage-page-title')
	@stop
	@section('innerpage-content')
		<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
			<div class="portlet-title">
				<div class="caption">
					@section('portlet-captions')
						<i class="fa fa-{{{$fa_icons or 'cog'}}}"></i>{{{$portlet_title or 'Portlet Title'}}}
					@show
				</div>
			</div>
			<div class="portlet-body {{{$portlet_body_class or ''}}}">
				<div class="tabbable portlet-tabs">
					@section('portlet-tab')
						@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.nav' )
					@show
					<div class="tab-content">
						@section('portlet-content')
						@show
					</div>
				</div>
			</div>
		</div>
	@stop
@stop

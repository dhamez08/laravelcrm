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
					@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.nav' )
					<div class="tab-content">
						@section('portlet-content')
							<div class="row">
								<div class="col-md-6 col-sm-12">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.box-calendar-task-setting' )
								</div>
								<div class="col-md-6 col-sm-12">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.user-setting' )
								</div>
								<div class="col-md-6 col-sm-12">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.email-setting' )
								</div>
								<div class="col-md-6 col-sm-12">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.tags-setting' )
								</div>
								<div class="col-md-6 col-sm-12">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.custom-fields-setting' )
								</div>
								<div class="col-md-6 col-sm-12">
									@include( \DashboardEntity::get_instance()->getView() . '.settings.partials.screen-setting' )
								</div>
							</div>
						@show
					</div>
				</div>
			</div>
		</div>
	@stop
@stop

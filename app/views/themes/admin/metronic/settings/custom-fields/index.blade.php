@extends( $settings_index )

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
		<div class="col-md-12">
			<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">
					<li class="{{ $tabActive=='custom-tabs' ? 'active':'' }}">
						<a href="#tab_custom_tabs" data-toggle="tab">
						Custom Tabs </a>
					</li>
					<li class="{{ $tabActive=='custom-forms' ? 'active':'' }}">
						<a href="#tab_custom_forms" data-toggle="tab">
						Custom Forms </a>
					</li>
					<li class="{{ $tabActive=='user-custom-fields' ? 'active':'' }}">
						<a href="#tab_custom_fields" data-toggle="tab">
						Custom Fields </a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane {{ $tabActive=='custom-tabs' ? 'active':'' }}" id="tab_custom_tabs">
						<div class="container-fluid">
							<div class="row">
								@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.custom-tabs' )
								@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.client-tabs' )
								@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.client-files' )
							</div>
						</div>
					</div>

					<div class="tab-pane {{ $tabActive=='custom-forms' ? 'active':'' }}" id="tab_custom_forms">
						<div class="container-fluid">
							<div class="row">
								@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.custom-forms' )
							</div>
						</div>
					</div>

					<div class="tab-pane {{ $tabActive=='user-custom-fields' ? 'active':'' }}" id="tab_custom_fields">
						<div class="container-fluid">
							<div class="row">
								@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.custom-fields' )
							</div>
						</div>
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
	<script src="{{$asset_path}}/pages/scripts/components-dropdowns.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		   ComponentsDropdowns.initBootstrapSelect();
		});
	</script>
	@stop
@stop

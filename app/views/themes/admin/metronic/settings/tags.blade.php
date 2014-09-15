@extends( $dashboard_index )
@section('body-content')
	@parent
	@section('innerpage-content')
		<div class="col-md-12">
			<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab_client" data-toggle="tab">
						Client </a>
					</li>
					<li>
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
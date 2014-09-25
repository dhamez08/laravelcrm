@extends( $client_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
	@stop
@stop
@section('body-content')
	@parent
	@section('left-sidebar')
		@include($view_path.'.clients.partials.leftSidebar')
	@stop
	@section('pagebar')

	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('portlet-actions')
		<a class="btn btn-default btn-sm" href="#" data-toggle="modal" data-target="#add-opportunity-form-modal">
		<i class="fa fa-plus"></i> Add </a>
	@stop
	@section('portlet-content')
		
		@include($view_path.'.clients.partials.opportunity-lists')

	@stop
	@include($view_path.'.clients.partials.modals.add-opportunity-form-modal')
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
	<!-- add here -->
	@parent
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/opportunities.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			UpdateModal.init();
		});
	</script>
	@stop
@stop

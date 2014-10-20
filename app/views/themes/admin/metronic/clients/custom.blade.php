@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
		<link href="{{$asset_path}}/global/plugins/star-rating/css/star-rating.css" rel="stylesheet" type="text/css"/>
		<style>
		.portlet.light.bordered > .portlet-title {
			border: 0px;
		}

		.radio input[type=radio] {
			position: relative;
			float:left;
		}

		.checkbox input[type=checkbox] {
			position: relative;
			float:left;
		}

		#content-form-data input[type="text"] {
			border:0px;
			font-weight: bold;
		}
		#content-form-data select {
		    -webkit-appearance: none;
		    -moz-appearance: none;
		    text-indent: 1px;
		    text-overflow: '';
		}
		#content-form-data .form-control[disabled] {
			background: none;
			cursor: default;
			border: 0px;
			font-weight: bold;
			padding-left: 0px;
		}
		</style>
	@stop
@stop
@section('body-content')
	@parent
	@section('left-sidebar')
		@include($view_path.'.clients.partials.leftSidebar')
	@stop
	@section('pagebar')
		@parent
		@include($view_path.'.clients.partials.subPagebar')
	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('innerpage-content')
		<div class="col-md-3">
			<!-- CLIENT LEFT SIDEBAR -->
			@if( $customer->type == 2 )
				@include($view_path.'.clients.company.leftColumn')
			@else
				@include($view_path.'.clients.partials.leftColumn')
			@endif

			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-md-8">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.partials.center_column.'.$center_column_view)
			<!-- END CENTER COLUMN -->
		</div>
		<div class="col-md-3">
			<!-- ADS -->
			@include($view_path.'.clients.partials.rightColumn')
			<!-- END ADS -->
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	
	<script type="text/javascript">
		$(document).on("ready", function() {
			$(".view-data-form").on("click", function(e) {
				e.preventDefault();
				$this = $(this);
				$.get("{{ url('settings/custom-forms/form-data') }}/"+$this.attr("data-ref-id"), function(responce) {
					$("#form-data-modal #content-form-data").html(responce);
					$("#form-data-modal #content-form-name").html($this.attr("data-form-name"));
					$("#form-data-modal").modal("show");
				});
			});
		});
	</script>

	@stop
@stop

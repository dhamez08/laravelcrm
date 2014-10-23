@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/pages/css/client_summary.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
		<link href="{{$asset_path}}/global/plugins/star-rating/css/star-rating.css" rel="stylesheet" type="text/css"/>
		<style>
		span#content-form-spinner {
		    -animation: spin .7s infinite linear;
		    -webkit-animation: spin2 .7s infinite linear;
		    font-size: 50px;
			margin-left: auto;
			left: 50%;
			color: gray;
			margin-top: 50px;
			margin-bottom: 50px;
		}

		@-webkit-keyframes spin2 {
		    from { -webkit-transform: rotate(0deg);}
		    to { -webkit-transform: rotate(360deg);}
		}

		@keyframes spin {
		    from { transform: scale(1) rotate(0deg);}
		    to { transform: scale(1) rotate(360deg);}
		}
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
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('innerpage-content')
		<div class="col-md-2 col-summary">
			<!-- CLIENT LEFT SIDEBAR -->
			@if( $customer->type == 2 )
				@include($view_path.'.clients.company.leftColumn')
			@else
				@include($view_path.'.clients.partials.leftColumn')
			@endif

			<!-- END CLIENT LEFT SIDEBAR -->
		</div>
		<div class="col-md-8 col-summary">
			<!-- CENTER COLUMN -->
			@include($view_path.'.clients.partials.center_column.'.$center_column_view)
			<!-- END CENTER COLUMN -->
		</div>
		<div class="col-md-2 col-summary">
			<!-- ADS -->
			@include($view_path.'.clients.partials.rightColumn')
			<!-- END ADS -->
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	<script src="{{$asset_path}}/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/opportunities.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/notes.js"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client_summary.js"></script>
	<script src="{{$asset_path}}/global/plugins/ckeditor/ckeditor.js"></script>
	<script src="{{$asset_path}}/global/plugins/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript">
		$(document).on("ready", function() {
			$(".view-data-form").on("click", function(e) {
				e.preventDefault();
				$this = $(this);

				$("#form-data-modal #content-form-action").hide();
				$("#form-data-modal").modal("show");

				$.get("{{ url('settings/custom-forms/form-data') }}/"+$this.attr("data-ref-id"), function(responce) {
					$("#form-data-modal input.content-hidden-form").val(responce);
					$("#form-data-modal input.title-hidden-form").val($this.attr("data-form-name"));
					$("#form-data-modal #content-form-data").html(responce);
					$("#form-data-modal #content-form-name").html($this.attr("data-form-name"));
					$("#form-data-modal #content-form-action").show();
				});
			});

			deletePhone.init();
        	deleteURL.init();
        	deleteEmail.init();
        	deletePerson.init();
        	Notes.init();
        	Summary.init();
		});
	</script>

	@stop
@stop

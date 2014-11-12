@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
		<style>
			#taskcalendar{

			}
		</style>
	@stop
@stop
@section('body-content')
	@parent
	@section('innerpage-page-title')

	@stop
	@section('innerpage-content')
		<div class="portlet box {{{$dashboard_class or 'blue'}}} calendar">
			<div class="portlet-title">
				<div class="caption">
					@section('portlet-captions')
						<i class="fa fa-{{{$fa_icons or 'cog'}}}"></i>{{{$portlet_title or 'Portlet Title'}}}
					@show
					<a href="{{url('task')}}" class="btn btn-default">Task List</a>
				</div>
			</div>
			<div class="portlet-body {{{$portlet_body_class or ''}}}">
				<div class="row">
					<div class="col-md-12">

						<div id="taskcalendar"></div>
					</div>
				</div>
			</div>
		</div>
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		<script type="text/javascript" src="{{$asset_path}}/pages/scripts/calendar.js"></script>
		<script>
	    jQuery(document).ready(function() {
	    	TaskCalendar.init(baseURL, '{{$google_calendar}}');
	    });
		</script>
	@stop
@stop

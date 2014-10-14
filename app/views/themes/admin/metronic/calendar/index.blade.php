@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
	@stop
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
						<ul role="tablist" class="nav nav-tabs">
						  <li class="active"><a href="{{url('calendar')}}">Calendar</a></li>
						  <li class=""><a href="{{url('task')}}">Task List</a></li>
						</ul>
						<div class="tab-content">
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
	    	TaskCalendar.init(baseURL);
	    });
		</script>
	@stop
@stop

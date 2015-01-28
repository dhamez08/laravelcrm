@extends( $dashboard_index )
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

	<div class="row">
		<div class="col-md-6">
			<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
				<div class="portlet-title">
					<div class="caption">
						@section('portlet-1-captions')
							{{{$portlet_title[1] or 'Portlet Title'}}}
						@show
					</div>
				</div>
				<div class="portlet-body {{{$portlet_body_class or ''}}}">
					<div class="portlet-tabs">
						<div class="tab-content">
							@section('portlet-1-content')
								<a href="{{ url('marketing/send-client-sms') }}" class="btn btn-lg green btn-block" {{ $sms_credit <= 0 ? 'disabled' : '' }}>Send SMS ({{ $sms_credit }} credits)</a>
								<a href="#" class="btn btn-lg blue btn-block">SMS Templates</a>
								<a href="{{ url('marketing/old-index') }}" class="btn btn-lg yellow btn-block">Reports</a>
							@show
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
				<div class="portlet-title">
					<div class="caption">
						@section('portlet-2-captions')
							{{{$portlet_title[2] or 'Portlet Title'}}}
						@show
					</div>
				</div>
				<div class="portlet-body {{{$portlet_body_class or ''}}}">
					<div class="portlet-tabs">
						<div class="tab-content">
							@section('portlet-2-content')
								<a href="#" class="btn btn-lg green btn-block" data-toggle="modal" data-target=".emailMessage">Send Email</a>
								<a href="{{url('marketing/templates')}}" class="btn btn-lg blue btn-block">Email Templates</a>
								<a href="#" class="btn btn-lg yellow btn-block">Reports</a>
							@show
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
    @include($view_path.'.marketing.partials.emailWidget')
	@stop
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	@stop
@stop

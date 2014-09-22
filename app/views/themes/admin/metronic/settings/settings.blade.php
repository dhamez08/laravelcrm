@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/pages/css/settings.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
		<div class="col-md-12 site-themes">
			<div class="row">
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/naturalgreen') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_naturalgreen.png", "Natural Green") }}
					<p><strong>Natural Green</strong></p></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/blue') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_blue.png", "Blue") }}
					<p><strong>Blue</strong></p></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/bluedusk') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_bluedusk.png", "Blue Dusk") }}
					<p><strong>Blue Dusk</strong></p></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/purple') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_purple.png", "Purple") }}
					<p><strong>Purple</strong></p></a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/pink') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_pink.png", "Pink") }}
					<p><strong>Pink</strong></p></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/red') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_red.png", "Red") }}
					<p><strong>Red</strong></p></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/icesteel') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_icesteel.png", "Ice Steel") }}
					<p><strong>Ice Steel</strong></p></a>
				</div>
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/olive') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_olive.png", "Olive") }}
					<p><strong>Olive</strong></p></a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3 text-center">
					<a href="{{ URL::to('settings/screen/change-theme/salmon') }}">
					{{ HTML::image($asset_path."/pages/media/settings/screen/settings_sytle_salmon.png", "Warm Salmon") }}
					<p><strong>Warm Salmon</strong></p></a>
				</div>
			</div>
		</div>
		@stop
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	<!-- add here -->
	@parent
	@stop
@stop
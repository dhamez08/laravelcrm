@extends( $client_index )

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
	@section('left-sidebar')
		@include($view_path.'.clients.partials.leftSidebar')
	@stop
	@section('pagebar')

	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('portlet-content')
		{{ Form::open(
			array(
					'action' => array('Clients\ClientsController@postCreateClient'),
					'method' => 'POST',
					'role'=>'form',
					'class'=>'horizontal-form'
				)
			)
		}}
		<div class="form-body">
			<div class="col-md-12">
				{{Form::submit('Add User',array('class'=>"btn blue"))}}
				<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('settings/users')}}">Cancel</a>
			</div>
			<div class="col-md-12">
				<h3>Personal Details</h3>
			</div>
			<div class="row">
				<div class="col-md-12">
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.personalInput' )
				</div>
			</div>
			<div class="col-md-12">
				<h3>Contact Details</h3>
			</div>
			<div class="">
				<div class="col-md-6">
					<div class="col-md-12">
						<h5>Telephone Number</h5>
					</div>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.contactInput' )
				</div>
				<div class="col-md-6">
					<div class="col-md-12">
						<h5>Email</h5>
					</div>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.emailInput' )
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="col-md-12">
						<h5>Website</h5>
					</div>
					{{--@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.contactInput' )--}}
				</div>
				<div class="col-md-6">
					<div class="col-md-12">
						<h5>Address</h5>
					</div>
					{{--@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.emailInput' )--}}
				</div>
			</div>
		</div>
		{{Form::close()}}
	@stop
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
	<!-- add here -->
	@parent
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
		<script>
			jQuery(document).ready(function() {
				addPhone.init();
				addEmail.init();
			});
		</script>
	@stop
@stop

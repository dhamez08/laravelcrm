@extends( $client_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
		<style>
			.phone-wrapper, .email-wrapper, .children-wrapper, .clone-children, .website-wrapper{
				margin-left:0px;
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

	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('portlet-actions')
	@stop
	@section('portlet-content')
		{{$customer->email}}
		{{ Form::model(
			$customer,
			array(
					'action' => array('Clients\ClientsController@putUpdateClientCompany', $customer->id),
					'method' => 'PUT',
					'role'=>'form',
					'class' => 'form-horizontal',
				)
			)
		}}
		<div class="form-body">
			<div class="col-md-12">
				{{Form::submit('Update Company Client',array('class'=>"btn blue btn-sm"))}}
				<a class="btn {{{$dashboard_css or 'blue'}}} btn-sm" href="{{url('clients/client-summary/' . $customer->id)}}">Go back to Client Summary</a>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h3 class="form-section">Organisation Info</h3>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.company.organisationInput' )
				</div>
				<div class="col-md-6">
					<h3 class="form-section">Address</h3>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.company.EditcompanyAddressInput' )
				</div>
			</div>
			<div id="partner_details" class="hide">
				<div class="row">
					<div class="col-md-12">
						<h3 class="form-section">Partner Details</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.partnerInput' )
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h3 class="form-section">Telephone Number</h3>
					@if( isset($telephone) )
						<?php $telephoneIdx = 0; ?>
						@foreach( $telephone->get() as $val )
							@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.EditContactInput' )
							<?php $telephoneIdx++; ?>
						@endforeach
					@endif
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.contactInput' )
				</div>
				<div class="col-md-6">
					<h3 class="form-section">Email</h3>
					@if( isset($email) )
						<?php $emailIdx = 0; ?>
						@foreach( $email->get() as $val )
							@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.EditEmailInput' )
							<?php $emailIdx++; ?>
						@endforeach
					@endif
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.emailInput' )
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="form-section">Website</h3>
					@if( isset($url) )
						<?php $urlIdx = 0; ?>
						@foreach( $url->get() as $val )
							@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.EditUrlInput' )
							<?php $urlIdx++; ?>
						@endforeach
					@endif
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.urlInput' )
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="form-section">Main Contact Details (if required):</h3>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.company.contactPersonInput' )
				</div>
			</div>
		</div>
		{{Form::hidden('contact_person',isset($contactPerson) ? $contactPerson->id:null)}}
		{{Form::close()}}
	@stop
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
	<!-- add here -->
	@parent
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="{{$asset_path}}/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
		<script>
			jQuery(document).ready(function() {
				jQuery('.dob').datepicker({
				    autoclose:true,
				    format: 'yyyy-mm-dd'
				});
				addPhone.init();
				addEmail.init();
				addPartner.init();
				addChildren.init();
				addressLookup.init();
				addWebsite.init();
				deletePhone.init();
				deleteURL.init();
				deleteEmail.init();
				deletePerson.init();
			});
		</script>
	@stop
@stop

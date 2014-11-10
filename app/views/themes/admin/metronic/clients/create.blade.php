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
		{{ Form::open(
			array(
					'action' => array('Clients\ClientsController@postCreateClient'),
					'method' => 'POST',
					'class' => 'form-horizontal',
					'role'=>'form',
				)
			)
		}}
		<div class="form-actions">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							{{Form::submit('Add Client',array('class'=>"btn blue"))}}
							<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('clients')}}">Cancel</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
				</div>
			</div>
		</div>
		<div class="form-body">
			<div class="row">
				<div class="col-md-6 left-form">
					<h3 class="form-section">Personal Info</h3>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.personalInput' )
				</div>
				<div class="col-md-6 right-form">
					<h3 class="form-section">Address</h3>
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.addressInput' )
				</div>
			</div>
			<div class="hide" id="partner_details">
				<div class="row">
					<div class="col-md-12">
						<h3 class="form-section">Partner Info</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.partnerInput' )
					</div>
				</div>
			</div>
			<div id="children_details" class="hide">
				<div class="row">
					<div class="col-md-12">
						<h3 class="form-section">Childrens Details</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.childrenInput' )
					</div>
				</div>
			</div>
			<div id="telephone-email-container">
				<div class="row">
					<div class="col-md-6">
						<h3 class="form-section">Telephone Number</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.contactInput' )
					</div>
					<div class="col-md-6">
						<h3 class="form-section">Email</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.emailInput' )
					</div>
				</div>
			</div>
			<div id="website-customfields-container">
				<div class="row">
					<div class="col-md-6">
						<h3 class="form-section">Website</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.urlInput' )
					</div>
					<div class="col-md-6">
						<h3 class="form-section">Custom Fields</h3>
						<?php
                        $customFields = \CustomField\CustomField::where('user_id',\Auth::id())->get();
                        ?>
                        @if(count($customFields) > 0)
                            @foreach($customFields as $cfield)
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{ $cfield->label }}</label>
                                    <div class="col-md-9">
                                        {{
                                            Form::text(
                                                'custom_field['.$cfield->id.']',
                                                 null,
                                                array(
                                                    'class'=>'form-control input-sm'
                                                )
                                            );
                                        }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							{{Form::submit('Add Client',array('class'=>"btn blue"))}}
							<a class="btn {{{$dashboard_css or 'blue'}}}" href="{{url('clients')}}">Cancel</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
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
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
	<script>
		jQuery(document).ready(function() {
			Metronic.init();
			Index.init();
			addPhone.init();
			addEmail.init();
			addPartner.init();
			addChildren.init();
			addressLookup.init();
			addWebsite.init();
		});
	</script>
	@stop
@stop

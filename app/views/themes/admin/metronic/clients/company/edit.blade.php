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

                    <div class="form-group">
                        <label class="col-md-3 control-label">Type: </label>
                        <div class="col-md-9">
                            <label>Home</label>
                            <input type="checkbox" name="address_checkbox[]" class="form-control address-checkbox" value="home" {{ $customer->address()->where('type','Home')->count() ? 'checked' : '' }}/>

                            <label>Work</label>
                            <input type="checkbox" name="address_checkbox[]" class="form-control address-checkbox" value="work" {{ $customer->address()->where('type','Work')->count() ? 'checked' : '' }}/>
                        </div>
                    </div>
                    @foreach(array('home','work') as $address_index)
                        @include( \DashboardEntity::get_instance()->getView() . '.clients.partials.addressMultipleInput', array('index' => $address_index, 'val' => $customer->address()->where('type', ucfirst($address_index))->first()) )
                    @endforeach

					{{-- @include( \DashboardEntity::get_instance()->getView() . '.clients.company.EditcompanyAddressInput' ) --}}
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
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
    <script src="https://getaddress.io/js/jquery.getAddress-1.0.0.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				jQuery('.dob').datepicker({
				    autoclose:true,
				    format: 'yyyy-mm-dd'
				});

                addAddress.init();
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

                $('#home_postcode_lookup').getAddress({
                    api_key: 'zCgWr6M_E0eA-L4drmAXAQ297',
                    output_fields:{
                        line_1: '#home_address_line_1',
                        line_2: '#home_address_line_2',
                        line_3: '#home_address_line_3',
                        post_town: '#home_town',
                        postcode: '#home_postcode'
                    },
                    onAddressSelected: function() {
                        var address = [];
                        if($('#home_address_line_1').val() !== '') address.push($('#home_address_line_1').val());
                        if($('#home_address_line_2').val() !== '') address.push($('#home_address_line_2').val());
                        if($('#home_address_line_3').val() !== '') address.push($('#home_address_line_3').val());
                        $('#home_address').val(address.join('\n'));
                    }
                });

                $('#work_postcode_lookup').getAddress({
                    api_key: 'zCgWr6M_E0eA-L4drmAXAQ297',
                    output_fields:{
                        line_1: '#work_address_line_1',
                        line_2: '#work_address_line_2',
                        line_3: '#work_address_line_3',
                        post_town: '#work_town',
                        postcode: '#work_postcode'
                    },
                    onAddressSelected: function() {
                        var address = [];
                        if($('#work_address_line_1').val() !== '') address.push($('#work_address_line_1').val());
                        if($('#work_address_line_2').val() !== '') address.push($('#work_address_line_2').val());
                        if($('#work_address_line_3').val() !== '') address.push($('#work_address_line_3').val());
                        $('#work_address').val(address.join('\n'));
                    }
                });


            });
		</script>
	@stop
@stop

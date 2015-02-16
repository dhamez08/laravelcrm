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
			.phone-wrapper, .email-wrapper, .children-wrapper, .clone-children, .edit-children-wrapper{
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
		{{ Form::model(
			$customer,
			array(
				'action' => array('Clients\ClientsController@putClientUpdate', $customer->id),
				'method' => 'PUT',
				'role'=>'form',
				'class' =>'form-horizontal'
			))
		}}
		<div class="form-actions">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							{{Form::submit('Update Client',array('class'=>"btn blue btn-sm"))}}
							<a class="btn {{{$dashboard_css or 'blue'}}} btn-sm" href="{{url('clients/client-summary/' . $customer->id)}}">Go back to Client Summary</a>
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
					@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.EditPersonalInput' )
				</div>
				<div class="col-md-6 right-form">
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
				</div>
				{{
					Form::hidden(
						'type',
						null,
						array(
							'class'=>'form-control input-sm'
						)
					);
				}}
				@if( $belongToPartner && $belongToPartner->id )
					{{
						Form::hidden(
							'associated',
							$belongToPartner->id,
							array(
								'class'=>'form-control input-sm'
							)
						);
					}}
				@endif
			</div>

			<div class="hide" id="partner_details">
				<div class="row">
					<div class="col-md-12">
						<h3 class="form-section">Partner Info</h3>
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.partnerInput' )
					</div>
				</div>
			</div>

			<div id="children_details" class="show">
				<div class="row">
					<div class="col-md-12">
						<h3 class="form-section">Childrens Details <button class="btn green btn-xs add-row-children" type="button">Add</button></h3>
						@if(count($children) > 0)
							@foreach($children as $chldrn)
								@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.editChildrenInput', array('childrenIdx' => $chldrn->children_id, 'val' => $chldrn) )
							@endforeach
						@endif
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.childrenInput' )
					</div>
				</div>
			</div>			

			<div class="row">
				<div class="col-md-6">
					<h3 class="form-section">Telephone Number <button class="btn green btn-xs add-phone" type="button">Add</button></h3>
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
					<h3 class="form-section">Email <button class="btn green btn-xs add-email" type="button">Add</button></h3>
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
			<div id="website-customfields-container">
				<div class="row">
					<div class="col-md-6">
						<h3 class="form-section">Website <button class="btn green btn-xs add-website" type="button">Add</button></h3>
						@if( isset($url) )
							<?php $urlIdx = 0; ?>
							@foreach( $url->get() as $val )
								@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.EditUrlInput' )
								<?php $urlIdx++; ?>
							@endforeach
						@endif
						@include( \DashboardEntity::get_instance()->getView() . '.clients.partials.urlInput' )
					</div>
					<div class="col-md-6">
						<h3 class="form-section">Custom Fields</h3>
						<?php
						$customFields = \CustomField\CustomField::where('user_id',\Auth::id())->get();
						?>
						@if(count($customFields) > 0)
						    @foreach($customFields as $cfield)
						    <?php $field_data = $cfield->fieldDataByCustomerAndField($customer->id, $cfield->id); ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{ $cfield->label }}</label>
                                    <div class="col-md-9">
                                        {{
                                            Form::text(
                                                'custom_field['.$cfield->id.']',
                                                 $field_data ? $field_data->value:null,
                                                array(
                                                    'class'=>'form-control input-sm',
                                                    'placeholder'=>$cfield->placeholder
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
							{{Form::submit('Update Client',array('class'=>"btn blue btn-sm"))}}
							<a class="btn {{{$dashboard_css or 'blue'}}} btn-sm" href="{{url('clients/client-summary/' . $customer->id)}}">Go back to Client Summary</a>
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
	{{-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> --}}
	<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client.js"></script>
		<script>
			jQuery(document).ready(function() {
				jQuery('.dob').datepicker({
				    autoclose:true,
				    format: 'dd/mm/yyyy'
				});

				//Metronic.init();
				//Index.init();
				addAddress.init();
				addPhone.init();
				addEmail.init();
				addPartner.init();
				addChildren.init();
				addressLookup.init();
				addWebsite.init();

				addRowChildren.init();
				deletePhone.init();
				deleteURL.init();
				deleteEmail.init();
				deletePerson.init();
				//addPartner.init();
			});
		</script>
	@stop
@stop

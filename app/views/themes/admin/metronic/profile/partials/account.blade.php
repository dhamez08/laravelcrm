@section('head-custom-css')
	@parent
	<link href="{{$asset_path}}/pages/css/client-social-profile.css" rel="stylesheet"/>
@stop
<div class="tab-pane{{(\Session::has('profile') && \Session::get('profile') == 'account-settings') ? ' active': ''}}" id="tab_account_settings">
	<div class="container-fluid">
		<div class="row profile-account">
			<div class="col-md-3">
				<ul class="ver-inline-menu tabbable margin-bottom-10">
					<li class="{{(\Session::has('account-settings')) ? ((\Session::get('account-settings') == 'personal_info') ? ' active': '') : ' active'}}">
						<a data-toggle="tab" href="#tab_personal_info">
						<i class="fa fa-cog"></i> Personal info </a>
						<span class="after">
						</span>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_change_avatar">
						<i class="fa fa-picture-o"></i> Company Logo </a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_change_password">
						<i class="fa fa-lock"></i> Change Password </a>
					</li>
					<li>
						<a data-toggle="tab" href="#url_account">
						<i class="fa fa-cloud"></i> URL Account </a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_sms">
						<i class="fa fa-mobile-phone"></i> SMS Account </a>
					</li>
					<li class="{{(\Session::has('account-settings') && \Session::get('account-settings') == 'social-profile') ? ' active': ''}}">
						<a data-toggle="tab" href="#tab_social_media_account">
							<i class="fa fa-globe"></i> Social Media Account </a>
					</li>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="tab-content">
					<div id="tab_personal_info" class="tab-pane{{(\Session::has('account-settings')) ? ((\Session::get('account-settings') == 'personal_info') ? ' active': '') : ' active'}}">
							{{
								Form::model(
									$user,
									array(
										'action' => array('Profile\ProfileController@putAccount', $user->id),
										'method' => 'PUT'
									)
								)
							}}
							<p>
								 Your Contact Infomation
							</p>
							<div class="form-group">
								<label class="control-label">Title</label>
									{{
										Form::select(
											'title',
											array(
												'0'=>'Please Select Title',
												'Mr' => 'Mr',
												'Mrs' => 'Mrs',
												'Ms' => 'Ms',
												'Miss' => 'Miss',
											),
											null,
											array('class'=>'form-control')
										)
									}}
							</div>
							<div class="form-group">
								<label class="control-label">First Name</label>
								{{
									Form::text(
										'first_name',
										null,
										array(
											'placeholder'=>'First Name',
											'class'=>'form-control placeholder-no-fix'
										)
									);
								}}
							</div>
							<div class="form-group">
								<label class="control-label">Surname</label>
								{{
									Form::text(
										'last_name',
										null,
										array(
											'placeholder'=>'Surname',
											'class'=>'form-control placeholder-no-fix'
										)
									);
								}}
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								{{
									Form::text(
										'email',
										null,
										array(
											'placeholder'=>'Email',
											'class'=>'form-control placeholder-no-fix'
										)
									);
								}}
							</div>
							<div class="form-group">
								<label class="control-label">Phone</label>
									{{
										Form::text(
											'telephone',
											null,
											array(
												'placeholder'=>'Phone',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>
                            <div class="form-group">
                                <label class="control-label">Timezone</label>
                                {{
                                    Timezone::selectForm(
                                        $user->timezone,
                                        'Select a timezone',
                                        array(
                                            'name' => 'timezone',
                                            'class'=>'form-control placeholder-no-fix',
                                            'placeholder'=>'Timezone'
                                        ),
                                        array(
                                            'customValue' => 'true'
                                        )
                                    );
                                }}
                            </div>
							<div class="form-group">
								<label class="control-label">Website</label>
									{{
										Form::text(
											'website',
											null,
											array(
												'placeholder'=>'Website',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div> 
							<div class="form-group">
								<label class="control-label">Birthdate</label>
									{{
										Form::text(
											'birthdate',
											\Carbon\Carbon::createFromFormat('Y-m-d', $user->birthdate)->format('d/m/Y'),
											array(
												'placeholder'=>'Birthdate',
												'class'=>'form-control placeholder-no-fix',
												'id'=>'birthdate'
											)
										);
									}}
							</div>
							<div class="form-group">
								<label class="control-label">Occupation</label>
									{{
										Form::text(
											'occupation',
											null,
											array(
												'placeholder'=>'Occupation',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>							
							<p>
								Company Information
							</p>
							<div class="form-group">
								<label class="control-label">Company</label>
									{{
										Form::text(
											'company',
											null,
											array(
												'placeholder'=>'Company',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>
							<div class="form-group">
								<label class="control-label">Address</label>
									{{
										Form::text(
											'address_line',
											null,
											array(
												'placeholder'=>'Address',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>
							<div class="form-group">
								<label class="control-label">Town</label>
									{{
										Form::text(
											'address_town',
											null,
											array(
												'placeholder'=>'Town',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>
							<div class="form-group">
								<label class="control-label">County</label>
									{{
										Form::text(
											'address_county',
											null,
											array(
												'placeholder'=>'County',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>
							<div class="form-group">
								<label class="control-label">Postcode</label>
									{{
										Form::text(
											'address_postcode',
											null,
											array(
												'placeholder'=>'Postcode',
												'class'=>'form-control placeholder-no-fix'
											)
										);
									}}
							</div>
							<div class="form-group">
								<label class="control-label">SMS Display Name</label>
								<div class="controls">
									{{
										Form::text(
											'sms',
											null,
											array(
												'placeholder'=>'SMS Display Name',
												'class'=>'form-control placeholder-no-fix',
											)
										);
									}}
								</div>
							</div>
							<div class="margiv-top-10">
								{{Form::submit('Save Changes',array('class'=>'btn green'))}}
								<a href="#" class="btn default">
								Cancel </a>
							</div>
						{{Form::close()}}
					</div>
					<div id="tab_change_avatar" class="tab-pane">
						{{
							Form::model(
								$user,
								array(
									'action' => array('Profile\ProfileController@putAccountLogo', $user->id),
									'method' => 'PUT',
									'role'=>'form',
									'files' => true
								)
							)
						}}
							<div class="form-group">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
										@if( $group->logo )
											<img src="{{URL::asset('public/img/company_logos/' . $group->logo)}}" alt="" style="max-width: 200px; max-height: 150px;"/>
										@else
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" style="max-width: 200px; max-height: 150px;"/>
										@endif

									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
									</div>
									<div>
										<span class="btn default btn-file">
										<span class="fileinput-new">
										Select image </span>
										<span class="fileinput-exists">
										Change </span>
										{{Form::file('logo')}}
										</span>
										<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
										Remove </a>
									</div>
								</div>
								<div class="clearfix margin-top-10">
									<span class="label label-danger">
									NOTE! </span>
									<span>
									Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
								</div>
							</div>
							<div class="margin-top-10">
								{{Form::submit('Upload Logo',array('class'=>'btn green'))}}
								<a href="#" class="btn default">
								Cancel </a>
							</div>
						{{Form::close()}}
					</div>
					<div id="tab_change_password" class="tab-pane">
						{{
							Form::model(
								$user,
								array(
									'action' => array('Profile\ProfileController@putUpdatePassword', $user->id),
									'method' => 'PUT'
								)
							)
						}}
							<div class="form-group">
								<label class="control-label">Current Password</label>
								{{
									Form::password(
										'password',
										array(
											'class'=>'form-control'
										)
									);
								}}
							</div>
							<div class="form-group">
								<label class="control-label">New Password</label>
								{{
									Form::password(
										'new_password',
										array(
											'class'=>'form-control'
										)
									);
								}}
							</div>
							<div class="form-group">
								<label class="control-label">Re-type New Password</label>
								{{
									Form::password(
										'new_password_confirmation',
										array(
											'class'=>'form-control'
										)
									);
								}}
							</div>
							<div class="margin-top-10">
								{{Form::submit('Change Password',array('class'=>'btn green'))}}
								<a href="#" class="btn default">
								Cancel </a>
							</div>
						{{Form::close()}}
					</div>
					<div id="url_account" class="tab-pane">
						<h2>URL Accounts</h2>
						{{
							Form::model(
								$user,
								array(
									'action' => array('Profile\ProfileController@putUpdateUrlAccount', $user->id),
									'method' => 'PUT'
								)
							)
						}}
							<div class="form-group">
								<label class="control-label">Google Calendar ID <i class="fa fa-info-circle text-info" id="gcal-help"></i></label>
								<div class="hidden" id="gcal-help-content">
									<p><strong>Make your Google Calendar public:</strong></p>
									<ol>
										<li>In the Google Calendar interface, locate the "My calendars" area on the left.</li>
										<li>Hover over the calendar you need and click the downward arrow.</li>
										<li>A menu will appear. Click "Share this Calendar".</li>
										<li>Check "Make this calendar public".</li>
										<li>Make sure "Share only my free/busy information" is <strong>unchecked</strong>.</li>
										<li>Click "Save".</li>
									</ol>
									<p><strong>Obtain your Google Calendar's ID:</strong></p>
									<ol>
										<li>In the Google Calendar interface, locate the "My calendars" area on the left.</li>
										<li>Hover over the calendar you need and click the downward arrow.</li>
										<li>A menu will appear. Click "Calendar settings".</li>
										<li>In the "Calendar Address" section of the screen, you will see your Calendar ID.
										It will look something like "abcd1234@group.calendar.google.com".</li>
										<li>Copy and paste the Calendar ID below.</li>
									</ol>
								</div>
								<div class="controls">
									{{
										Form::text(
											'meta[google_calendar_feed]',
											\User\UserEntity::get_instance()->getGoogleCalendarFeedURL() ? \User\UserEntity::get_instance()->getGoogleCalendarFeedURL():null,
											array(
												'class'=>'form-control placeholder-no-fix',
											)
										);
									}}
								</div>
							</div>
							<div class="margiv-top-10">
								{{Form::submit('Save Changes',array('class'=>'btn green'))}}
							</div>
						{{Form::close()}}
					</div>
					<div id="tab_sms" class="tab-pane">
						<form action="#">
							<h2>SMS</h2>
							<ul class="list-group">
							@if( count($get_sms_purchase) > 0 )
								@foreach($get_sms_purchase as $key_sms => $sms_purchase)
									<li class="list-group-item">
										<a href="{{action('SMS\SMSController@getPurchaseSms',$key_sms)}}" class="btn btn-primary btn-lg" role="button">Purchase {{$key_sms}} SMS Credits - {{$get_currency}}{{$sms_purchase}}</a>
									</li>
								@endforeach
							@endif
							</ul>
						</form>
					</div>

					<div id="tab_social_media_account" class="tab-pane{{(\Session::has('account-settings') && \Session::get('account-settings') == 'social-profile') ? ' active': ''}}">
						<h2>Social Media Accounts</h2>
						<div class="col-lg-12">
							<div class="row">
								<span>Get Connected to Social Networking Site:</span>
								<br />
								<?php $providers = Config::get('anvard::hybridauth.providers'); ?>
								<ul class="social-icons">
									@foreach($providers as $provider_key => $provider_value)
									<?php
										$key = strtolower($provider_key);
										if($key == "google"){
											$class = "googleplus";
											$title = "Google Plus";
											$key = "google";
										} else {
											$class = $key;
											$title = $provider_key;
											$key = $key;
										}
									?>
										@if($provider_value['enabled'] && !in_array(strtolower($provider_key),\SocialMediaAccount\ProfileEntity::get_instance()->getConnectedProviders()))
											<li>
												<a href="{{url('social/'.$key)}}" data-original-title="{{$title}}" class="{{$class}}">
												</a>
											</li>
										@endif
									@endforeach
								</ul>
								<span class="social-loading"></span>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="row">
								<hr />
								<?php $social = \SocialMediaAccount\ProfileEntity::get_instance()->getMediaAccount(); ?>
								@if(count($social) > 0)
									@foreach($social as $account)
										<div class="col-md-6 col-sm-4 col-lg-4">

												<!-- BEGIN Portlet PORTLET-->
												<div class="portlet box green-meadow">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-{{strtolower($account->provider)}}"></i>
															<span class="caption-subject bold uppercase">
																{{$account->provider}}
															</span>
														</div>
														<div class="tools">
															<a href="" class="collapse"></a>
															<a href="" title="Used as Profile photo" data-profile-id="{{$account->id}}" class="config social-profile-config"></a>
															<!--
															<a href="" class="reload"></a>
															<a href="" class="remove"></a>
															-->
														</div>
													</div>
													<div class="portlet-body">
														<div class="row">
															<div class="social-img col-xs-2 col-sm-12 col-md-3">
																<a href="{{$account->profileURL}}" target="_blank">
																	<img src="{{$account->photoURL}}" style="width:60px;" />
																</a>
															</div>
															<div class="social-detail col-xs-10 col-sm-12 col-md-9">
																<div class="row">
																	<ul>
																		<li class="profile-name">{{$account->displayName}}</li>
																		<li class="profile-email">{{$account->email}}</li>
																	</ul>
																</div>
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
												</div>
												<!-- END GRID PORTLET-->

										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end col-md-9-->
		</div>
	</div>

</div>

@section('script-footer')
	@parent

	@section('footer-custom-js')
		<script>
			$(function(){
				$(document).on("click","ul.social-icons li a",function(){
					$("span.social-loading").html('<i class="fa fa-spinner fa-spin"></i> Connecting Account to ' + $(this).attr('data-original-title'));
				});

				$(document).on("click","a.social-profile-config",function(e){
					e.preventDefault();
					var dataId = $(this).attr('data-profile-id');
					$.get("{{url('profile/setprimary')}}",{ id: dataId },function(response){
						if(response.status == true){
							$("img.img-avatar-top").attr("src",response.profile['photoURL']);
						}
					});
				});

				$('#birthdate').datepicker({
				    autoclose:true,
				    format: 'dd/mm/yyyy'
				});					
			});
		</script>
	@stop
@stop
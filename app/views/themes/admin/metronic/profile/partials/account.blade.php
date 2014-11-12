<div class="tab-pane" id="tab_account_settings">
	<div class="container-fluid">
		<div class="row profile-account">
			<div class="col-md-3">
				<ul class="ver-inline-menu tabbable margin-bottom-10">
					<li class="active">
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
				</ul>
			</div>
			<div class="col-md-9">
				<div class="tab-content">
					<div id="tab_personal_info" class="tab-pane active">
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
								<label class="control-label">Google Calendar Feed</label>
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
				</div>
			</div>
			<!--end col-md-9-->
		</div>
	</div>

</div>

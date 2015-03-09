@extends( $master_view )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="{{$asset_path}}/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/pages/css/login.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop
@section('body-content')
		<div class="logo">
			<a href="{{url('/')}}">
			<img style="width: 375px;" alt="" src="{{$asset_path}}/layout/img/123crm_logo.jpg">
			</a>
		</div>
		<div class="content">
			{{ HTML::ul($errors->all(),array('class' => 'list-group list-unstyled error list-group-item list-group-item-danger')) }}

			@if (Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif

			{{ Form::open(
				array(
						'action' => array('RegisterController@postStore'),
						'method' => 'POST',
						'role'=>'form',
						'class'=>'login-form'
					)
				)
			}}
				<h3>Sign Up</h3>
				<p>
					 Your Contact Infomation
				</p>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Title</label>
					<div class="input-icon">
						<i class="fa fa-font"></i>
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
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">First Name</label>
					<div class="input-icon">
						<i class="fa fa-font"></i>
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
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Surname</label>
					<div class="input-icon">
						<i class="fa fa-font"></i>
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
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Email</label>
					<div class="input-icon">
						<i class="fa fa-envelope"></i>
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
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Phone</label>
					<div class="input-icon">
						<i class="fa fa-phone"></i>
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
				</div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Timezone</label>
                    <div class="input-icon">
                        <i class="fa fa-globe"></i>
                        {{
                            Timezone::selectForm(
                                null,
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
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Website</label>
                    <div class="input-icon">
                        <i class="fa fa-globe"></i>
                        {{
                            Form::text(
                            	'website',
                            	null,
                            	array(
                            		'placeholder' => 'Website',
                            		'class' => 'form-control placeholder-no-fix'
                            	)
                            )
                        }}
                    </div>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Birthdate</label>
                    <div class="input-icon">
                        <i class="fa fa-birthday-cake"></i>
                        {{
                            Form::text(
                            	'birthdate',
                            	null,
                            	array(
                            		'placeholder' => 'Birthdate',
                            		'class' => 'form-control placeholder-no-fix',
                            		'id' => 'birthdate'
                            	)
                            )
                        }}
                    </div>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Occupation</label>
                    <div class="input-icon">
                        <i class="fa fa-briefcase"></i>
                        {{
                            Form::text(
                            	'occupation',
                            	null,
                            	array(
                            		'placeholder' => 'Occupation',
                            		'class' => 'form-control placeholder-no-fix'
                            	)
                            )
                        }}
                    </div>
                </div>                
				<p>
					Company Information
				</p>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Company</label>
					<div class="input-icon">
						<i class="fa fa-building"></i>
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
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Address</label>
					<div class="input-icon">
						<i class="fa fa-home"></i>
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
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Town</label>
					<div class="input-icon">
						<i class="fa fa-home"></i>
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
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">County</label>
					<div class="input-icon">
						<i class="fa fa-home"></i>
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
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Postcode</label>
					<div class="input-icon">
						<i class="fa fa-home"></i>
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
				</div>
				<p>
					Website Preference
				</p>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Username</label>
					<div class="input-icon">
						<i class="fa fa-user"></i>
						{{
							Form::text(
								'username',
								null,
								array(
									'placeholder'=>'Username',
									'class'=>'form-control placeholder-no-fix',
									'autocomplete'=>'off'
								)
							);
						}}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						{{
							Form::password(
								'password',
								array(
									'placeholder'=>'Password',
									'class'=>'form-control placeholder-no-fix',
									'id'=>'register_password',
								)
							);
						}}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
					<div class="controls">
						<div class="input-icon">
							<i class="fa fa-check"></i>
							{{
							Form::password(
								'password_confirmation',
								array(
									'placeholder'=>'Re-type Your Password',
									'class'=>'form-control placeholder-no-fix',
								)
							);
						}}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">SMS Display Name</label>
					<div class="controls">
						<div class="input-icon">
							<i class="fa fa-user"></i>
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
				</div>
				<div class="form-group">
					<label>
					<div class="checker"><span><input type="checkbox" name="tnc"></span></div> I agree to the <a href="#">
					Terms of Service </a>
					and <a href="#">
					Privacy Policy </a>
					</label>
					<div id="register_tnc_error">
					</div>
				</div>
				<div class="form-actions">
					<button class="btn" type="button" id="register-back-btn">
					<i class="m-icon-swapleft"></i> Back </button>
					<button class="btn green pull-right" id="register-submit-btn" type="submit">
					Sign Up <i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>
			{{Form::close()}}
		</div>
@stop
@section('body-footer')
	<!-- BEGIN FOOTER -->
	<div class="copyright">
	 2014 &copy; {{{$copyright or 'Put Copyright text'}}}.
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#birthdate').datepicker({
			    autoclose:true,
			    format: 'dd/mm/yyyy'
			});	
		});
	</script>
	<!-- END FOOTER -->
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
		<script src="{{$asset_path}}/pages/scripts/login.js" type="text/javascript"></script>
	@stop
	@section('footer-custom-js')
		<script>
			jQuery(document).ready(function() {
				Metronic.init(); // init metronic core components
				Layout.init(); // init current layout
				Login.init();
				$('.error > li').addClass('list-group-item list-group-item-danger');			
			});
		</script>
	@stop
@stop



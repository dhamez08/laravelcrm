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
			<a href="index_3.html">
			<img style="width: 375px;" alt="" src="{{$asset_path}}/layout/img/123crm_logo.jpg">
			</a>
		</div>
		<div class="content">
			{{ HTML::ul($errors->all(),array('class' => 'list-group error')) }}

			@if (Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif

			<form method="post" action="index_3.html" class="login-form" novalidate="novalidate" style="display: block;">
				<h3 class="form-title">Login to your account</h3>
				<div class="alert alert-danger display-hide">
					<button data-close="alert" class="close"></button>
					<span>
					Enter any username and password. </span>
				</div>
				<div class="form-group">
					<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
					<label class="control-label visible-ie8 visible-ie9">Username or Email</label>
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input type="text" name="username" placeholder="Username or Email" autocomplete="off" class="form-control placeholder-no-fix" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center; cursor: auto;">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label visible-ie8 visible-ie9">Password</label>
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;">
					</div>
				</div>
				<div class="form-actions">
					<label style="visibility:hidden" class="checkbox">
					<div class="checker"><span><input type="checkbox" value="1" name="remember"></span></div> Remember me </label>
					<button class="btn green pull-right" type="submit">
					Login <i class="m-icon-swapright m-icon-white"></i>
					</button>
				</div>
				<div class="login-options">
					<h4>Or login with</h4>
					<ul class="social-icons">
						<li>
							<a href="#" data-original-title="facebook" class="facebook">
							</a>
						</li>
						<li>
							<a href="#" data-original-title="Twitter" class="twitter">
							</a>
						</li>
						<li>
							<a href="#" data-original-title="Goole Plus" class="googleplus">
							</a>
						</li>
						<li>
							<a href="#" data-original-title="Linkedin" class="linkedin">
							</a>
						</li>
					</ul>
				</div>
				<div class="forget-password">
					<h4>Forgot your password ?</h4>
					<p>
						 no worries, click <a id="forget-password" href="javascript:;">
						here </a>
						to reset your password.
					</p>
				</div>
				<div class="create-account">
					<p>
						 Don't have an account yet ?&nbsp; <a id="register-btn" href="{{url('register')}}">
						Create an account </a>
					</p>
				</div>
			</form>
		</div>
@stop
@section('body-footer')
	<!-- BEGIN FOOTER -->
	<div class="copyright">
	 2014 &copy; {{{$copyright or 'Put Copyright text'}}}.
	</div>
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
			});
		</script>
	@stop
@stop



<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Hello {{$name}}</h2>
		<div>
			<p>Thank you for registering with us</p>
			<p>Before you can start using your account, you must verify your email address. </p>
			<p>To do this, simply follow the link displayed below and your account will be activated.</p>
			<p>
				<a href="{{url('confirm/' . $confirm_code)}}">{{url('confirm/' . $confirm_code)}}</a>
			</p>
			<p>Thank you</p>
			<p>CRM Team</p>
		</div>
	</body>
</html>

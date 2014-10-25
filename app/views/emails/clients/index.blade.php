<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>
			<p>{{ $body }}</p>
			@if(isset($footer))
			<hr />
			<p>{{ $footer }}</p>
			@endif
		</div>
	</body>
</html>

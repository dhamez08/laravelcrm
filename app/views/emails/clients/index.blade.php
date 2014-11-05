<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
<?php
// preg_match_all('/img src="([^"]*)"/', $body, $matchesimage);

// if(count($matchesimage[0])>0) {
// 	foreach($matchesimage[1] as $matchImage) {

// 	}
// }
// dd($replacement_image_url);
?>
		<div>
			<p>{{ $body }}</p>
			@if(isset($footer))
			<hr />
			<p>{{ $footer }}</p>
			@endif
		</div>
	</body>
</html>

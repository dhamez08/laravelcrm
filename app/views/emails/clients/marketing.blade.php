<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">

</head>
<body>
<div>
    <div>
        <style> @media (max-width: 640px) { .section-area { width: 100% !important; padding: 0 !important; } .inner-section { padding: 10px 0 !important; } .inner-section div { width: 100% !important; display: block !important; margin: 0 auto !important; text-align: center !important; padding: 5px 0 !important; } .scaled-image { width: 80% !important; height: auto !important; } p { text-align: center !important; } .inner-section div.div-button { width: 90% !important; margin-top: 10px !important; margin-bottom: 10px !important; } } </style>
        <style>{{ $style or '' }}</style>
        {{ $body }}
    </div>
    @if(isset($footer))
    <div>{{ $footer }}</div>
    @endif
</div>
</body>
</html>

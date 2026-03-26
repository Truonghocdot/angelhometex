<!DOCTYPE html>
<html{!! $htmlAttributes !== '' ? ' '.$htmlAttributes : '' !!}>
<head>
{!! $headHtml !!}
</head>
<body{!! $bodyAttributes !== '' ? ' '.$bodyAttributes : '' !!}>
@yield('page-content')
</body>
</html>

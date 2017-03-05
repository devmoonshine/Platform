<!DOCTYPE html>
<html>
<head>
	<title>Upload Picture</title>
	<!-- Using Foundation this time! -->
	<link rel="stylesheet" href="/css/foundation.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	<div class="row">
		<div class="large-12 columns">
			<div class="logo">
				<a href="{{ route('createImage') }}">$pic->upload();</a>
			</div>
		</div>
	</div>
	@yield('content')
</body>
</html>
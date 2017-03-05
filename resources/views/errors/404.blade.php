@extends('uploader.master')

@section('content')
	<div class="row">
		<div class="large-6 large-offset-3 columns">
			<div class="container">
				<div class="logo"><a href="{{ route('createImage') }}">:(</a></div>
				<p class="error_message">Seems like we don't have this image...</p>
			</div>
			<a href="{{ route('createImage') }}">Upload your image</a>
		</div>
	</div>

@endsection
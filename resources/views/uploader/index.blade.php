@extends('uploader.master')

@section('content')
	<div class="row">
		<div class="large-6 large-offset-3 columns">
			<div class="container">
				<a href="{{ $image }}"><img src="{{ $image }}" alt="Uploaded Image"></a>
				Link: <textarea>{{ $image }}</textarea>
			</div>
			<a href="{{ route('createImage') }}" class="suggest">Upload your image</a>
		</div>
	</div>

@endsection
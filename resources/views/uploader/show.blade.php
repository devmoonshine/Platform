@extends('uploader.master')

@section('content')
		<div class="row">
			<div class="large-6 large-offset-3 columns">
				<div class="container">
					@include('layouts.errors')
					<form method="post" action="{{ route('createImage') }}" enctype="multipart/form-data">
						<input type="file" name="image">
						<button type="submit" class="button expanded">Upload</button>
						{{ method_field('PUT') }}
						{{ csrf_field() }}
					</form>
				</div>
		</div>
	</div>

@endsection
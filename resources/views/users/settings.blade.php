@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">
                    <form action="/users/settings" method="post" enctype="multipart/form-data" name="image" id="image">
                        <input type="file" name="image" id="image">
                        <button type="submit">Update</button>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

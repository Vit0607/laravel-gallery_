@extends('layout')

@section('content')
<div class="container">
    <h1 align="center">My Gallery</h1>
    <div class="row">
        @foreach ($imagesInView as $image)
        <div class="col-md-3 gallery-item"><img src="/{{$image->image}}" class="img-thumbnail" alt="php">
            <a href="/show/{{$image->id}}" class="btn btn-info my-button">Show</a>
            <a href="/edit/{{$image->id}}" class="btn btn-warning my-button">Edit</a>
            <a type="#" class="btn btn-danger my-button">Delete</a>
        </div>
        @endforeach
    </div>
</div>
@endsection

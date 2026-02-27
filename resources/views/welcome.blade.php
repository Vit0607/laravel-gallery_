@extends('layout')

@section('content')
<div class="container">
    <h1 align="center">My Gallery</h1>
    <div class="row">
        <div class="col-md-3 gallery-item"><img src="/image.png" class="img-thumbnail" alt="php">
            <a href="/show" class="btn btn-info my-button">Show</a>
            <a type="/edit" class="btn btn-warning my-button">Edit</a>
            <a type="#" class="btn btn-danger my-button">Delete</a>
        </div>
    </div>
</div>
@endsection

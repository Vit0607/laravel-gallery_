@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Image</h1>
            <img src="/image.png" alt="" class="img-thumbnail" />
            <form action="" method="post">
                <div class="form-control">
                    <input type="file" />
                </div>
                <button class="btn btn-danger">Edit</button>
            </form>
        </div>
    </div>
</div>
@endsection

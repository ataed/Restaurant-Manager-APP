@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-align-justify"></i> Edit Category
        <hr>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="form-group" method="POST" action="/management/category/{{$category->id}}">
            <!-- To protect from cross-site request forgery(CSRF) -->
            @csrf

            @method('PUT')
            <div class="form-group">
                <label for="categoryName">New Name</label>
                <input type="text" class="form-control" placeholder="Category..." name="name"
                    value="{{$category->name}}">

            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>

    </div>

    <hr>

</div>


</div>






@endsection
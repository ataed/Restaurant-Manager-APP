@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-align-hamburger"></i> Edit Menu
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

        <form class="form-group" method="POST" action="/management/menu/{{$menu->id}}" enctype="multipart/form-data">
            <!-- To protect from cross-site request forgery(CSRF) -->
            @csrf

            @method('PUT')
            <div class="form-group">
                <label for="menuName">Menu Name</label>
                <input type="text" class="form-control" placeholder="Menu Name..." value="{{$menu->name}}" name="name">

            </div>

            <label for="menuPrice">Price</label>
            <div class="input-group">
                <input value="{{$menu->price}}" name="price" type="text" class="form-control"
                    aria-label="Dollar amount (with dot and two decimal places)">
                <div class="input-group-append">
                    <span class="input-group-text">$</span>
                    <span class="input-group-text">0.00</span>
                </div>
            </div>
            <label for="menuImage">Image</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="menuDescription">Description</label>
                <input type="text" value="{{$menu->description}}" class="form-control" name="description"
                    placeholder="Menu Description...">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$menu->category_id === $category->id ? 'selected' : ''}}>
                        {{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>

    </div>

    <hr>

</div>


</div>






@endsection
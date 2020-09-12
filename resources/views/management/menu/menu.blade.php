@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-hamburger"></i> Menu
        <a class="btn btn-success btn-sm float-right" href="/management/menu/create">
            <i class="fas fa-plus"></i>
            Create Menu
        </a>
        <hr>
        @if(session()->has('status'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{session()->get('status')}}
        </div>
        @endif



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scop="col">ID</th>
                    <th scop="col">Name</th>
                    <th scop="col">Price</th>
                    <th scop="col">Picture</th>
                    <th scop="col">Description</th>
                    <th scop="col">Category</th>
                    <th scop="col">Edit</th>
                    <th scop="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td scop="row">{{$menu->id}}</td>
                    <td scop="row">{{$menu->name}}</td>
                    <td scop="row">{{$menu->price}}</td>

                    <td scop="row">{{$menu->description}}</td>
                    <td scop="row">
                        <img src="{{asset('/img/menuImages')}}/{{$menu->image}}" alt="{{$menu->name}}" width="120px"
                            height="120px" class="img-thumbnail" />
                    </td>
                    <td scop="row">{{$menu->category->name}}</td>
                    <td scop="row">
                        <a href='/management/menu/{{$menu->id}}/edit' class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="/management/menu/{{$menu->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">

                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>






    </div>
</div>
@endsection
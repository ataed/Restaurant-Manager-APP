@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-align-justify"></i> Category
        <a class="btn btn-success btn-sm float-right" href="/management/category/create">
            <i class="fas fa-plus"></i>
            Create Category
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
                    <th scop="col">Edit</th>
                    <th scop="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td scop="row">{{$category->id}}</td>
                    <td scop="row">{{$category->name}}</td>
                    <td scop="row">
                        <a class="btn btn-warning" href="/management/category/{{$category->id}}/edit">Edit</a>
                    </td>

                    <td>
                        <form action="/management/category/{{$category->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">

                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{$categories->links()}}





    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-users"></i> Users
        <a class="btn btn-success btn-sm float-right" href="/management/user/create">
            <i class="fas fa-plus"></i>
            Add New User
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
                    <th scop="col">Email</th>
                    <th scop="col">Role</th>
                    <th scop="col">Edit</th>
                    <th scop="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td scop="row">{{$user->id}}</td>
                    <td scop="row">{{$user->name}}</td>
                    <td scop="row">{{$user->email}}</td>
                    <td scop="row">{{$user->role}}</td>



                    <td scop="row">
                        <a href='/management/user/{{$user->id}}/edit' class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="/management/user/{{$user->id}}" method="POST">
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
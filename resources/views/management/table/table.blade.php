@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-chair"></i> Table
        <a class="btn btn-success btn-sm float-right" href="/management/table/create">
            <i class="fas fa-plus"></i>
            Create Table
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
                    <th scop="col">Status</th>
                    <th scop="col">Edit</th>
                    <th scop="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tables as $table)
                <tr>
                    <td scop="row">{{$table->id}}</td>
                    <td scop="row">{{$table->name}}</td>
                    <td scop="row">{{$table->status}}</td>


                    <td scop="row">
                        <a href='/management/table/{{$table->id}}/edit' class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="/management/table/{{$table->id}}" method="POST">
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
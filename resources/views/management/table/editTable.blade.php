@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-chair"></i> Edit Table
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

        <form class="form-group" method="POST" action="/management/table/{{$table->id}}">
            <!-- To protect from cross-site request forgery(CSRF) -->
            @csrf

            @method('PUT')
            <div class="form-group">
                <label for="tableName">New Name</label>
                <input type="text" class="form-control" placeholder="table..." name="name" value="{{$table->name}}">

            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>

    </div>

    <hr>

</div>


</div>






@endsection
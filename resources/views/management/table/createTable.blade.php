@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        @include('management.inc.sidebar')

    </div>

    <div class="col-md-8">
        <i class="fas fa-chair"></i> Create Table
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

        <form class="form-group" method="POST" action="/management/table">
            <!-- To protect from cross-site request forgery(CSRF) -->
            @csrf
            <div class="form-group">
                <label for="tableName">Name</label>
                <input type="text" class="form-control" placeholder="Table Name..." name="name">
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>

    </div>

    <hr>

</div>


</div>






@endsection
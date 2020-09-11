@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row text-center">
                        <div class="col-sm-3">
                            <a href='/management'>
                                <h4>Management</h4>
                                <img width="50px" src="{{asset('img/data-management.svg')}}" />

                            </a>

                        </div>
                        <div class="col-sm-3">
                            <a href='/cashier'>
                                <h4>Cashier</h4>
                                <img width="50px" src=" {{asset('img/cashier.svg')}}" />

                            </a>

                        </div>
                        <div class="col-sm-3">
                            <a href='/report'>
                                <h4>Report</h4>
                                <img width="50px" src=" {{asset('img/seo-report.svg')}}" />

                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
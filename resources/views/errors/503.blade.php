@extends('errors.layouts.errors')

@section('content')
    <h1 class="error-text fw-bold">503</h1>
    <h4><i class="fa fa-times-circle text-danger"></i> Service Unavailable</h4>
    <p>Sorry, we are under maintenance!</p>
    <div>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back to Home</a>
    </div>
@endsection

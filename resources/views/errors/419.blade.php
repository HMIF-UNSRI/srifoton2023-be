@extends('errors.layouts.errors')

@section('content')
    <h1 class="error-text fw-bold">419</h1>
    <h4><i class="fa fa-thumbs-down text-danger"></i> Page Expired</h4>
    <p>Page expired, please try again!</p>
    <div>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back to Home</a>
    </div>
@endsection

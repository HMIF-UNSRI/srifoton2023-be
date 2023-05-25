@extends('errors.layouts.errors')

@section('content')
    <h1 class="error-text fw-bold">400</h1>
    <h4><i class="fa fa-thumbs-down text-danger"></i> Bad Request</h4>
    <p>Your Request resulted in an error</p>
    <div>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back to Home</a>
    </div>
@endsection

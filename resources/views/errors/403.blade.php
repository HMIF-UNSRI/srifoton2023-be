@extends('errors.layouts.errors')

@section('content')
    <h1 class="error-text  fw-bold">403</h1>
    <h4><i class="fa fa-times-circle text-danger"></i> Forbidden Error!</h4>
    <p>You do not have permission to view this resource.</p>
    <div>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back to Home</a>
    </div>
@endsection

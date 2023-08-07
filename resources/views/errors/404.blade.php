@extends('errors.layouts.errors')

@section('content')
    <h1 class="error-text fw-bold">404</h1>
    <h4><i class="fa fa-exclamation-triangle text-warning"></i> The page you were looking for is not found!</h4>
    <p>You may have mistyped the address or the page may have moved.</p>
    <div>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back to Home</a>
    </div>
@endsection

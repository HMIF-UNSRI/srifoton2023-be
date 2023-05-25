@extends('layouts.app')

@section('content')
<div class="alert alert-primary alert-dismissible alert-alt fade show bg-white">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
    <div class="d-flex align-items-center ">
        <img src="{{ asset('images/welcome.png')}}" alt="welcome" width="150">
        <h2 class="fw-bold ms-3 text-primary">Selamat Datang {{ Auth::guard('admin')->user()->name }} 👋</h2>
    </div>
    
</div>
@endsection

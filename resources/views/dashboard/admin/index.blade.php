@extends('layouts.app')

@section('content')
    <div class="alert alert-primary alert-dismissible alert-alt fade show bg-white">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
        <div class="d-flex align-items-center ">
            <img src="{{ asset('images/welcome.png') }}" alt="welcome" width="150">
            <h2 class="fw-bold ms-3 text-primary">Selamat Datang {{ Auth::guard('admin')->user()->name }} 👋</h2>
        </div>
    </div>
    <div class="row">
        {{-- Users --}}
        <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-success text-success">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Users</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Seminar --}}
        <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-warning text-warning">
                            <i class="fas fa-microphone"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Seminar</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Competition --}}
        <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-3">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-danger text-danger">
                            <i class="fas fa-laptop"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Competitive Programming</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- UI/UX --}}
        <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-3">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-info text-info">
                            <i class="fas fa-pen-nib"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">UI/UX Design</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Web Development --}}
        <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-3">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-dark text-dark">
                            <i class="fas fa-code"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Web Development</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Legends --}}
        <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-3">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-primary text-primary">
                            <i class="fas fa-gamepad"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Mobile Legends</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

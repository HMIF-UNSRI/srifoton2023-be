@extends('layouts.app')

@section('content')
    <div class="alert alert-light alert-dismissible alert-alt fade show bg-white">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
        <div class="d-flex align-items-center ">
            <img src="{{ asset('images/welcome.png') }}" alt="welcome" width="150">
            <h2 class="fw-bold ms-3 text-primary">Selamat Datang {{ Auth::guard('admin')->user()->name }} 👋</h2>
        </div>
    </div>
    <div class="row">
        {{-- Users --}}
        @can('inti')
            <div class="col-md-4">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-success text-success">
                                <i class="bi bi-people fs-1"></i>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Users</p>
                                <h4 class="mb-0">3280</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @canany(['inti', 'seminar'])
        {{-- Seminar --}}
        <div class="col-md-4">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-warning text-warning">
                            <i class="bi bi-easel fs-1"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Seminar</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcanany

        @canany(['inti', 'competition', 'competitive_programming'])
        {{-- Competitive Programming --}}
        <div class="col-md-4">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-danger text-danger">
                            <i class="bi bi-laptop fs-1"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Competitive Programming</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcanany

        @canany(['inti', 'competition', 'uiux_design'])
        {{-- UI/UX --}}
        <div class="col-md-4">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-info text-info">
                            <i class="bi bi-palette fs-1"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">UI/UX Design</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcanany
        
        @canany(['inti', 'competition', 'web_development'])
        {{-- Web Development --}}
        <div class="col-md-4">
            <div class="widget-stat card" >
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="me-3 bgl-primary text-primary">
                            <i class="bi bi-code-slash fs-1"></i>
                        </span>
                        <div class="media-body">
                            <p class="mb-1">Web Development</p>
                            <h4 class="mb-0">3280</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcanany
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-primary fw-bold">Detail {{ $seminar->name }}
                    <span
                        class="badge light badge-rounded badge-lg ms-2 {{ $seminar->isVerified ? 'badge-success' : 'badge-warning' }}">
                        <i class="{{ $seminar->isVerified ? 'bi bi-cash-stack me-1' : 'bi bi-hourglass-split me-1' }}"></i>
                        {{ $seminar->isVerified ? 'Paid' : 'Awaiting' }}
                    </span>
                </h3>
                <a href="{{ route('seminar') }}" class="d-flex btn light btn-sm btn-primary">
                    <i class="bi bi-box-arrow-left me-2"></i>Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center align-middle justify-content-center">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img src="{{ $seminar->proof }}"
                                    class="img-fluid rounded-1 d-inline-block mx-auto shadow-sm" style="max-height: 300px"
                                    id="proof" alt="">
                            </div>
                            <div class="mt-3">
                                <a href="{{ $seminar->proof }}"
                                    class="btn btn-sm btn-primary light mt-2 w-100 fw-medium" target="blank">
                                    <i class="fas fa-expand me-2"></i>Show Payment Proof</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="product-detail-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="name1">Name</label>
                                    <input class="form-control mb-3" value="{{ $seminar->name }}" type="text" id="name1"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input class="form-control mb-2" value="{{ $seminar->email }}" type="text" id="email"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="nim1">NIM</label>
                                    <input class="form-control mb-3" value="{{ $seminar->nim }}" type="text" id="nim1"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="college1">Institution</label>
                                    <input class="form-control mb-3" value="{{ $seminar->college }}" type="text" id="college1"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number1">Phone Number</label>
                                    <input class="form-control mb-3" value="{{ $seminar->phone_number }}" type="text"
                                        id="phone_number1" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="type">Type</label>
                                    <div class="d-flex">
                                        <span
                                            style="border-radius: 4px; padding-top: 7px; padding-bottom: 7px" class="badge badge-lg light w-100 {{ $seminar->type === 'Offline' ? 'badge-primary' : 'badge-warning' }}">
                                            <i
                                                class="{{ $seminar->type === 'Offline' ? 'bi bi-geo-fill me-1' : 'bi bi-camera-video-fill me-1' }}"></i>
                                            {{ $seminar->type === 'Offline' ? 'Offline' : 'Online' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_method">Payment Method</label>
                                    <input class="form-control mb-3" value="{{ $seminar->payment_method }}" type="text"
                                        id="payment_method" readonly>
                                </div>
                                    
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

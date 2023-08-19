@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-primary fw-bold">Detail {{ $uiux->team_name }} team
                    <span
                        class="badge light badge-rounded badge-lg ms-2 {{ $uiux->isVerified ? 'badge-success' : 'badge-warning' }}">
                        <i class="{{ $uiux->isVerified ? 'bi bi-cash-stack me-1' : 'bi bi-hourglass-split me-1' }}"></i>
                        {{ $uiux->isVerified ? 'Paid' : 'Awaiting' }}
                    </span>
                </h3>
                <a href="{{ route('competition.cp') }}" class="d-flex btn light btn-sm btn-primary">
                    <i class="bi bi-box-arrow-left me-2"></i>Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 d-flex align-items-center align-middle justify-content-center">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img src="{{ $uiux->proof }}"
                                    class="img-fluid rounded-1 d-inline-block mx-auto shadow-sm" style="max-height: 300px"
                                    id="proof" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-detail-content">
                            <label for="email">Team Leader Email</label>
                            <input class="form-control mb-2" value="{{ $uiux->email }}" type="text" id="email"
                                readonly>
                            <label for="college1">Institution</label>
                            <input class="form-control mb-3" value="{{ $uiux->college }}" type="text" id="college1"
                                readonly>
                            <label for="payment_method">Payment Method</label>
                            <input class="form-control mb-3" value="{{ $uiux->payment_method }}" type="text"
                                id="payment_method" readonly>
                            <a href="{{ $uiux->proof }}"
                                class="btn btn-sm btn-primary light mt-2 w-100 fw-medium" target="blank">
                                <i class="fas fa-expand me-2"></i>Show Payment Proof</a>
                            @if ($uiux->submission && !empty($uiux->submission))
                                <a href="{{ route('competition.uiux.download', $uiux->id) }}"
                                    class="btn btn-success shadow mt-3 w-100 fw-medium"> <i
                                        class="fas fa-file-download fs-4 me-2"></i>Download Submission</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @for ($i = 1; $i <= $members; $i++)
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title text-primary fw-bold">Detail Member {{ $i }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 d-flex align-items-center align-middle justify-content-center">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img src="{{ $uiux->{"id_card$i"} }}"
                                        class="img-fluid rounded-1 d-block shadow-sm" style="max-height: 300px"
                                        id="id_card1" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 d-flex align-items-center justify-content-center">
                            <div class="product-detail-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="name1">Name</label>
                                        <input class="form-control mb-3" value="{{ $uiux->{"name$i"} }}" type="text"
                                            id="name1" readonly>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="nim1">NIM</label>
                                        <input class="form-control mb-3" value="{{ $uiux->{"nim$i"} }}" type="text"
                                            id="nim1" readonly>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number1">Phone Number</label>
                                        <input class="form-control mb-3" value="{{ $uiux->{"phone_number$i"} }}"
                                            type="text" id="phone_number1" readonly>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="instagram1">Instagram</label>
                                        <input class="form-control mb-3" value="{{ $uiux->{"instagram$i"} }}"
                                            type="text" id="instagram1" readonly>

                                    </div>
                                </div>

                                <a href="{{ $uiux->{"id_card$i"} }}"
                                    class="btn btn-sm btn-primary light mt-2 w-100 fw-medium" target="blank"><i
                                        class="fas fa-expand me-2"></i>Show Identity Card</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
@endsection

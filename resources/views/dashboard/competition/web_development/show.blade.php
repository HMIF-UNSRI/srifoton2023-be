@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-primary fw-bold">Detail {{ $webdev->team_name }}
                    <span
                        class="badge badge-rounded badge-lg ms-2 {{ $webdev->isVerified ? 'badge-success' : 'badge-warning' }}">
                        <i
                            class="{{ $webdev->isVerified ? 'bi bi-check-circle-fill me-1' : 'bi bi-exclamation-circle me-1' }}"></i>
                        {{ $webdev->isVerified ? 'Verified' : 'Unverified' }}
                    </span>
                </h3>
                <a href="{{ route('competition.webdev') }}" class="btn btn-sm btn-primary">
                    Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="p-3 rounded-3 border border-primary border-2 shadow-md">
                            <label class="text-primary" for="email">Email Ketua</label>
                            <input class="form-control mb-2" value="{{ $webdev->email }}" type="text" id="email"
                                readonly>
                            <label class="text-primary" for="college1">Institusi</label>
                            <input class="form-control mb-3" value="{{ $webdev->college }}" type="text"
                                id="college1" readonly>
                        </div>
                    </div>
                    @for ($i = 1; $i <= $members; $i++)
                        <div class="col-md-6 mb-3">
                            <div class="p-3 rounded-3 border border-primary border-2 shadow-md">
                                <h4 class="text-primary fw-bold mb-3">Anggota {{ $i }}</h4>
                                <label class="text-primary form-label" for="name1">Nama</label>
                                <input class="form-control mb-3" value="{{ $webdev->{"name$i"} }}" type="text"
                                    id="name1" readonly>
                                <label class="text-primary" for="nim1">NIM</label>
                                <input class="form-control mb-3" value="{{ $webdev->{"nim$i"} }}" type="text"
                                    id="nim1" readonly>
                                <label class="text-primary" for="phone_number1">Nomor Telepon</label>
                                <input class="form-control mb-3" value="{{ $webdev->{"phone_number$i"} }}"
                                    type="text" id="phone_number1" readonly>
                                <label class="text-primary" for="instagram1">Instagram</label>
                                <input class="form-control mb-3" value="{{ $webdev->{"instagram$i"} }}" type="text"
                                    id="instagram1" readonly>
                                <label class="text-primary" for="id_card1">ID Card</label>
                                <img src="{{ $webdev->{"id_card$i"} }}"
                                    class="img-fluid text-center rounded-3 d-block" style="max-height: 300px" id="id_card1"
                                    alt="">
                                <a href="{{ $webdev->{"id_card$i"} }}" class="btn btn-xs btn-primary light mt-2"
                                    target="blank"><i class="fas fa-expand me-2"></i>Lihat ID Card</a>
                            </div>
                        </div>
                    @endfor
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded-3 border border-primary border-2 shadow-md">
                            <label class="text-primary" for="payment_method">Metode Pembayaran</label>
                            <input class="form-control mb-3" value="{{ $webdev->payment_method }}" type="text"
                                id="payment_method" readonly>
                            <label class="text-primary" class="form-label" for="proof">Bukti Pembayaran</label>
                            <img src="{{ $webdev->proof }}" class="img-fluid text-center rounded-3 d-block"
                                style="max-height: 300px" id="proof" alt="">
                            <a href="{{ $webdev->proof }}" class="btn btn-xs btn-primary light mt-2" target="blank">
                                <i class="fas fa-expand me-2"></i>Lihat Bukti Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

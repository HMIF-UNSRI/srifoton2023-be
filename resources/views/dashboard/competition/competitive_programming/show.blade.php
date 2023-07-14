@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-primary fw-bold">Data Tim {{ $programming->team_name }}<span
                        class="badge badge-rounded badge-lg ms-2 {{ $programming->isVerified ? 'badge-success' : 'badge-warning' }}">
                        <i
                            class="{{ $programming->isVerified ? 'fas fa-check-circle me-1' : 'fas fa-exclamation-circle me-1' }}"></i>
                        {{ $programming->isVerified ? 'Verified' : 'Unverified' }}
                    </span></h3>

                <a href="{{ route('competition.cp') }}" class="btn btn-sm btn-primary"><i
                        class="fas fa-undo-alt me-1"></i>Back</a>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="p-3 rounded border border-primary border-1">

                            <label for="email">Email Ketua</label>
                            <input class="form-control mb-2" value="{{ $programming->email }}" type="text" id="email"
                                readonly>

                            <label for="college1">Institusi</label>
                            <input class="form-control mb-3" value="{{ $programming->college }}" type="text"
                                id="college1" readonly>
                        </div>
                    </div>
                    @for ($i = 1; $i <= $members; $i++)
                        <div class="col-md-6 mb-3">
                            <div class="p-3 rounded border border-primary border-1">
                                <h4 class="text-primary mb-3">Anggota {{ $i }}</h4>
                                <label class="form-label" for="name1">Nama</label>
                                <input class="form-control mb-3" value="{{ $programming->{"name$i"} }}" type="text"
                                    id="name1" readonly>

                                <label for="nim1">NIM</label>
                                <input class="form-control mb-3" value="{{ $programming->{"nim$i"} }}" type="text"
                                    id="nim1" readonly>

                                <label for="phone_number1">Nomor Telepon</label>
                                <input class="form-control mb-3" value="{{ $programming->{"phone_number$i"} }}"
                                    type="text" id="phone_number1" readonly>

                                <label for="instagram1">Instagram</label>
                                <input class="form-control mb-3" value="{{ $programming->{"instagram$i"} }}" type="text"
                                    id="instagram1" readonly>


                                <label for="id_card1">ID Card</label>
                                <img src="{{ $programming->{"id_card$i"} }}"
                                    class="img-fluid text-center rounded-1 d-block" style="max-height: 300px" id="id_card1"
                                    alt="">
                                <a href="{{ $programming->{"id_card$i"} }}" class="btn btn-xs btn-primary light mt-2"
                                    target="blank"><i class="fas fa-expand me-2"></i>Lihat ID Card</a>

                            </div>
                        </div>
                    @endfor
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded border border-primary border-1">


                            <label for="payment_method">Metode Pembayaran</label>
                            <input class="form-control mb-3" value="{{ $programming->payment_method }}" type="text"
                                id="payment_method" readonly>

                            <label class="form-label" for="proof">Bukti Pembayaran</label>
                            <img src="{{ $programming->proof }}" class="img-fluid text-center rounded-1 d-block"
                                style="max-height: 300px" id="proof" alt="">
                            <a href="{{ $programming->proof }}" class="btn btn-xs btn-primary light mt-2" target="blank"><i
                                    class="fas fa-expand me-2"></i>Lihat Bukti Pembayaran</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

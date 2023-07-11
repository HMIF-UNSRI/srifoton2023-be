@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-primary fw-bold">Data User {{ $user->name }}<span
                        class="badge badge-rounded badge-lg ms-2 {{ $user->email_verified_at ? 'badge-success' : 'badge-warning' }}">
                        <i
                            class="{{ $user->email_verified_at ? 'fas fa-check-circle me-1' : 'fas fa-exclamation-circle me-1' }}"></i>
                        {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                    </span></h3>

                <a href="{{ route('users') }}" class="btn btn-sm btn-primary"><i class="fas fa-undo-alt me-1"></i>Back</a>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="p-3 rounded border border-primary border-1">

                            <label for="email">Email</label>
                            <input class="form-control mb-2" value="{{ $user->email }}" type="text" id="email"
                                readonly>
                            <label class="form-label" for="name1">Nama</label>
                            <input class="form-control mb-3" value="{{ $user->name }}" type="text" id="name1"
                                readonly>

                            <label for="college1">Gender</label>
                            <input class="form-control mb-3" value="{{ $user->gender }}" type="text" id="college1"
                                readonly>

                            <label for="phone_number1">Nomor Telepon</label>
                            <input class="form-control mb-3" value="{{ $user->phone_number }}" type="text"
                                id="phone_number1" readonly>

                            <label for="instagram1">Instagram</label>
                            <input class="form-control mb-3" value="{{ $user->instagram }}" type="text" id="instagram1"
                                readonly>

                            <label for="instagram1">College</label>
                            <input class="form-control mb-3" value="{{ $user->college }}" type="text" id="instagram1"
                                readonly>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

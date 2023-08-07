@extends('layouts.app')



@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/toastr-init.js') }}"></script>
    <script>
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'Success', {
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        @endif
    </script>
@endpush

@section('content')
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title text-primary fw-medium">Detail {{ $user->name }}<span
                        class="badge light badge-rounded badge-lg ms-2 {{ $user->email_verified_at ? 'badge-success' : 'badge-warning' }}">
                        <i
                            class="{{ $user->email_verified_at ? 'bi bi-check-circle-fill me-1' : 'bi bi-exclamation-circle-fill me-1' }}"></i>
                        {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                    </span></h3>

                <a href="{{ route('users') }}" class="btn light btn-sm btn-primary"><i
                        class="bi bi-box-arrow-left me-2"></i>Back</a>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input class="form-control mb-2" value="{{ $user->email }}" type="text" id="email"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="name1">Nama</label>
                                <input class="form-control mb-3" value="{{ $user->name }}" type="text" id="name1"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Gender</label>
                                <input class="form-control mb-3" value="{{ $user->gender }}" type="text" id="gender"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number1">Nomor Telepon</label>
                                <input class="form-control mb-3" value="{{ $user->phone_number }}" type="text"
                                    id="phone_number1" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="instagram1">Instagram</label>
                                <input class="form-control mb-3" value="{{ $user->instagram }}" type="text"
                                    id="instagram1" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="institusi">Institusi</label>
                                <input class="form-control mb-3" value="{{ $user->college }}" type="text" id="institusi"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

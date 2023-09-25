@extends('layouts.app')

@push('css')
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            const wrapperDiv = $('<div>').addClass('w-100').css("overflow-x", "scroll");
            const table = $('#example3');
            table.wrap(wrapperDiv);
        });
        $(document).ready(function() {
            const buttons = $(
                ".buttons-excel, .buttons-csv, .buttons-pdf, .buttons-copy, .buttons-print");

            buttons.each(function() {
                const $thisButton = $(this);
                if ($thisButton.length) {
                    if ($thisButton.hasClass("buttons-excel")) {
                        $thisButton.html('<i class="ni ni-file-xls"></i>');
                    } else if ($thisButton.hasClass("buttons-copy")) {
                        $thisButton.html('<i class="ni ni-copy"></i>');
                    } else if ($thisButton.hasClass("buttons-pdf")) {
                        $thisButton.html('<i class="ni ni-file-pdf"></i>');
                    } else if ($thisButton.hasClass("buttons-print")) {
                        $thisButton.html('<i class="ni ni-printer"></i>');
                    } else if ($thisButton.hasClass("buttons-csv")) {
                        $thisButton.html('<i class="ni ni-file-csv"></i>');
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('show.bs.modal', '#detailUserModal', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const name = button.data('name');
                const email = button.data('email');
                const email_verified_at = button.data('email-verified-at');
                const institution = button.data('institution');
                const gender = button.data('gender');
                const instagram = button.data('instagram');
                const phone_number = button.data('phone-number');
                const modal = $(this);

                modal.find('#name').val(name);
                modal.find('#email').val(email);
                modal.find('#institution').val(institution);
                modal.find('#gender').val(gender);
                modal.find('#instagram').val(instagram);
                modal.find('#phone_number').val(phone_number);

                if (email_verified_at) {
                    $('#badge').removeClass('badge-warning').addClass('badge-success');
                    $('#icon').removeClass('bi bi-exclamation-circle-fill').addClass('bi bi-check-circle-fill');
                    $('#badge').text('Verified');
                } else {
                    $('#badge').removeClass('badge-success').addClass('badge-warning');
                    $('#icon').removeClass('bi bi-check-circle-fill').addClass('bi bi-exclamation-circle-fill');
                    $('#badge').text('Unverified');
                }

            });
        });
    </script>
@endpush

@section('content')
    <div class="col-12">
        <div class="card shadow-sm" style="overflow-x: scroll">
            <div class="card-header">
                <h4 class="card-title text-primary fw-medium">Users</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <table id="example3" class="display dataTable cell-border no-footer mb-3" style="min-width: 845px"
                            role="grid" aria-describedby="example3_info">
                            <thead>
                                <tr class="text-center" role="row">
                                    <th class="sorting">No</th>
                                    <th class="sorting">Name</th>
                                    <th class="sorting">Email</th>
                                    <th class="sorting">Email Verification</th>
                                    <th class="sorting">Institution</th>
                                    <th class="sorting">Gender</th>
                                    <th class="sorting">Phone</th>
                                    <th class="sorting">Instagram</th>
                                    <th class="sorting no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr role="row">
                                        <td class="text-center">{{ $index + 1 }} </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge light badge-rounded badge-sm w-75 {{ $user->email_verified_at ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $user->email_verified_at ? 'bi bi-check-circle-fill me-1' : 'bi bi-exclamation-circle-fill me-1' }}"></i>
                                                {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $user->college ? $user->college : '-' }}</td>
                                        <td class="text-center">{{ $user->gender ? $user->gender : '-' }}</td>
                                        <td class="text-center">{{ $user->phone_number ? $user->phone_number : '-' }}</td>
                                        <td class="text-center">{{ $user->instagram ? $user->instagram : '-' }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-rounded btn-primary btn-xs shadow sharp" data-bs-toggle="modal"
                                                data-bs-target="#detailUserModal" data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                data-email-verified-at="{{ $user->email_verified_at }}"
                                                data-college="{{ $user->college }}"
                                                data-gender="{{ $user->gender }}"
                                                data-phone-number="{{ $user->phone_number }}"
                                                data-instagram="{{ $user->instagram }}">
                                                <em class="bi bi-eye-fill"></em>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="detailUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18">User Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" class="form-control w-100 mb-3" id="name" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" class="form-control w-100 mb-3" id="email" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Email Verified</td>
                            <td>
                                <span id="badge" class="badge light badge-xl w-100">
                                    <i id="icon"></i>
                                    <span class="verification-status"></span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Institution</td>
                            <td>
                                <input type="text" class="form-control w-100 mb-3" id="institution" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                <input type="text" class="form-control w-100 mb-3" id="gender" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>
                                <input type="text" class="form-control w-100 mb-3" id="phone_number" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Instagram</td>
                            <td>
                                <input type="text" class="form-control w-100 mb-3" id="instagram" readonly>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

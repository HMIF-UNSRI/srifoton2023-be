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
                                        <td class="text-center">{{ $user->gender ? $user->gender : '-' }}</td>
                                        <td class="text-center">{{ $user->phone_number ? $user->phone_number : '-' }}</td>
                                        <td class="text-center">{{ $user->instagram ? $user->instagram : '-' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-rounded btn-primary btn-xs shadow sharp"><i
                                                        class="bi bi-eye-fill"></i></a>
                                            </div>
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
@endsection

@extends('layouts.app')

@push('css')
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/css/toastr.min.css') }}">
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
    <script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/toastr-init.js') }}"></script>
    <script>
        $(document).ready(function() {
            const wrapperDiv = $('<div>').addClass('w-100').css("overflow-x", "scroll");
            const table = $('#example3');
            table.wrap(wrapperDiv);

            const urlParams = new URLSearchParams(window.location.search);
            const searchKeyword = urlParams.get('search');

            if (searchKeyword) {
                $('#example3').DataTable().search(searchKeyword).draw();
            }
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
            // edit modal
            $(document).on('show.bs.modal', '#editModalWebdev', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const proof = button.data('proof');
                const paymentMethod = button.data('payment-method');
                const isVerified = button.data('is-verified');
                const editModalTitle = $('#editModalTitle');
                const modal = $(this);
                const editForm = $('#editFormWebdev');

                modal.find('#teamName').val(teamName);
                modal.find('#paymentMethod').val(paymentMethod);
                modal.find('#showProof').attr('href', proof);
                modal.find('#proof').attr('src', proof);

                if (isVerified) {
                    editForm.hide();
                    editModalTitle.html(teamName + ' has been verified');
                } else {
                    editForm.show();
                    editForm.attr('action', '{{ route('competition.webdev.verification', ':id') }}'.replace(
                        ':id', id));
                    editModalTitle.html('Payment Verification');
                }
            });

            // Delete Modal
            $(document).on('show.bs.modal', '#deleteModalWebdev', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const modal = $(this);
                const deleteForm = $('#deleteFormWebdev');
                const deleteModalBody = $('#deleteModalBody');

                deleteModalBody.html(`Are you sure want to delete ${teamName} team ?`);
                deleteForm.attr('action', '{{ route('competition.webdev.delete', ':id') }}'.replace(':id',
                    id));

                modal.find('#teamName').val(teamName);
            });
        });
    </script>
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
        @if (session()->has('error'))
            toastr.error('{{ session('error') }}', 'Failed', {
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
        <div class="card" style="overflow-x: scroll">
            <div class="card-header">
                <h4 class="card-title text-primary fw-medium">Web Development
                </h4>
                <a href="{{ route('competition.webdev.all.download') }}" class="btn btn-xs btn-primary"><i
                        class="ni ni-file-zip me-1"></i>Download All Submission</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <table id="example3" class="display dataTable cell-border no-footer mb-3" style="min-width: 845px"
                            role="grid" aria-describedby="example3_info">
                            <thead>
                                <tr class="text-center" role="row">
                                    <th class="sorting">No</th>
                                    <th class="sorting">Team Name</th>
                                    <th class="sorting">Member 1</th>
                                    <th class="sorting">Member 2</th>
                                    <th class="sorting">Member 3</th>
                                    <th class="sorting">Submission</th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($webdevs as $index => $webdev)
                                    <tr role="row">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="">{{ $webdev->team_name }}</td>
                                        <td>{{ $webdev->name1 ? $webdev->name1 : '-' }}</td>
                                        <td>{{ $webdev->name2 ? $webdev->name2 : '-' }}</td>
                                        <td>{{ $webdev->name3 ? $webdev->name3 : '-' }}</td>
                                        <td><span
                                                class="badge light badge-rounded badge-sm w-100 {{ $webdev->submission ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="bi bi-file-earmark{{ $webdev->submission ? '-check' : '-x' }} me-1"></i>
                                                {{ $webdev->submission ? 'Submitted' : 'Unsubmitted' }}
                                            </span></td>
                                        <td class="text-center">
                                            <span
                                                class="badge light badge-rounded badge-sm w-100 {{ $webdev->isVerified ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $webdev->isVerified ? 'bi bi-cash-stack me-1' : 'bi bi-hourglass-split me-1' }}"></i>
                                                {{ $webdev->isVerified ? 'Paid' : 'Awaiting' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('competition.webdev.download', $webdev->id) }}"
                                                    class="btn btn-success shadow btn-rounded btn-xs sharp me-1"> <i
                                                        class="bi bi-download"></i></a>
                                                <a href="{{ route('competition.webdev.show', $webdev->id) }}"
                                                    class="btn btn-primary shadow btn-rounded btn-xs sharp me-1"><i
                                                        class="bi bi-eye-fill"></i></a>
                                                @canany(['inti', 'finance'])
                                                    <button class="btn btn-warning shadow btn-rounded btn-xs sharp me-1"
                                                        data-bs-toggle="modal" data-bs-target="#editModalWebdev"
                                                        data-id="{{ $webdev->id }}"
                                                        data-team-name="{{ $webdev->team_name }}"
                                                        data-proof="{{ $webdev->proof }}"
                                                        data-payment-method="{{ $webdev->payment_method }}"
                                                        data-is-verified={{ $webdev->isVerified }}><i
                                                            class="bi bi-pencil-fill text-dark"></i></button>
                                                @endcanany
                                                @can('inti')
                                                    <button class="btn btn-danger shadow btn-rounded btn-xs sharp"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModalWebdev"
                                                        data-id={{ $webdev->id }}
                                                        data-team-name="{{ $webdev->team_name }}"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModalWebdev">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="editModalTitle"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Team Name</td>
                                                <td>
                                                    <input type="text" class="form-control w-100 mb-3" id="teamName"
                                                        readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment Method</td>
                                                <td>
                                                    <input type="text" class="form-control w-100" id="paymentMethod"
                                                        readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment Proof</td>
                                                <td>
                                                    <img class="img-fluid rounded-1 mb-3" alt="" id="proof"
                                                        style="max-height: 500px">
                                                    <a id="showProof"
                                                        class="btn btn-xs btn-primary light mt-2 w-100 fw-medium"
                                                        target="blank">
                                                        <i class="fas fa-expand me-2"></i>Show Payment Proof</a>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Close</button>
                                        <form method="post" id="editFormWebdev">
                                            @csrf
                                            <button type="submit" name="isVerified"
                                                class="btn btn-primary">Verified</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteModalWebdev">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body" id="deleteModalBody"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Close</button>
                                        <form method="post" id="deleteFormWebdev">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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

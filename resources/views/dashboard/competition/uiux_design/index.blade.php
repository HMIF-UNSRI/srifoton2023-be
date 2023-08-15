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

        $(document).ready(function() {
            // edit modal
            $(document).on('show.bs.modal', '#editModalUiux', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const proof = button.data('proof');
                const paymentMethod = button.data('payment-method');
                const isVerified = button.data('is-verified');
                const editModalTitle = $('#editModalTitle');
                const modal = $(this);
                const editForm = $('#editFormUiux');

                modal.find('#teamName').val(teamName);
                modal.find('#paymentMethod').val(paymentMethod);
                modal.find('#proof').attr('src', '{{ asset('storage') }}/' + proof);

                if (isVerified) {
                    editForm.hide();
                    editModalTitle.html(teamName + ' has been verified')
                } else {
                    editForm.show();
                    editForm.attr('action', `/dashboard/admin/uiux-design/${id}/verification`)
                    editModalTitle.html('Payment Verification');
                }
            });

            // Delete Modal
            $(document).on('show.bs.modal', '#deleteModalUiux', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const modal = $(this);
                const deleteForm = $('#deleteFormUiux');
                const deleteModalBody = $('#deleteModalBody');

                deleteModalBody.html(`Are you sure want to delete ${teamName} team ?`);
                deleteForm.attr('action', `/dashboard/admin/uiux-design/${id}/delete`);

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
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title text-primary fw-medium">UIUX Design</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <table id="example3" class="display dataTable cell-border no-footer mt-1 mb-2"
                            style="min-width: 845px" role="grid" aria-describedby="example3_info">
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
                                @foreach ($uiuxs as $index => $uiux)
                                    <tr role="row">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $uiux->team_name }}</td>
                                        <td>{{ $uiux->name1 }}</td>
                                        <td class="sorting_1">{{ $uiux->name2 }}</td>
                                        <td>{{ $uiux->name3 }}</td>
                                        <td><span
                                                class="badge light badge-rounded badge-sm w-100 {{ $uiux->submission ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="bi bi-file-earmark{{ $uiux->submission ? '-check' : '-x' }} me-1"></i>
                                                {{ $uiux->submission ? 'Submitted' : 'Unsubmitted' }}
                                            </span></td>
                                        <td class="text-center">
                                            <span
                                                class="badge light badge-rounded badge-sm w-100 {{ $uiux->isVerified ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $uiux->isVerified ? 'bi bi-cash-stack me-1' : 'bi bi-hourglass-split me-1' }}"></i>
                                                {{ $uiux->isVerified ? 'Paid' : 'Awaiting' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('competition.uiux.download', $uiux->id) }}"
                                                    class="btn btn-success shadow btn-rounded btn-xs sharp me-1"> <i
                                                        class="bi bi-file-earmark-arrow-down-fill"></i></a>
                                                <a href="{{ route('competition.uiux.show', $uiux->id) }}"
                                                    class="btn btn-primary shadow btn-rounded btn-xs sharp me-1"><i
                                                        class="bi bi-eye-fill"></i></a>
                                                <button title="Edit"
                                                    class="btn btn-warning shadow btn-rounded btn-xs sharp me-1 text-dark"
                                                    data-bs-toggle="modal" data-bs-target="#editModalUiux"
                                                    data-id="{{ $uiux->id }}" data-team-name="{{ $uiux->team_name }}"
                                                    data-proof="{{ $uiux->proof }}"
                                                    data-payment-method="{{ $uiux->payment_method }}"
                                                    data-is-verified={{ $uiux->isVerified }}><i
                                                        class="bi bi-pencil-fill"></i></button>
                                                <button class="btn btn-danger shadow btn-rounded btn-xs sharp"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModalUiux"
                                                    data-id={{ $uiux->id }} data-team-name="{{ $uiux->team_name }}"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModalUiux">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-18" id="editModalTitle"></h5>

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
                                                    <a href="{{ asset('storage/' . $uiux->proof) }}"
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
                                        <form method="post" id="editFormUiux">
                                            @csrf
                                            <button type="submit" name="isVerified"
                                                class="btn btn-primary">Verified</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteModalUiux">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-18">Delete Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body" id="deleteModalBody"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Close</button>
                                        <form method="post" id="deleteFormUiux">
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

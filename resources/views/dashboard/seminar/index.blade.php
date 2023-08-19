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
    </script>
    <script>
        $(document).ready(function() {
            // edit modal
            $(document).on('show.bs.modal', '#editModalSeminar', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const name = button.data('name');
                const proof = button.data('proof');
                const type = button.data('type');
                const paymentMethod = button.data('payment-method');
                const isVerified = button.data('is-verified');
                const editModalTitle = $('#editModalTitle');
                const modal = $(this);
                const editForm = $('#editFormSeminar');

                modal.find('#name').val(name);
                modal.find('#paymentMethod').val(paymentMethod);
                modal.find('#type').val(type);
                modal.find('#showProof').attr('href', '{{ asset('storage') }}/' + proof);
                modal.find('#proof').attr('src', '{{ asset('storage') }}/' + proof);

                if (isVerified) {
                    editForm.hide();
                    editModalTitle.html(name + ' has been verified')
                } else {
                    editForm.show();
                    editForm.attr('action', `/dashboard/admin/seminar/${id}/verification`)
                    editModalTitle.html('Payment Verification');
                }
            });

            // Delete Modal
            $(document).on('show.bs.modal', '#deleteModalSeminar', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const name = button.data('name');
                const modal = $(this);
                const deleteForm = $('#deleteFormSeminar');
                const deleteModalBody = $('#deleteModalBody');

                deleteModalBody.html(`Are you sure want to delete ${name} ?`);
                deleteForm.attr('action', `/dashboard/admin/seminar/${id}/delete`);

                modal.find('#name').val(name);

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
    </script>
@endpush

@section('content')
    <div class="col-12">
        <div class="card" style="overflow-x: scroll">
            <div class="card-header">
                <h4 class="card-title text-primary fw-medium">Seminar</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <table id="example3" class="display dataTable cell-border no-footer mb-3" style="min-width: 845px"
                            role="grid" aria-describedby="example3_info">
                            <thead>
                                <tr role="row" class="text-center">
                                    <th class="sorting">No</th>
                                    <th class="sorting">Name</th>
                                    <th class="sorting">Email</th>
                                    <th class="sorting">Phone Number</th>
                                    <th class="sorting">Type</th>
                                    <th class="sorting">Ticket Code</th>
                                    <th class="sorting">Status</th>
                                    <th class="sorting no-export">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seminars as $index => $seminar)
                                    <tr role="row">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $seminar->name }}</td>
                                        <td>{{ $seminar->email }}</td>
                                        <td>{{ $seminar->phone_number }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge light badge-rounded badge-sm w-100 {{ $seminar->type === 'Offline' ? 'badge-primary' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $seminar->type === 'Offline' ? 'bi bi-geo-fill me-1' : 'bi bi-camera-video-fill me-1' }}"></i>
                                                {{ $seminar->type === 'Offline' ? 'Offline' : 'Online' }}
                                            </span>
                                        </td>


                                        <td class="text-center">{{ $seminar->ticket_code ? $seminar->ticket_code : '-' }}
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge light badge-rounded badge-sm w-100 {{ $seminar->isVerified ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $seminar->isVerified ? 'bi bi-cash-stack me-1' : 'bi bi-hourglass-split me-1' }}"></i>
                                                {{ $seminar->isVerified ? 'Paid' : 'Awaiting' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('seminar.show', $seminar->id) }}"
                                                    class="btn btn-rounded btn-primary btn-xs shadow sharp"><i
                                                        class="bi bi-eye-fill"></i></a>
                                                <button
                                                    class="btn btn-rounded btn-warning btn-xs shadow sharp text-dark mx-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModalSeminar"
                                                    data-id="{{ $seminar->id }}" data-name="{{ $seminar->name }}"
                                                    data-type="{{ $seminar->type }}" data-proof="{{ $seminar->proof }}"
                                                    data-payment-method="{{ $seminar->payment_method }}"
                                                    data-is-verified={{ $seminar->isVerified }}><i
                                                        class="bi bi-pencil-fill"></i></button>
                                                @cannot('finance')
                                                    <button class="btn btn-rounded btn-danger btn-xs shadow sharp"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModalSeminar"
                                                        data-id={{ $seminar->id }} data-name="{{ $seminar->name }}"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                @endcannot
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModalSeminar">
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
                                                <td>Name</td>
                                                <td>
                                                    <input type="text" class="form-control w-100 mb-3" id="name"
                                                        readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>
                                                    <input type="text" class="form-control w-100 mb-3" id="type"
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
                                        <form method="post" id="editFormSeminar">
                                            @csrf
                                            <button type="submit" name="isVerified"
                                                class="btn btn-primary">Verified</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModalSeminar">
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
                                        <form method="post" id="deleteFormSeminar">
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

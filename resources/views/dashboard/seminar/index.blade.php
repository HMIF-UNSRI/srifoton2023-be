@extends('layouts.app')

@push('css')
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/css/toastr.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script>

    <script src="{{ asset('js/plugins-init/toastr-init.js') }}"></script>
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
                modal.find('#proof').attr('src', '{{ asset('storage') }}/' + proof);

                if (isVerified) {
                    editForm.hide();
                    editModalTitle.html(name + ' telah diverifikasi')
                } else {
                    editForm.show();
                    editForm.attr('action', `/dashboard/admin/seminar/${id}/verification`)
                    editModalTitle.html('Verifikasi Pembayaran');
                }
            });

            // Delete Modal
            $(document).on('show.bs.modal', '#deleteModalseminar', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const modal = $(this);
                const deleteForm = $('#deleteFormseminar');
                const deleteModalBody = $('#deleteModalBody');

                deleteModalBody.html(`Apakah anda yakin ingin menghapus tim ${teamName}`);
                deleteForm.attr('action', `/dashboard/admin/competitive-seminar/${id}/delete`);

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
    </script>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-primary">Competitive seminar Datatable</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <table id="example3" class="display dataTable no-footer mb-3" style="min-width: 845px"
                            role="grid" aria-describedby="example3_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc text-center" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 25px;">No</th>
                                    <th class="sorting text-center" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 180px;">Name</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">
                                        Email</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="descending" style="width: 160px;">
                                        Phone Number</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Type</th>
                                        <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Ticket Code</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Status
                                    </th>
                                    <th class="text-center sorting_desc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="descending" style="width: 25px;">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seminars as $index => $seminar)
                                    <tr class="text-center" role="row">
                                        <td class="">{{ $index + 1 }}</td>
                                        <td class="">{{ $seminar->name }}</td>
                                        <td>{{ $seminar->email }}</td>
                                        <td class="sorting_1">{{ $seminar->phone_number }}</td>
                                        <td>{{ $seminar->type }}</td>
                                        <td>{{ $seminar->ticket_code ? $seminar->ticket_code : '-'}}</td>
                                        <td>
                                            <span
                                                class="badge badge-rounded badge-sm {{ $seminar->isVerified ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $seminar->isVerified ? 'fas fa-check-circle me-1' : 'fas fa-exclamation-circle me-1' }}"></i>
                                                {{ $seminar->isVerified ? 'Verified' : 'Unverified' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('competition.cp.show', $seminar->id) }}"
                                                    class="btn btn-primary shadow btn-rounded btn-xs sharp me-1"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="#"
                                                    class="btn btn-warning shadow btn-rounded btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModalSeminar"
                                                    data-id="{{ $seminar->id }}"
                                                    data-name="{{ $seminar->name }}"
                                                    data-type="{{ $seminar->type }}"
                                                    data-proof="{{ $seminar->proof }}"
                                                    data-payment-method="{{ $seminar->payment_method }}"
                                                    data-is-verified={{ $seminar->isVerified }}><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-rounded btn-xs sharp"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModalseminar"
                                                    data-id={{ $seminar->id }}
                                                    data-name="{{ $seminar->name }}"><i
                                                        class="fa fa-trash"></i></a>
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
                                        <h5 class="modal-title text-primary" id="editModalTitle"></h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Nama</td>
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
                                                <td>Metode Pembayaran</td>
                                                <td>
                                                    <input type="text" class="form-control w-100" id="paymentMethod"
                                                        readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bukti Pembayaran</td>
                                                <td>
                                                    <img class="img-fluid rounded-1 mb-3" alt="" id="proof"
                                                        style="max-height: 500px">
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
                        <div class="modal fade" id="deleteModalseminar">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body" id="deleteModalBody"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light"
                                            data-bs-dismiss="modal">Close</button>
                                        <form method="post" id="deleteFormseminar">
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

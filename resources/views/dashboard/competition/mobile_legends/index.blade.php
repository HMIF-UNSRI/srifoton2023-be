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
            $(document).on('show.bs.modal', '#editModalMobileLegends', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const proof = button.data('proof');
                const paymentMethod = button.data('payment-method');
                const isVerified = button.data('is-verified');
                const editModalTitle = $('#editModalTitle');
                const modal = $(this);
                const editForm = $('#editFormMobileLegends');

                modal.find('#teamName').val(teamName);
                modal.find('#paymentMethod').val(paymentMethod);
                modal.find('#proof').attr('src', '{{ asset('storage') }}/' + proof);

                if (isVerified) {
                    editForm.hide();
                    editModalTitle.html(teamName + ' telah diverifikasi')
                } else {
                    editForm.show();
                    editForm.attr('action', '{{ route('competition.mole.verification', ':id') }}'.replace(':id', id));
                    editModalTitle.html('Verifikasi Pembayaran');
                }
            });

            // Delete Modal
            $(document).on('show.bs.modal', '#deleteModalMobileLegends', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const teamName = button.data('team-name');
                const modal = $(this);
                const deleteForm = $('#deleteFormMobileLegends');
                const deleteModalBody = $('#deleteModalBody');

                deleteModalBody.html(`Apakah anda yakin ingin menghapus tim ${teamName}`);
                deleteForm.attr('action', `/dashboard/admin/mobile-legends/${id}/delete`);

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
                <h4 class="card-title text-primary">Mobile Legends Datatable</h4>
                <button class="btn btn-primary shadow btn-rounded btn-sm sharp"><i class="fas fa-plus me-2"></i>Add</button>
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
                                        style="width: 180px;">Team Name</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">
                                        Player 1</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="descending" style="width: 160px;">
                                        Player 2</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Player 3</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">
                                        Player 4</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Player 5
                                    </th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Status
                                    </th>
                                    <th class="text-center sorting_desc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="descending" style="width: 25px;">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mobilelegends as $index => $mobilelegend)
                                    <tr class="text-center" role="row">
                                        <td class="">{{ $index + 1 }}</td>
                                        <td class="">{{ $mobilelegend->team_name }}</td>
                                        <td>{{ $mobilelegend->name1 }}</td>
                                        <td class="sorting_1">{{ $mobilelegend->name2 }}</td>
                                        <td>{{ $mobilelegend->name3 }}</td>
                                        <td>{{ $mobilelegend->name4 }}</td>
                                        <td>{{ $mobilelegend->name5 }}</td>
                                        <td>
                                            <span
                                                class="badge badge-rounded badge-sm {{ $mobilelegend->isVerified ? 'badge-success' : 'badge-warning' }}">
                                                <i
                                                    class="{{ $mobilelegend->isVerified ? 'fas fa-check-circle me-1' : 'fas fa-exclamation-circle me-1' }}"></i>
                                                {{ $mobilelegend->isVerified ? 'Verified' : 'Unverified' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('competition.mole.show', $mobilelegend->id) }}"
                                                    class="btn btn-primary shadow btn-rounded btn-xs sharp me-1"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="#"
                                                    class="btn btn-warning shadow btn-rounded btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModalMobileLegends"
                                                    data-id="{{ $mobilelegend->id }}"
                                                    data-team-name="{{ $mobilelegend->team_name }}"
                                                    data-proof="{{ $mobilelegend->proof }}"
                                                    data-payment-method="{{ $mobilelegend->payment_method }}"
                                                    data-is-verified={{ $mobilelegend->isVerified }}><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-rounded btn-xs sharp"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModalMobileLegends"
                                                    data-id={{ $mobilelegend->id }}
                                                    data-team-name="{{ $mobilelegend->team_name }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModalMobileLegends">
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
                                                <td>Nama Tim</td>
                                                <td>
                                                    <input type="text" class="form-control w-100 mb-3" id="teamName"
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
                                        <form method="post" id="editFormMobileLegends">
                                            @csrf
                                            <button type="submit" name="isVerified"
                                                class="btn btn-primary">Verified</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModalMobileLegends">
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
                                        <form method="post" id="deleteFormMobileLegends">
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

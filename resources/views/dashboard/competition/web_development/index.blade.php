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
                modal.find('#proof').attr('src', '{{ asset('storage') }}/' + proof);

                if (isVerified) {
                    editForm.hide();
                    editModalTitle.html(teamName + ' telah diverifikasi');
                } else {
                    editForm.show();
                    editForm.attr('action', '{{ route('competition.webdev.verification', ':id') }}'.replace(
                        ':id', id));
                    editModalTitle.html('Verifikasi Pembayaran');
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

                deleteModalBody.html(`Apakah anda yakin ingin menghapus tim ${teamName}`);
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
    </script>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-primary">Web Development</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <table id="example3" class="display dataTable no-footer mb-3" style="min-width: 845px"
                            role="grid" aria-describedby="example3_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc text-center">No</th>
                                    <th class="sorting text-center">Team Name</th>
                                    <th class="text-center sorting">Player 1</th>
                                    <th class="text-center sorting">Player 2</th>
                                    <th class="text-center sorting">Player 3</th>
                                    <th class="text-center sorting">Submission</th>
                                    <th class="text-center sorting">Status</th>
                                    <th class="text-center sorting_desc">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($webdevs as $index => $webdev)
                                    <tr class="text-center" role="row">
                                        <td class="">{{ $index + 1 }}</td>
                                        <td class="">{{ $webdev->team_name }}</td>
                                        <td>{{ $webdev->name1 }}</td>
                                        <td class="sorting_1">{{ $webdev->name2 }}</td>
                                        <td>{{ $webdev->name3 }}</td>
                                        <td>{{ $webdev->submission }}</td>
                                        <td>
                                            <span
                                                class="badge badge-rounded badge-sm {{ $webdev->isVerified ? 'bg-success' : 'bg-warning' }}">
                                                <i
                                                    class="{{ $webdev->isVerified ? 'bi bi-check-circle-fill me-1' : 'bi bi-exclamation-circle-fill me-1' }}"></i>
                                                {{ $webdev->isVerified ? 'Verified' : 'Unverified' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('competition.mole.show', $webdev->id) }}"
                                                    class="btn btn-primary shadow btn-rounded btn-xs sharp me-1"><i
                                                        class="bi bi-eye-fill"></i></a>
                                                <button class="btn btn-warning shadow btn-rounded btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModalWebdev"
                                                    data-id="{{ $webdev->id }}"
                                                    data-team-name="{{ $webdev->team_name }}"
                                                    data-proof="{{ $webdev->proof }}"
                                                    data-payment-method="{{ $webdev->payment_method }}"
                                                    data-is-verified={{ $webdev->isVerified }}><i
                                                        class="bi bi-pencil-fill text-dark"></i></button>
                                                <button class="btn btn-danger shadow btn-rounded btn-xs sharp"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModalWebdev"
                                                    data-id={{ $webdev->id }}
                                                    data-team-name="{{ $webdev->team_name }}"><i
                                                        class="bi bi-trash-fill"></i></button>
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
                                        <h5 class="modal-title">Hapus Data</h5>
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

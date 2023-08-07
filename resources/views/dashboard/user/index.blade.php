@extends('layouts.app')

@push('css')
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
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
                                    <th class="sorting">Action</th>
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

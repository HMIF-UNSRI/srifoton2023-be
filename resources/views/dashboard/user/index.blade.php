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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-primary">User Datatable</h4>
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
                                        Verification</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">gender</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">
                                        phone</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1"
                                        style="width: 160px;">Instagram
                                    </th>
                                    <th class="text-center sorting_desc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="descending" style="width: 25px;">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr class="text-center" role="row">
                                        <td>{{ $index + 1 }} </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span
                                                class="badge badge-rounded badge-sm {{ $user->email_verified_at == null ? 'badge-warning' : 'badge-success' }}">
                                                <i
                                                    class="{{ $user->email_verified_at == null ? 'fas fa-exclamation-circle me-1 ' : 'fas fa-check-circle me-1' }}"></i>
                                                {{ $user->email_verified_at == null ? 'Unverified' : 'Verified' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->gender ? $user->gender : '-' }}</td>
                                        <td>{{ $user->phone_number ? $user->phone_number : '-' }}</td>
                                        <td>{{ $user->instagram ? $user->instagram : '-'}}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-primary shadow btn-rounded btn-xs sharp me-1"><i
                                                        class="fas fa-eye"></i></a>
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

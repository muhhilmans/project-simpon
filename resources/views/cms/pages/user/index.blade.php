@extends('cms.layouts.main', ['title' => 'Users'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Kelola Pengguna</h4>

    <div class="card px-3 py-2">
        <div class="card-header d-flex align-items-center">
            <button class="btn btn-dark d-inline-flex align-items-center me-2" type="button" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="bx bx-plus"></i> Tambah</button>
            {{-- @include('pages.users.partials.create') --}}
            <select class="form-select" style="width: 70px" id="records_per_page">
                <option value="10" {{ request()->get('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request()->get('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request()->get('perPage') == 50 ? 'selected' : '' }}>50</option>
                <option value="all" {{ request()->get('perPage') == 'all' ? 'selected' : '' }}>All</option>
            </select>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Roles</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start"><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                </td>
                                <td>
                                    {{ $user->username }}
                                    {{-- <span class="badge bg-label-primary me-1">Active</span> --}}
                                </td>
                                <td><span
                                        class="badge bg-label-primary me-1">{{ $user->roles->implode('name', ', ') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                        <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $user->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Ubah</button>
                                        {{-- @include('pages.users.partials.edit') --}}
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $user->id }}"><i
                                                class="bx bx-trash me-1"></i>
                                            Hapus</button>
                                        {{-- @include('pages.users.partials.delete') --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BEGIN: Pagination -->
        @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="">
                {{ $users->links('cms.layouts.partials.paginate') }}
            </div>
        @endif
        <!-- END: Pagination -->
    </div>
@endsection

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('records_per_page').addEventListener('change', function() {
                const perPage = this.value;
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('perPage', perPage);
                window.location.search = urlParams.toString();
            });
        });
    </script>
@endpush
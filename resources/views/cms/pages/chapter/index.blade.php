@extends('cms.layouts.main', ['title' => 'Bab Materi'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Kelola Bab Materi</h4>

    <div class="card px-3 py-2">
        <div class="card-header d-flex align-items-center">
            @hasrole('superadmin|admin|tutor')
                <button class="btn btn-dark d-inline-flex align-items-center me-2" type="button" data-bs-toggle="modal"
                    data-bs-target="#createModal"><i class="bx bx-plus"></i> Tambah</button>
                @include('cms.pages.chapter.partials.create')
            @endhasrole
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
                            <th>Judul Bab</th>
                            <th>Mata Pelajaran</th>
                            @hasrole('superadmin|admin|ketua')
                                <th>Tutor</th>
                            @endhasrole
                            @hasrole('superadmin|admin|tutor')
                                <th>Aksi</th>
                            @endhasrole
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($datas->count() == 0)
                            <td colspan="4" class="text-center fw-bold">Belum ada data</td>
                        @else
                            @foreach ($datas as $index => $data)
                                <tr class="text-center">
                                    <td>
                                        @if ($datas instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                            {{ $index + $datas->firstItem() }}
                                        @else
                                            {{ $loop->iteration }}
                                        @endif
                                    </td>
                                    <td class="text-start fw-bold">
                                        <span class="fw-bold">{{ $data->name }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $data->subject->name }}</span>
                                    </td>
                                    @hasrole('superadmin|admin|ketua')
                                        <td>
                                            <span>{{ $data->subject->user->civitasProfile->name }}</span>
                                        </td>
                                    @endhasrole
                                    @hasrole('superadmin|admin|tutor')
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                                <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $data->id }}"><i
                                                        class="bx bx-edit-alt"></i></button>
                                                @include('cms.pages.chapter.partials.edit')
                                                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $data->id }}"><i
                                                        class="bx bx-trash"></i></button>
                                                @include('cms.pages.chapter.partials.delete')
                                            </div>
                                        </td>
                                    @endhasrole
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BEGIN: Pagination -->
        @if ($datas instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="">
                {{ $datas->links('cms.layouts.partials.paginate') }}
            </div>
        @endif
        <!-- END: Pagination -->
    </div>
@endsection

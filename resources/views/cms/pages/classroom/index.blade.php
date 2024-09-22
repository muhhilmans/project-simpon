@extends('cms.layouts.main', ['title' => 'Rombongan Belajar'])

@section('content')
    <h4 class="fw-bold py-3 mb-4">Kelola Rombongan Belajar</h4>

    <div class="card px-3 py-2">
        <div class="card-header d-flex align-items-center">
            <button class="btn btn-dark d-inline-flex align-items-center me-2" type="button" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="bx bx-plus"></i> Tambah</button>
            @include('cms.pages.classroom.partials.create')
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
                            <th>Nama Ruang</th>
                            <th>Tingkat</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($datas->count() == 0)
                            <td colspan="5" class="text-center fw-bold">Belum ada data</td>
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
                                        <a href="{{ route('classroom.show', $data->id) }}" class="text-decoration-none text-black">{{ $data->name }}</a>
                                    </td>
                                    <td>
                                        <span>Tingkat {{ $data->level->name }}, Kelas {{ $data->level->class }}, Paket {{ $data->level->package }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $data->schoolYear->early_year }}/{{ $data->schoolYear->final_year }} ({{ $data->schoolYear->semester == 1 ? 'Ganjil' : 'Genap' }})</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                            <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $data->id }}"><i
                                                    class="bx bx-edit-alt"></i></button>
                                            @include('cms.pages.classroom.partials.edit')
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $data->id }}"><i
                                                    class="bx bx-trash"></i></button>
                                            @include('cms.pages.classroom.partials.delete')
                                        </div>
                                    </td>
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

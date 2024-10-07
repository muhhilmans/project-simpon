@extends('cms.layouts.main', ['title' => 'Detail Rombongan Belajar'])

@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('classroom.index') }}"
            class="text-decoration-none text-muted fw-light">Rombongan Belajar /</a> {{ $classroom->name }}
    </h4>

    <div class="card px-3 py-2">
        <div class="card-header d-flex align-items-center">
            <button class="btn btn-dark d-inline-flex align-items-center me-2" type="button" data-bs-toggle="modal"
                data-bs-target="#addModal{{ $classroom->id }}"><i class="bx bx-plus"></i> Tambah</button>
            @include('cms.pages.classroom.partials.add')
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama Warga Belajar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($classroomStudents->count() == 0)
                            <td colspan="5" class="text-center fw-bold">Belum ada data</td>
                        @else
                            @foreach ($classroomStudents as $data)
                                <tr class="text-center">
                                    <td>
                                            {{ $loop->iteration }}
                                    </td>
                                    <td class="text-start fw-bold">
                                        <span>{{ $data->user->studentProfile->name }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-2 text-start">
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#removeModal{{ $data->id }}"><i
                                                    class="bx bx-trash"></i></button>
                                            @include('cms.pages.classroom.partials.remove')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

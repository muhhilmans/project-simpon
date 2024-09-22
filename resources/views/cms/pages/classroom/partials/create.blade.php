<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Rombongan Belajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('classroom.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Ruang <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Nama Lengkap" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-6 mb-3">
                            <label for="level_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select name="level_id" id="level_id" name="level_id" class="form-select" required>
                                <option disabled selected>Pilih Kelas...</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">Tingkatan {{ $level->name }}, Kelas
                                        {{ $level->class }}, Paket {{ $level->package }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="school_year_id" class="form-label">Tahun Ajaran <span
                                    class="text-danger">*</span></label>
                            @if ($schoolYear->isNotEmpty())
                                <input type="text" class="form-control"
                                    value="{{ $schoolYear->first()->early_year }}/{{ $schoolYear->first()->final_year }} ({{ $schoolYear->first()->semester == 1 ? 'Ganjil' : 'Genap' }})"
                                    disabled>
                                <input type="hidden" name="school_year_id" id="school_year_id"
                                    value="{{ $schoolYear->first()->id }}">
                            @else
                                <input type="text" class="form-control" value="Tahun ajaran tidak tersedia" disabled>
                                <input type="hidden" name="school_year_id" id="school_year_id" value="">
                            @endif
                            {{-- <select name="school_year_id" id="school_year_id" name="school_year_id" class="form-select" required>
                                <option disabled selected>Pilih Tahun Ajaran...</option>
                                @foreach ($schoolYear as $sy)
                                    <option value="{{ $sy->id }}" selected>{{ $sy->early_year }}/{{ $sy->final_year }} ({{ $sy->semester == 1 ? 'Ganjil' : 'Genap' }})</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
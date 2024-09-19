<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('school-year.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label for="early_year" class="form-label">Tahun Awal <span
                                    class="text-danger">*</span></label>
                            <input type="number" id="early_year" name="early_year" class="form-control"
                                placeholder="xxxx" min="1000" max="9999" value="{{ $data->early_year }}" required />
                        </div>
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <label for="final_year" class="form-label">Tahun Akhir <span
                                    class="text-danger">*</span></label>
                            <input type="number" id="final_year" name="final_year" class="form-control"
                                placeholder="xxxx" min="1000" max="9999" value="{{ $data->final_year }}" required />
                        </div>
                        <div class="col mb-3 mb-lg-0">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select class="form-select" id="semester" name="semester">
                                <option selected disabled>Pilih Semester</option>
                                <option value="1" {{ $data->semester == 1 ? 'selected' : '' }}>Ganjil</option>
                                <option value="0" {{ $data->semester == 0 ? 'selected' : '' }}>Genap</option>
                            </select>
                        </div>
                        {{-- <div class="col-lg-6 mb-3">
                            <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option selected disabled>Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
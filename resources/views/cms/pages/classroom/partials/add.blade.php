<div class="modal fade" id="addModal{{ $classroom->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Warga Belajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('classroom.addStudent', $classroom->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="user_id" class="form-label">Warga Belajar <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" name="user_id" class="form-select" required>
                                <option disabled selected>Pilih Warga Belajar...</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->studentProfile->name }}</option>
                                @endforeach
                            </select>
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

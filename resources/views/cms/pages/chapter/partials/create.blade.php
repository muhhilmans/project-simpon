<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Bab Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('chapter.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Judul Bab <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Judul Bab" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="subject_id" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id" name="subject_id" class="form-select" required>
                                <option disabled selected>Pilih Mata Pelajaran...</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
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

<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Bab Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('chapter.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Judul Bab <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ $data->name }}" placeholder="Masukkan Judul Bab" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="subject_id" class="form-label">Mata Pelajaran <span
                                    class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id" name="subject_id" class="form-select" required>
                                <option disabled selected>Pilih Mata Pelajaran...</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ $subject->id == $data->subject_id ? 'selected' : '' }}>{{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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

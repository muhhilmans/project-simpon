<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subject.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}"
                                placeholder="Masukkan Nama Lengkap" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-6 mb-3">
                            <label for="level_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select name="level_id" id="level_id" name="level_id" class="form-select" required>
                                <option disabled selected>Pilih Kelas...</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}" {{ $level->id == $data->level_id ? 'selected' : '' }}>Tingkatan {{ $level->name }}, Kelas {{ $level->class }}, Paket {{ $level->package }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="user_id" class="form-label">Tutor <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" name="user_id" class="form-select" required>
                                <option disabled selected>Pilih Tutor...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $data->user_id ? 'selected' : '' }}>{{ $user->civitasProfile->name }}</option>
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

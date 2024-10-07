<div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Hapus Sub Bab Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sub-chapter.destroy', $data->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center">Apakah Anda yakin menghapus sub bab <span class="fw-bold">{{ $data->title }}</span> ini?</p>
                        <input type="hidden" id="data_id" name="data_id" value="{{ $data->id }}" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
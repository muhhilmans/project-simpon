<div class="modal fade" id="changeModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeModalLabel{{ $data->id }}">{{ $data->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('school-year.status', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center">Apakah Anda yakin {{ $data->is_active ? 'menonaktifkan' : 'mengaktifkan' }} tahun ajaran <span class="fw-bold">{{ $data->early_year }}/{{ $data->final_year }}</span> ini?</p>
                        <input type="hidden" id="data_id" name="data_id" value="{{ $data->id }}" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
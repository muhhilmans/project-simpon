<div class="modal fade" id="changeModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeModalLabel{{ $user->id }}">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Warga Belajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('wargabelajar.status', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <p class="text-center">Apakah Anda yakin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} <span class="fw-bold">{{ $user->studentProfile->name }}</span> ini?</p>
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
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
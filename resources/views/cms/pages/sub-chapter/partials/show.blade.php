<div class="modal fade" id="showModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="showModalLabel{{ $data->id }}">Detail Sub Bab Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($data->format == 'url')
                    <div class="ratio ratio-16x9">
                        {!! $data->video !!}
                    </div>
                @else
                    <p>Ini PDF. Anda dapat mengunduhnya <a href="{{ Storage::url($data->file_path) }}"
                            target="_blank">di sini</a>.</p>
                @endif

                <p>
                    {{ $data->description }}
                </p>
            </div>
        </div>
    </div>
</div>

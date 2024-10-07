<div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $data->id }}">Edit Sub Bab Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sub-chapter.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6 mb-3">
                            <label for="subject_id_edit_{{ $data->id }}" class="form-label">Mata Pelajaran <span
                                    class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id_edit_{{ $data->id }}" class="form-select"
                                required>
                                <option disabled>Pilih Mata Pelajaran...</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ $data->chapterMaterial->subject_id == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="chapter_id_edit_{{ $data->id }}" class="form-label">Bab Materi <span
                                    class="text-danger">*</span></label>
                            <select name="chapter_id" id="chapter_id_edit_{{ $data->id }}" class="form-select"
                                required>
                                <option disabled>Pilih Bab Materi...</option>
                                @foreach ($chapters as $chapter)
                                    <option value="{{ $chapter->id }}" data-subject="{{ $chapter->subject_id }}"
                                        {{ $data->chapter_material_id == $chapter->id ? 'selected' : '' }}>
                                        {{ $chapter->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Judul Sub Bab Materi <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control"
                                value="{{ old('title', $data->title) }}" placeholder="Masukkan Judul Bab" required />
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-lg-6 mb-3">
                            <label for="format_{{ $data->id }}" class="form-label">Format Sub Bab Materi <span
                                    class="text-danger">*</span></label>
                            <select name="format" id="format_{{ $data->id }}" class="form-select" required>
                                <option disabled>Pilih Format Sub Bab Materi...</option>
                                <option value="file" {{ $data->format == 'file' ? 'selected' : '' }}>PDF</option>
                                <option value="url" {{ $data->format == 'url' ? 'selected' : '' }}>Youtube</option>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3" id="pdf-upload-edit-{{ $data->id }}"
                            style="display: {{ $data->format == 'file' ? 'block' : 'none' }};">
                            <label for="pdf_file" class="form-label">Upload PDF <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="pdf_file" id="pdf_file" class="form-control"
                                accept="application/pdf">
                            @if ($data->file_path)
                                <div class="mt-1">
                                    <a href="{{ Storage::url($data->file_path) }}" target="_blank"
                                        class="text-decoration-underline">{{ Str::slug($data->title) }}.pdf</a>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-6 mb-3" id="youtube-link-edit-{{ $data->id }}"
                            style="display: {{ $data->format == 'url' ? 'block' : 'none' }};">
                            <label for="youtube_url" class="form-label">Link YouTube <span
                                    class="text-danger">*</span></label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-control"
                                value="{{ old('youtube_url', $data->url) }}" placeholder="Masukkan link YouTube">
                            @if ($data->url)
                                <div class="mt-1">
                                    <a href="{{ $data->url }}" target="_blank"
                                        class="text-decoration-underline">Lihat Video</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Deskripsi Sub Bab Materi</label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Masukkan Deskripsi Bab">{{ old('description', $data->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectSelect = document.getElementById('subject_id_edit_{{ $data->id }}');
            const chapterSelect = document.getElementById('chapter_id_edit_{{ $data->id }}');
            const allChapters = chapterSelect.querySelectorAll('option[data-subject]');

            const filterChapters = () => {
                const subjectId = subjectSelect.value;
                chapterSelect.innerHTML = '<option disabled selected>Pilih Bab Materi...</option>';
                allChapters.forEach(chapter => {
                    if (chapter.getAttribute('data-subject') === subjectId) {
                        chapterSelect.appendChild(chapter);
                    }
                });
                const currentChapterId = "{{ $data->chapter_material_id }}";
                const currentChapter = chapterSelect.querySelector(`option[value="${currentChapterId}"]`);
                if (currentChapter) {
                    chapterSelect.value = currentChapterId;
                }
            };

            filterChapters();

            subjectSelect.addEventListener('change', filterChapters);

            const formatSelect = document.getElementById('format_{{ $data->id }}');
            const pdfUploadDiv = document.getElementById('pdf-upload-edit-{{ $data->id }}');
            const youtubeLinkDiv = document.getElementById('youtube-link-edit-{{ $data->id }}');

            const toggleFormatFields = () => {
                if (formatSelect.value === 'file') {
                    pdfUploadDiv.style.display = 'block';
                    youtubeLinkDiv.style.display = 'none';
                } else if (formatSelect.value === 'url') {
                    youtubeLinkDiv.style.display = 'block';
                    pdfUploadDiv.style.display = 'none';
                } else {
                    pdfUploadDiv.style.display = 'none';
                    youtubeLinkDiv.style.display = 'none';
                }
            };

            toggleFormatFields();
            formatSelect.addEventListener('change', toggleFormatFields);
        });
    </script>
@endpush

<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Sub Bab Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sub-chapter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6 mb-3">
                            <label for="subject_id" class="form-label">Mata Pelajaran <span
                                    class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id" class="form-select" required>
                                <option disabled selected>Pilih Mata Pelajaran...</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="chapter_id" class="form-label">Bab Materi <span
                                    class="text-danger">*</span></label>
                            <select name="chapter_id" id="chapter_id" class="form-select" required>
                                <option disabled selected>Pilih Bab Materi...</option>
                                @foreach ($chapters as $chapter)
                                    <option value="{{ $chapter->id }}" data-subject="{{ $chapter->subject_id }}">
                                        {{ $chapter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Judul Sub Bab Materi <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control"
                                placeholder="Masukkan Judul Bab" required />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-lg-6 mb-3">
                            <label for="format" class="form-label">Format Sub Bab Materi <span
                                    class="text-danger">*</span></label>
                            <select name="format" id="format" class="form-select" required>
                                <option disabled selected>Pilih Format Sub Bab Materi...</option>
                                <option value="file">PDF</option>
                                <option value="url">Youtube</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3" id="pdf-upload" style="display: none;">
                            <label for="pdf_file" class="form-label">Upload PDF <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="pdf_file" id="pdf_file" class="form-control"
                                accept="application/pdf">
                        </div>
                        <div class="col-lg-6 mb-3" id="youtube-link" style="display: none;">
                            <label for="youtube_url" class="form-label">Link YouTube <span
                                    class="text-danger">*</span></label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-control"
                                placeholder="Masukkan link YouTube">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Deskripsi Sub Bab Materi</label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Masukkan Deskripsi Bab"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectSelect = document.getElementById('subject_id');
            const chapterSelect = document.getElementById('chapter_id');
            const allChapters = chapterSelect.querySelectorAll('option[data-subject]');

            chapterSelect.innerHTML = '<option disabled selected>Pilih Bab Materi...</option>';

            subjectSelect.addEventListener('change', function() {
                const subjectId = this.value;

                chapterSelect.innerHTML = '<option disabled selected>Pilih Bab Materi...</option>';

                allChapters.forEach(chapter => {
                    if (chapter.getAttribute('data-subject') === subjectId) {
                        chapterSelect.appendChild(chapter);
                    }
                });
            });

            const formatSelect = document.getElementById('format');
            const pdfUploadDiv = document.getElementById('pdf-upload');
            const youtubeLinkDiv = document.getElementById('youtube-link');

            formatSelect.addEventListener('change', function() {
                if (this.value === 'file') {
                    // Menampilkan input upload PDF
                    pdfUploadDiv.style.display = 'block';
                    youtubeLinkDiv.style.display = 'none';
                } else if (this.value === 'url') {
                    // Menampilkan input link YouTube
                    youtubeLinkDiv.style.display = 'block';
                    pdfUploadDiv.style.display = 'none';
                } else {
                    // Jika tidak ada yang dipilih, sembunyikan kedua input
                    pdfUploadDiv.style.display = 'none';
                    youtubeLinkDiv.style.display = 'none';
                }
            });
        });
    </script>
@endpush

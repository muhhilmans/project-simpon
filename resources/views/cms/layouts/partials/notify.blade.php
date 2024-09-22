@if ($errors->any())
    <div class="bs-toast toast toast-placement-ex m-2 show top-0 start-50 translate-middle-x bg-danger" role="alert"
        aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-error me-2"></i>
            <div class="me-auto fw-semibold">Gagal</div>
            {{-- <small>11 mins ago</small> --}}
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('success'))
<div class="bs-toast toast toast-placement-ex m-2 show top-0 start-50 translate-middle-x" role="alert"
    aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Berhasil</div>
        {{-- <small>11 mins ago</small> --}}
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">{{ session('success') }}</div>
</div>
@endif

@if (session('error'))
<div class="bs-toast toast toast-placement-ex m-2 show top-0 start-50 translate-middle-x bg-danger" role="alert"
    aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
        <i class="bx bx-error me-2"></i>
        <div class="me-auto fw-semibold">Gagal</div>
        {{-- <small>11 mins ago</small> --}}
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">{{ session('error') }}</div>
</div>
@endif
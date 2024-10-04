@extends('cms.layouts.main', ['title' => 'Detail Pengguna'])

@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('wargabelajar.index') }}"
            class="text-decoration-none text-muted fw-light">Warga Belajar /</a> {{ $user->studentProfile->name }}
    </h4>

    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active d-flex align-items-center" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-pills-top-detail" aria-controls="navs-pills-top-detail" aria-selected="true">
                    <i class="bx bx-user me-1"></i> Detail
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link d-flex align-items-center" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-pills-top-file" aria-controls="navs-pills-top-file" aria-selected="false">
                    <i class="bx bx-file me-1"></i> Berkas
                </button>
            </li>
        </ul>
        <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-pills-top-detail" role="tabpanel">
                <h5 class="card-header">Detail Profil</h5>
                <!-- Account -->
                <div class="card-body pt-0 d-flex justify-content-center">
                    <img alt="Profile"
                        src="{{ $user->studentProfile->photo ? route('getImage', ['path' => 'photos', 'imageName' => $user->studentProfile->photo]) : asset('assets/img/profile-default.png') }}"
                        class="d-block rounded" height="150" width="150">
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ $user->studentProfile->name }}" disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control" type="text" id="nik" name="nik"
                                value="{{ $user->studentProfile->nik ? $user->studentProfile->nik : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nis" class="form-label">NIS</label>
                            <input class="form-control" type="text" id="nis" name="nis"
                                value="{{ $user->studentProfile->nis ? $user->studentProfile->nis : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input class="form-control" type="text" id="nisn" name="nisn"
                                value="{{ $user->studentProfile->nisn ? $user->studentProfile->nisn : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                            <input class="form-control" type="text" id="place_of_birth" name="place_of_birth"
                                value="{{ $user->studentProfile->place_of_birth ? $user->studentProfile->place_of_birth : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                            <input class="form-control" type="text" id="date_of_birth" name="date_of_birth"
                                value="{{ $user->studentProfile->date_of_birth ? $user->studentProfile->date_of_birth : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <input class="form-control" type="text" id="gender" name="gender"
                                value="{{ $user->studentProfile->gender ? $user->studentProfile->gender : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Alamat</label>
                            <input class="form-control" type="text" id="address" name="address"
                                value="{{ $user->studentProfile->address ? $user->studentProfile->address : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="rt" class="form-label">RT</label>
                            <input class="form-control" type="text" id="rt" name="rt"
                                value="{{ $user->studentProfile->rt ? $user->studentProfile->rt : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="rw" class="form-label">RW</label>
                            <input class="form-control" type="text" id="rw" name="rw"
                                value="{{ $user->studentProfile->rw ? $user->studentProfile->rw : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="village" class="form-label">Desa</label>
                            <input class="form-control" type="text" id="village" name="village"
                                value="{{ $user->studentProfile->village ? $user->studentProfile->village : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="district" class="form-label">Kecamatan</label>
                            <input class="form-control" type="text" id="district" name="district"
                                value="{{ $user->studentProfile->district ? $user->studentProfile->district : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="regency" class="form-label">Kabupaten</label>
                            <input class="form-control" type="text" id="regency" name="regency"
                                value="{{ $user->studentProfile->regency ? $user->studentProfile->regency : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="province" class="form-label">Provinsi</label>
                            <input class="form-control" type="text" id="province" name="province"
                                value="{{ $user->studentProfile->province ? $user->studentProfile->province : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="father_name" class="form-label">Nama Ayah</label>
                            <input class="form-control" type="text" id="father_name" name="father_name"
                                value="{{ $user->studentProfile->father_name ? $user->studentProfile->father_name : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="mother_name" class="form-label">Nama Ibu</label>
                            <input class="form-control" type="text" id="mother_name" name="mother_name"
                                value="{{ $user->studentProfile->mother_name ? $user->studentProfile->mother_name : 'Belum diisi' }}"
                                disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" id="username" name="username"
                                value="{{ $user->username ? $user->username : 'Belum diisi' }}" disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" id="email" name="email"
                                value="{{ $user->email ? $user->email : 'Belum diisi' }}" disabled />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Nomor Telepon</label>
                            <input class="form-control" type="text" id="phone_number" name="phone_number"
                                value="{{ $user->studentProfile->phone_number ? $user->studentProfile->phone_number : 'Belum diisi' }}"
                                disabled />
                        </div>
                    </div>
                </div>
                <!-- /Account -->
            </div>
            <div class="tab-pane fade" id="navs-pills-top-file" role="tabpanel">
                <div class="card-header d-flex justify-content-between align-items-center mb-2">
                    <h5>Berkas Kelengkapan</h5>
                    @hasrole('superadmin|admin')
                        <button class="btn btn-{{ $user->is_active ? 'danger' : 'primary' }}" type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#changeModal{{ $user->id }}">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                        @include('cms.pages.user.wargabelajar.partials.change')
                    @endhasrole
                </div>
                <div class="card-body pt-0">
                    <div class="row justify-content-center g-lg-3">
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="identity_card" class="form-label">Kartu Tanda Penduduk</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->identity_card ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->identity_card]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="family_card" class="form-label">Kartu Keluarga</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->family_card ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->family_card]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="school_certificate" class="form-label">Ijazah</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->school_certificate ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->school_certificate]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="birth_certificate" class="form-label">Akta Kelahiran</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->birth_certificate ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->birth_certificate]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="scholarship_application" class="form-label">Surat Pengajuan Beasiswa</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->scholarship_application ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->scholarship_application]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="receipt" class="form-label">Kwitansi Bukti Pendaftaran</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->receipt ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->receipt]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                        <div class="mb-3 col-md-3 d-flex flex-column text-center">
                            <label for="final_report" class="form-label">Rapor Terakhir</label>
                            <img alt="Profile"
                                src="{{ $user->studentFiles->final_report ? route('getImage', ['path' => 'files', 'imageName' => $user->studentFiles->final_report]) : asset('assets/img/logo.png') }}"
                                class="rounded mx-auto" height="200" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('cms.layouts.main', ['title' => 'Detail Pengguna'])

@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('civitas.index') }}"
            class="text-decoration-none text-muted fw-light">Civitas /</a> {{ $user->civitasProfile->name }}
    </h4>

    <div class="card">
        <h5 class="card-header">Detail Profil</h5>
        <div class="card-body d-flex justify-content-center">
            <img alt="Profile"
                src="{{ $user->civitasProfile->photo ? route('getImage', ['path' => 'photos', 'imageName' => $user->civitasProfile->photo]) : asset('assets/img/profile-default.png') }}"
                class="d-block rounded" height="150" width="150">
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" id="name" name="name"
                        value="{{ $user->civitasProfile->name }}" disabled />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <input class="form-control" type="text" id="nip" name="nip"
                        value="{{ $user->civitasProfile->nip ? $user->civitasProfile->nip : 'Belum diisi' }}"
                        disabled />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input class="form-control" type="text" id="username" name="username"
                        value="{{ $user->username ? $user->username : 'Belum diisi' }}"
                        disabled />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="text" id="email" name="email"
                        value="{{ $user->email ? $user->email : 'Belum diisi' }}"
                        disabled />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="phone" class="form-label">Nomor Handphone</label>
                    <input class="form-control" type="text" id="phone" name="phone"
                        value="{{ $user->civitasProfile->phone ? $user->civitasProfile->phone : 'Belum diisi' }}"
                        disabled />
                </div>
            </div>
        </div>
    </div>
@endsection

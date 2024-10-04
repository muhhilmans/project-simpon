<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo justify-content-center">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" style="width: 40px">
            </span>
            {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        @if (auth()->user()->is_active == 1)
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : ''}}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @else
        <li class="menu-item {{ Route::is('candidate') ? 'active' : ''}}">
            <a href="{{ route('candidate') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @endif

        @hasrole('superadmin|ketua|admin|tutor')
            <!-- Guru -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pembelajaran</span>
            </li>
            <li class="menu-item  {{ Route::is('chapter.*', 'sub-chapter.*') ? 'active open' : ''}}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Materi">Materi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('chapter.*') ? 'active' : ''}}">
                        <a href="{{ route('chapter.index') }}" class="menu-link">
                            <div data-i18n="Bab">Bab</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Route::is('sub-chapter.*') ? 'active' : ''}}">
                        <a href="{{ route('sub-chapter.index') }}" class="menu-link">
                            <div data-i18n="Sub Bab">Sub Bab</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="{{ route('task.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Tugas</div>
                </a>
            </li>

            <!-- Rekapitulasi -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Rekapitulasi</span></li>
            <li class="menu-item">
                <a href="{{ route('grade.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Nilai</div>
                </a>
            </li>

            @hasrole('superadmin|admin|ketua')
                <!-- Master -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Master</span></li>
                <li class="menu-item {{ Route::is('classroom.*') ? 'active' : ''}}">
                    <a href="{{ route('classroom.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Rombel">Rombel</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('subject.*') ? 'active' : ''}}">
                    <a href="{{ route('subject.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Mata Pelajaran">Mata Pelajaran</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('school-year.*') ? 'active' : ''}}">
                    <a href="{{ route('school-year.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Tahun Ajaran">Tahun Ajaran</div>
                    </a>
                </li>
                <li class="menu-item  {{ Route::is('civitas.*', 'wargabelajar.*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Pengguna">Pengguna</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Route::is('civitas.*') ? 'active' : ''}}">
                            <a href="{{ route('civitas.index') }}" class="menu-link">
                                <div data-i18n="Civitas">Civitas</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Route::is('wargabelajar.*') ? 'active' : ''}}">
                            <a href="{{ route('wargabelajar.index') }}" class="menu-link">
                                <div data-i18n="Warga Belajar">Warga Belajar</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasrole
        @endhasrole
    </ul>
</aside>

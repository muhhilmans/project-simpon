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
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : ''}}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @hasrole('superadmin|ketua|admin|tutor')
            <!-- Guru -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pembelajaran</span>
            </li>
            <li class="menu-item">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Materi</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Tugas</div>
                </a>
            </li>

            <!-- Rekapitulasi -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Rekapitulasi</span></li>
            <li class="menu-item">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Nilai</div>
                </a>
            </li>

            @hasrole('superadmin|admin')
                <!-- Master -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Master</span></li>
                <li class="menu-item  {{ Route::is('users.*', 'wargabelajar.*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Form Elements">Pengguna</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Route::is('users.*') ? 'active' : ''}}">
                            <a href="{{ route('users.index') }}" class="menu-link">
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
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Layouts">Form Layouts</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="form-layouts-vertical.html" class="menu-link">
                                <div data-i18n="Vertical Form">Vertical Form</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="form-layouts-horizontal.html" class="menu-link">
                                <div data-i18n="Horizontal Form">Horizontal Form</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasrole
        @endhasrole
    </ul>
</aside>

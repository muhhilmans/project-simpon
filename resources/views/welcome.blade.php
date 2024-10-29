<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/landing/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/landing/css/main.css') }}">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                {{-- <h1 class="sitename">PKBM Bela Warga</h1> --}}
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Program</a></li>
                    <li><a href="#features">Beasiswa</a></li>
                    <li><a href="#portfolio">Galeri</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @if (Route::has('login'))
                @auth
                    <a class="btn-getstarted" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
                @endauth
            @endif

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        @include('landing.section.hero')
        <!-- /Hero Section -->

        <!-- About Section -->
        @include('landing.section.about')
        <!-- /About Section -->

        <!-- Levels Section -->
        @include('landing.section.level')
        <!-- /Levels Section -->

        <!-- Scholarship Section -->
        @include('landing.section.scholarship')
        <!-- /Scholarship Section -->

        <!-- Why Us Section -->
        @include('landing.section.flow')
        <!-- /Why Us Section -->

        <!-- Gallery Section -->
        @include('landing.section.gallery')
        <!-- /Gallery Section -->

        <!-- Faq Section -->
        {{-- @include('landing.section.faq') --}}
        <!-- /Faq Section -->

        <!-- Contact Section -->
        @include('landing.section.contact')
        <!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer dark-background">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Daftar Sekarang</h4>
                        <p>Saatnya kembali merajut asa yang tertunda!</p>
                        <a href="#" class="btn-registration">Daftar Sekarang!</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ route('home') }}" class="d-flex align-items-center">
                        <span class="sitename">PKBM Bela Warga</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Yasaadi No. 5 RT 03 RW 1, Sukamanah, <br> Rancaekek, Bandung 40394</p>
                        <p><strong>Telepon:</strong> <span>+62895-3313-75113</span></p>
                        <p><strong>Email:</strong> <span>pkbmbelawarga01@gmail.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Beasiswa</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Other Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Program</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Galeri</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Ikuti Kami</h4>
                    <p>Yuk, gabung jadi bagian dari keluarga kami!</p>
                    <div class="social-links d-flex">
                        <a href="https://wa.me/62895331375113"><i class="bi bi-whatsapp"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">IT PKBM Bela Warga</strong> <span>All Rights
                    Reserved</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/landing/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/landing/js/main.js') }}"></script>

</body>

</html>

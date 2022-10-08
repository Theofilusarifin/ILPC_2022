<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ $pageTitle ?? 'ILPC 2022 - Artificial Iintelligence: The Future Is Now!' }}</title>
    <link rel="apple-touch-icon" href="{{ asset('vuexy') }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('ilpc2022') }}/identity/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/extensions/swiper.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/extensions/ext-component-swiper.min.css">
    {{-- Own Css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/ilpc2022.css">
    <!-- END: Page CSS-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- BEGIN: Custom CSS-->
    @yield('css')
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
            <div class="navbar-header d-xl-block d-none">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <img src="{{ asset('ilpc2022') }}/identity/logo-no-footer.png" width="100" alt="Logo ILPC" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">
                    </li>
                </ul>
            </div>
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ms-auto" style="height: 40px">
                    <li class="nav-item dropdown dropdown-user">
                        <a href="https://time.is/Surabaya" id="time_is_link" rel="nofollow" style="font-size:14px; pointer-events: none; cursor: default;">Jam Server :</a>
                        <span id="Surabaya_z41c" style="font-size:14px; pointer-events: none; cursor: default; color:#7367f0"></span>
                        <script src="//widget.time.is/t.js"></script>
                        <script>
                            time_is_widget.init({Surabaya_z41c:{}});
                        </script>
                    </li>
                    <li class="nav-item dropdown dropdown-user ms-2">
                        <a class="btn btn-outline-primary" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="user"></i> AKUN
                        </a>
                        @auth
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="{{ route(Auth::user()->role.'.index') }}"><i class="me-50" data-feather="cpu"></i>Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="me-50" data-feather="power"></i>
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                        @else
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="{{ route('login') }}"><i class="me-50" data-feather="log-in"></i> Log In</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('register') }}"><i class="me-50" data-feather="edit"></i> Register</a>
                        </div>
                        @endauth

                    </li>
                </ul>
            </div>
        </nav>
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="horizontal-menu-wrapper">
            <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row">
                        <li class="nav-item me-auto">
                            <a class="navbar-brand" href={{ route('visitor.index') }}>
                                <span class="brand-logo">
                                    {{-- Logo Here --}}
                                </span>
                                <img src="{{ asset('ilpc2022') }}/identity/logo-no-footer.png" style="height: 20px;">
                            </a>
                        </li>
                        <li class="nav-item nav-toggle">
                            <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                                <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="shadow-bottom"></div>
                <!-- Horizontal menu content-->
                <div class="navbar-container main-menu-content" style="z-index: 1;" data-menu="menu-container">
                    <!-- include {{ asset('vuexy') }}/includes/mixins-->
                    <ul class="nav navbar-nav justify-content-center menu-content" id="main-menu-navigation" data-menu="menu-navigation">
                        <li class="nav-item{{ request()->is('home') ? ' active' : '' }}{{ request()->is('/') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('visitor.index') }}">
                                <i data-feather="home"></i>
                                <span data-i18n="Home">Home</span>
                            </a>
                        </li>
                        <li class="dropdown nav-item{{ request()->is('acara/*') ? ' active' : '' }}" data-menu="dropdown">
                            <a class="dropdown-toggle nav-link d-flex align-items-center" data-bs-toggle="dropdown"><i data-feather="book"></i><span data-i18n="Lomba">Lomba</span></a>
                            <ul class="dropdown-menu" data-bs-popper="none">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('visitor.penilaian') }}" data-bs-toggle="" data-i18n="Penilaian"><i data-feather="info"></i><span data-i18n="Panduan">Penilaian</span></a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('visitor.peraturan') }}" data-bs-toggle="" data-i18n="Peraturan"><i data-feather="info"></i><span data-i18n="Peraturan">Peraturan</span></a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('visitor.detail') }}" data-bs-toggle="" data-i18n="Detail"><i data-feather="info"></i><span data-i18n="Detail">Detail</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item{{ request()->is('gallery') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('visitor.gallery') }}">
                                <i data-feather="aperture"></i>
                                <span data-i18n="Galeri">Galeri</span>
                            </a>
                        </li>
                        <li class="nav-item{{ request()->is('faq') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('visitor.faq') }}">
                                <i data-feather="help-circle"></i>
                                <span data-i18n="FAQ">FAQ</span>
                            </a>
                        </li>
                        <li class="nav-item{{ request()->is('contact') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('visitor.contact') }}"><i data-feather="phone"></i><span data-i18n="Kontak">Kontak</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        @yield("content")


        {{-- <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="content-wrapper p-0">
                <div class="content-body">

                </div>
            </div>
        </div> --}}
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        <!----------- Footer ------------>
        <footer class="footer-bs mt-3">
            <div class="row">
                <div class="col-md-3 footer-brand animated fadeInLeft">
                    <h2>ILPC 2022</h2>
                    <p>ILPC adalah kompetisi logika dan pemrograman tingkat nasional yang diadakan setiap tahun oleh Jurusan
                        Teknik Informatika Fakultas Teknik Universitas Surabaya (UBAYA) yang diikuti oleh siswa SMA atau
                        sederajat se-Indonesia..</p>
                    <div class="brand-text mb-0 d-inline">
                        <img src="{{ asset('ilpc2022') }}/ubaya/logo.png" style="height: 20px;">
                    </div>
                    <div class="brand-text mb-0 d-inline">
                        <img src="{{ asset('ilpc2022') }}/identity/logo-no-footer.png" style="height: 30px;">
                    </div>
                </div>
                <div class="col-md-2 footer-nav animated fadeInUp">
                    <h4>Menu —</h4>
                    {{-- <div class="col-md-6"> --}}
                        <ul class="pages">
                            <li><a href="{{ route('visitor.index') }}">Home</a></li>
                            <li><a href="{{ route('visitor.penilaian') }}">Penilaian</a></li>
                            <li><a href="{{ route('visitor.peraturan') }}">Peraturan</a></li>
                            <li><a href="{{ route('visitor.detail') }}">Detail</a></li>
                            <li><a href="{{ route('visitor.gallery') }}">Gallery</a></li>
                            <li><a href="{{ route('visitor.faq') }}">FAQ</a></li>
                            <li><a href="{{ route('visitor.contact') }}">Contact</a></li>
                        </ul>
                        {{--
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <ul class="list">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Terms & Condition</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div> --}}
                </div>
                <div class="col-md-3 footer-social animated fadeInDown">
                    <h4>Follow Us</h4>
                    <ul>
                        <li> <a href="https://www.instagram.com/ilpc_ubaya/?hl=en" target="_blank" rel="noopener"><i data-feather="instagram"></i>&nbsp; ilpc_ubaya</a></li>
                        <li> <a href="https://www.facebook.com/ilpcubaya.page/" target="_blank" rel="noopener"><i data-feather="facebook"></i>&nbsp; ilpc ubaya</a></li>

                    </ul>
                    <h4>Contact Us</h4>
                    <ul>
                        <li><b>Whatsapp</b></li>
                        <li><a href="https://wa.me/+6289620102020" target="_blank" rel="noopener"><i data-feather="phone"></i>&nbsp; Sean Alessandro (089620102020)</a></li>
                        <li><a href="https://wa.me/+6281231599922" target="_blank" rel="noopener"><i data-feather="phone"></i>&nbsp; Brian Owen (081231599922)</a></li>
                        <li><b>Line OA</b></li>
                        <li> @QIX0011E</li>
                        <li><b>Email</b></li>
                        <li><a href="mailto:ilpc.ubaya@gmail.com" target="_blank" rel="noopener"><i data-feather="mail"></i>&nbsp; ilpc.ubaya@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-social animated fadeInRight">
                    <h4 class="mb-2">Media Partner</h4>
                    <div class="brand-text me-1 d-inline">
                        <img src="{{ asset('ilpc2022') }}/medpart/event_kampus.png" style="height: 40px;">
                    </div>
                    <div class="brand-text me-1 d-inline">
                        <img src="{{ asset('ilpc2022') }}/medpart/eventcampus.png" style="height: 40px;">
                    </div>
                    <div class="brand-text me-1 d-inline">
                        <img src="{{ asset('ilpc2022') }}/medpart/info_event_jatim.png" style="height: 40px;">
                    </div>
                    <div class="brand-text me-1 d-inline">
                        <img src="{{ asset('ilpc2022') }}/medpart/info_event.png" style="height: 40px;">
                    </div>
                    <div class="brand-text me-1 d-inline">
                        <img class="my-1" src="{{ asset('ilpc2022') }}/medpart/info_surabaya.jpg" style="height: 40px;">
                    </div>
                    <div class="brand-text me-1 d-inline">
                        <img class="my-1" src="{{ asset('ilpc2022') }}/medpart/ou.png" style="height: 40px;">
                    </div>
                    <hr style="color:#505154"> <br>
                    <h4 class="mb-2">Sponsor</h4>
                    <div class="brand-text me-1 d-inline">
                        <img class="my-1" src="{{ asset('ilpc2022') }}/medpart/dewaweb.png" style="height: 50px;">
                    </div>
                    <div class="brand-text me-1 d-inline">
                        <img class="my-1" src="{{ asset('ilpc2022') }}/medpart/dicoding.png" style="height: 30px;">
                    </div>
                </div>
            <p class="mt-2">
                <span class="float-md-start d-block d-md-inline-block mt-25 text-white">COPYRIGHT &copy; Information System
                    ILPC 2022</span>
            </p>
        </footer>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/extensions/ext-component-swiper.js"></script>
    <!-- END: Page JS-->

    {{-- Script AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- Anime Js Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script>
        anime({
            targets: '.line-drawing-demo .lines path',
            strokeDashoffset: [anime.setDashoffset, 0],
            easing: 'easeInOutSine',
            duration: 1500,
            delay: function(el, i) {
                return i * 250
            },
            direction: 'alternate',
            loop: true
        });
    </script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    {{-- Particle JS Script --}}
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/617cf14a86aee40a5739138f/1fj80t3p7';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    @yield("javascript")
</body>
<!-- END: Body-->

</html>
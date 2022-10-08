<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    {{-- Kalau Peserta Back, Pagenya Refresh --}}
    <script>
        if(performance.navigation.type == 2){
            location.reload(true);
        }
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ $pageTitle ?? 'ILPC 2022 - Artificial Iintelligence: The Future Is Now!' }}</title>
    <link rel="apple-touch-icon" href="{{ asset('vuexy') }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('ilpc2022') }}/identity/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/forms/select/select2.min.css">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/pages/app-invoice-list.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/assets/css/style.css">
    <!-- END: Custom CSS-->

    @yield('style')

</head>
<!-- END: Head -->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('pemain.index') }}"><span class="brand-logo">
                        <img src="{{ asset('ilpc2022') }}/identity/logo-no-footer.png" width="100" alt="Logo ILPC" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">    
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                                data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                {{-- Foto Profile --}}
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- Ambil nama tim dari database --}}
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{ auth()->user()->team->nama }}</span><span class="user-status">Account</span></div><span class="avatar"><img class="round" src="{{ asset('ilpc2022') }}/identity/account.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('visitor.index') }}">
                            <i class="me-50" data-feather="home"></i>
                            Main Website
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="log-out"></i>
                            Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
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
                        <a class="navbar-brand" href={{ route('pemain.index') }}>
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
                <div class="navbar-container main-menu-content" data-menu="menu-container">
                    <!-- include {{ asset('vuexy') }}/includes/mixins-->
                    <ul class="nav navbar-nav justify-content-center menu-content" id="main-menu-navigation" data-menu="menu-navigation">
                        <li class="nav-item{{ request()->is('pemain') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('pemain.index') }}">
                                <i data-feather="cpu"></i>
                                <span data-i18n="Home">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item{{ request()->is('pemain/contest') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('pemain.contest') }}">
                                <i data-feather="award"></i>
                                <span data-i18n="Contest">Contest</span>
                            </a>
                        </li>
                        {{-- @php
                            COMMENT INI
                            $team_simul_user_id = array(43,45,46,47,48,54,55,56,57,60,61,62,63,64,65,5)
                            
                            UNCOMMENT INI
                            $team_semifinal_team_id = array(1,9,32,19,73,21,27,54,11,49,50,58,71,15,66,75,25,57,22,20,56,6,62,12,72,17,13,59,14,16,74,52,53,70,24,51,63,55,26,68,60);
                        @endphp
                        COMMENT INI
                        @if(in_array(Auth::user()->id, $team_simul_user_id))
                        
                        UNCOMMENT INI
                        @if(in_array(Auth::user()->team->id, $team_semifinal_team_id))
                        <li class="nav-item{{ request()->is('pemain/rally-games/*') ? ' active' : '' }} {{ request()->is('pemain/rally-games') ? ' active' : '' }}">
                            <a class="nav-link d-flex align-items-center" href="{{ route('pemain.rally') }}">
                                <i data-feather="life-buoy"></i>
                                <span data-i18n="Contest">Semifinal</span>
                            </a>
                        </li>
                        @endif --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; ILPC Information System
                <span class="d-none d-sm-inline-block">, All rights Reserved</span>
            </span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/dashboard-analytics.js"></script> --}}
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/app-invoice-list.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-select2.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-number-input.min.js"></script>
    <!-- END: Page JS-->

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

    @yield('script')
</body>
<!-- END: Body-->

</html>
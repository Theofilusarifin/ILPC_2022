<!DOCTYPE html>
@php
    $selected_mode = request()->session()->get('mode') ?? 'light';
@endphp 
<html class="loading {{ $selected_mode }}-layout" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Love from SI <3">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ $pageTitle ?? 'ILPC 2022 - Artificial Iintelligence: The Future Is Now!' }}</title>
    <link rel="apple-touch-icon" href="{{ asset('vuexy') }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('ilpc2022') }}/identity/favicon.ico"">
    <link href=" https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/pages/authentication.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/plugins/forms/form-file-uploader.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/assets/css/style.css">
    <!-- END: Custom CSS-->

    @yield('style')
    @yield('header')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-{{ $selected_mode }} navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item">
                        <a class="nav-link menu-toggle" href="#">
                            <i class="ficon" data-feather="menu">
                            </i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-style" onclick="SetMode()">
                            @php
                                if ($selected_mode == 'light') $data_feather = 'moon';
                                else $data_feather = 'sun';
                            @endphp 
                            <i class="ficon" id="mode_param" data-feather={{ $data_feather }}></i>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-flex">
                            <span class="user-name fw-bolder">{{ auth()->user()->username }}</span>
                            <span class="user-status">Account</span>
                        </div>
                        <div class="user-nav d-flex">
                            <span class="avatar"><img class="round" src="{{ asset('ilpc2022') }}/identity/account.jpg" alt="avatar" height="40" width="40">
                                <span class="avatar-status-online"></span>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        {{-- <a class="dropdown-item" href="#"><i class="me-50" data-feather="user"></i>
                            Profile</a><a class="dropdown-item" href="#"><i class="me-50" data-feather="mail"></i>
                            Inbox</a><a class="dropdown-item" href="#"><i class="me-50" data-feather="check-square"></i>
                            Task</a><a class="dropdown-item" href="#"><i class="me-50" data-feather="message-square"></i>
                            Chats</a> --}}
                        {{-- <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="me-50" data-feather="settings"></i> Settings</a><a class="dropdown-item" href="#"><i class="me-50" data-feather="credit-card"></i> Pricing</a> --}}
                        <a class="dropdown-item" href="{{ route('visitor.index') }}">
                            <i class="me-50" data-feather="help-circle"></i>
                            Main Website
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i>
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
    <div class="main-menu menu-fixed menu-{{ $selected_mode }} menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ route('soal.index') }}">
                        {{-- <span class="brand-logo"></span> --}}
                        <img src="{{ asset('ilpc2022') }}/identity/logo-no-footer.png" style="height: 20px;">
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item{{ $pageActive == 'soal.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('soal.index') }}">
                        <i data-feather="menu"></i>
                        <span class="menu-title text-truncate">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'soal' || Auth::user()->role == 'penpos')
                <div class="divider">
                    <div class="divider-text">Contest</div>
                </div>
                <li class="nav-item{{ $pageActive == 'soal.prg.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('soal.prg.index') }}">
                        <i data-feather="book"></i>
                        <span class="menu-title text-truncate">Programming</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role == 'soal')
                <li class="nav-item{{ $pageActive == 'soal.mc.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('soal.mc.index') }}">
                        <i data-feather="book"></i>
                        <span class="menu-title text-truncate">Multiple Choice</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role == 'soal' || Auth::user()->role == 'penpos')
                <li class="nav-item{{ $pageActive == 'soal.essay.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('soal.essay.index') }}">
                        <i data-feather="book"></i>
                        <span class="menu-title text-truncate">Essay</span>
                    </a>
                </li>
                @endif
                </li>
                @if (Auth::user()->role == 'soal')
                <div class="divider">
                    <div class="divider-text">Code</div>
                </div>
                <li class="nav-item{{ $pageActive == 'soal.run.code' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('soal.run.code') }}">
                        <i data-feather="codesandbox"></i>
                        <span class="menu-title text-truncate">Run Code</span>
                    </a>
                </li>
                <div class="divider">
                    <div class="divider-text">Score</div>
                </div>
                <li class="nav-item{{ $pageActive == 'soal.summerize.score' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('soal.summerize.score') }}">
                        <i data-feather="airplay"></i>
                        <span class="menu-title text-truncate">Summarize Score</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role == 'acara')
                <div class="divider">
                    <div class="divider-text">Rally</div>
                </div>
                <li class="nav-item{{ $pageActive == 'acara.rally.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('acara.rg.index') }}">
                        <i data-feather="life-buoy"></i>
                        <span class="menu-title text-truncate">List of Rally Games</span>
                    </a>
                </li>
                <li class="nav-item{{ $pageActive == 'acara.rally.scoreboard' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('acara.rg.scoreboard') }}">
                        <i data-feather="award"></i>
                        <span class="menu-title text-truncate">Scoreboard</span>
                    </a>
                </li>
                <div class="divider">
                    <div class="divider-text">Gambes</div>
                </div>
                <li class="nav-item{{ $pageActive == 'acara.gambes.wave.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('acara.gambes.wave.index') }}">
                        <i data-feather="activity"></i>
                        <span class="menu-title text-truncate">List of Waves</span>
                    </a>
                </li>
                <li class="nav-item{{ $pageActive == 'acara.gambes.item.index' ? ' active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('acara.gambes.item.index') }}">
                        <i data-feather="archive"></i>
                        <span class="menu-title text-truncate">List of Items</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role == 'penpos')
                    <div class="divider">
                        <div class="divider-text">Rally</div>
                    </div>
                    <li class="nav-item{{ $pageActive == 'penpos.rally-games.index' ? ' active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('penpos.rg.index') }}">
                            <i data-feather="life-buoy"></i>
                            <span class="menu-title text-truncate">Rally Games</span>
                        </a>
                    </li>

                    @php
                        $penpos_gambes = array(140, 141, 142, 143, 144, 145, 146)
                    @endphp
                    @if(in_array(Auth::user()->id, $penpos_gambes))
                        <div class="divider">
                            <div class="divider-text">Gambes</div>
                        </div>
                        <li class="nav-item{{ $pageActive == 'penpos.gambes.index' ? ' active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('penpos.gb.index') }}">
                                <i data-feather="life-buoy"></i>
                                <span class="menu-title text-truncate">Game Besar</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            @yield('content')
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-{{ $selected_mode }}">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; ILPC
                2022<span class="d-none d-sm-inline-block">,
                    All rights Reserved</span></span>
            <span class="float-md-end d-none d-md-block">SI Mohon Dicintai<i data-feather="heart"></i></span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/auth-login.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-select2.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/components/components-popovers.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-number-input.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/forms/form-file-uploader.js"></script>
    <script src="{{ asset('vuexy') }}/app-assets/js/scripts/customizer.min.js"></script>
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

        function SetMode() {
            $.ajax({
                type: 'POST',
                url: "{{ route('soal.set.mode') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    // location.reload();
                }
            });
        }
    </script>

    @yield('script')
</body>
<!-- END: Body-->

</html>
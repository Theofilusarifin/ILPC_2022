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
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('vuexy') }}/app-assets/css/components.min.css">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/contest.css">
    <!-- END: Custom CSS-->

    <style>
        div.sticky {
                position: -webkit-sticky;
                position: sticky;
                top: 25px;
                bottom : 0;
        }

        @media (max-width: 1160px) {
            div.sticky {
                position: static;
            }
        }
    </style>

    @yield('style')
</head>
<!-- END: Head -->

<!-- BEGIN: Body-->

<body>
    <!-- BEGIN: Header-->
    <div class="contest-container">
        <div class="contest-content">
            @yield('content')
        </div>
        <div class="contest-nav sticky">
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item mb-1"><a href="{{route('pemain.contest')}}">Contest</a></li>
                    @if ($contestType == 'Programming')
                    <li class="breadcrumb-item mb-1"><a href="{{route('pemain.contest.prg', $contest->slug)}}">{{ $contest->nama }}</a></li>
                    @elseif ($contestType == 'Programming > Question')
                    <li class="breadcrumb-item mb-1"><a href="{{route('pemain.contest.prg', $contest->slug)}}">{{ $contest->nama }}</a></li>
                    @elseif ($contestType == 'Programming > Scoreboard')
                    <li class="breadcrumb-item mb-1"><a href="{{route('pemain.contest.prg', $contest->slug)}}">{{ $contest->nama }}</a></li>
                    @elseif ($contestType == 'Multiple Choice')
                    <li class="breadcrumb-item mb-1"><a href="{{route('pemain.contest.mc', [$contest->slug, $nomor])}}">{{ $contest->nama }}</a></li>
                    @elseif ($contestType == 'Essay')
                    <li class="breadcrumb-item mb-1"><a href="{{route('pemain.contest.essay', $contest->slug)}}">{{ $contest->nama }}</a></li>
                    @endif
                </ol>
            </div>
            <br>
            <h4>{{ $contest->nama }}</h4>
            <div class='divider divider-start'>
                <div class="divider-text">
                    <span class="badge badge-light-primary">{{ $contestType ?? 'Programming' }}</span>
                </div>
            </div>
            <br><br>
            <p>Jadwal Mulai : {{ $contest->jadwal_mulai }}</p>
            <p>Jadwal Selesai : <span id="jadwal_selesai">{{ $contest->jadwal_selesai }}</p>
            <br>
            <p>Sisa Waktu : <span id="hours_left"></span><span id="mins_left"></span><span id="secs_left"></span></p>
            @if ($contestType == 'Multiple Choice')
            <div>
                <span class="badge badge-light-warning text-start">Pastikan anda memilih jawaban dan tingkat <br> keyakinan untuk menyimpan jawaban anda</span>
            </div>
            @endif
            @if ($contestType == 'Programming > Scoreboard')
            <div>
                <span class="badge badge-light-warning text-start">Scoreboard tidak perlu di Refresh</span>
            </div>
            @endif
        </div>
        <!-- END: Header-->

        <!-- BEGIN: Content-->
        <!-- END: Content-->

        <!-- BEGIN: Footer-->
        <button class="btn btn-primary btn-icon scroll-top mb-5" type="button"><i data-feather="arrow-up"></i></button>
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
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="{{ asset('vuexy') }}/app-assets/js/core/app-menu.js"></script>
        <script src="{{ asset('vuexy') }}/app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        {{-- <script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/dashboard-analytics.js"></script> --}}
        <script src="{{ asset('vuexy') }}/app-assets/js/scripts/pages/app-invoice-list.js"></script>
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
        
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/61dae75bb84f7301d32a182c/1fovhfg52';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>

        <script>
            $('body').bind('copy paste',function(e) {
                alert('This Feature is Disabled');
                e.preventDefault();
                return false; 
            });
            document.addEventListener('contextmenu', event => {
                event.preventDefault()
                alert('This Feature is Disabled');
                return false;
            }); // Klik Kanan
            document.onkeydown = function (e) {
                if(e.keyCode == 123) { alert('This Feature is Disabled'); return false; } // Key F12 -> Menu Application
                if(e.ctrlKey && e.shiftKey && e.keyCode == 73){ alert('This Feature is Disabled'); return false; } // Ctrl Shift i -> Menu Application
                if(e.ctrlKey && e.shiftKey && e.keyCode == 74) { alert('This Feature is Disabled'); return false; } // Ctrl shift j -> Menu Console
                if(e.ctrlKey && e.keyCode == 85) { alert('This Feature is Disabled'); return false; } // Ctrl U -> View Page Source
            }
        </script>

        <script>
            var year = {{ now()->year }}
            var month = {{ now()->month }}
            var day = {{ now()->day }}
            var hour = {{ now()->hour }}
            var minute = {{ now()->minute }}
            var second = {{ now()->second }}
            var millisecond = {{ now()->millisecond }}

            const countdown = () => {
                let startDate = null;
                var offerDate = new Date({{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->year }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->month }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->day }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->hour }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->minute }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->second }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contest->jadwal_selesai)->millisecond }});

                second += 1;
                if (second>60){
                    minute+=1;
                    second-=60;
                }
                if (minute>60){
                    hour+=1;
                    minute-=60;
                }

                startDate = new Date(year, month, day, hour, minute, second, 0);
                
            
                //offerTime will have the total millseconds
                const offerTime = offerDate - startDate;
                

                // 1 sec= 1000 ms
                // 1 min = 60 sec
                // 1 hour = 60 mins
                const offerHours = Math.floor((offerTime / (1000 * 60 * 60) % 24));
                const offerMins = Math.floor((offerTime / (1000 * 60) % 60));
                const offerSecs = Math.floor((offerTime / 1000) % 60);

                //Kalau waktu sudah habis
                if (offerHours <= 0 && offerMins <= 0 && offerSecs <= 0) {
                    window.location = "{{ route('pemain.contest') }}";
                }

                $('#hours_left').html(offerHours+":");
                $('#mins_left').html(offerMins+":");
                $('#secs_left').html(offerSecs);
            }
            setInterval(countdown, 1000);
        </script>
        @yield('script')
</body>
<!-- END: Body-->

</html>
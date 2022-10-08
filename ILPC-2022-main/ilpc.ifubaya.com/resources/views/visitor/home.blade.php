@extends('visitor.layouts.app')

@section('content')
<div class="app-content content" style="padding: 0;">
    <div class="content-body">

        {{-- CAROUSEL --}}
        <div id="carousel-example-caption" class="carousel slide carousel-fade" data-bs-ride="carousel">
            {{-- <ol class="carousel-indicators">
                <li data-bs-target="#carousel-example-caption" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carousel-example-caption" data-bs-slide-to="1"></li>
                <li data-bs-target="#carousel-example-caption" data-bs-slide-to="2"></li>
            </ol> --}}
            <div class="carousel-inner">
                <div class="carousel-item active" style="max-height: 100vh;">
                    <img class="img-fluid" src="{{ asset('ilpc2022') }}/home/c1.jpg" alt="First slide" style="min-height: 500px; width: 100%; object-fit: cover;" />
                    <div class="carousel-caption d-flex h-100 align-items-start justify-content-center flex-column" style="position: absolute; top: 20px; text-align: start;">
                        <div class="demo-content line-drawing-demo py-1">
                            <svg style="width: 160px; height: 60px; transform: scale(1.2)">
                                <g fill="none" fill-rule="evenodd" stroke="#7367f0" stroke-width="2" class="lines">
                                    <path class="el" d="M20.5 48H30.4V13H20.5V48Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M39.5 48H66.1V40.15H49.4V13H39.5V48Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M88.5 13H72.5V48H82.4V38.85H88.5C98.05 38.85 104.05 33.9 104.05 25.95C104.05 17.95 98.05 13 88.5 13ZM87.9 31.05H82.4V20.8H87.9C92 20.8 94.05 22.7 94.05 25.95C94.05 29.15 92 31.05 87.9 31.05Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M128.95 48.7C135.4 48.7 140.6 46.35 144 42.1L137.7 36.4C135.5 39.05 132.8 40.5 129.45 40.5C123.7 40.5 119.7 36.5 119.7 30.5C119.7 24.5 123.7 20.5 129.45 20.5C132.8 20.5 135.5 21.95 137.7 24.6L144 18.9C140.6 14.65 135.4 12.3 128.95 12.3C117.85 12.3 109.7 19.85 109.7 30.5C109.7 41.15 117.85 48.7 128.95 48.7Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>
                                </g>
                            </svg>
                        </div>
                        <p class="text-white col-md-6 col-sm-12 carousel-desc">
                            Selamat datang di halaman utama ILPC 2022. Informatics Logical Programming Competition
                            (ILPC) adalah lomba programming yang diadakan oleh Universitas Surabaya untuk siswa SMA/SMK
                            sederajat. Ayo daftarkan dirimu dan menangkan hadiahnya!
                        </p>
                    </div>
                </div>
                <div class="carousel-item " style="max-height: 100vh;">
                    <img class="img-fluid" src="{{ asset('ilpc2022') }}/home/c2.jpg" alt="First slide" style="min-height: 500px; width: 100%; object-fit: cover;" />
                    <div class="carousel-caption d-flex h-100 align-items-start justify-content-center flex-column" style="position: absolute; top: 20px; text-align: start;">
                        <div class="demo-content line-drawing-demo py-1">
                            <svg style="width: 160px; height: 60px; transform: scale(1.2)">
                                <g fill="none" fill-rule="evenodd" stroke="#7367f0" stroke-width="2" class="lines">
                                    <path class="el" d="M20.5 48H30.4V13H20.5V48Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M39.5 48H66.1V40.15H49.4V13H39.5V48Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M88.5 13H72.5V48H82.4V38.85H88.5C98.05 38.85 104.05 33.9 104.05 25.95C104.05 17.95 98.05 13 88.5 13ZM87.9 31.05H82.4V20.8H87.9C92 20.8 94.05 22.7 94.05 25.95C94.05 29.15 92 31.05 87.9 31.05Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M128.95 48.7C135.4 48.7 140.6 46.35 144 42.1L137.7 36.4C135.5 39.05 132.8 40.5 129.45 40.5C123.7 40.5 119.7 36.5 119.7 30.5C119.7 24.5 123.7 20.5 129.45 20.5C132.8 20.5 135.5 21.95 137.7 24.6L144 18.9C140.6 14.65 135.4 12.3 128.95 12.3C117.85 12.3 109.7 19.85 109.7 30.5C109.7 41.15 117.85 48.7 128.95 48.7Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>
                                </g>
                            </svg>
                        </div>
                        <p class="text-white col-md-6 col-sm-12 carousel-desc">
                            Selamat datang di halaman utama ILPC 2022. Informatics Logical Programming Competition
                            (ILPC) adalah lomba programming yang diadakan oleh Universitas Surabaya untuk siswa SMA/SMK
                            sederajat. Ayo daftarkan dirimu dan menangkan hadiahnya!
                        </p>
                    </div>
                </div>
                <div class="carousel-item" style="max-height: 100vh;">
                    <img class="img-fluid" src="{{ asset('ilpc2022') }}/home/c3.jpg" alt="First slide" style="min-height: 500px; width: 100%; object-fit: cover;" />
                    <div class="carousel-caption d-flex h-100 align-items-start justify-content-center flex-column" style="position: absolute; top: 20px; text-align: start;">
                        <div class="demo-content line-drawing-demo py-1">
                            <svg style="width: 160px; height: 60px; transform: scale(1.2)">
                                <g fill="none" fill-rule="evenodd" stroke="#7367f0" stroke-width="2" class="lines">
                                    <path class="el" d="M20.5 48H30.4V13H20.5V48Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M39.5 48H66.1V40.15H49.4V13H39.5V48Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M88.5 13H72.5V48H82.4V38.85H88.5C98.05 38.85 104.05 33.9 104.05 25.95C104.05 17.95 98.05 13 88.5 13ZM87.9 31.05H82.4V20.8H87.9C92 20.8 94.05 22.7 94.05 25.95C94.05 29.15 92 31.05 87.9 31.05Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>

                                    <path class="el" d="M128.95 48.7C135.4 48.7 140.6 46.35 144 42.1L137.7 36.4C135.5 39.05 132.8 40.5 129.45 40.5C123.7 40.5 119.7 36.5 119.7 30.5C119.7 24.5 123.7 20.5 129.45 20.5C132.8 20.5 135.5 21.95 137.7 24.6L144 18.9C140.6 14.65 135.4 12.3 128.95 12.3C117.85 12.3 109.7 19.85 109.7 30.5C109.7 41.15 117.85 48.7 128.95 48.7Z" stroke-dasharray="316.85528564453125" style="stroke-dashoffset: 174.483px;"></path>
                                </g>
                            </svg>
                        </div>
                        <p class="text-white col-md-6 col-sm-12 carousel-desc">
                            Selamat datang di halaman utama ILPC 2022. Informatics Logical Programming Competition
                            (ILPC) adalah lomba programming yang diadakan oleh Universitas Surabaya untuk siswa SMA/SMK
                            sederajat. Ayo daftarkan dirimu dan menangkan hadiahnya!
                        </p>
                    </div>
                </div>

                <a class="carousel-control-prev" data-bs-target="#carousel-example-caption" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a>
                <a class="carousel-control-next" data-bs-target="#carousel-example-caption" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-wrapper">
        <div style="position: relative;">
            <div id="particles-js">
                
                {{-- PRIZE LIST --}}
                <div class="row d-flex justify-content-center align-items-center vh-home">
                    <div class="row d-flex justify-content-center align-items-center" data-aos="fade-up">
                        <!-- JUARA 1 -->
                        <div class="col-12 col-lg-3 col-md-4 order-lg-2 order-md-2  order-sm-1" id="juara1">
                            <div class="card enterprise-pricing text-center">
                                <div class="card-body">
                                    <img src="{{ asset('ilpc2022') }}/maskot/1.png" alt="svg img" style="width: 50%;">
                                    <h2 class="text-primary">Rp 6.000.000,00</h2>
                                    <p class="card-text">Juara 1</p>
                                    <ul class="list-group list-group-flush text-start ps-2 pe-2">
                                        <li class="list-group-item">Piala Bergilir Walikota Surabaya</li>
                                        <li class="list-group-item">Piala ILPC</li>
                                        <li class="list-group-item">Medali</li>
                                        <li class="list-group-item">Sertifikat</li>
                                        {{-- <li class="list-group-item">Potongan USP 100%*</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ JUARA 1 -->
                        <!-- JUARA 2 -->
                        <div class="col-12 col-lg-3 col-md-4 order-lg-1 order-md-1 order-sm-2 " id="juara2">
                            <div class="card standard-pricing popular text-center">
                                <div class="card-body">
                                    <div class="pricing-badge text-end">
                                    </div>
                                    <img src="{{ asset('ilpc2022') }}/maskot/2.png " alt="svg img" style="width: 50%;">
                                    <h3 class="text-primary">Rp. 4.000.000,00</h3>
                                    <p class="card-text">Juara 2</p>
                                    <ul class="list-group list-group-flush text-start ps-2 pe-2">
                                        <li class="list-group-item">Piala ILPC</li>
                                        <li class="list-group-item">Medali</li>
                                        <li class="list-group-item">Sertifikat</li>
                                        {{-- <li class="list-group-item">Potongan USP 70%*</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ JUARA 2 -->
                        <!-- JUARA 3 -->
                        <div class="col-12 col-lg-3 col-md-4 order-lg-3 order-md-3 order-sm-3 " id="juara3">
                            <div class="card enterprise-pricing text-center">
                                <div class="card-body">
                                    <img src="{{ asset('ilpc2022') }}/maskot/3.png " alt="svg img" style="width: 50%;">
                                    <h3 class="text-primary">Rp. 2.500.000,00</h3>
                                    <p class="card-text">Juara 3</p>
                                    <ul class="list-group list-group-flush text-start ps-2 pe-2">
                                        <li class="list-group-item">Piala ILPC</li>
                                        <li class="list-group-item">Medali</li>
                                        <li class="list-group-item">Sertifikat</li>
                                        {{-- <li class="list-group-item">Potongan USP 60%*</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ JUARA 3 -->
                    </div>
                </div>
                {{-- / PRIZE LIST --}}

                {{-- AFTER MOVIE ILPC 2021 --}}
                    <div class="container-xxl vh-home" data-aos="fade-up">
                        <div class="px-4">
                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/O8jgIh0ARZM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                {{-- / AFTER MOVIE ILPC 2021 --}}


                {{-- TIMELINE ILPC 2022 --}}
                <div class="d-md-block d-none col-lg-12 vh-home container" data-aos="fade-up">
                    <div class="card p-1">
                        <div class="card-header d-flex justify-content-center">
                            <h1 class="btn btn-primary" style="cursor:default; pointer-events: none;">Timeline ILPC 2022</h1>
                        </div>
                        <div class="card-body">
                            <object data="{{ asset('ilpc2022') }}/home/timeline.svg" width="100%"> </object>
                        </div>
                    </div>
                </div>
                <div class="row d-lg-none d-md-none d-sm-flex justify-content-center align-items-center vh-home">
                    <div class="col-12" data-aos="fade-up">
                        <div class="card p-1">
                            <div class="card-header">
                                <h4 class="card-title">Timeline</h4>
                            </div>
                            <div class="card-body">
                                <ul class="timeline">
                                    <x-timeline iconColor="timeline-point-primary" icon="book">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Pendaftaran Early Bird Dibuka</h6>
                                            <span class="timeline-event-time">1 NOV - 17 DEC 2022</span>
                                        </div>
                                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium aliquid dolorum unde cum modi.</p> --}}
                                        <a href="{{ route('register') }}">
                                            <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="true" aria-controls="collapseExample2">
                                                Daftar Sekarang
                                            </button>
                                        </a>
                                    </x-timeline>
                                    <x-timeline iconColor="timeline-point-primary" icon="book">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Pendaftaran Normal Dibuka</h6>
                                            <span class="timeline-event-time">20 DEC 2021 - 16 JAN 2022</span>
                                        </div>
                                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium aliquid dolorum unde cum modi.</p> --}}
                                    </x-timeline>

                                    <x-timeline iconColor="timeline-point-warning" icon="code">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Babak Penyisihan</h6>
                                            <span class="timeline-event-time">20-21 JAN 2022</span>
                                        </div>
                                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga exercitationem necessitatibus accusamus optio nesciunt! Nisi.</p> --}}
                                    </x-timeline>
                                    <x-timeline iconColor="timeline-point-info" icon="user">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Technical Meeting</h6>
                                            <span class="timeline-event-time">27 JAN 2022</span>
                                        </div>
                                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga exercitationem necessitatibus accusamus optio nesciunt! Nisi.</p> --}}
                                    </x-timeline>
                                    <x-timeline iconColor="timeline-point-danger" icon="cpu">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Babak Semifinal</h6>
                                            <span class="timeline-event-time">29 JAN 2022</span>
                                        </div>
                                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga exercitationem necessitatibus accusamus optio nesciunt! Nisi.</p> --}}
                                    </x-timeline>
                                    <x-timeline iconColor="timeline-point-success" icon="codepen">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Babak Final</h6>
                                            <span class="timeline-event-time">30 JAN 2022</span>
                                        </div>
                                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga exercitationem necessitatibus accusamus optio nesciunt! Nisi.</p> --}}
                                    </x-timeline>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- / TIMELINE ILPC 2022 --}}

            </div>
        </div>

    </div>

</div>
</div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('vuexy') }}/app-assets/js/scripts/maps/map-leaflet.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script>
    var textWrapper = document.querySelector('.ml6 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
        anime.timeline({
                loop: true
            })
            .add({
                targets: '.ml6 .letter',
                translateY: ["1.1em", 0],
                translateZ: 0,
                duration: 1000,
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, -0.1],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [-0.1, 0],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, 0],
                duration: 2000,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, -0.1],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [-0.1, 0],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, 0],
                duration: 2000,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, "1.1em"],
                translateZ: 0,
                duration: 1000,
                delay: (el, i) => 50 * i
            });
</script>
<script>
    AOS.init();
</script>


<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 80,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 80,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
</script>
@endsection

@section('css')
<style>
    body {
        overflow-x: hidden;
    }

    #particles-js canvas {
        background: #0a1014;
        position: absolute;
        z-index: -10;
        top: 0;
        left: 0
    }

    .ml6 {
        position: relative;
        font-weight: 900;
        font-size: 3.3em;
    }

    .ml6 .text-wrapper {
        position: relative;
        display: inline-block;
        padding-top: 0.2em;
        padding-right: 0.05em;
        padding-bottom: 0.1em;
        overflow: hidden;
    }

    .ml6 .letter {
        display: inline-block;
        line-height: 1em;
    }

    .vh-home {
        padding: 100px 0px 100px 0px;
    }

    @media(max-width: 750px) {
        .vh-home {
            padding: 20px 0px 20px 0px;
        }
    }
</style>
@endsection
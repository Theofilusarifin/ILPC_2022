@extends('visitor.layouts.app', ["pageTitle" => "Gallery"])
@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <!-- search header -->
                <section id="faq-search-filter d-flex justify-content-center align-items-center" style="">
                    <div class="card faq-search" style="background-image: url('{{ asset('ilpc2022') }}/home/c1.jpg')">
                        <div class="card-body text-center">
                            <!-- main title -->
                            <h1 class="ml6 mt-2">
                                <span class="text-wrapper">
                                    <span class="letters text-primary" style="text-shadow: 0 0 20px #7367f0;">Gallery</span>
                                </span>
                            </h1>

                            <!-- subtitle -->
                            <p class="card-text mb-2 text-white">Our Past Event Documentations</p>
                        </div>
                    </div>
                </section>
                <!-- /search header -->

                {{-- Foto Gallery --}}

                <section>
                    <div class="row" id="galleryImage">

                        {{-- Col 1 --}}
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img src="{{ asset('/ilpc2022') }}/gallery/img1.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img2.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img3.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img4.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img5.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img6.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                alt="Foto Gallery" onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img14.jpg" class="w-100 shadow-1-strong rounded" alt="Foto Gallery" onclick="showFoto(this.src)" />
                        </div>

                        {{-- Col 2 --}}
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img src="{{ asset('/ilpc2022') }}/gallery/img21.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img8.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img9.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img10.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img11.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img12.jpg" class="w-100 shadow-1-strong rounded"
                                alt="Foto Gallery" onclick="showFoto(this.src)" />
                        </div>

                        {{-- Col 3 --}}
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            <img src="{{ asset('/ilpc2022') }}/gallery/img13.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img14.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img15.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img16.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img17.jpg"
                                class="w-100 shadow-1-strong rounded mb-4" alt="Foto Gallery"
                                onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img18.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                alt="Foto Gallery" onclick="showFoto(this.src)" />
                            <img src="{{ asset('/ilpc2022') }}/gallery/img2.jpg" class="w-100 shadow-1-strong rounded" alt="Foto Gallery" onclick="showFoto(this.src)" />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="d-flex justify-content-center align-items-center">
        <div class="modal fade" id="fotoGalleryModal" tabindex="-1" aria-labelledby="fotoGalleryModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <div class="card card-developer-meetup" id="fotoGallery">
                                    {{-- Ambil data modal dari Ajax --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script>
        var textWrapper = document.querySelector('.ml6 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
        anime.timeline({loop: true})
        .add({targets: '.ml6 .letter', translateY: ["1.1em", 0],translateZ: 0,duration: 1000,delay: (el, i) => 50 * i})
        .add({targets: '.ml6 .letter',translateY: [0, -0.1],translateZ: 0,duration: 100,easing: 'linear',delay: (el, i) => 50 * i})
        .add({targets: '.ml6 .letter',translateY: [ -0.1, 0],translateZ: 0,duration: 100,easing: 'linear',delay: (el, i) => 50 * i })
        .add({targets: '.ml6 .letter',translateY: [ 0, 0],duration: 2000,easing: 'linear',delay: (el, i) => 50 * i})
        .add({targets: '.ml6 .letter',translateY: [0, -0.1],translateZ: 0,duration: 100,easing: 'linear',delay: (el, i) => 50 * i})
        .add({targets: '.ml6 .letter',translateY: [ -0.1, 0],translateZ: 0,duration: 100,easing: 'linear',delay: (el, i) => 50 * i})
        .add({targets: '.ml6 .letter',translateY: [ 0, 0],duration: 2000,easing: 'linear',delay: (el, i) => 50 * i})
        .add({targets: '.ml6 .letter',translateY: [0, "1.1em"],translateZ: 0,duration: 1000,delay: (el, i) => 50 * i});
    </script>
    <script>
        function showFoto(_src) {
            // Modal ditampilkan
            $('#fotoGalleryModal').modal("show");

            // Masukkan foto bukti foto gallery
            $("div#fotoGallery").html(`<img class="img-fluid rounded" role="button" src="` + _src +
                `" alt="Foto bukti pembayaran">`);
        }
    </script>
@endsection

@section('css')
    <style>
        img {
            cursor: pointer;
        }

        .ml6 {
            position: relative;
            font-weight: 900;
            font-size: 3.3em;
            margin: 0;
        }

        .ml6 .text-wrapper {
            position: relative;
            display: inline-block;
            padding-right: 0.05em;
            overflow: hidden;
        }

        .ml6 .letter {
            display: inline-block;
            line-height: 1em;
        }

    </style>
@endsection

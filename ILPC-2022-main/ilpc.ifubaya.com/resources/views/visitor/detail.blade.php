@extends('visitor.layouts.app')

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
                                    <span class="letters text-primary" style="text-shadow: 0 0 20px #7367f0;">Detail</span>
                                </span>
                            </h1>

                            <!-- subtitle -->
                            <p class="card-text mb-2 text-white">Detail Lomba ILPC 2022</p>

                        </div>
                    </div>
                </section>
                <!-- /search header -->

                <div class="row row-cols-1 row-cols-md-3 mb-2">
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top img-fluid" src="{{ asset('ilpc2022') }}/gallery/penyisihan.JPG" alt="penyisihan" style="max-height:260px">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Penyisihan</h4>
                                <p class="card-text" style="text-align:justify; text-justify:inter-word">
                                    Seluruh tim yang mendaftar pada ILPC 2022 wajib mengikuti Penyisihan Online. Babak penyisihan dilakukan secara online dengan login ke website ini. Babak ini terbagi menjadi 2 sesi: 
                                    <br><br>
                                    sesi pertama (1) tim mengerjakan soal logika, sedangkan pada hari sesi (2) tim mengerjakan soal pemrograman. Tiap tim wajib mengikuti kedua sesi tersebut.
                                    <br><br>
                                    {{-- *Teknis penyisihan online dapat dilihat pada <a href="#"><b>link ini</b></a> --}}
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('ilpc2022') }}/gallery/semifinal.jpg" alt="semifinal" style="max-height:260px"> 
                            <div class="card-body">
                                <h4 class="card-title text-primary">Semifinal</h4>
                                <p class="card-text" style="text-align:justify; text-justify:inter-word">Babak semifinal ILPC 2022 akan diselenggarakan dalam bentuk Rally Games dan Game Besar yang akan diikuti oleh tiap tim, serta mengerjakan soal logika maupun pemrograman melalui Zoom dan menggunakan website ILPC 2022.

                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('ilpc2022') }}/gallery/final.JPG" alt="final" style="max-height:260px">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Final</h4>
                                <p class="card-text" style="text-align:justify; text-justify:inter-word">
                                    Setiap tim yang berhasil masuk ke babak final akan menyelesaikan soal logika dan pemrograman secara berkelompok. Babak final dilakukan secara online melalui Zoom dan menggunakan website ILPC 2022.
                                </p>
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
@endsection

@section('css')
<style>
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

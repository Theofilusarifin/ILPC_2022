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
                                    <span class="letters text-primary" style="text-shadow: 0 0 20px #7367f0;">Contact</span>
                                </span>
                            </h1>

                            <!-- subtitle -->
                            <p class="card-text mb-2 text-white">Detail Lomba ILPC 2022</p>

                        </div>
                    </div>
                </section>
                <!-- /search header -->

                <div class="row pricing-card">
                    <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
                        <div class="row">
                            <!-- basic plan -->
                            <div class="col-12 col-md-6">
                                <div class="card basic-pricing text-center" style="height:500px">
                                    <div class="card-body">
                                        <img src="{{ asset('ilpc2022') }}/undraw/contact.svg" class="mb-2 mt-2"
                                            alt="svg img" style="max-height:150px; width:100%">
                                        <h3>Contact Person</h3>
                                        <br>
                                        <h5>Whatsapp</h5>
                                        <a href="https://wa.me/6289620102020" target="_blank" rel="noopener">
                                            <p class="card-text">Sean Alessandro (089620102020)</p>
                                        </a>
                                        <a href="https://wa.me/6281231599922" target="_blank" rel="noopener">
                                            <p class="card-text">Brian Owen (081231599922)</p>
                                        </a>
                                        <h5>Line OA</h5>
                                        <p class="card-text">@QIX0011E</p>
                                        <h5>Email</h5>
                                        <p class="card-text">ilpc.ubaya@gmail.com</p>
                                        {{-- <span class="text-body">We are always happy to help!</span> --}}
                                    </div>
                                </div>
                            </div>
                            <!--/ basic plan -->


                            <!-- enterprise plan -->
                            <div class="col-12 col-md-6" >
                                <div class="card enterprise-pricing text-center" style="height:500px">
                                    <div class="card-body">
                                        <img src="{{ asset('ilpc2022') }}/undraw/email.svg" class="mb-2 mt-2"
                                            alt="svg img" style="max-height:150px; width:100%">
                                        <h3>Media Social</h3>
                                        <br>
                                        <h5><i data-feather="instagram"></i>&nbsp;Instagram</h5>
                                        <p class="card-text"><a
                                                href="https://www.instagram.com/ilpc_ubaya/?hl=en" target="_blank" rel="noopener">&nbsp; ilpc_ubaya</a></p>
                                                <h5><i data-feather="facebook"></i>&nbsp;Facebook</h5>
                                                <p class="card-text"><a
                                                  href="https://www.facebook.com/ilpcubaya.page/" target="_blank" rel="noopener">&nbsp; ilpc_ubaya</a></p>
                                                
                                    </div>
                                </div>
                            </div>
                            <!--/ enterprise plan -->

                            
                        </div>
                    </div>
                </div>

                {{-- Map Ubaya --}}
                <div class="row">
                    <div class="col-lg-12">
                      <div class="card mb-4">
                        <div class="card-header">
                          <h4 class="card-title">Lokasi Universitas Surabaya</h4>
                        </div>
                        <div class="row peta-ubaya">
                              {{-- <h1 class="text-center title-shadow" style="color: #07051c">Lokasi Universitas Surabaya</h1> --}}
                              <iframe class="map-box" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1663.8375504123223!2d112.76730277048476!3d-7.320733414711787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTknMTUuMSJTIDExMsKwNDYnMDIuOSJF!5e0!3m2!1sen!2sid!4v1475753468457" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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


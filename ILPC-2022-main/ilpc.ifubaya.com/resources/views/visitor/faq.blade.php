@extends('visitor.layouts.app')
@php
    $faqs = array(
    ['question' => 'Apa itu ILPC?',
        'answer' => 'ILPC adalah kompetisi logika dan pemrograman yang diselenggarakan setiap tahun oleh jurusan Teknik Informatika Universitas Surabaya yang diikuti oleh siswa-siswi sma/smk sederajat di seluruh Indonesia'],

    ['question' => 'Kapan acara ILPC diselenggarakan?',
        'answer' => 'Babak penyisihan : 20-21 Januari 2022.<br>
        Technical Meeting : 27 Januari 2022.<br>
        Babak semifinal : 29 Januari 2022.<br>
        Babak final : 30 Januari 2022.<br>
        Keterangan lebih lengkap, silahkan dilihat di <a href="/home">link ini</a>.'],

    ['question'=>'ILPC sudah diadakan berapa kali?',
        'answer'=>'Sudah 15 kali kali dalam 15 tahun terakhir, ini tahun ke - 16'],


    ['question'=>'Seperti apakah soal-soal yang ada di kompetisi ini?' ,
    'answer' => 'Untuk babak penyisihan, soal logika pilihan ganda dan beberapa soal pemrograman.<br>
    Untuk babak semifinal, lomba dalam bentuk rally berupa game logika maupun pemrograman.<br>
    Untuk babak final, soal – soal lomba berisi soal logika dan pemrograman.'],

    ['question'=>'Apa bahasa pemrograman yang digunakan dalam kompetisi ini?' , 
    'answer'=>'Bahasa pemrograman yang digunakan adalah C++, Java, dan Pascal.'],

    ['question'=>'Kira-kira berapa lama durasi acara berlangsung?' , 
    'answer'=>'Penyisihan = siang - sore.<br>
    Technical Meeting = siang - sore.<br>
    Semifinal dan Final = pagi - sore.'],

    ['question'=>'Berapakah anggota tiap kelompok?' , 
    'answer'=>'1 kelompok terdiri dari  3 orang dan 1 cadangan, cadangan bersifat opsional'],

    ['question'=>'Satu tim boleh campur dari beda angkatan ya?' , 
    'answer'=>' Boleh beda angkatan asalkan dari sekolah yang sama tiap timnya dan merupakan siswa yang masih aktif.'],

    ['question'=>'Apakah tema dari ILPC tahun ini?' ,
    'answer'=>'Tema ILPC 2022 adalah <i>Artificial Iintelligence</i>: <i>The Future Is Now!.</i>'],

    ['question'=>'Apakah diperbolehkan mengganti rekan 1 tim jika mendadak tidak bisa mengikuti ILPC 2022?' ,
    'answer'=>'tidak bisa, hanya rekan yang terdaftar yang bisa mengikuti ILPC 2022'],

    ['question'=>'Berapa kelompok yang akan dipilih untuk maju ke babak semifinal?' , 
    'answer'=>'40 kelompok.'],

    ['question'=>'Berapa kelompok yang akan dipilih untuk maju ke babak final?' , 
    'answer'=>'15 kelompok.'],

    ['question'=>'Berapa biaya pendaftaran untuk tiap timnya?' , 
    'answer'=>'Rp.60.000/tim. Jika mendaftar 4 tim/lebih dari satu sekolah mendapatkan harga spesial Rp.45.000/tim.'],

    ['question'=>'Apakah pendaftaran harus menggunakan kartu pelajar? ' ,
    'answer'=>'Jika tidak memiliki kartu pelajar bisa mendaftar menggunakan surat keterangan aktif dari sekolah.'],

    ['question'=>'Apa itu surat keterangan aktif?' , 
    'answer'=>'Surat yang menyatakan bahwa peserta tersebut merupakan siswa/siswi berstatus aktif di sekolah tersebut, disertai tanda tangan kepala sekolah.'],

    ['question'=>'Apakah ILPC dapat diikuti oleh siswa/siswi kelas 12?' , 
    'answer'=>'Boleh, ILPC dapat diikuti semua siswa/siswi sma/smk sederajat selama berstatus aktif sebagai siswa pada saat ILPC 2022 berlangsung.'],

    ['question'=>'Dimana kami bisa mendaftar untuk ikut lomba ILPC 2022?' ,
    'answer'=>'ilpc.ifubaya.com'],

    ['question'=>'Dimana informasi tentang ILPC 2022 bisa dilihat?' ,
    'answer'=>'Silahkan cek di instagram: <a href="https://www.instagram.com/ilpc_ubaya/?hl=en" target="_blank" rel="noopener"><i data-feather="instagram"></i>&nbsp; ilpc_ubaya</a>'],

    ['question'=>'Untuk bertanya-tanya dan mencari informasi, di mana?' , 
    'answer'=>'Melalui Contact Person kami:<br>
        Sean Alessandro (089620102020)<br>
        Brian Owen (081231599922)<br>
        E-mail: ilpc.ubaya@gmail.com<br>
        Instagram: ILPC_UBAYA<br>
        Facebook: ILPC UBAYA<br>'
        ],  
);

@endphp
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
                                <span class="letters text-primary" style="text-shadow: 0 0 20px #7367f0;">FAQ</span>
                            </span>
                        </h1>

                        <!-- subtitle -->
                        <p class="card-text mb-2 text-white">Frequently Asked Question</p>

                    </div>
                </div>
            </section>
            <!-- /search header -->

            <!-- frequently asked questions tabs pills -->
            <section id="faq-tabs">
                <!-- vertical tab pill -->
                <div class="row d-flex">
                    <div class="col-12">
                        <!-- pill tabs tab content -->
                        <div class="tab-content">
                            <!-- payment panel -->
                            <div role="tabpanel" class="tab-pane active" id="faq-payment" aria-labelledby="payment" aria-expanded="true">

                                <!-- frequent answer and question  collapse  -->
                                <div class="accordion accordion-margin mt-2" id="faq-payment-qna">
                                    @foreach ($faqs as $faq)
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="payment{{$loop->index}}">
                                            <button class="accordion-button collapsed" data-bs-toggle="collapse" role="button" data-bs-target="#faq-payment-{{$loop->index}}" aria-expanded="false" aria-controls="faq-payment-{{$loop->index}}">
                                                <span>
                                                    {!!$faq['question']!!}
                                                </span>
                                            </button>
                                        </h2>

                                        <div id="faq-payment-{{$loop->index}}" class="collapse accordion-collapse" aria-labelledby="payment{{$loop->index}}" data-bs-parent="#faq-payment-{{$loop->index}}">
                                            <div class="accordion-body">
                                                <p style="text-align:justify; text-justify:inter-word">
                                                    {!!$faq['answer']!!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- / frequently asked questions tabs pills -->

            <!-- contact us -->
            <section class="faq-contact">
                <div class="row mt-5 pt-75">
                    <div class="col-12 text-center">
                        <h2>You still have a question?</h2>
                        <p class="mb-3">
                            If you cannot find a question in our FAQ, you can always contact us. We will answer to you shortly!
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center faq-contact-card shadow-none py-1 "  style="height:200px"> 
                            <div class="accordion-body">
                                <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call font-medium-3">
                                        <path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                                <h4>Sean Alessandro (089620102020)</h4>
                                <h4>Brian Owen (081231599922)</h4>
                                <span class="text-body">We are always happy to help!</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card text-center faq-contact-card shadow-none py-1" style="height:200px">
                            <div class="accordion-body">
                                <div class="avatar avatar-tag bg-light-primary mb-2 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail font-medium-3">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                                <h4>ilpc.ubaya@gmail.com</h4>
                                <span class="text-body">Email us for futher information!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ contact us -->

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
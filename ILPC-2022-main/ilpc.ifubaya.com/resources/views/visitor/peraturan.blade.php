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
                                    <span class="letters text-primary" style="text-shadow: 0 0 20px #7367f0;">Peraturan</span>
                                </span>
                            </h1>

                            <!-- subtitle -->
                        <p class="card-text mb-2 text-white">Peraturan yang wajib dipatuhi peserta ILPC 2022</p>
                        </div>
                    </div>
                </section>

                <section id="list-group-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Peraturan peserta ILPC 2022</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Berikut adalah peraturan-peraturan yang wajib ditaati saat lomba berlangsung. 
                                    </p>
                                    <div class="row mt-1">
                                        {{-- Button Controls --}}
                                        <div class="col-md-4 col-sm-12">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                <a class="list-group-item list-group-item-action active" id="list-umum-list" data-bs-toggle="list" href="#list-umum" role="tab" aria-controls="list-umum" aria-selected="true">I. Peraturan Umum</a>
                                                <a class="list-group-item list-group-item-action" id="list-technical-meeting-list" data-bs-toggle="list" href="#list-technical-meeting" role="tab" aria-controls="list-khusus" aria-selected="false">II. Peraturan Technical Meeting</a>
                                                <a class="list-group-item list-group-item-action" id="list-semifinal-list" data-bs-toggle="list" href="#list-semifinal" role="tab" aria-controls="list-semifinal" aria-selected="false">III. Peraturan Semifinal</a>
                                                <a class="list-group-item list-group-item-action" id="list-final-list" data-bs-toggle="list" href="#list-final" role="tab" aria-controls="list-final" aria-selected="false">IV. Peraturan Final</a>
                                            </div>
                                        </div>
                                        {{-- Peraturan Content --}}
                                        <div class="col-md-8 col-sm-12 mt-1">
                                            <div class="tab-content" id="nav-tabContent">

                                                {{-- Peraturan Umum --}}
                                                <div class="tab-pane fade active show" id="list-umum" role="tabpanel" aria-labelledby="list-umum-list">
                                                    <h5 class="card-text mb-2">
                                                        Peraturan-peraturan di bawah ini berlaku saat Technical Meeting, Semifinal, dan Final.
                                                    </h5>

                                                    <p class="card-text">
                                                        1. Peserta <span class="text-danger">tidak diperkenankan</span> untuk melakukan pertemuan tatap muka langsung. Apabila peserta masih melakukan pertemuan tatap muka langsung, segala risiko ditanggung oleh peserta karena hal itu merupakan kehendak peserta sendiri. Panitia tidak bertanggung jawab atas risiko tersebut.
                                                    </p>

                                                    <p class="card-text">
                                                        2. Tidak menggunakan alat komunikasi selama acara berlangsung, kecuali telah mendapatkan izin dari Panitia ILPC.
                                                    </p>

                                                    <p class="card-text">
                                                        3. Wajib menyalakan kamera selama acara berlangsung. Panitia tidak menerima alasan apapun untuk off camera. (Peserta yang tidak memiliki kamera dapat mengunduh DroidCam atau sejenisnya pada smartphone masing-masing).
                                                    </p>

                                                    <p class="card-text">
                                                        4. Peserta wajib mengenakan atasan seragam sekolah dengan bawahan celana panjang bebas dan sopan.
                                                    </p>

                                                    <p class="card-text">
                                                        5. Wajib menggunakan format nama sebagai berikut:
                                                        <br>[Nama Kelompok]_[Nama Depan]
                                                        <br>Contoh: Eagle_Theo
                                                    </p>

                                                    <p class="card-text">
                                                        6. <span class="text-danger">Dilarang</span> menunjukkan senjata tajam, senjata api, dan benda-benda berbahaya lainnya di hadapan kamera.
                                                    </p>

                                                    <p class="card-text">
                                                        7. <span class="text-danger">Dilarang</span> menunjukkan rokok (tradisional dan elektrik) dan/atau NAPZA di hadapan kamera.
                                                    </p>

                                                    <p class="card-text">
                                                        8. <span class="text-danger">Dilarang</span> berbicara kotor dan menyinggung SARA.
                                                    </p>

                                                    <p class="card-text">
                                                        9. <span class="text-danger">Dilarang</span> membuat gaduh selama acara. Peserta wajib mute microphone saat di main-room, kecuali pada saat diskusi di break-out room.
                                                    </p>

                                                    <p class="card-text">
                                                        10. <span class="text-danger">Dilarang</span> berbuat asusila.
                                                    </p>
                                                    
                                                    <p class="card-text">
                                                        11. <span class="text-danger">Dilarang</span> menggunakan Virtual Background selama acara ILPC 2022 berlangsung.
                                                    </p>

                                                    <p class="card-text">
                                                        12. Tidak melakukan tindakan kriminal dan provokasi.
                                                    </p>

                                                    <p class="card-text">
                                                        13. Bersikap sopan terhadap sesama peserta dan panitia serta pihak luar yang terkait dengan ILPC 2022.
                                                    </p>

                                                    <p class="card-text">
                                                        14. <span class="text-danger">Dilarang</span> meninggalkan Zoom Meeting tanpa seizin ketua panitia ILPC 2022* selama acara berlangsung.
                                                    </p>

                                                    <p class="card-text">
                                                        15. Peserta yang keluar dari Zoom Meeting dikarenakan kendala koneksi, diharapkan untuk join kembali dalam durasi 10 menit. Apabila masih terjadi kendala, harap menghubungi Koordinator Divisi Perkam*, disertai dengan bukti kendala, misal: screenshot reconnecting disertai dengan jamnya. Tidak ada bukti maka alasan tidak diterima apapun itu.
                                                    </p>

                                                    <p class="card-text">
                                                        16. Peserta yang hendak meninggalkan posisi (seperti ke toilet, dsb.) harap menghubungi Koordinator Divisi Perkam*. Peserta akan diberikan waktu 10 menit, dengan keadaan kamera menyala, apabila dalam waktu 10 menit belum kembali, maka peserta akan diberikan toleransi 5 menit, dan jika belum datang maka akan didiskualifikasi.
                                                    </p>

                                                    <p class="card-text">
                                                        17. Menjaga ketertiban acara ILPC 2022.
                                                    </p>

                                                    <p class="card-text">
                                                        18. <span class="text-danger">Dilarang</span> menerima tamu, termasuk pendamping ke dalam Zoom Meeting dan berbincang dengan pihak luar selama acara belangsung.
                                                    </p>

                                                    <p class="card-text">
                                                        19. <span class="text-danger">Dilarang</span> mendokumentasikan acara baik dari kelompok maupun pihak yang ikut lomba dalam bentuk apapun.
                                                    </p>

                                                    <p class="card-text mb-2">
                                                        20. Peserta wajib hadir 30 menit sebelum acara dimulai.
                                                    </p>
                                                </div>

                                                {{-- Peraturan Technical Meeting --}}
                                                <div class="tab-pane fade" id="list-technical-meeting" role="tabpanel" aria-labelledby="list-technical-meeting-list">
                                                    {{-- Technical Meeting --}}
                                                    <h5 class="card-text">
                                                        Peraturan-peraturan di bawah ini berlaku saat Technical Meeting
                                                    </h5>

                                                    <p class="card-text">
                                                        1. Wajib menggunakan 1 kamera (webcam atau kamera lain).
                                                    </p>

                                                    <p class="card-text">
                                                        2. Peserta diperbolehkan gabung kedalam Zoom Meeting menggunakan smartphone.
                                                    </p>
                                                </div>

                                                {{-- Peraturan semifinal --}}
                                                <div class="tab-pane fade" id="list-semifinal" role="tabpanel" aria-labelledby="list-semifinal-list">
                                                    {{-- Semifinal --}}
                                                    <h5 class="card-text">
                                                        Peraturan-peraturan di bawah ini berlaku saat Semifinal.
                                                    </h5>

                                                    <p class="card-text">
                                                        1. Wajib menggunakan 1 kamera (Terdapat tambahan 1 kamera pada Pos Programming dan Logika).
                                                    </p>

                                                    <p class="card-text">
                                                        2. Peserta wajib menggunakan laptop saat gabung kedalam Zoom Meeting
                                                    </p>

                                                    <p class="card-text">
                                                        3. Wajib share screen saat pos logika & pemrograman.
                                                    </p>

                                                    <p class="card-text">
                                                        4. Masing-masing peserta hanya diperbolehkan menggunakan total 3 lembar kertas kosongan ukuran A4 dalam 1 tim.
                                                    </p>

                                                    <p class="card-text">
                                                        5. <span class="text-danger">Dilarang</span> menggunakan notes, kalkulator dan/atau alat bantu hitung lainnya.
                                                    </p>

                                                    <p class="card-text">
                                                        6. <span class="text-danger">Dilarang</span> mencari jawaban menggunakan web-browser dan/atau sumber lainnya.
                                                    </p>

                                                    <p class="card-text">
                                                        7. <span class="text-danger">Dilarang</span> bekerja sama dalam bentuk apapun antar tim.
                                                    </p>
                                                </div>

                                                {{-- Peraturan Final --}}
                                                <div class="tab-pane fade" id="list-final" role="tabpanel" aria-labelledby="list-final-list">
                                                    {{-- Final --}}
                                                    <h5 class="card-text">
                                                        Peraturan-peraturan di bawah ini berlaku saat Final.
                                                    </h5>

                                                    <p class="card-text">
                                                        1. Wajib menggunakan 2 kamera (untuk kamera kedua disarankan menggunakan smartphone).
                                                    </p>

                                                    <p class="card-text">
                                                        2. Wajib share screen selama final berlangsung.
                                                    </p>

                                                    <p class="card-text">
                                                        3. <span class="text-danger">Dilarang</span> meninggalkan posisi selama final berlangsung.
                                                    </p>

                                                    <p class="card-text">
                                                        4. Masing-masing peserta hanya diperbolehkan menggunakan total 10 lembar kertas kosongan ukuran A4 dalam 1 tim.
                                                    </p>

                                                    <p class="card-text">
                                                        5. Setiap tim diperbolehkan untuk membawa cheat sheet ukuran A4, sebanyak 4 lembar (kedua sisi boleh digunakan)
                                                    </p>

                                                    <p class="card-text">
                                                        6. <span class="text-danger">Dilarang</span> menggunakan notes, kalkulator dan/atau alat bantu hitung lainnya.
                                                    </p>

                                                    <p class="card-text">
                                                        7. <span class="text-danger">Dilarang</span> mencari jawaban menggunakan web-browser dan/atau sumber lainnya
                                                    </p>

                                                    <p class="card-text">
                                                        8. <span class="text-danger">Dilarang</span> bekerja sama dalam bentuk apapun antar tim.
                                                    </p>

                                                    <p class="card-text">
                                                        9. Peserta hanya diperbolehkan izin ke toilet saat sebelum sesi final dimulai dan setelah sesi final selesai.
                                                    </p>

                                                    <p class="card-text">
                                                        10. Peserta diharapkan untuk mengunduh/meng-update Zoom Meeting ke versi terbaru
                                                    </p>

                                                    <p class="card-text">
                                                        11. Peserta diharapkan mengunduh camscanner atau sejenisnya agar dapat digunakan untuk scan jawaban pada kertas.
                                                    </p>

                                                    <p class="card-text">
                                                        12. Pendamping peserta dapat menghubungi ketua panitia ILPC 2022* untuk menanyakan progress peserta yang bersangkutan.
                                                    </p>

                                                    <p class="card-text">
                                                        13. Setiap <span class="text-danger">pelanggaran</span> atas peraturan di atas akan diberikan <span class="text-danger">sanksi</span> sesuai dengan kebijakan panitia.
                                                    </p>

                                                    <p class="card-text">
                                                        14. Hal-hal yang tidak tertera dapat ditambahkan sewaktu-waktu bila diperlukan.
                                                    </p>

                                                    <p class="card-text mb-2">
                                                        15. Keputusan panitia bersifat <span class="text-danger">MUTLAK</span> dan <span class="text-danger">TIDAK DAPAT DIGANGGU GUGAT</span>.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
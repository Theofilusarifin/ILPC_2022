@extends('pemain.layouts.app', ['pageActive' => 'pemain.index', 'pageTitle' => 'Team Dashboard'])

@section('content')
<style>
    th,
    td {
        padding: 7px;
    }
</style>

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            {{-- Dashboard Pemain --}}
            <section id="dashboard-analytics">
                <div class="row match-height">
                    {{-- Welcome --}}
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">
                                <img src="{{ ('vuexy') }}/app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                                <img src="{{ ('vuexy') }}/app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content" style="cursor:default">
                                        <i data-feather="award" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">Selamat Datang di ILPC 2022</h1>
                                    <p class="card-text m-auto w-75">
                                        Semoga beruntung
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Welcome --}}
                </div>

                {{-- Congrats / Sorry --}}
                {{-- @php
                $team_lolos_penyisihan = array(1,9,32,19,73,21,27,54,11,49,50,58,71,15,66,75,25,57,22,20,56,6,62,12,72,17,13,59,14,16,74,52,53,70,24,51,63,55,26,68,60);
                $team_tidak_lolos_penyisihan = array(65,10,76,61,67,69,8,31,28,30,29);
                @endphp
                @if(in_array(Auth::user()->team->id, $team_lolos_penyisihan))
                <div class="card card-congratulation-medal">
                    <div class="card-body text-center">
                        <div class="mt-1 mb-1">
                            <h1>Congratulations, {{ auth()->user()->team->nama }} 🎉!</h1>
                            <br>
                            <p class="card-text">Selamat Team anda lolos ke babak Semifinal. Sampai Jumpa di Technical Meeting ILPC 2022!</p>
                        </div>
                        <img src="{{ ('vuexy') }}/app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic">
                    </div>
                </div>
                @elseif(in_array(Auth::user()->team->id, $team_tidak_lolos_penyisihan))
                <div class="card card-congratulation-medal">
                    <div class="card-body text-center">
                        <div class="mt-1 mb-1">
                            <h1>Mohon maaf, {{ auth()->user()->team->nama }} 😢 </h1>
                            <br>
                            <p class="card-text">Team anda tidak lolos ke babak Semifinal. Tetap berjuang dan semangat selalu. Sampai jumpa pada kesempatan lainnya!🙌 </p>
                        </div>
                    </div>
                </div>
                @endif --}}

                <div class="row match-height">
                    <!-- Data Ketua, Anggota 1, dan Anggota 2, Cadangan -->
                    <div class="col-lg-5 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-50">
                                    <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                        <div class="mb-1 mb-sm-0">
                                            <h3 class="fw-bolder mb-1">Data Team</h3>
                                            {{-- Nama team dari database --}}
                                            <p class="card-text">
                                                Nama Team: {{ $team->nama }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row avg-sessions pt-50">
                                    <div>
                                        {{-- Nama dan Status dari database --}}
                                        @foreach($participants as $participant)
                                        <p class="mb-75"><strong>{{ str_replace("_", " ", ucfirst($participant->status)) }}</strong></p>
                                        <div class="d-flex flex-row">
                                            <i data-feather='user' class="me-1 font-large-2"></i>
                                            <div class="my-auto row">
                                                <h5>{{ $participant->nama }}</h5>
                                                <p>{{ $participant->kelas }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Ketua, Anggota 1, dan Anggota 2, Cadangan --}}

                    {{-- Data Sekolah dan Guru --}}
                    <div class="col-lg-7 col-12">
                        {{-- Data Sekolah --}}
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h3 class="fw-bolder">Data Sekolah</h3>
                            </div>
                            <hr>
                            <div class="card-body pt-0">
                                <table style="border: none">
                                    {{-- Nama dan Alamat dari database --}}
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $school->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{ $school->alamat }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- <p>Nama</p>
                                <p>Alamat</p> --}}
                            </div>
                        </div>
                        {{-- End Data Sekolah --}}

                        {{-- Data Guru --}}
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h3 class="fw-bolder">Data Guru</h3>
                            </div>
                            <hr>
                            <div class="card-body pt-0">
                                <table style="border: none">
                                    {{-- Nama dan Alamat dari database --}}
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td> {{ $teacher->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon </td>
                                        <td>:</td>
                                        <td> {{ $teacher->telp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email </td>
                                        <td>:</td>
                                        <td>{{ $teacher->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat </td>
                                        <td>:</td>
                                        <td>{{ $teacher->alamat }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Data Guru --}}
                    </div>
                </div>
                {{-- End Data Sekolah dan Guru --}}

                <div class="row match-height">
                    {{--Timeline Card --}}
                    <div class="col-lg-5 col-md-6 col-12" data-aos="fade-up">
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
                    {{-- End Of Timeline Card --}}

                    {{--Pengumuman --}}
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="card card-app-design">
                            <div class="card-body">
                                <h4 class="card-title mb-75 pt-25 fw-bolder">Instruksi Penggunaan</h4>
                                <span class="badge badge-light-primary">1 November 2021</span>
                                <hr>
                                <div class="design-group mb-2 pt-50">
                                    <h6>Akun</h6>
                                    <p>Setiap akun hanya bisa login di satu komputer. Apabila login di lebih dari satu komputer, maka akun yang login pertama akan otomatis logout.</p>
                                </div>
                                <hr>
                                <div class="design-group mb-2 pt-50">
                                    <h6>Platform</h6>
                                    <p>
                                        Peserta diharapkan untuk tidak melakukan pertemuan tatap muka langsung. Jika ingin berkumpul, dapat menggunakan fitur share screen Google Meet/Zoom/aplikasi lainnya untuk mengerjakan soal. Apabila peserta masih melakukan pertemuan tatap muka langsung, segala risiko ditanggung oleh peserta karena hal itu merupakan kehendak peserta sendiri. Panitia TIDAK bertanggung jawab atas risiko tersebut.
                                    </p>
                                </div>
                                <hr>
                                <div class="design-group mb-1 pt-50">
                                    <h6>Browser</h6>
                                    <p>
                                        Disarankan menggunakan web browser Chrome dan TIDAK disarankan menggunakan web browser Safari dalam penggunaan web ini.
                                    </p>
                                    <div class="d-flex">
                                        <img src="{{ ('vuexy') }}/app-assets/images/icons/google-chrome.png" class="rounded me-1" height="30" alt="Google Chrome">
                                        <h6 class="align-self-center mb-0">Google Chrome</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--End Of Pengumuman --}}
                </div>
            </section>
            {{-- End Dashboard Pemain --}}
        </div>
    </div>
</div>
@endsection

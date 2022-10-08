@extends('pemain.pembayaran.layouts.app', ['pageActive' => 'pemain.index', 'pageTitle' => 'Pemain Dashboard'])

@section('content')
<style>
    li {
        padding-bottom: 10px;
    }
    .step-trigger {
        cursor: default!important;
    }
</style>

<section class="horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
        {{-- Header - 3 Step --}}
        <div class="bs-stepper-header" role="tablist">
            {{-- Step 1 --}}
            <div class="step active" data-target="#account-details" role="tab" id="account-details-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Upload</span>
                        <span class="bs-stepper-subtitle">Mengupload Bukti Pembayaran</span>
                    </span>
                </button>
            </div>
            {{-- Garis Penghubung --}}
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            {{-- Step 2 --}}
            <div class="step active" data-target="#personal-info" role="tab" id="personal-info-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Proses Verifikasi</span>
                        <span class="bs-stepper-subtitle">Bukti Pembayaran Sedang Diverifikasi</span>
                    </span>
                </button>
            </div>
            {{-- Garis Penghubung --}}
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            {{-- Step 3 --}}
            <div class="step" data-target="#address-step" role="tab" id="address-step-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Selesai</span>
                        <span class="bs-stepper-subtitle">Team Resmi Terdaftar</span>
                    </span>
                </button>
            </div>
        </div>
        {{-- End Header - 3 Step --}}

        <div class="bs-stepper-content">
            {{-- Isi step 2 (isi dikomen) --}}
            <div id="personal-info" class="content active dstepper-block" role="tabpanel" aria-labelledby="personal-info-trigger">
                <div class="content-header">
                    <h4 class="mb-0 fw-bold">Data Anda Sedang Kami Verifikasi</h4>
                    <hr>
                    
                    <div class="col-12">
                        <div class="card card-developer-meetup">
                            <div class="meetup-img-wrapper rounded-top text-center">
                                <img src="{{ asset("vuexy") }}/app-assets/images/illustration/email.svg" alt="Meeting Pic" height="170">
                            </div>
                            <div class="card-body">
                                <div class="meetup-header d-flex align-items-center">
                                    <div class="meetup-day">
                                        <h6 class="mb-0">ILPC</h6>
                                        <h3 class="mb-0">2022</h3>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="card-title mb-25">Harap Menunggu Proses Verifikasi Data</h4>
                                        <p class="card-text mb-0">Apabila terjadi kesalahan, dapat menghubungi : Brian Owen (081231599922)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    var loadFile = function(image_id, event) {
        var image = document.getElementById(image_id);
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
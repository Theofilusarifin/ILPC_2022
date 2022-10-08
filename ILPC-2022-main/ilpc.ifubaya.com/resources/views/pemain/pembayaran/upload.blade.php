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
            {{-- Garis Pengubung --}}
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            {{-- Step 2 --}}
            <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Proses Verifikasi</span>
                        <span class="bs-stepper-subtitle">Bukti Pembayaran Sedang Diverifikasi</span>
                    </span>
                </button>
            </div>
            {{-- Garis Pengubung --}}
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
            {{-- Step 1 --}}
            <div id="account-details" class="content active dstepper-block" role="tabpanel" aria-labelledby="account-details-trigger">
                <div class="content-header">
                    <h4 class="mb-0 fw-bold">Petunjuk Pembayaran</h4>
                    <hr>
                    <p><b class="text-danger">Transfer melalui rekening BCA: 088 176 3957 a/n Reynard Halim</b></p>
                    <p>Biaya Pendaftaran: Rp60.000/team</p>
                    <p>Dapatkan biaya pendaftaran HANYA Rp45.000,00/tim, apabila 1 sekolah yang sama mendaftarkan minimal 4 tim.</p>
                    <hr>
                    <p><strong>Ketentuan Transfer</strong></p>
                    <p>[Bagi sekolah yang mendaftarkan 4 atau lebih team]</p>
                    <ul>
                        <li>Wajib transfer menggunakan 1 rekening yang sama dalam 1x transfer dan mencantumkan nama tiap tim dan asal sekolah di keterangan transfer.</li>
                        <li>Total biaya pendaftaran: Rp45.000,00 x jumlah tim</li>
                        <li>Setelah mengupload bukti transfer harap mengkonfirmasi ke contact person yang tertera 
                            <ol class="mt-50">
                                <li>Whatsapp</li>
                                <li>Line</li>
                                <li>Instagram</li>
                            </ol>
                        </li>
                    </ul>
                </div>
                <hr>
                <form method="POST" action="{{ route('pemain.upload.payment') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row d-flex">
                        <div class="col-4">
                            <label for="pembayaran" class="form-label">Foto Bukti Pembayaran (max: 10mb, type: png/jpeg/jpg)</label>
                            <input type="file" accept="image/jpeg, image/png" id="foto_upload_pembayaran" name="foto_upload_pembayaran"
                                style="display: none;" onchange="loadFile('foto_pembayaran', event)">
                            <label for="foto_upload_pembayaran" class="btn btn-outline-primary mb-1 waves-effect dz-clickable"
                                style="cursor: pointer; width: 100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg> Foto/Scan Bukti Pembayaran
                            </label>
                            @error("foto_upload_pembayaran")
                            <p class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </p>
                            @enderror
                            <p class="py-0 my-0"><img id="foto_pembayaran" width="100%" /></p>
                        </div>

                        <div class="col-8 mt-2 d-flex" style="align-items:flex-end; justify-content:flex-end;">
                            <div class="modal-size-default d-inline-block">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal"
                                    data-bs-target="#defaultSize">
                                    Next
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-start" id="defaultSize" tabindex="-1" aria-labelledby="myModalLabel18"
                                    style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel18">Validasi Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah bukti pembayaran yang anda masukkan sudah benar? 
                                                <small class="text-danger">Data yang telah diinput, tidak dapat diganti</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light"
                                                    data-bs-dismiss="modal">Ya</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
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
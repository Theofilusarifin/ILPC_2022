@extends('auth.layouts.app')

@section('style')
<style>
    img{
        margin-bottom: 15px;
    }
</style>
@endsection

@section('content')
<a href="{{ route('register') }}" class="brand-logo">
    <h2 class="brand-text text-primary ms-1">REGISTRATION</h2>
</a>

<h4 class="card-title mb-1">Petualangan ILPC Mulai Disini! 🚀</h4>
<p class="card-text mb-2">Daftarkan Team Anda Disini!</p>


<div class="divider my-2 mt-4">
    <div class="divider-text">Catatan Pendaftaran</div>
</div>

<ol class="text-secondary">
    <small>
        <li>Pilih sekolah di kabupaten anda.</li>
    </small>
    <small>
        <li>Apabila kabupaten/sekolah/guru anda tidak tertera pada form. Mohon kontak panitia kami.</li>
    </small>
    <small>
        <li>Email ketua digunakan untuk recover account.</li>
    </small>
    <small>
        <li>Anggota cadangan adalah opsional.</li>
    </small>
</ol>

<form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    {{-- |============| SEKOLAH REGISTRATION |============| --}}

    <div class="divider my-2 mt-4">
        <div class="divider-text">Data Sekolah</div>
    </div>

    <div class="mb-4">
        <div class="mb-1" data-select2-id="46">
            <label class="form-label" for="select2-basic">Kabupaten/Kota</label>
            <select class="select2 form-select" tabindex="-1" aria-hidden="true" id="regency_id" onchange="getSchool()">
                <option selected disabled>-- Pilih Kabupaten --</option>
                @foreach ($regencies as $regency)
                <option value="{{ $regency->id }}" data-select2-id="{{ $regency->id }}">
                    {{ $regency->nama }}</option>
                @endforeach
            </select>
        </div>

        <div id="school_container">
            <div class="mb-1">
                <label class="form-label" for="large-select">Sekolah</label>
                <select class="select2 form-select" id="school_id" onchange="getTeacher()" disabled>
                </select>
            </div>
        </div>

        <div id="teacher_container">
            <div class="mb-1">
                <label class="form-label" for="large-select">Guru</label>
                <select class="select2 form-select" id="teacher_id" name="teacher_id" disabled>
                </select>
            </div>
        </div>


        @error('teacher_id')
        <span class="text-danger" role="alert">
            <small>the guru field is required</small>
        </span>
        @enderror
    </div>

    {{-- |============| END OF SEKOLAH REGISTRATION |============| --}}


    {{-- |============| TEAM REGISTRATION |============| --}}

    <div class="divider my-2 mt-4">
        <div class="divider-text">Data Team</div>
    </div>

    {{-- NAMA TEAM --}}
    <div class="mb-1">
        <label for="team_nama" class="form-label">Nama Team (min. 4, max. 12)</label>
        <input type="text" class="form-control @error('team_nama') is-invalid @enderror" name="team_nama" value="{{ old('team_nama') }}" id="team_nama" placeholder="Nama Team" aria-describedby="team_nama" tabindex="1" autofocus />
        @error('team_nama')
        <span class="text-danger" role="alert">
            <small>{{ $message }}</small>
        </span>
        @enderror
    </div>

    {{-- USERNAME --}}
    <div class="mb-1">
        <label for="username" class="form-label">Username (min. 4, max.8)</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" id="username" placeholder="Username" aria-describedby="username" tabindex="1" autofocus />
        @error('username')
        <span class="text-danger" role="alert">
            <small>{{ $message }}</small>
        </span>
        @enderror
    </div>

    {{-- PASSWORD --}}
    <div class="mb-1">
        <label for="password" class="form-label">Password (min. 8)</label>
        <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" tabindex="2" />
            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
        </div>
        @error('password')
        <span class="text-danger" role="alert">
            <small>{{ $message }}</small>
        </span>
        @enderror
    </div>

    {{-- COMFIRM PASSWORD --}}
    <div class="mb-5">
        <label for="password-confirm" class="form-label">Confirm Password</label>
        <div class="input-group input-group-merge form-password-toggle">
            <input type="password" class="form-control form-control-merge" id="password-confirm" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password-confirm" tabindex="3" required autocomplete="new-password" />
            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
        </div>
    </div>

    {{-- |============| END OF TEAM REGISTRATION |============| --}}


    {{-- |============| ANGGOTA REGISTRATION |============| --}}
    @include('auth.register-components.ketua', ["status"=>"ketua"])
    @include('auth.register-components.ketua', ["status"=>"anggota_1"])
    @include('auth.register-components.ketua', ["status"=>"anggota_2"])
    {{-- |============| END OF ANGGOTA REGISTRATION |============| --}}

    <div id="buttonCadangan">
        <button type="button" class="btn btn-outline-primary waves-effect w-100" data-bs-toggle="popover" data-bs-content="Data cadangan digunakan untuk verifikasi anggota pengganti apabila dibutuhkan" data-bs-trigger="hover" title="" data-bs-original-title="Penjelasan" onclick="showCadanganForm()">
            Tambah Data Peserta Cadangan (Opsional)
        </button>
    </div>

    <div class="{{ old('cadangan_status') == " yes" ? "" : "d-none" }}" id="formCadangan">
        <input type="hidden" id="cadangan_status" name="cadangan_status" value="no">
        @include('auth.register-components.ketua', ["status"=>"cadangan"])
        <button type="button" class="btn btn-outline-danger waves-effect w-100" onclick="hideCadanganForm()">Batalkan
            Data Cadangan</button>
    </div>
    
    {{-- Captcha --}}
    {!! NoCaptcha::renderJs() !!}
    <div class="form-check">
        <div class="my-2">
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
            <small class="text-danger">
                {{ $errors->first('g-recaptcha-response') }}
            </small>
            @endif
        </div>
    </div>
    {{-- End Of Captcha --}}

    <button type="button" data-bs-toggle="modal" onclick="fillConfirmation()" data-bs-target="#confirmationModal" class="btn btn-primary w-100" tabindex="5">Next</button>


    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="readmoreModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <h4 class="modal-title">Konfirmasi Data</h4><br>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah data anda sudah benar?</p>
                    <small>Pastikan data yang anda masukan sebelumnya sudah benar.
                        <br><span class="text-primary">Silahkan periksa kembali 😊.
                            <br><br><span class="text-danger">Data yang telah diinput tidak dapat diubah</span></small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="if(!confirm('Anda akan teregistrasi menjadi ILO Crew ILPC 2022')) return false;">Register</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- MODAL READ MORE --}}
{{-- END OF MODAL READ MORE --}}


<p class="text-center mt-2">
    <span>Sudah punya akun?</span>
    <a href="{{ route("login") }}">
        <span>Lakukan login disini</span>
    </a>
</p>
@endsection

@section('javascript')
<script>
    var loadFile = function(image_id, event) {
        var image = document.getElementById(image_id);
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    function fillConfirmation()
    {

    }



    function getSchool() {
        $.ajax({
            type: 'POST',
            url: "{{ route('register.getSchool') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'regency_id': $('#regency_id').val(),
            },
            success: function(data) {
                
                $("#school_id").attr('disabled', false);
                $("#school_id").html('');

                $("#teacher_id").attr('disabled', true);
                $("#teacher_id").html('');

                var temp = "";
                temp += '<option selected disabled>-- Pilih Sekolah --</option>';
                $.each(data.msg, function(key, value) {
                    temp += "<option value='" +
                        data.msg[key].id + "'>" +
                        data.msg[key].nama + "</option>";
                })
                $("#school_id").html(temp)
                $(".select2").select2();
            }
        });
    }

    function getTeacher() {
        $.ajax({
            type: 'POST',
            url: "{{ route('register.getTeacher') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'school_id': $('#school_id').val(),
            },
            success: function(data) {                    
                $("#teacher_id").attr('disabled', false);
                $("#teacher_id").html('');

                var temp = "";
                temp += '<option selected disabled>-- Pilih Sekolah --</option>';
                $.each(data.msg, function(key, value) {
                    temp += "<option value='" +
                        data.msg[key].id + "'>" +
                        data.msg[key].nama + "</option>"
                })
                $("#teacher_id").html(temp)
                $(".select2").select2();
            }
        });
    }

    function showCadanganForm() {
        $("#formCadangan").attr("class", "")
        $("#buttonCadangan").attr("class", "d-none")
        $("#cadangan_status").attr("value", "yes")
    }

    function hideCadanganForm() {
        $("#formCadangan").attr("class", "d-none")
        $("#buttonCadangan").attr("class", "")
        $("#cadangan_status").attr("value", "no")
    }
</script>
@endsection
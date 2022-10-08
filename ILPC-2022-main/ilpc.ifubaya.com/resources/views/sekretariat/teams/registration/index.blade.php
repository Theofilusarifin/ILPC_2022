@extends('sekretariat.layouts.app', ['pageActive' => 'sekretariat.teams.index', 'pageTitle' => 'Tim - Data
Pendaftar'])

@section('header')
<style>
    ul {
        margin: 0;
    }

    @media only screen and (max-width: 800px) {

        th:nth-child(1),
        td:nth-child(1),
        th:nth-child(4),
        th:nth-child(5),
        td:nth-child(4),
        td:nth-child(5) {
            display: none;
        }
    }
</style>
@endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Data Teams</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Sekretariat</a>
                        </li>
                        <li class="breadcrumb-item">Teams
                        </li>
                        <li class="breadcrumb-item active">Registrasi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
        <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        data-feather="grid"></i></button>
                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"><i class="me-1"
                            data-feather="check-square"></i><span class="align-middle">Todo</span></a><a
                        class="dropdown-item" href="#"><i class="me-1" data-feather="message-square"></i><span
                            class="align-middle">Chat</span></a><a class="dropdown-item" href="#"><i class="me-1"
                            data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item"
                        href="#"><i class="me-1" data-feather="calendar"></i><span
                            class="align-middle">Calendar</span></a></div>
            </div>
        </div>
    </div> --}}
</div>
<div class="content-body">

    <div class="card">
        <div class="card-body">
            @php
            if($errors->any()) session()->flash("error", "Mohon input semua data yang diperlukan")
            @endphp
            @include('layouts.alert')
            <h4 class="card-title mt-2">Search &amp; Filter</h4>
            <form method="get" action="{{ route('sekretariat.teams.search') }}">
                <div class="row mb-1">
                    <div class="col-md-6 mb-4">
                        <label for="team_nama" class="form-label">Status</label>
                        <div class="d-flex align-items-center h-100">
                            <div class="form-check form-check-inline form-check-success">
                                <input id="checkStatusReady" class="form-check-input" type="checkbox" name="status[]"
                                    value="ready" {{ in_array("ready", request('status')) ? " checked" : "" }}><label
                                    class="form-check-label" for="checkStatusReady">Ready</label>
                            </div>
                            <div class="form-check form-check-inline form-check-secondary">
                                <input id="checkStatusWaiting" class="form-check-input" type="checkbox" name="status[]"
                                    value="waiting" {{ in_array("waiting", request('status')) ? " checked" : ""
                                    }}><label class="form-check-label" for="checkStatusWaiting">Waiting</label>
                            </div>
                            <div>
                                <div class="form-check form-check-inline form-check-warning">
                                    <input id="checkStatusUnverified" class="form-check-input" type="checkbox"
                                        name="status[]" value="unverified" {{ in_array("unverified", request('status'))
                                        ? " checked" : "" }}><label class="form-check-label"
                                        for="checkStatusUnverified">Unverified</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="team_nama" class="form-label">Search by</label>
                        <div class="input-group">
                            <select id="searchBy" name="searchBy" class="form-select text-capitalize">
                                <option value="teams.nama" class="text-capitalize">Team</option>
                                <option value="participants.nama" class="text-capitalize">Peserta</option>
                                <option value="schools.nama" class="text-capitalize">Sekolah</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Keyword" name="keyword"
                                value="{{ session('keyword') ?? '' }}">
                            <button class="btn btn-outline-primary waves-effect" type="submit"><i
                                    data-feather="search"></i></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="card-body">
            <div class="divider mb-4">
                <div class="divider-text">
                    {{ $teams->onEachSide(1)->withQueryString()->links() }}</div>
            </div>

            <table class="table">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Nama</th>
                    <th width="10%">Status</th>
                    <th width="35%">Peserta</th>
                    <th width="25%">Sekolah</th>
                    <th width="5%">Action</th>
                </tr>
                @foreach ($teams as $team)
                <tr>
                    <td>{{ $team->id }}</td>
                    <td>{{ $team->nama }}</td>
                    @php
                    if($team->status == "ready") $statusBadgeColor = "badge-light-success";
                    else if($team->status == "waiting") $statusBadgeColor = "badge-light-secondary";
                    else if($team->status == "unverified") $statusBadgeColor = "badge-light-warning";
                    @endphp
                    <td><span class="badge{{ " $statusBadgeColor" }}">{{ $team->status }}</span></td>
                    <td>
                        @foreach ($team->participants as $participant)
                        <div><small class="mb-1">- {{ $participant->nama }}</small></div>
                        @endforeach
                    </td>
                    <td>{{ $team->teacher->school->nama }}</td>
                    <td width="8%">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                            onclick="getTeamsDataToReadMore({{ $team->id }})" style="width:100%;">
                            <i data-feather="book-open"></i></button>
                        <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal"
                            data-bs-target="#deactivateModal" onclick="getTeamsDataToDelete({{ $team->id }})"
                            style="width:100%;">
                            <i data-feather="power"></i></button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


{{-- MODAL DEACTIVATE --}}
<div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Deactivate Team</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="sekretariatTeamsDelete">
                    @csrf
                    <p>Apakah anda yakin untuk menonaktifkan team ini?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatTeamsDelete" type="submit" class="btn btn-danger"
                    data-bs-dismiss="modal">Deactivate</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL DEACTIVATE --}}

{{-- MODAL READ MORE --}}
<div class="modal fade" id="readmoreModal" tabindex="-1" aria-labelledby="readmoreModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2" id="judul_modal">
                    {{-- Ambil dari Ajax --}}
                </div>
                <div class="d-flex justify-content-center mb-4" id="foto_bukti_pembayaran">
                    {{-- Ambil dari Ajax --}}
                </div>

                <div id="carousel-pause" class="carousel slide carousel-fade" data-bs-ride="carousel"
                    data-pause="hover">
                    <ol class="carousel-indicators" id="indicator_kartu_pelajar">
                        {{-- Ambil Indicator dari Ajax --}}
                    </ol>
                    <div class="carousel-inner" role="listbox" id="foto_kartu_pelajar">
                        {{-- Ambil Foto dari ajax --}}
                    </div>
                    <a class="carousel-control-prev" href="#carousel-pause" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-pause" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                <div class="d-flex justify-content-center">

                </div>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL READ MORE --}}

{{-- MODAL FOTO BUKTI TRANSFER --}}
<div class="modal fade" id="buktiTransferModal" tabindex="-1" aria-labelledby="buktiTransferModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-12">
                        <div class="card card-developer-meetup" id="dataBuktiTransfer">
                            {{-- Ambil data modal dari Ajax --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END OF FOTO BUKTI TRANSFER --}}

{{-- MODAL FOTO KARTU PELAJAR --}}
<div class="modal fade" id="kartuPelajarModal" tabindex="-1" aria-labelledby="kartuPelajarModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-12">
                        <div class="card card-developer-meetup" id="dataKartuPelajar">
                            {{-- Ambil data modal dari Ajax --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL FOTO KARTU PELAJAR --}}

{{-- Modal Success --}}
    {{-- <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;">
        <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
            class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive"
            aria-modal="true" style="display: grid;"><button type="button" class="swal2-close"
                aria-label="Close this dialog" style="display: none;">×</button>
            <ul class="swal2-progress-steps" style="display: none;"></ul>
            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                <div class="swal2-success-ring"></div>
                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
            </div><img class="swal2-image" style="display: none;">
            <h2 class="swal2-title" id="swal2-title" style="display: block;">Good job!</h2>
            <div class="swal2-html-container" style="display: block;">You clicked the button!</div><input
                class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;">
            <div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select
                class="swal2-select" style="display: none;"></select>
            <div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox"
                style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea
                class="swal2-textarea" style="display: none;"></textarea>
            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
            <div class="swal2-actions">
                <div class="swal2-loader"></div><button type="button" class="swal2-confirm btn btn-primary" aria-label=""
                    style="display: inline-block;">OK</button><button type="button" class="swal2-deny" aria-label=""
                    style="display: none;">No</button><button type="button" class="swal2-cancel" aria-label=""
                    style="display: none;">Cancel</button>
            </div>
            <div class="swal2-footer" style="display: none;"></div>
            <div class="swal2-timer-progress-bar-container">
                <div class="swal2-timer-progress-bar" style="display: none;"></div>
            </div>
        </div>
    </div> --}}
{{-- End Of Modal Success --}}
@endsection

@section('script')
<script>
    // So that Select2 would work on Modal
        $(document).ready(function() {

        });

        // Modal Read More Ajax
        function getTeamsDataToReadMore(team_id){
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.teams.readMore') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'team_id': team_id,
                },
                success: function(data) {
                }
            }).then(data => {
                    // Modal ditampilkan
                    $('#readmoreModal').modal("show");

                    if(data.team['status']=='waiting'){
                        $("div#judul_modal").html(
                            `<small class="btn btn-sm btn-outline-secondary"> Team `+data.team['nama']+` Belum melakukan upload bukti transfer</small>`
                        );
                        $("div#foto_bukti_pembayaran").html("");
                    }
                    else{
                        // Masukkan data judul modal
                        $("div#judul_modal").html(
                            `<h2>`+data.team['nama']+`</h2>
                            <p id="txtNamaTeam">`+data.school['nama']+`</p>`
                        );

                        // Masukkan foto bukti pembayaran
                        var url_bukti_transfer = data.team['bukti_transfer'];
                        $("div#foto_bukti_pembayaran").html(
                        `<img class="img-fluid rounded" role="button" src="{{ asset('/`+url_bukti_transfer+`')}}" alt="Foto bukti pembayaran" onclick="showBuktiTransfer(`+data.team['id']+`)">
                        <br>`);
                    }

                    // Masukkan Indicator (Apakah 3 atau 4 berdasarkan jumlah data dari controller)
                    var index = 0;
                    var temp = "";
                    var active = "";
                    $.each(data.participants, function(key, value) {    
                        if (index==0) active="active";
                        else active="";
                        temp+="<li data-bs-target='#carousel-pause' data-bs-slide-to='"+index+"' class='"+active+"' aria-current='true'>"
                        index++;
                    })
                    $("ol#indicator_kartu_pelajar").html(temp);

                    // Masukkan Indicator dan Foto (Apakah 3 atau 4 berdasarkan jumlah data dari controller)
                    var index = 0;
                    var indicator = "";
                    var foto = "";
                    var active = "";
                    $.each(data.participants, function(key, value) {
                        var url_foto = data.participants[key].kartu_pelajar;

                        if (index==0) active = "active";     
                        else active = "";
                        
                        indicator+="<li data-bs-target='#carousel-pause' data-bs-slide-to='"+index+"' class='"+active+"' aria-current='true'>";
                            foto += `<div class="carousel-item `+active+`">
                                        <img data-bs-toggle="modal" class="img-fluid rounded w-100" role="button"
                                            src="{{ asset('/`+url_foto+`')}}" alt="Foto kartu pelajar" onclick="showKartuPelajar(`+data.participants[key].id+`)">
                                        <div class="carousel-caption"><small class="text-white">`+data.participants[key].nama+`</small></div>
                                    </div>`;
                        index++;
                    })
                    $("ol#indicator_kartu_pelajar").html(indicator);
                    $("div#foto_kartu_pelajar").html(foto);
                });
        }

        function showBuktiTransfer(team_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.teams.showBuktiTransfer') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'team_id': team_id,
                },
                success: function(data) {
                    // // Modal ditampilkan
                    $('#buktiTransferModal').modal("show");
                    
                    // Tampilkan foto kartu pelajar
                    var url_foto_bukti_transfer = data.team['bukti_transfer'];
                    var status = data.team['status'];
                    var button_style, button_text, button_function = ""
                    if (status == "ready") {
                        button_style = "danger"
                        button_text = "Batalkan Verifikasi"
                        button_function = "unverifiedBuktiPembayaran("+data.team['id']+")"
                    }
                    else {
                        button_style = "success"
                        button_text = "Verifikasi"
                        button_function = "verifiedBuktiPembayaran("+data.team['id']+")"
                    }
                    $("div#dataBuktiTransfer").html(
                        `<div class="meetup-img-wrapper rounded-top text-center">
                            <img class="img-fluid rounded w-100" src="{{ asset('/`+url_foto_bukti_transfer+`')}}" alt="Foto Bukti Transfer">
                        </div>
                        <div class="card-body">
                            <a href='{{ route('sekretariat.teams.index') }}' class="btn btn-`+button_style+` waves-effect waves-float waves-light w-100" id="type-success" onclick="if(!confirm('Confirm Action?')) return false; else `+button_function+`">`+button_text+`</a>
                        </div>`
                        );
                }
            })
        }

        function verifiedBuktiPembayaran(team_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.teams.verifiedBuktiTransfer') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'team_id': team_id,
                },
                success: function(data) {
                    $('#buktiTransferModal').modal("hide");
                }
            })
        }

        function unverifiedBuktiPembayaran(team_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.teams.unverifiedBuktiTransfer') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'team_id': team_id,
                },
                success: function(data) {
                    $('#buktiTransferModal').modal("hide");
                }
            })
        }

        function showKartuPelajar(participant_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.participant.showKartuPelajar') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'participant_id': participant_id,
                },
                success: function(data) {
                    // Modal ditampilkan
                    $('#kartuPelajarModal').modal("show");
                    
                    // Tampilkan foto kartu pelajar
                    var url_foto_kartu_pelajar = data.participant['kartu_pelajar'];
                    var status = data.participant['status'].replace("_", " ");
                    $("div#dataKartuPelajar").html(
                        `<div class="meetup-img-wrapper rounded-top text-center">
                            <img class="img-fluid rounded w-100" src="{{ asset('/`+url_foto_kartu_pelajar+`')}}" alt="Foto kartu pelajar">
                        </div>
                        <div class="card-body">
                            <div class="meetup-header d-flex align-items-center">
                                <div class="meetup-day">
                                    <h6 class="mb-0">KELAS</h6>
                                    <h3 class="mb-0">`+data.participant['kelas']+`</h3>
                                </div>
                                <div class="my-auto">
                                    <h4 class="card-title mb-25">`+data.participant['nama']+`<small> | `+status+`</small></h4>
                                    <p class="card-text mb-0">`+data.school['nama']+`</p>
                                </div>
                            </div>
                            <div class="d-flex flex-row meetings">
                                <div class="avatar bg-light-primary rounded me-1">
                                    <div class="avatar-content">
                                        <div class="icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-mail">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-body">
                                    <h6 class="mb-0">Email</h6>
                                    <small>`+data.participant['email']+`</small>
                                </div>
                            </div>
                            <div class="d-flex flex-row meetings">
                                <div class="avatar bg-light-primary rounded me-1">
                                    <div class="avatar-content">
                                        <div class="icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-phone">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-body">
                                    <h6 class="mb-0">Nomor Telephone</h6>
                                    <small>`+data.participant['telp_peserta']+`</small>
                                </div>
                            </div>
                        </div>`
                    );
                }
            })
        }

        function getTeamsDataToDelete(id) {
            $("#sekretariatTeamsDelete").attr("action", "{{ route('sekretariat.teams.index') }}/deactivate/" + id)
        }
</script>
@endsection
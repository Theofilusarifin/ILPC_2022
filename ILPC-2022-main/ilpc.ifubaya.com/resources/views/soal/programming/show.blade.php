@extends('soal.layouts.app', ['pageActive' => 'soal.prg.index', 'pageTitle' => 'Soal Programming'])@section('header')
<style>
    ul {
        margin: 0;
    }

    @media only screen and (max-width: 800px) {

        th:nth-child(3),
        th:nth-child(4),
        td:nth-child(3),
        td:nth-child(4) {
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
                <h2 class="content-header-title float-start mb-0">Data Programming Contest</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('soal.index') }}">Soal</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.prg.index') }}">Programming</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $contest->nama }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
        <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="#"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="#"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="#"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
            </div>
        </div>
    </div> --}}
</div>
@include('layouts.alert')
<div class="content-body" id="table-head"></div>
    {{-- Data Contest --}}
    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th width="15%">Author</th>
                    <th width="20%">Jadwal Mulai</th>
                    <th width="20%">Jadwal Selesai</th>
                    @if (Auth::user()->role == 'soal')
                    <th width="15%">Scoreboard Freeze</th>
                    <th width="15%">Scoreboard Status</th>
                    @endif
                    <th width="8%">
                        Participants
                    </th>
                    <th width="8%">
                        Submission
                    </th>
                    @if (Auth::user()->role == 'soal')
                    <th width="8%">
                        Scoreboard
                    </th>
                    <th width="8%">
                        Edit Contest
                    </th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <tr class="text-center">
                    <td>{{ $admin->nama }}</td>
                    <td>{{ $contest->jadwal_mulai }}</td>
                    <td>{{ $contest->jadwal_selesai }}</td>
                    @if (Auth::user()->role == 'soal')
                    <td>{{ $contest->scoreboard_freeze }}</td>
                    <td>{{ $contest->scoreboard_status }}</td>
                    @endif
                    <td width="8%">
                        <a href="{{ route('soal.prg.participant', $contest->id) }}" style="width:100%;" class="btn btn-outline-primary waves-effect">
                            <i data-feather="users"></i>
                        </a>
                    </td>
                    <td width="8%">
                        <a href="{{ route('soal.prg.submission', $contest->id) }}" style="width:100%;" class="btn btn-outline-primary waves-effect">
                            <i data-feather="file"></i>
                        </a>
                    </td>
                    @if (Auth::user()->role == 'soal')
                    <td width="8%">
                        <a href="{{ route('soal.prg.scoreboard', [$contest->id,$contest->scoreboard_slug]) }}" style="width:100%;" class="btn btn-outline-primary waves-effect">
                            <i data-feather="award"></i>
                        </a>
                    </td>
                    <td width="8%">
                        <button class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#editContestModal" style="width:100%;">
                            <i data-feather="edit"></i>
                        </button>
                    </td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- /Data Contest --}}

    {{-- Question --}}
    <div class="card">
        <div class="card-header mb-1" style='background-color: #5c657a'>
            <h4 class="card-title text-white">List of Question</h4>
        </div>
        @if (Auth::user()->role == 'soal')
        <p class="ms-2 mb-2">
            Pada tabel ini, anda dapat melihat list soal apa aja yang telah anda buat. <br>
            Untuk membuat soal baru, anda dapat menekan tombol <i class="text-success" data-feather="plus-square"></i> di ujung kanan pada tabel list soal.<br>
            Untuk mengubah soal, anda dapat menekan tombol <i class="text-warning" data-feather="edit"></i> pada soal yang diinginkan.<br>
            Untuk menghapus soal, anda dapat menekan tombol <i class="text-danger" data-feather="trash-2"></i> pada soal yang diinginkan.<br>
            Apabila anda ingin mengecek file input output, anda dapat menekan tombol pada kolom input output.<br>
            <b>Rejudge</b> hanya digunakan saat terjadi perubahan file input dan output pada nomor tersebut selama acara berlangsung.
            <div class="badge badge-light-primary">
                Teliti kembali nomor soal setelah anda membuatnya.
            </div>
        </p>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th width="10%">Nomor</th>
                        <th width="40%">Judul</th>
                        <th width="20%">Time Limit</th>
                        @if (Auth::user()->role == 'soal')
                        <th width="8%">Input</th>
                        <th width="8%">Output</th>
                        <th width="8%">Rejudge</th>
                        <th width="10%"><a href="{{ route('soal.prg.question.create', $contest->id) }}" style="width:100%;" class="btn btn-success"><i data-feather="plus-square"></i></a></th>
                        @endif
                    </tr>
                    {{-- <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addModal" style="width:100%;">
                        <i data-feather="plus-square"></i>
                    </button> --}}
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                    <tr class="text-center">
                        <td>Nomor {{ $question->nomor }}</td>
                        <td>{{ $question->judul }}</td>
                        <td>{{ $question->time_limit }}</td>
                        @if (Auth::user()->role == 'soal')
                        <td>
                            <a href="{{ asset('/'.$question->input) }}" style="width:100%;" download="" class="btn btn-outline-info waves-effect"><i data-feather="file-text"></i></a>
                        </td>
                        <td>
                            <a href="{{ asset('/'.$question->output) }}" style="width:100%;" download="" class="btn btn-outline-info waves-effect"><i data-feather="file-text"></i></a>    
                        </td>
                        <td>
                            <a href="#" style="width:100%;" download="" class="btn btn-outline-danger waves-effect" onclick="return confirm('Are you sure you want to rejudge?')">Rejudge</a>    
                        </td>
                        <td width="8%">
                            <a href="{{ route('soal.prg.question.edit', ['contest' => $contest->id, 'question' => $question->id]) }}" style="width:100%;" class="btn btn-outline-warning waves-effect"><i data-feather="edit"></i></a>
                            <button class="btn btn-outline-danger waves-effect mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal" style="width:100%;" onclick="deleteQuestion({{ $question->id }})">
                                <i data-feather="trash-2"></i>
                            </button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- /Question --}}
</div>

@if (Auth::user()->role == 'soal')
{{-- MODAL EDIT CONTEST --}}
<div class="modal fade" id="editContestModal" tabindex="-1" aria-labelledby="editContestModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Contest</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('soal.prg.update',$contest->id) }}" id="soalEssayUpdate">
                    @csrf
                    {{-- Nama --}}
                    <div class="mb-1">
                        <label for="nama" class="form-label">Nama Contest</label>
                        <input type="text" class="form-control" name="nama" id="edit_nama" placeholder="Nama Contest" aria-describedby="nama" tabindex="1" autofocus value="{{ old('nama') ?? $contest->nama }}" />
                    </div>

                    {{-- Jadwal Mulai --}}
                    <div class="mb-1">
                        <label class="form-label" for="edit_jadwal_mulai">Jadwal Mulai</label>
                        <input type="text" id="edit_jadwal_mulai" name="jadwal_mulai" class="form-control flatpickr-date-time flatpickr-input" placeholder="YYYY-MM-DD HH:MM" value="{{ old('jadwal_mulai') ?? $contest->jadwal_mulai }}"/>
                    </div>

                    {{-- Jadwal Selesai --}}
                    <div class="mb-1">
                        <label class="form-label" for="edit_jadwal_selesai">Jadwal Selesai</label>
                        <input type="text" id="edit_jadwal_selesai" name="jadwal_selesai" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" value="{{ old('jadwal_mulai') ?? $contest->jadwal_selesai }}"/>
                    </div>

                    {{-- Scoreboard Freeze --}}
                    <div class="mb-1">
                        <label class="form-label" for="edit_scoreboard_freeze">Scoreboard Freeze</label>
                        <input type="number" class="form-control" name="scoreboard_freeze" id="edit_scoreboard_freeze" placeholder="Scoreboard Freeze in Minutes" aria-describedby="scoreboard_freeze" tabindex="1" autofocus value="{{ old('scoreboard_freeze') ?? $contest->scoreboard_freeze }}" />
                    </div>

                    {{-- Scoreboard Status --}}
                    <div class="mb-1">
                        <label class="form-label" for="add_scoreboard_status">Scoreboard Status</label>
                        <input value="{{ old('scoreboard_status') ?? $contest->scoreboard_status }}" type="text" class="form-control" name="scoreboard_status" id="edit_scoreboard_status" placeholder="Status" aria-describedby="nama" tabindex="1" autofocus /> 
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="soalEssayUpdate" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL EDIT CONTEST --}}

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Soal Programming</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('soal.prg.question.destroy') }}" id="prgQuestionDelete">
                    @csrf
                    <input type='hidden' id='prgQuestionDeleteInput' name='id'/>
                    <p id='prgQuestionDeleteCaption'></p>
                </form>
            </div>
            <div class="modal-footer">
                <button form="prgQuestionDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL DELETE --}}
@endif

@endsection

@section('script')
<script>
    function deleteQuestion(id) {
        $('#prgQuestionDeleteInput').val(id);
        $('#prgQuestionDeleteCaption').html('Apakah anda yakin untuk delete soal ini?');
    }
</script>

@endsection
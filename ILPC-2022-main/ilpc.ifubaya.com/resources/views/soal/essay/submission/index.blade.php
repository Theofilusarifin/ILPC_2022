@extends('soal.layouts.app', ['pageActive' => 'soal.essay.index', 'pageTitle' => 'Soal Essay'])
@section('header')
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
<!-- Kick start -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Notes</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <p>
                Hi, {{ auth()->user()->username }}! <br>
                Disini anda dapat mengecek tiap tim yang mengikuti contest essay. Anda dapat melihat hasil jawabannya dengan menekan button <b>File Submission</b>.<br>
                Kemudian untuk <b>mengubah skor</b>, Anda dapat menekan button <b>Update Score</b> di ujung tabel paling kanan.<br>
                Pastikan kembali setiap kali anda selesai <b>mengubah skor</b>, apakah <b>jumlah skor sudah benar </b>.<br>

                Apabila ada kendala dapat menghubungi tim SI ya!
            </p>
            {{-- <div class="alert alert-primary" role="alert">
                <div class="alert-body">
                    <strong>Hai {{ auth()->user()->username }}!</strong> Semoga harimu menyenangkan :)
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!--/ Kick start -->
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Soal</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.essay.index') }}">Essay</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.essay.show', $contest->id) }}">{{ $contest->nama }}</a>
                        <li class="breadcrumb-item active">Submission</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Submission {{ $contest->nama }}</h4>
        </div>
        <div class="card-body">
            
        @include('layouts.alert')
        <h5 class="card mt-2">Search &amp; Filter</h5>
        <form method="get" action="{{ route('soal.essay.submission', $contest->id) }}" class="mb-2">
            {{-- @csrf --}}
            <div class="row">
                <div class="col-md-6">
                    <label for="team_nama" class="form-label">Team Name :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Keyword" name="keyword"
                            value="{{ session('keyword') ?? '' }}">
                        <button class="btn btn-outline-primary waves-effect" type="submit"><i
                                data-feather="search"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="divider mb-2">
            <div class="divider-text">
                {{ $submissions->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mb-8">
                <tr>
                    <th width="30%">Team</th>
                    <th width="10%">Waktu Bergabung</th>
                    @if (Auth::user()->role == 'soal')
                    <th width="5%">Total Skor</th>
                    @endif
                    <th width="5%">File Submission</th>
                    @if (Auth::user()->role == 'soal')
                    <th width="5%">Update Score</th>
                    @endif
                </tr>
                @foreach ($submissions as $submission)
                <tr>
                    <td>{{$submission->nama }}</td>
                    <td>{{ $submission->waktu_bergabung}}</td>
                    @if (Auth::user()->role == 'soal')
                    <td>{{ $submission->total_skor}}</td>
                    @endif
                    <td class="text-center">
                        <a href="{{ asset('/'.$submission->submission_filename) }}" style="width:100%;" download="" class="btn btn-outline-info waves-effect"><i data-feather="file-text"></i></a>
                    </td>
                    @if (Auth::user()->role == 'soal')
                    <td class="text-center">
                        <button class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#updateScoreModal-{{ $contest->id }}-{{ $submission->team_id }}" style="width:100%;">
                            <i data-feather="edit"></i>
                        </button>
                    </td>
                    @endif
                </tr>
                
                {{-- Modal Update Score --}}
                <div class="modal fade" id="updateScoreModal-{{ $contest->id }}-{{ $submission->team_id }}" tabindex="-1" aria-labelledby="updateScoreModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Update Score</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('soal.essay.updatescore', $contest->id) }}" id="updateScoreForm-{{ $contest->id }}-{{ $submission->team_id }}">
                                    @csrf
                                    {{-- Score --}}
                                    <div class="mb-1">
                                        <h5>{{$submission->nama }}</h5>
                                        <label for="score" class="form-label">Total Score</label>
                                        <input type="hidden" name="team_id" value="{{ $submission->team_id }}">
                                        <input type="text" class="form-control" name="total_skor" id="update_score" placeholder="Update Score" aria-describedby="score" tabindex="1" autofocus value="{{ old('total_skor') ?? $submission->total_skor }}" />
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button form="updateScoreForm-{{ $contest->id }}-{{ $submission->team_id }}" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </table>
        </div>
        </div>
    </div>
</div>

@endsection

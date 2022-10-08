@extends('soal.layouts.app', ['pageActive' => 'soal.prg.index', 'pageTitle' => 'Soal Programming'])
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
                Disini anda dapat mengecek tiap tim yang mengikuti contest programming. Anda dapat melihat hasil jawabannya dengan menekan button <b>Solution</b>.<br>
                Kemudian untuk <b>melakukan penilaian</b>, anda dapat menekan button <b>Judge</b> di ujung tabel paling kanan.<br>
                <b>Jangan lupa Judge harus dari paling bawah.</b><br>
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
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.prg.index') }}">Programming</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.prg.show', $contest->id) }}">{{ $contest->nama }}</a>
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
        <div class="divider mb-2">
            <div class="divider-text">
                {{ $submissions->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mb-4">
                <tr>
                    <th width="5%">Team</th>
                    <th width="5%">Nomor</th>
                    <th width="12%">Judul</th>
                    <th width="5%">Status</th>
                    <th width="5%">Waktu Submit</th>
                    <th width="5%">Bahasa</th>
                    <th width="5%">Runtime</th>
                    @if (Auth::user()->role == 'soal')
                    <th width="5%">Penalti</th>
                    @endif
                    <th width="5%">Solution</th>
                    <th width="5%">Judge</th>
                </tr>
                @foreach ($submissions as $submission)
                <tr>
                    <td>{{$submission->team->nama }}</td>
                    <td>{{ $submission->prgQuestion->nomor}}</td>
                    <td>{{ $submission->prgQuestion->judul}}</td>
                    <td>{{ $submission->status}}</td>
                    <td>{{ $submission->waktu_submit}}</td>
                    <td>{{ $submission->bahasa}}</td>
                    <td>{{ $submission->runtime}}</td>
                    @if (Auth::user()->role == 'soal')
                    <td>{{ $submission->skor}}</td>
                    @endif
                    <td class="text-center">
                        <a href="{{ asset('/'.$submission->filename) }}" style="width:100%;" download="" class="btn btn-outline-info waves-effect"><i data-feather="file-text"></i></a>
                    </td>
                    <td class="text-center">
                        @if ($submission->status == 'Pending')
                        <form method="POST" id="form-{{ $contest->id }}-{{ $submission->submission_id }}"  action="{{ route('soal.prg.submission.judge', [$contest->id, $submission->submission_id]) }}">
                            @csrf
                            <button style="width:100%;" id="btn-{{ $contest->id }}-{{ $submission->submission_id }}" class="btn btn-outline-danger waves-effect btn-judge" onclick="judgeSubmission({{ $contest->id }},{{ $submission->submission_id }})" >Judge</button>    
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function judgeSubmission(contest_id, submission_id){
        $('#form-'+contest_id+'-'+submission_id).one('submit', function() {
            $('#btn-'+contest_id+'-'+submission_id).attr('disabled', true);
        });
    };
</script>
@endsection
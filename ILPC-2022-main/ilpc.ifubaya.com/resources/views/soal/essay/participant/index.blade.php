@extends('soal.layouts.app', ['pageActive' => 'soal.essay.index', 'pageTitle' => 'Contest Participant'])
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
                Disini anda menambahkan team yang berpartisipasi dalam sebuah kontes.<br>
                Pilih salah satu team di combobox, kemudian tekan tombol plus untuk menambakan.<br>
                Tekan tombol sampah untuk menghapus tim dari partisipasi,<br>
                namun <b>hati-hati</b> tim yang di delete dari sini akan hilang total <b>Skor</b> dan <b>Submission</b> (Apabila sudah lomba)<br><br>
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
                        <li class="breadcrumb-item active"><a href="{{ route('soal.essay.index') }}">Essay</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.essay.show', $contest->id) }}">{{ $contest->nama }}</a>
                        <li class="breadcrumb-item active">Participant</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Participant {{ $contest->nama }}</h4>
        </div>
        <div class="card-body">
            @include('layouts.alert')
            <div class="row mb-1">
                <div class="col-4" class="mb-1">
                    @php
                    $id_teams_joined = [];
                    foreach($contest->teams as $team_join) {
                    array_push($id_teams_joined, $team_join->id);
                    }
                    @endphp

                    <label for="pilih_team">Pilih Team :</label>
                    @if(count($id_teams_joined) != count($all_teams))
                    <form method="post" action="{{ route('soal.essay.participant.store', $contest->id) }}" id="formStoreParticipant">
                        @csrf
                        <select id="pilih_team" class="select2 form-select" tabindex="-1" aria-hidden="true" name="team_id[]" multiple="multiple" onchange="enableButton()">
                            {{-- <option selected disabled>-- Pilih Team --</option> --}}
                            @foreach ($all_teams as $team)
                            @if (!in_array($team->id, $id_teams_joined))
                            <option value="{{ $team->id }}">{{ $team->nama }}</option>
                            @endif
                            @endforeach
                        </select>
                    </form>
                    @else
                    <input type='text' class='form-control' disabled value='Semua Team Sudah Join' />
                    @endif
                </div>
                <div class="col-4" class="mb-1">
                    <div class="mb-2"></div>
                    <button id="buttonStoreParticipant" form="formStoreParticipant" type="submit" class="btn btn-success" disabled><i data-feather='plus-square'></i></button>
                </div>
            </div>
            <div class="divider mb-2">
                <div class="divider-text">
                    {{ $teams->onEachSide(1)->withQueryString()->links() }}
                </div>
            </div>
            <table class="table mb-4">
                <tr>
                    <th width="95%">Team</th>
                    <th width="5%" class="text-center">Delete</th>
                </tr>
                @foreach ($contest->teams as $team_join)
                <tr>
                    <td>{{$team_join->nama }}</td>
                    <td class="text-center">
                        <button class="btn btn-outline-danger my-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="getEssayDataToDelete({{ $contest->id. ','. $team_join->id }})" style="width:100%;">
                            <i data-feather="trash-2"></i></button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Participant</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="participantessayContestDelete">
                    @csrf
                    <p>Apakah anda yakin untuk menghapus team ini?</p>
                    <small><b>Jangan sampai menghapus team yang sudah mengikuti contest. Karena akan menghapus history contest mereka!</b></small>
                </form>
            </div>
            <div class="modal-footer">
                <button form="participantessayContestDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL DELETE --}}


@endsection

@section('script')

<script>
    function getEssayDataToDelete(contest_id, team_id){
        $("#participantessayContestDelete").attr("action", "{{ route('soal.essay.index') }}/"+contest_id+"/participant/destroy/"+team_id);
    }

    function enableButton(){
        $('#buttonStoreParticipant').attr('disabled', false);
    }
</script>

@endsection
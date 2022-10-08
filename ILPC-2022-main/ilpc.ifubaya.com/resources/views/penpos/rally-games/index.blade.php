@extends('soal.layouts.app', ['pageActive' => 'penpos.rally-games.index', 'pageTitle' => 'Penilaian Rally Games'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Rally</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Rally Games</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Kick start -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Introduction</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Hi, {{ auth()->user()->username }}! <br>
                    Di sini, anda dapat melakukan penilaian rally games.<br>
                    Pilih nama team yang ingin diberi score dan pilih nama posnya.<br>
                    Kemudian, isikan jumlah score dan klik button Update.
                </p>
            </div>
        </div>
    </div>
    <!--/ Kick start -->
    <div class="row d-flex mb-3">
        {{-- Input Score Start --}}
        <div class="col-6">
            <div class="card card-app-design">
                <div class="card-header">
                    <h4 class="card-title">Input Score</h4>
                </div>
                <div class="card-body">

                    <div class="row" id="alert-success" style="display:none">
                        <div class="col-10">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-body">
                                    Score Sucesfully Updated
                                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-1">
                        <label class="form-label" for="nama_team">Nama Team</label>
                        <select class="select2 form-select" tabindex="-1" aria-hidden="true" id="nama_team" onchange="getDataTeam()">
                            <option selected disabled>-- Pilih Nama Team --</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="nama_pos">Nama Pos</label>
                        <select class="select2 form-select" id="nama_pos" tabindex="-1" aria-hidden="true">
                            <option selected disabled>-- Pilih Nama Pos --</option>
                            @foreach ($rally_games as $rg)
                                <option value="{{ $rg->id }}">{{ $rg->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label class="form-label">Score</label>
                    <input type="number" class="form-control" name="score" id="score" placeholder="Score" aria-describedby="score" tabindex="1"/>

                    <button type="submit" onclick="updateScore()" class="btn btn-primary mt-2">Add Score</button>
                    {{-- Input Score End --}}
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-app-design">
                <div class="card-header">
                    <h4 class="card-title">Team Score</h4>
                </div>
                <div class="card-body">
                    <table id="team_table" class="table mb-4">
                        <tr>
                            <th class="text-center" width="60%">Pos</th>
                            <th class="text-center" width="40%">Score</th>
                        </tr>
                        {{-- @foreach ($rally_games as $rg)
                            <tr>
                                <td class="text-center">{{ $rg->name }}</td>
                                <td class="text-center">{{ $rg->name }}</td>
                            </tr>
                        @endforeach --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    function getDataTeam() {
        // alert($("#nama_team").val());
        $.ajax({
            type: 'POST',
            url: "{{ route('penpos.rg.data.team') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'team_id': $("#nama_team").val(),
            },
            success: function(data) {
                $("#team_table").html('');
                var temp = '<tr>'
                    temp += '<th class="text-center" width="60%">Pos</th>'
                    temp += '<th class="text-center" width="40%">Score</th>'
                    temp += '</tr>'
                $.each(data.msg, function(key, value) {
                    temp += '<tr>' 
                    temp += '<td class="text-center">'+data.msg[key].name+'</td>'
                    if(data.msg[key].score == 0) {
                        temp += '<td class="text-center text-primary">'+data.msg[key].score+'</td>'
                    }
                    else if(!data.msg[key].score) {
                        temp += '<td class="text-center">-</td>'
                    }
                    else {
                        temp += '<td class="text-center text-primary">'+data.msg[key].score+'</td>'
                    }
                    temp += '</tr>'
                })
                $("#team_table").html(temp);
            }
        });
    }

    function updateScore() {
        $.ajax({
            type: 'POST',
            url: "{{ route('penpos.rg.update.score') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'team_id': $("#nama_team").val(),
                'pos_id': $("#nama_pos").val(),
                'score': $("#score").val(),
            },
            success: function(data) {
                $("#team_table").html('');
                var temp = '<tr>'
                    temp += '<th class="text-center" width="60%">Pos</th>'
                    temp += '<th class="text-center" width="40%">Score</th>'
                    temp += '</tr>'
                $.each(data.msg, function(key, value) {
                    temp += '<tr>' 
                    temp += '<td class="text-center">'+data.msg[key].name+'</td>'
                    if(data.msg[key].score == 0) {
                        temp += '<td class="text-center text-primary">'+data.msg[key].score+'</td>'
                    }
                    else if (!data.msg[key].score){
                        temp += '<td class="text-center">-</td>'
                    }
                    else {
                        temp += '<td class="text-center text-primary">'+data.msg[key].score+'</td>'
                    }
                    temp += '</tr>'
                })
                $("#team_table").html(temp);

                $('#alert-success').hide();
                $('#alert-success').show();
                
                $("#alert-success").fadeTo(2500, 500).hide(500, function(){
                    $("#alert-success").hide(500);
                });
            }
        });
    }
</script>
@endsection
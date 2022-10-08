@extends('soal.layouts.app', ['pageActive' => 'penpos.gambes.index', 'pageTitle' => 'Game Besar'])

@section('style')
<style>
    table {
        background-image: url(https://upload.wikimedia.org/wikipedia/commons/7/79/Eye_Of_The_Sahara_Mauritania.jpg);
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        width: 100%;
        font-size: 0.6em;
    }

    td {
        width: 5%;
        height: 35px;
        border: 1px dashed rgb(84, 84, 84);
    }

    td:hover {
        background-color: rgba(51, 51, 51, 0.5);
    }

    .progress {
        border-radius: 0px;
    }

    .progress-bar {
        font-size: 0.6em;
        border-radius: 2px!important;
    }

    .spawnable {
        background-color: rgba(170, 213, 170, 0.5);
        cursor: pointer;
    }

    .spawnable:hover {
        background-color: rgba(106, 167, 106, 0.5);     
    }

    .wall {
        background-color: rgb(53, 43, 43);
    }

    .robot {
        background-color: rgba(58, 58, 58, 0.5);
        color: white;
    }

    .fighting {
        background-color: rgba(58, 58, 58, 0.5);
        color: white;
    }

    .player {
        background-color: rgba(58, 58, 58, 0.5);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="content-header row my-2">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row my-2 breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Gambes</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Game Besar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="row my-2 d-flex mb-3">
        <div class="col-8">
            @php($column = 20)
            <table id='mainTable'>
                @foreach ($territories as $territory)
                @if ($loop->index == 0 || $loop->index % $column == 0)@php($dibuka = $loop->index)<tr>@endif

                    {{-- If 1 Occupants --}}
                    @if($territory->num_occupants == 1)
                        {{-- Robot --}}
                        @if(isset($territory->robot_id))
                        @php($robot_percentage = round(($territory->current_health/$territory->robot->health) * 100, 2))
                        @if ($territory->robot->health <= 150)
                        @php($robot_level = 'level1')
                        @elseif ($territory->robot->health > 150 && $territory->robot->health <= 250)
                        @php($robot_level = 'level2')
                        @elseif ($territory->robot->health > 250 && $territory->robot->health <= 450)
                        @php($robot_level = 'level3')
                        @elseif ($territory->robot->health > 450 && $territory->robot->health <= 600)
                        @php($robot_level = 'level4')
                        @elseif ($territory->robot->health > 600)
                        @php($robot_level = 'level5')
                        @endif
                        <td id='{{ $territory->id }}' class='text-center territories robot' num_occupants='{{ $territory->num_occupants }}'>
                            <img style='height: 20px;' src="{{ asset('ilpc2022/gambes').'/'.$robot_level }}.svg" alt="Robot {{ $robot_level }}">
                            <div class="progress progress-bar-danger">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $robot_percentage }}%;" role="progressbar" aria-valuenow="{{ $robot_percentage }}" aria-valuemin="{{ $robot_percentage }}" aria-valuemax="100">{{ $robot_percentage }}%</div>
                            </div>
                        </td>
                        {{-- Player --}}
                        @else
                        @php($player_percentage = round(($territory->players->first()->current_health / $territory->players->first()->max_health) * 100, 2))
                        <td id='{{ $territory->id }}' class='text-center territories player' num_occupants='{{ $territory->num_occupants }}'>
                            {{$territory->players->first()->id}}
                            <div class="progress progress-bar-danger">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $player_percentage }}%;" role="progressbar" aria-valuenow="{{ $player_percentage }}" aria-valuemin="{{ $player_percentage }}" aria-valuemax="{{ $player_percentage }}">{{ $player_percentage }}%</div>
                            </div>
                        </td>
                        @endif
                    @elseif($territory->num_occupants == 2)
                        {{-- Robot and Player --}}
                        @if(isset($territory->robot_id))
                        
                        @php($robot_percentage = round(($territory->current_health/$territory->robot->health) * 100, 2))
                        @php($first_player_percentage = round(($territory->players->first()->current_health / $territory->players->first()->max_health) * 100, 2))
                        @if ($territory->robot->health <= 150)
                        @php($robot_level = 'level1')
                        @elseif ($territory->robot->health > 150 && $territory->robot->health <= 250)
                        @php($robot_level = 'level2')
                        @elseif ($territory->robot->health > 250 && $territory->robot->health <= 450)
                        @php($robot_level = 'level3')
                        @elseif ($territory->robot->health > 450 && $territory->robot->health <= 600)
                        @php($robot_level = 'level4')
                        @elseif ($territory->robot->health > 600)
                        @php($robot_level = 'level5')
                        @endif

                        <td id='{{ $territory->id }}' class='text-center territories fighting' num_occupants='{{ $territory->num_occupants }}'>
                            <div class="progress progress-bar-info">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $first_player_percentage }}%;" role="progressbar" aria-valuenow="{{ $first_player_percentage }}" aria-valuemin="{{ $first_player_percentage }}" aria-valuemax="100">{{ $first_player_percentage }}%</div>
                            </div>
                            <span class='text-info'>{{$territory->players->first()->id}}</span> vs <img style='height: 20px;' src="{{ asset('ilpc2022/gambes').'/'.$robot_level }}.svg" alt="Robot {{ $robot_level }}">
                            <div class="progress progress-bar-warning">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $robot_percentage }}%;" role="progressbar" aria-valuenow="{{ $robot_percentage }}" aria-valuemin="{{ ($territory->current_health/$territory->robot->health) * 100 }}" aria-valuemax="100">{{ $robot_percentage }}%</div>
                            </div>
                        </td>
                        {{-- Player and Player --}}
                        @else
                        @php($first_player_percentage = round(($territory->players->first()->current_health / $territory->players->first()->max_health) * 100, 2))
                        @php($second_player_percentage = round(($territory->players->skip(1)->first()->current_health / $territory->players->skip(1)->first()->max_health) * 100, 2))
                        <td id='{{ $territory->id }}' class='text-center territories fighting' num_occupants='{{ $territory->num_occupants }}'>
                            <div class="progress progress-bar-info">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $first_player_percentage }}%;" role="progressbar" aria-valuenow="{{ $first_player_percentage }}" aria-valuemin="{{ $first_player_percentage }}" aria-valuemax="100">{{ $first_player_percentage }}%</div>
                            </div>
                            <span class="text-info">{{$territory->players->first()->id}}</span> vs <span class="text-warning">{{$territory->players->skip(1)->first()->id}}</span>
                            <div class="progress progress-bar-warning">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $second_player_percentage }}%;" role="progressbar" aria-valuenow="{{ $second_player_percentage }}" aria-valuemin="{{ $second_player_percentage }}" aria-valuemax="100">{{ $second_player_percentage }}%</div>
                            </div>
                        </td>
                        @endif
    
                    {{-- Spawnable --}}
                    @elseif($territory->is_spawnable == 'yes')
                    <td id='{{ $territory->id }}' class='territories spawnable' onclick="setSpawnPoint({{ $territory->id }})" num_occupants='{{ $territory->num_occupants }}'></td>
    
                    {{-- Wall --}}
                    @elseif($territory->is_wall == 'yes')
                    <td id='{{ $territory->id }}' class='territories wall' num_occupants='{{ $territory->num_occupants }}'></td>

                    @else
                    <td id='{{ $territory->id }}' class='text-center territories refresh' num_occupants='{{ $territory->num_occupants }}'></td>
                    @endif
    
    
                @if($loop->index == $dibuka + $column)</tr>@endif
                @endforeach
            </table>
        </div>
        <div class="col-4">
            <div class="card" style='height: 100%; background-color: #3e3d44;'>
                <div class="card-body">

                    {{-- Alert 1 --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible" id="alert" style="display:none" role="alert">
                                <div class="alert-body" id="alert-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Alert 2 --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible" id="alert-2" style="display:none" role="alert">
                                <div class="alert-body" id="alert-body-2">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert-2">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Team --}}
                    <div class="divider divider-secondary">
                        <div class="divider-text"><i data-feather="users" style="color:white"></i></div>
                    </div>
                    <p class="text-white">Nama Team</p>
                    {{-- <label class="form-label" for="nama_team">Nama Team</label> --}}
                    {{-- <select class="select2 form-select" tabindex="-1" aria-hidden="true" id="nama_team" onchange="getDataTeam()"> --}}
                    <select class="select2 form-select" id="player_id" tabindex="-1" aria-hidden="true">
                        <option selected disabled>-- Pilih Nama Team --</option>
                        @foreach ($players as $player)
                            <option value="{{ $player->id }}">
                                {{ "[ ".$player->id." ] ".$player->team->nama }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Button Timer --}}
                    <div class="divider divider-secondary">
                        <div class="divider-text"><i data-feather="clock" style="color:white"></i></div>
                    </div>
                    <div class="d-flex justify-content-center px-4 mt-2 mb-1" >
                        <h4 class="text-white"><b>Timer : <span id="timer">120</span></b></h4>
                    </div>
                    <div class="d-flex justify-content-center px-3">
                        <div class="btn-group">
                            <button class="btn btn-gradient-success waves-effect waves-float waves-light" type="button" id="start">Start</button>
                            <button class="btn btn-gradient-warning waves-effect waves-float waves-light" type="button" id="pause">Pause</button>
                            <button class="btn btn-gradient-danger waves-effect waves-float waves-light" type="button" id="reset" >Reset</button>
                        </div>
                    </div>
                    
                    {{-- Button Move --}} 
                    <div class="divider divider-secondary">
                        <div class="divider-text"><i data-feather="activity" style="color:white"></i></div>
                    </div>
                    <div class="d-flex justify-content-center px-4 mt-2 mb-1">
                        <h4 class="text-white"><b>Action : <span id="step">8</span></b></h4>
                    </div>
                    <div class="d-flex justify-content-center px-4 mt-2">
                        <button type="button" class="btn btn-icon btn-gradient-primary me-2 mb-2 btn-control-action" onclick="move('kanan_atas')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-up-left' style="width: 24px; height:24px;"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-gradient-primary me-2 mb-2 btn-control-action" onclick="move('atas')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-up' style="width: 24px; height:24px;"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-gradient-primary mb-2 btn-control-action" onclick="move('kiri_atas')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-up-right' style="width: 24px; height:24px;"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center px-4" >
                        <button type="button" class="btn btn-icon btn-gradient-primary me-2 mb-2 btn-control-action" onclick="move('kiri')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-left' style="width: 24px; height:24px;"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-gradient-danger me-2 mb-2 btn-control-action" onclick="action()" style="width: 58px; height:58px;">
                            <i data-feather='zap' style="width: 24px; height:24px;"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-gradient-primary mb-2 btn-control-action" onclick="move('kanan')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-right' style="width: 24px; height:24px;"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center px-4" >
                        <button type="button" class="btn btn-icon btn-gradient-primary me-2 mb-2 btn-control-action" onclick="move('kiri_bawah')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-down-left' style="width: 24px; height:24px;"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-gradient-primary me-2 mb-2 btn-control-action" onclick="move('bawah')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-down' style="width: 24px; height:24px;"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-gradient-primary mb-2 btn-control-action" onclick="move('kanan_bawah')" style="width: 58px; height:58px;">
                            <i data-feather='arrow-down-right' style="width: 24px; height:24px;"></i>
                        </button>
                    </div>

                    {{-- Reset Step Button --}}
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-icon btn-gradient-secondary" id ="reset_step" style="width: 48px; height:48px;" >
                            <i data-feather='rotate-cw' style="width: 18px; height:18px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script>
        function setSpawnPoint(territory_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('penpos.gb.set.spawn') }}",
                data:{
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'player_id': $('#player_id').val(),
                        'territory_id': territory_id,
                    },
                success: function (data) {
                    $('#alert').hide();
                    $('#alert').show();
                    $('#alert-body').html(data.msg);

                    $("#alert").fadeTo(5000, 500).hide(1000, function(){
                            $("#alert").hide(1000);
                        });
                    if (data.status == "success") {
                        $('#alert').removeClass("alert-danger");
                        $('#alert').addClass("alert-success");
                    } 
                    else if (data.status == "error") {
                        $('#alert').removeClass("alert-success");
                        $('#alert').addClass("alert-danger");
                    }
                }
            })
        }

        function move(arah) {
            $('.btn-control-action').attr('disabled', true);
            
            // Ambil remaining step
            var remaining_step = $("#step").text() * 1;

            $.ajax({
                type: 'POST',
                url: "{{ route('penpos.gb.move') }}",
                data:{
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'arah': arah,
                        'player_id': $('#player_id').val(),
                        'sisa_move': remaining_step,
                    },
                success: function (data) {

                    // Jika response error, tidak usah di kurangi Actionnya
                    if(data.response == 'error')
                    {
                        $('.btn-control-action').attr('disabled', false);
                    } else {
                        // Kurangi remaining step
                        if (remaining_step > 0) {
                            remaining_step -= 1;
                            $("#step").html(remaining_step);
                        }
                    }

                    if (data.status != ""){
                        $('#alert').hide();
                        $('#alert').show();
                        $('#alert-body').html(data.msg);

                        $("#alert").fadeTo(5000, 500).hide(1000, function(){
                            $("#alert").hide(1000);
                        });
                        if (data.status == "success") {
                            $('#alert').removeClass("alert-danger");
                            $('#alert').addClass("alert-success");
                        } 
                        else if (data.status == "error") {
                            $('#alert').removeClass("alert-success");
                            $('#alert').addClass("alert-danger");
                        }
                    }
                }
            })
        }

        function action() {
            $('.btn-control-action').attr('disabled', true);
            
            // Ambil remaining step
            var remaining_step = $("#step").text() * 1;

            $.ajax({
                type: 'POST',
                url: "{{ route('penpos.gb.action') }}",
                data:{
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'player_id': $('#player_id').val(),
                        'sisa_move': remaining_step,
                    },
                success: function (data) {

                    // Jika response error, tidak usah di kurangi Actionnya
                    if(data.response == 'error') {
                        $('.btn-control-action').attr('disabled', false);
                    } else {
                        // Kurangi remaining step
                        if (remaining_step > 0) {
                            remaining_step -= 1;
                            $("#step").html(remaining_step);
                        }
                    }

                    if (data.status != ""){
                        $('#alert').hide();
                        $('#alert').show();
                        $('#alert-body').html(data.msg);

                        $("#alert").fadeTo(5000, 500).hide(1000, function(){
                            $("#alert").hide(1000);
                        });
                        if (data.status == "success") {
                            $('#alert').removeClass("alert-danger");
                            $('#alert').addClass("alert-success");
                        } 
                        else if (data.status == "error") {
                            $('#alert').removeClass("alert-success");
                            $('#alert').addClass("alert-danger");
                        }
                    }
                    if (data.status2 != ""){
                        $('#alert-2').hide();
                        $('#alert-2').show();
                        $('#alert-body-2').html(data.msg2);

                        $("#alert-2").fadeTo(5000, 500).hide(1000, function(){
                                $("#alert-2").hide(1000);
                            });
                        if (data.status2 == "success") {
                            $('#alert-2').removeClass("alert-danger");
                            $('#alert-2').addClass("alert-success");
                        } 
                        else if (data.status2 == "error") {
                            $('#alert-2').removeClass("alert-success");
                            $('#alert-2').addClass("alert-danger");
                        }
                    }
                }
            })
        }
    </script>
    
    <script>
        $(document).on('click', '#reset_step', function() {
            if(confirm("Apakah anda yakin ingin reset step?")==true){
                var step = 8;
                $("#step").html(step);
            }
        });

    </script>

    <script>
        var timer;
        var second = 120;
        var running = false;
        $(document).on('click', '#start', function() {
            if (!running){
                $("#timer").css('display','inline');
                running = true;
                timer = setInterval(function() {
                    second--;
                    $("#timer").text(second);
                    if (second <= 0) {
                        $("#timer").text('Waktu Habis');
                        alert('Waktu Habis');
                        running = false;
                        clearInterval(timer);
                        second = 120;
                    }
                }, 1000);
            }
        });

        
        $(document).on('click','#pause', function(){
            $("#timer").text(second);
            running = false
            clearInterval(timer);
        });
        
        $(document).on('click','#reset', function(){
            $('.btn-control-action').attr('disabled', false);
            $("#timer").text('120');
            running = false;
            clearInterval(timer);
            second = 120;
        });

        </script>
    
        <script src="{{ asset('js/updatemap.js') }}"></script>
@endsection


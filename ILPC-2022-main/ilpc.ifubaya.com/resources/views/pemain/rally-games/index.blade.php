@extends('pemain.layouts.app', ['pageActive' => 'pemain.rally-games', 'pageTitle' => 'Team Rally Games'])

@section('content')
<style>
    th,
    td {
        padding: 7px;
    }
</style>

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style='background-color: #5c657a'>
                            <h4 class="card-title text-white">Semifinal ILPC 2022 🏆</h4>
                            <!-- Button Gambes Semifinal  -->
                            @if(!$shopOpen->isEmpty())
                            <a href="{{ route('pemain.shop')}}" class="btn btn-success waves-effect">
                                <i data-feather="shopping-bag"></i> <span> Go to Shop</span>
                            </a>
                            @elseif($wave)
                            <a class="btn btn-dark waves-effect disabled" >
                                <i data-feather="shopping-bag"></i> <span> Wave {{$wave->nomor}} sedang berjalan</span>
                            </a>
                            @else
                            <a class="btn btn-dark waves-effect disabled">
                                <i data-feather="shopping-bag"></i> <span> Shop Telah Ditutup</span>
                            </a>
                            @endif
                        </div>
                        <div class="card-body mt-2 ">
                            <div class="card-text">
                                <div class="badge badge-light-primary">
                                    Mohon lakukan refresh page untuk update data
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-sm-6 col-12 mb-2 mt-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="user"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">ID {{$player->id}}</h4>
                                            <p class="card-text font-small-3  mb-0">Player ID</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 col-12 mb-2 mt-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-info avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="award"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$poin_rally}}</h4>
                                            <p class="card-text font-small-3  mb-0">Poin Rally Games</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 col-12 mb-2 mt-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-warning avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="award"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$player->poin_gambes}}</h4>
                                            <p class="card-text font-small-3  mb-0">Poin Game Besar</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 col-12 mb-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="dollar-sign"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$player->current_money?$player->current_money:0}}</h4>
                                            <p class="card-text font-small-3  mb-0">My Cash</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 col-12 mb-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-danger avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="zap"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$player->max_attack}}@isset($selected_weapon)+<span class='text-danger cursor-pointer' data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="{{$selected_weapon->name}} ({{$selected_weapon->pivot->current_durability}} pcs)">{{$selected_weapon->attack}}</span>@endisset</h4>
                                            <p class="card-text font-small-3  mb-0">Attack</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 col-12 mb-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success avatar-lg me-2">
                                            <div class="avatar-content" style="cursor:default"><i data-feather="heart"></i></div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{$player->current_health}}/{{$player->max_health}}</h4>
                                            <p class="card-text font-small-3  mb-0">Health</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Semifinal/ -->

            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-primary">Scoreboard Rally Games</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="badge badge-light-primary">
                                    Mohon lakukan refresh page untuk update score
                                </div>
                            </div>
                        </div>
                        <div table-responsive>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="80%">Nama Pos</th>
                                        <th width="20%" class="text-center">Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_team as $dt)
                                        <tr>
                                            <td>{{ $dt->name }}</td>
                                            @isset( $dt->score )
                                                <td class="text-center">{{ $dt->score }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                            @endisset
                                        </tr>
                                    @endforeach
                                </tbody>    
                            </table>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
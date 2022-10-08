@extends('pemain.layouts.app', ['pageActive' => 'pemain.active.contest', 'pageTitle' => 'Team Active Contest'])

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
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- Kick start -->
            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Active Contest ILPC 2022 🏆</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <p>
                                    Anda dapat melihat <b>Active Contest</b> yang sedang anda ikuti disini.
                                </p>
                                <div class="badge badge-light-primary">
                                    Semoga Beruntung :)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Kick start -->

            <!-- Active Contest -->
            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @include('layouts.alert')
                            <div class="card-header">
                                <h4 class="card-title">Active Contest</h4>
                            </div>
                            <table class="table mb-4">
                                <tr>
                                    <th width="30%">Nama Contest</th>
                                    <th width="30%">Tipe</th>
                                    <th width="20%">Jadwal Mulai</th>
                                    <th width="20%">Jadwal Selesai</th>
                                    <th width="8%">
                                        <p class="text-center">Masuk</p>
                                    </th>
                                </tr>
                                <tr>
                                    @foreach ($joined_contests as $contestsName => $contests)
                                    @foreach ($contests as $contest)
                                    <td>{{ $contest->nama }}</td>
                                    <td>{{ $contestsName }}</td>
                                    <td>{{ $contest->jadwal_mulai }}</td>
                                    <td>{{ $contest->jadwal_selesai }}</td>
                                    <td width="8%">
                                        <button class="btn btn-outline-primary waves-effect" style="width:100%;">
                                            <i data-feather="log-in"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Active Contest -->
        </div>
    </div>
</div>
@endsection
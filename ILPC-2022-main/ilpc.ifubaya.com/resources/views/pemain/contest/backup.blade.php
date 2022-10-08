@extends('pemain.layouts.app', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Contest'])

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
            
            {{-- Alert --}}
            <div class="col-8 d-none" id="alert">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="alert-body">
                        Anda berhasil tergabung dalam kontes 
                        <button type="button" class="btn-close" data-bs-dismiss="alert">
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Kick start -->
            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Selamat datang di Contest ILPC 2022 🏆</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <p>
                                    Anda dapat melihat <b>Available Contest</b> dan <b>Upcoming Contest</b> disini.
                                </p>
                                <div class="badge badge-light-primary">
                                    <strong>Hai {{ auth()->user()->username }}!</strong> Semoga harimu menyenangkan :)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Kick start -->

            <!-- Available Contest -->
            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Available Contest</h4>
                            </div>
                            <table class="table mb-4">
                                <tr>
                                    <th width="30%">Nama Contest</th>
                                    <th width="22%">Tipe</th>
                                    <th width="20%">Jadwal Mulai</th>
                                    <th width="20%">Jadwal Selesai</th>
                                    <th width="8%">
                                        <p class="text-center">Action</p>
                                    </th>
                                </tr>
                                @foreach ($active_contests as $contestsName => $contests)
                                @foreach ($contests as $contest)
                                <tr id="{{ $contestsName }}_{{ $contest->id }}">
                                    <td>{{ $contest->nama }}</td>
                                    <td>{{ $contestsName }}</td>
                                    <td>{{ $contest->jadwal_mulai }}</td>
                                    <td>{{ $contest->jadwal_selesai }}</td>
                                    <td width="8%">
                                        <button class="btn btn-outline-primary waves-effect" style="width:100%;" onclick="joinContest('{{ $contestsName }}', '{{ $contest->id }}')">
                                            <i data-feather="fast-forward"></i> Join
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
            <!-- /Available Contest -->

            <!-- Upcoming Contest -->
            <div class="row match-height">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @include('layouts.alert')
                            <div class="card-header">
                                <h4 class="card-title">Upcoming Contest</h4>
                            </div>
                            <table class="table mb-4">
                                <tr>
                                    <th width="30%">Nama Contest</th>
                                    <th width="22%">Tipe</th>
                                    <th width="20%">Jadwal Mulai</th>
                                    <th width="20%">Jadwal Selesai</th>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-secondary">No Upcoming Contest</td>
                                </tr>
                                @foreach ($upcoming_contests as $contestsName => $contests)
                                @foreach ($contests as $contest)
                                <tr>
                                    <td>{{ $contest->nama }}</td>
                                    <td>{{ $contestsName }}</td>
                                    <td>{{ $contest->jadwal_mulai }}</td>
                                    <td>{{ $contest->jadwal_selesai }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Upcoming Contest -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function joinContest(contest_type, contest_id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('pemain.join.contest') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'contest_type' : contest_type,
                'contest_id': contest_id,
                },
            success: function(data) {
                if(data.status == 'success'){
                    $("#"+contest_type+"_"+contest_id).remove()
                    $("#alert").removeClass('d-none')
                }
            }
        }); 
    }
</script>
@endsection
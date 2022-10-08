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
                        <div class="card-header" style='background-color: #5c657a'>
                            <h4 class="card-title text-white">Contest ILPC 2022 🏆</h4>
                        </div>
                        <div class="card-body mt-2">
                            <div class="card-text">
                                <p>
                                    Anda dapat melihat <b>Available Contest</b> dan <b>Upcoming Contest</b> disini.
                                </p>
                                <div class="badge badge-light-primary">
                                    Mohon lakukan refresh page untuk update data contest
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
                        <div class="card-header">
                            <h4 class="card-title text-primary">Available Contest</h4>
                        </div>
                        <div table-responsive>
                            @include('layouts.alert')
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="35%">Nama Contest</th>
                                        <th width="15%" class="text-center">Tipe</th>
                                        <th width="20%" class="text-center">Jadwal Mulai</th>
                                        <th width="20%" class="text-center">Jadwal Selesai</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $empty = 0;
                                @endphp
                                @foreach ($active_contests as $contestsName => $contests)
                                @forelse ($contests as $contest)
                                <tr>
                                    <td>{{ $contest->nama }}</td>
                                    <td class="text-center">{{ $contestsName }}</td>
                                    <td class="text-center">{{ $contest->jadwal_mulai }}</td>
                                    <td class="text-center">{{ $contest->jadwal_selesai }}</td>
                                    <td id="{{ $contestsName }}_{{ $contest->id }}">
                                        <form method='POST' action="{{ route('pemain.join.contest') }}">
                                            @csrf
                                            <input type="hidden" name="contest_type" value='{{ $contestsName }}'>
                                            <input type="hidden" name="contest_id" value='{{ $contest->id }}'>
                                            @isset ($contest->waktu_bergabung)
                                            <div class="me-2">
                                                <button class="btn btn-outline-primary waves-effect mx-1" name="status" value='Rejoin' type="submit" style="width:100%;">
                                                    <i data-feather="fast-forward"></i> <span>Rejoin</span>
                                                </button>
                                            </div>
                                            @else
                                            <div class="me-2">
                                                <button type='button' class="btn btn-outline-primary waves-effect mx-1" style="width:100%;" data-bs-toggle="modal" data-bs-target="#JoinModal{{ $contest->id  }}">
                                                    <i data-feather="play"></i> <span>Join</span>
                                                </button>
                                            {{-- MODAL FINISH ATTEMPT --}}
                                            <div class="modal fade" id="JoinModal{{ $contest->id }}" tabindex="-1" aria-labelledby="finishAttemptModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Join Contest</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to join {{ $contest->nama }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                            <button type="submit" class="btn btn-primary waves-effect mx-1" name="status" value='Join'>Join</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- END OF MODAL FINISH ATTEMPT --}}
                                            {{-- Add Modal Here --}}
                                            @endisset
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                @php
                                    $empty += 1;
                                @endphp
                                @endforelse
                                @endforeach
                                @if ($empty == count($active_contests))
                                    <tr>
                                        <td colspan="5" class="text-secondary text-center p-2">No Active Contest</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Available Contest -->

            <!-- Upcoming Contest -->
            <div class="row match-height" id="table-contextual">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Upcoming Contest</h4>
                        </div>   
                        <div table-responsive>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="35%">Nama Contest</th>
                                        <th width="15%" class="text-center">Tipe</th>
                                        <th width="20%" class="text-center">Jadwal Mulai</th>
                                        <th width="20%" class="text-center">Jadwal Selesai</th>
                                        <th width="10%" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $empty = 0;
                                    @endphp
                                    @foreach ($upcoming_contests as $contestsName => $contests)
                                    @forelse ($contests as $contest)
                                    <tr>
                                        <td>{{ $contest->nama }}</td>
                                        <td class="text-center">{{ $contestsName }}</td>
                                        <td class="text-center">{{ $contest->jadwal_mulai }}</td>
                                        <td class="text-center">{{ $contest->jadwal_selesai }}</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    @empty
                                    @php
                                        $empty += 1;
                                    @endphp
                                    @endforelse
                                    @endforeach
                                    @if ($empty == count($upcoming_contests))
                                    <tr>
                                        <td colspan="5" class="text-secondary text-center p-2">No Upcoming Contest</td>
                                    </tr>
                                    @endif
                                </tbody>
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

</script>
@endsection
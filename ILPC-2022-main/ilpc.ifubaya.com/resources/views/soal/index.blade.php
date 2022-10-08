@extends('soal.layouts.app', ['pageActive' => 'soal.index', 'pageTitle' => 'Soal Dashboard'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home</li>
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
            <h4 class="card-title">Selamat datang di Dashboard 🚀</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Anda dapat memulai perjalanan anda dengan memilih salah satu menu pada bagian
                    navigation di kiri.
                </p>
                <div class="alert alert-primary" role="alert">
                    <div class="alert-body">
                        <strong>Hai {{ auth()->user()->username }}!</strong> Semoga harimu menyenangkan :)
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Kick start -->
    
    @if (Auth::user()->role == 'soal')
    <!-- Available Contest -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary">Available Contest</h4>
                </div>
                <div class="table-responsive">
                    @include('layouts.alert')
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30%">Nama Contest</th>
                                <th width="22%" class="text-center">Tipe</th>
                                <th width="20%" class="text-center">Jadwal Mulai</th>
                                <th width="20%" class="text-center">Jadwal Selesai</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $empty = 0;
                            $frontRoute = "";
                            @endphp
                            @foreach ($active_contests as $contestsName => $contests)
                                @forelse ($contests as $contest)
                                    <tr>
                                        <td>{{ $contest->nama }}</td>
                                        <td class="text-center">{{ $contestsName }}</td>
                                        <td class="text-center">{{ $contest->jadwal_mulai }}</td>
                                        <td class="text-center">{{ $contest->jadwal_selesai }}</td>
                                        @php
                                            if($contestsName == "Programming")
                                                $frontRoute = "soal.prg.show";
                                            else if ($contestsName == "Essay")
                                                $frontRoute = "soal.essay.show";
                                            else
                                                $frontRoute = "soal.mc.show";
                                        @endphp     
                                        <td>
                                            <a class="btn btn-outline-info" href="{{ route($frontRoute, $contest->id) }}" style="width:100%;"> 
                                                <i data-feather="book-open"></i>
                                            </a>
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
                                <td colspan="5" class="text-secondary text-center p-2">No Available Contest</td>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="bg-secondary" style="color: #6e6b7b">
                                <th width="30%">Nama Contest</th>
                                <th width="22%" class="text-center">Tipe</th>
                                <th width="20%" class="text-center">Jadwal Mulai</th>
                                <th width="20%" class="text-center">Jadwal Selesai</th>
                                <th width="15%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $empty = 0;
                                $frontRoute ="";
                            @endphp
                            @foreach ($upcoming_contests as $contestsName => $contests)
                                @forelse ($contests as $contest)
                                    <tr>
                                        <td>{{ $contest->nama }}</td>
                                        <td class="text-center">{{ $contestsName }}</td>
                                        <td class="text-center">{{ $contest->jadwal_mulai }}</td>
                                        <td class="text-center">{{ $contest->jadwal_selesai }}</td>
                                        @php
                                            if($contestsName == "Programming")
                                                $frontRoute = "soal.prg.show";
                                            else if ($contestsName == "Essay")
                                                $frontRoute = "soal.essay.show";
                                            else
                                                $frontRoute = "soal.mc.show";
                                        @endphp
                                        <td><a class="btn btn-outline-info" href="{{ route($frontRoute,$contest->id) }}" style="width:100%;"> <i data-feather="book-open"></i></a></td>
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
    @endif

    @if (Auth::user()->role == 'acara')

    @endif

</div>
@endsection
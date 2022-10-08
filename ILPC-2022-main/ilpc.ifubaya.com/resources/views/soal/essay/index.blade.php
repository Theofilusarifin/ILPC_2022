@extends('soal.layouts.app', ['pageActive' => 'soal.essay.index', 'pageTitle' => 'Soal Essay'])

@section('header')
<style>
    ul {
        margin: 0;
    }
</style>


@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active">Essay</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @if (Auth::user()->role == 'soal')
    <!-- Kick start -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Introduction</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Hi, {{ auth()->user()->username }}! <br>
                    Di sini, anda dapat menambah dan melakukan pengaturan terhadap soal essay.<br>
                    Untuk memudahkan pencarian contest, anda dapat menggunakan fitur Search&Filter.<br>
                    Untuk membuat contest baru, anda dapat menekan tombol <i class="text-success" data-feather="plus-square"></i> di ujung kanan pada tabel list contest.<br>
                    Untuk melihat detail contest, anda dapat menekan tombol <i class="text-info" data-feather="book-open"></i> pada contest yang diinginkan.<br>
                    Untuk menghapus contest, anda dapat menekan tombol <i class="text-danger" data-feather="trash-2"></i> pada contest yang diinginkan.
                    <br>
                <div class="badge badge-light-primary">
                    Teliti kembali setiap contest yang telah anda buat atau ubah.
                </div>
                <br><br>
                Love,
                <br><br>
                Tim SI
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
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List of Essay Contest</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            @php
            session()->flash("error", "Mohon isi data dengan benar");
            @endphp
            @endif
            @include('layouts.alert')
            <h4 class="card-title mt-2">Search &amp; Filter</h4>
            <form method="get" action="{{ route('soal.essay.search') }}" class="mt-2">
                {{-- @csrf --}}
                <div class="row">
                    <div class="col-md-6">
                        <label for="team_nama" class="form-label">Contest Name :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Keyword" name="keyword" value="{{ session('keyword') ?? '' }}">
                            <button class="btn btn-outline-primary waves-effect" type="submit"><i data-feather="search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="card-body">
            <div class="divider mb-2">
                <div class="divider-text">
                    {{ $contests->onEachSide(1)->withQueryString()->links() }}</div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-2">
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Nama</th>
                    <th width="20%">Jadwal Mulai</th>
                    <th width="20%">Jadwal Selesai</th>
                    <th width="5$">Pembuat</th>
                    <th width="5%">
    
                        @if (Auth::user()->role == 'soal')
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="max-width:100%;">
                            <i data-feather="plus-square"></i>
                        </button>
                        @endif
                    </th>
                </tr>
                @foreach ($contests as $contest)
                <tr>
                    <td>{{ $contest->id }}</td>
                    <td>{{ $contest->nama }}</td>
                    <td>{{ $contest->jadwal_mulai }}</td>
                    <td>{{ $contest->jadwal_selesai }}</td>
                    <td>{{ $contest->admin->nama }}</td>
                    <td width="8%">
                        {{-- @if (Auth::user()->user->id == $contest->id) --}}
                        <a class="btn btn-outline-info" href="{{ route('soal.essay.show',$contest->id) }}" style="width:100%;">
                            <i data-feather="book-open"></i></a>
                        {{-- @endif --}}
                        @if (Auth::user()->role == 'soal')
                        <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="getEssayDataToDelete({{ $contest->id }})" style="width:100%;">
                            <i data-feather="trash-2"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>

@if (Auth::user()->role == 'soal')
{{-- MODAL ADD --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contest</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('soal.essay.store') }}" id="soalEssaysStore">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-1">
                        <label for="nama" class="form-label">Nama Contest</label>
                        <input type="text" class="form-control" name="nama" id="add_nama" placeholder="Nama Contest" aria-describedby="nama" tabindex="1" autofocus />
                    </div>

                    {{-- Jadwal Mulai --}}
                    <div class="mb-1">
                        <label class="form-label" for="add_jadwal_mulai">Jadwal Mulai</label>
                        <input type="text" id="add_jadwal_mulai" name="jadwal_mulai" class="form-control flatpickr-date-time flatpickr-input" placeholder="YYYY-MM-DD HH:MM" />
                    </div>

                    {{-- Jadwal Selesai --}}
                    <div class="mb-1">
                        <label class="form-label" for="add_jadwal_selesai">Jadwal Selesai</label>
                        <input type="text" id="add_jadwal_selesai" name="jadwal_selesai" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" />
                    </div>
                    {{-- <div class="col-md-6 mb-1">
                        <label class="form-label" for="fp-date-time">Date & TIme</label>
                        <input type="text" id="fp-date-time" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" />
                    </div> --}}

                </form>
            </div>
            <div class="modal-footer">
                <button form="soalEssaysStore" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL ADD --}}

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Essay</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="soalEssaysDelete">
                    @csrf
                    <p>Apakah anda yakin untuk delete Contest Essay ini?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button form="soalEssaysDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL DELETE --}}
@endif


@endsection

@section('script')

<script>
    function getEssayDataToDelete(id){
        $("#soalEssaysDelete").attr("action", "{{ route('soal.essay.index') }}/destroy/"+id)
    }
</script>

@endsection
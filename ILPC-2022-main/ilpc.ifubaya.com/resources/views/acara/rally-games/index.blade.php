@extends('soal.layouts.app', ['pageActive' => 'acara.rally.index', 'pageTitle' => 'Pos Rally Games'])

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
                            Di sini, anda dapat menambah dan melakukan pengaturan terhadap  Rally Games. <br>
                            Untuk memudahkan pencarian Rally Games, anda dapat menggunakan fitur Search&Filter.<br>
                            Untuk membuat Rally Games baru, anda dapat menekan tombol <i class="text-success" data-feather="plus-square"></i> di ujung kanan pada tabel list Rally Games.<br>
                            Untuk menghapus Rally Games, anda dapat menekan tombol <i class="text-danger" data-feather="trash-2"></i> pada rg yang diinginkan.
                            <br>
                            <div class="badge badge-light-primary">
                                Teliti kembali setiap Rally Games yang telah anda buat atau ubah.
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
        </div>
    </div>
        
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Rally Games</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @php
                        session()->flash("error", "Mohon isi data dengan benar");
                        @endphp
                    @endif
                    @include('layouts.alert')
                    <h4 class="card-title mt-2">Search &amp; Filter</h4>
                    <form method="get" action="{{ route('acara.rg.search') }}" class="mt-2">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="team_nama" class="form-label">Rally Game Name :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Keyword" name="keyword" value="{{ session('keyword') ?? '' }}">
                                    <button class="btn btn-outline-primary waves-effect" type="submit">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        
                
                <div class="card-body">
                    <div class="divider mb-2">
                        <div class="divider-text">
                            {{ $rally_games->onEachSide(1)->withQueryString()->links() }}</div>
                        </div>
                    </div>
        
                    <table class="table mb-2">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Nama</th>
                            <th width="5%" class="text-center">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="max-width:100%;">
                                    <i data-feather="plus-square"></i>
                                </button>
                            </th>
                        </tr>
                        @foreach ($rally_games as $rg)
                        <tr>
                            <td>{{ $rg->id }}</td>
                            <td>{{ $rg->name }}</td>
                            <td width="5%" class="text-center">
                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="getRallyGameDelete({{ $rg->id }})" style="max-width:100%;">
                                    <i data-feather="trash-2"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        
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
                        <form method="post" action="{{ route('acara.rg.store') }}" id="acaraRallyGamesStore">
                            @csrf
        
                            {{-- Nama --}}
                            <div class="mb-1">
                                <label for="nama" class="form-label">Nama Contest</label>
                                <input type="text" class="form-control" name="name" id="add_name" placeholder="Nama Contest" aria-describedby="name" tabindex="1" autofocus />
                            </div>
        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="acaraRallyGamesStore" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
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
                        <h4 class="modal-title">Delete Rally Games</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="acaraRallyGameDelete">
                            @csrf
                            <p>Apakah anda yakin untuk menghapus Rally Game ini?</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="acaraRallyGameDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END OF MODAL DELETE --}}
        
        @endsection
        
        @section('script')
        
        <script>
            function getRallyGameDelete(id){
                $("#acaraRallyGameDelete").attr("action", "{{ route('acara.rg.index') }}/rally-games/destroy/"+id)
            }
        </script>          
@endsection
